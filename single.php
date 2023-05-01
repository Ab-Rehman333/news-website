<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                include "config.php";
                // set the limit whatever we want to show on the  page 

                $post_id = $_GET['id'];
                // applying formula for finding the offset offset = (pageId - 1) * limit {limit means what ever you set the limit it's up to you }

                $sql = "SELECT post.post_id , post.title, post.description,post.category,post.post_img,
                    post.post_date, category.category_name, user.username FROM post
                    LEFT JOIN  category ON post.category = category.category_id
                    LEFT JOIN  user     ON post.author   = user.user_id  WHERE post.post_id = {$post_id} ";
                $result = mysqli_query($conn, $sql) or die("Error: mysql Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    $db_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

                ?>
                    <div class="post-container">
                        <?php foreach ($db_data as $row) : ?>

                            <div class="post-content single-post">
                                <h3>Lorem ipsum dolor sit amet, consectetur</h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <?= $row['category_name']; ?>
                                    </span>
                                    <span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <a href='author.php'><?= $row['username']; ?></a>
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?= $row['post_date']; ?>
                                    </span>
                                </div>
                                <img class="single-feature-image" src="admin/upload/<?= $row['post_img']; ?>" alt="" />
                                <p class="description">
                                    <?php if ($row['description']) {

                                        echo   $row['description'];
                                    } else {
                                        echo "lorem ipsum dolor sit amet, consectetur admin is not okay 
                                            lorem ipsum dolor sit amet, consectetur admin is not okay 
                                            lorem ipsum dolor sit amet, consectetur admin is not okay 
                                            lorem ipsum dolor sit amet, consectetur admin is not okay 
                                            lorem ipsum dolor sit amet, consectetur admin is not okay 
                                            lorem ipsum dolor sit amet, consectetur admin is not okay 
                                            lorem ipsum dolor sit amet, consectetur admin is not okay 
                                            lorem ipsum dolor sit amet, consectetur admin is not okay 
                                            lorem ipsum dolor sit amet, consectetur admin is not okay 
                                            lorem ipsum dolor sit amet, consectetur admin is not okay ";
                                    }
                                    ?>
                                </p>
                            </div>
                        <?php endforeach; ?>

                    </div>
                <?php } ?>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>