<?php
include "0-sessionstart.php";    //Tiếp tục session nếu có
//  ko có session : trở về login
if (isset($_SESSION['user'])) {
} else {
    if (isset($url)) {
        $_SESSION['url'] = $url;
    } else {
    }
    header("Location: login.php");
}

$who = $_SESSION['user'];
if (isset($who)) {
    // removes backslashes
    $user = mysqli_real_escape_string($conn, $who);
    //User Collumn
    $query = "SELECT propic,user,fname,lname,birthday,balance FROM Account WHERE user = '$user'";
    $result = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($result);
} else {
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link SESSION</title>
</head>

<body>

</body>

</html>