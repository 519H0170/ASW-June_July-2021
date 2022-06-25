<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
// connect.php
$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "simulatestore";      // Khai báo database
$conn = mysqli_connect($server, $username, $password, $dbname);
// Check connection
if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
}

// sessionstart.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} else {
}

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $query = "SELECT * from account where user='$user'";
    $result = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($result);
    $res = $res['Activate'];
    if ($res == 'active') {
    } else {
        header("Location: reg_author.php");
    }
} else {
}
?>

<body>

</body>

</html>