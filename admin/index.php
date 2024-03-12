<?php 
      include('../config/constants.php'); 
      include('../admin/partials/login-check.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="../css/admin.css" />
  </head>

  <?php 

  ?>
  <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login']; //Displaying Session message
                    unset($_SESSION['login']); //Removing Session message
                }
  ?>
  <body>
    <div class="sidebar">
      <div class="sidebar-header">
        <h3 class="brand">
          <span class="ti-unlink"></span>
          <span>Dashboard</span>
        </h3>
      </div>

      <div class="sidebar-menu">
        <ul>
          <li>
            <a href="../admin/index.php">
              <span class="ti-home"></span>
              <span>Home</span>
            </a>
          </li>
          <li>
            <a href="../admin/manage-admin.php">
            <span class="ti-user"></span>
              <span>Admins</span>
            </a>
          </li>
          <li>
            <a href="../admin/manage-category.php">
            <span class="ti-view-list-alt"></span>
              <span>Categories</span>
            </a>
          </li>
          <li>
            <a href="../admin/manage-service.php">
            <span class="ti-cut"></span>
              <span>Services</span>
            </a>
          </li> 
          <li>
            <a href="../admin/manage-appointment.php">
            <span class="ti-calendar"></span>
              <span>Appointments</span>
            </a>
          </li>
          <li>
            <a href="../admin/manage-newsletter.php">
            <span class="ti-announcement"></span>
              <span>Newsletters</span> 
            </a>
          </li>
          <li>
            <a href="../admin/logout.php">
            <span class="ti-power-off"></span>
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main_content">
      <header>
          <span>Barbershop Admin Panel</span>
      </header>

        <main>
        <h2 class="dash-title">Overview</h2>
            
            <div class="dash-cards">
            <?php
                $sql ="SELECT * FROM tbl_admin";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
            ?>
                <div class="card-single">
                    <div class="card-body">
                        <div>
                            <h5>Admins</h5>
                            <h4><?php echo $count; ?></h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="../admin/manage-admin.php">View all</a>
                    </div>
                </div>
                
                <div class="card-single">
                <?php
                $sql1 ="SELECT * FROM tbl_category";
                $res1 = mysqli_query($conn, $sql1);
                $count1 = mysqli_num_rows($res1);
                ?>
                    <div class="card-body">
                        <div>
                            <h5>Categories</h5>
                            <h4><?php echo $count1; ?></h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="../admin/manage-category.php">View all</a>
                    </div>
                </div>
                
                <div class="card-single">
                <?php
                $sql2 ="SELECT * FROM tbl_service";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                ?>
                    <div class="card-body">
                        <div>
                            <h5>Services</h5>
                            <h4><?php echo $count2; ?></h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="../admin/manage-service.php">View all</a>
                    </div>
                </div>
                
                <div class="card-single">
                <?php 
                  $sql3 ="SELECT * FROM tbl_appointment";
                  $res3 = mysqli_query($conn, $sql3);
                  $count3 = mysqli_num_rows($res3);
                ?>
                    <div class="card-body">
                        <div>
                            <h5>Appointments</h5>
                            <h4><?php echo $count3; ?></h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="manage-appointment.php">View all</a>
                    </div>
                </div>

                <div class="card-single">
                <?php 
                  $sql4 ="SELECT * FROM tbl_newsletter";
                  $res4 = mysqli_query($conn, $sql4);
                  $count4 = mysqli_num_rows($res4);
                ?>
                    <div class="card-body">
                        <div>
                            <h5>Newsletters</h5>
                            <h4><?php echo $count4; ?></h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="manage-newsletter.php">View all</a>
                    </div>
                </div>

            </div>
        </main>
    </div>
  </body>
</html>
<?php include('../admin/partials/footer.php'); ?>


