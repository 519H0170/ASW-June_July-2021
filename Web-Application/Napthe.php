<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp thẻ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<?php
$url = $_SERVER['PHP_SELF'];
include "cosodulieu.php";
include "kiemtrathe.php";
?>

<body id="napthepage">
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

    <!----------------Body : Start------------------>
    <div class="container mt-3 mb-5 bg-dark p-3 pb-3" id="naptheBody">
        <div id="AccountTab">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link unactive bg-light text-dark" href="Hoso.php">Hồ sơ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Napthe.php">Nạp thẻ</a>
                </li>
            </ul>
        </div>

        <div class="mt-2 text-center p-0 w-100">
            <div class="text-center w-100 bg-dark pt-3 pb-3" id="napthe">
                <form action="" method="post" id="form">
                    <table class="w-100 font-weight-bold text-left">
                        <tr>
                            <td class="p-2">Số seri:</td>
                            <td class="p-2">
                                <input class="w-100 border" type="text" value="<?php if ($_POST) {
                                                                                    echo $serial;
                                                                                } ?>" require name="serial">
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2">Mệnh giá:</td>
                            <td class="p-2">
                                <select class="w-100 border" name="menhgia">
                                    <option value="20000" selected>20000</option>
                                    <option value="50000">50000</option>
                                    <option value="100000">100000</option>
                                    <option value="200000">200000</option>
                                    <option value="500000">500000</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <?php if (strlen($thongbao) > 0) {
                        echo "<div class='text-danger p-2 bg-light font-weight-bold'>$thongbao</div>";
                    } else {
                    } ?>
                    <button type="submit" class="btn btn-success p-2 mt-2 w-50">Nạp thẻ</button>
                </form>

            </div>

            <?php include "lichsu.php"; ?>

        </div>

    </div>
    <!----------------Body : End------------------>
    <!----------------CopyRight: Start------------------>
    <footer class="bg-dark mt-5 text-center text-white fixed-bottom">
        <div class="py-2">2021 ABC CORP</div>
    </footer>
    <!----------------CopyRight: End------------------>


    <script src="main.js"></script>
</body>

</html>