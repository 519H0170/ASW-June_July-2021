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
    <title>Customize Category</title>
</head>
<?php
// require_once('db_ad_category.php');
include "admin_check.php";
?>

<body id="admcate" class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin_portal.php">NH-Store Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="admin_portal.php">Duyệt ứng dụng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_listgc.php">Xem mã thẻ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_gc.php">Tạo mã thẻ</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link disabled" href="#">Quản lý thể loại<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_statistic.php">Thống kê</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mt-lg-0 mt-sm-4">
                <li class="nav-item">
                    <a class="nav-link" href="./"> UserMode </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"> Logout <span class='fa fa-sign-out'> </span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h3 class="mt-3 ">Quản lý thể loại</h3>
        <button class="btn btn-success mt-3" id="ad-cate-load">Load data</button>
        <button class="btn btn-primary mt-3" id="ad-cate-add" data-toggle="modal" data-target="#ad-cate-addModal">Add Category</button>
        <table class="table table-hover border mt-3">
            <thead>
                <tr>
                    <th class="text-center">Thể loại</th>
                    <th class="text-center">Số ứng dụng</th>
                    <th class="text-center">Hành động</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="ad-cate-show">
                <!-- DATA CATEGORY SE HIEN THI TAI DAY -->


            </tbody>
        </table>
    </div>


    <!-- ADD CATE MODAL -->
    <div class="modal fade" id="ad-cate-addModal" role="dialog">
        <div class="modal-dialog">
            <!-- MODAL CONTENTS -->
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Thêm thể loại</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="ad-cate-add-input-m">Nhập thể loại mới</label>
                            <input type="text" class="form-control" id="ad-cate-add-input-m" placeholder="Nhập thể loại mới tại đây" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="ad-cate-add-btn">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- SCRIPT-->
    <script src="main.js" type="text/javascript"></script>
</body>

</html>