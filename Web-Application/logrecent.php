<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Have Log</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>
<?php
include "0-sessionstart.php";
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
?>

<body id="logrecent">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark m-0 rounded-0">
        <a href="./" class="navbar-brand mx-auto d-block text-center  w-25" id="Store">NH-Store</a>
    </nav>
    <div class="container p-5">
        <div class="row">
            <div class="col-md-6 mt-5 mx-auto p-3 border border-dark border-2 rounded-top">
                <h4 class="d-flex align-items-center justify-content-center">Đừng nghịch, bạn dùng 1 tài khoản</h4>
                <div class="d-flex align-items-center justify-content-center">Nếu bạn muốn đăng nhập tài khoản khác</div>
                <div class="d-flex align-items-center justify-content-center">Vui lòng đăng xuất trước</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto p-3 border border-dark border-2 border-top-0 rounded-bottom">
                <div class="mt-2 d-flex align-items-center justify-content-center">
                    <a class="text-center btn btn-primary text-decoreation-none" href="logout.php" role="button">Đăng xuất</a>
                </div>
                <div class="mb-2 d-flex align-items-center justify-content-center">
                    Tự động về trang chủ sau
                </div>
                <div class="rounded-circle m-auto" id="counter">10</div>
                <div class="mt-2 d-flex align-items-center justify-content-center">
                    <a class="text-center btn btn-success text-decoreation-none" href="./" role="button">Về trang chủ ngay</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark mt-5 text-center text-white fixed-bottom">
        <div class="p-4">2021 ABC CORP</div>
    </footer>
</body>
<script src="main.js"></script>

</html>