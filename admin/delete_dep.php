<?php
	include"../include/config.php";
	$sql="delete from department where did='{$_GET["id"]}'";
	
	if ($_SESSION["role"]='admin') {
		
		if($con->query($sql))
		{
			header("location:add_dep.php?msg=2");
		}	
	}
?>
