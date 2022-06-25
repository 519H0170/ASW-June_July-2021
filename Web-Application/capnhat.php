<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<?php
include "cosodulieu.php";
if (isset($_POST) and !empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if ($key == 'propic')
            $propic = $value;
        if ($key == 'fname')
            $fname = $value;
        if ($key == 'lname')
            $lname = $value;
        if ($key == 'bd')
            $bd = $value;
    }
    $upquery = "UPDATE account SET propic = '$propic',fname = '$fname',lname = '$lname', birthday = '$bd' Where user = '$user'";
    $upres = mysqli_query($conn, $upquery);
} else {
}
header("Location: Hoso.php");
?>
<body>
    
</body>

</html>