<?php
$connect = new PDO("mysql:host=localhost;dbname=simulatestore", "root", "");
// $username = "root"; // Khai báo username
// $password = "";      // Khai báo password
// $server   = "localhost";   // Khai báo server
// $dbname   = "simulatestore";      // Khai báo database
// $conn = mysqli_connect($server, $username, $password, $dbname);


$page = 1;
if (!isset($_POST['limit'])) {
    $limit = 12;
}


// POST
if ($_POST['page'] > 1) {
    $start = (($_POST['page'] - 1) * $limit);
    $page = $_POST['page'];
} else {
    $start = 0;
}
// QUERY

//HAVE CATE AND SEARCH NAME
$query = "SELECT icon,appid,appname,dl_count FROM app where status = 'published' ";
if ($_POST['cate'] != '') {
    $cate = $_POST['cate'];
    // echo $cate;
    $query .= '
    and category = "' . $cate . '"
    ';
} else {
}
if ($_POST['pay'] != '') {                                                     //have post pay
    if ($_POST['pay'] == "free") {                                          //free
        $query .= '
        and price = 0 
        ';
    } else {                                                                 //paid
        $query .= '
        and price > 0
        ';
    }
} else {
}
if ($_POST['query'] != '') {
    $query .= '
    and appname LIKE "%' . str_replace(' ', '%', $_POST["query"]) . '%" 
    ';
} else {
}
// echo $query;


//Fine
$query .= 'ORDER BY appname ASC ';
// echo $query;
//Fine
$filter_query = $query . 'LIMIT ' . $start . ', ' . $limit . '';
// echo $filter_query;
$statement = $connect->prepare($query);

$statement->execute();
//Fine
$total_data = $statement->rowCount();
// echo $total_data;
$statement = $connect->prepare($filter_query);

$statement->execute();
//Fine
$result = $statement->fetchAll();
// print_r($result);

$output = '';
//  OUTPUT  //
if ($total_data > 0) {
    $output .= '<div class="d-flex flex-wrap my-3" id="appGoParent">';
    foreach ($result as $row) {
        $dir = $row['icon'];
        $icon = glob($dir . "/*.{jpg,img,jpeg,png}", GLOB_BRACE);
        foreach ($icon as $icon) {
            $icon = $icon;
        }
        $output .= '
        <a id="appGo" href="app.php?aid=' . $row['appid'] . '" class="text-decoration-none my-2 col-12 col-sm-6 col-md-4 col-lg-3">
            <div id="appGoChild">
                <div class="d-flex align-items-center justify-content-center"><img src="' . $icon . '" id="aaicon"></div>
                <div id="tenapp" class="d-flex align-items-center justify-content-center text-dark text-center">' . $row['appname'] . '</div>
                <div id="aarate" class="d-flex align-items-center justify-content-center">' . $row['dl_count'] . ' use(s)</div>
            </div>
        </a>
        ';
    }
    $output .= '</div>';
} else {
    $output .= '
        <div class="mt-0 d-flex align-items-center justify-content-center text-light bg-secondary font-weight-bold p-5">No app was found </div>
    ';
}


$output .= '
<br />
<div class="mt-0 d-flex align-items-center justify-content-center">
    <ul class="pagination">
';

//  OUTPUT  //


//PAGNIGTION 2
$total_links = ceil($total_data / $limit);

$previous_link = '';

$next_link = '';

$page_link = '';

$page_array = [];

if ($total_links > 4) {
    if ($page < 5) {
        for ($count = 1; $count <= 5; $count++) {
            $page_array[] = $count;
        }
        $page_array[] = '...';
        $page_array[] = $total_links;
    } else {
        $end_limit = $total_links - 5;
        if ($page >= $end_limit) {
            $page_array[] = 1;
            $page_array[] = '...';

            for ($count = $end_limit; $count <= $total_links; $count++) {
                $page_array[] = $count;
            }
        } else {
            $page_array[] = 1;
            $page_array[] = '...';

            for ($count = $page - 1; $count <= $page + 1; $count++) {
                $page_array[] = $count;
            }

            $page_array[] = '...';
            $page_array[] = $total_links;
        }
    }
} else {
    for ($count = 1; $count <= $total_links; $count++) {
        $page_array[] = $count;
    }
}

for ($count = 0; $count < count($page_array); $count++) {
    if ($page == $page_array[$count]) {
        $page_link .= ' 
        <li class = "page-item active">
            <a class="page-link" href="#">' . $page_array[$count] . '
                <span class="sr-only">(current)</span>
            </a>
        </li>    
        ';

        $previous_id = $page_array[$count] - 1;

        if ($previous_id > 0) {
            $previous_link = '
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">
                    Previous
                </a>
            </li>
            ';
        } else {
            $previous_link = '
            <li class="page-item disabled">
                <a class="page-link" href="#">
                    Previous
                </a>
            </li>
            ';
        }

        $next_id = $page_array[$count] + 1;

        if ($next_id > $total_links) {
            $next_link = '
            <li class="page-item disabled">
                <a class="page-link" href="#">
                    Next
                </a>
            </li>
            ';
        } else {
            $next_link = '
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '">
                    Next
                </a>
            </li>
            ';
        }
    } else {
        if ($page_array[$count] == '...') {
            $page_link .= '
            <li class = "page-item disabled">
                <a class="page-link" href="#">...</a>
            </li>
            ';
        } else {
            $page_link .= '
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a>
                </li>
            ';
        }
    }
}

$output .= $previous_link . $page_link . $next_link . '</ul></div>';
echo $output;
?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

</body>

</html>