<!--?php

require('../vendor/autoload.php');
header('Content-type: image/jpeg');


$image_in = new Imagick('test.jpg');

$image_in->blurImage(10,10);
$image_in->borderImage('black', 100, 100);

echo $image_in;

?-->



<?php 
	//header('Content-type:text/html; charset=utf-8');
	
	session_start();
 
	if (isset($_COOKIE['username'])) {
		$_SESSION['username'] = $_COOKIE['username'];
		echo $_SESSION['username'];
		$_SESSION['islogin'] = 1;
		echo "\n";
		echo "<a href='logout.php'>LOGOUT</a>";
	}else {
		echo "Please Login";
		$_SESSION['islogin'] = 0;
		echo "\n";
		echo "<a href='login.html'>LOGIN</a>";
	}
 ?>




 <!DOCTYPE html>
 <html>
 <head>
 	<title>Index</title>
 </head>
 <body>
 	<h1>The photo album.</h1>
    <center>

 	<form action="upload.php" method="POST" enctype="multipart/form-data">
   	Upload Photo: <input type="file" name="image"/>
   	<input type="submit" value="Upload"/>
	</form>

 
 </body>
 </html>

