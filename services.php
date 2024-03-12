<?php include('partials-front/header.php'); ?>

    <!-- Service sEARCH Section Starts Here -->
    <section class="service-search text-center">
    <br><br><br>
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>service-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for service.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Service sEARCH Section Ends Here -->



    <!-- Service MEnu Section Starts Here -->
    <section class="service-menu">
        <div class="container">
            <h2 class="text-center"><strong>Service Menu</strong></h2>
            <br><br>
            <?php
                //Display service that active 
                //SQL QUery
                $sql = "SELECT * FROM tbl_service WHERE active='Yes' ORDER BY category_id, title";

                //Execute the query
                $res = mysqli_query($conn, $sql);
                
                //Count rows
                $count = mysqli_num_rows($res);

                //Check whether the services are available
                if($count>0)
                {
                    //Services available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $service_id = $row['service_id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        ?>
                                <div class="service-menu-box">
                                    <div class="service-menu-desc">
                                        <h4><i><b><?php echo $title; ?></b></i></h4>
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
                    //Service not available
                    echo "<div class='error'>No service available</div>";                
                }
                ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>