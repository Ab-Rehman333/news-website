<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
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

                    $sql = "SELECT * FROM category  ORDER BY category_id DESC  LIMIT {$offset}, {$limit}";
                    $result = mysqli_query($conn, $sql) or die("Querry couldn't connect to database");
                    $db_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    if (mysqli_num_rows($result) > 0) :

                    ?>
                        <thead>
                            <th>S.No.</th>
                            <th>Category Name</th>
                            <th>No. of Posts</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php foreach ($db_array as $row) : ?>

                                <tr>
                                    <td class='id'><?= $row['category_id'] ?></td>
                                    <td><?= $row['category_name'] ?></td>
                                    <td><?= $row['post'] ?></td>
                                    <td class='edit'><a href='update-category.php?id=<?= $row['category_id']; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-category.php?id=<?= $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                </table>

                <?php
                        $sql_two = "SELECT * FROM category";
                        $result_two = mysqli_query($conn, $sql_two) or die("query failed in pagination");
                        if (mysqli_num_rows($result_two) > 0) :
                            // getting the total records length 
                            $total_records = mysqli_num_rows($result_two);
                            // applying the farmulaa to calculate the total pages    total = getFromDatabase / 3 
                            $total_pages = ceil($total_records / $limit);  // 3
                            echo "<ul class='pagination admin-pagination'>";
                            if ($page > 1) {
                                echo '<li><a  href="category.php?page=' . ($page - 1) . ' ">Pre</a></li>';
                            }
                            // loop throught them all the pages  and dispaly the results from specific limit values that we selected before
                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo '<li class="' . $active . '"><a href="category.php?page=' . $i . ' " > ' . $i . '</a></li>';
                            }
                            if ($total_pages > $page) {  // 3 > 2
                                echo '<li><a  href="category.php?page=' . ($page + 1) . ' ">Next</a></li>';
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