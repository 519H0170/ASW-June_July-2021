<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bình luận</title>
</head>

<?php
$connect = new PDO("mysql:host=localhost;dbname=simulatestore", "root", "");
//Can change connect for each computer
// $page = 1;
// $limit = 10;
// // POST
// if ($_POST['page'] > 1) {
//     $start = (($_POST['page'] - 1) * $limit);
//     $page = $_POST['page'];
// } else {
//     $start = 0;
// }

if (!$_POST) {
    exit();
}
$aid = $_POST['aid'];
$query = "SELECT user,rate,comment,DATE(ratetime) as `time` FROM rate_comment where appid = '$aid' ORDER BY ratetime DESC";

$statement = $connect->prepare($query);

$statement->execute();

$total_data = $statement->rowCount();

$result = $statement->fetchAll();

$output = '';

//  OUTPUT  //
if ($total_data > 0) {
    foreach ($result as $row) {
        $output .= '<div class="mx-3 mt-2 px-3 pt-1" id="commentbox">';
        $output .= '
        <div class="form-group">
            <div id="who" class="d-inline">' . $row['user'] . '</div> 
        ';
        $output .= '
        <div id="ratestart" class="px-2"> Cho điểm: 
        ';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $row['rate']) {
                $output .= '<span class = "fa fa-star checked"></span>';
            } else {
                $output .= '<span class = "fa fa-star unchecked"></span>';
            }
        }
        $output .= '</div>';
        $output .= '<div class="px-2">Đánh giá:</div>';
        $output .= '<div class="pl-3 pr-2">' . $row['comment'] . '</div>';
        $output .= '</div>';
        $output .= '<div class="text-dark px-2 pt-2 text-right" id="dayrate">' . $row['time'] . '</div>';
        $output .= '</div>';
    }
} else {
    $output .= '
        <div class="mt-0 d-flex align-items-center justify-content-center text-light bg-secondary font-weight-bold p-5">Chưa có ai bình luận</div>
    ';
}

echo $output;
?>


<body>

</body>

</html>