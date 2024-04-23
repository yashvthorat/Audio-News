<?php
// connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "translate";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// get the ID and genre of the article from the URL parameters
$id = $_GET['id'];
$genre = isset($_GET['genre']) ? urldecode($_GET['genre']) : '';

if (!empty($_GET['genre'])) {
// execute the query to retrieve the article data
$query = "SELECT * FROM articles WHERE id = $id AND genre = '".urldecode($genre). "'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

// execute another query to get the ID of the next article in the same genre
$next_query = "SELECT id FROM articles WHERE id > $id AND genre = '".urldecode($genre). "' ORDER BY id ASC LIMIT 1";
$next_result = mysqli_query($conn, $next_query);
$next_row = mysqli_fetch_array($next_result);

// generate the "Next" button URL only if there is a next article in the same genre
$next_url = "";
if ($next_row) {
    $next_url = "post.php?id=" . $next_row['id'] . "&genre=" . urldecode($genre);
}
}
else{
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';
// execute the query to retrieve the article data
$query = "SELECT * FROM articles WHERE id = $id ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

// execute another query to get the ID of the next article in the same genre
$next_query = "SELECT id FROM articles WHERE id > $id  ORDER BY id ASC LIMIT 1";
$next_result = mysqli_query($conn, $next_query);
$next_row = mysqli_fetch_array($next_result);

// generate the "Next" button URL only if there is a next article in the same genre
$next_url = "";
if ($next_row) {
    $next_url = "post.php?id=" . $next_row['id'] ;
}
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="post.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' ></script>
    <title><?php echo $row['title']; ?></title>
    <style>
    .main-container .heading{
    display:flex;
    justify-content: center;
    align-items: center;
    background-color: whitesmoke;
    font: 3em;
}
.main-container{
    border-radius: 25px;
    background-color: lightgray;
    margin: 3%;
    
    
}
.main-container .message{
    display: flex;
    justify-content: center;
    align-content: center;
    padding: 2% 10%;
    background-color: lightblue;
    font-size: 2em;
    height: fit-content;
    border-bottom-left-radius: 25px;
    border-bottom-right-radius: 25px;
}
.main-container .audio-player{
    display: flex;
    justify-content: center;
    align-content: center;
    background-color: lightgrey;
    padding: 5px;
}
.audio-text{
    font-size: 2em;
    color: darkcyan;
    padding: 5px;
    
}
.main{
    background-color: gray; 
    height: 100vh;
    width: 100%; 
}
.next-btn{
display: inline-flex;
margin: 5px;
font-size: large;
background-color: lightgreen;
}
.homePage{
display: inline-flex;
background-color:lightcyan;
font-size: large;
margin: 5px 10px 5px 5px;
}
header{
    display:flex;
    margin-top: 10px;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;
    padding:1em 0px;
    justify-content: space-between;  
}
header button{
    cursor: pointer;
}
.backButton {
    display: inline-flex;
    align-items:center;
    background-color: lightgreen;
    font-size: large;
    margin: 5px;
}
header button{
    padding:10px;
    border-radius:25px;
}
header button:hover{
    background-color: skyblue;
    
}
header a{
    text-decoration:none;
}
.date{
    margin: 5px auto 5px 10px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:1.5em;
}
.date-mobile{
    display:none;
}

@media only screen and (max-width:600px){
    
    .main{
        width:100%;
    }
    .main-container{
          width:100%;
          margin:0%;
          font-size:small;
        }
        .login-container{
          width:100%;
        }
        .date{
            display:none;
        }
        .date-mobile{
            display:block;
            margin:0px 4% 0px auto;
            background-color:red;
       }
      }

    </style>
</head>

<body class="main">
    <div >

            <div class="main-container">
            <header>

            <div class="date-mobile">
            <label for="date">Date:</label>&nbsp;&nbsp;<span style="color:brown;"><?php echo $row['date']; ?></span>
            </div>

            <button class="homePage" onclick="document.location='homepage4.php'" ><i class='fas fa-arrow-circle-left'></i>&nbsp;Back</button>

            <!-- display date of article"-->
            <div class="date">
            <label for="date">Date:</label>&nbsp;&nbsp;<span style="color:brown;"><?php echo $row['date']; ?></span>
            </div>
            <!-- display the "previous"-->
            <button class="backButton" onclick="window.history.back()"><i class='far fa-arrow-alt-circle-left' style='font-size:larger; color:blue;'></i>&nbsp;&nbsp;Previous</button>

                    <!-- display the "Next" button if there is a next article -->
                    <?php if ($next_url != ""): ?>
                    <a  href="<?php echo $next_url; ?>"><Button class="next-btn" >Next&nbsp;&nbsp;<i class='far fa-arrow-alt-circle-right' style='font-size:larger; color:red;'></i></Button></a>
                    <?php endif; ?>
                    
                    </header>

                <div class="heading">
                <h1><?php echo $row['title']; ?></h1>
                </div>
                <div class="audio-player">
                    <span class="audio-text">Audio Player:&nbsp;&nbsp;&nbsp;</span>
                <?php
                            echo "<audio controls>";
                            echo "<source src='data:audio/mpeg;base64," . base64_encode($row["audio"]) . "'>";
                            echo "Your browser does not support the audio element.";
                            echo "</audio>";
                ?>
                </div>
                <div class="message">
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['message']; ?></p>
                </div>
                    

            </div>

    </div>    
</body>
</html>