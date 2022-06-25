<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <title>Admin App Details</title>
</head>
<?php
include "admin_check.php";
// define('HOST','127.0.0.1');
// define('USER','nguyent');
// define('PASS','123456');
// define('DB','simulatestore');
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'simulatestore');
//--------------//
function open_database()
{
  $conn = new mysqli(HOST, USER, PASS, DB);
  if ($conn->connect_error) {
    die('Connect error ' . $conn->connect_error);
  }
  return $conn;
}

$error = "";
$cate = $name = $short_d = $long_d = $price = $icon = $picture = $fileapp = "";
if ($_GET) {
  if ($_GET['appid']) {
    $aid = $_GET['appid'];
    $sql = "SELECT * from `app` where appid = '$aid' and `status`='pending'";
    $mysqli = open_database();
    $stm = $mysqli->prepare($sql);
    $stm->execute();
    $result = $stm->get_result();
    if (mysqli_num_rows($result) == 1) {
      while ($data = $result->fetch_assoc()) {
        $cate = $data['category'];
        $name = $data['appname'];
        $short_d = $data['short_d'];
        $long_d = $data['long_d'];
        $price = $data['price'];
        $icon = $data['icon'];
        $dir = $icon;
        $icon = glob($dir . "/*.{jpg,img,jpeg,png}", GLOB_BRACE);
        foreach ($icon as $icon) {
          $icon = $icon;
        }
        $picture = $data['picture'];
        $dir = $picture;
        $picture = glob($dir . "/*.{jpg,img,jpeg,png}", GLOB_BRACE);
        $fileapp = $data['file_app'];
        $dir = $fileapp;
        $fileapp = glob($dir . "/*.{zip}", GLOB_BRACE);
      }
    } else {
      $error = "<div class='container p-3 text-dark mt-2 text-center'>
          <h2> ID không tồn tại hoặc không cần duyệt </h2>
          <a href='admin_portal.php' class='btn btn-primary p-2 mt-2'>Về trang duyệt</a>
        </div>";
    }
  } else {
    $error = "<div class='container p-3 text-dark mt-2 text-center'>
          <h2> Không nhận được app id để duyệt ứng dụng</h2>
          <a href='admin_portal.php' class='btn btn-primary p-2 mt-2'>Về trang duyệt</a>
        </div>";
  }
} else {
  $error = "<div class='container p-3 text-dark mt-2 text-center'>
          <h2> Không nhận được thông tin nào để triển khai</h2>
          <a href='admin_portal.php' class='btn btn-primary p-2 mt-2'>Về trang duyệt</a>
        </div>";
}



//Duyet
if ($_POST) {
  $error = '';
  $path = "./app";

  if (isset($_POST['browse-a'])) {
    $aid = $_POST['appid'];
    $duyet = $_POST['browse-a'];
    if ($duyet == "yes") {
      $conn = open_database();
      $query = "UPDATE app SET status = 'published' where appid='$aid'";
      $result = mysqli_query($conn, $query);
      $error = "<div class='container p-3 text-dark mt-2 text-center'>
      <h2> Duyệt app thành công</h2>
      <a href='admin_portal.php' class='btn btn-primary p-2 mt-2'>Duyệt app khác</a>
    </div>";
    } else {
      $sql = "SELECT file_app,icon FROM app where appid='$aid'";
      $mysqli = open_database();
      $stm = $mysqli->prepare($sql);
      $stm->execute();
      $result = $stm->get_result();

      if ($result->num_rows == 0) {
        die(); // khong co data ton tai
      }

      $data = $result->fetch_assoc();

      $link = $data['file_app'];
      $icon = $data['icon'];
      // DELETE FILE
      $flink = glob($link . '/*');
      foreach ($flink as $fl) {
        if (is_file($fl)) {
          unlink($fl);
        }
      }

      $ficon = glob($icon . '/*');
      foreach ($ficon as $fi) {
        if (is_file($fi)) {
          unlink($fi);
        }
      }

      rmdir($icon);
      rmdir($link);

      // DELETE STATEMENT
      $sql = "DELETE FROM app WHERE appid='$aid'";
      $stm = $mysqli->prepare($sql);

      $stm->execute();
      $result = $stm->get_result();

      $error = "<div class='container p-3 text-dark mt-2 text-center'>
      <h2> Xóa app thành công </h2>
      <a href='admin_portal.php' class='btn btn-primary p-2 mt-2'>Duyệt app khác</a>
    </div>";
    }
  } else {
    die();
  }
} else {
}
?>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="admin_portal.php">NH-Store Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="admin_portal.php">Duyệt ứng dụng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_listgc.php">Xem mã thẻ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_gc.php">Tạo mã thẻ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_category.php">Quản lý thể loại</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_statistic.php">Thống kê</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto mt-lg-0 mt-sm-4">
        <li class="nav-item">
          <a class="nav-link" href="./"> UserMode </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"> Logout <span class='fa fa-sign-out'> </span></a>
        </li>
      </ul>
    </div>
  </nav>
  <?php
  if ($error == "") {
  } else {
    echo $error;
    die();
  }
  ?>
  <div id="thongbao"></div>
  <div class="container">
    <form method="post" class="rounded shadow mb-3 mt-4 mx-auto" id="form-login-body">
      <div class="form-row">
        <div class="form-group col-lg-12 mx-auto px-4 mt-2 bg">
          <p>Ứng dụng này có đủ yêu cầu để được duyệt?</p>
          <div class="form-check-inline">
            <input type="radio" class="form-check-input" id="app-browse-y" name="browse-a" value="yes" checked>
            <label class="form-check-label text-dark" for="app-browse-y">
              Yes
            </label>
          </div>
          <div class="form-check-inline">
            <input type="radio" class="form-check-input" id="app-browse-n" name="browse-a" value="no">
            <label class="form-check-label text-dark" for="app-browse-n">
              No
            </label>
          </div>
          <input type="hidden" name="appid" value="<?= $aid ?>">

          <button class="btn btn-success px-5 float-right" type="submit">Submit</button>
        </div>
      </div>
    </form>

    <div class="form-row">
      <div class="form-group col-lg-12 mx-auto px-4">
        <label for="fname" class="text-primary mt-2 font-weight-bold">Tên ứng dụng</label>
        <input name="fname" id="fname" type="text" class="form-control" placeholder="Tên ứng dụng" value="<?= $name ?>" require readonly>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-lg-12 mx-auto px-4">
        <label for="txa-short" class="text-primary mt-2 font-weight-bold">Mô tả ngắn</label>
        <textarea class="form-control" id="txa-short" rows="2" readonly><?= $short_d ?></textarea>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-lg-12 mx-auto px-4">
        <label for="txa-long" class="text-primary mt-2 font-weight-bold">Mô tả chi tiết</label>
        <textarea class="form-control" id="txa-long" rows="5" readonly><?= $long_d ?></textarea>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-lg-12 mx-auto px-4">
        <!-- <label for="ds-app" class="text-primary mt-2 font-weight-bold">Thể loại</label>
        <select class="form-control" id="ds-app" name="category">
          <option value="education">Giáo dục</option>
          <option value="sport">Thể thao</option>
          <option value="game">Trò chơi</option>
          <option value="life">Đời sống</option>
          <option value="family">Gia đình</option>
          <option value="economic">Kinh tế</option>
          <option value="snetwork">Mạng xã hội</option>
        </select> -->
        <label for="cate" class="text-primary mt-2 font-weight-bold">Thể loại</label>
        <input name="cate" id="cate" type="text" class="form-control" value="<?= $cate ?>" require readonly>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-lg-12 mx-auto px-4">
        <label for="app-price" class="text-primary mt-2 font-weight-bold">Đơn giá (Mặc định là 0, bội chung nhỏ nhất là 10.000)</label>
        <input type="number" class="form-control" id="app-price" name="app-price" min="0" max="5000000" step="10000" value="<?= $price ?>" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-lg-12 mx-auto px-4">
        <p class="text-primary mt-2 font-weight-bold">Icon</p>
        <img src="<?= $icon ?>" height="100" width="100">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-lg-12 mx-auto px-4">
        <p class="text-primary mt-2 font-weight-bold">Icon</p>
        <?php foreach ($picture as $demo) {
          echo ' <img src="' . $demo . '" class="mr-2 border border-dark rounded">';
        }
        ?>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-lg-12 mx-auto px-4">
        <p class="text-primary mt-2 font-weight-bold">File(*.zip)</p>
        <div class="custom-file">
          <?php if ($fileapp != "") {
            $havefile = "Có file app";
          } else {
            $havefile = "Không tìm thấy file app";
          } ?>
          <input type="text" class="form-control" value="<?= $havefile ?>" readonly>
        </div>
      </div>
    </div>
  </div>
</body>

</html>