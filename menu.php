	<?php
	if (isset($_SESSION['username'])) {
		echo '<table width=25% border=0>';
		echo '<td><a href=index.php>首頁</a></td>';
		echo '<td><a href=admin.php>管理</a></td>';
		echo '<td><a href=logout.php>登出(' .$_SESSION['username'] .')</a>';
		echo '</table>';
	}
	else{
		echo '<table width=15% border=0>';
		echo '<td><a href=index.php>首頁</a></td>';
		echo '<td><a href=login.php>登陸</a></td>';
		echo '<td><a href=reg.php>註冊</a></td>';
		echo '</table>';
	}
	?>