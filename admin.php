<?php
	session_start();
	// ���n�J�w�V��n�J�e��
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
<title>�d���޲z</title>
</head>
<body>
<div id="container">
<div id="guestbook"><!--�d���C��-->
<h3>�d���C��</h3>
<?php
	// �ޥά������
	require("./conn.php");
	require("./config.php");
	require("menu.php");
	
	// �T�{��e����
	$p = $_GET['p']?$_GET['p']:1;
	// �ƾڲέp
	$offset = ($p-1)*$pagesize;

	$query_sql = "SELECT * FROM guestbook where uid =". $_SESSION['uid'] ." ORDER BY id DESC LIMIT  $offset , $pagesize";
	$result = mysql_query($query_sql);
	// �p�G�X�{���~�õn�X
	if(!$result) exit('�d�߿��~�G'.mysql_error());
	// �`����X
	while($gb_array = mysql_fetch_array($result)){
?>
<div class="guestbook-list">
<p class="guestbook-head">
<img src="images/<?=$gb_array['face']?>.gif" />
<span class="bold"><?=$gb_array['nickname']?></span> <span class="guestbook-time">[<?=date("Y-m-d H:i:s", 
$gb_array['createtime'])?>]</span><span> ID?�G<?=$gb_array['id']?> �d����IP�G
<?=$gb_array['clientip']?> <a href="reply.php?action=delete&id=<?=$gb_array['id']?>
">�R���d��</a> </span></p>
<p class="guestbook-content"><?=nl2br($gb_array['content'])?></p>
<form id="form1" name="form1" method="post" action="reply.php">
<p><label for="reply">�^�_�����d��:</label></p>
<textarea id="reply" name="reply" cols="40" rows="5"><?=$gb_array['reply']?></textarea>
<p>
<input name="id" type="hidden" value="<?=$gb_array['id']?>" />
<input type="submit" name="submit" value="�^�_�d��" />
</p>
</form>
</div>
<?php
	}	//while�`������
?>
<div class="guestbook-list guestbook-page">
<p>
<?php
	//�p��d������
	$count_result = mysql_query("SELECT count(*) FROM guestbook where uid = ". $_SESSION['uid'] ."");
	$count_array = mysql_fetch_array($count_result);
	$pagenum = ceil($count_array['count(*)']/$pagesize);
	echo '�@ ',$count_array['count(*)'],' �ʯd��';
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
</div><!--�d���C����-->


</div><!--container-->
</body>
</html>