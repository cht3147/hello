<!doctype html>
<html>
<head>
<title>�|�����U</title>

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
		//���U�T���P�_
		
	
	
		if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
			echo '���~�G�Τ�W���ŦX�W�w�C<a href="reg.php">��^</a>';
			exit();
		}
		if(strlen($password) < 6){
			echo '���~�G�K�X�`�פ��ŦX�W�w�C<a href="reg.php">��^</a>';
			exit();
		}
		if($password != $password1 ){
			echo '���~�G�⦸�K�X���P�C<a href="reg.php">��^</a>';
			exit();
		}
		if(!preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/", $email)){
			echo '���~�G�H�c�榡���~�C<a href="reg.php">��^</a>';
			exit();
		}
		
		
		//�˴��Τ�Τ���O�_�s�b
		$check_query = mysql_query("select uid from user where username='$username' limit 1");
		if(mysql_fetch_array($check_query)){
			echo '���~�G�Τ�W ',$username,'�w�s�b�A<a href="reg.php">��^</a>';
			exit();
		}
		//�g�J��Ʈw
		$password = MD5($password);
		$regdate = time();
		$sql = "INSERT INTO user(username,password,email,regdate)VALUES('$username','$password','$email',$regdate)";
		if(mysql_query($sql,$conn)){
			exit('�Τ���U���\�I�I�����B <a href="login.html">�n��</a>');
		} 
		else {
			echo '��p�I���U���ѡG',mysql_error(),'<br />';
			echo '�I�������B <a href="reg.php">��^</a>';
		}
	}
	
	
?>

<fieldset>
<legend>�Τ���U</legend>
<form name="RegForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p>
<label for="username" class="label">�Τ�W�١G</label>
<input id="username" name="username" type="text" class="input" />
<span>(����A3-15�r)</span>
</p>
<p>
<label for="password" class="label">�K�X�G</label>
<input id="password" name="password" type="password" class="input" />
<span>(����A���o�֩�6��)</span>
</p>
<p>
<label for="repass" class="label">���ƱK�X�G</label>
<input id="repass" name="repass" type="password" class="input" />
</p>
<p>
<label for="email" class="label">�q�l�H�c�G</label>
<input id="email" name="email" type="text" class="input" />
<span>(����)</span>
</p>
<p>
<input type="submit" name="submit" value="���U" class="left" />
</p>
<p>
</form>
</fieldset>


