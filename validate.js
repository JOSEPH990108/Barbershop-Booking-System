function validateForm(){
    var name = document.myForm.name.value;
    var surname = document.myForm.surname.value;
    var email = document.myForm.email.value;
    var message = document.myForm.message.value;

    var letters = /^[A-Za-z]+$/;
    var emailpattern = /^([A-Za-z\d\.-]+)@([A-Za-z\d\.-]+)\.([a-z]{2,3})$/;
    var returnVal = true;

    
    if(!name.match(letters)){
        //document.myForm.name.style.borderColor = "red";
        document.getElementById("errname").innerHTML = "*Name must be letters only!";
        returnVal = false;
    }
    if(name == ""){
        //document.myForm.name.style.borderColor = "red";
        document.getElementById("errname").innerHTML = "*Enter First Name!";
        returnVal = false;
    }
    if(!surname.match(letters)){
        //document.myForm.surname.style.borderColor = "red";
        document.getElementById("errsurname").innerHTML = "*Name must be letters only!";
        returnVal = false;
    }
    if(surname == ""){
        //document.myForm.surname.style.borderColor = "red";
        document.getElementById("errsurname").innerHTML = "*Enter Last Name!";
        returnVal = false;
    }
    if(message == ""){
        //document.myForm.message.style.borderColor = "red";
        document.getElementById("errmessage").innerHTML = "*Enter Message!";
        returnVal = false;
    }
    if(!email.match(emailpattern)){
        //document.myForm.email.style.borderColor = "red";
        document.getElementById("erremail").innerHTML = "*Invalid Email Address!";
        returnVal = false;
    }
    if(email == ""){
        //document.myForm.email.style.borderColor = "red";
        document.getElementById("erremail").innerHTML = "*Enter an Email!";
        returnVal = false;
    }

    return returnVal;
}
function validateRegisterForm(){
    var fname = document.myForm.fname.value;
    var lname = document.myForm.lname.value;
    var username = document.myForm.username.value;
    var password = document.myForm.password.value;
    var confpass = document.myForm.confpass.value;
    var age = document.myForm.age.value;
    var email = document.myForm.email.value;
    var phone = document.myForm.phone.value;

    var letters = /^[A-Za-z][A-Za-z\s]*$/;
    var emailpattern = /^([A-Za-z\d\.-]+)@([A-Za-z\d\.-]+)\.([a-z]{2,3})$/;
    var validphone = /[0-9]+$/;
    var validpassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;

    var returnVal = true;

    
    if(!fname.match(letters)){
        //document.myForm.fname.style.borderColor = "red";
        document.getElementById("errfname").innerHTML = "*First Name must be letters only!";
        returnVal = false;
    }
    if(fname == ""){
        //document.myForm.fname.style.borderColor = "red";
        document.getElementById("errfname").innerHTML = "*First Name is required!";
        returnVal = false;
    }
    if(!lname.match(letters)){
        //document.myForm.lname.style.borderColor = "red";
        document.getElementById("errlname").innerHTML = "*Last Name must be letters only!";
        returnVal = false;
    }
    if(lname == ""){
        //document.myForm.lname.style.borderColor = "red";
        document.getElementById("errlname").innerHTML = "*Last Name is required!";
        returnVal = false;
    }
    /*if(!username.match(letters)){
        document.myForm.username.style.borderColor = "red";
        document.getElementById("errusername").innerHTML = "*Username must be letters only!";
        returnVal = false;
    }*/
    if(username == ""){
        //document.myForm.username.style.borderColor = "red";
        document.getElementById("errusername").innerHTML = "*Username is required!";
        returnVal = false;
    }
    if(!password.match(validpassword)){
        //document.myForm.password.style.borderColor = "red";
        document.getElementById("errpass").innerHTML = "*Password must contain at least one numbers, special Char, small and capital letters!";
        returnVal = false;
    }
    if(password == ""){
        //document.myForm.password.style.borderColor = "red";
        document.getElementById("errpass").innerHTML = "*Password is required!";
        returnVal = false;
    }
    if(confpass == ""){
        //document.myForm.confpass.style.borderColor = "red";
        document.getElementById("errconfpass").innerHTML = "*Confirm  password is required!";
        returnVal = false;
    }
    if(confpass != password){
        //document.myForm.confpass.style.borderColor = "red";
        //document.myForm.password.style.borderColor = "red";
        document.getElementById("errconfpass").innerHTML = "*Passwords Don't Match!"; 
        returnVal = false;
    }
    if(!(age>=18) || !(age<=60)){
        //document.myForm.age.style.borderColor = "red";
        document.getElementById("errage").innerHTML = "*Please select your age!";
        returnVal = false;
    }
    if(!email.match(emailpattern)){
        //document.myForm.email.style.borderColor = "red";
        document.getElementById("erremail").innerHTML = "*Invalid Email Address!";
        returnVal = false;
    }
    if(email == ""){
        //document.myForm.email.style.borderColor = "red";
        document.getElementById("erremail").innerHTML = "*Email is required!";
        returnVal = false;
    }
    if(phone.length != 10 && phone.length != 11){
        document.getElementById("errphone").innerHTML = "*Phone number must be of 10 or 11 digits!";
        returnVal = false;
    }
    if(!phone.match(validphone)){
        //document.myForm.phone.style.borderColor = "red";
        document.getElementById("errphone").innerHTML = "*Phone number must be digits only!";
        returnVal = false;
    }
    if(phone == ""){
        //document.myForm.phone.style.borderColor = "red";
        document.getElementById("errphone").innerHTML = "*Phone number is required!";
        returnVal = false;
    }
    return returnVal;
}