<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<?php
$url = $_SERVER['PHP_SELF'];
include "cosodulieu.php";
?>

<body id="profilepage">

    <!------------------HEADER : START-------------------->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark m-0" id="navbar">
        <a class="navbar-brand" href="./" id="Store">NH-Store</a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ml-auto text-center" id="log-area">
                <?php
                if (isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    $query = "SELECT * FROM account WHERE user = '$user'";
                    $result = mysqli_query($conn, $query);
                    $rows = mysqli_num_rows($result);
                    if ($rows == 1) {
                        $result = mysqli_fetch_assoc($result);
                        $level = $result['level'];
                        if ($level == 'Administrator') {
                            $_SESSION['admin'] = "1";
                            echo "<li class='nav-item' id='devp'><a class='nav-link' href='admin_portal.php'> AdminPortal </a></li>";
                        } else if ($level == 'Developer') {
                            $_SESSION['dev'] = "1";
                            echo "<li class='nav-item' id='devp'><a class='nav-link' href='dev_portal.php'> DevPortal </a></li>";
                        } else {
                            echo "<li class='nav-item' id='devp'><a class='nav-link' href='upgrade_info.php'> Upgrade </a></li>";
                        }
                        echo "<li class='nav-item' id='accp'><a class='nav-link' href='Hoso.php'> Account </a></li>";
                        echo "<li class='nav-item' id='outp'><a class='nav-link' href='logout.php'> Sign out <span class='fa fa-sign-out'></span></a></li>";
                    } else {
                        echo "M hack session ah????";
                        session_unset();
                        session_destroy();
                        header("Location: login.php");
                    }
                } else {
                    echo "<li class='nav-item' id='inp'><a class='nav-link' href='login.php' role='button'> Sign In <span class='fa fa-sign-in'></span></a></li>";
                    echo "<li class='nav-item' id='newp'><a class='nav-link' href='register.php' role='button'> Create an account <span class='fa fa-user-plus'></span></a></li>";
                }
                ?>
            </ul>
        </div>
    </nav>
    <!------------------HEADER : END-------------------->

    <!----------------Body : Start------------------>
    <div class="container mt-3 mb-5 bg-dark p-3 w-100" id="hosoBody">
        <div id="AccountTab">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" href="Hoso.php">Hồ sơ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link unactive bg-light text-dark" href="Napthe.php">Nạp thẻ</a>
                </li>
            </ul>
        </div>

        <form method='post' action="./capnhat.php" id="prosub">
            <div class="text-left p-0 w-100" id="info">
                <table border="0" class="text-center w-100 p-0 mt-2" id="pTable">
                    <tr>
                        <td colspan="3">
                            <img src="<?php echo $result["propic"]; ?>" height="150" width="150" style="border-radius:50%;" id="profilepic">
                            <input type="hidden" value="<?php echo $result["propic"]; ?>" id="propic" name="propic"><br>
                            <label class="btn btn-light mt-3">
                                <i class="fa fa-image"></i> Change profile picture <input type="file" accept="image/*" id="upload" style="display:none;">
                            </label>

                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td> Email : </td>
                        <td><input type="email" value="<?php echo $result["user"]; ?>" id="user" name="user" disabled></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Firstname :</td>
                        <td><input type="text" value="<?php echo $result["fname"]; ?>" id="fname" name="fname" disabled></td>
                        <td><button type="button" class="fa fa-pencil-square-o" id="edit"></button></td>
                    </tr>
                    <tr>
                        <td>Lastname : </td>
                        <td><input type="text" value="<?php echo $result["lname"]; ?>" id="lname" name="lname" disabled></td>
                        <td><button type="button" class="fa fa-pencil-square-o" id="edit"></button></td>
                    </tr>
                    <tr>
                        <td>Birthday : </td>
                        <td><input type="date" value="<?php echo $result["birthday"]; ?>" id="bd" name="bd" disabled></td>
                        <td><button type="button" class="fa fa-pencil-square-o" id="edit"></button></td>
                    </tr>
                    <tr>
                        <td>Balance : </td>
                        <td><input type="number" value="<?php echo $result["balance"]; ?>" id="money" disabled></td>
                        <td>( VNĐ )</td>
                    </tr>
                </table>
            </div>

            <div class="text-center text-light w-100 mt-2">
                <a role="button" class="text-decoration-none" id="save">
                    <div role="button" class="text-center text-dark border p-2" id="save">
                        Save
                    </div>
                </a>
            </div>

        </form>
        <div class="container" id="testpost">

        </div>
    </div>
    <!----------------Body : End------------------>
    <!----------------CopyRight: Start------------------>
    <footer class="bg-dark mt-5 text-center text-white fixed-bottom">
        <div class="py-2">2021 ABC CORP</div>
    </footer>
    <!----------------CopyRight: End------------------>

    <script src="main.js"></script>

</body>



<!----------------FadeOut---------------->

</html>