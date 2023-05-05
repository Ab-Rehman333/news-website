<?php include "header.php"; ?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php

                include "config.php";


                
                $sql = "SELECT * FROM websitesetting";

                $result = mysqli_query($conn, $sql) or die("Error: mysql Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    $db_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($db_data as $row) :
                ?>
                        <!-- Form -->
                        <form action="save-post.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="post_title">WEBSITE name</label>
                                <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">website logo</label>
                                <input type="file" name="fileToUpload" required>
                                <img src="" height="150px">
                                <input type="hidden" name="old_logo">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Footer Description</label>
                                <textarea name="postdesc" class="form-control" rows="5" required></textarea>
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                        </form>
                <?php
                    endforeach;
                }
                ?>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>