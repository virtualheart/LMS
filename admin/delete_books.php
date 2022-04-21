<?php

	include"../include/config.php";
	

	if ($_SESSION["role"]='admin') {

	$qry="delete from books where bid='{$_GET["id"]}'";
	
		if($con->query($qry)){

			header("location:view_books.php?msg=2");

		} else {
			header("location:view_books.php?msg=10");

		}
}

?>