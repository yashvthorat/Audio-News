<?php
// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'translate');

// Retrieve article ID from URL
$id = $_GET['id'];

// Delete article
$query = "DELETE FROM articles WHERE id = $id";
mysqli_query($conn, $query);

// Redirect to admin article delete page
header('Location: removeArticle.php');
?>