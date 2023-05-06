<?php include "header.php"; ?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <?php

                include "config.php";



                $sql = "SELECT * FROM websitesetting";

                $result = mysqli_query($conn, $sql) or die("Error: mysql Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    $db_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                ?>
                    <!-- Form -->
                    <form action="save-setting.php" method="POST" enctype="multipart/form-data">
                        <?php
                        foreach ($db_data as $row) :

                        ?>
                            <div class="form-group">
                                <label for="post_title">website Title</label>
                                <input type="text" name="website_name" class="form-control" value="<?= $row['websitename']; ?>" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">website logo</label>
                                <input type="file"  name="logo" required>
                                <img src="../images/<?= $row['logo']; ?>" height="150px">
                                <input type="hidden" name="old_logo">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Footer Description </label>
                                <textarea name="footer_desc" class="form-control" rows="5" required><?= $row['footer_desc']; ?></textarea>
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                        <?php
                        endforeach;

                        ?>
                    </form>
                <?php
                }
                ?>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>