<?php
	require_once('startsession.php');
?>
<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style/style.css" />
<title>�d���O</title>
<script language="JavaScript">
function InputCheck(form1) {
  if (form1.nickname.value == "") {
    alert("�п�J�z���ʺ١C");
    form1.nickname.focus();
    return (false);
  }
  if (form1.content.value == "") {
    alert("�d�����e���i���šC");
    form1.content.focus();
    return (false);
  }
}
</script>

</head>
<body>
<div id="container">
<div id="guestbook"><!--�d���C��-->
<h3>�d���C��</h3>
<?php
	// �ޥά������

	require("./conn.php"); //�s�u��
	require("./config.php"); //�ݩ���
	require("menu.php");
	
	
	$query_sql = "SELECT * FROM user";
	$result = mysql_query($query_sql);
	echo '<table>';
	
	while ($row = mysql_fetch_array($result)) {
		echo '<tr><td><a href="board.php?uid='. $row['uid'] .'">'. $row['username'] .' </a></td></tr>';
	}
