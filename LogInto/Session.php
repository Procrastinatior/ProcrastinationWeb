<?php
   session_start();
   include("Config.php");
   $myusername='';
   $mypassword='';
   $login_session='';
   $login_password='';
   
   
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
        $login_password =$row['password'];
         
        





	$_SESSION['login_user'] = $login_session; 
	$_SESSION['passwordUsed'] = $login_password;
   
   
?>