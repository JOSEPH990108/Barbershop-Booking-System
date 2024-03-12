<?php 
  include('partials-front/header.php');
  include('server.php');
?>

<div class="container1">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="sear">Sign In</h5>
            <form class="form-signin" action="signin.php" method="post">
                <?php 
                    if(@$_GET['error']==true){
                ?>
                <div class="alert-light text-danger text-center py-3"><?php echo $_GET['error'] ?>
                </div>
                <?php

                    }
                 ?>
              <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
              </div>

              <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" name="login_user" type="submit">Sign in</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>