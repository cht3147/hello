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
		//回復為空時。將回復時間設置為空
		$replytime = $reply?time():'NULL';
		$update_sql = "UPDATE guestbook SET reply = '$reply', replytime = $replytime WHERE id = $_POST[id]";
		if(mysql_query($update_sql)){
			exit('<script language="javascript">alert("回復成功");self.location = "admin.php";</script>');
		} else {
			exit('留言失敗'.mysql_error().'[ <a href="javascript:history.back()">返回</a> ]');
		}
	}

	//刪除留言
	if($_GET['action'] == 'delete'){
		$delete_sql = "DELETE FROM guestbook WHERE id = $_GET[id]";
		if(mysql_query($delete_sql)){
			exit('<script language="javascript">alert("刪除成功�");self.location = "admin.php";</script>');
		} else {
			exit('留言失敗'.mysql_error().'[ <a href="javascript:history.back()">殿 隙</a> ]');
		}
	}
?>