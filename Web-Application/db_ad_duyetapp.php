<?php
include "admin_check.php";
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'simulatestore');
// LUU SESSION devname DE QUERY SQL
//$devname = ...   <-- dien vao day
//demo


//--------------//
function open_database()
{
    $conn = new mysqli(HOST, USER, PASS, DB);
    if ($conn->connect_error) {
        die('Connect error ' . $conn->connect_error);
    }
    return $conn;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>