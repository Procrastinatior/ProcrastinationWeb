<!DOCTYPE html>
<html>
<body>

<?php
$host = "localhost";  
$dbUsername = "root";
$dbPassword = "";
$dbname = "procrastination";   

//Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

//Check connection
//if (mysqli_connect_error()) {
    //die('Connect Error ('. mysqli_connect_errno().')'. mysqli_connect_error());
//} 
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

$sql = "SELECT taskTitle, taskDescription, priorityLVL FROM listOfTasks";
$result = $conn->query($sql);

if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){
        echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>";        }
    }else{ 
        echo "null results";
    }

$conn->close();
?>

</body>
</html>