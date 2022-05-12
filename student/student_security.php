<?php
	

	if (@$_SESSION["role"]=='student') {
//		echo @$_SESSION["role"];
	} else {
		header("location:../index.php");
	}


?>