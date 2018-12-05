<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "procrastination"; 

// Create connection 
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql1 = "SELECT taskTitle, taskDescription, priorityLVL FROM listOfTasks";
$result = $conn->query($sql1); 

$sql2 = "SELECT taskTitle, taskDescription, priorityLVL FROM listOfTasks WHERE priorityLVL='hi'";
$result2 = $conn->query($sql2); 

$timestamp = strtotime('8:30') + 60*60;
$time = date('H:i', $timestamp);
//echo $time;//9:30

//$timestamp = strtotime($time) + 60*60;
//$time2 = date('H:i', $timestamp);
//echo $time2;

if ($result->num_rows > 0) {
    echo "<table><tr><th>Task</th><th>Description</th><th>Priority Level</th><th>Start</th><th>End</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {  
        $timestamp = strtotime($time) + 60*60;
        $time = date('H:i', $timestamp);

        $timestamp = strtotime($time) + 60*60;
        $time2 = date('H:i', $timestamp);   

        echo "<tr><td>" . $row["taskTitle"]. "</td><td>" . $row["taskDescription"]. "</td><td>" . $row["priorityLVL"]. "</td><td>" . $time . "</td><td>" . $time2 . "</td></tr>";
   
    }
    echo "</table>";
} else {
    echo "0 results";
}


$conn->close();
?> 

</body>
</html>