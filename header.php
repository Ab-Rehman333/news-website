<?php
include "config.php";

$page = basename($_SERVER['PHP_SELF']);



switch ($page) {
    case 'single.php':

        $single_id = $_GET['id'];
        if (isset($single_id)) {
            $sql_single = "SELECT * FROM post WHERE post_id = {$single_id}";
            $result = mysqli_query($conn, $sql_single) or die("Error");
            $row_title = mysqli_fetch_assoc($result);
            $page_title = $row_title['title'];
        } else {
            $page_title = "NO POST";
        }
        break;
    case 'category.php':
        $cid = $_GET['cid'];
        if (isset($cid)) {
            $sql_single = "SELECT * FROM category WHERE category_id = {$cid}";
            $result = mysqli_query($conn, $sql_single) or die("Error");
            $row_title = mysqli_fetch_assoc($result);
            $page_title = $row_title['category_name'];
        } else {
            $page_title = "NO POST";
        }
        break;
    case 'author.php':
        $aid = $_GET['aid'];
        if (isset($aid)) {
            $sql_single = "SELECT * FROM user WHERE user_id = {$aid}";
            $result = mysqli_query($conn, $sql_single) or die("Error");
            $row_title = mysqli_fetch_assoc($result);
            $page_title = $row_title['username'];
        } else {
            $page_title = "NO POST";
        }
        break;
    case 'index.php':
        $page_title = "Home page";

        break;

    case 'search.php':
        $search_id = $_GET['search'];
        if (isset($search_id)) {

            $page_title = $_GET['search'];
        } else {
            $page_title = "NO Search REsult Found";
        }
        break;

    default:
        echo "Blogging website";

        break;
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <?php
                    $sql = "SELECT * FROM websitesetting";

                    $result = mysqli_query($conn, $sql) or die("Error: mysql Query Failed");
                    if (mysqli_num_rows($result) > 0) {
                        $db_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        foreach ($db_data as $row) {

                            if ($row['logo'] === "") {
                                '<a href="index.php" id="logo"><h1>' . $row['websitename'] . ' </h1></a> ';
                            }
                            echo '<a href="index.php" id="logo"><img src="images/' . $row['logo'] . '"></a> ';
                        }
                    }
                    ?>

                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <?php
                include "config.php";
                if (isset($_GET['cid'])) {

                    $catid = $_GET['cid'];
                }
                $sql = "SELECT * FROM category WHERE post > 0 ";
                $result = mysqli_query($conn, $sql) or die("Error: " . mysqli_error($conn));
                if (mysqli_num_rows($result) > 0) :
                    $active = "";
                    $db_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
                ?>
                    <div class="col-md-12">

                        <ul class='menu'>
                            <li><a href='<?= $host_name; ?>'>home</a></li>
                            <?php
                            foreach ($db_array as $row) {
                                if (isset($_GET['cid'])) {

                                    if ($row['category_id'] === $catid) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                }
                                echo " <li><a class='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                            } ?>
                        </ul>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->