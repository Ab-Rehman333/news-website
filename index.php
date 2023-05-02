<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    include "config.php";
                    // set the limit whatever we want to show on the  page 
                    $limit = 3;
                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];
                    } else {
                        $page = 1;
                    }

                    // applying formula for finding the offset offset = (pageId - 1) * limit {limit means what ever you set the limit it's up to you }
                    $offset = ($page - 1) * $limit;
                    $sql = "SELECT post.post_id , post.title, post.description,post.category,post.post_img,
                    post.post_date, category.category_name, user.username FROM post
                    LEFT JOIN  category ON post.category = category.category_id
                    LEFT JOIN  user     ON post.author   = user.user_id ORDER BY post.post_id 
                    DESC LIMIT {$offset}, {$limit}";
                    $result = mysqli_query($conn, $sql) or die("Error: mysql Query Failed");
                    if (mysqli_num_rows($result) > 0) {
                        $db_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    ?>
                        <div class="post-content">
                            <div class="row">
                                <?php foreach ($db_data as $row) : ?>

                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?= $row['post_id']; ?>"><img src="admin/upload/<?= $row['post_img']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?= $row['post_id']; ?>'><?= $row['title']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?= $row['category']; ?>'> <?= $row['category_name']; ?> </a>
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
                                            <p class="description">
                                                <?php if ($row['description']) {

                                                    echo substr($row['description'], 0, 200) . "...";
                                                } else {
                                                    $dummy =  "lorem ipsum dolor sit amet, consectetur admin is not okay 
                                                    lorem ipsum dolor sit amet, consectetur admin is not okay 
                                                    lorem ipsum dolor sit amet, consectetur admin is not okay 
                                                    lorem ipsum dolor sit amet, consectetur admin is not okay 
                                                    lorem ipsum dolor sit amet, consectetur admin is not okay 
                                                    lorem ipsum dolor sit amet, consectetur admin is not okay 
                                                    lorem ipsum dolor sit amet, consectetur admin is not okay 
                                                    lorem ipsum dolor sit amet, consectetur admin is not okay 
                                                    lorem ipsum dolor sit amet, consectetur admin is not okay 
                                                    lorem ipsum dolor sit amet, consectetur admin is not okay ";
                                                    echo substr($dummy, 0, 300) . "...";
                                                }
                                                ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?= $row['post_id']; ?>'>read more</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>


                    <?php
                    } else {
                        echo "<h3>No Records Found</h3>";
                    }
                    $sql_two = "SELECT * FROM post";
                    $result_two = mysqli_query($conn, $sql_two) or die("query failed in pagination");
                    if (mysqli_num_rows($result_two) > 0) :
                        // getting the total records length 
                        $total_records = mysqli_num_rows($result_two);
                        // applying the farmulaa to calculate the total pages    total = getFromDatabase / 3 
                        $total_pages = ceil($total_records / $limit);  // 3
                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo '<li><a  href="index.php?page=' . ($page - 1) . ' ">Pre</a></li>';
                        }
                        // loop throught them all the pages  and dispaly the results from specific limit values that we selected before
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                            echo '<li class="' . $active . '"><a href="index.php?page=' . $i . ' " > ' . $i . '</a></li>';
                        }
                        if ($total_pages > $page) {  // 3 > 2
                            echo '<li><a  href="index.php?page=' . ($page + 1) . ' ">Next</a></li>';
                        }

                        echo "</ul>";
                    ?>

                    <?php endif; ?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>