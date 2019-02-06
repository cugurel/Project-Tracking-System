<?php 
	session_start();
	unset($_SESSION['kullanici']);
	unset($_SESSION['oturum_kontrol']);
	$_SESSION['oturum_kontrol'] = "";
	session_destroy();
	header("Location:login.php");

 ?>