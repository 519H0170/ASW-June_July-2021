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

    <title>App Infomation</title>
</head>
<?php include "0-sessionstart.php"; ?>

<body id="allapp">
    <!------------------HEADER : END-------------------->
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
    <!----------------Body : Start------------------>
    <div class="container border-0" id="Body">
        <div class="w-100 p-0" id="aapart">
            <div class="card" id="appCard">
                <div class="card-header p-1">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link unactive" href="./">Main Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active disabled" href="appall.php">All apps</a>
                        </li>
                    </ul>
                    <div>
                        <?php
                        if (isset($_SESSION['user'])) {
                            $money = $_SESSION['user'];
                            $acc = "SELECT balance,fname,lname FROM Account WHERE user = '$money'";
                            $accask = mysqli_query($conn, $acc);
                            $rows = mysqli_num_rows($accask);
                            $balance = mysqli_fetch_assoc($accask);
                            $fname = $balance['fname'];
                            $lname = $balance['lname'];
                            $balance = $balance['balance'];
                            echo "<div class='text-dark p-0 text-center'>$fname $lname</div>";
                            echo "<div class='text-dark p-0 text-center'>Tài khoản: $balance (VNĐ)</div>";
                        } else {
                        }
                        ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Search...">
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <select name="sortPay" id="sortPay" class="form-control w-25 d-inline mr-1">
                                <option value="" selected>Type Paid</option>
                                <option value="free"> Free</option>
                                <option value="pay">Paid</option>
                            </select>
                            <select name="cate" id="sortCate" class="form-control w-25 d-inline ml-1">
                                <option value="" selected>Thể loại</option>
                                <?php include "catechoose.php"; ?>
                            </select>
                        </div>
                        <div id="appshowing" class="table-responsive"></div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------Body : End-------------------->
        <!----------------CopyRight: Start------------------>
        <footer class="bg-dark mt-5 text-center text-white fixed-bottom">
            <div class="py-2">2021 ABC CORP</div>
        </footer>
        <!----------------CopyRight: End------------------>

</body>
<script src="main.js"></script>

</html>