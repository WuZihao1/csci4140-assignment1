<?php
	



	if(isset($_POST['continue'])){
		include "mysql.php";
		$drop = "Drop Table IF EXISTS image";

		mysqli_query($conn, $drop);

		mysqli_query($conn, $create_table);

		deldir("Public/");
		deldir("Private/");
		header("location: login.html");
		exit;
	}
	if(isset($_POST['back'])){
		header("location: index.php");
		exit;

	}

	function deldir($path){
		if(is_dir($path)){
	     	$p = scandir($path);
	       	foreach($p as $val){       
				if($val !="." && $val !=".."){
					if(is_dir($path.$val)){			                        
			 			deldir($path.$val.'/');			                      
			     	}
			    	else{
				   		unlink($path.$val);
			    	}
				}
	        }
	    }
	}



?>




<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="post"> 
    <input type="submit" name="continue" id="continue" value="Go ahead" />
	</form>

	<form method="post"> 
    <input type="submit" name="back" id="back" value="Go back" />
	</form>

</body>
</html>



