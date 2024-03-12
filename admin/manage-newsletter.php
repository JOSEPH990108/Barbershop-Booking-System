<?php include('partials/header.php')?>

<!--Main Content Section Starts -->
<div class="main-content">
        <div class="wrapper">
            <h1>Manage Newsletter</h1>

            <br>
            
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

                if(isset($_SESSION['no-newsletter-found']))
                {
                    echo $_SESSION['no-newsletter-found'];
                    unset ($_SESSION['no-newsletter-found']);
                }
            ?>

            <br><br>

            <!-- Button to Add Main-->
            <a href="<?php echo SITEURL; ?>admin/add-newsletter.php" class="btn-primary">Add Newsletter</a>
            
            <br><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th style="width:15%">Title</th>
                    <th style="width:10%">Expiry Date</th>
                    <th style="width:30%">Content</th>
                    <th>Image</th>
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
                    $total_pages_sql = "SELECT COUNT(*) FROM tbl_newsletter";
                    $result = mysqli_query($conn,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $per_page_record);

                    //Create SQL Query to get all the news
                    $sql = "SELECT * 
                            FROM tbl_newsletter 
                            ORDER BY ndate, edate
                            LIMIT $offset, $per_page_record";
                    
                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    $idx=0;
                    if($count>0)
                    {
                        while($row = mysqli_fetch_assoc($res))
                        {
                            //get the value
                            $idx++;
                            $news_id = $row['news_id'];
                            $title = $row['title'];
                            $edate = $row['edate'];
                            $content = $row['content'];
                            $image = $row['image_name'];
                            $active = $row['active'];
                            
                            ?>
                    
                            <tr>
                                <td><?php echo $idx; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $edate; ?></td>
                                <td><?php echo $content; ?></td>
                                <td>
                                        <?php 
                                            //Check whether image name is available
                                            if($image!="")
                                            {
                                                //Display the image
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/newsletter/<?php echo $image; ?>" alt="" width="160px" height="200px">
                                                <?php
                                            }
                                            else
                                            {
                                                //Display the message
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                        ?>
                                </td>
                                <td><?php echo $active; ?></td>
                                <td>
                                <a href="<?php echo SITEURL; ?>admin/update-newsletter.php?news_id=<?php echo $news_id; ?>" class="btn-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-newsletter.php?news_id=<?php echo $news_id; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this newsletter?')">Delete</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {
                        //No Services
                        echo "<tr><td colspan='7' class='error'>No Newsletter Added Yet</td></tr>";
                    }
                ?>

            </table>
            <div class="pagination">
                <?php

                    $pagLink = "";

                    if($page>=2){   
                        echo "<a href='manage-newsletter.php?page=".($page-1)."'>  Prev </a>";   
                    }       
                               
                    for ($i=1; $i<=$total_pages; $i++) {   
                      if ($i == $page) {   
                          $pagLink .= "<a class = 'active' href='manage-newsletter.php?page="  
                                                            .$i."'>".$i." </a>";   
                      }               
                      else  {   
                          $pagLink .= "<a href='manage-newsletter.php?page=".$i."'>   
                                                            ".$i." </a>";     
                      }   
                    };     
                    echo $pagLink;   
              
                    if($page<$total_pages){   
                        echo "<a href='manage-newsletter.php?page=".($page+1)."'>  Next </a>";   
                    }

                ?>
            </div>   
        </div>
    </div>
    <!--Main Content Section Ends -->


<?php include('partials/footer.php')?>