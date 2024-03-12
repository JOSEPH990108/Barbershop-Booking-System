<?php 
    include('partials-front/header.php');
    include('server.php');
?>

    <div class="container-fluid register" id="regi">
                <div class="row">
                    <div class="col-md-2 register-left">
                    </div>
                    <div class="col-md-8 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading"><b>Member Registration</b></h3>
                                <form name="myForm" method="post" action="registering.php" onsubmit="return validateRegisterForm()">
                                    <div class="row register-form">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>First Name</strong></label>
                                                <input type="text" name="fname" class="form-control" placeholder="First Name *" oninput="validateFirstName()"/>
                                                <label class="label" style='color:red' id="errfname"></label>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Last Name</strong></label>
                                                <input type="text" name="lname" class="form-control" placeholder="Last Name *" oninput="validateLastName()"/>
                                                <label class="label" style='color:red' id="errlname"></label>
                                            </div>
                                             <div class="form-group">
                                                <label><strong>Username</strong></label>
                                                <span id="check-username"></span>
                                                <input type="text" name="username" id="username" class="form-control" placeholder="Username *" onInput="checkUsername()"/>
                                                <label class="label" style='color:red' id="errusername"></label>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Password</strong></label>
                                                <input type="password" name="password" class="form-control" placeholder="Password *" oninput="validatePassword()">
                                                <label class="label" style='color:red' id="errpass"></label>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Confirm Password</strong></label>
                                                <input type="password" name="confpass" class="form-control"  placeholder="Confirm Password *" 
                                                oninput="validateConfirmPassword()">
                                                <label class="label" style='color:red' id="errconfpass"></label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Gender</strong></label>
                                                <div class="maxl">
                                                    <label class="radio inline"> 
                                                        <input type="radio" name="gender" value="male" checked>
                                                        <span> Male </span> 
                                                    </label>
                                                    <label class="radio inline"> 
                                                        <input type="radio" name="gender" value="female">
                                                        <span>Female </span> 
                                                    </label>  
                                                </div>
                                                    <label class="label"></label>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Age</strong></label>
                                                <input type="number" name="age" min="18" max="60" placeholder="Age *" value="" class="form-control" 
                                                onclick="document.getElementById('errage').innerHTML='';style=''">
                                                <label class="label" style='color:red' id="errage"></label>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Email</strong></label>
                                                <span id="check-email"></span>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email address *" 
                                                onclick="document.getElementById('erremail').innerHTML='';style=''" onInput="checkEmail()"/>
                                                <label class="label" style='color:red' id="erremail"></label>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Phone Number</strong></label>
                                                <input type="text" minlength="10" maxlength="11" name="phone" class="form-control" placeholder="Phone number without '-'*" 
                                                onclick="document.getElementById('errphone').innerHTML='';style=''">
                                                <label class="label" style='color:red' id="errphone"></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="reg_user" class="btnRegister"  value="Register"/>
                                            </div>
                                            <div class="form-group">
                                                <p>Already have an account?</p>
                                                <a href="signin.php" >Signin</a> 
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="validate.js"></script>
        <script> 
        function validateFirstName(){
            var fname = document.myForm.fname.value;
            var letters = /^[A-Za-z][A-Za-z\s]*$/;
            var returnVal = true;
            if(!fname.match(letters)){
                document.getElementById("errfname").innerHTML = "*First Name must be letters only!";
                returnVal = false;
            }
            if(fname == ""){
                document.getElementById("errfname").innerHTML = "*First Name is required!";
                returnVal = false;
            }
            if(fname != "" && fname.match(letters)){
                document.getElementById("errfname").innerHTML = "";
            }
        }
        </script>
        <script> 
        function validateLastName(){
            var lname = document.myForm.lname.value;
            var letters = /^[A-Za-z][A-Za-z\s]*$/;
            var returnVal = true;
            if(!lname.match(letters)){
                document.getElementById("errlname").innerHTML = "*Last Name must be letters only!";
                returnVal = false;
            }
            if(lname == ""){
                document.getElementById("errlname").innerHTML = "*Last Name is required!";
                returnVal = false;
            }
            if(lname != "" && lname.match(letters)){
                document.getElementById("errlname").innerHTML = "";
            }
        }
        </script>
        <script>
        function validatePassword(){
            var password = document.myForm.password.value;
            var validpassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
            var returnVal = true;
            if(!password.match(validpassword)){
                document.getElementById("errpass").innerHTML = "*Password must contain at least one numbers, one special character, small and capital letters!";
                returnVal = false;
            }
            if(password == ""){
                document.getElementById("errpass").innerHTML = "*Password is required!";
                returnVal = false;
            }
            if(password.match(validpassword) && password != ""){
                document.getElementById("errpass").innerHTML = "";
            }
        }
        </script>
        <script>
        function validateConfirmPassword(){
            var password = document.myForm.password.value;
            var confpass = document.myForm.confpass.value;
            var returnVal = true;
            if(confpass == ""){
                document.getElementById("errconfpass").innerHTML = "*Confirm  password is required!";
                returnVal = false;
            }
            if(confpass != password){
                document.getElementById("errconfpass").innerHTML = "*Passwords Don't Match!"; 
                returnVal = false;
            }
            if(confpass == password){
                document.getElementById("errconfpass").innerHTML = ""; 
            }
        }
        </script>
        <script>
        function checkUsername() {
            
            jQuery.ajax({
            url: "usercheck.php",
            data:'username='+$("#username").val(),
            type: "POST",
            success:function(data){
                $("#check-username").html(data);
            },
            error:function (){}
            });
        }
        </script>     
        <script>
        function checkEmail() {
            
            jQuery.ajax({
            url: "emailcheck.php",
            data:'email='+$("#email").val(),
            type: "POST",
            success:function(data){
                $("#check-email").html(data);
            },
            error:function (){}
            });
        }
        </script>
</body>
</html>
