<?php
include "dev_check.php";
// khai bao server
// connect dbs
// CHINH SUA TUY MAY
// define('HOST','127.0.0.1');
// define('USER','nguyent');
// define('PASS','123456');
// define('DB','simulatestore');

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'simulatestore');
// LUU SESSION devname DE QUERY SQL
//$devname = ...   <-- dien vao day

//demo
//$devname = 'vtsq3';


//--------------//
function open_database()
{
    $conn = new mysqli(HOST, USER, PASS, DB);
    if ($conn->connect_error) {
        die('Connect error ' . $conn->connect_error);
    }
    return $conn;
}

$page = '';
if (isset($_GET['p'])) {
    $page = $_GET['p'];
}

// Cac tinh nang sua,xem

//chuc nang XOA
if ($page == 'del') {
    $appid = $_GET['appid'];

    $sql = "SELECT file_app,icon FROM app where appid=?";

    $mysqli = open_database();
    $stm = $mysqli->prepare($sql);
    $stm->bind_param('s', $appid);

    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        die(); // khong co data ton tai
    }

    $data = $result->fetch_assoc();

    $link = $data['file_app'];
    $icon = $data['icon'];

    // DELETE FILE
    $flink = glob($link . '/*');
    foreach ($flink as $fl) {
        if (is_file($fl)) {
            unlink($fl);
        }
    }

    $ficon = glob($icon . '/*');
    foreach ($ficon as $fi) {
        if (is_file($fi)) {
            unlink($fi);
        }
    }

    rmdir($icon);
    rmdir($link);

    // DELETE STATEMENT
    $sql = "DELETE FROM app WHERE appid=?";
    $stm = $mysqli->prepare($sql);
    $stm->bind_param('s', $appid);

    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        die(); // khong co data ton tai
    }
} else {
    $dname = $_POST['dname'];

    $sql = "SELECT appid,appname,status,price from app where devname=?";

    $mysqli = open_database();
    $stm = $mysqli->prepare($sql);
    $stm->bind_param('s', $dname);

    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        die(); // khong co data ton tai
    }

    while ($data = $result->fetch_assoc()) {
?>
        <tr>
            <td><?= $data['appname'] ?></td>
            <td><?= $data['status'] ?></td>
            <?php if ($data['price'] == 0) { ?>
                <td> No </td>
            <?php } else {
                echo '<td> Yes </td>';
            } ?>
            <td>
                <button class="btn btn-warning" onclick="location.href = 'dev_edit.php?appid=<?= $data['appid'] ?>'">Sửa</button>
                <button class="btn btn-danger" onclick="dev_del_app('<?= $dname ?>','<?= $data['appid'] ?>')">Xóa</button>
            </td>
        </tr>
<?php
    }
}

?>