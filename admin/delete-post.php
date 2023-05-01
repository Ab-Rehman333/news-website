<?php
include "config.php";

$post_id = $_GET['id'];
$cat_id = $_GET['catid'];

// for deleting the image from the folder 
$sql_one = "SELECT *  FROM  post WHERE post_id = {$post_id}";
$result_one = mysqli_query($conn, $sql_one) or die("Error for Deleting image Query");
$row_one = mysqli_fetch_assoc($result_one);
unlink("upload/" . $row_one['post_img']);



$sql = "DELETE  FROM  post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post= post -1 WHERE  category_id = {$cat_id}";

$result  = mysqli_multi_query($conn, $sql);

if ($result) {
    header("location: {$host_name}/admin/post.php");
} else {
    echo "Querry Failed";
}
