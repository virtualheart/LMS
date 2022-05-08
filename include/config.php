<?php
	
	//  DB connection
	$con=mysqli_connect("localhost","smk","","sinpro");

	if (!$con) {
		header("location:server_500.php");
	}

?>