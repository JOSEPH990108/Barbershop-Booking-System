<?php 
    include("../config/constants.php"); 
    
    //Check whether the category_id and image_name value is set or not
    if(isset($_GET['news_id']))
    {
        //Process to delete
        //1. Get service_id and image name
        $news_id = $_GET['news_id'];

        //3. Delete service from database
        $sql = "DELETE FROM tbl_newsletter WHERE news_id = $news_id";

        $res = mysqli_query($conn, $sql);

        //Check Query executed or not
        //4. Redirect to Manage food with session message
        if($res==TRUE)
        {
            //service deleted
            $_SESSION['delete'] = "<div class='success'>Newsletter Delete Successfully</div>";
            header('location:'.SITEURL.'admin/manage-newsletter.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Newsletter Delete Unsuccessfully</div>";
            header('location:'.SITEURL.'admin/manage-newsletter.php');
        }
    }
    else
    {
        //Redirect to Manage service page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
        header('location:'.SITEURL.'admin/manage-newsletter.php');
    }

?>