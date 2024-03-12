<?php
# create database connection
$connect = mysqli_connect("localhost","root","","barbershop");

if(!empty($_POST["username"])) {
  $query = "SELECT * FROM tbl_customer WHERE username='" . $_POST["username"] . "'";
  $result = mysqli_query($connect,$query);
  $count = mysqli_num_rows($result);
  if($count>0) {
    echo "<span style='color:red'>Username is taken!</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
  /*else{
    echo "<span style='color:green'> User available for Registration .</span>";
    echo "<script>$('#submit').prop('disabled',false);</script>";
  }*/
}
?>

