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
echo "<table class='table table-hover border mt-3'>
    <thead>
      <tr>
        <th>Mã thẻ</th>
        <th>Mệnh giá</th>
        <th>Người tạo</th>
        <th>Người sở hữu</th>
      </tr>
    </thead>
    <tbody>";

$sql = "SELECT serial, value,AdminName, Username FROM gift_card ORDER BY username DESC, value ASC";

// $mysqli = open_database();

$result = mysqli_query($conn, $sql);

// Tao bang tung gia tri
// $row chua thong tin moi hang
while ($row = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>$row[0]</td>";
  echo "<td>$row[1]</td>";
  echo "<td>$row[2]</td>";
  echo "<td>$row[3]</td>";
  echo "</tr>";
}
echo "</tbody>";
echo "</table>";

// $mysqli->close();    
$conn->close();
