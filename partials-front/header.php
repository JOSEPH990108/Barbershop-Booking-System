<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbershop Booking Website</title>
	<meta http-equiv="X-UA-Compatible" content="ide=edge">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<script src="jquery-3.4.1.js"></script>
	<script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
	<script src="login.js"></script>
	<script src="jump.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <!-- Compiled and minified CSS -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>-->
</head>

<body> 		
	<div id="header">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
            <div class="container">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#Navbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="<?php echo SITEURL; ?>" class="navbar-brand"><img src="images/Icon.png" style="width: 40x;height: 50px;"></a>
                <div class="collapse navbar-collapse" id="Navbar">
                    <ul class="navbar-nav ml-auto" id="new">
                        <li class="nav-item"><a href="<?php echo SITEURL; ?>" class="nav-link">HOME</a></li>
                        <li class="nav-item"><a href="<?php echo SITEURL; ?>categories.php" class="nav-link">CATEGORIES</a></li>
                        <li class="nav-item"><a href="<?php echo SITEURL; ?>services.php" class="nav-link">SERVICES</a></li>
                        <li class="nav-item"><a href="<?php echo SITEURL; ?>newsletter.php" class="nav-link">NEWSLETTER</a></li>
                        <!---<li class='nav-item dropdown '>
                             <a class="nav-link dropdown-toggle" data-toggle="dropdown" tabindex="-1" href="#"><span class="glyphicon glyphicon-user" id="newsletter">NEWSLETTER</span>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                
                            <?php
                                     //Display service that active 
                            //SQL QUery
                            //$con =  mysqli_connect("localhost","root", "root","barbershop");
                            //$sql = "SELECT title, active FROM tbl_newsletter WHERE active='Yes' ORDER BY ndate";

                            //Execute the query
                            //$res = mysqli_query($con, $sql);
                            //$count = mysqli_fetch_array($res)?>
                            <?php   
                                //while( )
                                {
                                    //$title = $count['title'];
                                    //$active = $count['active'];
                                    //if($active=="Yes") {?>
                                    
                                        <a class="dropdown-item" href="newsletter.php"><?php //echo $title;?></a>
                                    </div>
                                <?php } ?>
                                </select>
                            </a>
                        </li>
                        <li class="nav-item"><a href="contact.php" class="nav-link">CONTACT US</a></li>-->
                        <li class="nav-item"><a href="signin.php" class="nav-link" id="reg">SIGN IN</a></li>
                        <li class="nav-item"><a href="registering.php" class="nav-link" id="reg">REGISTER</a></li>
                    </ul>


                    <ul class="navbar-nav ml-auto" id="old">
                        <li class="nav-item"><a href="<?php echo SITEURL; ?>" class="nav-link">HOME</a></li>
                        <li id = "cart">
                        <li class="nav-item"><a href="<?php echo SITEURL; ?>categories.php" class="nav-link">CATEGORIES</a></li>
                        <li class="nav-item"><a href="<?php echo SITEURL; ?>services.php" class="nav-link">SERVICES</a></li>
                        <li class="nav-item"><a href="<?php echo SITEURL; ?>newsletter.php" class="nav-link">NEWSLETTER</a></li>
                        <!---<li class='nav-item dropdown '>
                             <a class="nav-link dropdown-toggle" data-toggle="dropdown" tabindex="-1" href="#"><span class="glyphicon glyphicon-user" id="newsletter">NEWSLETTER</span>
                                
                            <?php
                                     //Display service that active 
                            //SQL QUery
                            //$con =  mysqli_connect("localhost","root", "root","barbershop");
                            //$sql = "SELECT * FROM tbl_newsletter WHERE active='Yes' ORDER BY ndate";

                            //Execute the query
                            //$res = mysqli_query($con, $sql);?>
                            <?php   
                              //  while( $count = mysqli_fetch_array($res))
                                {
                                    ?>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="newsletter.php"><?php //echo $count['title'];?></a>
                                        <div class="divider"></div>
                                        <a class="dropdown-item" href="newsletter.php">View more</a>
                                    </div>
                                <?php } ?>
                                </select>
                            </a>
                        </li>
                        <li class="nav-item"><a href="contact.php" class="nav-link">CONTACT US</a></li>-->
						<a class="nav-link" href="<?php echo SITEURL; ?>appointment.php"><span class="glyphicon glyphicon-shopping-cart"></span>APPOINTMENT</a>
						</li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" tabindex="-1" href="#"><span class="glyphicon glyphicon-user" id="welcome"> Welcome!</span>
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="history.php">History</a>
                                <a class="dropdown-item" href="setting.php">Change Password</a>
                                <a class="dropdown-item" href="#" id="logout">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>