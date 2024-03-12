<?php include('partials/header.php'); ?>

    <div class="main-content">
        <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
            if(isset($_GET['barber_id']))
            {
                //1. Get the ID of selected Admin
                $barber_id=$_GET['barber_id'];
                //2. Create SQL Query to get the details
                $sql="SELECT * FROM tbl_admin WHERE barber_id=$barber_id";
                //Execute the Query
                $res=mysqli_query($conn, $sql);
                //Check Whether the Query is executed or not
                if($res==TRUE)
                {
                    //Chech whether the data is available or not
                    $count = mysqli_num_rows($res);
                    //Check whether we have admin data or not
                    if($count==1)
                    {
                        //Get the details
                        //echo "Admin Available";
                        $rows = mysqli_fetch_assoc($res);

                        $barber_id =$rows['barber_id'];
                        $username = $rows['username'];
                        $first_name = $rows['first_name'];
                        $last_name = $rows['last_name'];
                        $gender = $rows['gender'];
                        $ic = $rows['ic'];
                        $phone_number = $rows['phone_number'];
                    }
                    else
                    {
                        //Redirect to Manage Admin Page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
            }
        ?>

        <form action="" method="POST">
        <table class="tbl-30">
                    <tr>
                        <td>Fist Name: </td>
                        <td><input type="text" name="first_name" value="<?php echo $first_name; ?>" maxlength=99 required></td>
                    </tr>

                    <tr>
                        <td>Last Name: </td>
                        <td><input type="text" name="last_name" value="<?php echo $last_name; ?>" maxlength=99 required></td>
                    </tr>

                    <tr>
                        <td>IC: </td>
                        <td><input type="text" name="ic" value="<?php echo $ic; ?>" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" title="xxxxxx-xx-xxxx" minlength=14 maxlength=14 required></td>
                    </tr>

                    <tr>
                        <td>Gender: </td>
                        <td><input type="text" minlength=4 maxlength=6 name="gender" required value=<?php echo $gender; ?>></td>
                    </tr>

                    <tr>
                        <td>Phone Number: </td>
                        <td><input type="text" name="phone_number" value="<?php echo $phone_number; ?>" title="Ingeters only" onkeypress="return onlyNumberKey(event)" required minlength=10 maxlength=11></td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>" maxlength=99 required>
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
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $ic = $_POST['ic'];
        $gender = $_POST['gender'];
        $phone_number = $_POST['phone_number'];
        $username = $_POST['username'];

        //2. SQL Query to Save the data into Database
        $sql = "UPDATE tbl_admin SET
            first_name = '$first_name',
            last_name = '$last_name',
            ic = '$ic',
            gender = '$gender',
            phone_number = '$phone_number',
            username = '$username'
            WHERE barber_id = '$barber_id'
        ";

        //3. Executing Query and Save Data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whethter the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //Data Updated successfully
            //echo "Data Updated";
            //Create a Session Variable to display message
            $_SESSION['update'] = "<div class='success'>Admin Details Update Successfully</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //Failed to update data
            //echo "Failed to update data";
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }

    }
?>

<?php include('partials/footer.php'); ?>