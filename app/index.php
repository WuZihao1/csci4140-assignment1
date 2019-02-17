<!--?php

require('../vendor/autoload.php');
header('Content-type: image/jpeg');


$image_in = new Imagick('test.jpg');

$image_in->blurImage(10,10);
$image_in->borderImage('black', 100, 100);

echo $image_in;

?-->



<?php 
	
	
	session_start();

	include "mysql.php";
	//$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	//$server = $url["host"];
	//$username = $url["user"];
	//$password = $url["pass"];
	//$db = substr($url["path"], 1);

	//$conn = new mysqli($server, $username, $password, $db);




 
	if (isset($_COOKIE['username'])) {
		$_SESSION['username'] = $_COOKIE['username'];
		echo $_SESSION['username'];
		$_SESSION['islogin'] = 1;
		echo "\n";
		echo "<a href='logout.php'>LOGOUT</a>";

		echo '<br>';

		$username = $_COOKIE['username'];

		$query = "Select id, Permission, Name from image where Permission = 'Public' or Permission = '".$username."' order by id DESC";

		$result = mysqli_query($conn, $query);
		$num=mysqli_num_rows($result); 
		$totalPage=ceil($num/8);
		$paths = array();

		$j=0;
		while($row = $result->fetch_assoc()) {
        	if($row["Permission"] != "Public"){
        		$path = "Private/".$row["Name"];
        	}else{
        		$path = "Public/".$row["Name"];
        	}
        	$paths[$j] = $path;

        	$j++;
        	//echo "<img src=".$path." height=200 width=200>";
		}
	    	

	}else {
		echo "Please Login";
		$_SESSION['islogin'] = 0;
		echo "\n";
		echo "<a href='login.html'>LOGIN</a>";

		$query = "Select id, Permission, Name from image where Permission = 'Public' order by id DESC";

		$result = mysqli_query($conn, $query);
		$num=mysqli_num_rows($result); 
		$totalPage=ceil($num/8);

		$paths = array();

		$j=0;
		while($row = $result->fetch_assoc()) {	
        	$path = "Public/".$row["Name"];
        	$paths[$j] = $path;
        	$j++;
        	//echo "<img src=".$path." height=200 width=200>";
		}
	}


	
	if(!isset($_COOKIE['page'])){
		$page = 1;
	}else{
		$page=$_COOKIE['page'];
	}

	

	$top=min($page*8, $num);
	$bottom=$page-1;
	$bottom=$bottom*8;

	for($i=$bottom;$i<$top;++$i){

		echo "<img src=".$paths[$i]." height=200 width=200 >";
		echo '<a href='.$paths[$i].'>'.__DIR__.'/'.$paths[$i].'</a><br>';
	}


	echo '</tr>';
	echo '<tr>';

	echo '<td><form method="post">
    		<input type="submit" name="pre" id="pre" value="Rrevious Page" /><br/>
			</form></td>';

	echo '<td>'.$page.'/'.$totalPage.'</td>';

	echo '<td><form method="post">
    	<input type="submit" name="next" id="next" value="Next Page" /></td>';//row 3,cell3
	echo '</form></tr>';

	if(isset($_POST['pre'])){
		if($page > 1){
			$page=$page-1;
			$number_of_minutes = 30;
			$date_of_expiry = time() + 60 * $number_of_minutes;
			setcookie( "page",$page,$date_of_expiry,"/");
			header("location:index.php");
		}
	}

	if(isset($_POST['next'])){
		if($page < $totalPage){
	  		$page++;
	 	}
		$number_of_minutes = 30;
		$date_of_expiry = time() + 60 * $number_of_minutes;
	   	setcookie( "page",$page,$date_of_expiry,"/");
	   	header("location:index.php");
	}


	if(isset($_SESSION["username"]) && $_SESSION["username"] == "admin"){
		echo '<form action="init.php"> 
    <input type="submit" name="init" value="Initialization" " /> 
	</form>';
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
 		Upload Mode: <br><input type="radio" name="mode" value="Public" checked="Public">Public
		<input type="radio" name="mode" value="Private">Private
		<br>
   		Upload Photo: <input type="file" name="image"/>
   		<input type="submit" value="Upload"/>
	</form>

	<!--div class="testswitch">
		<input class="testswitch-checkbox" id="onoffswitch" type="checkbox">
		<label class="testswitch-label" for="onoffswitch">
				<span class="testswitch-inner" data-on="Public" data-off="Private"></span>
				<span class="testswitch-switch"></span>
		</label>
	</div-->



 
 </body>
 </html>

