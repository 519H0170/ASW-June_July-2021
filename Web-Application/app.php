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

<?php
include "0-sessionstart.php";
//DEMO
if ($_GET) {
    $aid = $_GET["aid"];
} else if ($_POST) {
    $aid = $_POST["aid"];
} else {
    echo "Không thể truy cập vào trang này";
    exit();
}
$query = "SELECT * from `app` where appid = '$aid' and `status`='Published' ";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
if ($rows == 1) {
    $app = mysqli_fetch_assoc($result);
} else {
    echo "Không tìm thấy app nào có app id này";
    exit();
}
$error = "";
if (isset($_SESSION['user'])) {
    $query = "SELECT billid from `bill` where `user`='$user' and `appid`='$aid'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $error = "HaveBuy";
    } else {
    }
} else {
}

$query = "SELECT avg(`rate`) as `avg` from `rate_comment` where `appid`='$aid'";
$result = mysqli_query($conn, $query);
$avg = "0";
$res = mysqli_fetch_assoc($result);
// print_r($res);
if ($res['avg'] == "") {
    $avg = 0;
} else {
    $avg = $res['avg'];
}
$hcom = 2;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $query = "SELECT * from `rate_comment` where `appid`='$aid' and `user` = '$user'";
    $result = mysqli_query($conn, $query);
    $hcom = 0;
    if (mysqli_num_rows($result) == 1) {
        if ($_POST) {
            $comment = $_POST['comment'];
            $rpoint  = $_POST['rpoint'];
            if ($rpoint < 0) {
                $rpoint = 0;
            } else if ($rpoint > 5) {
                $rpoint = 5;
            } else {
            }
            if (strlen($comment) == 0) {
                $comment = "Không có bình luận";
            } else {
            }
            $query = "UPDATE `rate_comment` set rate = $rpoint,comment = '$comment', ratetime = NOW() where `appid`='$aid' and `user` = '$user'";
            $result = mysqli_query($conn, $query);
            $hcom = 1;
        }
    } else {
        if ($_POST) {
            $comment = $_POST['comment'];
            $rpoint  = $_POST['rpoint'];
            if ($rpoint < 0) {
                $rpoint = 0;
            } else if ($rpoint > 5) {
                $rpoint = 5;
            } else {
            }
            if (strlen($comment) == 0) {
                $comment = "Không có bình luận";
            } else {
            }
            $query = "INSERT into `rate_comment`value('$user','$aid','$rpoint','$comment',DEFAULT)";
            $result = mysqli_query($conn, $query);
            $hcom = 1;
        }
    }
}
?>



<body id="appPage">
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

    <?php
    $aname = $app['appname'];
    $dev = $app['devname'];
    $count = $app['dl_count'];
    $price = $app['price'];
    $cate = $app['category'];
    $short_d = $app['short_d'];
    $long_d = $app['long_d'];
    //READ ICON
    $dir = $app['icon'];
    $icon = glob($dir . "/*.{jpg,img,jpeg,png}", GLOB_BRACE);
    foreach ($icon as $i) {
        $i = $i;
    }
    //READ ICON
    $dir = $app['picture'];
    $pic = glob($dir . "/*.{jpg,img,jpeg,png}", GLOB_BRACE);

    ?>
    <!----------------Body : Start------------------>
    <div class="d-flex justify-content-center align-items-center"><a href="./" class="btn btn-primary text-left my-2 p-2">Về trang chủ</a></div>
    <div class="bg-light mx-auto mb-5 pb-5" id="appBody">
        <div class="text-dark w-100" id="aAll">
            <div class="p-3" id="aHead">
                <div id="apoint"></div>
                <form action="Bill.php" method="get">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="<?= $i ?>" id="aicon">'
                        <input type="hidden" name="aid" value="<?= $aid ?>" id="aid">
                    </div>
                    <h4 class="d-flex align-items-center justify-content-center mt-2 text-dark font-weight-bold">
                        <?= $aname ?>
                    </h4>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <button class="btn btn-success" id="abuy">
                            <?php if (strlen($error) == 0) {
                                if ($price == 0) {
                                    echo "Free to buy";
                                } else {
                                    echo "$price VNĐ";
                                }
                            } else {
                                echo "Mua lại";
                            }
                            ?>
                        </button>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <div class="fa fa-user" id="psrate"> <?= $count ?> download(s) time</div><br>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-2"> <?php
                                                                                        $query = "SELECT COUNT(user) as `countrate` from rate_comment where appid = '$aid'";
                                                                                        $result = mysqli_query($conn, $query);
                                                                                        $res = mysqli_fetch_assoc($result);
                                                                                        echo $res['countrate'];
                                                                                        // foreach($res as $row){
                                                                                        //     $row = $res[0];
                                                                                        // }
                                                                                        // echo $row;
                                                                                        ?> rate(s)</div>
                    <!-- Star -->
                    <!-- <div class="arate" id="arate"></div> -->
                </form>
            </div>
            <div id="appDescript">
                <div class="w-100 text-dark" id="appdemopic">
                    <div class=" p-2 w-100 text-dark bg-light font-weight-bold" id="amota"> Ảnh mô tả </div>
                    <div class="px-2 py-1 slider">
                        <?php
                        $picif = 0;
                        if (isset($pic)) {
                            foreach ($pic as $pic) {
                                echo "<div class='px-2 py-1 py-0 mr-2'><img src='$pic'></div>";
                                $picif = 1;
                            }
                        }
                        if ($picif == 0) {
                            echo "<div class='m-auto font-weight-bold'>Chưa có ảnh mô tả</div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="py-3 px-1 bg-light w-100 text-dark" id="appanothers">
                    <div class="pb-2 px-2 text-left"><span class="font-weight-bold">Ngắn gọn:</span> <br><?= $short_d ?></div>
                    <div class="p-1 bg-light w-100 collapsed border font-weight-bold" role="button" data-toggle="collapse" data-target="#adel">
                        Mô tả rõ
                        <div class="float-right">Xem thêm <span class="fa fa-caret-down"></span></div>
                    </div>
                    <div class="p-2 collapse bg-light text-left border" id="adel">
                        <?= $long_d ?>
                    </div>
                    <div class="p-1 bg-light w-100 collapsed border font-weight-bold" role="button" data-toggle="collapse" data-target="#npt">
                        Nhà phát triển
                        <i class="fa fa-caret-down float-right"></i>
                    </div>
                    <div class="p-2 collapse bg-light text-center border" id="npt">
                        <div>
                            <?php
                            $devapp = "SELECT icon,appid,appname FROM app where devname='$dev' ORDER BY dl_count";
                            // echo $cateapp;
                            // echo '<br>';
                            // $vnCate = vn_to_str($theloai[0]); // ra thể loại -> chuyển về không dấu
                            // echo $vnCate;
                            // echo '<br>';
                            $devres = mysqli_query($conn, $devapp);
                            $devapp = mysqli_fetch_all($devres);
                            if (mysqli_num_rows($devres) > 0) {
                                echo '<div class="text-light mb-2" id="indexcate">';
                                echo ' <div class="bg-success font-weight-bold p-2">
                                        <div class="text-left"> App cùng npt: ' . $dev . '';
                                echo ' </div>
                                        </div>';
                                echo ' <div class="px-1 py-1 slider" id="cateslider">';

                                foreach ($devapp as $app) {
                                    $dir = $app[0];
                                    $icon = glob($dir . "/*.{jpg,img,jpeg,png}", GLOB_BRACE);
                                    foreach ($icon as $icon) {
                                        $icon = $icon;
                                    }
                                    echo '<a href="app.php?aid=' . $app[1] . ' " class="text-decoration-none ml-3" id="linkapps">';
                                    echo '<div id="indexapp" class="p-2">';
                                    echo ' <div class="d-flex align-items-center justify-content-center" id="indexicon"><img src="' . $icon . '"></div>';
                                    echo ' <div id="tenapp" class="d-flex align-items-center justify-content-center text-dark text-center">' . $app[2] . '</div>';
                                    echo "</div>";
                                    echo "</a>";
                                }
                                // <div class="d-flex align-items-center justify-content-center"><img src="' . $icon . '" id="aaicon"></div>
                                // <div id="tenapp" class="d-flex align-items-center justify-content-center text-dark text-center">' . $row['appname'] . '</div>
                                // <div id="aarate" class="d-flex align-items-center justify-content-center">' . $row['dl_count'] . ' use(s)</div>
                                echo ' </div>';

                                echo '</div>';
                            } else {
                            }
                            ?>
                        </div>
                    </div>
                    <div class="p-1 bg-light w-100 collapsed border font-weight-bold" role="button" data-toggle="collapse" data-target="#appca">
                        Thể loại
                        <i class="fa fa-caret-down float-right"></i>
                    </div>
                    <div class="p-2 collapse bg-light text-center border" id="appca">
                        <div>
                            <?php
                            $cateapp = "SELECT icon,appid,appname FROM app where category='$cate' ORDER BY dl_count";
                            // echo $cateapp;
                            // echo '<br>';
                            // $vnCate = vn_to_str($theloai[0]); // ra thể loại -> chuyển về không dấu
                            // echo $vnCate;
                            // echo '<br>';
                            $appres = mysqli_query($conn, $cateapp);
                            $cateapp = mysqli_fetch_all($appres);
                            if (mysqli_num_rows($appres) > 0) {
                                echo '<div class="text-light mb-2" id="indexcate">';
                                echo ' <div class="bg-info font-weight-bold p-2">
                                        <div class="text-left"> App cùng thể loại:' . $cate . '';

                                if (mysqli_num_rows($appres) == 5) {
                                    // echo '<div class="float-right"><a href="cateapp.php?cate=' . $vnCate . '" class="text-decoration-none">Xem thêm</span></a></div>';
                                }
                                echo ' </div>
                                        </div>';
                                echo ' <div class="px-1 py-1 slider" id="cateslider">';

                                foreach ($cateapp as $app) {
                                    $dir = $app[0];
                                    $icon = glob($dir . "/*.{jpg,img,jpeg,png}", GLOB_BRACE);
                                    foreach ($icon as $icon) {
                                        $icon = $icon;
                                    }
                                    echo '<a href="app.php?aid=' . $app[1] . ' " class="text-decoration-none ml-3" id="linkapps">';
                                    echo '<div id="indexapp" class="p-2">';
                                    echo ' <div class="d-flex align-items-center justify-content-center" id="indexicon"><img src="' . $icon . '"></div>';
                                    echo ' <div id="tenapp" class="d-flex align-items-center justify-content-center text-dark text-center">' . $app[2] . '</div>';
                                    echo "</div>";
                                    echo "</a>";
                                }
                                // <div class="d-flex align-items-center justify-content-center"><img src="' . $icon . '" id="aaicon"></div>
                                // <div id="tenapp" class="d-flex align-items-center justify-content-center text-dark text-center">' . $row['appname'] . '</div>
                                // <div id="aarate" class="d-flex align-items-center justify-content-center">' . $row['dl_count'] . ' use(s)</div>
                                echo ' </div>';

                                echo '</div>';
                            } else {
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 bg-light font-weight-bold" id="nhanxet">
                <div class="p-1 bg-light w-100 text-dark">
                    <?php if ($hcom == 0) { ?>
                        <?php if ($error == "HaveBuy") { ?>
                            <form action="app.php?aid=<?= $aid ?>" method="post">
                                <div class="d-flex align-items-center justify-content-center"> Đánh giá </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <input class="text-center" type="number" max="5" min="0" name="rpoint" id="rpoint" value="5" require>
                                    <input class="text-center" type="hidden" name="aid" value="<?= $aid ?>">
                                </div>

                                <div class="form-group">
                                    <label for="comment"></label>
                                    <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <button class="btn btn-primary" type="submit">Gửi nhận xét</button>
                                </div>
                            </form>
                        <?php } else {
                            echo "<div class='d-flex align-items-center justify-content-center'> Hãy mua sản phẩm để được phép bình luận </div>";
                        } ?>
                    <?php } else if ($hcom == 1) { ?>

                        <form action="app.php?aid=<?= $aid ?>" method="post">
                            <div class="d-flex align-items-center justify-content-center"> Đánh giá </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <input class="text-center" type="number" max="5" min="0" name="rpoint" id="rpoint" value="5" require>
                                <input class="text-center" type="hidden" name="aid" value="<?= $aid ?>">
                            </div>

                            <div class="form-group">
                                <label for="comment"></label>
                                <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <button class="btn btn-primary" type="submit">Đánh giá mới</button>
                            </div>
                        </form>


                    <?php } else {
                        echo "<div class='d-flex align-items-center justify-content-center'> Hãy đăng nhập trước để có thể bình luận </div>";
                    } ?>
                </div>

                <div id="oldcomment" class="text-dark d-flex align-items-center justify-content-center bg-light mt-2">
                    Những bình luận trước
                </div>
                <div id="loadcomment">

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
    <script src="main.js"></script>
</body>

<!----------------FadeOut---------------->

</html>