<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        include "config.php";
        // set the limit whatever we want to show on the  page 
        $limit = 3;


        $sql = "SELECT post.post_id , post.title, post.category,post.post_img,
                    post.post_date, category.category_name FROM post
                    LEFT JOIN  category ON post.category = category.category_id
                    ORDER By post.post_id DESC LIMIT  {$limit}";

        $result = mysqli_query($conn, $sql) or die("Error: mysql Query Failed in recent posts");
        if (mysqli_num_rows($result) > 0) {
            $db_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($db_data as $row) :


        ?>
                <div class="recent-post">
                    <a class="post-img" href="">
                        <img src="admin/upload/<?= $row['post_img']; ?>" alt="" />
                    </a>
                    <div class="post-content">
                        <h5><a href='single.php?id=<?= $row['post_id']; ?>'><?= $row['title']; ?></a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php?cid=<?= $row['category']; ?>'> <?= $row['category_name']; ?> </a>

                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?= $row['post_date']; ?>
                        </span>
                        <a class="read-more" href="single.php?id=<?= $row['post_id']; ?>">Read more</a>
                    </div>
                </div>
        <?php
            endforeach;
        } ?>

    </div>
    <!-- /recent posts box -->
</div>