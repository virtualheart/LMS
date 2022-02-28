<?php
	include"../include/config.php";
	$qry="delete from designation where id={$_GET['id']}";
	
	if ($_SESSION["role"]='admin') {

		if($con->query($qry))
		{
			header("location:add_designation.php?msg=Delete Successfully");
		}
?>