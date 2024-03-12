<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'barbershop') or die("Connection failed ".mysqli_error($conn));
	$user = $_POST['user'];
	$oldpass = $_POST['oldpass'];
	$newpass = $_POST['newpass'];
	$confpass = $_POST['confpass'];

	$passwordd = md5($oldpass);
	$newpassword = md5($newpass);
	$sql = "SELECT username FROM tbl_customer WHERE username = '$user' AND password = '$passwordd'";
	$result = mysqli_query($conn,$sql);

	$users = mysqli_num_rows($result);
	if($users > 0){
		$sql1 = "UPDATE tbl_customer SET password = '$newpassword' WHERE username = '$user' AND password = '$passwordd'";
		mysqli_query($conn,$sql1);
		header('location:index.php');
	}else{
		header('location:setting.php?error=Wrong old password');
	}

?>