<?php

	$conn = @mysql_connect("localhost","root","phpweb");
	if (!$conn){
		die("�s���ƾڮw���ѡG" . mysql_error());
	}
	mysql_select_db("board", $conn);
	

  // Define database connection constants
  define('db_host', 'localhost');
  define('db_user', 'root');
  define('db_password', 'phpweb');
  define('db_name', 'board');
	
	//�r���ഫ�AŪ�w
	mysql_query("set character set 'big5'");
	//�g�w
	mysql_query("set names 'big5'");

?>