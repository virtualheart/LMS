<?php
	include"./include/config.php";
	session_start();
?>
<html>
	<head>
		<?php include"head.php"?>
		<?php include"admin_login_nav.php"?>
	</head>
	<body>
		<div class="col-md-offset-4 col-md-4" style="margin-top:80px">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
			<div class="box1">
				<h3 class="page-header text-info text-center">Staff Login</h3>		
				<?php
					if(isset($_POST["login"]))
					{
						$sname=$_POST["sname"];
						$spass=$_POST["spass"];
						$qry="select * from staff where sname='{$sname}' and regno='{$spass}'";
						$res=$con->query($qry);										
						if($res->num_rows>0)											
						{
							$row=$res->fetch_assoc();
							$_SESSION["sid"]=$row["sid"];
							$_SESSION["sname"]=$row["sname"];											
							header("location:staff_home.php");
						}
						else
						{
							echo"<div class='alert alert-danger'>Login Failed</div>";
						}
					}
				?>
				<div class="form-group">
					<label>Staff Name</label>
					<input type="text" name="sname" class="form-control" placeholder="Name"> 
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="spass" class="form-control" placeholder="Staff ID">
				</div>
				<div class="form-group pull-right">
					<button type="submit" class="btn btn-success" name="login">Login</button>
					<button type="reset" class="btn btn-danger">Clear</button>
				</div>											
			</form>
		</div>
	</div>
	<?php
		include"footer.php";
	?>
	</body>	
</html>