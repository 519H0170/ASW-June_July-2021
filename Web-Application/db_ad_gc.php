<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database_GiftCard</title>
</head>
<?php
include "admin_check.php";
//--------------//
// define('HOST','127.0.0.1');
// define('USER','nguyent');
// define('PASS','123456');
// define('DB','simulatestore');
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'simulatestore');
//--------------//
function open_database()
{
    $conn = new mysqli(HOST, USER, PASS, DB);
    if ($conn->connect_error) {
        die('Connect error ' . $conn->connect_error);
    }
    return $conn;
}

function random_value($limit)
{
    $chars = '0123456789QWERTYUIOPASDFGHJKLZXCVBNM';
    $ch_len = strlen($chars);
    $random = '';
    $error = 0;
    while ($error == 0) {
        $error = 1;
        for ($i = 0; $i < $limit; $i++) {
            $random .= $chars[rand(0, $ch_len - 1)];
        }
        $sql = "SELECT * from `gift_card` where `serial`='$random'";
        $conn = open_database();
        $find = $conn->prepare($sql);
        $find->execute();
        $row = $find->num_rows();
        if ($row == 1) {
            $random = '';
            $error = 0;
        }
    }
    return $random;
}

function insert_gc($quan, $val, $admin)
{
    $sql = "INSERT INTO gift_card (`serial`,`AdminName`,`Username`,`Value`,`usedate`) VALUES (?,?,DEFAULT,?,DEFAULT)";

    $conn = open_database();

    for ($i = 0; $i < $quan; $i++) {
        $serial = random_value(12);
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssi', $serial, $admin, $val);

        if (!$stm->execute()) {
            return array('code' => 1, 'error' => 'Cannot execute command');
        }
    }
}

?>

<body>

</body>

</html>