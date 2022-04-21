<?php
	
	ob_start();

	if (@$_SESSION["role"]=='admin') {
//		echo @$_SESSION["role"];
	} else {
		header("location:../index.php");
	}


?>