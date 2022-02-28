<?php
	

	if (@$_SESSION["role"]=='staff') {
//		echo @$_SESSION["role"];
	} else {
		header("location:../index.php");
	}


?>