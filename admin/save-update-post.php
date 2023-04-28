<?php

include "config.php";
if (empty($_FILES['new-image']['name'])) {
    $file_name = $_POST['old_image'];
} else {
    $errors = [];

    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp =  $_FILES['new-image']['tmp_name'];
    $file_type =  $_FILES['new-image']['type'];
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
$post_id = $_POST['post_id'];
$title =  $_POST['post_title'];
$postdesc =  $_POST['postdesc'];
$category =  $_POST['category'];




$sql = "UPDATE post SET title ='{$title}', description = '{$postdesct}', category = {$category} , post_img  = '{$file_name}' WHERE post_id ={$post_id} ";
$result = mysqli_query($conn, $sql) or die("query failed");

if ($result) {
    header("Location: {$host_name}/admin/post.php");
} else {
    echo "Query Failed";
}
