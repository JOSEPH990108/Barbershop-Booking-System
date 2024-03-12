<?php
    include("config/constants.php");
    
    if(isset($_SESSION['username']))
    {
        $user = $_SESSION['username'];                          
    }
        
        if(isset($_GET['customer_id'])&&isset($_GET['date'])&&isset($_GET['timeslot']))
        {
            $customer_id = $_GET['customer_id'];
            $date = $_GET['date'];
            $timeslot = $_GET['timeslot'];
            
            $sql = "UPDATE tbl_appointment SET isCancel = 'Yes' WHERE customer_id = $customer_id AND date = '$date' AND timeslot = '$timeslot'";

            $res = mysqli_query($conn, $sql);
            
            if($res==TRUE)
            {
                header('location:'.SITEURL.'history.php');
            }
        }

?>