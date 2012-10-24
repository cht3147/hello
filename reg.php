<!doctype html>
<html>
<head>
<title>會員註冊</title>

<style type="text/css">
    html{font-size:20x;}
    fieldset{width:600px; margin: 0 auto;}
    legend{font-weight:bold; font-size:20px;}
    label{float:left; width:100px; margin-left:14px;}
    .left{margin-left:90px;}
    .input{width:200px;}
    span{color: #666666;}
</style>
</head>
<body>


<?php
	require("config.php");
	require("conn.php");
	
	if (isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password1 = $_POST['repass'];
		$email = $_POST['email'];
		//註冊訊息判斷
		
	
	
		if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
			echo '錯誤：用戶名不符合規定。<a href="reg.php">返回</a>';
			exit();
		}
		if(strlen($password) < 6){
			echo '錯誤：密碼常度不符合規定。<a href="reg.php">返回</a>';
			exit();
		}
		if($password != $password1 ){
			echo '錯誤：兩次密碼不同。<a href="reg.php">返回</a>';
			exit();
		}
		if(!preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/", $email)){
			echo '錯誤：信箱格式錯誤。<a href="reg.php">返回</a>';
			exit();
		}
		
		
		//檢測用戶用戶明是否存在
		$check_query = mysql_query("select uid from user where username='$username' limit 1");
		if(mysql_fetch_array($check_query)){
			echo '錯誤：用戶名 ',$username,'已存在，<a href="reg.php">返回</a>';
			exit();
		}
		//寫入資料庫
		$password = MD5($password);
		$regdate = time();
		$sql = "INSERT INTO user(username,password,email,regdate)VALUES('$username','$password','$email',$regdate)";
		if(mysql_query($sql,$conn)){
			exit('用戶註冊成功！點擊此處 <a href="login.html">登陸</a>');
		} 
		else {
			echo '抱歉！註冊失敗：',mysql_error(),'<br />';
			echo '點擊此此處 <a href="reg.php">返回</a>';
		}
	}
	
	
?>

<fieldset>
<legend>用戶註冊</legend>
<form name="RegForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p>
<label for="username" class="label">用戶名稱：</label>
<input id="username" name="username" type="text" class="input" />
<span>(必填，3-15字)</span>
</p>
<p>
<label for="password" class="label">密碼：</label>
<input id="password" name="password" type="password" class="input" />
<span>(必填，不得少於6位)</span>
</p>
<p>
<label for="repass" class="label">重複密碼：</label>
<input id="repass" name="repass" type="password" class="input" />
</p>
<p>
<label for="email" class="label">電子信箱：</label>
<input id="email" name="email" type="text" class="input" />
<span>(必填)</span>
</p>
<p>
<input type="submit" name="submit" value="註冊" class="left" />
</p>
<p>
</form>
</fieldset>


