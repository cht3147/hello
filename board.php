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
	


	$_SESSION['touid']= $_GET['uid'];
	// 確定當前頁數$p 參數
	$p = $_GET['p']?$_GET['p']:1;
	
	// 數據指針
	$offset = ($p-1)*$pagesize;
	$query_sql = "SELECT * FROM guestbook where uid= ". $_GET['uid'] ." ORDER BY id DESC LIMIT $offset , $pagesize ";
	
	$result = mysql_query($query_sql);
	// 如果出現錯誤並退出
	if(!$result) exit('查詢數據錯誤：'.mysql_error());
	// 循環輸出當前頁顯示數據
	while($gb_array = mysql_fetch_array($result)){
?>
	<div class="guestbook-list">
	<p class="guestbook-head">
	<img src="images/<?=$gb_array['face']?>.gif" />
	<span class="bold"><?=$gb_array['nickname']?></span> 
	<span class="guestbook-time">[<?=date("Y-m-d H:i", $gb_array['createtime'])?>]</span></p>
	<p class="guestbook-content"><?=nl2br($gb_array['content'])?></p>
	<?php
		// 回復
		if(!empty($gb_array['replytime'])) {
	?>
	<p class="guestbook-head">管理員回復<span class="guestbook-time">[<?=date("Y-m-d H:i", $gb_array['replytime'])?>]</span></p>
	<p class="guestbook-content"><?=nl2br($gb_array['reply'])?></p>
	<?php
		}	// 回復結束
	?>
	</div>
	<?php
	}	//while循環結束
	?>
	<div class="guestbook-list guestbook-page">
	<p>
	<?php
	// 計算留言頁數
	$count_result = mysql_query("SELECT count(*) FROM guestbook where uid= ". $_GET['uid']);
	$count_array = mysql_fetch_array($count_result);
	$pagenum = ceil($count_array['count(*)']/$pagesize);
	
	//echo $pagenum;
	echo '共 ',$count_array['count(*)'],' 條留言';
	// 頁數>1 顯示分頁
	if ($pagenum > 1) {
		for($i=1;$i<=$pagenum;$i++) {
			if($i==$p) {
				echo '&nbsp;[',$i,']';
			} else {
				echo '&nbsp;<a href="board.php?uid='.$_GET['uid'] .'&p=',$i,'">'.$i.'</a>';
			}
		}
	}
?>
</p>
</div>
</div><!--留言列表結束-->

<div id="guestbook-form">
<h3>發表留言</h3>
<form id="form1" name="form1" method="post" action="submiting.php" onSubmit="return InputCheck(this)">
<p>
<?php
	if(!isset($_SESSION['username'])){
?>
<label for="title">名&nbsp;&nbsp;&nbsp;&nbsp;稱：</label>
<input id="nickname" name="nickname" type=""  value ="<? echo $_SESSION['username'];?>"/><span>(必須填寫，不超過16個字)</span>
</p>
<?php
	} else{
	
?>
<label for="title">名&nbsp;&nbsp;&nbsp;&nbsp;稱：</label>
<input id="nickname" name="nickname" type="hidden"  value ="<? echo $_SESSION['username'];?>"/><span>(必須填寫，不超過16個字)</span>
</p>
<?php
	}
?>
<p>
<label for="title">E-mail&nbsp;：</label>
<input id="email" name="email" type="text" /><span>(非必需，不超過60個字元)</span>
</p>
<p>
<label for="face">頭&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;像:</label>
<input type="radio" name="face" value="1" checked>
<img src="images/1.gif" /> 
<input type="radio" name="face" value="2">
<img src="images/2.gif" />
<input type="radio" name="face" value="3">
<img src="images/3.gif" /> 
<input type="radio" name="face" value="4">
<img src="images/4.gif" /> 
<input type="radio" name="face" value="5">
<img src="images/5.gif" /> 
<input type="radio" name="face" value="6">
<img src="images/6.gif" /> 
<input type="radio" name="face" value="7">
<img src="images/7.gif" />
</p>
<p class="leftmargin">
<input type="radio" name="face" value="8">
<img src="images/8.gif" /> 
<input type="radio" name="face" value="9">
<img src="images/9.gif" /> 
<input type="radio" name="face" value="10">
<img src="images/10.gif" /> 
<input type="radio" name="face" value="11">
<img src="images/11.gif" /> 
<input type="radio" name="face" value="12">
<img src="images/12.gif" /> 
<input type="radio" name="face" value="13">
<img src="images/13.gif" /> 
<input type="radio" name="face" value="14">
<img src="images/14.gif" />
</p>
<p>
<p>
<label for="title">留言內容</label>
<textarea id="content" name="content"></textarea>
</p>
<input type="submit" name="submit" class="submit" value="發表" />
<span> </span>
</form>
</div>
</div><!--container-->
</body>
</html>