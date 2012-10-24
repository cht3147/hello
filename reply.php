<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/login.php");
		exit;
	}
	require("./conn.php");
	if($_POST){
		if(get_magic_quotes_gpc()){
			$reply = htmlspecialchars(trim($_POST['reply']));
		} else {
			$reply = addslashes(htmlspecialchars(trim($_POST['reply'])));
		}
		//¦^´_¬°ªÅ®É¡C±N¦^´_®É¶¡³]¸m¬°ªÅ
		$replytime = $reply?time():'NULL';
		$update_sql = "UPDATE guestbook SET reply = '$reply', replytime = $replytime WHERE id = $_POST[id]";
		if(mysql_query($update_sql)){
			exit('<script language="javascript">alert("¦^´_¦¨¥\");self.location = "admin.php";</script>');
		} else {
			exit('¯d¨¥¥¢±Ñ'.mysql_error().'[ <a href="javascript:history.back()">ªð¦^</a> ]');
		}
	}

	//§R°£¯d¨¥
	if($_GET['action'] == 'delete'){
		$delete_sql = "DELETE FROM guestbook WHERE id = $_GET[id]";
		if(mysql_query($delete_sql)){
			exit('<script language="javascript">alert("§R°£¦¨¥\¡");self.location = "admin.php";</script>');
		} else {
			exit('¯d¨¥¥¢±Ñ'.mysql_error().'[ <a href="javascript:history.back()">·µ »Ø</a> ]');
		}
	}
?>