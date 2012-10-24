<?php
	session_start();
	// 禁止非POST方式訪問
	if(!isset($_POST['submit'])){
		exit('非法訪問!');
	}
	
	$nickname = 
	// 表單信息處理
	
		$nickname = htmlspecialchars(trim($_POST['nickname']));
		$email = htmlspecialchars(trim($_POST['email']));
		$content = htmlspecialchars(trim($_POST['content']));
	
	
		$nickname = addslashes(htmlspecialchars(trim($_POST['nickname'])));
		$email = addslashes(htmlspecialchars(trim($_POST['email'])));
		$content = addslashes(htmlspecialchars(trim($_POST['content'])));
	
	if(strlen($nickname)>16){
		exit('錯誤：暱稱不得超過16個字符串[ <a href="javascript:history.back()">返回</a> ]');
	}
	if(strlen($nickname)>60){
		exit('錯誤：郵箱不得超過60個字符串[ <a href="javascript:history.back()">返回</a> ]');
	}

require("./conn.php");
require("./function.php");

$createtime = time();
$ip = get_client_ip();

	if (!isset($_SESSION['username'])) {
		$insert_sql = "INSERT INTO guestbook(nickname,email,face,content,createtime,clientip,uid)VALUES";
		$insert_sql .= "('$nickname','$email',$_POST[face],'$content',$createtime,'$ip',". $_SESSION['touid'] .")";
	}	else {
		$insert_sql = "INSERT INTO guestbook(nickname,email,face,content,createtime,clientip,uid)VALUES";
		$insert_sql .= "('$nickname','$email',$_POST[face],'$content',$createtime,'$ip',". $_SESSION['touid'] .")";
	}
	
	if(mysql_query($insert_sql)){
?>

<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset='uft8'">
<meta http-equiv="Refresh" content="1;url=board.php?uid=<?php echo $_SESSION['touid']?>">
<link rel="stylesheet" type="text/css" href="style/style.css" />
<title>留言成功</title>
</head>
<body>
<div class="refresh">

<p>留言成功！非常感謝您的留言。<br />請稍後，頁面正在返回...
</div>
</body>
</html>
<?php
	} else {
		echo '留言失敗：',mysql_error(),'[ <a href="javascript:history.back()">返回</a> ]';
	}
?>
