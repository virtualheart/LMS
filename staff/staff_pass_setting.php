<?php

	include"../include/config.php";
	session_start();
	include"staff_security.php";

?>

<html>
	<head>
		<?php
			include"../include/head.php";
		?>
	</head>
	<body>
		<?php include"staff_home_nav.php";?>
		<div class="col-md-3" style="margin-top:50px">
			<?php
				include"staff_sidenav.php";
			?>
		</div>
		<!-- BODY -->
			<div class="col-md-9">											
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
			<h3 class='page-header text-primary'><i class='fa fa-user'> User Settings</i></h3>

				<?php
					if(isset($_POST["update"]))
					{					
						$apass=$_POST["apass"];
						$amail=$_POST["amail"];

						$qry="update staff set spass='{$apass}',semail='{$amail}' where sid='{$_SESSION["sid"]}'";

						if($con->query($qry)){
							echo"<div class='alert alert-success'>Update Successfully...!</div>";
						} else {
							echo"<div class='alert alert-danger'>Update Falied...!</div>";
						}	
					}

				?>

				<?php

				$qry="select * from staff where sid='{$_SESSION["sid"]}'";
				$res=$con->query($qry);

				if($res->num_rows>0){
					$row1=$res->fetch_assoc();
				}	
					
				?>

				<div class="form-group col-md-5">
					<label>Username</label>
					<input type="text" class="form-control"placeholder='user' value="<?php echo $row1["regno"]; ?>" name="aname" disabled>
					<br>
					
					<label>Password</label>
					<input type="password" placeholder="*****" class="form-control" name="apass" id="apass"value="<?php echo $row1["spass"]; ?>">
					<input type="checkbox" onclick="myFunction()">Show Password
					<br>


					<label>mail</label>
					<input type="text" placeholder="admin@gmail.com" class="form-control"  name="amail" value="<?php echo $row1["semail"]; ?>">
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