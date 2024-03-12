<?php include('partials-front/header.php'); ?>
    <br><br><br><br><br>
    <h1 class="text-center"><strong>Appointment History</strong></h1>
    <section class="history">
        <div class="container1 text-black">
        <h5 class="text-left alert-danger">Note: Appointment cancellation or editing cannot be completed one day before the appointment date</h5>
            <table class="tbl-full">
                <thead>
                    <?php
                        if(isset($_SESSION['edit-success']))
                        {
                            echo  ($_SESSION['edit-success']);
                            unset ($_SESSION['edit-success']);
                        }
                        if(isset($_SESSION['edit-unsuccess']))
                        {
                            echo  ($_SESSION['edit-unsuccess']);
                            unset ($_SESSION['edit-unsuccess']);
                        }
                    ?>
                    <tr>
                        <th>S.N</th>
                        <th>Barber</th>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
    <?php
        $per_page_record = 5;

        // Look for a GET variable page if not found default is 1.        
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
        $page=1;    
        }
        
        $offset = ($page-1) * $per_page_record; 

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $datetoday = date('Y-m-d H:i:s');
        if(isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];

            $sql = "SELECT customer_id FROM tbl_customer WHERE username='$username'";

            $res = mysqli_query($conn, $sql);
           
            $count = mysqli_num_rows($res);
            
            if($count>0)
            {
                while($rows = mysqli_fetch_assoc($res))
                {
                        $customer_id = $rows['customer_id'];
                }
            }

            $total_pages_sql = "SELECT COUNT(*) FROM tbl_appointment WHERE customer_id = $customer_id";
            $result = mysqli_query($conn,$total_pages_sql) or die(mysqli_error($conn));
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = round($total_rows / $per_page_record);

            /*$sql = "SELECT * 
                    FROM tbl_appointment 
                    WHERE customer_id = $customer_id 
                    ORDER BY date AND timeslot
                    LIMIT $offset, $per_page_record";*/
            $sql2 = "SELECT a.timeslot AS Timeslot, a.date AS Date, CAST(SUBSTRING(a.timeslot, 1, 7)AS TIME) AS START, CAST(SUBSTRING(a.timeslot, 9, 7) AS TIME) AS END, CONCAT(ad.first_name, ' ', ad.last_name) AS Barber, s.title AS Title, s.price AS Price, a.isCancel AS Cancel
                     FROM ((tbl_appointment a
                     INNER JOIN tbl_admin ad ON a.barber_id = ad.barber_id)
                     INNER JOIN tbl_service s ON a.service_id = s.service_id)
                     WHERE customer_id = $customer_id
                     ORDER BY 
                     a.date DESC,
                     START
                     LIMIT $offset, $per_page_record";

            $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn)); 
            $count2 = mysqli_num_rows($res2);
            $idx=0;

            if($count2==0)
            {
                echo "<div class='alert alert-danger'><strong>No appointments history</strong></div>";
            }
            else
            {
                while($row=mysqli_fetch_array($res2))
                {
                    $idx++;
                    $barber = $row['Barber'];
                    $service = $row['Title'];
                    $price = $row['Price'];
                    $date = $row['Date'];
                    $timeslot = $row['Timeslot'];
                    $start = $row['START'];
                    $end = $row['END'];
                    $isCancel = $row['Cancel'];
                    $datetime = date('Y-m-d H:i:s', strtotime("$date $end"));
                    $datetimes = date('Y-m-d H:i:s', strtotime("$date $start"));

                    ?>
                        <tr>
                            <td><?php echo $idx; ?></td>
                            <td><?php echo $barber; ?></td>
                            <td><?php echo $service; ?></td>
                            <td>RM<?php echo $price; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $start; ?></td>
                            <td><?php echo $end; ?></td>
                            <td><?php 
                                    if($isCancel=='No'&& $datetime >= $datetoday)
                                    {
                                        echo "<div class='alert-success'><strong>Pending</strong></div>";
                                    } 
                                    else if($isCancel=='No'&& $datetime < $datetoday)
                                    {
                                        echo "<div class='alert-success'><strong>Done</strong></div>";
                                    }
                                    else if($isCancel=='Yes')
                                    {
                                        echo "<div class='alert-danger'><strong>Cancelled</strong></div>";
                                    } 
                                ?>
                            </td>
                            <td>
                                <?php
                                    $prev_date = date('Y-m-d H:m:s', strtotime($datetimes .' -1 day'));
                        
                                    if($prev_date > $datetoday && $isCancel=='No')
                                    {
                                        ?>
                                            <a href="<?php echo SITEURL; ?>edit_appointment.php?customer_id=<?php echo $customer_id; ?>&date=<?php echo $date; ?>&timeslot=<?php echo $timeslot; ?>" class="btn btn-success">EDIT</a>
                                            <a href="<?php echo SITEURL; ?>cancel_appointment.php?customer_id=<?php echo $customer_id; ?>&date=<?php echo $date; ?>&timeslot=<?php echo $timeslot; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?');">CANCEL</a>
                                        <?php
                                    } 

                                ?> 
                            </td>
                            <?php
                }
            }
            ?>
                        </tr>
                    </table>
                    <br><br>
                    <div class="pagination">
                <?php

                    $pagLink = "";

                    if($page>=2){   
                        echo "<a href='history.php?page=".($page-1)."'>  Prev </a>";   
                    }       
                               
                    for ($i=1; $i<=$total_pages; $i++) {   
                      if ($i == $page) {   
                          $pagLink .= "<a class = 'active' href='history.php?page="  
                                                            .$i."'>".$i." </a>";   
                      }               
                      else  {   
                          $pagLink .= "<a href='history.php?page=".$i."'>   
                                                            ".$i." </a>";     
                      }   
                    };     
                    echo $pagLink;   
              
                    if($page<$total_pages){   
                        echo "<a href='history.php?page=".($page+1)."'>  Next </a>";   
                    }

                ?>
            </div> 
                </div>
            </section>
          <?php  
        }
        else
        {
            header('location:'.SITEURL.'signin.php');
        }
        ?>
    </body>
</html>