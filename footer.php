<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php

                include "config.php";



                $sql = "SELECT * FROM websitesetting";

                $result = mysqli_query($conn, $sql) or die("Error: mysql Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    $db_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($db_data as $row) :

                ?>
                        <span><?= $row['footer_desc']; ?></span>

                <?php
                    endforeach;
                } ?>
            </div>
        </div>
    </div>
</div>
</body>

</html>