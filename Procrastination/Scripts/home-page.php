<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Page Title</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
    box-sizing: border-box;
}
/* Style the body */
body {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
}
/* Header/logo Title */
.header { 
    padding: 50px;
    text-align: left;
    background: #72bbed;
    color: white;
}  
/* Increase the font size of the heading */
.header h1 {
    font-size: 50px;
}
/* Sticky navbar - toggles between relative and fixed, depending on the scroll position. It is positioned relative until a given offset position is met in the viewport - then it "sticks" in place (like position:fixed). The sticky value is not supported in IE or Edge 15 and earlier versions. However, for these versions the navbar will inherit default position */
.sidenav{
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.35s;
    padding-top: 40px;
}
/* Style the navigation bar links */
.sidenav a {
    padding: 8px 8px 8px 28px;
    text-decoration: none;
    font-size: 20px;
    color: #818181;
    display: block;
    transition: 0.3s;
}
/* Change colour on hover */
.sidenav a:hover {
    color: #f1f1f1;
}
/* Close sidebar */
.sidenav .closebtn{
    position: absolute;
    top: 0;
    right: 20px;
    font-size: 34px;
    margin-left: 40px;
}
/* Column container */
.row {  
    display: -ms-flexbox; /* IE10 */
    display: flex;
    -ms-flex-wrap: wrap; /* IE10 */
    flex-wrap: wrap;
}
/* Main */
.main {   
    flex: 80%;
    background-color: white;
    padding: 20px;
}
/* Fake image, just for this example */
.fakeimg {
    background-color: #aaa;
    width: 100%;
    padding: 20px;
}
/* Footer */
.footer {
    padding: 20px;
    text-align: center;
    background: #ddd;
}
/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
    .row {   
        flex-direction: column;
    }
}
/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
    .navbar a {
        float: none;
        width: 100%;
    }
}
</style>
</head>
<body>

    <div class="header">
        <h1>Welcome <?php echo $login_session; ?></h1>
        <h1>Task Manager for Procrastinators</h1>
        <p><b>Version 1.0</b> created by Ginika, Monnie, and Priscilia.</p>
    </div> 

    <span style="font-size:37px;cursor:pointer" onclick="openNav()">&#9776; Menu
    </span>

    <div id = "homeSideNav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">Home</a>
        <a href="list.php">Lists</a>
        <!-- <a href="#">Create New TO-DO List</a> -->
        <a href="task.php">Generate New Task</a>
        <a href="#">Generate a Schedule</a>
        <a href="#">Userboard</a>
        <a href="indexComments.php">Comment Section</a>
        <a href="logout.php">Sign Out</a>
    </div>

  <div class="main">
      <h2>TITLE HEADING</h2>
      <h5>Title description, Dec 7, 2017</h5>
      <div class="fakeimg" style="height:200px;">Image</div>
      <p>Some text..
        <b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum  
      </p>

      <br>

      <h2>TITLE HEADING</h2>
      <h5>Title description, Sep 2, 2017</h5>
      <div class="fakeimg" style="height:200px;">Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
  </div>

<div class="footer">
  <h2>Footer</h2>
</div>

<script>
    function openNav() {
        document.getElementById("homeSideNav").style.width = "250px";
    }
    function closeNav() {
        document.getElementById("homeSideNav").style.width = "0";
    }
</script>


</body>
</html>