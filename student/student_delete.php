<?php
	include"./include/config.php";
	 $qry="delete from students where st_id={$_GET['id']}";
	if($con->query($qry))
	{
		header("location:view_students_details.php?msg=Deleted Successfully");		
	}
?>