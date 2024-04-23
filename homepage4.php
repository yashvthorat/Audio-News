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
<html>
  <head>
    <meta charset="utf-8">
    <title>Audio News Web Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    
    <link rel="website icon" type="png"
     href="Audio News1.png">
    <link rel="stylesheet" href="styles.css">
    
    <style>

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


            #search-container {
              display: flex;
            }

            #search-container input[type="text"] {
              border: 1px solid white;
              background-color: #333;
              color: #fff;
              padding: 10px;
              margin: 4px;
            }

            #search-container button {
              border: 2px solid gray;
              background-color: #333;
              color: #fff;
              padding: 10px;
              cursor: pointer;
            }

            #menu-button {
              font-size: 24px;
              cursor: pointer;
            }

            #menu-modal {
              position: absolute;
              top: 280px;
              right: 5px;
              background-color: #333;
              color: #fff;
              padding: 10px;
            }

            #menu-modal button {
              border: none;
              background-color: #333;
              color: #fff;
              padding: 10px;
              cursor: pointer;
              width: 100%;
              text-align: left;
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
              background-color: lightblue;
              color: black;
              padding:7px;
            }
            li:hover {
              background-color: darkgray;
              color: white;
              cursor: pointer;
            }
              .window-cointainer{
              display: flex;
              flex-wrap: wrap;
              justify-content: space-between;
              min-height:100px;
              max-height: 60vh; 
              overflow-y: scroll;
              border:2px black  solid;
              background-color:whitesmoke;
              }
            
              .window {
                display:flex;
              background-color: rgb(214, 236, 220);
              color: black;
              font-size: 1.7vw;
              padding: 10px 10px;
              cursor: pointer;
              height: 100px;
              width:48%;
              border: 2px solid black;
              border-radius: 25px;
              margin:3px;
              justify-content: center;
              align-items: center;
              text-decoration: none;
              }
              @media (max-width: 1440px) {
              .window {
                width: 45%;
                margin:3px auto;
                font-size: 2vw;
                height:60px;
              }

            }
              .genre-label{
                color: white;
                width:2em;
                height:2em;
                display:flex;
            }
            .genre-label label{
                font-size: 20px;
                display:flex;
                justify-content: center;
                align-items: center;
            }
            .form select{
                color:rgb(247, 183, 8);
                font-size:16px;
            }
            .form{
                display:flex;
            }
            .wel-msg{
                font-size:20px;

            }
            body{
            
            }
            footer{
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 5px;
                margin: 10px 0px;
                background-color: lightgray;
                color: black;
                font-size: large;
            }
            #genre-display{
              display:none;
            }


            @media only screen and (max-width:600px){
              #app-name{
                display:none;
              }
              #search-container{
                display:none;
              }
              #genre-display{
                display:block;
                margin:0px 5% 0px auto;
                font-size:1em;
              }
              .genre-label{
                font-size:1em;
              }
              .window{
                width:80%;
                font-size:large;
              }

            }

    </style>
  </head>
  <body>
    <div>
    
      <div class="bg">
        <img src="logos/AudioNews3.png" alt="logo" class="logo">
      </div>
    <header>
      <div id="header">
        <div id="app-name">Audio News</div>

        <div class="genre-label">
            <form method="GET" class="form">
            <label for="genre">Select Genre &nbsp;&nbsp;</label>
            <select name="genre" id="genre">
                <option value="" >All</option>
                <option value="Politics">Politics</option>
                <option value="Education">Education</option>
                <option value="Celebrities">Celebrity</option>
                <option value="Sports">Sports</option>
                <option value="Religious">Religious</option>
                <option value="Economics">Economics</option>
            </select>
            <input type="submit" value="Select">
            </form>
        </div>
        

        <div id="search-container">
            <?php 
                $genre = isset($_GET['genre']) ? $_GET['genre'] : '';

                if (!empty($_GET['genre'])) {
                    echo "<div>Selected genre is <span style='color:red; font-size:20px;'>$genre </span> </div>";
                }
                else{
                    echo " <div class='wel-msg'>Welcome to <span style='color:red;'> Audio News </span> </div>";
                }            

            ?>
        </div>
        <div id="genre-display">
        <?php 
                $genre = isset($_GET['genre']) ? $_GET['genre'] : '';

                if (!empty($_GET['genre'])) {
                    echo "<div><span style='color:red;'>$genre</span></div>";
                }
                else{
                    echo "<div style='font-size:small;'><span>Welcome to </span><span style='color:red;'> Audio News </span></div>";
                }            

            ?>
        </div>

        <div id="menu-button">&#9776;</div>
      </div>
      <div id="menu-modal" style="display:none">
        <button id="profile-button" onclick="document.location='profilepage.php'">Profile</button>
        <button id="logOut-button" onclick="document.location='logout.php'" >Log Out</button>        
      </div>
    </header>
    </div>
    <nav>
      <ul>
        <li><a href="homepage4.php" title="Go To Home Page" <?php if(basename($_SERVER['PHP_SELF']) == 'homepage4.php'){echo 'class="active"';} ?>>Home</a></li>
        <li><a href="about.html" title="About Us">About</a></li>
        <li><a href="contact.html" title="Contact Page">Contact</a></li>
      </ul>
    </nav>
 

    <main>
      <h2>Trending News for Today are</h2>
     

        <div>
          <div id="button-container"></div>
        </div>
        <?php
                // connect to the database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "translate";

                $genre = isset($_GET['genre']) ? $_GET['genre'] : '';

             




                $conn = mysqli_connect($servername, $username, $password, $dbname);
                if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
                }

                // execute the SQL query to fetch the titles
                $result = mysqli_query($conn, "SELECT title, id FROM articles");



                $sql = "SELECT * FROM articles";

                // If a genre is selected, add a WHERE clause to the query
                if (!empty($_GET['genre'])) {
                    $selected_genre = mysqli_real_escape_string($conn, $_GET['genre']);
                    $sql .= " WHERE genre = '$genre'";
                }
            
                // Execute the query and fetch the results
                $result = mysqli_query($conn, $sql);


                echo "<div class='window-cointainer'>";
                // loop through the result and display each title as a window
                while ($row = mysqli_fetch_array($result)) {
                  echo '<a href="post.php?id=' . $row['id'] . '&genre=' . urlencode($genre) . '" class="window">';
                    echo '<div >';
                    echo $row['title'];
                    echo '</div>';
                    echo '</a>';
                  }
                  echo "</div>";
                


                // close the database connection
                mysqli_close($conn);
         ?>
</div>
 

        
    </main>
    <footer>
       <span>&copy; Copyright 2021 Audio News. All rights reserved.</span>
    </footer>

    
    <script>
  // active navigation bar
  var currentLocation = window.location.href;
  var links = document.querySelectorAll('ul li a');
  
  for (var i = 0; i < links.length; i++) {
    if (links[i].href === currentLocation) {
      links[i].className = 'active';
    }
  }


const menuButton = document.getElementById('menu-button');
const menuModal = document.getElementById('menu-modal');

menuButton.addEventListener('click', () => {
  if (menuModal.style.display === 'none') {
    menuModal.style.display = 'block';
  } else {
    menuModal.style.display = 'none';
  }
});

const profileButton = document.getElementById('profile-button');
const genreButton = document.getElementById('genre-button');
const logOutButton = document.getElementById('logOut-button');


profileButton.addEventListener('click', () => {
  // code to execute when profile button is clicked

});
genreButton.addEventListener('click', () => {
  // code to execute when genre button is clicked
});
logOutButton.addEventListener('click', () => {
    // Redirect to logout.php
    window.location.href = 'logout.php';
});


    </script>
  </body>
</html>