	<?php
	if (isset($_SESSION['username'])) {
		echo '<table width=25% border=0>';
		echo '<td><a href=index.php>����</a></td>';
		echo '<td><a href=admin.php>�޲z</a></td>';
		echo '<td><a href=logout.php>�n�X(' .$_SESSION['username'] .')</a>';
		echo '</table>';
	}
	else{
		echo '<table width=15% border=0>';
		echo '<td><a href=index.php>����</a></td>';
		echo '<td><a href=login.php>�n��</a></td>';
		echo '<td><a href=reg.php>���U</a></td>';
		echo '</table>';
	}
	?>