<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log out</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<?php
session_start();
//xoa het moi thu trong session
// if (!isset($_SESSION['user'])) {
//     header("Location: login.php");
// }
session_unset();
session_destroy();
?>

<body id="logout">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark m-0 rounded-0">
        <a href="./" class="navbar-brand mx-auto d-block text-center  w-25" id="Store">NH-Store</a>
    </nav>
    <div class="container p-5">
        <div class="row ">
            <div class="col-10 col-md-6 mt-5 mx-auto p-2 border border-dark rounded-top bg-light">
                <h4 class="d-flex align-items-center justify-content-center">Đăng xuất thành công</h4>
                <p class="d-flex align-items-center justify-content-center">Tài khoản của bạn đã được đăng xuất</p>
            </div>
        </div>
        <div class="row ">
            <div class="col-10 col-md-6 mx-auto p-3 border border-top-0 border-dark rounded-bottom bg-light">
                <a href="login.php" class="d-flex align-items-center justify-content-center">Nhấn vào đây</a>
                <div class="d-flex align-items-center justify-content-center">
                    Hoặc
                </div>
                <div class="mb-2 d-flex align-items-center justify-content-center">
                    Tự động về trang chủ sau
                </div>
                <div class="rounded-circle m-auto border border-2 border-dark" id="counter">10</div>
                <a href="login.php" role="button" class="btn btn-success mt-2 d-flex align-items-center justify-content-center">Về trang đăng nhập</a>
            </div>
        </div>
    </div>
    <footer class="bg-dark mt-5 text-center text-white fixed-bottom">
        <div class="p-4">2021 ABC CORP</div>
    </footer>
</body>
<script src="main.js"></script>

</html>