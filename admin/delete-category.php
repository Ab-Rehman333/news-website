<?php
include "config.php";



$stu_id = $_GET['id'];

$sql = "DELETE FROM  category WHERE category_id = {$stu_id}";
$result = mysqli_query($conn, $sql) or die("Sorry select data");
if ($result) {
    header("Location: {$host_name}/admin/category.php");
} else {
    echo "<p>Sorry Can't Delete your information</p>";
}
