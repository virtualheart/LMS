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
		<div class="col-md-9">
			<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]?>">
				<h3 class="page-header text-info"><span class="fa fa-users"> Add Staff Details</span></h3>
				<?php
					if(isset($_POST["save"])){

						$regno=$_POST["regno"];
						$name=$_POST["sname"];
						$dep=$_POST["dep"];
						$design=$_POST["design"];
						$contact=$_POST["contact"];
						$gender=$_POST['gender'];
						$mail=$_POST["email"];

						if(isset($_FILES["image"])==null){

							$path="img/staff";
							$path=$path.basename($_FILES["image"]["name"]);
							if(move_uploaded_file($_FILES["image"]["tmp_name"],$path))
							{								
								
							}
						} elseif ($gender == "male") {

							$path = "img/staff/male.png";

						} elseif ($gender == "female") {

							$path = "img/staff/female.png";
						
						} 

						$qry="insert into staff(regno,sname,semail,did,id,contact,gender,image,role)values
						                      ('$regno','$name','$mail','$dep','$design','$contact','$gender','$path','staff')";

						//echo $qry;

								if($con->query($qry))
								{
									echo"<div class='alert alert-success'>Insert Successfully</div>";
								}	
								else
								{
									echo"<div class='alert alert-danger'>Insert Failed</div>";
								}
					}
				?>				
				<div class="form-group col-md-5">
					<label>Staff ID(*)</label>
					<input type="text" name="regno" id="staffid" class="form-control" placeholder="Staff ID" required>
				</div>
				<div class="form-group col-md-5">
					<label>Name(*)</label>
					<input type="text" name="sname" class="form-control" placeholder="Name" required>
				</div>
				<div class="form-group col-md-5">
					<label>Department(*)</label>
						<select class="form-control" name="dep">
						<option>Select Department</option>
					<?php
							$qry="select * from staff_department";
							$res=$con->query($qry);
							if($res->num_rows>0)
							{
								while($row=$res->fetch_assoc())
								{	
									echo"<option value='{$row["id"]}'>{$row["s_d_name"]}</option>";
								}							}	
									
							?>
							
						
					</select>
				</div>

				<div class="form-group col-md-5">
					<label>Designation(*)</label>
					<select class="form-control" name="design">
						<option>Select Designation</option>
						<?php
							$qry="select * from designation";
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
					<input type="number" name="contact" class="form-control" placeholder="Contact" min="1">
				</div>

				<div class="form-group col-md-5">
					<label>Image</label>
					<input type="file" name="image" class="form-control" accept="image/png, image/gif, image/jpeg">
				</div>	

				<div class="form-group col-md-5">
					<label>Mail(*)</label>
					<input type="email" name="email" class="form-control" placeholder="email" required>
				</div>

				<div class="form-group col-md-5">
					
					<label > Geneder(*)</label><br>
						<input type="radio" id="male" name="gender" value="male" required>
					<label for="male"> Male</label>
						<input type="radio" id="female" name="gender" value="female" required>
					<label for="female"> Female</label>
					
						<div class="form-group pull-right" style="margin-top:15px">					
							<input type="submit" name="save" value="Save" class="btn btn-primary">
							<input type="reset" value="Clear" class="btn btn-danger">
						</div>
				</div>





			</form>			
		</div>
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>