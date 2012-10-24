<?php
	session_start();

	//檢測是否登錄，若沒登錄則轉向登錄界面
	if(!isset($_SESSION['userid'])){
		header("Location:login.html");
		exit();
	}

	//包含數據庫連接文件
	include('conn.php');
	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	$user_query = mysql_query("select * from user where uid=$userid limit 1");
	$row = mysql_fetch_array($user_query);
	echo '用戶信息：<br />';
	echo '用戶ID：',$userid,'<br />';
	echo '用戶名：',$username,'<br />';
	echo '郵箱：',$row['email'],'<br />';
	echo '註冊日期：',date("Ymd", $row['regdate']),'<br />';
	echo '<a href="login.php?action=logout">註銷</a> 登錄<br /> <a href="index.php">留言板</a>';
?>