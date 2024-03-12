<?php    
// Starting the session, necessary 
session_start(); 
// for using session variables 
// Declaring and hoisting the variables 
$username = ""; 
$email    = ""; 
$errors = array();  
$_SESSION['success'] = "";  
$db = mysqli_connect('localhost', 'root', '', 'barbershop'); 
// Registration code 
if (isset($_POST['reg_user'])) { 
    
    $fname = mysqli_real_escape_string($db, $_POST['fname']); 
    $lname = mysqli_real_escape_string($db, $_POST['lname']); 
    $username = mysqli_real_escape_string($db, $_POST['username']); 
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $confpass = mysqli_real_escape_string($db, $_POST['confpass']); 
    $gender = mysqli_real_escape_string($db, $_POST['gender']); 
    $age = mysqli_real_escape_string($db, $_POST['age']); 
    $email = mysqli_real_escape_string($db, $_POST['email']); 
    $phone = mysqli_real_escape_string($db, $_POST['phone']); 

    $errors = array();
    
    // If the form is error free, then register the user 
    if (count($errors) == 0) { 
        // Password encryption to increase data security 

        $passwor = md5($password); 
        // Inserting data into table  

        $query = "INSERT INTO tbl_customer (first_name, last_name, username, password, gender, age, phone_number, email) 
        VALUES ('$fname','$lname','$username','$passwor','$gender', $age, $phone,'$email')";
        mysqli_query($db, $query); 

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You have logged in"; 
        header('location: index.php');  

    } 
} 
 
// User login 

if (isset($_POST['login_user'])) { 
    
    $username = mysqli_real_escape_string($db, $_POST['username']); 
    $pass = mysqli_real_escape_string($db, $_POST['password']);
      
        $passwor = md5($pass);
        $sql = "SELECT username, password FROM tbl_customer WHERE username='$username' AND password='$passwor'"; 

        $res = mysqli_query($db, $sql); 

        $count = mysqli_num_rows($res);
          
        if($count == 1)
        {
            $_SESSION['username'] = $username; 
            $_SESSION['success'] = "<div class='success'>You have logged in!</div>"; 
            header("location:".SITEURL); 
        }
        else
        {
            header("location:signin.php?error=Incorrect username or password");
        }
} 
   
?> 