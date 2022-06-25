<?php
include "cosodulieu.php"; //Coutinue session can use another link
if (isset($who)) {  // Session['user'] = $who   --> $user use for sql
    $account = "SELECT propic,user,fname,lname,birthday,balance FROM Account WHERE user = '$user'"; // Lúc sau sử dụng : cập nhật
    //Check method nhận được.
    if ($_POST) {
        $serial = "";
        // Check xem lúc post đi thì có nhập số seri hay không?
        if (strlen($_POST["serial"]) > 0) {
            // Số seri nhận
            $serial = $_POST["serial"];
            // Mệnh giá nhận
            $menhgia = $_POST["menhgia"];
            $ser = mysqli_real_escape_string($conn, $serial);
            $serqu = "SELECT serial,value,username FROM gift_card WHERE serial = '$ser'";
            $serres = mysqli_query($conn, $serqu);          //Nhận về giá trị sau khi thực thi query :table
            $serrows = mysqli_num_rows($serres);            //Số giá trị nhận về của query
            //Check xem có tồn tại số seri này hay không?
            if ($serrows > 0) {
                $serres = mysqli_fetch_assoc($serres);      //Chuyển về array
                //Check mệnh giá thẻ đúng với số seri không?
                if ($menhgia == $serres["value"]) {
                    //Check thẻ xài hay chưa?
                    if ($serres["username"] == "") {
                        // SQL Update
                        //Card
                        $gcchange = "UPDATE gift_card SET username = '$who',usedate = now() where serial = '$ser'";
                        $gcchange = mysqli_query($conn, $gcchange);    //update card status
                        // Account Balance ++
                        $account = mysqli_query($conn, $account);
                        $account = mysqli_fetch_assoc($account);
                        $balance = (int) ($account["balance"] + $menhgia); // + balance
                        $account = "UPDATE Account SET balance = $balance WHERE user = '$user'";
                        $query = mysqli_query($conn, $account);    //update account balance
                        //Return
                        $thongbao = "Nạp thẻ thành công";
                        $serial = "";
                    } else {
                        $thongbao = "Số seri : $serial đã được người khác sử dụng";
                        $serial = "";
                    }
                } else {
                    $thongbao = "Bạn nên kiểm tra lại mệnh giá thẻ";
                }
            } else {
                $thongbao = "Số seri : $serial không tồn tại";
                $serial = "";
            }
        } else {
            $thongbao = "Mời nhập số serial";
        }
    } else {
        $thongbao="";
    }
} else {
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>