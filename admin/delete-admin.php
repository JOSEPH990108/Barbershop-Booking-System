<?php 
    //Include constants.php file
    include('../config/constants.php');

    //1. Get the ID of Admin to be deleted
    $barber_id = $_GET['barber_id'];
    //2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE barber_id=$barber_id";

    //Execute the Query
    $res = mysqli_query($conn,$sql);

    //Check whether the Query executed successfully or not
    if($res==TRUE)
    {
        //Query executed successfully & Admin deleted
        //echo "Admin Deleted";
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to delete admin
        //echo "Failed to Delete Admin";
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    //3. Redirect to the Manage Admin Page with message (success/fail)
?>