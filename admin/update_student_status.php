<?php
	include"./include/config.php";
	session_start();
	include"./admin_security.php";
?>
<html>
	<head>
		<?php
			include"head.php";
		?>
	</head>
	<body>
		<?php include"admin_home_nav.php";?>
		<form method="post" action="<?php $_SERVER['REQUEST_URI']?>" enctype="multipart/form-data">				 	
			<?php
				if(isset($_GET["id"]))
				{
					
					$qry="select * from books where bid='{$_GET["id"]}'";
					$res=$con->query($qry);
					if($res->num_rows>0)
					{
					
						$row=$res->fetch_assoc();
						
							$sql="update books set sstatus='2' where bid='{$_GET["id"]}'";
							if($con->query($sql))
							{
							
								header("location:accept_student_request.php?id='{$row["bid"]}'");
							}
						
					}
				}
			?>
		</form>					
		<footer>
			<?php
				include"footer.php";
			?>
		</footer>
	</body>
</html>