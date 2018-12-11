<!DOCTYPE html>
<html>
<head>
	<title>List</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" type="text/css" href="Styles/todos.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">
	<script type="text/javascript" src="Scripts/jquery-2.1.4.min.js"></script>
</head>
<body>

<div class="grid-container">
    <!--<div id="grid-item">
        <h1 id= "header">List Test<i class="fa fa-plus"></i></h1>

        <ul>
            <li><span><i class="fa fa-trash"></i></span> Biology Quiz</li>
            <li><span><i class="fa fa-trash"></i></span> Algebra Final</li>
            <li><span><i class="fa fa-trash"></i></span> Comp Assignment 1</li>
        </ul>
    </div> -->

    <?php
        $host = "localhost"; 
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "procrastination";

        //create connection

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

		$sql= "SELECT  createlist.listTitle, createtask.taskTitle, createtask.priorityLVL 
		From createtask 
		INNER JOIN createlist 
		ON createtask.listTitle=createlist.listTitle
		ORDER BY createtask.listTitle";

        $result = $conn->query($sql);
        $Title = "";
        


		while($row = $result->fetch_assoc())

		{
            if ($Title != $row['listTitle'] ){

                // close list unless it is the first one
                if  ($Title != ""){
                    echo "</u1>";

                    echo "</div>";
                }

                $Title = $row['listTitle'];
                echo "<div id= 'grid-item' ></i>";
                echo "<h1>" . $row['listTitle'] . " <i class='fa fa-plus'></i> </h1>";
                echo "<u1 style='list-style: none;'>";
                
            }

            echo "<li><span><i class='fa fa-trash'></i></span>" . $row['taskTitle'] . "</li>";

        }

    ?>


	
</div>

<script type="text/javascript" src="Scripts/todos.js"></script>

</body>
</html>