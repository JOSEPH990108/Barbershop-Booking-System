<?php include('partials/header.php')?>

<!--Main Content Section Starts -->
<div class="main-content">
        <div class="wrapper">
            <h1>Manage Categories</h1>

            <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Displaying Session message
                        unset($_SESSION['add']); //Removing Session message
                    }

                    if(isset($_SESSION['remove']))
                    {
                        echo $_SESSION['remove']; //Displaying Session message
                        unset($_SESSION['remove']); //Removing Session message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete']; //Displaying Session message
                        unset($_SESSION['delete']); //Removing Session message
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update']; //Displaying Session message
                        unset($_SESSION['update']); //Removing Session message
                    }

                    if(isset($_SESSION['no-category-found']))
                    {
                        echo  ($_SESSION['no-category-found']);
                        unset ($_SESSION['no-category-found']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo  ($_SESSION['upload']);
                        unset ($_SESSION['upload']);
                    }

                    if(isset($_SESSION['failed-remove']))
                    {
                        echo  ($_SESSION['failed-remove']);
                        unset ($_SESSION['failed-remove']);
                    }
            ?>

            <br><br>

            <!-- Button to Add Main-->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            
            <br><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $per_page_record = 2;

                    // Look for a GET variable page if not found default is 1.        
                    if (isset($_GET["page"])) {    
                       $page  = $_GET["page"];    
                    }    
                    else {    
                        $page=1;    
                    }
                   
                    $offset = ($page-1) * $per_page_record; 
                    $total_pages_sql = "SELECT COUNT(*) FROM tbl_category";
                    $result = mysqli_query($conn,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $per_page_record);
                    //Query to get all data from table category
                    $sql = "SELECT * 
                            FROM tbl_category 
                            ORDER BY title
                            LIMIT $offset, $per_page_record";

                    //Execute Qeury'
                    $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));

                    //Count the rows
                    $count = mysqli_num_rows($res);
                    $idx = 0;
                    //Check whether we have data in database
                    if($count>0)
                    {
                        //We have data in database
                        //Get the data and display
                        while($rows=mysqli_fetch_array($res))
                        {
                            $idx++;
                            $category_id = $rows['category_id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];

                            ?>
                                <tr>
                                    <td><?php echo $idx; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                            //Check whether image name is available
                                            if($image_name!="")
                                            {
                                                //Display the image
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" width="160px" height="200px">
                                                <?php
                                            }
                                            else
                                            {
                                                //Display the message
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?category_id=<?php echo $category_id; ?>" class="btn-secondary">Update</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?category_id=<?php echo $category_id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                                    </td>
                                </tr>
                            <?php
                        }

                    }
                    else
                    {
                        //We do not have data in database
                        //Display the message inside table
                        ?>

                        <tr>
                            <td colspan="6"><div class="class error">No Category Added</div></td>
                        </tr>

                        <?php
                    }

                ?>
            </table>
            <div class="pagination">
                <?php

                    $pagLink = "";

                    if($page>=2){   
                        echo "<a href='manage-category.php?page=".($page-1)."'>  Prev </a>";   
                    }       
                               
                    for ($i=1; $i<=$total_pages; $i++) {   
                      if ($i == $page) {   
                          $pagLink .= "<a class = 'active' href='manage-category.php?page=".$i."'>".$i." </a>";   
                      }               
                      else  {   
                          $pagLink .= "<a href='manage-category.php?page=".$i."'>".$i." </a>";     
                      }   
                    };     
                    echo $pagLink;   
              
                    if($page<$total_pages){   
                        echo "<a href='manage-category.php?page=".($page+1)."'>  Next </a>";   
                    }


                ?>
            </div>    
        </div>
    </div>
    <!--Main Content Section Ends -->

<?php include('partials/footer.php')?>