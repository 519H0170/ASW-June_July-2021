<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

    <title>Upgrade Dev</title>
</head>

<?php
include "0-sessionstart.php";
$error = $thongbao = $tb = "";
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    if (isset($_SESSION['admin']) || isset($_SESSION['dev'])) {
        $tb = 0;
        $thongbao = "Tài khoản của bạn đã được nâng cấp từ trước.";
    } else {
        if ($_POST) {
            $dname = $_POST['devname'];
            $dinfo = $_POST['devinfo'];
            $dphone = $_POST['devphone'];

            $query = "SELECT balance from account where user='$user'";
            $result = mysqli_query($conn, $query);
            $result = mysqli_fetch_all($result);
            $bal = 0;
            foreach ($result as $bal) {
                $bal =  $bal[0];
            }
            if ($bal >= 500000) {
                $query = "SELECT * from dev where devname='$dname'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) == 0) {
                    $sql = "INSERT INTO dev VALUES ('$dname','$dinfo','$dphone','$user')";
                    $result = mysqli_query($conn, $sql);
                    $sql = "UPDATE account SET level = 'Developer', balance=balance-500000 where user = '$user'";
                    $result = mysqli_query($conn, $sql);
                    header("Location: upgrade_success.php");
                } else {
                    $error = "Tên nhà sản xuất bị trùng với người khác.";
                }
            } else {
                $error = "Bạn không có đủ tiền để nâng cấp.";
            }
        } else {
            $query = "SELECT balance from account where user='$user'";
            $result = mysqli_query($conn, $query);
            $result = mysqli_fetch_all($result);
            $bal = 0;
            foreach ($result as $bal) {
                $bal =  $bal[0];
            }
            if ($bal >= 500000) {
            } else {
                $error = "Bạn không có đủ tiền để nâng cấp.";
            }
        }
    }
} else {
    $tb = 1;
    $thongbao = "Vui lòng đăng nhập trước khi muốn sử dụng dịch vụ này";
}

if (strlen($error) > 0) {
    $error = "<div class='alert alert-danger'>$error</div>";
}
if (strlen($thongbao) > 0) {
    $thongbao = "<div class='alert alert-danger'>$thongbao</div>";
}
?>
<!-- id="upgrade-body" -->

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark m-0 rounded-0">
        <a href="./" class="navbar-brand mx-auto d-block text-center  w-25" id="Store">NH-Store</a>
    </nav>
    <?php
    if ($thongbao != "") {
        echo "<div class='p-5 bg-success text-center mt-2'>";
        echo $thongbao;
        if ($tb == 0) {
            echo '<a class="btn btn-primary" href="./">Về trang chủ</a>';
        } else {
            echo '<a class="btn btn-primary" href="login.php">Đăng nhập</a>';
        }
        echo '</div>';
        exit();
    }
    ?>
    <div class="container mb-5">

        <div class="row justify-content-center">

            <div class="col-md-8 rounded border shadow" id="upgrade-form-table-1">
                <h3 class="text-center py-3">Đăng ký Developer</h3>
                <form method="POST" action="upgrade.php" class="mb-5 mt-2 mx-auto">
                    <div class="form-row">
                        <div class="form-group col-lg-12 mx-auto px-4">
                            <label for="devname" class="text-primary mt-2 font-weight-bold">Developer Name</label>
                            <input type="text" name="devname" id="devname" class="form-control" placeholder="Developer Name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12 mx-auto px-4">
                            <label for="devinfo" class="text-primary mt-2 font-weight-bold">Dev's Information</label>
                            <input type="text" name="devinfo" id="devinfo" class="form-control" placeholder="Your Description" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12 mx-auto px-4">
                            <label for="devphone" class="text-primary mt-2 font-weight-bold">Phone Contact</label>
                            <input type="text" name="devphone" id="devphone" class="form-control" placeholder="Phone number" required>
                        </div>
                    </div>
                    <!-- <div class="form-row px-4">
                        <p class="text-primary mt-2 font-weight-bold">Chụp ảnh chứng minh</p>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="upg_1st_id" required>
                            <label class="custom-file-label" for="customFile">Chụp ảnh chứng minh ở mặt trước</label>
                        </div>
                        <div class="custom-file mt-3">
                            <input type="file" class="custom-file-input" id="customFile" name="upg_2nd_id" required>
                            <label class="custom-file-label" for="customFile">Chụp ảnh chứng minh ở mặt sau</label>
                        </div>
                    </div> -->
                    <div class="form-row mt-4 px-4">
                        <div class="col-lg-12 mx-auto px-3 border rounded shadow border-success">
                            <p class="font-weight-bold pt-2">Gói Developer <span class="text-danger font-weight-bold float-right">500.000đ</span></p>
                            <p class="">Dành cho 1 User</p>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="form-group col-lg-12 mx-auto px-4">
                            <?= $error ?>
                            <button class="btn btn-outline-success px-5" type="submit">Submit</button>
                            <a href="Napthe.php" class="btn btn-warning px-5">Nạp tiền</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-dark mt-5 text-center fixed-bottom">
        <p class="text-white py-3">2021 ABC CORP</p>
    </footer>

    <script src="main.js"></script>
</body>

</html>