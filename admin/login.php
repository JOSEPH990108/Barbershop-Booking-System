<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbershop - Admin Login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="main-content">
    <div class="login">
        <h1 class="text-center">Administrator  Login</h1>
        <br>
        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login']; //Displaying Session message
                unset($_SESSION['login']); //Removing Session message
            }

            if(isset($_SESSION['no-login-message']))
            {
                {
                    echo $_SESSION['no-login-message']; //Displaying Session message
                    unset($_SESSION['no-login-message']); //Removing Session message
                }
            }
        ?>
        <br>
            <!-- Login Form -->
            <form action="" method="POST" class="text-center">
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter Username" required>
                           
                        </td>
                        <br><br>
                        <td>Password: </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter Password" required>
                            <br>
                        </td>
                <br>
                <input type="submit" name="submit" value="Login" class="btn-login">
                
            </form>
            <br>
    </div>
</body>
</html>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the username and password exist 
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User exist and login success
            $_SESSION['login'] = "<div class='success'>Welcome $username</div>";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it
            //Redirect to home page
            header('location:'.SITEURL.'admin/index.php');
        }
        else
        {
            //User not available
            $_SESSION['login'] = "<div class='error text-center'>Invalid Username or Password</div>";
            //Redirect to home page
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>