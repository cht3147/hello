<?php
	include('conn.php');
	
	session_start();
	//註銷登錄
	
	if (!isset($_SESSION['uid'])) {
		if(isset($_POST['submit'])) {
			$username = htmlspecialchars($_POST['username']);
			$password = MD5($_POST['password']);
			
			if (!empty($username) && !empty($password)){
				$check_query = mysql_query("select uid from user where username='$username' and password='$password' limit 1");
	
				if($result = mysql_fetch_array($check_query)){
				//登錄成功
				$_SESSION['username'] = $username;
				$_SESSION['uid'] = $result['uid'];				
	
				$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
				header('Location: ' . $home_url);			
				
				exit;
			} 
			else {
				exit('登錄失敗！點擊此處<a href="login.php">返回</a> 重試');
			}
			}
		}
	}
	else if (isset($_SESSION['uid'])){
		echo '已經登陸<a href="index.php">返回主頁</a>';
	}

?>
<!doctype html>
<html>

<style type="text/css">
    html{font-size:12px;}
    fieldset{width:520px; margin: 0 auto;}
    legend{font-weight:bold; font-size:14px;}
    label{float:left; width:70px; margin-left:10px;}
    .left{margin-left:80px;}
    .input{width:150px;}
    span{color: #666666;}
</style>
<body>
<div>
<fieldset>
	<legend>用戶登錄</legend>
	<form name="LoginForm" method="post" action="login.php" onSubmit="return InputCheck(this)">
	<p>
	<label for="username" class="label">用戶名:</label>
	<input id="username" name="username" type="text" class="input" />
	<p/>
	<p>
	<label for="password" class="label">密碼:</label>
	<input id="password" name="password" type="password" class="input" />
	<p/>
	<p>
	<input type="submit" name="submit" value=" 確定" class="left" />
	</p>
	</form>
</fieldset>
</div>
</body>
</html>