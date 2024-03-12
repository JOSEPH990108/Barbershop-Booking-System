<?php include('partials-front/header.php'); ?>

    <br>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="service-search text-center">
        <div class="container">
            <?php

                //Get the search keyword
                $search = $_POST['search'];

            ?>
            <br><br>
            <h2 class="text-white">Services on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="service-menu">
        <div class="container">
            <h2 class="text-center">Service Menu</h2>
            <br><br>
            <?php

                //SQL Query to get foods based on search keyword
                $sql = "SELECT * FROM tbl_service WHERE title LIKE '%$search%' AND active='Yes' ORDER BY title";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Service available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details
                        $service_id = $row['service_id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        ?>

                            <div class="service-menu-box">
                                <div class="service-menu-desc">
                                    <h4><b><i><?php echo $title; ?></b></i></h4>
                                    <p class="service-price">RM<?php echo $price; ?></p>
                                    <p class="service-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>
                                </div>
                            </div>

                        <?php
                    }
                }
                else
                {
                    //Service no available
                    echo "<div class='error'>Service no available</div>";
                }

            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>