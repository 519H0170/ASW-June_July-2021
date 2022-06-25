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
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<?php
include "0-xulidangnhap.php";
?>

<body id="login-backg">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark m-0 rounded-0">
        <a href="./" class="navbar-brand mx-auto d-block text-center  w-25" id="Store">NH-Store</a>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9 col-lg-6 bg-primary rounded shadow mt-5" id="col-2">
                <h2 id="login-header">Đăng nhập</h2>
                <form action="login.php" method="post" class="rounded shadow mb-5 mt-2 mx-auto" id="form-login-body">
                    <div class="form-group w-75 mx-auto">
                        <label for="user" class="text-primary mt-2 font-weight-bold">Username</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" name="user" id="user" class="form-control" value="<?= $user ?>" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group w-75 mx-auto">
                        <label for="pass" class="text-primary mt-2 font-weight-bold">Password</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input name="pass" id="pass" type="password" class="form-control" value="<?= $pass ?>" placeholder="Password" required>
                            <span class="input-group-addon">
                                <i class="fa fa-eye-slash ml-auto" aria-hidden="true" role="button" id="vpass"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group w-75 mx-auto custom-control custom-checkbox">
                        <input name="remember" type="checkbox" class="custom-control-input" id="remember">
                        <label class="text-body custom-control-label" for="remember">Remember Me</label>
                    </div>
                    <div class="form-group w-75 mx-auto">
                        <?php echo $error ?>
                        <button class="btn btn-success px-5" type="submit">Login</button>
                    </div>
                    <div class="form-group w-75 mx-auto pb-3 text-dark">
                        <div>Don't have account? </div><a class="ml-2" href="register.php">Register now</a>.
                        <div>Forgot your password? </div><a class="ml-2" href="passwordforgot.php">Reset your password</a>.
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!----------------CopyRight: Start------------------>
    <footer class="bg-dark mt-5 text-center text-white fixed-bottom">
        <div class="p-4">2021 ABC CORP</div>
    </footer>
    <!----------------CopyRight: End------------------>
    <script src="main.js"></script>
</body>

</html>