<?php

	$conn = @mysql_connect("localhost","root","phpweb");
	if (!$conn){
		die("連接數據庫失敗：" . mysql_error());
	}
	mysql_select_db("board", $conn);
	

  // Define database connection constants
  define('db_host', 'localhost');
  define('db_user', 'root');
  define('db_password', 'phpweb');
  define('db_name', 'board');
	
	//字符轉換，讀庫
	mysql_query("set character set 'big5'");
	//寫庫
	mysql_query("set names 'big5'");

?>