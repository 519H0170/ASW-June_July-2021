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
    <title>Admin Portal</title>
</head>
<?php
include "admin_check.php";
?>

<body id="admportal" class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin_portal.php">NH-Store Admin</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link disabled" href="#">Duyệt ứng dụng<span class="sr-only">(current)</span></a>
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

    <div class="container">
        <h3 class="mt-3 ">Ứng dụng đang chờ duyệt</h3>
        <button class="btn btn-success mt-3" id="ad-portal-load">Load data</button>
        <a href="admin_portal.php" class="btn btn-primary mt-3">Reset Page</a>
        <table class="table table-hover border mt-3" id="ad-apppending-show">
            <!-- App cần duyệt SE HIEN THI TAI DAY -->
        </table>
    </div>
</body>
<script src="main.js" type="text/javascript"></script>

</html>