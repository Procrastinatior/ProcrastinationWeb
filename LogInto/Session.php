<?php
   session_start();
   include("config.php");
   $myusername='';
   $mypassword='';
   
   
   if(!(isset($_SESSION['login_user']) && isset($_SESSION['password']))){
    include("login.php");
 }
   else{
    $myusername=$_SESSION['login_user'];
    $mypassword=$_SESSION['password'];
}
   	$sql = "SELECT * FROM register WHERE username = '$myusername' and password = '$mypassword'";
	$ses_sql = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($ses_sql);
   $login_session =$row['username'];





$_SESSION['login_user'] = $row['username']; 
$_SESSION["password"] = $row['password'];
   
   
?>