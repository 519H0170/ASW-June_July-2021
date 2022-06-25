<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử lí bill</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<?php
include "0-sessionstart.php";
//UserBalance
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
if (!$_POST) {
    header("Location: ./");
}
if (!isset($_POST['aid'])) {
    header("Location: ./");
}
$user = $_SESSION['user'];
$aid = $_POST["aid"];
$query = "SELECT price from `app` where appid = '$aid'";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
$result = mysqli_fetch_assoc($result);
$price = $result['price'];

$query = "SELECT balance FROM Account WHERE user = '$user'";
$result = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($result);
$balance = $result['balance'];
//Start
$thongbao = "";
if ($price > $balance) {
    $thongbao = "NOT ENOUGH MONEY";
} else {
    $thongbao = "SUCCESS";
    $query = "SELECT billid from `bill` where `user`='$user' and `appid`='$aid'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $thongbao = "HAVE BUY BEFORE";
    } else {
        $len = 6;
        $rows = 1;
        while ($rows == 1) {
            $billid = substr(md5(rand()), 0, $len);
            $query = "SELECT billid from `bill` where billid='$billid'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
        }
        $query = "INSERT into `bill`(`billid`, `user`, `appid`, `price`) VALUES ('$billid','$user','$aid',$price)";
        $result = mysqli_query($conn, $query);
        $query = "UPDATE `account` set balance = balance-$price where user='$user'";
        $result = mysqli_query($conn, $query);
        $query = "UPDATE `app` set dl_count = dl_count+1 where appid='$aid'";
        $result = mysqli_query($conn, $query);
    }
    // $query = "SELECT file_app from app where app='$aid'";
    // $result = mysqli_query($conn,$query);
    // $result = mysqli_fetch_assoc($result);
    // print_r($result);


    // $dir = $row['fileapp'];
    // $icon = glob($dir . "/*.{zip}", GLOB_BRACE);
    // foreach ($icon as $icon) {
    //     $icon = $icon;
    // }
}
?>

<body id="billxl">
    <!------------------HEADER : START-------------------->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark m-0" id="navbar">
        <a class="navbar-brand" href="./" id="Store">NH-Store</a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ml-auto text-center" id="log-area">
                <?php
                if (isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    $query = "SELECT * FROM Account WHERE user = '$user'";
                    $result = mysqli_query($conn, $query);
                    $rows = mysqli_num_rows($result);
                    if ($rows == 1) {
                        $result = mysqli_fetch_assoc($result);
                        $level = $result['level'];
                        if ($level == 'Administrator') {
                            $_SESSION['admin'] = "1";
                            echo "<li class='nav-item' id='devp'><a class='nav-link' href='admin_portal.php'> AdminPortal </a></li>'";
                        } else if ($level == 'Developer') {
                            $_SESSION['dev'] = "1";
                            echo "<li class='nav-item' id='devp'><a class='nav-link' href='dev_portal.php'> DevPortal </a></li>'";
                        } else {
                        }
                        echo "<li class='nav-item' id='accp'><a class='nav-link' href='Hoso.php'> Account </a></li>'";
                        echo "<li class='nav-item' id='outp'><a class='nav-link' href='logout.php'> Sign out <span class='fa fa-sign-out'></span></a></li>'";
                    } else {
                        echo "M hack session ah????";
                        session_unset();
                        session_destroy();
                        header("Location: login.php");
                    }
                } else {
                    echo "<li class='nav-item' id='inp'><a class='nav-link' href='login.php' role='button'> Sign In <span class='fa fa-sign-in'></span></a></li>'";
                    echo "<li class='nav-item' id='newp'><a class='nav-link' href='register.php' role='button'> Create an account <span class='fa fa-user-plus'></span></a></li>'";
                }
                ?>
            </ul>
        </div>
    </nav>
    <!------------------HEADER : END-------------------->

    <?php if ($thongbao == "SUCCESS" or $thongbao == "HAVE BUY BEFORE") { ?>
        <div class="bg-success text-light my-5 pb-3 px-0 mx-auto border border-dark rounded col-10 col-md-6 col-lg-5 text-center">
            <h4 class="p-2 border-bottom border-light border-2"><?= $thongbao ?></h4>
            <?php
            $query = "SELECT file_app from app where appid='$aid'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            // print_r($row);
            $dir = $row['file_app'];
            $path = __DIR__ . '/' . $dir . '/';
            $files = scandir($path);


            // ID-Filename
            $_SESSION['download_files'] = array();
            foreach ($files as $f) {
                $ext = pathinfo($f, PATHINFO_EXTENSION);
                if ($ext == "zip") {
                    $filePath = $path . $f;
                } else {
                }
                // if ($ext == "jpg") {
                // $filePath = $path . $f;
                // } else {
                // }
            }
            // echo $filePath;
            $uid = uniqid();
            $_SESSION['download_files'][$uid] = $filePath;
            // print_r($_SESSION);
            echo '<a href="download.php?fileId=' . $uid . '" class="btn btn-primary text-light">Download</a>';
            //Download
            echo "<div class='mt-2 d-flex align-items-center justify-content-center'><a class='text-center btn btn-warning text-decoreation-none' href='app.php?aid=$aid' role='button'>Về trang ứng dụng</a></div>";
            ?>
        </div>
    <?php } else { ?>
        <div class="bg-danger text-light my-5 pb-3 px-0 mx-auto border border-dark rounded col-10 col-md-6 col-lg-5 text-center">
            <h4 class="p-2 border-bottom border-light border-2"><?= $thongbao ?></h4>
            <div class="mt-2 d-flex align-items-center justify-content-center">
                Vui lòng nạp thêm tiền vào tài khoản
            </div>
            <div class="mt-2 d-flex align-items-center justify-content-center">
                <a class="text-center btn btn-success text-decoreation-none mx-1" href="Napthe.php" role="button">Nạp tiền</a>
                <a class="text-center btn btn-info text-decoreation-none mx-1" href="./" role="button">Về trang chủ</a>
            </div>
        </div>
    <?php } ?>


    <!----------------CopyRight: Start------------------>
    <footer class="bg-dark mt-5 text-center text-white fixed-bottom">
        <div class="py-2">2021 ABC CORP</div>
    </footer>
    <!----------------CopyRight: End------------------>

</body>
<script src="main.js"></script>

</html>