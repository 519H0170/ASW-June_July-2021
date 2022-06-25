<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Statistic</title>
</head>

<body>
    <?php
    // khai bao server
    // connect dbs
    // CHINH SUA TUY MAY
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

    function count_user()
    {
        $sql = "SELECT count(*) as c_user from account where level!='Administrator'";

        $conn = open_database();
        $stm = $conn->prepare($sql);
        // $stm->bind_param('s',$devname);

        if (!$stm->execute()) {
            // chay sql that bai vi ly do nao do
            return array('code' => 1, 'error' => 'Cannot execute command');
        }

        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return null; // khong co data ton tai
        }

        $data = $result->fetch_assoc();

        return $data['c_user'];
    }
    function count_dev()
    {
        $sql = "SELECT count(*) as c_dev from account where level='Developer'";

        $conn = open_database();
        $stm = $conn->prepare($sql);
        // $stm->bind_param('s',$devname);

        if (!$stm->execute()) {
            // chay sql that bai vi ly do nao do
            return array('code' => 1, 'error' => 'Cannot execute command');
        }

        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return null; // khong co data ton tai
        }

        $data = $result->fetch_assoc();

        return $data['c_dev'];
    }

    function count_app()
    {
        $sql = "SELECT count(*) as c_app from app";

        $conn = open_database();
        $stm = $conn->prepare($sql);
        // $stm->bind_param('s',$devname);

        if (!$stm->execute()) {
            // chay sql that bai vi ly do nao do
            return array('code' => 1, 'error' => 'Cannot execute command');
        }

        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return null; // khong co data ton tai
        }

        $data = $result->fetch_assoc();

        return $data['c_app'];
    }

    function list_cate()
    {
        $sql = " SELECT c1.category, c2.numb FROM category c1 LEFT JOIN
        (SELECT category, count(appid) as numb from app group by category) c2
        ON c1.category = c2.category
        ORDER BY c2.numb";

        $conn = open_database();
        $stm = $conn->prepare($sql);
        // $stm->bind_param('s',$devname);

        if (!$stm->execute()) {
            // chay sql that bai vi ly do nao do
            return array('code' => 1, 'error' => 'Cannot execute command');
        }

        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return null; // khong co data ton tai
        }

        // $data = $result->fetch_assoc();

        return $result;
    }

    function list_download_app()
    {
        $sql = "SELECT appname, dl_count from app order by dl_count DESC LIMIT 5";

        $conn = open_database();
        $stm = $conn->prepare($sql);

        if (!$stm->execute()) {
            // chay sql that bai vi ly do nao do
            return array('code' => 1, 'error' => 'Cannot execute command');
        }

        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return null; // khong co data ton tai
        }

        // $data = $result->fetch_assoc();

        return $result;
    }

    function list_purchased_app()
    {
        $sql = "SELECT appname, price, dl_count from app WHERE price>0 and dl_count > 0 order by dl_count DESC LIMIT 5";

        $conn = open_database();
        $stm = $conn->prepare($sql);

        if (!$stm->execute()) {
            // chay sql that bai vi ly do nao do
            return array('code' => 1, 'error' => 'Cannot execute command');
        }

        $result = $stm->get_result();

        // if ($result->num_rows == 0) {
        //     return null; // khong co data ton tai
        // }

        // $data = $result->fetch_assoc();

        return $result;
    }


    ?>
</body>

</html>