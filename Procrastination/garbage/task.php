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
    <script src="Scripts/myScript.js"></script> 

    <title>Create Task</title>
  </head>
  <body>

      <div class="jumbotron jumbotron-fluid text-center" style="margin-bottom:0">
        <div class="container"> 
          <h1> Procrastination </h1>
          <blockquote class="blockquote mb-0">
            <p>"Never put off till tomorrow what may be done day after tomorrow just as well."</p>
            <footer class="blockquote-footer">Mark Twain in <cite title="Source Title">Source Title</cite></footer>
          </blockquote>
        </div>
      </div>

      <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <a class="navbar-brand" href="#" id="icon">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>    
          </ul>

            <!--Search box to search user ?-->
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>  
       </nav>



        <div class="container" style="margin-top:30px" >

            <form action="Scripts/insert.php" method="POST">
                <div class="form-group">
                  <label for="taskTitle">Title of the Task</label>
                  <input type="text" class="form-control" id="taskTitle" name="taskTitle" required>
                </div>
                <div class="form-group">
                  <label for="taskDescription">Description of the Task</label>
                  <textarea class="form-control" id="taskDescription" rows="3" name="taskDescription"></textarea>
                </div>

                <div class="form-group">
                  <label for="listTitle">Choose a List</label>
                  <button type="submit" class="btn btn-outline-secondary btn-sm float-right" onclick= "window.location = 'createList.html'">create a List</button>
                  <select class="custom-select mr-sm-2" id="listTitle" name="listTitle">
                    <option selected hidden value="">Choose...</option>
                    <?php
                        //echo "<option selected >Choose...</option>";
                        $conn = mysqli_connect("localhost", "root", "", "procrastination");
                        // Check connection
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                        } 
                        $sql = "SELECT listTitle From createlist";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $value = "test";
                            //echo ("<option value= " '. $row['listTitle']. ' ">" . $row["listTitle"]. "</option>");
                            echo('<option value="'.$row['listTitle'].' ">'.$row['listTitle'].'</option>');
                        }
                        } else { echo "0 results"; }
                        $conn->close();
                    ?>
                  </select>
                </div>

                <div class="form-group">
                    <label >Visibility: </label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="publicCheckbox" name="Visibility" value="pub" >
                    <label class="form-check-label" for="inlineCheckbox1">Public</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="privateCheckbox" name="Visibility" value="pri" >
                    <label class="form-check-label" for="inlineCheckbox2">Private</label>
                  </div>
                </div>

                <div class="form-group">
                    <label >Frequency: </label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="onceCheckbox" name="Frequency" value="o" data-toggle="collapse" data-target="#dueDate">
                    <label class="form-check-label" for="inlineCheckbox1">Once</label>
                  </div>
                  <!--
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="recurrentCheckbox" name="Frequency" value="r" >
                    <label class="form-check-label" for="inlineCheckbox2">Recurrent</label>
                  </div>-->
                </div>

                <div class="form-group form-inline collapse" id="dueDate">
                    <label for="inputDate" class="pr-2">Due Date:</label>
                      <input type="date" id="inputDate" class="form-control" aria-describedby="dueDateHelpInline" name="dueDate">
                </div>

                <div class="form-group">
                    <label for="priorityLevel">Priority</label>
                    <select class="custom-select mr-sm-2" id="priorityLevel" name="priorityLVL">
                      <option selected hidden value="">Choose...</option>
                      <option value="l">Low</option>
                      <option value="m">Medium</option>
                      <option value="h">High</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary float-right">Submit</button>
                <br>
            </form>
        </div>
        <div> </div>

  </body>
</html>