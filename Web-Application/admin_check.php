<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Admin</title>
</head>



<?php
include "0-sessionstart.php";
if (isset($_SESSION['user'])) {
    if (isset($_SESSION["admin"])) {
    } else {
        header("Location: ./");
    }
} else {
    header("Location: login.php");
}

?>

<body>
</body>

</html>