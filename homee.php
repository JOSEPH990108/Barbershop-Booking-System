<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'barbershop'); 
// $username = $_GET['username'];
if(!isset($_SESSION['username']))
{
	echo 0;
}
else
    echo $_SESSION['username'];
?>