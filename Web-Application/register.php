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
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
    <title>Register Account</title>
</head>
<?php
include "0-sessionstart.php";
include "0-sendmail.php";
$error = "";
$fname = $lname = $user = $pass = $cpass = "";
// if (isset($_SESSION['user'])) {
//     header("Location: logrecent.php");
// } else {
// }
if ($_POST) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    if (strlen($fname) > 0 & strlen($lname) > 0 & strlen($user) > 0) {
        $duplicate = 0;
        $find = stripslashes($_REQUEST['user']);
        $find = mysqli_real_escape_string($conn, $find);
        $query = "SELECT * FROM Account WHERE user = '$find'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 0) {
            if (strlen($pass) > 0) {
                if (strlen($cpass) > 0) {
                    if ($pass == $cpass) {
                        $loop = 0;
                        while ($loop == 0) {
                            $loop = 1;
                            $token = bin2hex(random_bytes(10));
                            $query = "SELECT token from regaccount where token ='$token'";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) == 0) {
                            } else {
                                $loop = 0;
                            }
                        }
                        $pass = md5($pass);
                        $query = "INSERT INTO `account`(`user`, `pass`, `fname`, `lname`, `birthday`, `balance`, `propic`, `level`, `Activate`) VALUES ('$user','$pass','$fname','$lname',DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT)";
                        $result = mysqli_query($conn, $query);

                        $query = "INSERT INTO `regaccount`(`token`, `username`, `expire`) VALUES ('$token','$user',DATE_ADD(NOW(), INTERVAL 10 DAY))";
                        $result = mysqli_query($conn, $query);
                        sendActivationEmail($user, $token);
                        $fname = $lname = $pass = $cpass = $user = "";
                        $_SESSION['reguser'] = $user;
                        header("Location: reg_author.php");
                    } else {
                        $error = "Mật khẩu xác nhận không đúng.";
                    }
                } else {
                    $error = "Bạn chưa xác nhận mật khẩu";
                }
            } else {
                $error = "Bạn chưa nhập mật khẩu";
            }
        } else {
            $error = "Tài khoản đã tồn tại";
        }
    } else {
        $error = "Mời nhập đủ thông tin tài khoản";
    }

    if (strlen($error) > 0) {
        $error = "<div class='alert alert-danger'>$error</div>";
    } else {
    }
} else {
}
?>

<body id="register-backg">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark m-0 rounded-0" id="navbar">
        <a href="./" class="navbar-brand mx-auto d-block text-center  w-25" id="Store">NH-Store</a>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-11 col-md-8 col-lg-6 bg-primary rounded shadow mt-0 mt-md-2 mb-5" id="col-2">
                <h3 id="register-header">Đăng Ký</h3>
                <form action="register.php" method="post" class="rounded shadow mb-5 mt-2 mx-auto" id="form-login-body">
                    <div class="form-row">
                        <div class="form-group mx-auto col-lg-6 px-4">
                            <label for="fname" class="text-primary mt-2 font-weight-bold">Firstname</label>
                            <input name="fname" id="fname" type="text" class="form-control" placeholder="First name" value="<?= $fname ?>">
                        </div>
                        <div class="form-group mx-auto col-lg-6 px-4">
                            <label for="lname" class="text-primary mt-2 font-weight-bold">Lastname</label>
                            <input name="lname" id="lname" type="text" class="form-control" placeholder="Last name" value="<?= $lname ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12 mx-auto px-4">
                            <label for="user" class="text-primary mt-2 font-weight-bold">Username</label>
                            <input type="email" name="user" id="user" class="form-control" placeholder="Example: abc@gmail.com" value="<?= $user ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group mx-auto col-lg-6 px-4">
                            <label for="pass" class="text-primary mt-2 font-weight-bold">Password</label>
                            <input name="pass" id="pass" type="password" class="form-control" placeholder="Password" value="<?= $pass ?>">
                        </div>
                        <div class="form-group mx-auto col-lg-6 px-4">
                            <label for="cpass" class="text-primary mt-2 font-weight-bold">Confirm Password</label>
                            <input name="cpass" id="cpass" type="password" class="form-control" placeholder="Confirm Password" value="<?= $cpass ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12 mx-auto px-4">
                            <?php echo $error; ?>
                            <button class="btn btn-success px-5" type="submit">Register</button>
                            <button type="reset" class="btn btn-warning px-5 float-right">Reset</button>
                        </div>
                        <div class="form-group col-lg-12 mx-auto px-4">
                            <a href="login.php" class="text-decoration-none">Bạn đã có tài khoản?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!----------------CopyRight: Start------------------>
    <footer class="bg-dark text-center text-white fixed-bottom">
        <div class="p-4">2021 ABC CORP</div>
    </footer>
    <!----------------CopyRight: End------------------>
    <script src="main.js"></script>
</body>

</html>