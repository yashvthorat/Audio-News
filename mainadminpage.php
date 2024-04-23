<?php
session_start();
if(isset($_SESSION['login_status']))
{
    if($_SESSION['login_status']==false)
    {
        echo "<h2>Unauthorised Login</h2>";
        die;
    }
}
else
{
    echo "<h2>Illegal Attempt</h2>";
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
    .top {
    background-color: lightblue;
    display: flex;
    justify-content: center;
    }
    
    h1 {
        font-size: 50px;
        margin-bottom: 20px;
    }
    .container{
        background-color: lightgray;
        display: block;
        width: 90%;
        margin: 0px auto;
        border-radius: 25px;
        padding: 10px;
    }
    .event-buttons button{
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        width: 300px;
        margin: 5px auto;
        border-radius:25px;
        font-size:larger;
        text-align: center;
        cursor: pointer;
    }
    .event-buttons button:hover{
        background:darkgray;
        color:white;
    }
    .main{

        justify-items: center;
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
            body{
                background-color: black;
            }
            #header {
              display: flex;
              align-items: center;
              justify-content: space-between;
              background-color: #333;
              color: #fff;
              padding: 10px;
              white-space: nowrap;
              flex-wrap: wrap;
            }
            #header button{
                padding:7px;
                background-color:cyan;
                border-radius:25px;
                font-size:large;
                margin:3px 3px 3px auto;
                cursor: pointer;
            }
            .greeting {
                font-size:larger;
                margin: 3px auto;
            }
            .adminName{
                color:red;
            }

        </style>
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
			$sql = "SELECT * FROM admin_details WHERE id='$user_id'";
			$result = mysqli_query($conn, $sql);
			$user = mysqli_fetch_assoc($result);
		}

		mysqli_close($conn);
?>
    </head>
    <body>
        <div class="main">

              <div class="container">
                <div class="bg">
                    <img src="logos/AudioNews3.png" alt="logo" class="logo">
                  </div>
            <div><h1 class="top">Admin Console</h1> </div>
            <div id="header">
                <div class="greeting">
                <span class="welcome">Welcome</span> &nbsp;&nbsp; <span class="adminName"><?php echo $user['name']; ?> </span>
                </div>
            <button onclick="document.location='admin-logout.php'">Logout <i class="fa fa-power-off"></i></button>
            </div>
                
                        <div class="event-buttons">
                        <button onclick="AddArticle()" id="addArticle">Add Article &nbsp;&nbsp;<i class='fa fa-plus' style="font-size:larger; color:green;"></i></button>
                        <br>
                        <button onclick="RemoveArticle()" id="removeArticle">Remove Article &nbsp;&nbsp;<i class="fa fa-minus" style="font-size:larger; color:red;"></i></button>
                        <br>
                        <button onclick="RemoveUser()" id="removeUser">Remove User &nbsp;&nbsp; <i class="fa fa-minus-circle" style="font-size:larger;"></i></button>
                        <br>
                        </div>
                        
                </div>
        </div>
  
    </body>
    <script>
        function AddArticle(){
            window.location.href='translate2.html';
        }
        function RemoveArticle(){
            window.location.href='removeArticle.php';
        }
        function RemoveUser(){
            window.location.href='manageUser.php';
        }





    </script>
</html>