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
$page = '';
if (isset($_GET['p'])) {
    $page = $_GET['p'];
}

// Cac tinh nang them, sua, xoa, xem
//chuc nang XOA
if ($page == 'del') {
    $id = $_GET['id'];
    $id = str_replace("-", " ", $id);

    if (!if_app_exists($id)) {
        $sql = "DELETE FROM category where category = ?";

        $mysqli = open_database();
        $stm = $mysqli->prepare($sql);
        $stm->bind_param('s', $id);

        if (!$stm->execute()) {
            // chay sql that bai vi ly do nao do
            die('Failed');
        }
    }
}
// CHUC NANG ADD
else if ($page == 'add') {
    $cate = $_POST['cate'];
    if (!empty($cate)) {
        if (!if_cate_exists($cate)) {
            $sql = "INSERT INTO category VALUES (?)";

            $mysqli = open_database();
            $stm = $mysqli->prepare($sql);
            $stm->bind_param('s', $cate);

            if (!$stm->execute()) {
                // chay sql that bai vi ly do nao do
                die('Failed');
            }
        }
    }
}
// CHUC NANG EDIT
else if ($page == 'edit') {
    $cate = $_POST['cate'];
    $ncate = $_POST['ncate'];
    $cate = str_replace("-", " ", $cate);

    if (!empty($ncate)) {
        if (!if_cate_exists($ncate)) {
            insert_cate_sql($ncate);
            change_all_app_cate($cate, $ncate);
            remove_cate_sql($cate);
        }
    }
} else {
    $sql = "SELECT category from category";

    $mysqli = open_database();
    $stm = $mysqli->prepare($sql);
    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        die(); // khong co data ton tai
    }
    while ($data = $result->fetch_assoc()) {
        $cate = $data['category'];
        $sql = "SELECT COUNT(`appid`) as `count` FROM `app` WHERE `category`='$cate'";
        // echo $sql;
        $mysqli = open_database();
        $sud = $mysqli->prepare($sql);
        $sud->execute();
        $sud = $sud->get_result();
        $sud = $sud->fetch_array();

        $subcate = vn_to_str($cate);

        // echo $subcate;
        // echo $cate;
?>
        <tr>
            <td><?= $cate ?></td>
            <td class="text-center"><?= $sud[0] ?></td>
            <td class="text-center">
                <button class="btn btn-warning" id="ad-cate-edit" data-toggle="modal" data-target="#ad-cate-editModal-<?= $subcate ?>">Sửa</button>
                <?php
                if (if_app_exists($cate)) {
                ?>
                    <button class="btn btn-danger" id="ad-cate-del" disabled>Xóa</button>
                <?php
                } else {
                ?>
                    <button class="btn btn-danger" id="ad-cate-del" onclick="deleteCate('<?= $cate ?>')">Xóa</button>
                <?php
                }
                ?>
            </td>
            <!-- ADD EDIT MODAL -->
            <td>
                <div class="modal fade" id="ad-cate-editModal-<?= $subcate ?>" role="dialog">
                    <div class="modal-dialog">
                        <!-- MODAL CONTENTS -->
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title">Sửa thể loại</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <p>Thể loại cần chuyển: <span class="font-weight-bold"><?= $cate ?></span></p>

                                    </div>
                                    <div class="form-group">
                                        <label for="ad-cate-add-input-m">Nhập thể loại mới</label>
                                        <input type="text" class="form-control" id="ad-cate-edit-input-m-<?= $subcate ?>" placeholder="Nhập thể loại mới tại đây" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" id="ad-cate-edit-btn" onclick="editCate('<?= $subcate ?>')">Submit</button>
                                        <!--  -->
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
<?php
    }

    //$mysqli->close(); 
}


// kiem tra neu cate da ton tai
function if_cate_exists($cate)
{
    $sql = "SELECT * FROM category where category =?";

    $mysqli = open_database();
    $stm = $mysqli->prepare($sql);
    $stm->bind_param('s', $cate);

    if (!$stm->execute()) {
        // chay sql that bai vi ly do nao do
        // return array ('code'=>1,'error' =>'Cannot execute command');
        die('Failed');
    }

    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        return false; // khong co data ton tai
    }
    return true;
}

function if_app_exists($cate)
{
    $sql = "SELECT a1.appid FROM category c1, app a1 WHERE 
            c1.category = a1.category AND c1.category = ?";

    $mysqli = open_database();
    $stm = $mysqli->prepare($sql);
    $stm->bind_param('s', $cate);

    if (!$stm->execute()) {
        die('Failed');
    }

    $result = $stm->get_result();

    // khong co data ton tai
    if ($result->num_rows == 0) {
        return false;
    }
    return true;
}

function insert_cate_sql($ncate)
{
    $sql = "INSERT INTO category VALUES (?)";

    $mysqli = open_database();
    $stm = $mysqli->prepare($sql);
    $stm->bind_param('s', $ncate);

    if (!$stm->execute()) {
        // chay sql that bai vi ly do nao do
        die('Failed');
    }
}

function remove_cate_sql($cate)
{
    $sql = "DELETE FROM category where category = ?";

    $mysqli = open_database();
    $stm = $mysqli->prepare($sql);
    $stm->bind_param('s', $cate);

    if (!$stm->execute()) {
        // chay sql that bai vi ly do nao do
        die('Failed');
    }
}

function change_all_app_cate($cate, $ncate)
{
    $sql = "UPDATE app SET category = ? WHERE category = ?";

    $mysqli = open_database();
    $stm = $mysqli->prepare($sql);
    $stm->bind_param('ss', $ncate, $cate);

    if (!$stm->execute()) {
        // chay sql that bai vi ly do nao do
        die('Failed');
        // echo "Error";
    }
}


function vn_to_str($str)
{
    $unicode = array(

        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

        'd' => 'đ',

        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

        'i' => 'í|ì|ỉ|ĩ|ị',

        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

        'D' => 'Đ',

        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',

        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

    );

    foreach ($unicode as $nonUnicode => $uni) {

        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $str = str_replace(' ', '-', $str);

    return $str;
}
?>

<body>

</body>

</html>