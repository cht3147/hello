<?php
	session_start();
	// �T��DPOST�覡�X��
	if(!isset($_POST['submit'])){
		exit('�D�k�X��!');
	}
	
	$nickname = 
	// ���H���B�z
	
		$nickname = htmlspecialchars(trim($_POST['nickname']));
		$email = htmlspecialchars(trim($_POST['email']));
		$content = htmlspecialchars(trim($_POST['content']));
	
	
		$nickname = addslashes(htmlspecialchars(trim($_POST['nickname'])));
		$email = addslashes(htmlspecialchars(trim($_POST['email'])));
		$content = addslashes(htmlspecialchars(trim($_POST['content'])));
	
	if(strlen($nickname)>16){
		exit('���~�G�ʺ٤��o�W�L16�Ӧr�Ŧ�[ <a href="javascript:history.back()">��^</a> ]');
	}
	if(strlen($nickname)>60){
		exit('���~�G�l�c���o�W�L60�Ӧr�Ŧ�[ <a href="javascript:history.back()">��^</a> ]');
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
<title>�d�����\</title>
</head>
<body>
<div class="refresh">

<p>�d�����\�I�D�`�P�±z���d���C<br />�еy��A�������b��^...
</div>
</body>
</html>
<?php
	} else {
		echo '�d�����ѡG',mysql_error(),'[ <a href="javascript:history.back()">��^</a> ]';
	}
?>
