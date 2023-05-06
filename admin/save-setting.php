<?php

include "config.php";
if (empty($_FILES['logo']['name'])) {
    $file_name = $_POST['old_logo'];
} else {
    $errors = [];

    $file_name = $_FILES['logo']['name'];

    $file_size = $_FILES['logo']['size'];
    $file_tmp =  $_FILES['logo']['tmp_name'];
    $file_type =  $_FILES['logo']['type'];
    $exp = explode('.', $file_name);
    $file_ext = end($exp);


    $extensions = ["jpeg", "jpg", "png"];

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This file extension is not allowed Only allowed files are follow as {jpeg, jpg, png}";
    }

    if ($file_size > 2097152) {
        $errors[] = "File size should be less than or equal to 2MB";
    }
    if (empty($errors)) {
        move_uploaded_file($file_tmp, "../images/" .$file_name);
    } else {
        print_r($errors);
        die();
    }
}

$title =  $_POST['website_name'];
$footer_desc =  $_POST['footer_desc'];





$sql = "UPDATE websitesetting SET websitename ='{$title}',  logo = '{$file_name}', footer_desc = '{$footer_desc}' ";
$result = mysqli_query($conn, $sql) ;

if ($result) {
    header("Location: {$host_name}/admin/setting.php");
} else {
    echo "Query Failed";
}
