<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->
                <?php

                include "config.php";


                $post_id = $_GET['id'];
                $sql = "SELECT post.post_id , post.title, post.description,post.category,
                            post.post_date, post.post_img, category.category_name, user.username FROM post
                            LEFT JOIN  category ON post.category = category.category_id
                            LEFT JOIN  user     ON post.author   = user.user_id
                            WHERE post.post_id = {$post_id} ";

                $result = mysqli_query($conn, $sql) or die("Error: mysql Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    $db_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($db_data as $row) :
                ?>

                        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value="<?= $row['post_id'];  ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?= $row['title'];  ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Description</label>
                                <textarea name="postdesc" class="form-control" required rows="5">
                                <?= $row['description'];  ?>
                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <select class="form-control" name="category">
                                    <?php
                                    include "config.php";

                                    $sql1 = "SELECT *  FROM category";
                                    $result1 = mysqli_query($conn, $sql1) or die("Sorry select data");
                                    if (mysqli_num_rows($result1) > 0) {
                                        $arryDb1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
                                        foreach ($arryDb1 as $row1) {

                                            if ($row['category'] === $row1['category_id']) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo "<option {$selected} value='{$row1['category_id']}'>{$row1['category_name']}</option>";
                                        }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="file" name="new-image">
                                <img src="upload/<?= $row['post_img']; ?>" height="150px">
                                <input type="hidden" name="old_image" value="<?= $row['post_img']; ?>">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </form>

                <?php

                    endforeach;
                } else {
                    echo "Sorry Result Not Found";
                }
                ?>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>