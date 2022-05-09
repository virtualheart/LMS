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
			<h3 class='page-header text-primary'><i class='fa fa-gear'> General Settings</i></h3>

	<?php
					if(isset($_POST["save"]))
					{					
						
						$fine=$_POST["fine"];
						$stf_days=$_POST["stf_days"];
						$std_days=$_POST["std_days"];
						
		
						$qry="update settings set fine='$fine',fine_stf_days='$stf_days',fine_std_days='$std_days'";
						//echo $qry;
						if($con->query($qry))
						{
							echo"<div class='alert alert-success'>Update Success</div>";			
						} else {
							echo"<div class='alert alert-danger'>Update Falied</div>";			
						}								
					}

			 $qry="SELECT fine,fine_stf_days,fine_std_days
			 		FROM settings 
			 ";
	
				$res=$con->query($qry);
			
				if($res->num_rows>0)
			
				{
			
					$row=$res->fetch_assoc();
			
				}								
				
				?>					
			
				<div class="form-group col-md-5">
					<label>Fine Per day ₹(*)</label>
					<input type="number" name="fine" value="<?php echo $row['fine']?>" class="form-control" placeholder="Rs" >
				</div>	

				<div class="form-group col-md-5">
					<label>Staff book carry days(*)</label>
					<input type="number" name="stf_days" class="form-control" value="<?php echo $row['fine_stf_days']?>" placeholder="days" required>
				</div>

				<div class="form-group col-md-5">
					<label>Student book carry days(*)</label>
					<input type="number" name="std_days" class="form-control" value="<?php echo $row['fine_std_days']?>" placeholder="Days" required>
				</div>
			

				<div class=" form-group col-md-5"style="position:relative;top:30px;">
					<label></label>
					<input type="submit" class="btn btn-primary btn-md " name="save" value="Save" style="margin-left:5px">					
					<input type="reset" class="btn btn-danger btn-md " value="Clear">
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