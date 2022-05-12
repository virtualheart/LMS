<?php

	include"../include/config.php";
	session_start();
	include"./admin_security.php";

?>

<html>
	<head>
		<?php
			include"../include/head.php";
		?>
	</head>
	<body>
		<?php include"admin_home_nav.php";?>
		<div class="col-md-3" style="margin-top:50px">
			<?php
				include"admin_sidenav.php";
			?>
		</div>
		<!-- BODY -->
			<div class="col-md-9">											
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
			<h3 class='page-header text-primary'><i class='fa fa-user'> User Settings</i></h3>

				<?php
					if(isset($_POST["update"]))
					{					
						$aname=$_POST["aname"];
						$apass=$_POST["apass"];
						$amail=$_POST["amail"];

						$qry="update admin set aname='{$aname}', apass='{$apass}',a_mail='{$amail}' where aid='{$_SESSION["aid"]}'";

						if($con->query($qry)){
							echo"<div class='alert alert-success'>Update Successfully...!</div>";
						} else {
							echo"<div class='alert alert-danger'>Update Falied...!</div>";
						}	
					}

				?>

				<?php

				$qry="select * from admin";
				$res=$con->query($qry);

				if($res->num_rows>0){
					$row1=$res->fetch_assoc();
				}	
					
				?>

				<div class="form-group col-md-5">
					<label>Username</label>
					<input type="text" class="form-control"placeholder='user' value="<?php echo $row1["aname"]; ?>" name="aname" readonly='yes'>
					<br>
					
					<label>Password</label>
					<input type="password" placeholder="*****" class="form-control"  name="apass" value="<?php echo $row1["apass"]; ?>">
					<br>

					<label>mail</label>
					<input type="text" placeholder="admin@gmail.com" class="form-control"  name="amail" value="<?php echo $row1["a_mail"]; ?>">
					<br>

					<input type="submit" class="btn btn-primary btn-md " name="update" value="Update" style="margin-left:5px">					

				</div>
			
				</div>
			</form>
		</div>



		<!-- END -->
	<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>