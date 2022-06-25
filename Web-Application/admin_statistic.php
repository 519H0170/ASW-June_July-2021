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
  <title>Statistics</title>
</head>
<?php
include "admin_check.php";

require_once('db_ad_statistic.php');

$count_user = count_user();
$count_dev = count_dev();
$count_app = count_app();

$list_cate = list_cate();

$list_dl_app = list_download_app();
$list_ps_app = list_purchased_app();

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
        <li class="nav-item active">
          <a class="nav-link disabled" href="#">Thống kê<span class="sr-only">(current)</span></a>
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

  <div class="container">
    <div class="row mt-5 mb-3">
      <div class="col-12 border rounded shadow">
        <h4 class="mt-2 text-primary">Thống kê tổng quan</h4>
        <p>Tổng số người dùng (User): <span class="float-right"> <?= $count_user ?></span> </p>
        <p>Tổng số người phát triển (Dev): <span class="float-right"> <?= $count_dev ?></span> </p>
        <p>Tổng số ứng dụng trong chợ (Apps): <span class="float-right"> <?= $count_app ?></span> </p>
      </div>
    </div>
    <div class="row mt-4 mb-3">
      <div class="col-12 border rounded shadow">
        <h4 class="mt-2 text-primary">Danh sách các thể loại</h4>
        <table class="table table-hover border mt-3">
          <thead>
            <tr>
              <th class="text-center">Tên thể loại</th>
              <th class="text-center">Số lượng</th>
            </tr>
          </thead>
          <tbody>

            <?php
            if ($list_cate != NULL) {
              while ($row = $list_cate->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='text-center'>" . $row['category'] . "</td>";
                if ($row['numb'] == NULL) {
                  $row['numb'] = 0;
                }
                echo "<td class='text-center'>" . $row['numb'] . "</td>";
                echo "</tr>";
              }
            }
            ?>

          </tbody>
        </table>
      </div>
    </div>
    <div class="row mt-4 mb-3">
      <div class="col-12 col-md-5 border rounded shadow">
        <h4 class="mt-2 text-primary">Top 5 Ứng dụng tải nhiều nhất</h4>
        <table class="table table-hover border mt-3">
          <?php
          if ($list_dl_app->num_rows > 0) {
            echo '<thead>
                    <tr>
                      <th class="text-center">Tên ứng dụng</th>
                      <th class="text-center">Lượt tải</th>
                    </tr>
                  </thead>
                  <tbody>';
            while ($row = $list_dl_app->fetch_assoc()) {
              echo "<tr>";
              echo "<td class='text-center'>" . $row['appname'] . "</td>";
              echo "<td class='text-center'>" . $row['dl_count'] . "</td>";
              echo "</tr>";
              echo "</tbody>";
            }
          } else {
            echo '<tr><td align="center" class="p-5 text-light bg-secondary">Chưa ai mua ứng dụng trả phí</td></tr>';
          }
          ?>
        </table>
      </div>
      <div class="col-md-2 mt-4"></div>
      <div class="col-12 col-md-5 border rounded shadow">
        <h4 class="mt-2 text-primary">Top 5 Ứng dụng mua nhiều nhất</h4>
        <table class="table table-hover border mt-3">
          <?php
          if ($list_ps_app->num_rows > 0) {
            echo '<thead>
                      <tr>
                        <th>Tên ứng dụng</th>
                        <th>Giá</th>
                        <th>Lượt mua</th>
                      </tr>
                    </thead>
                    <tbody>';
            while ($row = $list_ps_app->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['appname'] . "</td>";
              echo "<td>" . $row['price'] . "</td>";
              echo "<td>" . $row['dl_count'] . "</td>";
              echo "</tr>";
              echo "</tbody>";
            }
          } else {
            echo '<tr><td align="center" class="p-5 text-light bg-secondary">Chưa ai mua ứng dụng trả phí</td></tr>';
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</body>

</html>