<?php
    
    include 'comments.inc.php';
    date_default_timezone_set('Asia/Bangkok');
   
    $id='';
    $firstname='';
    $date='';
    $message='';
    
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="body">

<?php
$id= $_POST['id'];
$firstname= $_SESSION['login_user'];
$date = $_POST['date'];
$message = $_POST['message'];


echo "<form method='POST' action='".editComments($db)."'>
   <input type='hidden' name='id' value='".$id."'>
   <input type='hidden' name='firstname' value='".$firstname."'>
   <input type='hidden' name='date' value='".$date."'>
   <textarea name='message'>".$message."</textarea><br>
   <button name='commentSubmit' type='submit'>Edit</button>
</form>";


?>
</body>
</html>
