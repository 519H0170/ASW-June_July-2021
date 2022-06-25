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
  <title>Dev Management</title>
</head>

<?php
include "dev_check.php";
// Take Dev name
$user = $_SESSION['user'];
$query = "SELECT devname from dev where user = '$user'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $devname = $row['devname'];
  }
}
?>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">NH-Store Developer</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="dev_portal.php">Đơn hàng của tôi</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="dev_manager">Quản lý ứng dụng của tôi <span class="sr-only">(current)</span></a>
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
      <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> -->
    </div>
  </nav>

  <div class="container">
    <div class="mt-5">
      <h3>Quản lý ứng dụng của tôi</h3>
    </div>
    <button class="btn btn-success mt-3" id="dev-mana-load" data-value="<?= $devname ?>">Load data</button>
    <table class="table table-hover border mt-3 text-center">
      <thead>
        <tr>
          <th>Tên ứng dụng</th>
          <th>Trạng thái</th>
          <th>Tính phí?</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody id="dev-mana-show">
        <!-- <tr>
            <td>Angry Birds</td>
            <td>Bản nháp</td>
            <td>
                <button class="btn btn-warning">Sửa</button>
                <button class="btn btn-danger">Xóa</button>
          </tr>
          <tr>
            <td>Angry Birds 2</td>
            <td>Đang chờ duyệt</td>
            <td>
              <button class="btn btn-warning">Sửa</button>
              <button class="btn btn-danger">Xóa</button>
            </td>
          </tr> -->
      </tbody>
    </table>
  </div>



  <!-- SCRIPT-->
  <script src="main.js" type="text/javascript"></script>
</body>

</html>