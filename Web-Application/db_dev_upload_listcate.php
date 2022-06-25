<?php
// khong can khai bao open_database do file kia da khai bao roi
include "dev_check.php";
function get_cate_list()
{
    $sql = "SELECT category FROM category";

    $conn = open_database();
    $stm = $conn->prepare($sql);

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



?>
<html>

</html>