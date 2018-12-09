<!doctype html>
<html lang="en" class="no-js">
<head>

<style>
table.calendar {
    margin-bottom: 0;
    border: 2px solid #dddddd;
    padding: 10px;
}

table.calendar > thead > tr > th {
    text-align: center;
}

table.calendar > tbody > tr > td {
    height: 25px;
}

table.calendar > tbody > tr > td > div {
    padding: 7px;
    height: 40px; 
    overflow: hidden;
    display: inline-block;
    vertical-align: middle;
    border: 1px solid #dddddd;
}

table.calendar > tbody > tr > td.has-events {
    color: white;
    cursor: pointer;
    padding: 5px;
    border-radius: 5px;
}

table.calendar > tbody > tr > td.has-events > div {
    background-color: #08C;
    border-left: 1px solid white;
}

table.calendar > tbody > tr > td.has-events > div:first-child {
    border: 1px solid black;
    margin-left: 1px;
}

table.calendar > tbody > tr > td.has-events > div.practice {
    opacity: 0.7;
}
table.calendar > tbody > tr > td.conflicts > div > span.title {
    color: red;
}
table.calendar > tbody > tr > td.max-conflicts > div {
    background-color: red;
    color: white;
}

table.calendar > tbody > tr > td.has-events > div > span {
    display: block;
    text-align: center;
}
table.calendar > tbody > tr > td.has-events > div > span a {
    color: white;
}

table.calendar > tbody > tr > td.has-events > div > span.title {
    font-weight: bold;
}

table.table-borderless > thead > tr > th, table.table-borderless > tbody > tr > td {
    border: 0;
}

.table tbody tr.hover td, .table tbody tr.hover th {
    background-color: whiteSmoke;
}
</style>
</head>
<body>

<table class="calendar table table-bordered">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th width="10%">Sunday</th>
            <th width="16%">Monday</th>
            <th width="16%">Tuesday</th>
            <th width="16%">Wednesday</th>
            <th width="16%">Thursday</th>
            <th width="16%">Friday</th>  
            <th width="10%">Saturday</th>  
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <td>09:00</td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

        </tr>

<?php
$host = "localhost";  
$dbUsername = "root";
$dbPassword = "";
$dbname = "procrastination"; 
$chosenList = ucwords($_POST['taskT']); 

/*if (isset($_POST['pickL'])) {
    $tryIt = $_POST['pickL'];
}
echo $tryIt;

//echo mysql_real_escape_string($_POST['pickList']);
//$x= $_POST["pickList"]; 
//echo $x;
$test = $_POST['pickL'];
echo $test;
$chosenList = 'Biology';  */

//$chosenList = mysql_real_escape_string($_POST["pickList"]); 
//echo $chosenList;

//Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

//Check connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

$sql= "SELECT  createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList'
ORDER BY createtask.listTitle
LIMIT 0,3";  

$result = $conn->query($sql);
 
$timestamp = strtotime('9:00');
$time = date('H:i', $timestamp);   

$timestamp = strtotime($time) + 60*60; //increment by 1 hour
$time = date('H:i', $timestamp); 

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){ 
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";
        }
    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
echo "</tr>";    

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 

$sql2= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList' AND createtask.priorityLVL ='h'
ORDER BY createtask.listTitle
LIMIT 0,6";
$tmp=0;

$result = $conn->query($sql2);

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){
        $tmp++;

        //No event if odd idNum
        if($tmp%2==1){
            echo "<td class=\" no-events\" rowspan=\"1\"></td>";
        } 
        //Event if even idNum
        if($tmp%2==0){
            echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 90%; height: 100%;\">";
            echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";     
        }   

    }

    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
echo "</tr>"; 

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp);    

$sql3= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList'
ORDER BY createtask.listTitle
LIMIT 3,3";

$result = $conn->query($sql3);

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){ 
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";
        }
    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
echo "</tr>"; 

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 

$sql4= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList' AND createtask.priorityLVL ='h'
ORDER BY createtask.listTitle
LIMIT 0,7";
$tmp=0;

$result = $conn->query($sql4);

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){
        $tmp++;
        //No event if odd idNum
        if($tmp%2==0){
            echo "<td class=\" no-events\" rowspan=\"1\"></td>";
        } 
        //Event if even idNum
        if($tmp%2==1){
            echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 90%; height: 100%;\">";
            echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";     
        }   
    }

    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
echo "</tr>"; 

$sql5= "SELECT  createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList'
ORDER BY createtask.listTitle
LIMIT 6,3";  

$result = $conn->query($sql5);

$timestamp = strtotime($time) + 60*60; 
$time = date('H:i', $timestamp); 

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){ 
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";
        }
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";  
    }
echo "</tr>"; 

//Free time at 15:00

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 
$tmp=0;

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($tmp!=1){ //Output data in each row
    while($tmp<7){
        $tmp++;
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";} 
    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    } 
echo "</tr>";

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 

$sql6= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList' AND createtask.priorityLVL ='m'
ORDER BY createtask.listTitle
LIMIT 0,6";
$tmp=0;

$result = $conn->query($sql6);

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){
        $tmp++;
        //No event if even idNum
        if($tmp%2==0){
            echo "<td class=\" no-events\" rowspan=\"1\"></td>";
        } 
        //Event if odd idNum
        if($tmp%2==1){
            echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 90%; height: 100%;\">";
            echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";     
        }   
    }

    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>"; 
        //echo "null results"; 
    }
echo "</tr>"; 

$sql7= "SELECT  createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList'
ORDER BY createtask.listTitle
LIMIT 9,3";  

$result = $conn->query($sql7); 

$timestamp = strtotime($time) + 60*60; //increment by 1 hour
$time = date('H:i', $timestamp); 

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){ 
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";
        }
    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>"; 
    }
echo "</tr>";  

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 
$tmp=0;

$sql6= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList' AND createtask.priorityLVL ='m'
ORDER BY createtask.listTitle
LIMIT 0,7";
$tmp=0;

$result = $conn->query($sql6);

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){
        $tmp++;
        //No event if odd idNum
        if($tmp%2==1){
            echo "<td class=\" no-events\" rowspan=\"1\"></td>";
        } 
        //Event if even idNum
        if($tmp%2==0){
            echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 90%; height: 100%;\">";
            echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";     
        }   
    }

    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>"; 
    }
echo "</tr>";

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 
$tmp=0;

$sql8= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList' AND createtask.priorityLVL ='m'
ORDER BY createtask.listTitle
LIMIT 7,7";
$tmp=0;

$result = $conn->query($sql8);

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){        
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 90%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";     
        }   
    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>"; 
    }
echo "</tr>";

$sql9= "SELECT  createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList'
ORDER BY createtask.listTitle
LIMIT 12,3";  

$result = $conn->query($sql9); 

$timestamp = strtotime($time) + 60*60; //increment by 1 hour
$time = date('H:i', $timestamp); 

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){ 
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";
        }
    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>"; 
    }
echo "</tr>";  

// third appearance of task with priority level h
$sql10= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList' AND createtask.priorityLVL ='h'
ORDER BY createtask.listTitle
LIMIT 0,7";

$result = $conn->query($sql10);

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){ 
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";
        }
    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>"; 
    }
echo "</tr>";

$sql11= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList' AND createtask.priorityLVL ='h'
ORDER BY createtask.listTitle
LIMIT 7,7";

$result = $conn->query($sql11);

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){ 
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";
        }
    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>"; 
    }
echo "</tr>";

//Free time at 23:00
$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 
$tmp=0;

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($tmp!=1){ //Output data in each row
    while($tmp<7){
        $tmp++;
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";} 
    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>"; 
    } 
echo "</tr>"; 

$conn->close();
?>

    </tbody>

</table>

</body>
</html> 