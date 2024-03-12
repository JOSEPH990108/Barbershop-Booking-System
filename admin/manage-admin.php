<?php include('partials/header.php')?>

    <!--Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Administrator </h1>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //Displaying Session message
                    unset($_SESSION['add']); //Removing Session message
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update']; //Displaying Session message
                    unset($_SESSION['update']); //Removing Session message
                }

                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found']; //Displaying Session message
                    unset($_SESSION['user-not-found']); //Removing Session message
                }
                
                if(isset($_SESSION['pass-not-match']))
                {
                    echo $_SESSION['pass-not-match']; //Displaying Session message
                    unset($_SESSION['pass-not-match']); //Removing Session message
                }

                if(isset($_SESSION['changed-pwd']))
                {
                    echo $_SESSION['changed-pwd']; //Displaying Session message
                    unset($_SESSION['changed-pwd']); //Removing Session message
                }
            ?>
            
            <br><br>

            <!-- Button to Add Main-->
            <a href="<?php echo SITEURL; ?>admin/add-admin.php" class="btn-primary">Add Admin</a>
            
            <br><br><br>
            
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>IC</th>
                    <th>Gender</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
                
                <?php
                    $per_page_record = 7;

                    // Look for a GET variable page if not found default is 1.        
                    if (isset($_GET["page"])) {    
                       $page  = $_GET["page"];    
                    }    
                    else {    
                        $page=1;    
                    }
                   
                    $offset = ($page-1) * $per_page_record; 
                    $total_pages_sql = "SELECT COUNT(*) FROM tbl_admin";
                    $result = mysqli_query($conn,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $per_page_record); 

                    //Query to get all admin
                    $sql = "SELECT * 
                            FROM tbl_admin 
                            ORDER BY first_name, last_name
                            LIMIT $offset, $per_page_record";

                    //Execute the Query
                    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    //Check whether they Query is Execute
                    if($res==TRUE)
                    {
                        //Count rows to check whether we have data inside database or not
                        $count = mysqli_num_rows($res);//Function to get all the rows from database
                        $idx=1;
                        //Check the num of rows
                        if($count>0)
                        {
                            //Having at least one data inside database
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //Using while loop to fetch all the data
                                //Get individual data
                                $barber_id = $rows['barber_id'];
                                $first_name = $rows['first_name'];
                                $last_name = $rows['last_name'];
                                $username = $rows['username'];
                                $gender = $rows['gender'];
                                $ic = $rows['ic'];
                                $phone_number = $rows['phone_number']

                                //Display the Values in Table
                                ?>

                                <tr>
                                    <td><?php echo $idx++; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td><?php echo $first_name; ?></td>
                                    <td><?php echo $last_name; ?></td>
                                    <td><?php echo $ic; ?></td>
                                    <td><?php echo $gender; ?></td>
                                    <td><?php echo $phone_number; ?></td>
                                    <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?barber_id=<?php echo $barber_id; ?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?barber_id=<?php echo $barber_id; ?>" class="btn-secondary">Update</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?barber_id=<?php echo $barber_id; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this Admin?');">Delete</a>
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
                                <td colspan="8"><div class="class error">No Admin Added</div></td>
                            </tr>

                            <?php
                        }
                    }
                ?>

            </table>
            <div class="pagination">
                <?php

                    $pagLink = "";

                    if($page>=2){   
                        echo "<a href='manage-admin.php?page=".($page-1)."'>  Prev </a>";   
                    }       
                               
                    for ($i=1; $i<=$total_pages; $i++) {   
                      if ($i == $page) {   
                          $pagLink .= "<a class = 'active' href='manage-admin.php?page=".$i."'>".$i." </a>";   
                      }               
                      else  {   
                          $pagLink .= "<a href='manage-admin.php?page=".$i."'>".$i." </a>";     
                      }   
                    };     
                    echo $pagLink;   
              
                    if($page<$total_pages){   
                        echo "<a href='manage-admin.php?page=".($page+1)."'>  Next </a>";   
                    }


                ?>
            </div>     
        </div>
    </div>
    <!--Main Content Section Ends -->

<?php include('partials/footer.php')?>