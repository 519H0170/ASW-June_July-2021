<?php
include "0-sessionstart.php";
print_r($_SESSION);
if (!isset($_SESSION['user'])) {
    die('Vui lòng <a href="login.php">Đăng nhập </a> trước');
}
if (!isset($_SESSION['download_files'])) {
    die('Không có nội dung nào để tải về');
}
if (!isset($_GET['fileId'])) {
    die('Vui lòng cung cấp file id');
}

$id = $_GET['fileId'];
$filePath = $_SESSION['download_files'][$id];

if (!file_exists(($filePath))) {
    die('Tập tin không tồn tại');
}

header('Content-Description: File Transfer');
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
header('Expires: 0');
// header('Cache-Control: must-revalidate');
// header('Pragma: public');
header('Pragma: no-cache');
header('Content-Length: ' . filesize($filePath));
// flush();
readfile($filePath);
?>

<div></div>