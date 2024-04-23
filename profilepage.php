<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<link rel="stylesheet" type="text/css" href="login.css">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<style>
	  input[type="text"], input[type="email"],input[type="tel"] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
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
  .login-container {
    width: 400px;
    height: auto;
    margin: 0 auto;
    text-align: center;
    border: black solid 2px;
    padding: 10px;
    border-radius: 20px;
  }
  #home-page{
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }
             nav {
                background-color: lightgray;
                display: flex;
                padding:0px;
                
              }
              
              nav ul {
                list-style: none;
                margin: 0px;
                padding: 5px;
                display: flex;
              }
              
              nav li {
                margin: 0 10px;
                padding:5px;
              }
              
              nav a {
                color: black;
                text-decoration: none;
              }
              nav li a.active {
              background-color: lightcyan;
              color: black;
              padding:7px;
            }
            li:hover {
              background-color: darkgray;
              color: white;
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
      @media only screen and (max-width:600px){
        .main-container{
          width:100%;
          margin:0%;
        }
        .login-container{
          width:100%;
        }
      }


	</style>
</head>
<?php
		session_start();
		//connect to database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "audio_news";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		//check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		//get user info from database
		$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
		if ($user_id) {
			$sql = "SELECT * FROM user_details WHERE id='$user_id'";
			$result = mysqli_query($conn, $sql);
			$user = mysqli_fetch_assoc($result);
		}

		//update user info if form submitted
		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$mobile = $_POST['mobile'];
      $password= $_POST['password'];

          //check if username already exists
    $check_user = "SELECT * FROM user_details WHERE username='$name' AND id !='$user_id'";
    $result = mysqli_query($conn, $check_user);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = "Username already exists";
        header("Location:profilepage.php");
        exit();
    }else{
      $sql = "UPDATE user_details SET username='$name', email='$email', mobile='$mobile' , password='$password' WHERE id='$user_id'";
			if (mysqli_query($conn, $sql)) {
				$_SESSION['message'] = "Profile updated successfully";
				header("Location: ".$_SERVER['PHP_SELF']);
				exit();
			} else {
				echo "Error updating profile: " . mysqli_error($conn);
			}
		}
    }



    //
    

		mysqli_close($conn);
?>
<body>
<div class="main-container">

    <div class="login-container">
    <div class="bg">
        <img src="logos/AudioNews3.png" alt="logo" class="logo">
      </div>
	<nav>
      <ul>
        <li><a href="homepage4.php" title="Go To Home Page" <?php if(basename($_SERVER['PHP_SELF']) == 'homepage4.php'){echo 'class="active"';} ?>>Home</a></li>
        <li><a href="homepage4.php" title="Go To Home Page" <?php if(basename($_SERVER['PHP_SELF']) == 'profilepage.php'){echo 'class="active"';} ?>>Update Profile</a></li>
       
      </ul>
    </nav>
		<h1>Update Profile</h1>
   
    
   
		
		<form method="post" action="profilepage.php" onsubmit="return validateForm()">
			<label for="name">User Name:</label>
			<input type="text" name="name" id="name" value="<?php echo $user['username']; ?>"><br>
			<label for="email">Email:</label>
			<input type="email" name="email" id="email" value="<?php echo $user['email']; ?>"><br>
			<label for="mobile">Mobile Number:</label>
			<input type="tel" name="mobile" id="mobile" pattern="[6-9][0-9]{9}" value="<?php echo $user['mobile']; ?>">

       
      
      <label for="password">Update Password:</label>
      <input type="password" id="password" name="password"  oninput="validatePassword()" value="<?php echo $user['password']; ?>">
          
          <!-- confirm pass -->
        <label for="confirm_password">Confirm new Password:</label>
        <input type="password" id="confirm_password" name="confirm_password"  oninput="validatePassword()" value="<?php echo $user['password']; ?>">
        <!-- validate pass -->
        <div id="Validation"></div>
        
      <br><br>
			<input type="submit" name="submit" value="Update Profile">
		</form>
    <span style='color:green'>
    <?php if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
          unset($_SESSION['message']); // clear the session message
      } ?>
    </span>
	</div>
</div>
<script>
// active navigation bar
var currentLocation = window.location.href;
var links = document.querySelectorAll('ul li a');
  
  for (var i = 0; i < links.length; i++) {
    if (links[i].href === currentLocation) {
      links[i].className = 'active';
    }
  }

  //pass validation
  function validateForm() {
  var password = document.getElementById("password").value;
  var confirm_password = document.getElementById("confirm_password").value;

  if (password !== confirm_password) {
    var validation = document.getElementById('Validation');
    validation.innerHTML = "Please check confirm password and submit";
    return false; // prevent form submission
  }

  // passwords match, allow form submission
  return true;
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




</script>	
</body>
</html>