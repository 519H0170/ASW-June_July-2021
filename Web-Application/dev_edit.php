<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">

  <title>Dev's Upload</title>
</head>
<?php
include "dev_check.php";
require_once('db_dev_upload_listcate.php');
require_once('db_dev_edit_upload.php');

require_once('db_dev_edit.php');


// KIEM TRA TRANG WEB SU DUNG GET['appid'] TAI URL
if (!isset($_GET['appid'])) {
  die('Đường dẫn thiếu tên appid');
}

$appid = $_GET['appid'];

$user = $_SESSION['user'];
$query = "SELECT devname from dev where user = '$user'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $devname = $row['devname'];
  }
}
// CẤP QUYỀN EDIT KHI APPID TRÙNG DEVNAME TẠI SESSION['devname']
if (!verify_appid_devname($appid, $devname)) {
  die('Bạn không có thẩm quyền để truy cập trang này');
}
// $list_cate = get_cate_list();

$data = get_data_from_appid($appid);

// print_r($data);

$list_cate = get_cate_list();



?>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="dev_portal.php">NH-Store Developer</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="dev_portal.php">Đơn hàng của tôi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dev_manager.php">Quản lý ứng dụng của tôi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dev_upload.php">Upload</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="./"> UserMode </span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"> Logout <span class='fa fa-sign-out'> </span></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-9 col-lg-6 mt-5" id="col-2">
        <h3 class="text-center">Chỉnh sửa ứng dụng</h3>
        <form method="post" class="rounded shadow mb-5 mt-2 mx-auto" id="form-login-body" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-lg-12 mx-auto px-4">
              <label for="appname" class="text-primary mt-2 font-weight-bold">Tên ứng dụng</label>
              <input name="appname" id="appname" type="text" class="form-control" placeholder="Tên ứng dụng" value="<?= $data['appname'] ?>" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12 mx-auto px-4">
              <label for="txa-short" class="text-primary mt-2 font-weight-bold">Mô tả ngắn</label>
              <textarea class="form-control" id="txa-short" rows="2" name="short_d"><?= $data['short_d'] ?></textarea>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12 mx-auto px-4">
              <label for="txa-long" class="text-primary mt-2 font-weight-bold">Mô tả chi tiết của ứng dụng</label>
              <textarea class="form-control" id="txa-long" rows="5" name="long_d"><?= $data['long_d'] ?></textarea>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12 mx-auto px-4">
              <label for="ds-app" class="text-primary mt-2 font-weight-bold">Thể loại</label>
              <select class="form-control" id="ds-app" name="category">
                <?php
                if ($list_cate != NULL) {
                  while ($row = $list_cate->fetch_assoc()) {
                    if ($row['category'] != $data['category']) {
                      echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                    } else {
                      echo "<option selected value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                    }
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12 mx-auto px-4">
              <label for="app-price" class="text-primary mt-2 font-weight-bold">Đơn giá (Mặc định là 0, bội chung nhỏ nhất là 10.000)</label>
              <input type="number" class="form-control" id="app-price" name="app-price" min="0" max="5000000" step="10000" value="<?= $data['price'] ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-12 mx-auto px-4">
              <p class="text-primary mt-2 font-weight-bold">Upload ảnh icon ứng dụng</p>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="app-icon" name="app-icon">
                <label class="custom-file-label text-dark" for="app-icon">Chọn file icon ứng dụng</label>
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-12 mx-auto px-4">
              <span class="text-primary mt-2 font-weight-bold">Upload ảnh sản phẩm (Sẽ tự động xóa tất ảnh cũ nếu có ảnh mới chèn vào)</span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-6 mx-auto px-4">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="app-pic-1" name="app-pic-1">
                <label class="custom-file-label text-dark" for="app-pic-1">Ảnh 1</label>
              </div>
            </div>
            <div class="form-group col-lg-6 mx-auto px-4">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="app-pic-2" name="app-pic-2">
                <label class="custom-file-label text-dark" for="app-pic-2">Ảnh 2</label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-6 mx-auto px-4">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="app-pic-3" name="app-pic-3">
                <label class="custom-file-label text-dark" for="app-pic-3">Ảnh 3</label>
              </div>
            </div>
            <div class="form-group col-lg-6 mx-auto px-4">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="app-pic-4" name="app-pic-4">
                <label class="custom-file-label text-dark" for="aapp-pic-4">Ảnh 4</label>
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-12 mx-auto px-4">
              <p class="text-primary mt-2 font-weight-bold">Upload File cài đặt ứng dụng (*.zip)</p>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="app-data" name="app-data">
                <label class="custom-file-label text-dark" for="app-data">Ứng dụng tối đa là 25MB</label>
              </div>
            </div>
          </div>

          <?php
          if ($data['status'] == 'draft' || $data['status'] == 'pending') {
          ?>
            <div class="form-row">
              <div class="form-group col-lg-12 mx-auto px-4">
                <p class="text-primary mt-2 font-weight-bold">Chọn hình thức nộp file</p>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="app-status" id="app-status-d" value="draft" checked>
                  <label class="form-check-label text-dark" for="app-status-d">Lưu dưới dạng nháp</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="app-status" id="app-status-p" value="pending">
                  <label class="form-check-label text-dark" for="app-status-p">Nộp lên để chờ duyệt</label>
                </div>
              </div>
            </div>
          <?php
          }

          ?>


          <div class="form-row">
            <div class="form-group col-lg-12 mx-auto px-4">
              <!-- <div class='alert alert-danger'>$error</div> -->
              <button class="btn btn-success px-5" type="submit" name="app-btn-submit">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>



  <!-- SCRIPT-->
  <script src="main.js"></script>
</body>

</html>