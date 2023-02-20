<?php
	$link = mysqli_connect("localhost", "root", "", "test");
	if(!$link) die('database connect error!!');
	mysqli_query($link, "SET CHARACTER SET UTF8");//設定編碼utf-8 
?>