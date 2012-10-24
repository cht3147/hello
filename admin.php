<?php
	session_start();
	// 未登入定向到登入畫面
	if(!isset($_SESSION['username'])){
		header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/login.php");
		exit;
	}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset='big5'">
<link rel="stylesheet" type="text/css" href="style/style.css" />
<title>留言管理</title>
</head>
<body>
<div id="container">
<div id="guestbook"><!--留言列表-->
<h3>留言列表</h3>
<?php
	// 引用相關文件
	require("./conn.php");
	require("./config.php");
	require("menu.php");
	
	// 確認當前頁數
	$p = $_GET['p']?$_GET['p']:1;
	// 數據統計
	$offset = ($p-1)*$pagesize;

	$query_sql = "SELECT * FROM guestbook where uid =". $_SESSION['uid'] ." ORDER BY id DESC LIMIT  $offset , $pagesize";
	$result = mysql_query($query_sql);
	// 如果出現錯誤並登出
	if(!$result) exit('查詢錯誤：'.mysql_error());
	// 循環輸出
	while($gb_array = mysql_fetch_array($result)){
?>
<div class="guestbook-list">
<p class="guestbook-head">
<img src="images/<?=$gb_array['face']?>.gif" />
<span class="bold"><?=$gb_array['nickname']?></span> <span class="guestbook-time">[<?=date("Y-m-d H:i:s", 
$gb_array['createtime'])?>]</span><span> ID?：<?=$gb_array['id']?> 留言者IP：
<?=$gb_array['clientip']?> <a href="reply.php?action=delete&id=<?=$gb_array['id']?>
">刪除留言</a> </span></p>
<p class="guestbook-content"><?=nl2br($gb_array['content'])?></p>
<form id="form1" name="form1" method="post" action="reply.php">
<p><label for="reply">回復本條留言:</label></p>
<textarea id="reply" name="reply" cols="40" rows="5"><?=$gb_array['reply']?></textarea>
<p>
<input name="id" type="hidden" value="<?=$gb_array['id']?>" />
<input type="submit" name="submit" value="回復留言" />
</p>
</form>
</div>
<?php
	}	//while循環結束
?>
<div class="guestbook-list guestbook-page">
<p>
<?php
	//計算留言頁數
	$count_result = mysql_query("SELECT count(*) FROM guestbook where uid = ". $_SESSION['uid'] ."");
	$count_array = mysql_fetch_array($count_result);
	$pagenum = ceil($count_array['count(*)']/$pagesize);
	echo '共 ',$count_array['count(*)'],' 封留言';
	if ($pagenum > 1) {
		for($i=1;$i<=$pagenum;$i++) {
			if($i==$p) {
				echo '&nbsp;[',$i,']';
			} else {
				echo '&nbsp;<a href="admin.php?p=',$i,'">'.$i.'</a>';
			}
		}
	}
?>
</p>
</div>
</div><!--留言列表結束-->


</div><!--container-->
</body>
</html>