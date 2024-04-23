
<?php

$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];

//At phpmyadmin window, click on Server->User accounts, check their for hostname, username & password of any row(video: Introduction to SQL 1:25:00), If password is NA then keep it like "". 
$conn=new mysqli("localhost","root","","audio_news");


$sql_obj=mysqli_query($conn,"select * from user_details where username='$username'");

$total_rows=mysqli_num_rows($sql_obj);
if($total_rows>0)
{
    header('Location: registerPage.php?error=invalid_credentials');
    $_SESSION['login_status']=false;
    die;
}


$cmd="insert into user_details(username,password,mobile,email) values('$username','$password',$mobile,'$email')";
                    

$sql_result=mysqli_query($conn,$cmd);

if($sql_result)
{
    header('location:loginPage.php');
}
else
{
    echo "Registration Failed!, contact the developer";
}

 ?>