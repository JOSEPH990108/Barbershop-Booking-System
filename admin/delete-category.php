<?php
    include("../config/constants.php");
    //echo "Delete Page";
    //Check whether the category_id and image_name value is set or not
    if(isset($_GET['category_id']) AND isset($_GET['image_name']))
    {
        //Get the Value and Delete
        //echo "Get Value and Delete";
        $category_id = $_GET['category_id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file is exist
        if($image_name != "")
        {
            //Image exist, get the path
            $path = "../images/category/".$image_name;
            //Remove the image
            $remove = unlink($path);
            
            //If failed to remove image, then add an error message and stop the process
            if($remove==FALSE)
            {
                //Set the Session message
                $_SESSION['remove'] = "<div class='error'>Fail to Remove Category Image</div>";
                //Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the process
                die();
            }
        }
        //Delete the data from database
        //SQL Query to Delete data from database
        $sql = "DELETE FROM tbl_category WHERE category_id = $category_id";
        
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the data is removed from the database
        if($res==TRUE)
        {
            //Set Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>"; 
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Set Fail Message and Redirect
            $_SESSION['delete'] = "<div class='error'>Category Deleted Unsuccessfully</div>"; 
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        //Redirect to manage category page and error message
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>