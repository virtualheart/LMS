<?php
	include"../include/config.php";
	
	if ($_SESSION["role"]='admin') {

	$sql="delete from staff_department where id='{$_GET["id"]}'";
		
		if($con->query($sql))
		{
			header("location:add_staff_dep.php?msg=2");
		} 
	}
?>
