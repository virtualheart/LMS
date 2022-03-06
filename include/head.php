<?php

		include "../include/config.php";
		$qry="select app_name from settings";
		$res=$con->query($qry);

		if($res->num_rows>0){
			$row=$res->fetch_assoc();
		}	
				
?>
<title><?php echo $row["app_name"]; ?></title>
<link rel="shortcut icon" href="../img/favicon/favicon.ico" type="image/x-icon">  
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
