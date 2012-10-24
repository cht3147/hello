<?php
	require_once('startsession.php');
?>
<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style/style.css" />
<title>留言板</title>
<script language="JavaScript">
function InputCheck(form1) {
  if (form1.nickname.value == "") {
    alert("請輸入您的暱稱。");
    form1.nickname.focus();
    return (false);
  }
  if (form1.content.value == "") {
    alert("留言內容不可為空。");
    form1.content.focus();
    return (false);
  }
}
</script>

</head>
<body>
<div id="container">
<div id="guestbook"><!--留言列表-->
<h3>留言列表</h3>
<?php
	// 引用相關文件

	require("./conn.php"); //連線檔
	require("./config.php"); //屬性檔
	require("menu.php");
	
	
	$query_sql = "SELECT * FROM user";
	$result = mysql_query($query_sql);
	echo '<table>';
	
	while ($row = mysql_fetch_array($result)) {
		echo '<tr><td><a href="board.php?uid='. $row['uid'] .'">'. $row['username'] .' </a></td></tr>';
	}
