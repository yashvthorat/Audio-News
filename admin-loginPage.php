<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="login.css">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <style>
    #login-container {
    width: 400px;
    height: auto;
    margin: 10px auto;
    text-align: center;
    border: white solid 2px;
    padding: 10px;
    border-radius: 20px;
  }
  
  #login-form {
    margin-top: 50px;
  }
  
  label {
    display: block;
    margin-bottom: 10px;
  }
  
  input[type="text"], input[type="password"] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
  }
  
  input[type="submit"] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .or {
    margin-top: 20px;
    margin-bottom: 20px;
  }
  
  #signup {
    width: 100%;
    background-color: #dd4b39;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  #user-login {
    width: 100%;
    background-color: lightpink;
    color: black;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  .logo {
    display: flex;
    margin-left: auto; margin-right: auto;
    height: 200px;
    width: 200px; 
  }
  .bg {
    background-color: rgb(173, 216, 230);
  }
  .admin-login{
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    background-color: #d6817b;
  }
  .main-container {
    display: flex;
    margin: 10vh auto;
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
  }
}
  </style> 

</head>
<body>
 <div class="main-container"> 
  <div id="login-container">
    <div class="bg">
      <img src="logos/AudioNews3.png" alt="logo" class="logo">
    </div>
    <h1>Admin Login</h1>
      <form id="login-form" action="admin-login.php" method="post">
        <label for="username">Admin Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input class="loginButton" type="submit" value="Login">
        <div class="or">or</div>

      </form>
      <button id="signup" onclick="document.location='admin-registerPage.php'" >Register Admin</button>
      <button id="user-login" onclick="document.location='loginPage.php'" >User Login</button>
  </div>
</div> 
  <script>
    const username = document.getElementById('username');
    const password = document.getElementById('password');

    function Signup() {
  // code to sign up 
}
  </script>
</body>
</html>