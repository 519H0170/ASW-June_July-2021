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
    <title>Create Giftcards</title>
</head>

<?php
include "admin_check.php";
require_once('db_ad_gc.php');

// TAO SESSION LUU TEN ADMIN
//$admin = .....      <---

//DEMO
$admin = "Administrator";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST['quantity'];
    $value = $_POST['price'];

    insert_gc($number, $value, $admin);
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

                <li class="nav-item active">
                    <a class="nav-link disabled" href="#">Tạo mã thẻ<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_category.php">Quản lý thể loại</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_statistic.php">Thống kê</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="./"> UserMode <span class='fa fa-sign-out'> </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"> Logout <span class='fa fa-sign-out'> </span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        ?>
            <div class="row ml-1 mr-1">
                <div class="rounded shadow border border-success col-12 mt-4">
                    <p class="mt-2 font-weight-bold">Tạo mã thẻ thành công!</p>
                </div>
            </div>
        <?php
        }
        ?>

        <form class="rounded shadow mb-5 mt-4 mx-auto" method="POST">
            <div class="form-row">
                <div class="form-group col-lg-12 mx-auto px-4">
                    <h3 class="mt-3 ">Tạo mã thẻ</h3>
                    <label for="ad-gc-ca" class="text-primary mt-2 font-weight-bold">Chọn mệnh giá</label>
                    <select class="form-control" id="ad-gc-ca" name="price">
                        <option value="20000">20000</option>
                        <option value="50000">50000</option>
                        <option value="100000">100000</option>
                        <option value="200000">200000</option>
                        <option value="500000">500000</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-12 mx-auto px-4">
                    <label for="gc-quantity" class="text-primary mt-2 font-weight-bold">Số lượng</label>
                    <input type="number" class="form-control" id="gc-quantity" name="quantity" min="1" max="100" value="1">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-12 mx-auto px-4">
                    <!-- <div class='alert alert-danger'>$error</div> -->
                    <button class="btn btn-success px-5" type="submit">Submit</button>
                </div>
            </div>
        </form>

    </div>
</body>
<script src="main.js"></script>

</html>