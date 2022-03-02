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
			<h3 class='page-header text-primary'><i class='fa fa-envelope'> SMTP Settings</i></h3>

				<div class="form-group col-md-5">
					<label>Server Type</label>
					<select class="form-control" name="server_type">
						<option value="Choose any one">Select one any</option>
						<option value="email">Email</option>
						<option value="custom mail">Custom Server</option>
					</select>
				</div>

				<div class="form-group col-md-5">
					<label>Image</label>
					<input type="text" name="text" class="form-control">
				</div>	

				<div class="form-group col-md-5">
					<label>Mail(*)</label>
					<input type="email" name="email" class="form-control" placeholder="email" required>
				</div>



				<div class=" form-group col-md-5"style="position:relative;top:30px;">
					<label></label>
					<input type="submit" class="btn btn-primary btn-md " name="save" value="Save" style="margin-left:5px">					
					<input type="reset" class="btn btn-danger btn-md " value="Clear">
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