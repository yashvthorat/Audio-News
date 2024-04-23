<?php
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$mobile = $_POST['mobile'];
$code = $_POST['code'];

if ($code !== 'HJM24$') {
  header('Location: admin-registerPage.php?errorCode=invalid_code');
  die();
}

//connection to db
$conn = new mysqli('localhost', 'root', '', 'audio_news');
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

//validating adminName
$stmt = $conn->prepare('SELECT * FROM admin_details WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  header('Location: admin-registerPage.php?error=invalid_credentials');
  die();
}

$stmt = $conn->prepare('INSERT INTO admin_details(name, username, password, mobile) VALUES (?, ?, ?, ?)');
$stmt->bind_param('ssss', $name, $username, $password, $mobile);
if ($stmt->execute()) {
  header('Location: admin-loginPage.php');
} else {
  die('Registration failed.');
}
?>