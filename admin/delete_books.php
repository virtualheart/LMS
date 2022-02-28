<?php
	include"../include/config.php";
	
	$qry="delete from books where bid='{$_GET["id"]}'";

	if ($_SESSION["role"]='admin') {

		if($con->query($qry) && @$_SESSION["role"]=='admin')
		{
			header("location:view_books.php?msg=Book Deleted Successfully...!!!");
		}
	}
?>