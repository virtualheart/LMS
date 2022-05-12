<?php
	include"../include/config.php";


	if ($_SESSION["role"]='admin') {
	
	$qry="update staff set spass='pass' where  sid={$_GET['id']}";
		
		if($con->query($qry))
		{
			$head="location:update_staff.php?id={$_GET['id']}&msg=11";
			header($head);		
		} else {
			
			$head="location:update_staff.php?id={$_GET['id']}&msg=12";
			header($head);		
		}
	}
?>