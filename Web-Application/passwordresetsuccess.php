<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
    <title>Reset Password Successfully</title>
</head>

<?php
include "0-sessionstart.php";
if (isset($_SESSION['resetpass'])) {
    session_unset();
} else {
    header("Location: login.php");
}
session_destroy();
?>

<body id="reg_suc-backg">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark m-0 rounded-0" id="navbar">
        <a href="./" class="navbar-brand mx-auto d-block text-center  w-25" id="Store">NH-Store</a>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9 col-lg-6 bg-success rounded shadow mt-5" id="col-2">
                <h3 id="login-header">Đổi mật khẩu thành công</h3>
                <div class="row bg-white mx-3 pt-3 rounded shadow mb-5 mt-2 mx-auto">
                    <div class=" px-3">
                        <p>Bạn đã đổi mật khẩu của mình</p>
                        <p>Nhấn vào <a href="login.php" class="font-weight-bold">Đây</a> để về trang đăng nhập</p>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="bg-dark mt-5 text-center text-white fixed-bottom">
        <div class="p-4">2021 ABC CORP</div>
    </footer>
</body>

</html>