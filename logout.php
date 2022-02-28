<?php
	include"./include/config.php";
	session_start();
	unset($_SESSION["sid"]);
	unset($_SESSION["aid"]);
	unset($_SESSION["ID"]);
	session_destroy();
	header("location:index.php");
	
?>