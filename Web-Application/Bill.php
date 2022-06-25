<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>

<?php
include "0-sessionstart.php";
//DEMO
$aid = "";
//Variable SET
$error = "";
$aname = $price = "";
if ($_GET and strlen($_GET['aid']) > 0) {
    $aid = $_GET["aid"];
    $url = $_SERVER['PHP_SELF'];
    $url = "$url?aid=$aid";
    //Check appid
    $query = "SELECT * from `app` where appid = '$aid' and `status`='Published' ";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $app = mysqli_fetch_assoc($result);
        $aname = $app['appname'];
        $price = $app['price'];
        if (!isset($_SESSION['user'])) {
            $_SESSION['url'] = $url;
            // header("Location: login.php");
        } else {
            $user = $_SESSION['user'];
            $query = "SELECT billid from `bill` where `user`='$user' and `appid`='$aid'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 1) {
                $error = "HaveBuy";
                $aname = $price = "";
            }
        }
    } else {
        $error = "App không tồn tại hoặc chưa được published";
    }
} else {
    header("Location: ./");
}
?>

<body>
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
                    $query = "SELECT * FROM account WHERE user = '$user'";
                    $result = mysqli_query($conn, $query);
                    $rows = mysqli_num_rows($result);
                    if ($rows == 1) {
                        $result = mysqli_fetch_assoc($result);
                        $level = $result['level'];
                        if ($level == 'Administrator') {
                            $_SESSION['admin'] = "1";
                            echo "<li class='nav-item' id='devp'><a class='nav-link' href='admin_portal.php'> AdminPortal </a></li>";
                        } else if ($level == 'Developer') {
                            $_SESSION['dev'] = "1";
                            echo "<li class='nav-item' id='devp'><a class='nav-link' href='dev_portal.php'> DevPortal </a></li>";
                        } else {
                            echo "<li class='nav-item' id='devp'><a class='nav-link' href='upgrade_info.php'> Upgrade </a></li>";
                        }
                        echo "<li class='nav-item' id='accp'><a class='nav-link' href='Hoso.php'> Account </a></li>";
                        echo "<li class='nav-item' id='outp'><a class='nav-link' href='logout.php'> Sign out <span class='fa fa-sign-out'></span></a></li>";
                    } else {
                        echo "M hack session ah????";
                        session_unset();
                        session_destroy();
                        header("Location: login.php");
                    }
                } else {
                    echo "<li class='nav-item' id='inp'><a class='nav-link' href='login.php' role='button'> Sign In <span class='fa fa-sign-in'></span></a></li>";
                    echo "<li class='nav-item' id='newp'><a class='nav-link' href='register.php' role='button'> Create an account <span class='fa fa-user-plus'></span></a></li>";
                }
                ?>
            </ul>
        </div>
    </nav>
    <!------------------HEADER : END-------------------->
    <!----------------Bill: Start------------------>
    <div class="bg-light my-5 pb-3 pt-1 px-0 mx-auto border border-dark rounded col-10 col-md-6 col-lg-5 text-center">
        <form action="billxuli.php" method="post">
            <div id="billhead" class="border border-dark border-right-0 border-left-0 border-top-0">
                <h4>Your Bill</h4>
            </div>
            <div id="billbody" class="pt-1 pb-0 px-2">
                <?php if (strlen($aname) > 0) { ?>
                    <table class="w-100">
                        <tr>
                            <td>
                                <div class="font-weight-bold">Appname</div>
                                <input type="hidden" name="aid" value="<?= $aid ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><?= $aname ?></td>
                        </tr>
                    </table>
                    <div id="billsub" class="pt-3 by-1 w-100">
                        <button type="submit" class="btn btn-success">
                            Thanh toán
                        </button>
                        <div>Đơn giá: <?= $price ?> VNĐ</div>
                    </div>
                <?php } else {
                }
                if ($error == "HaveBuy") {
                    echo "<div>Bạn đã mua ứng dụng này từ trước</div>";
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
                        //     $filePath = $path . $f;
                        // } else {
                        // }
                    }
                    // echo  $filePath;
                    $uid = uniqid();
                    $_SESSION['download_files'][$uid] = $filePath;
                    // print_r($_SESSION);
                    echo '<a href="download.php?fileId=' . $uid . '" class="btn btn-primary text-light">Download</a>';
                    //Download
                    echo "<div class='mt-2 d-flex align-items-center justify-content-center'><a class='text-center btn btn-success text-decoreation-none' href='app.php?aid=$aid' role='button'>Về trang ứng dụng</a></div>";
                } else {
                    echo $error;
                } ?>
            </div>
        </form>
    </div>
    <!----------------Bill: End------------------>
    <!----------------CopyRight: Start------------------>
    <footer class="bg-dark mt-5 text-center text-white fixed-bottom">
        <div class="py-2">2021 ABC CORP</div>
    </footer>
    <!----------------CopyRight: End------------------>
    <script src="main.js"></script>
</body>

<!----------------FadeOut---------------->

</html>