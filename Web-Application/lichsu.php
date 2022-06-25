<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử nạp</title>
</head>
<?php
include "cosodulieu.php";
if (isset($who)) {  // Session['user'] = $who   --> $user use for sql
    $account = "SELECT propic,user,fname,lname,birthday,balance FROM Account WHERE user = '$user'"; // Lúc sau sử dụng : cập nhật
    $hisnap = "SELECT serial,value,usedate FROM gift_card WHERE username = '$user' order by usedate desc";
    $result = mysqli_query($conn, $hisnap);
    $rows = mysqli_num_rows($result);
    echo "<div class='mt-2 p-0 w-100 text-center' id='lichsu'>";
    if ($rows > 0) {
        echo "<div class='p-2 text-light' id='bigger'>Lịch sử nạp thẻ</div>";
        // echo "<div class='pt-2 pb-2 text-light text-left' id='bigger'><input class='form-control' id='findNapthe' type='text' placeholder='Search..'></div>";    // Search : not need
        echo "<table class='table-hover w-100 bg-light' id='hTable'>";
        echo "<thead class='thead-dark'>";
        echo "<tr><th role='button' id='sortSeri'>Số seri <span class='fa fa-sort' aria-hidden='true'></span></th><th role='button' id='daySort'>Ngày sử dụng <span class='fa fa-sort' aria-hidden='true'></span></th><th role='button' id='sortValue'>Mệnh giá <span class='fa fa-sort' aria-hidden='true'></span></th></tr>";
        echo "</thead>";
        echo "<tbody id='hntBody'>";
        $tongnap = 0;
        for ($i = 0; $i < $rows; $i++) {
            # code...
            $fecth = mysqli_fetch_array($result);
            echo "<tr><td> $fecth[0] </td>";
            echo "<td> $fecth[2] </td>";
            echo "<td> $fecth[1] </td></tr>";
            $tongnap = $tongnap + $fecth[1];
        }
        echo "</tbody>";
        echo "</table>";
        echo "<div><div class='bg-dark mt-3 p-2 text-light' id='bigger'> Tổng nạp : $tongnap (VNĐ)</div></div>";
    } else {
        echo "<div class='container p-5 text-white' id='bigger'> Không có lịch sử nạp</div>";
    }
    echo "</div>";
} else {
    header("Location: login.php");
}
?>

<body>

</body>

</html>