<?php
    
    if(isset($_POST['submit'])){

    $firstname = $_POST['firstname'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    

   if(!empty($firstname) || !empty($password) || !empty($gender) || !empty($email) || !empty($phone)){
       $host = "localhost";
       $dbFirstname = "root";
       $dbPassword = "";
       $dbname    = "procrastination";
       
       
      
}
else{
    echo "All fields are required";
    die();
}


   $conn= new mysqli($host,$dbFirstname,$dbPassword,$dbname);
    if(mysqli_connect_error()){
         die('Connect_Error('.mysqli_connect_errno().')'.mysqli_connect());
    }else{
         $SELECT = "SELECT email From register Where email = ? Limit 1";
         $INSERT = "INSERT Into register (username, password, gender, email, phone) VALUES(?,?,?,?,?)";


       $stmt = $conn->prepare($SELECT);
       $stmt->bind_param("s",$email);
       $stmt->execute();
       $stmt->bind_result($email);
       $stmt->store_result();
       $rnum = $stmt->num_rows;

       if($rnum==0){
       $stmt->close();


       $stmt = $conn->prepare($INSERT);
       $stmt->bind_param("ssssi", $firstname, $password, $gender, $email, $phone);
       $stmt ->execute();
       //echo "New record inserted successfully";
         header("location: InsertToDatabaseNewRegisters.php");
        }
         else{
              echo "Someone already registered";
      } $stmt->close();
        $conn->close();
   
  }
  
 }
 
   
?>

<!doctype html>
<html>
<head>
<title>Register Form</title>
<link rel="stylesheet" href="index.css">
</head>
<body>
<div class="firstDiv">
<h1>Your Are Welcome to Sign Below<h1>
<form action = " " method="POST">
First name: <input type="text" id="firstname" name="firstname" required><br>
Password:   <input type="password" id="password" name="password" required><br>
Gender:     <input type="radio" id="gender" name="gender" value="m" checked required>Male
            <input type="radio" id="gender" name="gender" value="f" required>Female<br>
Email:      <input type="email" id="email" name="email" required><br>
Phone no:   <input type="tel"   id="phone" name="phone" required><br>
Submit:     <input type="submit" name="submit" value="Submit">
</form>
</div>
</body>
</html>