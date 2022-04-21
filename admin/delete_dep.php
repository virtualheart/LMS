<?php
	include"../include/config.php";
	
	if ($_SESSION["role"]='admin') {
	
	$sql="delete from department where did='{$_GET["id"]}'";
		
		if($con->query($sql))
		{
			header("location:add_dep.php?msg=2");
		
		} else {
			
			header("location:add_dep.php?msg=10");
		}	
	}
?>
