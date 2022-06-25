<?php
include "0-sessionstart.php";
$connect = new PDO("mysql:host=localhost;dbname=simulatestore", "root", "");
$paid = "SELECT icon,appid,appname,dl_count,price from app where price > 0 ORDER BY dl_count DESC LIMIT 0,10";
$paidres = mysqli_query($conn, $paid);
$paid = mysqli_fetch_all($paidres);
if (mysqli_num_rows($paidres) > 0) {
    echo '<div class="text-light mb-2" id="indexcate">';
    echo '  <div class="bg-success font-weight-bold p-2">
                <div class="text-left">Top 10 game trả phí</div>';
    echo  ' </div>';
    echo '  <div class="px-1 py-1 slider" id="scateslider">';

    foreach ($paid as $app) {
        $dir = $app[0];
        $icon = glob($dir . "/*.{jpg,img,jpeg,png}", GLOB_BRACE);
        foreach ($icon as $icon) {
            $icon = $icon;
        }
        echo '<a href="app.php?aid=' . $app[1] . ' " class="text-decoration-none ml-3 bg-dark" id="linkapp">';
        echo '<div id="indexapp" class="p-2">';
        echo '  <div class="d-flex align-items-center justify-content-center" id="indexicon"><img src="' . $icon . '"width=150 height=150></div>';
        echo '  <div id="tenapp" class="d-flex align-items-center justify-content-center text-light text-center">' . $app[2] . '</div>';
        echo '  <div id="tenapp" class="d-flex align-items-center justify-content-center text-light text-center"><span class="fa fa-user" id="psrate"> ' . $app[3] . ' </span></div>';
        echo '  <div class="d-flex align-items-center justify-content-center text-light text-center">~' . round($app[4] / 23000, 1) . ' $ </div>';
        echo "</div>";
        echo "</a>";
    }
    // <div class="d-flex align-items-center justify-content-center"><img src="' . $icon . '" id="aaicon"></div>
    // <div id="tenapp" class="d-flex align-items-center justify-content-center text-dark text-center">' . $row['appname'] . '</div>
    // <div id="aarate" class="d-flex align-items-center justify-content-center">' . $row['dl_count'] . ' use(s)</div>
    echo '  </div>';

    echo '</div>';
} else {
}

///Freee
$free = "SELECT icon,appid,appname,dl_count from app where price = 0 ORDER BY dl_count DESC LIMIT 0,10";
$freeres = mysqli_query($conn, $free);
$free = mysqli_fetch_all($freeres);
if (mysqli_num_rows($freeres) > 0) {
    echo '<div class="text-light mb-2" id="indexcate">';
    echo '  <div class="bg-info font-weight-bold p-2">
                <div class="text-left">Top 10 game free</div>';
    echo  ' </div>';
    echo '  <div class="px-1 py-1 slider" id="scateslider">';

    foreach ($free as $app) {
        $dir = $app[0];
        $icon = glob($dir . "/*.{jpg,img,jpeg,png}", GLOB_BRACE);
        foreach ($icon as $icon) {
            $icon = $icon;
        }
        echo '<a href="app.php?aid=' . $app[1] . ' " class="text-decoration-none ml-3 bg-dark" id="linkapp">';
        echo '<div id="indexapp" class="p-2">';
        echo '  <div class="d-flex align-items-center justify-content-center" id="indexicon"><img src="' . $icon . '"width=150 height=150></div>';
        echo '  <div id="tenapp" class="d-flex align-items-center justify-content-center text-light text-center">' . $app[2] . '</div>';
        echo '  <div id="tenapp" class="d-flex align-items-center justify-content-center text-light text-center"><span class="fa fa-user" id="psrate"> ' . $app[3] . ' </span></div>';
        echo "</div>";
        echo "</a>";
    }
    // <div class="d-flex align-items-center justify-content-center"><img src="' . $icon . '" id="aaicon"></div>
    // <div id="tenapp" class="d-flex align-items-center justify-content-center text-dark text-center">' . $row['appname'] . '</div>
    // <div id="aarate" class="d-flex align-items-center justify-content-center">' . $row['dl_count'] . ' use(s)</div>
    echo '  </div>';

    echo '</div>';
} else {
}


//HAVE CATE
$cate = "SELECT category from category";
$catestm = $connect->prepare($cate);
$catestm->execute();
$cate = $catestm->fetchAll();
foreach ($cate as $theloai) {
    $cateapp = "SELECT icon,appid,appname FROM app where category='$theloai[0]' ORDER BY dl_count DESC LIMIT 0,5";
    // echo $cateapp;
    // echo '<br>';
    $vnCate =  vn_to_str($theloai[0]); // ra thể loại -> chuyển về không dấu
    // echo $vnCate;
    // echo '<br>';
    $appres = mysqli_query($conn, $cateapp);
    $cateapp = mysqli_fetch_all($appres);
    if (mysqli_num_rows($appres) > 0) {
        echo '<div class="text-dark mb-2" id="indexcate">';
        echo '  <div class="bg-warning font-weight-bold p-2">
                    <div class="text-left"> ' . $theloai[0] . '';
        echo   '<div class="float-right"><span>Top 5</span></div>';

        if (mysqli_num_rows($appres) == 5) {
            // echo   '<div class="float-right"><a href="cateapp.php?cate=' . $vnCate . '" class="text-decoration-none">Xem thêm</span></a></div>';
        }
        echo  ' </div>
                </div>';
        echo '  <div class="px-1 py-1 slider" id="cateslider">';

        foreach ($cateapp as $app) {
            $dir = $app[0];
            $icon = glob($dir . "/*.{jpg,img,jpeg,png}", GLOB_BRACE);
            foreach ($icon as $icon) {
                $icon = $icon;
            }
            echo '<a href="app.php?aid=' . $app[1] . ' " class="text-decoration-none ml-3" id="linkapp">';
            echo '<div id="indexapp" class="p-2">';
            echo '  <div class="d-flex align-items-center justify-content-center" id="indexicon"><img src="' . $icon . '"></div>';
            echo '  <div id="tenapp" class="d-flex align-items-center justify-content-center text-dark text-center">' . $app[2] . '</div>';
            echo "</div>";
            echo "</a>";
        }
        // <div class="d-flex align-items-center justify-content-center"><img src="' . $icon . '" id="aaicon"></div>
        // <div id="tenapp" class="d-flex align-items-center justify-content-center text-dark text-center">' . $row['appname'] . '</div>
        // <div id="aarate" class="d-flex align-items-center justify-content-center">' . $row['dl_count'] . ' use(s)</div>
        echo '  </div>';

        echo '</div>';
    } else {
    }
}

// <div class="container text-dark" id="itemlist">
//                     <div class="container" id="itemlisthead">
//                         <div class="text-left">Top 10</div>
//                     </div>
//                     <div class="container" id="itemDiv">
//                         <div class="slider">
//                             <a href="#" id="item">
//                                 <div id="iteminfo">
//                                     <img src="Logo.jpg">
//                                     <div id="appInd">
//                                         <div id="aName">
//                                             NameQuaTroiDaiLuonNek
//                                         </div>
//                                         <div id="aRate">
//                                             <span class="fa fa-star checked"></span>
//                                             <span class="fa fa-star checked"></span>
//                                             <span class="fa fa-star checked"></span>
//                                             <span class="fa fa-star checked"></span>
//                                             <span class="fa fa-star-half checked"></span>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </a>








function vn_to_str($str)
{
    $unicode = array(

        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

        'd' => 'đ',

        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

        'i' => 'í|ì|ỉ|ĩ|ị',

        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

        'D' => 'Đ',

        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',

        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

    );

    foreach ($unicode as $nonUnicode => $uni) {

        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $str = str_replace(' ', '-', $str);

    return $str;
}
?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

</body>

</html>