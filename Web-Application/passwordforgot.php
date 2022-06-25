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
    <title>Quên mật khẩu</title>
</head>


<?php
include "0-sessionstart.php";
include "0-sendmail.php";
$thongbao = "<p>Nhập email chính xác để nhận mã xác thực</p>";
$error = "";
if ($_POST) {
    $thongbao = "";
    $email = $_POST['email'];
    if (strlen($email) > 0) {
        $email = stripslashes($email);
        $email = mysqli_real_escape_string($conn, $email);
        $query = "SELECT * FROM Account WHERE user = '$email'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['respass'] = $email;
            $token = bin2hex(random_bytes(10));
            $query = "SELECT  * FROM `resetpass` WHERE username = '$email'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                $query = "UPDATE `resetpass` set token = '$token', expire = DATE_ADD(NOW(), INTERVAL 10 DAY) where username='$email' ";
                $result = mysqli_query($conn, $query);
            } else {
                $query = "INSERT INTO `resetpass`(`token`, `username`, `expire`) VALUES ('$token','$email',DATE_ADD(NOW(), INTERVAL 10 DAY))";
                $result = mysqli_query($conn, $query);
            }
            sendResetEmail($email,$token);
            header("Location: passwordreset.php");
        } else {
            $error = "Tài khoản không tồn tại, kiểm tra lại email.";
        }
    } else {
        $error = "Nhập email để nhận reset token.";
    }
    if (strlen($error > 0)) {
        $error = "<div class='alert alert-danger'>$error</div>";
    } else {
    }
} else {
}
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark m-0 rounded-0" id="navbar">
        <a href="./" class="navbar-brand mx-auto d-block text-center  w-25" id="Store">NH-Store</a>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9 col-lg-6 bg-info rounded shadow mt-5" id="col-2">
                <h4 id="login-header">Quên mật khẩu</h4>
                <form action="passwordforgot.php" method="post" class="rounded shadow mb-5 mt-2 mx-auto" id="form-login-body">
                    <div class="form-group w-75 mx-auto pt-3">
                        <label for="email" class="text-info mt-2 font-weight-bold">Email</label>
                        <input name="email" id="email" type="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="form-group w-75 mx-auto">
                        <?= $thongbao ?>
                        <?= $error ?>
                        <button class="btn btn-success px-3 px-md-5 mb-4" type="submit">Reset password</button>
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