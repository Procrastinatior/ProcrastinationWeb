<?php
$taskTitle = $_POST['taskTitle'];
$taskDescription = $_POST['taskDescription'];
$Visibility = $_POST['Visibility'];
$Frequency = $_POST['Frequency'];
$dueDate = $_POST['dueDate'];
$priorityLVL =$_POST['priorityLVL'];

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
        $INSERT = "INSERT Into createtask (taskTitle, taskDescription, Visibility, 
            Frequency, dueDate, priorityLVL) values(?, ?, ?, ?, ?, ?)";
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
            $stmt->bind_param("ssssss", $taskTitle, $taskDescription, $Visibility, 
            $Frequency, $dueDate, $priorityLVL);
            $stmt->execute();

            echo "New record inserted sucessfully";
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