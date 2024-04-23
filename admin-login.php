<?php

session_start();

$username=$_POST['username'];
$password=$_POST['password'];

//At phpmyadmin window, click on Server->User accounts, check their for hostname, username & password of any row(video: Introduction to SQL 1:25:00), If password is NA then keep it like "". 
$conn=new mysqli("localhost","root","","audio_news");

$sql_obj=mysqli_query($conn,"select * from admin_details where username='$username' and password='$password'");


$total_rows=mysqli_num_rows($sql_obj);


if($total_rows==0)
{
    header('Location: admin-loginPage.php?error=invalid_credentials');
    $_SESSION['login_status']=false;
    die;
}


$row = mysqli_fetch_assoc($sql_obj);
$user_id = $row['id']; 
$_SESSION['user_id'] = $user_id; 

$_SESSION['login_status']=true;
header("location:mainadminpage.php");

?>