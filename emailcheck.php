<?php
# create database connection
$connect = mysqli_connect("localhost","root","","barbershop");

if(!empty($_POST["email"])) {
  $query = "SELECT email FROM tbl_customer WHERE email='" . $_POST["email"] . "'";
  $result = mysqli_query($connect,$query);
  $count = mysqli_num_rows($result);
  if($count>0) {
    echo "<span style='color:red'>Email is taken!</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
  /*else{
    echo "<label style='color:green'>Email available for Registration.</label>";
    echo "<script>$('#submit').prop('disabled',false);</script>";
  }*/
}
?>
