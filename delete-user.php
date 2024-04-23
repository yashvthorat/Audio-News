<?php
// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'audio_news');

// Retrieve article ID from URL
$id = $_GET['id'];

// Delete article
$query = "DELETE FROM user_details WHERE id = $id";
mysqli_query($conn, $query);

// Redirect to admin article delete page
header('Location: manageUser.php');
?>