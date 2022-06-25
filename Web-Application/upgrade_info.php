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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <title>Developer Upgrade</title>
</head>
<?php
include "0-sessionstart.php";
$error = $tb = "";
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    if (isset($_SESSION['admin']) || isset($_SESSION['dev'])) {
        $tb = 0;
        $error = "Tài khoản đã nâng cấp trước";
    } else {
    }
} else {
    $tb = 0;
    $error = "Vui lòng đăng nhập trước khi muốn sử dụng dịch vụ này";
}

?>

<body id="upgrade_info-body">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark m-0 rounded-0">
        <a href="./" class="navbar-brand mx-auto d-block text-center  w-25" id="Store">NH-Store</a>
    </nav>
    <div class="container">
        <div class="row d-flex flex-wrap align-items-center" id="row-1-upgrade">
            <div class="col-sm-6 mt-sm-5" id="row-picture-upgarde">
                <img src="web_pic/dev_icon.png" alt="" id="icon-upgrade-1">
            </div>
            <div class="col-sm-6 col-12 mt-5">
                <h3>TIỆN LỢI HƠN, ĐƠN GIẢN HƠN</h3>
                <p>Nâng cấp trở thành Developer ngay hôm nay</p>
                <div class="card shadow border">
                    <div class="card-body">
                        <p class="card-title text-center mt-md-1 pt-md-2" id="card-title-1">GÓI DEVELOPER</p>
                        <div class="card-text">
                            <p id="price-tag-upgrade" class="text-center">500.000đ</p>
                            <p>Đăng ký trở thành Developer để hưởng được các ưu đãi sau:</p>
                            <ul id="ul-upgrade-1" class="font-weight-bold">
                                <li>Đăng ứng dụng trên chợ ứng dụng</li>
                                <li>Xem danh sách các đơn hàng của ứng dụng mình</li>
                                <li>Quản lý danh sách ứng dụng</li>
                                <li>Phí hoa hồng thấp</li>
                                <li>Lợi nhuận cao</li>
                                <li>Ưu tiên các thành viên đăng nhập mới</li>
                            </ul>
                            <div class="text-center">
                                <?php
                                if ($tb != "") {
                                    echo "$error";
                                } else {
                                    echo '<a href="upgrade.php" id="link-to-upgrade-1" class="btn btn-outline-danger font-weight-bold">ĐĂNG KÝ NGAY</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark mt-5 text-center fixed-bottom">
        <p class="text-white py-3">2021 ABC CORP</p>
    </footer>


    <script src="main.js"></script>
</body>

</html>