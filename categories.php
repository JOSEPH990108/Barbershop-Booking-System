<?php include('partials-front/header.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
    <br><br>
        <div class="container">
            <h2 class="text-center"><strong>Explore Services</strong></h2>

            <?php

                //Display all the categories that are active
                //SQl QUery
                $sql ="SELECT * FROM tbl_category WHERE active='Yes'";
                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the rows
                $count = mysqli_num_rows($res);
                if($count>0)
                {
                    //Categories Available
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        $category_id = $rows['category_id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-services.php?category_id=<?php echo $category_id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name == "")
                                    {
                                        //Image not available

                                    }
                                    else
                                    {
                                        //Image available
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
                    //Categories not available
                    echo "<div class='error'>Category not available</div>";
                }
            ?>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php'); ?>