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
