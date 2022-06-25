<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database_Categories</title>
</head>
<?php
include "admin_check.php";
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

// Lay chuc nang qua 'p'
$sql = "SELECT `appname`,`category`,`appid`,`devname` from `app` where `status`='pending'";

$mysqli = open_database();
$stm = $mysqli->prepare($sql);
$stm->execute();
$result = $stm->get_result();

if ($result->num_rows == 0) {
    echo "<tr><td><h3 class='text-center p-5 border-0'>Không có ứng dụng chờ để duyệt</h3></td></tr>";
    die();
}
?>
<thead>
    <tr>
        <th class="text-center">Tên ứng dụng</th>
        <th class="text-center">Thể loại</th>
        <th class="text-center">Nhà phát triển</th>
        <th class="text-center">Hành động</th>
    </tr>
</thead>
<tbody>
    <?php
    while ($data = $result->fetch_assoc()) {
        $cate = $data['category'];
        $aname = $data['appname'];
        $dev = $data['devname'];
        $aid = $data['appid'];

    ?>

        <tr>
            <td class="text-center"><?= $aname ?></td>
            <td class="text-center">
                <?= $cate ?>
            </td>
            <td class="text-center">
                <?= $dev ?>
            </td>
            <!-- ADD EDIT MODAL -->
            <td class="text-center">
                <a href="admin_app_details.php?appid=<?= $aid ?>" class='text-decoration-none btn btn-success p-2'>
                    Xem chi tiết
                </a>
            </td>
        </tr>
    <?php
    }

    //$mysqli->close(); 


    ?>
</tbody>



<body>

</body>

</html>