<?php
	include"../include/config.php";


	if ($_SESSION["role"]='admin') {
	
	$qry="update students set spass='pass' where  st_id={$_GET['id']}";
		
		if($con->query($qry))
		{
			$head="location:update_student.php?id={$_GET['id']}&msg=11";
			header($head);		
		} else {
			
			$head="location:update_student.php?id={$_GET['id']}&msg=12";
			header($head);		
		}
	}
?>