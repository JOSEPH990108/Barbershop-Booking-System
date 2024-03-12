<?php include('partials/header.php');?>

    <div class="main-content">
        <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 

            if(isset($_GET['barber_id']))
            {
                $barber_id = $_GET['barber_id'];
            }

        ?>

        <form action="" method="POST">
            <table class='tbl-30'>
            <tr>
                <td>Old Password: </td>
                <td>
                    <input type="password" name="old_password" placeholder="Old Password" required>
                </td>
            </tr> 

            <tr>
                <td>New Password: </td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password" required>
                </td>
            </tr>

            <tr>
                <td>Confirm Password: </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </td>
            </tr>

            <tr>
                <td colspan="2"> 
                    <input type="hidden" name="barber_id" value="<?php echo $barber_id; ?>">
                    <input type="submit" name="submit" value="Update" class="btn-secondary">
                    <input type="button" value="Cancel" class="btn-danger" onClick="document.location.href='http://localhost/barbershopbookingsystem/admin/manage-admin.php';" />
                </td>
            </tr>

            </table>
        </form>

        </div>
    </div>

<?php
    //Check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";
                //Get the data from form
                $barber_id = $_POST['barber_id'];
                $old_password = md5($_POST['old_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);

                //Check whether the user with current ID and Current password exist or not
                $sql = "SELECT * FROM tbl_admin WHERE barber_id=$barber_id AND password='$old_password'";
            
                //3. Executing Query and Save Data into Database
                $res = mysqli_query($conn, $sql) or die(mysqli_error());

                //4. Check whethter the (Query is Executed) data is inserted or not and display appropriate message
                if($res==TRUE)
                {
                    //Check whether data is available or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //User exist and password can be changed
                        //Check whether the new password and confirm password is the same
                        if($new_password==$confirm_password)
                        {
                            //Update password 
                            $sql2 = "UPDATE tbl_admin SET
                            password = '$new_password'
                            WHERE barber_id=$barber_id
                            ";
                            //Executing Query and Save Data into Database
                            $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());

                            //Check whether the query execute or not
                            if($res2==TRUE)
                            {
                                //Display Success Message
                                //Redirect to manage admin page with error message
                                $_SESSION['changed-pwd']="<div class='success'>Password Changed Successfully</div>";
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //Display Error Message
                                //Redirect to manage admin page with error message
                                $_SESSION['changed-pwd']="<div class='error'>Failed to Change Password</div>";
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }   

                        }
                        else
                        {
                            //Redirect to manage admin page with error message
                            $_SESSION['pass-not-match']="<div class='error'>Confirm password do not match. Try again</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                        
                    }
                    else
                    {
                        //User does not exist, send message and redirect
                            $_SESSION['user-not-found']="<div class='error'>Incorrect old password</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

            }
            else if(isset($_POST['cancel']))
            {
                //Redirect Page to Manage Admin
                header("location:".SITEURL.'admin/manage-admin.php');
            
            }
?>

<?php include('partials/footer.php');?>