<?php include"config.php";
	session_start();
?>

<html>
	<head>
		<?php include"head.php"?>
		<?php include"student_login_nav.php"?>
	</head>
	<body>
		<div class="col-md-offset-4 col-md-4" style="margin-top:80px">
			<div class="box1">
			<h3 class="page-header text-info text-center">Student Login</h3>
						<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
							<?php
									if(isset($_POST["login"]))
									{									
										$sname=$_POST["sname"];
										$spass=$_POST["spass"];
										echo $qry="select * from students where sname='{$sname}' and regno='{$spass}'";
										$res=$con->query($qry);										
										if($res->num_rows>0)											
										{
											$row=$res->fetch_assoc();
											$_SESSION["st_id"]=$row["st_id"];
											$_SESSION["sname"]=$row["sname"];											
											$_SESSION["regno"]=$row["regno"];											
											$_SESSION["did"]=$row["did"];											
											$_SESSION["year"]=$row["year"];											
											$_SESSION["shift"]=$row["shift"];											
											header("location:student_home.php");
										}
										else
										{
											echo"<div class='alert alert-danger'>Login Failed</div>";
										}
									}
								?>
						
						
							<div class="form-group">
								<label>Student Name</label>
								<input type="text" class="form-control" name="sname" placeholder="Student Name">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" name="spass" placeholder="Register No">
							</div>
							<div class="form-group pull-right">
								<input type="submit" class="btn btn-success" name="login" value="Login">
								<input type="reset" class="btn btn-danger" value="Clear">
							</div>						
						</form>
					</div>					
				</div>
		<footer>
		<footer>
			<?php
				include"footer.php";
			?>
		</footer>	
	</body>	
</html>