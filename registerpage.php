<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <link rel="stylesheet" type="text/css" href="registerpage.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <style>
    .register-container 
  {
  display: block;
  width: 80%;
  margin: 0 auto;
  text-align: center;
  border: black solid 2px;
  padding: 10px;
  border-radius: 20px;
  }
  @media only screen and (min-width: 992px){
  .register-container 
  {
  display: block;
  width: 600px;
  margin: 0 auto;
  text-align: center;
  border: black solid 2px;
  padding: 10px;
  border-radius: 20px;
  }

}
    

label {
  
  margin-top: 1em;
  text-align: center;
}

input[type="text"], input[type="email"], input[type="password"], input[type="tel"]{
  width: 90%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
}

input[type="submit"] {
  width: auto;
  background-color: #4CAF50;
  color: white;
  padding: 14px;
  margin: 8px ;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}
input[type="reset"] {
  width: auto;
  background-color: #dd4b39;
  color: white;
  padding: 14px ;
  margin: 8px ;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type="reset"]:hover {
  background-color: #dd4c39c2;
}
.submitField {
    display: flex;
    justify-content: center;
    align-items: center;
}
.bg {
  background-color: rgb(173, 216, 230);
}
.logo {
  display: flex;
  margin-left: auto; margin-right: auto;
  height: 200px;
  width: 200px; 
}
.sign-in{
  width: 30%;
  background-color: #15a4cf;
  color: white;
  padding: 14px ;
  margin:3px auto;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.sign-in:hover{
  background-color: #15a4cfd2;
}
.sign-inLable{
text-decoration: underline;
margin-bottom: 2px;
color: #d14844;
}
.errorMsg{
  display: flex;
  text-align: left;
  color: red;
  margin-top: 0px;
}
    .must-fill{
      display: flex;
      color: red;
    }
    .stick{
      display: flex;
      align-items: flex-end;
      justify-content: center;
    }
    #Validation,#errPass{
      display: flex;
      color: red;
      justify-content: center;
    }
    .main-container {
  display: flex;
  margin: 10vh auto;
  width: 80%;
  height: auto;
  border-radius: 25px;
  background-color: white;
}
body{
  background-color: lightgray;
}
@media only screen and (max-width: 600px) {
  .main-container {
    width: 100%;
    margin:0%;
    padding:0%;
    display:block;
    border: black solid 2px;
  }
  input[type="text"], input[type="email"], input[type="password"], input[type="tel"]{
  width: 98%;
  margin:0% auto;
}
.register-container{
  width:100%;
  border:none;
  padding:0%;
}
.bg{
  margin:10px;
}  
}
  </style>
</head>
<body>
  <div class="main-container">
      <div class="register-container">
        <div class="bg">
          <img src="logos/AudioNews3.png" alt="AudioNewsLogo" class="logo">
        </div>
        <form action="register.php" method="post" onsubmit="return validateForm()">
          <!-- For username -->
          <div class="stick"><span class="must-fill">*</span><label for="username">Username:</label></div>
          <input type="text" id="username" name="username">
          <?php
            // show massagee if password or username is wrong 
            if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
              echo '<span style="color:red; display:flex; margin-left:30px;">Username Exist already, Use another username.</span>';
            } ?>
          
          <!-- Mobile no. -->
          <div class="stick"><span class="must-fill">*</span><label for="mobile">Mobile Number:</label></div>
          <input type="tel" id="mobile" name="mobile" pattern="[6-9][0-9]{9}" title="Enter a valid Mobile Number">
          <span id="mobileError" style="color: red; display: flex;"></span>
          
          <!-- email  -->
          <div class="stick"><span class="must-fill">*</span><label for="email">Email:</label></div>
          <input type="email" id="email" name="email" oninput="emailvalidate()">
          
          <!-- pass -->
          <div class="stick"><span class="must-fill">*</span><label for="password">Password:</label></div>
          <input type="password" id="password" name="password"  oninput="validatePassword()">
          
          <!-- confirm pass -->
          <div class="stick"><span class="must-fill">*</span><label for="confirm_password">Confirm Password:</label></div>
          <input type="password" id="confirm_password" name="confirm_password"  oninput="validatePassword()"><br>
          
          <!-- validate pass -->
          <div id="errPass"></div>
          <br>
                <!-- validate pass -->
                <div id="Validation"></div>
                <br>
          
          <div class="submitField"><input type="submit" value="Register"> <input type="reset" value="Clear"></div>
          <hr>
          <div>
            <label for="sign-in" class="sign-inLable">If you already have account then</label><br><br>
            <input class="sign-in" type="button" onclick="document.location='loginPage.php'" value="Sign-in">
          </div>
        </form>
      </div>
  </div>
  
  <script>
    //validate
    function validateForm() {
    var username = document.getElementById('username').value;
    var mobile = document.getElementById('mobile').value;
    var email = document.getElementById('email').value;
    var pass = document.getElementById('password').value;
    var confPass = document.getElementById('confirm_password').value;

    if (username == '' || mobile == '' || email == '' || pass == '' || confPass == '') {
      var validation = document.getElementById('Validation');
      validation.innerHTML = "Please enter all required fields.";
      return false;
    }
    if(pass!=confPass){
      var validation = document.getElementById('Validation');
      validation.innerHTML = "Please cheak confirm password and submit";
      return false;
    }
    var mobileInput = document.getElementById("mobile");
    if (!mobileInput.checkValidity()) {
    mobileInput.setCustomValidity("Please enter a valid Mobile Number.");
    document.getElementById('mobileError').innerHTML = mobileInput.validationMessage;
    return false;
  }
     else {
      window.location.href ="register.php";
      return true;
    }
  }



// check if the confirm password matches the password
function validatePassword(){
    var password = document.getElementById("password");
    var confirm_password = document.getElementById("confirm_password");
    var errPassMsg = document.getElementById("Validation");

    if(password.value.length < 8) {
        password.setCustomValidity("Password should be at least 8 characters long.");
        errPassMsg.innerHTML="<span style='color:red; text-decoration:underline; justify-content:left; display:flex;'>Password should be at least 8 characters long.</span>";
    } else if(password.value != confirm_password.value) {
        password.setCustomValidity("");
        errPassMsg.innerHTML="<span style='color:red; text-decoration:underline; justify-content:left; display:flex;'> Password is not matching</span>";
    } else {
        password.setCustomValidity("");
        errPassMsg.innerHTML="<h6></h6>";
    };
  }



//for incorrect mobile number.
  var mobileInput = document.getElementById("mobile");
  mobileInput.addEventListener("input", function() {
    mobileInput.setCustomValidity("");
  });

  mobileInput.addEventListener("invalid", function() {
    mobileInput.setCustomValidity("Please enter a valid Mobile Number.");
  });

  </script>
</body>
</html>