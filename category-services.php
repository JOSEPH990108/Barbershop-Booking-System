<?php include('partials-front/header.php'); ?>

    <?php
        //Check the category id is pass or not
        if(isset($_GET['category_id']))
        {
            //Category id is set and get the id
            $category_id = $_GET['category_id'];
            //Get the Category title based on category_id
            $sql = "SELECT title FROM tbl_category WHERE category_id=$category_id";
            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Get the value from database
            $row = mysqli_fetch_assoc($res);

            $category_title = $row['title'];
        }
        else
        {
            //Category not pass
            //Redirect to home page
            header('location:'.SITEURL);
        }

    ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="service-search text-center">
    <br><br><br><br>
        <div class="container">
            
            <h2 class='text-white'>Services on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="service-menu">
        <div class="container">
            <h2 class="text-center">Service Menu</h2>
            <br><br>
            <?php

                //Create SQL QUery to get services based on category_id
                $sql1 = "SELECT * FROM tbl_service WHERE category_id=$category_id";

                //Execute the query
                $res1 = mysqli_query($conn, $sql1);

                $count = mysqli_num_rows($res1);

                if($count>0)
                {
                    //Services available
                    while($row1=mysqli_fetch_assoc($res1))
                    {
                        $service_id = $row1['service_id'];
                        $title = $row1['title'];
                        $price = $row1['price'];
                        $description = $row1['description'];
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
                    //Services not available
                    echo "<div class='error'>Service not available</div>";
                }
            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>