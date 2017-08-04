<?php
	session_start();
	$check = mysqli_connect("localhost","root","",'doc_db');
	if(!$check)
		die(("Error in connection").mysql_error());
	
?>

