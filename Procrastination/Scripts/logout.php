<?php
session_start();
session_destroy();

echo "You have been logged out.";
?>
<h2><a href = "login.php">Login in</a></h2>