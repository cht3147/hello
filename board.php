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
	


	$_SESSION['touid']= $_GET['uid'];
	// �T�w��e����$p �Ѽ�
	$p = $_GET['p']?$_GET['p']:1;
	
	// �ƾګ��w
	$offset = ($p-1)*$pagesize;
	$query_sql = "SELECT * FROM guestbook where uid= ". $_GET['uid'] ." ORDER BY id DESC LIMIT $offset , $pagesize ";
	
	$result = mysql_query($query_sql);
	// �p�G�X�{���~�ðh�X
	if(!$result) exit('�d�߼ƾڿ��~�G'.mysql_error());
	// �`����X��e����ܼƾ�
	while($gb_array = mysql_fetch_array($result)){
?>
	<div class="guestbook-list">
	<p class="guestbook-head">
	<img src="images/<?=$gb_array['face']?>.gif" />
	<span class="bold"><?=$gb_array['nickname']?></span> 
	<span class="guestbook-time">[<?=date("Y-m-d H:i", $gb_array['createtime'])?>]</span></p>
	<p class="guestbook-content"><?=nl2br($gb_array['content'])?></p>
	<?php
		// �^�_
		if(!empty($gb_array['replytime'])) {
	?>
	<p class="guestbook-head">�޲z���^�_<span class="guestbook-time">[<?=date("Y-m-d H:i", $gb_array['replytime'])?>]</span></p>
	<p class="guestbook-content"><?=nl2br($gb_array['reply'])?></p>
	<?php
		}	// �^�_����
	?>
	</div>
	<?php
	}	//while�`������
	?>
	<div class="guestbook-list guestbook-page">
	<p>
	<?php
	// �p��d������
	$count_result = mysql_query("SELECT count(*) FROM guestbook where uid= ". $_GET['uid']);
	$count_array = mysql_fetch_array($count_result);
	$pagenum = ceil($count_array['count(*)']/$pagesize);
	
	//echo $pagenum;
	echo '�@ ',$count_array['count(*)'],' ���d��';
	// ����>1 ��ܤ���
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
</div><!--�d���C����-->

<div id="guestbook-form">
<h3>�o��d��</h3>
<form id="form1" name="form1" method="post" action="submiting.php" onSubmit="return InputCheck(this)">
<p>
<?php
	if(!isset($_SESSION['username'])){
?>
<label for="title">�W&nbsp;&nbsp;&nbsp;&nbsp;�١G</label>
<input id="nickname" name="nickname" type=""  value ="<? echo $_SESSION['username'];?>"/><span>(������g�A���W�L16�Ӧr)</span>
</p>
<?php
	} else{
	
?>
<label for="title">�W&nbsp;&nbsp;&nbsp;&nbsp;�١G</label>
<input id="nickname" name="nickname" type="hidden"  value ="<? echo $_SESSION['username'];?>"/><span>(������g�A���W�L16�Ӧr)</span>
</p>
<?php
	}
?>
<p>
<label for="title">E-mail&nbsp;�G</label>
<input id="email" name="email" type="text" /><span>(�D���ݡA���W�L60�Ӧr��)</span>
</p>
<p>
<label for="face">�Y&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��:</label>
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
<label for="title">�d�����e</label>
<textarea id="content" name="content"></textarea>
</p>
<input type="submit" name="submit" class="submit" value="�o��" />
<span> </span>
</form>
</div>
</div><!--container-->
</body>
</html>