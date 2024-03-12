<?php 
    include("../config/constants.php"); 
    
    //Check whether the category_id and image_name value is set or not
    if(isset($_GET['service_id']))
    {
        //Process to delete
        //1. Get service_id and image name
        $service_id = $_GET['service_id'];

        //3. Delete service from database
        $sql = "DELETE FROM tbl_service WHERE service_id = $service_id";

        $res = mysqli_query($conn, $sql);

        //Check Query executed or not
        //4. Redirect to Manage food with session message
        if($res==TRUE)
        {
            //service deleted
            $_SESSION['delete'] = "<div class='success'>Service Delete Successfully</div>";
            header('location:'.SITEURL.'admin/manage-service.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Service Delete Unsuccessfully</div>";
            header('location:'.SITEURL.'admin/manage-service.php');
        }
    }
    else
    {
        //Redirect to Manage service page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
        header('location:'.SITEURL.'admin/manage-service.php');
    }

?>