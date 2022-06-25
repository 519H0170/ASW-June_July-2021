<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận tài khoản</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<?php
include "0-sendmail.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} else {
}
// connect.php
$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "simulatestore";      // Khai báo database
$conn = mysqli_connect($server, $username, $password, $dbname);
// Check connection
if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
}

if ($_GET) {
    $user = $_GET['email'];
    $token = $_GET['token'];
    $query = "SELECT * from account where user='$user'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_num_rows($result);
    if ($row == 1) {
        $res = mysqli_fetch_assoc($result);
        $res = $res['Activate'];
        if ($res == 'active') {
            echo '<div class="container py-5 px-2 my-5 bg-dark text-light">';
            echo '<h2 align="center">Tài khoản đã đc xác minh từ trước</h2>';
            echo '<div align="center" class="mt-2"><a class="btn btn-primary" href="login.php">Về đăng nhập</a></div></div>';
            exit();
        } else {
            $query = "SELECT * From regaccount where username='$user' and token = '$token'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {

                activeAccount($user, $token);
                header("Location: reg_success.php");
            } else {
                echo "Sai token";
                exit();
            }
        }
    } else {
        echo "Tài khoản không tồn tại.";
        exit();
    }
} else {
    if (isset($_SESSION['reguser'])) {
        session_unset();
        session_destroy();
    } else if (isset($_SESSION['user'])) {
        echo '<div class="container py-5 px-2 my-5 bg-dark text-light">';
        echo '<h2 align="center">Tài khoản không khả dụng</h2>';
        echo '<div align="center" class="mt-2"><a class="btn btn-primary" href="https://www.google.com/intl/vi/gmail/about/#"> để xác nhận</a></div></div>';
        exit();
    } else {
        echo "Không thể truy cập vào trang này";
        exit();
    }
}

?>

<body>
    <div class="container py-5 px-2 my-5 bg-dark text-light">
        <h2 align="center">Link to activate have send to your email</h2>
        <h3 align="center"><a class="btn btn-primary" href="https://www.google.com/intl/vi/gmail/about/#"> để xác nhận</a></h3>
    </div>
</body>

</html>