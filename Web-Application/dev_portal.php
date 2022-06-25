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

  <title>Dev Portal</title>
</head>
<?php
include "dev_check.php";
$user = $_SESSION['user'];
$query = "SELECT devname from dev where user = '$user'";
$result = $conn->query($query);
$devname="";
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $devname = $row['devname'];
  }
}
require_once('db_dev_portal.php');
$total_price = get_total_price($devname);
$total_bills = count_purchased_bills($devname);
$show_bill = show_bills($devname);


?>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="dev_portal.php">NH-Store Developer</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mr-auto mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="dev_portal.php">Đơn hàng của tôi <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dev_manager.php">Quản lý ứng dụng của tôi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dev_upload.php">Upload </a>
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
    <div class="border rounded mt-4 px-3 shadow">
      <h3 class="mt-2">Bảng tóm tắt </h3>
      <p>Tổng doanh thu: <span class="float-right text-primary mr-3 font-weight-bold"><?= $total_price ?></span></p>
      <p>Tổng số hóa đơn hiện có: <span class="float-right text-danger mr-3 font-weight-bold"><?= $total_bills ?></span></p>
    </div>
    <div class="mt-5">
      <h3>Thống kê chi tiết</h3>
    </div>
    <table class="table table-hover border mt-3">
      <thead>
        <tr>
          <th>Bill ID</th>
          <th>Tên ứng dụng</th>
          <th>Giá bán</th>
          <th>Nguời mua</th>
        </tr>
      </thead>
      <tbody>
        <!--SHOW DATA -->
        <?php
        if ($show_bill != NULL) {
          while ($row = $show_bill->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["billid"] . "</td>";
            echo "<td>" . $row["appname"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td>" . $row["user"] . "</td>";
            echo "</tr>";
          }
        }
        ?>
      </tbody>
    </table>
  </div>


  <!--SCRIPT-->
  <script src="main.js"></script>
</body>

</html>