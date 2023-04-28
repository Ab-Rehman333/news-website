<?php
include "config.php";

if($_SESSION['user_role'] == "0"){
    header("Location: {$host_name}/post.php/");
}

$stu_id = $_GET['id'];

$sql = "DELETE FROM  user WHERE user_id = {$stu_id}";
$result = mysqli_query($conn, $sql) or die("Sorry select data");
if ($result) {
    header("Location: {$host_name}/admin/users.php");
}else {
    echo "<p>Sorry Can't Delete your information</p>";
}
