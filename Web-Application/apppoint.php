<?php
$connect = new PDO("mysql:host=localhost;dbname=simulatestore", "root", "");
if (!$_POST) {
    exit();
}
$aid = $_POST['aid'];
$query = "SELECT avg(`rate`) as `avg` from `rate_comment` where `appid`='$aid'";
$statement = $connect->prepare($query);

$statement->execute();

$total_data = $statement->rowCount();

$result = $statement->fetchAll();

$output = '';
$avg = "0";
foreach ($result as $av) {
    $avg = $av[0];
}
if ($avg > 0) {
    echo '  
            <div>
                <span class="fa fa-star"></span>
                <div class="rounded-circle m-auto">
                    ' . round($avg, 1) . '
                </div>
            </div>';
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