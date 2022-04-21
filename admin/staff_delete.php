<?php

	include"../include/config.php";

	if ($_SESSION["role"]='admin') {

	$qry="delete from staff where sid={$_GET['id']}";

	if($con->query($qry)){
	
		header("location:view_staff.php?msg=2");		

		} else {
			
			header("location:view_staff.php?msg=10");
		}
	}

?>