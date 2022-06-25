<?php
include "dev_check.php";
//require('db_dev_opendbs.php');
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


//--------------//
function open_database()
{
    $conn = new mysqli(HOST, USER, PASS, DB);
    if ($conn->connect_error) {
        die('Connect error ' . $conn->connect_error);
    }
    return $conn;
}

$error = '';
$path = "./app";

if (isset($_POST['app-btn-submit'])) {
    $appname = check_isset('appname');

    $appid = get_appid($appname);

    $short_d = check_isset('short_d');
    $long_d = check_isset('long_d');
    $cate = check_isset('category');
    $price = check_isset('app-price');
    $icon = check_empty_file('app-icon');

    $fileapp = check_empty_file('app-data');
    $status = check_isset('app-status');

    $pic1 = check_empty_file('app-pic-1');
    $pic2 = check_empty_file('app-pic-2');
    $pic3 = check_empty_file('app-pic-3');
    $pic4 = check_empty_file('app-pic-4');
    $icon = check_empty_file('app-icon');
    $fileapp = check_empty_file('app-data');

    $app_path = $path . '/' . $appname;
    $icon_path = $app_path . '/icon';

    // CO THE XAY RA NHIEU HON 1 TRUONG HOP VOI MOI APP
    // TRUONG HOP 1: 4 FILE ANH KHONG PHAI NULL
    if (!($pic1 == NULL && $pic2 == NULL && $pic3 == NULL && $pic4 == NULL)) {
        if (check_file_extension($pic1, 'img') && check_file_extension($pic2, 'img') && check_file_extension($pic3, 'img') && check_file_extension($pic4, 'img')) {
            // DELETE CURRENT FILE
            $fapp = glob($app_path . '/*');
            foreach ($fapp as $fl) {
                if (is_file($fl)) {
                    //unlink($fl);
                    $ext = pathinfo($fl, PATHINFO_EXTENSION);
                    if ($ext == 'img' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
                        unlink($fl);
                    }
                }
            }

            // UPLOAD NEW FILE
            upload_file($pic1, $app_path);
            upload_file($pic2, $app_path);
            upload_file($pic3, $app_path);
            upload_file($pic4, $app_path);
            //upload_file($fileapp,$app_path);

            // tao ma appid
            // $appid = random_value(10);
            // while(check_app_id_exists($appid)){
            //     $appid = random_value(10);
            // }

            // QUERY SQL

        }
    } else {
        $error = 'Tập tin file không hợp lệ';
    }

    // TRUONG HOP 2: NEU FILE ICON KHONG PHAI NULL
    if ($icon != NULL) {
        if (check_file_extension($icon, 'img')) {
            $fi = glob($icon_path . '/*');
            foreach ($fi as $fl) {
                if (is_file($fl)) {
                    //unlink($fl);
                    $ext = pathinfo($fl, PATHINFO_EXTENSION);
                    if ($ext == 'zip' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
                        unlink($fl);
                    }
                }
            }

            // UPLOAD NEW FILE
            upload_file($icon, $icon_path);
        } else {
            $error = 'Tập tin file không hợp lệ';
        }
    }

    // TRUONG HOP 3: NEU FILE ZIP KHONG PHAI NULL
    if ($fileapp != NULL) {
        if (check_file_extension($fileapp, 'zip')) {
            if (check_file_size($fileapp)) {
                // DELETE CURRENT FILE
                $fapp = glob($app_path . '/*');
                foreach ($fapp as $fl) {
                    if (is_file($fl)) {
                        //unlink($fl);
                        $ext = pathinfo($fl, PATHINFO_EXTENSION);
                        if ($ext == 'zip') {
                            unlink($fl);
                        }
                    }
                }

                // UPLOAD NEW FILE
                upload_file($fileapp, $app_path);
            } else {
                $error = 'Your file is greater than 25MB';
            }
        } else {
            $error = 'Tập tin file không hợp lệ';
        }
    }

    // UPDATE DATABASE
    $sql = "UPDATE app SET price=?, status=?, short_d=?, long_d=?, category=? WHERE appid=?";

    $conn = open_database();

    $stm = $conn->prepare($sql);
    $stm->bind_param('isssss', $price, $status, $short_d, $long_d, $cate, $appid);

    if (!$stm->execute()) {
        return array('code' => 1, 'error' => 'Cannot execute command');
    }

    //----------


}


function upload_file($file, $dir)
{
    if ($file != NULL) {
        $pname = $file['name'];
        $tname = $file['tmp_name'];
        move_uploaded_file($tname, $dir . '/' . $pname);
    }
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

function get_appid($appname)
{
    $sql = "SELECT appid FROM app where appname=?";

    $conn = open_database();

    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $appname);

    if (!$stm->execute()) {
        return NULL;
    }

    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        return null; // khong co data ton tai
    }

    $data = $result->fetch_assoc();
    return $data['appid'];
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
