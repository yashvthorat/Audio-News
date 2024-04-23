<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
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
  input[type="text"], input[type="email"], input[type="password"], input[type="tel"]{
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
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
color: rgb(156, 247, 247);
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
    margin: 2vh auto;
    width: 80%;
    height: auto;
    border-radius: 25px;
    background-color: rgb(94, 93, 93);
    color: white;
  }
  body{
    background-color: lightgray  ;
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
        <h1>Admin Register</h1>
        <form action="admin-register.php" method="post" onsubmit="return validateForm()">
          <!-- Name  -->
          <div class="stick"><span class="must-fill">*</span><label for="name">Name:</label></div>
          <input type="text" name="name" id='name'>

          <!-- For username -->
          <div class="stick"><span class="must-fill">*</span><label for="username">Username:</label></div>
          <input type="text" id="username" name="username">
          <?php
            // show massagee if password or username is wrong 
            if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
              echo '<span style="color:red; display:flex; margin-left:30px;">Username is already taken</span>';
            } ?>
          
          <!-- Mobile no. -->
          <div class="stick"><span class="must-fill">*</span><label for="mobile">Mobile Number:</label></div>
          <input type="tel" id="mobile" name="mobile" pattern="[6-9][0-9]{9}" title="Enter a valid Mobile Number" >
          <span id="mobileError" style="color: red; display: flex;"></span>
          
          <!-- pass -->
          <div class="stick"><span class="must-fill">*</span><label for="password">Password:</label></div>
          <input type="password" id="password" name="password" oninput="validatePassword()">
          
          <!-- confirm pass -->
          <div class="stick"><span class="must-fill">*</span><label for="confirm_password">Confirm Password:</label></div>
          <input type="password" id="confirm_password" name="confirm_password" oninput="validatePassword()"><br>
          
          <div class="stick"><span class="must-fill">*</span><label for="code">Enter Key Provided by Developer</label><br></div>
          <input type="password" name="code" id="code">
          <?php
            // show massagee if password or username is wrong 
            if (isset($_GET['errorCode']) && $_GET['errorCode'] == 'invalid_code') {
              echo '<span style="color:red; display:flex; margin-left:30px;">Code is incorrect</span>';
            } ?>
          
          <!-- validate password -->
          <div id="errPass"></div>
          <br>
                <!-- validate pass -->
                <div id="Validation"></div>
                <br>
          
          <div class="submitField"><input type="submit" value="Register"> <input type="reset" value="Clear"></div>
          <hr>
          </form>
          <div>
            <label for="sign-in" class="sign-inLable">If you already have account then</label><br>
            <input class="sign-in" type="button" onclick="document.location='admin-loginPage.php'" value="Sign-in">
          </div>
        
      </div>
    </div>
  
  <script>

   /* function validateForm(){
    username = document.getElementById('username').value;
    password = document.getElementById('password').value;
    password_conf = document.getElementById('confirm_password').value;
    mobile_no = document.getElementById('mobile').value;
    admin_pass = document.getElementById('code').value;
    admin_name = document.getElementById('name').value;
    if(username==''|| password==''|| password_conf=='' || mobile_no==''|| admin_pass==''|| admin_name==''){
      return false;
    }
    else{
      return true;
    }
    };*/




    //validate
   function validateForm() {
    username = document.getElementById('username').value;
    var mobile = document.getElementById('mobile').value;
    var name = document.getElementById('name').value;
    var pass = document.getElementById('password').value;
    var confPass = document.getElementById('confirm_password').value;
    var code = document.getElementById('code').value;

    if (username == '' || mobile == '' || name == '' || pass == '' || confPass == ''|| code=='') {
      var validation = document.getElementById('Validation');
      validation.innerHTML = "Please enter all required fields.";
      return false;
    }
    if(pass!=confPass){
      var error_pass = document.getElementById('errPass');
      error_pass.innerHTML = "Please cheak confirm password and submit";
      return false;
    }
    var mobileInput = document.getElementById("mobile");
    if (!mobileInput.checkValidity()) {
    mobileInput.setCustomValidity("Please enter a valid Mobile Number.");
    document.getElementById('mobileError').innerHTML = mobileInput.validationMessage;
    return false;
  }
     
      return false;
    
  }





// check if the confirm password matches the password
    function validatePassword(){
      var password = document.getElementById("password")
      var confirm_password = document.getElementById("confirm_password");
      errPassMsg= document.getElementById('errPass');

      if(password.value != confirm_password.value) {
        errPassMsg.innerHTML="<span style='color:red; text-decoration:underline; justify-content:left; display:flex;'> Password is not matching</span>";
      } else {
        errPassMsg.innerHTML="<h6></h6>";
      }
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