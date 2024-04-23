<?php

session_start();

$username=$_POST['username'];
$password=$_POST['password'];

 
$conn=new mysqli("localhost","root","","audio_news");

$sql_obj=mysqli_query($conn,"select * from user_details where username='$username' and password='$password'");


$total_rows=mysqli_num_rows($sql_obj);




if($total_rows==0)
{
    header('Location: loginPage.php?error=invalid_credentials');
    $_SESSION['login_status']=false;
    die;
}

$_SESSION['login_status']=true;
$row = mysqli_fetch_assoc($sql_obj);
$user_id = $row['id']; 
$_SESSION['user_id'] = $user_id; 

header("location:homepage4.php");

?>
