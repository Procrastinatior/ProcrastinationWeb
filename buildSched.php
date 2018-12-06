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
        <tr>
            <td>09:30</td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

        </tr>
        <tr>
            <td>10:00</td>

            <td class=" has-events" rowspan="2">

                <div class="row-fluid lecture" style="width: 90%; height: 100%;">


                    <span class="title">TASK1</span> <span class="lecturer"><a>Priority
                            </a></span> <span class="location">23/111</span>
                </div>
            </td>
  
            <td class=" has-events" rowspan="2">

                <div class="row-fluid lecture" style="width: 90%; height: 100%;"><b>


                    <span class="title">TASK2</span> <span class="lecturer"><a>Priority<span class="location">44/654</span>

                </div>
            </td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" has-events" rowspan="4">

                <div class="row-fluid lecture" style="width: 90%; height: 100%;">


                    <span class="title">TASK3</span> <span class="lecturer"><a>Priority
                            </a></span> <span class="location">54/222</span>
                </div>
            </td>

            <td class=" no-events" rowspan="1"></td>

        </tr>
        <tr>
            <td>10:30</td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

        </tr>
        <tr>
            <td>11:00</td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

        </tr>
        <tr>
            <td>11:30</td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

        </tr>
        <tr>
            <td>12:00</td>

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

//Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

//Check connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

$sql = "SELECT taskTitle, taskDescription, priorityLVL FROM listOfTasks LIMIT 0,5";
$result = $conn->query($sql); 
 
$timestamp = strtotime('12:00');
$time = date('H:i', $timestamp);   
$tmp = 0;

$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result->num_rows > 0){ //Output data in each row
    while($row = $result->fetch_assoc()){
        $tmp++;
        //if($tmp<7){ 
        //echo "<td class=\" has-events\" rowspan=\"1\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }
        
        //No event if even
        if($tmp%2==1){
            echo "<td class=\" no-events\" rowspan=\"2\"></td>";
        } 
        //Event if odd
        if($tmp%2!=0){
            echo "<td class=\" has-events\" rowspan=\"2\"><div class=\"row-fluid lecture\" style=\"width: 90%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>";     
        }    
    
    }
        //echo "<td class=\" no-events\" rowspan=\"1\"></td>";} }
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";    

$sql3 = "SELECT taskTitle, taskDescription, priorityLVL FROM listOfTasks";
$result3 = $conn->query($sql);

$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 
$tmp3=0;  

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result3->num_rows > 0){ //Output data in each row
    while($row = $result3->fetch_assoc()){
        $tmp3++;
        if($tmp3<5){ 
        //echo "<td class=\" has-events\" rowspan=\"3\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        echo "<td class=\" no-events\" rowspan=\"2\"></td>";} } 
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";  


/*$sql2 = "SELECT taskTitle, taskDescription, priorityLVL FROM listOfTasks WHERE priorityLVL='hi'";
$result2 = $conn->query($sql2);
$tmp2=0;

$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 

echo "<tr><td>". $time ."</td>"; 
if($result2->num_rows > 0){ //Output data in each row
    while($row = $result2->fetch_assoc()){
        $tmp2++;
        if($tmp2<5){ 
        echo "<td class=\" has-events\" rowspan=\"2\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        //echo "<td class=\" no-events\" rowspan=\"1\"></td>";} }
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>"; */

$sqlT = "SELECT taskTitle, taskDescription, priorityLVL FROM listOfTasks LIMIT 4,3";
$resultT = $conn->query($sqlT);
$tmpT=0;
 
$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 

echo "<tr><td>". $time ."</td>"; 
if($resultT->num_rows > 0){ //Output data in each row
    while($row = $resultT->fetch_assoc()){
        $tmpT++;
        if($tmpT<5){ 
        echo "<td class=\" has-events\" rowspan=\"2\"><div class=\"row-fluid lecture\" style=\"width: 90%; height: 100%;\">";
        echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        //echo "<td class=\" no-events\" rowspan=\"1\"></td>";} }
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";

$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 
$tmp4=0;  

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result3->num_rows > 0){ //Output data in each row
    while($tmp4<8){
        $tmp4++; 
        //if($tmp4<8){ 
        //echo "<td class=\" has-events\" rowspan=\"3\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        echo "<td class=\" no-events\" rowspan=\"2\"></td>";}// } 
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>"; 

$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 
$tmp5=0;  

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result3->num_rows > 0){ //Output data in each row
    while($tmp5<8){
        $tmp5++; 
        //if($tmp4<8){ 
        //echo "<td class=\" has-events\" rowspan=\"3\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        echo "<td class=\" no-events\" rowspan=\"2\"></td>";}// } 
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";
$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 
$tmp6=0;  

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result3->num_rows > 0){ //Output data in each row
    while($tmp6<8){
        $tmp6++; 
        //if($tmp4<8){ 
        //echo "<td class=\" has-events\" rowspan=\"3\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        echo "<td class=\" no-events\" rowspan=\"2\"></td>";}// } 
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";

$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 
$tmp4=0;  

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result3->num_rows > 0){ //Output data in each row
    while($tmp4<8){
        $tmp4++; 
        //if($tmp4<8){ 
        //echo "<td class=\" has-events\" rowspan=\"3\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        echo "<td class=\" no-events\" rowspan=\"2\"></td>";}// } 
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";
$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 
$tmp4=0;  

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result3->num_rows > 0){ //Output data in each row
    while($tmp4<8){
        $tmp4++; 
        //if($tmp4<8){ 
        //echo "<td class=\" has-events\" rowspan=\"3\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        echo "<td class=\" no-events\" rowspan=\"2\"></td>";}// } 
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";
$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 
$tmp4=0;  

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result3->num_rows > 0){ //Output data in each row
    while($tmp4<8){
        $tmp4++; 
        //if($tmp4<8){ 
        //echo "<td class=\" has-events\" rowspan=\"3\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        echo "<td class=\" no-events\" rowspan=\"2\"></td>";}// } 
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";

$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 
$tmp4=0;  

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result3->num_rows > 0){ //Output data in each row
    while($tmp4<8){
        $tmp4++; 
        //if($tmp4<8){ 
        //echo "<td class=\" has-events\" rowspan=\"3\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        echo "<td class=\" no-events\" rowspan=\"2\"></td>";}// } 
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";

$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 
$tmp4=0;  

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result3->num_rows > 0){ //Output data in each row
    while($tmp4<8){
        $tmp4++; 
        //if($tmp4<8){ 
        //echo "<td class=\" has-events\" rowspan=\"3\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        echo "<td class=\" no-events\" rowspan=\"2\"></td>";}// } 
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";
$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 
$tmp4=0;  

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result3->num_rows > 0){ //Output data in each row
    while($tmp4<8){
        $tmp4++; 
        //if($tmp4<8){ 
        //echo "<td class=\" has-events\" rowspan=\"3\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        echo "<td class=\" no-events\" rowspan=\"2\"></td>";}// } 
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";
$timestamp = strtotime($time) + 60*60*.5;
$time = date('H:i', $timestamp); 
$tmp4=0;  

echo "<tr>";
echo "<td>". $time ."</td>"; 
if($result3->num_rows > 0){ //Output data in each row
    while($tmp4<8){
        $tmp4++; 
        //if($tmp4<8){ 
        //echo "<td class=\" has-events\" rowspan=\"3\"><div class=\"row-fluid lecture\" style=\"width: 95%; height: 100%;\">";
        //echo "<span class=\"title\">" . $row["taskTitle"] . "</span> <span class=\"lecturer\"><a>" . $row["priorityLVL"] . "</a></span> <span class=\"location\">23/111</span></div></td>"; }}
        echo "<td class=\" no-events\" rowspan=\"2\"></td>";}// } 
        //echo "<br> taskTitle: ". $row["taskTitle"]. "  " . "Description: ". $row["taskDescription"]. "  " . "Priority: ". $row["priorityLVL"] . "<br>"; }
    }else{ 
        echo "null results";
    }
echo "</tr>";

$conn->close();
?>

       <tr>
            <td>19:00</td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

            <td class=" no-events" rowspan="1"></td>

        </tr>

        <tr>
            <td>19:30</td>

            <td class=" has-events" rowspan="2">

                <div class="row-fluid lecture" style="width: 99%; height: 100%;">

                    <span class="title">TASK A</span> <span class="lecturer"><a>PrLVL</a></span> <span class="location">111</span>
                </div>
            </td>

            <td class=" has-events" rowspan="2">

                <div class="row-fluid lecture" style="width: 90%; height: 100%;">

                    <span class="title">TASK B</span> <span class="lecturer"><a>PrLVL</a></span> <span class="location">222</span>

                </div>
            </td>

            <td class=" no-events" rowspan="2"></td>

            <td class=" has-events" rowspan="2">

                <div class="row-fluid lecture" style="width: 90%; height: 100%;">


                    <span class="title">TASK C</span> <span class="lecturer"><a>PrLVL</a></span><span class="location">123</span>
                </div>
            </td>

            <td class=" no-events" rowspan="2"></td>

        </tr>

    </tbody>

</table>

</body>
</html> 