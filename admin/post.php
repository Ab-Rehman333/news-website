<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
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

                if ($_SESSION['user_role'] == "1") {
                    $sql = "SELECT post.post_id , post.title, post.description,post.category,
                            post.post_date, category.category_name, user.username FROM post
                            LEFT JOIN  category ON post.category = category.category_id
                            LEFT JOIN  user     ON post.author   = user.user_id ORDER BY post.post_id 
                            DESC LIMIT {$offset}, {$limit}";
                } else if ($_SESSION['user_role'] == "0") {
                    // for normal user 
                    $sql = "SELECT post.post_id , post.title, post.description, post.category,
                            post.post_date, category.category_name, user.username FROM post
                            LEFT JOIN  category ON post.category = category.category_id
                            LEFT JOIN  user     ON post.author   = user.user_id
                            WHERE post.author = {$_SESSION['user_id']}
                            ORDER BY post.post_id 
                            DESC LIMIT {$offset}, {$limit}";
                }

                $result = mysqli_query($conn, $sql) or die("Error: mysql Query Failed");
                if (mysqli_num_rows($result) > 0) :
                    $db_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php foreach ($db_data as $row) : ?>

                                <tr>
                                    <td class='id'><?= $row['post_id'] ?></td>
                                    <td><?= $row['title'] ?></td>
                                    <td><?= $row['category_name'] ?></td>
                                    <td><?= $row['post_date'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td class='edit'><a href='update-post.php?id=<?= $row['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?id=<?= $row['post_id'] ?>&catid=<?= $row['category'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                    <?php
                    $sql_two = "SELECT * FROM post";
                    $result_two = mysqli_query($conn, $sql_two) or die("query failed in pagination");
                    if (mysqli_num_rows($result_two) > 0) :
                        // getting the total records length 
                        $total_records = mysqli_num_rows($result_two);
                        // applying the farmulaa to calculate the total pages    total = getFromDatabase / 3 
                        $total_pages = ceil($total_records / $limit);  // 3
                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo '<li><a  href="post.php?page=' . ($page - 1) . ' ">Pre</a></li>';
                        }
                        // loop throught them all the pages  and dispaly the results from specific limit values that we selected before
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                            echo '<li class="' . $active . '"><a href="post.php?page=' . $i . ' " > ' . $i . '</a></li>';
                        }
                        if ($total_pages > $page) {  // 3 > 2
                            echo '<li><a  href="post.php?page=' . ($page + 1) . ' ">Next</a></li>';
                        }

                        echo "</ul>";
                    ?>

                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>