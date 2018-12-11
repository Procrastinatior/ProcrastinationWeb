<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="Styles/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="myScript.js"></script> 

    <title>insert</title>
  </head>
  <body>
<?php
include("session.php");

$taskTitle = $_POST['taskTitle'];
$taskDescription = $_POST['taskDescription'];
$listTitle = $_POST['listTitle'];
$Visibility = $_POST['Visibility'];
$Frequency = $_POST['Frequency'];
$dueDate = $_POST['dueDate'];
$priorityLVL =$_POST['priorityLVL'];
$userID = $_SESSION['userID'];

if(!empty($taskTitle)){
    $host = "localhost"; 
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "procrastination";

    //create connection

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
        $SELECT = "SELECT taskTitle From createtask Where taskTitle = ? Limit 1";
        $INSERT = "INSERT Into createtask (userID, taskTitle, taskDescription, listTitle, Visibility, 
            Frequency, dueDate, priorityLVL) values(?, ?, ?, ?, ?, ?, ?, ?)";

        //Prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $taskTitle);
        $stmt->execute();
        $stmt->bind_result($taskTitle);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("isssssss", $userID, $taskTitle, $taskDescription, $listTitle, $Visibility, 
            $Frequency, $dueDate, $priorityLVL);
            $stmt->execute();

            $sql= "SELECT  createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
            From createtask 
            INNER JOIN createlist 
            ON createtask.listTitle=createlist.listTitle
            ORDER BY createtask.listTitle";

            $result = $conn->query($sql);

            echo"<table>

            <tr>

            <th>EmpId</th>

            <th>Firstname</th>

            <th>DeptName</th>

            </tr>";

            while($row = $result->fetch_assoc())

            {

            echo "<tr>";

            echo "<td>" . $row['listTitle'] . "</td>";

            echo "<td>" . $row['taskTitle'] . "</td>";

            echo "<td>" . $row['priorityLVL'] . "</td>";

            echo "</tr>";

            

            }

            echo "</table>";


        } else {
            echo "This task already exist in the system";
        }

        $stmt->close();
        $conn->close();

    }

} else {
    echo "Title is required";
    die();
}
?>
  </body>
</html>