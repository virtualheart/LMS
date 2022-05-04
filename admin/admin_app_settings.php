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
			<h3 class='page-header text-primary'><i class='fa fa-edit'> App Settings</i></h3>

				<?php
					if(isset($_POST["update"]))
					{					
						$app_name=$_POST["app_name"];
						$app_decp=$_POST["app_decp"];

						$qry="update settings set app_name='{$app_name}', app_decp='{$app_decp}'";

						if($con->query($qry)){
							echo"<div class='alert alert-success'>Update Successfully...!</div>";
						} else {
							echo"<div class='alert alert-danger'>Update Falied...!</div>";
						}	
					}

				?>

				<?php

				$qry="select app_name,app_logo,app_decp from settings";
				$res=$con->query($qry);

				if($res->num_rows>0){
					$row1=$res->fetch_assoc();
				}	
					
				?>


				<div class="col-md-3">
					<img src="../img/<?php echo $row1["app_logo"];?>" class="img-thumbnail" id="img">
				</div>
				<div class="form-group col-md-5">
					<label>App Name</label>
					<input type="text" class="form-control"placeholder='LMS' value="<?php echo $row1["app_name"]; ?>" name="app_name">
				</div>

				<div class="form-group col-md-5">
					<label>Description</label>
					<input type="text" placeholder="Knowage is power" class="form-control"  name="app_decp" value="<?php echo $row1["app_decp"]; ?>">
				</div>

				<div class="form-group col-md-5">
					<label>Image</label>					
					<input type="file" name="image" class="form-control">

				<div class=" form-group col-md-5"style="position:relative;top:30px;">
					<label></label>
					<input type="submit" class="btn btn-primary btn-md " name="update" value="Save" style="margin-left:5px">					
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