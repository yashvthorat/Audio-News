<?php
// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'translate');
// Handle deletion
if (isset($_POST['delete_ids'])) {
  foreach ($_POST['delete_ids'] as $id) {
    $query = "DELETE FROM articles WHERE id = $id";
    mysqli_query($conn, $query);
  }
  header('Location: removeArticle.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <title>Admin Article Delete</title>
  <script src='https://kit.fontawesome.com/a076d05399.js' ></script>
  <style>
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
  font-size:large;
  text-align:center;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
}

th {
  background-color: #f2f2f2;
  position: sticky;
  top: -8px;
}
tbody tr {
  height: 50px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
tr:nth-child(odd) {
  background-color: rgb(180, 176, 176);
}

tr:hover {
  background-color: #ddd;
}

td.delete-cell {
  text-align: center;
}

td.delete-cell a {
  color: red;
  text-decoration: none;
  border:3px black solid;
  padding:5px;
  font-size:large;
  font-weight:bold;
  background-color:white;
}

td.delete-cell a:hover {
  background-color:lightgray;
}

.table-container{
  color:black;
  display:flex;
  width:90%;
  margin:0px auto;
  padding:7px;
  background-color:gray;
  border: 3px black solid;
  min-height:100px;
  max-height: 60vh; /* set a fixed height for the table body */
  overflow-y: scroll; /* add vertical scrollbar to the table body */
}
.main-container {
    display: block;
    padding: 10px 0px;
    margin: 5vh auto;
    width: 80%;
    height: auto;
    border:2px whitesmoke solid;
    border-radius: 25px;
    background-color: rgb(146, 145, 145);
    color: white;
  }
  body {
    background-color: black;
  }
  header {
              display: flex;
              align-items: center;
              justify-content: space-between;
              background-color: #333;
              color: #fff;
              padding: 10px;
              white-space: nowrap;
              flex-wrap: wrap;
              margin:10px;
            }
  header button , input[type="submit"]{
                padding:7px;
                background-color:cyan;
                border-radius:25px;
                font-size:large;
                margin:3px 3px 3px auto;
                cursor: pointer;
  }
  header button:hover, input[type="submit"]:hover{
    background-color:lightcyan;
  }
  h1{
    text-align: center;
    color:black;
    background-color: rgb(119, 115, 129);
    padding:5px;  
  }
  header label{
    font-size:1.5em;
  }
  header input[type="text"]{
    padding:7px;
    font-size:1em;
  }
  .back-btn{
    display: inline-flex;
    background-color:lightcyan;
    font-size: larger;
    margin: 5px auto 5px 5px;
    border-radius:15px;
    }
    .top-bar{
      display: flex;
      background-color: black;
      margin: 10px 0px 0px;
    }
    .search-container{
      margin:0px auto; 
    }
    .delete-selected{
      background-color:red !important; 
      color:white
    }
    .delete-selected:hover{
      background-color:orange !important; 
      color:black;
    }
    @media only screen and (max-width:600px){
      .main-container{
        width:100%;
        font-size:small;
      }
      .table-container{
        width:100%;
        font-size:small;
      }
    }
    
  </style>
</head>
<body>
  <div class="main-container">
    <div class="top-bar"><button class="back-btn" onclick="document.location='mainadminpage.php'" ><i class='fas fa-arrow-circle-left'></i>&nbsp;Back</button></div>

  <h1 >Remove Articles</h1>
            <header>
              <div class="search-container">
            <form method="get">
              <label for="search">Search articles:</label>
              <input type="text" name="search" autocomplete="off">
              <input type="submit" value="Search">
            </form>
            </div>
            <button onclick="document.location='removeArticle.php'">Show all Articles</button>
            
        
        <?php
            // Handle search
            if (isset($_GET['search'])) {
              $search = mysqli_real_escape_string($conn, $_GET['search']);
              $query = "SELECT * FROM articles WHERE title LIKE '%$search%'";
            } else {
              $query = "SELECT * FROM articles";
            }

            // Retrieve articles
            $result = mysqli_query($conn, $query);

        ?>

        <!--Dislay arrticles-->
        <form method="post">
        <input type="submit" name="delete" value="Delete selected" class="delete-selected">
        </header>

        <!--table to display startss from here.-->
        <div class="table-container">
          <table class="styled-table">
            <thead>
              <tr>
                <th>Delete</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Created At</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
      <?php

          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td><input type="checkbox" name="delete_ids[]" value="' . $row['id'] . '"></td>';
            echo '<td style="text-align:left;">' . $row['title'] . '</td>';
            echo '<td>' . $row['genre'] . '</td>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td class="delete-cell"><a href="delete-article.php?id=' . $row['id'] . '">Delete</a></td>';
            echo '</tr>';
          }
      ?>
          </tbody>
        </table>
        </form>
        </div>
</div>

</body>
</html>