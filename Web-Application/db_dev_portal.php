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

//--------------//
function open_database()
{
    $conn = new mysqli(HOST, USER, PASS, DB);
    if ($conn->connect_error) {
        die('Connect error ' . $conn->connect_error);
    }
    return $conn;
}

function get_total_price($devname)
{
    $sql = "SELECT sum(bi.price) as tprice FROM bill bi, app ap  where bi.appid = ap.appid and ap.devname = ?";

    $conn = open_database();
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $devname);

    if (!$stm->execute()) {
        // chay sql that bai vi ly do nao do
        return array('code' => 1, 'error' => 'Cannot execute command');
    }

    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        return null; // khong co data ton tai
    }

    $data = $result->fetch_assoc();

    if ($data['tprice'] == NULL) {
        return 0;
    }
    return $data['tprice'];
}

function count_purchased_bills($devname)
{
    $sql = "SELECT count(bi.billid) as cbill FROM bill bi, app ap where bi.appid= ap.appid and ap.devname =? and bi.price >0";
    $conn = open_database();
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $devname);

    if (!$stm->execute()) {
        // chay sql that bai vi ly do nao do
        return array('code' => 1, 'error' => 'Cannot execute command');
    }

    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        return null; // khong co data ton tai
    }

    $data = $result->fetch_assoc();

    return $data['cbill'];
}

function show_bills($devname)
{
    $sql = "SELECT bi.billid, ap.appname, bi.price, bi.user FROM bill bi, app ap WHERE bi.appid = ap.appid AND ap.devname = ? and bi.price >0";

    $conn = open_database();
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $devname);

    if (!$stm->execute()) {
        // chay sql that bai vi ly do nao do
        return array('code' => 1, 'error' => 'Cannot execute command');
    }

    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        return null; // khong co data ton tai
    }

    // $data = $result->fetch_assoc();

    return $result;
}
