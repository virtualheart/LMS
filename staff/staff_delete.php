<?php

	include"../include/config.php";

	session_start();

if ($_SESSION["role"]='admin') {

	echo $qry="delete from staff where sid={$_GET['id']}";

	if($con->query($qry))

	{

		header("location:view_staff.php?msg=Delete Successfully");		

	}
	}
	

?>