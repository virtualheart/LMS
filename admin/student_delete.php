<?php
	include"../include/config.php";


	if ($_SESSION["role"]='admin') {
	
	$qry="delete from students where st_id={$_GET['id']}";
		
		if($con->query($qry))
		{
			header("location:view_students_details.php?msg=2");		
		} else {
			
			header("location:add_dep.php?msg=10");
		}
	}
?>