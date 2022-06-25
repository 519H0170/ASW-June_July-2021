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
// $devname = $_SESSION['user'];


//--------------//
function open_database()
{
    $conn = new mysqli(HOST, USER, PASS, DB);
    if ($conn->connect_error) {
        die('Connect error ' . $conn->connect_error);
    }
    return $conn;
}

$path = "./app";
$error = '';
$appname = $short_d = $long_d = $cate = $price = $icon = $pic1 = $pic2 = $pic3 = $pic4 = $fileapp = $status = "";
if (isset($_POST['app-btn-submit'])) {
    $appname = check_isset('appname');
    $short_d = check_isset('short_d');
    $long_d = check_isset('long_d');
    $cate = check_isset('category');
    $price = check_isset('app-price');
    $icon = check_empty_file('app-icon');
    $pic1 = check_empty_file('app-pic-1');
    $pic2 = check_empty_file('app-pic-2');
    $pic3 = check_empty_file('app-pic-3');
    $pic4 = check_empty_file('app-pic-4');
    $fileapp = check_empty_file('app-data');
    $status = check_isset('app-status');

    // tao file app
    $app_path = $path . '/' . $appname;
    $icon_path = $app_path . '/icon';

    if (file_exists($app_path)) {
        $error = '<div class="text-white bg-danger py-2 m-auto d-flex align-items-center justify-content-center">Trùng tên ứng dụng</div>';
    } else {

        if (check_file_extension($icon, 'img') && check_file_extension($pic1, 'img') && check_file_extension($pic2, 'img') && check_file_extension($pic3, 'img') && check_file_extension($pic4, 'img') && check_file_extension($fileapp, 'zip')) {
            if (check_file_size($fileapp)) {
                mkdir($app_path);
                mkdir($icon_path);
                upload_file($icon, $icon_path);
                upload_file($pic1, $app_path);
                upload_file($pic2, $app_path);
                upload_file($pic3, $app_path);
                upload_file($pic4, $app_path);
                upload_file($fileapp, $app_path);
                // tao ma appid
                $appid = random_value(10);
                while (check_app_id_exists($appid)) {
                    $appid = random_value(10);
                }
                // QUERY SQL
                $sql = "SELECT `devname` From dev where user = '$devname'";
                $conn = open_database();
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $dname = $row['devname'];
                    }
                }
                $conn->close();
                $sql = "INSERT INTO app(appid, appname, devname, price, dl_count, status, short_d, long_d, category, icon, picture, file_app)VALUES (?,?,?,?,0,?,?,?,?,?,?,?)";
                $conn = open_database();
                $stm = $conn->prepare($sql);

                $stm->bind_param('sssisssssss', $appid, $appname, $dname, $price, $status, $short_d, $long_d, $cate, $icon_path, $app_path, $app_path);
                if (!$stm->execute()) {
                    echo $stm->error; //Show error
                } else {
                    $error = '<div class="text-white py-2 bg-success m-auto d-flex align-items-center justify-content-center">Success Upload</div>';
                }
                //----------
            } else {
                $error = '<div class="text-white py-2 bg-danger m-auto d-flex align-items-center justify-content-center">Your file is bigger than 25MB</div>';
                echo "25+MB";
            }
        } else {
            $error = '<div class="text-white py-2 bg-danger m-auto d-flex align-items-center justify-content-center">Tập tin ko hợp lệ</div>';
        }
    }
}


function upload_file($file, $dir)
{
    if ($file != NULL) {
        $pname = $file['name'];
        $tname = $file['tmp_name'];
        move_uploaded_file($tname, $dir . '/' . $pname);
    }
}
function check_file_size($file)
{
    if ($file == NULL) {
        return true;
    } else if ($file['size'] < 25 * 1024 * 1024) {
        return true;
    }
    return false;
}

function check_file_extension($file, $type)
{
    if ($file == NULL) {
        return true;
        //pass file if it null
    } else if ($type == 'img') {
        $file_name = $file['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if ($ext == 'img' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
            return true;
        }
    } else if ($type == 'zip') {
        $file_name = $file['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if ($ext == 'zip') {
            return true;
        }
    }
    return false;
}


function check_empty_file($val)
{
    if ($_FILES[$val]['size'] == 0) {
        return NULL;
    }
    return $_FILES[$val];
}

function check_isset($val)
{
    if (isset($_POST[$val])) {
        return $_POST[$val];
    }
    return NULL;
}


function random_value($limit)
{
    $chars = '0123456789qwertyuiopasdfghjklzxcvbnm';
    $ch_len = strlen($chars);
    $random = '';

    for ($i = 0; $i < $limit; $i++) {
        $random .= $chars[rand(0, $ch_len - 1)];
    }

    return $random;
}

function check_app_name_exists($appname)
{
    $sql = "SELECT appid FROM app where appname=?";
    $conn = open_database();

    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $appname);

    if (!$stm->execute()) {
        return array('code' => 1, 'error' => 'Cannot execute command');
    }

    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        return false; // khong co data ton tai
    }
    return true;
}

function check_app_id_exists($appid)
{
    $sql = "SELECT appid FROM app where appid=?";
    $conn = open_database();

    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $appid);

    if (!$stm->execute()) {
        return array('code' => 1, 'error' => 'Cannot execute command');
    }

    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        return false; // khong co data ton tai
    }
    return true;
}
?>

<html>

</html>