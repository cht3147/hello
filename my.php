<?php
	session_start();

	//�˴��O�_�n���A�Y�S�n���h��V�n���ɭ�
	if(!isset($_SESSION['userid'])){
		header("Location:login.html");
		exit();
	}

	//�]�t�ƾڮw�s�����
	include('conn.php');
	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	$user_query = mysql_query("select * from user where uid=$userid limit 1");
	$row = mysql_fetch_array($user_query);
	echo '�Τ�H���G<br />';
	echo '�Τ�ID�G',$userid,'<br />';
	echo '�Τ�W�G',$username,'<br />';
	echo '�l�c�G',$row['email'],'<br />';
	echo '���U����G',date("Ymd", $row['regdate']),'<br />';
	echo '<a href="login.php?action=logout">���P</a> �n��<br /> <a href="index.php">�d���O</a>';
?>