<?php
include("session.php");


function setComments($db) {
  if(isset($_POST['commentSubmit'])){
      $firstname = $_SESSION['login_user'];
      $date = $_POST['date'];
      $message = $_POST['message'];
     
        


     $sql = "INSERT INTO comment (username,date,message) VALUES('$firstname','$date','$message')";
     $result= mysqli_query($db,$sql);
  }
}

function getComments($db){
    $sql="SELECT * FROM comment";
    $result= mysqli_query($db,$sql);
    
    

    while($row = $result->fetch_assoc()){
      $_SESSION['commentId'] = $row['id'];
         echo "<div class='comment-box'><p>";
           echo $row['username']."<br>";
           echo $row['date']."<br>";
           echo $row['message'];
         echo "</p>
      <form class='reply-form' method='POST' action='replycomment.php'>
         <input type='hidden' name='id' value='".$row['id']."'>
         <input type='hidden' name='firstname' value='".$row['username']."'>
         <input type='hidden' name='date' value='".$row['date']."'>
         <input type='hidden' name='message' value='".$row['message']."'>
      <button>Reply</button>
      </form>
      <form class='delete-form' method='POST' action='".deleteComments($db)."'>
         <input type='hidden' name='id' value='".$row['id']."'>
         <button type='submit' name='commentDelete'>Delete</button>
       </form>
		     <form class='edit-form' method='POST' action='editcomment.php'>
			      <input type='hidden' name='id' value='".$row['id']."'>
			      <input type='hidden' name='firstname' value='".$row['username']."'>
			      <input type='hidden' name='date' value='".$row['date']."'>
			      <input type='hidden' name='message' value='".$row['message']."'>
			<button>Edit</button>
		</form>
    </div>";
         getReplies($db);
     }
}

function editComments($db){
  if(isset($_POST['commentSubmit'])){
    $id = $_POST['id'];
    $firstname = $_SESSION['login_user'];
    $date = $_POST['date'];
    $message = $_POST['message'];
   
      


   $sql = "UPDATE comment SET message='$message' WHERE id='$id'";
   $result= mysqli_query($db,$sql);
   header("Location: indexComments.php");
  }
}
function deleteComments($db){
  if(isset($_POST['commentDelete'])){
    $id = $_POST['id'];
    


   $sql = "DELETE FROM comment WHERE id='$id'";
   $result= mysqli_query($db,$sql);
   header("Location: indexComments.php");
   }   
}
function setReplies($db){
  if(isset($_POST['replySubmit'])){
    $firstname = $_SESSION['login_user'];
    $commentId = $_SESSION['commentId'];
    $date = $_POST['date'];
    $message = $_POST['message'];
   
      


   $sql = "INSERT INTO reply (username,comment_Id,time_updated,replied_message) VALUES('$firstname','$commentId','$date','$message')";
   $result= mysqli_query($db,$sql);
   header("Location: indexComments.php");
  }
}
function getReplies($db){
    $current=$_SESSION['commentId'];
    $sql="SELECT * FROM reply WHERE comment_Id='$current'";
    $result= mysqli_query($db,$sql);

    while($row = $result->fetch_assoc()){
      echo "<div class='comment-box' style='left-margin:200px;'><p>";
        echo $row['username']."<br>";
        echo $row['time_updated']."<br>";
        echo $row['replied_message'];
      echo "</p></div>";
    }
}



  