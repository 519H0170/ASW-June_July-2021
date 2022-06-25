<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử lí đăng nhập</title>
</head>
<?php
// include "0-connect.php";
include "0-sessionstart.php";
if ($_POST) {
} else {
    $error = "";
    // $tk = "<input type='email' name='user' id='user' class='form-control' placeholder='Username' required>";
}
// Have user
if (isset($_SESSION['user'])) {
    header("Location: logrecent.php");
} else {
}
if (isset($_COOKIE['user']) && isset($_COOKIE['pass'])) {
    $user = $_COOKIE['user'];
    $pass = $_COOKIE['pass'];
} else {
    $user = '';
    $pass = '';
}

// If form submitted, insert values into the database.
if (isset($_POST['user'])) {
    $puser = $_POST['user'];
    $ppass = $_POST['pass'];
    if (strlen($puser) == 0 or strlen($ppass) == 0) {
        // $tk = "<input type='email' name='user' id='user' class='form-control' placeholder='Username' required>";
        $error = "Bạn chưa nhập tên tài khoản và mật khẩu";
        $error = "<div class='alert alert-danger'>$error</div>";
    } else if (strlen($ppass) < 6) {
        // $tk = "<input type='email' name='user' id='user' class='form-control' value='$puser' required>";
        $error = "Mật khẩu cần có ít nhất 6 kí tự";
        $error = "<div class='alert alert-danger'>$error</div>";
    } else {
        // removes backslashes
        $user = stripslashes($_REQUEST['user']);
        $user = mysqli_real_escape_string($conn, $user);
        $pass = stripslashes($_REQUEST['pass']);
        $dbpass = mysqli_real_escape_string($conn, $pass);
        $md5pass = md5($dbpass);

        //========Search user in database===============
        $query = "SELECT pass FROM Account WHERE user = '$user'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        //Check: Tài khoản
        if ($rows == 1) {
            //Check: mật khẩu
            if ($md5pass == mysqli_fetch_assoc($result)["pass"]) {
                if (isset($_POST['remember'])) {
                    setcookie('user', $user, time() + 3600);
                    setcookie('pass', $dbpass, time() + 3600);
                } else {
                    unset($_COOKIE['user']);
                    unset($_COOKIE['pass']);
                    setcookie('user', null, -1, '/');
                    setcookie('pass', null, -1, '/');
                }
                $_SESSION['user'] = $user;
                if (isset($_SESSION['url'])) {
                    $url = $_SESSION['url'];
                    unset($_SESSION['url']);
                    header("Location: $url");
                } else {
                    header("Location: ./");
                }
                // header("Location: ./");
                exit();
            } else {
                $user = $_POST['user'];
                // $tk = $_POST['user'];
                // $tk = "<input type='email' name='user' id='user' class='form-control' value='$tk' required>";
                $error = "Sai mật khẩu.";
                $error = "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            // $user = $_POST['user'];
            // $tk = $_POST['user'];
            $user='';
            $pass='';
            $error = "Tài khoản $puser không tồn tại.";
            $tk = "<input type='email' name='user' id='user' class='form-control' placeholder='Username' required>";
            $error = "<div class='alert alert-danger'>$error</div>";
        }
    }
} else {
}
?>

<body>

</body>

</html>