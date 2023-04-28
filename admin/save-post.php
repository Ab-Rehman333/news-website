<?php

include "config.php";
if (isset($_FILES['fileToUpload'])) {
    $errors = [];

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp =  $_FILES['fileToUpload']['tmp_name'];
    $file_type =  $_FILES['fileToUpload']['type'];
    $file_ext = end(explode('.', $file_name));


    $extensions = ["jpeg", "jpg", "png"];

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This file extension is not allowed Only allowed files are follow as {jpeg, jpg, png}";
    }

    if ($file_size > 2097152) {
        $errors[] = "File size should be less than or equal to 2MB";
    }
    if (empty($errors)) {
        move_uploaded_file($file_tmp, "upload/{$file_name}");
    } else {
        print_r($errors);
        die();
    }
}
session_start();

$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
$cateogry = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d,M , Y");
$author =  $_SESSION['user_id'];

$sql = "INSERT INTO  post (title , description, category, post_date, author, post_img)
        VALUES('{$title}', '{$desc}', '{$cateogry}', '{$date}', '{$author}', '{$file_name}');";
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$cateogry}";
$result = mysqli_multi_query($conn, $sql);
if ($result) {
    header("Location: {$host_name}/admin/post.php");
} else {
    echo "<div class='alert alert-danger'>Sorry Your Query is failed </div>";
}
