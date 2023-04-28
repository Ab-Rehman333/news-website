<?php include "header.php";
include "config.php";
if($_SESSION['user_role'] == "0"){
    header("Location: {$host_name}/post.php/");
}
 ?>
<?php
if (isset($_POST['sumbit'])) {
    $user_id = $_GET['id'];
    $cat_name = $_POST['cat_name'];


    $sql = "UPDATE category SET category_name = '{$cat_name}' WHERE category_id = {$user_id} ";
    $result = mysqli_query($conn, $sql) or die("Sorry can't select data");
    if ($result) {
        header("Location: {$host_name}/admin/category.php");
    }
}

?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
              <?php
                $user_id = $_GET['id'];

                $sql_one = "SELECT * FROM category WHERE category_id = {$user_id}";
                $result_one = mysqli_query($conn, $sql_one) or die("Query Failed ");
                if (mysqli_num_rows($result_one) > 0) {
                    $db_array = mysqli_fetch_all($result_one, MYSQLI_ASSOC);
                    foreach ($db_array as $row) :
                ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?= $row['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?= $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                  endforeach;
                }
                  
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
