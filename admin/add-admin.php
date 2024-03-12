<?php include('partials/header.php') ?>

    <div class='main-content'>
        <div class='wrapper'>
            <h1>Add Admin</h1>

            <br><br>
            
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Fist Name: </td>
                        <td><input type="text" name="first_name" placeholder="Enter First Name" required maxlength=99></td>
                    </tr>
                    <tr>
                        <td>Last Name: </td>
                        <td><input type="text" name="last_name" placeholder="Enter Last Name" required maxlength=99></td>
                    </tr>
                    <tr>
                        <td>IC: </td>
                        <td><input type="text" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" title="xxxxxx-xx-xxxx" name="ic" placeholder="Enter IC" required minlength=14 maxlength=14></td>
                    </tr>
                    <tr>
                        <td>Gender: </td>
                        <td><input type="text" name="gender" placeholder="Male/Female" required minlength=4 maxlength=6></td>
                    </tr>
                    <tr>
                        <td>Phone Number: </td>
                        <td><input type="text"  title="Ingeters only" name="phone_number" placeholder="Phone number without -" onkeypress="return onlyNumberKey(event)" required minlength=10 maxlength=11></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" placeholder="Enter Username" required maxlength=99></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" title="Minimum 8 characters with at least one capital letter and special character" placeholder="Enter Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength=8 maxlength=99></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                            <input type="button" value="Cancel" class="btn-danger" onClick="document.location.href='http://localhost/barbershopbookingsystem/admin/manage-admin.php';" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include('partials/footer.php') ?>

<?php 
    //Process the value from Form and Save into Database
    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //Button clicked
        //echo "Button Clicked";
        //1. Get the data from Form
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $ic = $_POST['ic'];
        $gender = $_POST['gender'];
        $phone_number = $_POST['phone_number'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encription with MD5

        //2. SQL Query to Save the data into Database
        $sql = "INSERT INTO tbl_admin SET
            first_name = '$first_name',
            last_name = '$last_name',
            ic = '$ic',
            gender = '$gender',
            phone_number = '$phone_number',
            username = '$username',
            password = '$password'
        ";
        
        //3. Executing Query and Save Data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whethter the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //Data inserted successfully
            //echo "Data Inserted";
            //Create a Session Variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //Failed to insert data
            //echo "Failed to insert data";
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
    
?>