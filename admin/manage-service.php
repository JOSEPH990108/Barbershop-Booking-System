<?php include('partials/header.php')?>

<!--Main Content Section Starts -->
<div class="main-content">
        <div class="wrapper">
            <h1>Manage Services</h1>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset ($_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                }

                if(isset($_SESSION['updated']))
                {
                    echo $_SESSION['updated'];
                    unset ($_SESSION['updated']);
                }

                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset ($_SESSION['remove']);
                }

                if(isset($_SESSION['failed-remove']))
                {
                    echo $_SESSION['failed-remove'];
                    unset ($_SESSION['failed-remove']);
                }

                if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];
                    unset ($_SESSION['unauthorize']);
                }

                if(isset($_SESSION['no-service-found']))
                {
                    echo $_SESSION['no-service-found'];
                    unset ($_SESSION['no-service-found']);
                }
            ?>

            <br><br>

            <!-- Button to Add Main-->
            <a href="<?php echo SITEURL; ?>admin/add-service.php" class="btn-primary">Add Service</a>
            
            <br><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th style="width:35%">Description</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $per_page_record = 4;

                    // Look for a GET variable page if not found default is 1.        
                    if (isset($_GET["page"])) {    
                       $page  = $_GET["page"];    
                    }    
                    else {    
                        $page=1;    
                    }
                   
                    $offset = ($page-1) * $per_page_record; 
                    $total_pages_sql = "SELECT COUNT(*) FROM tbl_service";
                    $result = mysqli_query($conn,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $per_page_record);

                    //Create SQL Query to get all the food
                    $sql = "SELECT * 
                            FROM tbl_service 
                            ORDER BY category_id, title
                            LIMIT $offset, $per_page_record";

                    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    $count = mysqli_num_rows($res);
                    $idx=0;
                    if($count>0)
                    {
                        while($row = mysqli_fetch_array($res))
                        {
                            //get the value
                            $idx++;
                            $service_id = $row['service_id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $description = $row['description'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            
                            ?>
                    
                            <tr>
                                <td><?php echo $idx; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $description; ?></td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                <a href="<?php echo SITEURL; ?>admin/update-service.php?service_id=<?php echo $service_id; ?>" class="btn-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-service.php?service_id=<?php echo $service_id; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {
                        //No Services
                        echo "<tr><td colspan='7' class='error'>No Services Added Yet</td></tr>";
                    }
                ?>

            </table>
            <div class="pagination">
                <?php

                    $pagLink = "";

                    if($page>=2){   
                        echo "<a href='manage-service.php?page=".($page-1)."'>  Prev </a>";   
                    }       
                               
                    for ($i=1; $i<=$total_pages; $i++) {   
                      if ($i == $page) {   
                          $pagLink .= "<a class = 'active' href='manage-service.php?page="  
                                                            .$i."'>".$i." </a>";   
                      }               
                      else  {   
                          $pagLink .= "<a href='manage-service.php?page=".$i."'>   
                                                            ".$i." </a>";     
                      }   
                    };     
                    echo $pagLink;   
              
                    if($page<$total_pages){   
                        echo "<a href='manage-service.php?page=".($page+1)."'>  Next </a>";   
                    }

                ?>
            </div>  
        </div>
    </div>
    <!--Main Content Section Ends -->


<?php include('partials/footer.php')?>