<?php
	include "config.php";
	session_start();
?>
<html>
	<head>
		<?php include"head.php"?>
		<?php include"admin_login_nav.php"?>		
		<!-- <style>
			// body{
				// background-image:url(img/banner/3.jpg);
			// }
		// </style> --->
	</head>
	<body>
		<div class="col-md-offset-4 col-md-4" style="margin-top:80px">
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<div class="box1">
						<h3 class="page-header text-info text-center">Admin Login</h3>
						<?php
							if(isset($_POST["login"]))
							{
								$aname=$_POST["aname"];
								$apass=$_POST["apass"];
								
								$sql="select * from admin where aname='{$aname}' and apass='{$apass}'";
								$res=$con->query($sql);									
								if($res->num_rows>0)	
								{												
									$row=$res->fetch_assoc();
									$_SESSION["aid"]=$row["aid"];
									$_SESSION["aname"]=$row["aname"];
									
									header("location:admin_home.php");
								}
								else
								{
									echo "<div class='alert alert-danger'>Login Failed</div>";
								}
							}
						?>								
						<div class="form-group">
							<label>User Name</label>
							<input type="text" class="form-control" name="aname" placeholder="Username">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="apass" placeholder="Password">
						</div>
						<div class="form-group pull-right">
							<input type="submit" class="btn btn-success" value="Login" id="log" name="login">
							<input type="reset" class="btn btn-danger" value="Clear">
						</div>						
					</div>				
				</form>
			</div>
		</div>
		<footer>
			<?php
				include"footer.php";
			?>
		</footer>
	</body>	
</html>