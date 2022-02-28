<?php
	include"./include/config.php";
	echo $qry="delete from staff where sid={$_GET['id']}";
	if($con->query($qry))
	{
		header("location:view_staff.php?msg=Delete Successfully");		
	}
?>