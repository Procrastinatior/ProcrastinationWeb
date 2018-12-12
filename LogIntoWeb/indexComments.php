<?php
   
    include 'comments.inc.php';
    date_default_timezone_set('Asia/Bangkok');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="body">

<?php
echo "<form method='POST' action='".setComments($db)."'>
   	<input type='hidden' name='firstname' value='firstname'>
   	<input type='hidden' name='date' value='".date('Y-m-d H:i:S')."'>
   	<textarea name='message'></textarea><br>
   	<button name='commentSubmit' type='submit'>Comment</button>
</form>";

getComments($db);
?>
</body>
</html>

<?php
          
         echo "<form role='form' class='col-xs-6' action='".setComments($db)."'>
            
               <div class='form-group'>
                 <input type='hidden' class='form-control' id='firstname'  name='firstname' required>
                </div>
                <div class='form-group'>
                  <input type='hidden' class='form-control' id='".date('Y-m-d H:i:S')."' name='date' required>
                </div>
                <div class='form-group form-group-lg'>
                    <input type='text' class='form-control' id='comment' placeholder='Post Comment' name='comment'>
                </div>
                <div class='form-group'>
                   
                   <button name='postSubmit' type='submit'>Post</button>
                </div>
             
		 </form>";
		 getComments($db);
         ?>
