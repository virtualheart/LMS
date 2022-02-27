<?php
	include"config.php";
	session_start();
?>
<html>
	<head>
		<?php
			include"head.php";
		?>
	</head>
	<body>
		<?php include"admin_home_nav.php";?>
		<div class="col-md-3" style="margin-top:50px">
			<?php
				include"admin_sidenav.php";
			?>
		</div>						
		<div class="col-md-9">
			<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]?>">
				<h3 class="page-header text-info"><span class="fa fa-users"> Add Staff Details</span></h3>
				<?php
					if(isset($_POST["save"]))
					{						
						$regno=$_POST["regno"];
						$name=$_POST["sname"];
						$dep=$_POST["dep"];
						$design=$_POST["design"];
						$contact=$_POST["contact"];						
						if(isset($_FILES["image"]))						
						{						
							$path="img/staff";
							$path=$path.basename($_FILES["image"]["name"]);
							if(move_uploaded_file($_FILES["image"]["tmp_name"],$path))
							{								
								$qry="insert into staff(regno,sname,did,id,contact,image)values('$regno','$name','$dep','$design','$contact','$path')";
								if($con->query($qry))
								{
									echo"<div class='alert alert-success'>Insert Successfully</div>";
								}	
								else
								{
									echo"<div class='alert alert-danger'>Insert Failed</div>";
								}
							}
						}
					}
				?>				
				<div class="form-group col-md-5">
					<label>Staff ID</label>
					<input type="text" name="regno" id="staffid" class="form-control" placeholder="Staff ID">
				</div>
				<div class="form-group col-md-5">
					<label>Name</label>
					<input type="text" name="sname" class="form-control" placeholder="Name">
				</div>
				<div class="form-group col-md-5">
					<label>Department</label>
					<?php
							$qry="select * from department";
							$res=$con->query($qry);
							if($res->num_rows>0)
							{
								$row=$res->fetch_assoc();
							}	
									
							?>
					<input type="text" class="form-control" value="<?php echo $row['dname']; ?>" name="dep">
							
						
					</select>
				</div>
				<div class="form-group col-md-5">
					<label>Designation</label>
					<select class="form-control" name="design">
						<option>Select Designation</option>
						<?php
							$qry="select * from Designation";
							$res=$con->query($qry);
							if($res->num_rows>0)
							{
								while($row=$res->fetch_assoc())
								{	
									echo"<option value='{$row["id"]}'>{$row["designation"]}</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="form-group col-md-5">
					<label>Contact</label>
					<input type="text" name="contact" class="form-control" placeholder="Contact">
				</div>
				<div class="form-group col-md-5">
					<label>Image</label>
					<input type="file" name="image" class="form-control">
						<div class="form-group pull-right" style="margin-top:15px">					
							<input type="submit" name="save" value="Save" class="btn btn-primary">
							<input type="reset" value="Clear" class="btn btn-danger">
						</div>
				</div>				
			</form>			
		</div>
		<footer>
			<?php
				include"footer.php";
			?>
		</footer>
	</body>
</html>