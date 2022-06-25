<?php
include "dev_check.php";
function verify_appid_devname($appid, $devname)
{
    $sql = "SELECT appid FROM app WHERE appid=? AND devname=?";

    $mysqli = open_database();
    $stm = $mysqli->prepare($sql);
    $stm->bind_param('ss', $appid, $devname);

    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        return false; // khong co data ton tai       
    }

    return true;
}



function get_data_from_appid($appid)
{
    $sql = "SELECT * FROM app WHERE appid=?";

    $mysqli = open_database();
    $stm = $mysqli->prepare($sql);
    $stm->bind_param('s', $appid);

    if (!$stm->execute()) {
        // chay sql that bai vi ly do nao do
        return array('code' => 1, 'error' => 'Cannot execute command');
    }

    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        return null; // khong co data ton tai
    }

    $data = $result->fetch_assoc();
    return $data;
}
