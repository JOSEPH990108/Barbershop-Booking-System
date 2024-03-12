<?php include('partials-front/header.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="service-search text-center">
    <br><br><br>
            <form action="<?php echo SITEURL; ?>service-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Service.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center"><strong>Explore Services</strong></h2>

            <?php 
                //Create SQL Query to display all categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' ORDER BY title LIMIT 3";
                //Execute the query
                $res = mysqli_query($conn, $sql);
                //Count the rows to check whether category is available or not
                $count = mysqli_num_rows($res);
                if($count>0)
                {
                    //Category available
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //Get the value from tbl_category
                        $category_id = $rows['category_id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        ?>

                            <a href="<?php echo SITEURL; ?>category-services.php?category_id=<?php echo $category_id; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                    //Check whether image is available or not
                                        if($image_name == "")
                                        {
                                            echo "<div class='error'>Image not available</div>";
                                        }
                                        else
                                        {
                                            //Image Available
                                            ?>

                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Picture" class="img-responsive img-curve">
                                            
                                            <?php
                                        }
                                    ?>
                                    <h3 class="float-text text-black"><?php echo $title; ?></h3>
                                </div>
                            </a>

                        <?php
                    }
                }
                else
                {
                    //Category not available
                    echo "<div class='error'>Category Not Added</div>";
                }
            ?>

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>categories.php"><b>See All</b></a>
        </p>

    </section>
    <!-- Categories Section Ends Here -->

    <!-- Service MEnu Section Starts Here -->
    <section class="service-menu">
        <div class="container">
            <h2 class="text-center"><strong>Services Menu</strong></h2>
            <br><br>
            
            <?php
            // Getting services from database that are active and featured
            //SQL QUery
            $sql1 = "SELECT * FROM tbl_service WHERE active='Yes' AND featured='Yes' ORDER BY category_id, title LIMIT 6";

            //Execute the Query
            $res1 = mysqli_query($conn, $sql1);

            //Count the rows 
            $count1 = mysqli_num_rows($res1);

            if($count1>0)
            {
                //Services available
                while($row=mysqli_fetch_assoc($res1))
                {
                    $service_id = $row['service_id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    ?>

                    <div class="service-menu-box">
                        <div class="service-menu-desc">
                            <h4><i><b><?php echo $title; ?></b></i></h4>
                            <p class="service-price">RM<?php echo $price; ?></p>
                            <p class="service-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <!--<a href="<?php echo SITEURL; ?>appointment.php?service_id=<?php echo $service_id; ?>" class="btn btn-primary">Book Now</a>-->
                        </div>
                    </div>

                    <?php
                }

            }
            else
            {
                //No services
                echo "<div class='error'>No services available</div>";
            }
            ?>

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>services.php"><b>See All</b></a>
        </p>
    </section>
    <!-- Service Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>