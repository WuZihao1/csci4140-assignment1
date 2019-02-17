<?php
	//$servername = "localhost";
	//$username = "root";
	//$password = "1234";
	//$db = "4140hw1";
 
	//$conn = new mysqli($servername, $username, $password, $db);
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$db = substr($url["path"], 1);

	$conn = new mysqli($server, $username, $password, $db);
 
	if ($conn->connect_error) {
	    die("fail: " . $conn->connect_error);
	} 


	$create_table = "CREATE TABLE IF NOT EXISTS image
	(
		id INT(4) NOT NULL AUTO_INCREMENT, 
		Permission CHAR(10),
		Name CHAR(20),
		Primary Key(id)
	)";

	
	mysqli_query($conn, $create_table);


?>