<?php
	include"../include/config.php";
	
	if ($_SESSION["role"]='admin') {
	$sql="delete from staff_department where did='{$_GET["id"]}'";
		
		if($con->query($sql))
		{
			header("location:add_dep.php?msg=2");
		}	
	}
?>
