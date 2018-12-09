<!doctype html>
<html lang="en" class="no-js">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<style>
table.calendar {
    margin-bottom: 0;
}

table.calendar > thead > tr > th {
    text-align: center; 
}

table.calendar > tbody > tr > td {
    height: 20px;
}

table.calendar > tbody > tr > td > div {
    padding: 8px;
    height: 40px;
    overflow: hidden;
    display: inline-block;
    vertical-align: middle;
    float: left;
}

table.calendar > tbody > tr > td.has-events {
    color: white;
    cursor: pointer;
    padding: 0;
    border-radius: 4px;
}

table.calendar > tbody > tr > td.has-events > div {
    background-color: #08C;
    border-left: 1px solid white;
}

table.calendar > tbody > tr > td.has-events > div:first-child {
    border-left: 0;
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

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

        </tr>

<?php
$host = "localhost";  
$dbUsername = "root";
$dbPassword = "";
$dbname = "procrastination"; 
$chosenList = ucwords($_POST['taskT']); 

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
LIMIT 0,7";  

$result = $conn->query($sql);
 
$timestamp = strtotime('9:00');
$time = date('H:i', $timestamp);   

$timestamp = strtotime($time) + 60*60; //increment by 1 hour
$time = date('H:i', $timestamp); 
$x=0;

//10:00
echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span></div></td>";  
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
}
echo "</tr>";

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp);  

$sql2= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList' AND createtask.priorityLVL ='h'
ORDER BY createtask.listTitle
LIMIT 0,7";
$tmp=0;
$x=0;

$result = $conn->query($sql2);

//11:00
echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
        $tmp++;

        //No event if even idNum
        if($tmp%2==0){
            echo "<td class=\" no-events\" rowspan=\"1\"></td>";
        } 
        //Event if odd idNum
        if($tmp%2==1){
            echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
            echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> </div></td>";     
        }   
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
}
echo "</tr>";

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp);    

$sql3= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList'
ORDER BY createtask.listTitle
LIMIT 7,7";

$result = $conn->query($sql3);
$x=0;

//12:00
echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span></div></td>";  
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
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
$x=0;

$result = $conn->query($sql4);

//13:00
echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
        $tmp++;

        //No event if even idNum
        if($tmp%2==1){
            echo "<td class=\" no-events\" rowspan=\"1\"></td>";
        } 
        //Event if odd idNum
        if($tmp%2==0){
            echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
            echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> </div></td>";     
        }   
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
}
echo "</tr>";

$sql5= "SELECT  createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList'
ORDER BY createtask.listTitle
LIMIT 14,7";  

$result = $conn->query($sql5);

$timestamp = strtotime($time) + 60*60; 
$time = date('H:i', $timestamp); 
$x=0;

//14:00
echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
            echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
            echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> </div></td>";     
           
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
}
echo "</tr>";

//Free time at 15:00
$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 
$tmp=0;
$x=0;

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($tmp!=1){ //Output data in each row
    while($tmp<7){
        $tmp++;
        $x++;
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
$x=0;

$result = $conn->query($sql6);

//16:00
echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
        $tmp++;

        //No event if even idNum
        if($tmp%2==0){
            echo "<td class=\" no-events\" rowspan=\"1\"></td>";
        } 
        //Event if odd idNum
        if($tmp%2==1){
            echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
            echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> </div></td>";     
        }   
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
}
echo "</tr>"; 

$sql7= "SELECT  createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList'
ORDER BY createtask.listTitle
LIMIT 21,7";  

$result = $conn->query($sql7); 

$timestamp = strtotime($time) + 60*60; //increment by 1 hour
$time = date('H:i', $timestamp); 

$x=0;

//17:00 
echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span></div></td>";  
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
}
echo "</tr>"; 

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 


$sql6= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList' AND createtask.priorityLVL ='m'
ORDER BY createtask.listTitle
LIMIT 0,7";
$tmp=0;
$x=0;

$result = $conn->query($sql6);

//18:00
echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
        $tmp++;

        //No event if even idNum
        if($tmp%2==1){
            echo "<td class=\" no-events\" rowspan=\"1\"></td>";
        } 
        //Event if odd idNum
        if($tmp%2==0){
            echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
            echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> </div></td>";     
        }   
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
}
echo "</tr>"; 

$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp);  

$sql8= "SELECT createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList' AND createtask.priorityLVL ='m'
ORDER BY createtask.listTitle
LIMIT 7,7";
$tmp=0;
$x=0; 

$result = $conn->query($sql8);
 
echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span></div></td>";  
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
}
echo "</tr>";

$sql9= "SELECT  createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
FROM createtask  
INNER JOIN createlist    
ON createtask.listTitle=createlist.listTitle AND createlist.listTitle='$chosenList'
ORDER BY createtask.listTitle
LIMIT 28,7";  

$result = $conn->query($sql9); 

$timestamp = strtotime($time) + 60*60; //increment by 1 hour
$time = date('H:i', $timestamp); 
$x=0;
 
echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span></div></td>";  
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
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

$x=0;

echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span></div></td>";  
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
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
$x=0;

echo "<tr>";
echo "<td>". $time ."</td>"; 
for($x=0;$x<7;$x++){ //Output data in each row
    if(($row = $result->fetch_assoc())!=NULL){
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 99%; height: 100%; padding:4px;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span></div></td>";  
    }else{
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";
    }
}
echo "</tr>";

/*echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){ 
        echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";
        }
    }else{ 
        echo "<td class=\" no-events\" rowspan=\"1\"></td>"; 
    }
echo "</tr>"; */

//Free time at 23:00
$timestamp = strtotime($time) + 60*60;
$time = date('H:i', $timestamp); 
$tmp=0;
$x=0;

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($tmp!=1){ //Output data in each row
    while($tmp<7){
        $tmp++;
        $x++;
        echo "<td class=\" no-events\" rowspan=\"1\"></td>";} 
    }else{ 
        while($x<7){
            $x++;
            echo "<td class=\" no-events\" rowspan=\"1\"></td>";
        } 
    } 
echo "</tr>"; 

$conn->close();
?>

    </tbody>

</table>

</body>
</html> 
