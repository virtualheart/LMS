<?php
	include"./include/config.php";
	session_start();
	include"staff_security.php";
	
?>
<html>
	<head>
		<?php
			include"head.php";
		?>
	</head>
	<body>
		<?php include"admin_home_nav.php";?>
		<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]?>">
			<?php
				if(isset($_GET["id"]))
				{				
					$sql="select * from books where bid={$_GET["id"]}";
					$res=$con->query($sql);
					if($res->num_rows>0)
					{
						$row=$res->fetch_assoc();
						$qry="update books set status='3' where bid={$row["bid"]}";
						if($con->query($qry))
						{
							$qry1="delete from staff_barrow_books where sbid={$_GET['id1']}";
							if($con->query($qry1))
							{	
								header("location:admin_staff_requested_details.php?msg=Request Cancelled");
							}
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