<?php include('partials/header.php')?>

<!--Main Content Section Starts -->
<div class="main-content">
        <div class="wrapper">
        <h1>Appointments</h1>
        <br />
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Customer</th>
                    <th>Service</th>
                    <th>Barber</th>
                    <th>Date</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                </tr>
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

                    $total_pages_sql = "SELECT COUNT(*) FROM tbl_appointment";
                    $result = mysqli_query($conn,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $per_page_record);

                    date_default_timezone_set("Asia/Kuala_Lumpur");
                    $datetoday = date('Y-m-d H:i:s');
                    
                    $sql = "SELECT a.date AS Date, CAST(SUBSTRING(a.timeslot, 1, 7)AS TIME) AS START, CAST(SUBSTRING(a.timeslot, 9, 7) AS TIME) AS END, CONCAT(c.first_name, ' ', c.last_name) AS Customer, CONCAT(ad.first_name, ' ', ad.last_name) AS Barber, s.title AS Title, a.isCancel AS Cancel
                            FROM (((tbl_appointment a
                            INNER JOIN tbl_customer c ON a.customer_id = c.customer_id)
                            INNER JOIN tbl_admin ad ON a.barber_id = ad.barber_id)
                            INNER JOIN tbl_service s ON a.service_id = s.service_id)
                            ORDER BY 
                            a.date DESC,
                            START
                            LIMIT $offset, $per_page_record";
                            
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    if($count > 0){
                    $idx = 0;
                        //We have data in database
                        //Get the data and display
                        while($rows=mysqli_fetch_array($res)){
                            $idx++;
                            $customer = $rows['Customer'];
                            $barber = $rows['Barber'];
                            $title = $rows['Title'];
                            $date = $rows['Date'];
                            $start = $rows['START'];
                            $end = $rows['END'];
                            $isCancel = $rows['Cancel'];

                            $datetime = date('Y-m-d H:i:s', strtotime("$date $end"));
                            
                ?>
                <tr>
                    <td><?php echo $idx; ?></td>
                    <td><?php echo $customer; ?></td>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $barber; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $start; ?></td>
                    <td><?php echo $end; ?></td>
                    <td>
                        <?php 
                            if($isCancel=='No' && ($datetime < $datetoday)){
                                echo "<div class='success'><strong>Done</strong></div>";
                            }
                            else if($isCancel=='No' && $datetime >= $datetoday){
                                echo "<div class='success'><strong>Pending</strong></div>";
                            }
                            else if($isCancel=='Yes'){
                                echo "<div class='error'><strong>Cancelled</strong></div>";
                            }
                        ?>
                    </td>
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
                        echo "<a href='manageappt.php?page=".($page-1)."'>  Prev </a>";   
                    }       
                               
                    for ($i=1; $i<=$total_pages; $i++) {   
                      if ($i == $page) {   
                          $pagLink .= "<a class = 'active' href='manageappt.php?page="  
                                                            .$i."'>".$i." </a>";   
                      }               
                      else  {   
                          $pagLink .= "<a href='manageappt.php?page=".$i."'>   
                                                            ".$i." </a>";     
                      }   
                    };     
                    echo $pagLink;   
              
                    if($page<$total_pages){   
                        echo "<a href='manageappt.php?page=".($page+1)."'>  Next </a>";   
                    }

                ?>
            </div> 
        </div>
    </div>
    
    <!--Main Content Section Ends -->

<?php include('partials/footer.php')?>