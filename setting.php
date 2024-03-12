<?php 
    include('partials-front/header.php');
    include('server.php');

    if(isset($_SESSION['username']))
    {
      $user = $_SESSION['username'];
    }
?>



<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="sear">Setting</h5>
            <form name="myForm" class="form-signin" onsubmit="return validateForm()" action="save.php" method="post">
                <?php 
                    if(@$_GET['error']==true){
                ?>
                <div class="alert-light text-danger text-center py-3" id="errorm"><?php echo $_GET['error'] ?>
                </div>
                <?php

                    }
                 ?>
              <div class="form-group">
                <input type="text" name="user" class="form-control" value="<?php echo $user; ?>" readonly="readonly"> 
              </div>

              <div class="form-group">
                <input type="password" name="oldpass" class="form-control" placeholder="Old Password*" required>
              </div>
              <div class="form-group">
                <input type="password" name="newpass" class="form-control" placeholder="New Password*" required oninput="document.getElementById('errnewpass').innerHTML='';style=''">
                  <label class="label" id="errnewpass"></label>
              </div>
              <div class="form-group">
                <input type="password" name="confpass" class="form-control" placeholder="Confirm Password*" required oninput="document.getElementById('errconfpass').innerHTML='';style=''">
                  <label class="label" id="errconfpass"></label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" name="login_user" type="submit">SAVE</button>
              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="valid.js"></script>
</body>
</html>