
<?php 
	//header('Content-type:text/html; charset=utf-8');
	// 开启Session
	session_start();
 
	// 处理用户登录信息
	if (isset($_POST['login'])) {
		# 接收用户的登录信息
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		// 判断提交的登录信息
		if (($username == '') || ($password == '')) {
			// 若为空,视为未填写,提示错误,并3秒后返回登录界面
			header('refresh:3; url=login.html');
			echo "The username and the password cannot be empty";
			exit;
		} elseif (($username == 'admin') && ($password == 'minda123')) {
			//$_SESSION['username'] = $username;
			//$_SESSION['authenticated'] = 1;
			$number_of_days = 30;
			$date_of_expiry = time() + 60 * 60 * 24 * $number_of_days;
			setcookie('username', $username, $date_of_expiry);
			//setcookie('password', $password, $date_of_expiry);
			//setcookie('islogin', 'yes', $date_of_expiry);
			header('location:index.php');
			exit;
		}elseif (($username == 'Alice') && ($password == 'csci4140')) {
			//$_SESSION['username'] = $username;
			//$_SESSION['authenticated'] = 1;		
			$number_of_days = 30;
			$date_of_expiry = time() + 60 * 60 * 24 * $number_of_days;
			setcookie('username', $username, $date_of_expiry);
			//setcookie('password', $password, $date_of_expiry);
			//setcookie('islogin', 'yes', $date_of_expiry);
			header('location:index.php');
		}else {
			# 用户名或密码错误,同空的处理方式
			header('refresh:3; url=login.html');
			echo "The username or password are incorrect";
			exit;
		} 
	}
 ?>
