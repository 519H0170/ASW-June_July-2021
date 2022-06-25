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
    <script src="main.js"></script>
    <title>Reset Password</title>
</head>

<?php
include "0-sessionstart.php";
// print_r($_SESSION);
// print_r($_POST);
$email = "";
if (isset($_SESSION['respass'])) {
    $email = $_SESSION['respass'];
    echo '<div class="container py-5 px-2 my-5 bg-dark text-light">';
    echo "<div align='center' class='mt-2'>Xin chào $email</div>";
    echo "<div align='center' class='mt-2'>Mời nhấn địa chỉ liên kết trong mail để đổi mật khẩu</div>";
    echo '<div align="center" class="mt-2"><a class="btn btn-primary" href="https://www.google.com/intl/vi/gmail/about/#">Tới Gmail để xác nhận</a></div></div>';
    unset($_SESSION['respass']);
    exit();
} else {
}
// variables
$error = "";
$email = $token = "";
$pass = $cpass = "";



if ($_POST) {
    $email = $_SESSION['resetpass'];
    if (!isset($_POST['pass'])) {
        $error = "Chưa nhập mật khẩuc";
    } else if (!isset($_POST['cpass'])) {
        $error = "Chưa xác nhận mật khẩu";
    } else {
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        if (strlen($pass) < 6) {
            $error = "Mật khẩu cần có ít nhất 6 kí tự.";
        } else {
            if ($pass != $cpass) {
                $pass = $cpass = "";
                $error = "Mật khẩu và mật khẩu xác nhận phải giống nhau";
            } else {
                $pass = $cpass = md5($pass);
                $query = "UPDATE `account` set `pass` = '$pass' where `user` = '$email' ";
                $result = mysqli_query($conn, $query);
                $toknew = bin2hex(random_bytes(10));
                $query = "UPDATE `resetpass` set token = '$toknew', expire = DATE_ADD(NOW(), INTERVAL 10 DAY) where username='$email' ";
                $result = mysqli_query($conn, $query);

                header("Location: passwordresetsuccess.php");
            }
        }
    }
} else if ($_GET) {
    $md5email = $_GET['email'];
    $token = $_GET['token'];
    $query = "SELECT `token`,`username` From `resetpass` where md5(`username`) = '$md5email' and token='$token' ";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $res = mysqli_fetch_assoc($result);
        $_SESSION['resetpass'] = $res['username'];
    } else {
        session_unset();
        session_destroy();
        echo '<div class="container py-5 px-2 my-5 bg-dark text-light">';
        echo "<div align='center' class='mt-2'>Lỗi</div>";
        echo "<div align='center' class='mt-2'>Tài khoản/token không đúng</div>";
        echo '<div align="center" class="mt-2"><a class="btn btn-primary" href="https://www.google.com/intl/vi/gmail/about/#">Về Gmail để xác nhận</a></div>';
        echo '<div align="center" class="mt-2"><a class="btn btn-primary" href="./">Về trang chủ</a></div></div>';
        exit();
    }
} else {
    session_unset();
    session_destroy();
    echo '<div class="container py-5 px-2 my-5 bg-dark text-dark">';
    echo "<div align='center' class='mt-2'>Lỗi</div>";
    echo "<div align='center' class='mt-2'>Không nhận được địa chỉ email và token</div>";
    echo '<div align="center" class="mt-2"><a class="btn btn-primary" href="https://www.google.com/intl/vi/gmail/about/#">Tới Gmail để xác nhận</a></div>';
    echo '<div align="center" class="mt-2"><a class="btn btn-primary" href="./">Về trang chủ</a></div></div>';
    exit();
}

if (strlen($error) != 0) {
    $error = "<div class='alert alert-danger'>$error</div>";
} else {
}
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark m-0 rounded-0" id="navbar">
        <a href="./" class="navbar-brand mx-auto d-block text-center  w-25" id="Store">NH-Store</a>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9 col-lg-6 bg-info rounded shadow mt-5 mb-5" id="col-2">
                <h4 id="register-header">Khôi phục tài khoản</h4>
                <form action="passwordreset.php" method="post" class="rounded shadow mb-5 mt-2 mx-auto" id="form-login-body">
                    <div class="form-row">
                        <div class="form-group mx-auto col-lg-6 px-4">
                            <label for="pass" class="text-info mt-2 font-weight-bold">Password</label>
                            <input name="pass" id="pass" type="password" class="form-control" placeholder="Password" value="<?= $pass ?>" required>
                        </div>
                        <div class="form-group mx-auto col-lg-6 px-4">
                            <label for="cpass" class="text-info mt-2 font-weight-bold">Confirm Password</label>
                            <input name="cpass" id="cpass" type="password" class="form-control" placeholder="Confirm Password" value="<?= $cpass ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12 mx-auto px-4 d-flex align-items-center justify-content-center">
                            <button class="btn btn-success px-5" type="submit">Reset Password</button>
                        </div>
                        <div class="form-group col-lg-12 m-0 px-4 d-flex align-items-center justify-content-center">
                            <?= $error ?>
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