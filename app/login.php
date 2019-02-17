
<?php 
	//header('Content-type:text/html; charset=utf-8');
	
	session_start();
 
	
	if (isset($_POST['login'])) {
	
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		if (($username == '') || ($password == '')) {
			header('refresh:3; url=login.html');
			echo "The username and the password cannot be empty";
			exit;
		} elseif (($username == 'admin') && ($password == 'minda123')) {
			$number_of_days = 30;
			$date_of_expiry = time() + 60 * 60 * 24 * $number_of_days;
			setcookie('username', $username, $date_of_expiry);
			header('location:index.php');
			exit;
		}elseif (($username == 'Alice') && ($password == 'csci4140')) {
			$number_of_days = 30;
			$date_of_expiry = time() + 60 * 60 * 24 * $number_of_days;
			setcookie('username', $username, $date_of_expiry);
			header('location:index.php');
		}else {
			header('refresh:3; url=login.html');
			echo "The username or password are incorrect";
			exit;
		} 
	}
 ?>
