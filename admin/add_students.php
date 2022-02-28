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
			<form method="post" enctype="multipart/form-data" action="<?php $_SERVER["PHP_SELF"]?>">
				<h3 class="page-header text-primary"><span class="fa fa-users">Add Students</span></h3>
				<?php
					if(isset($_POST["save"]))
					{						
						$regno=$_POST["reg"];						
						
						$name=$_POST["sname"];
						$dname=$_POST["dname"];
						$year=$_POST["year"];
						$shift=$_POST["shift"];
						$gender=$_POST["gender"];
						if ($gender=="male") {
							$path="img/staff/student_male.png";
						} else{
							$path="img/staff/student_female.png";
						}

						/*if(isset($_FILES["image"]))						
						{						
							$path="img/student/";
							$path=$path.basename($_FILES["image"]["name"]);
							if(move_uploaded_file($_FILES["image"]["tmp_name"],$path))
							{*/	

								 $qry="insert into students(regno,sname,did,year,shift)values('{$regno}','{$name}','{$dname}','{$year}','{$shift}')";
								 echo $qry;
								if($con->query($qry))
								{
									echo"<div class='alert alert-success'>Insert Successfully</div>";
								}	
								else
								{
									echo"<div class='alert alert-danger'>Insert Failed</div>";
								}/*
							}
						}*/
					}
				?>

				<div class="form-group col-md-5">					
					<label>Register Number(*)</label>
					<input type="text" name="reg" id="stdid" class="form-control" placeholder="Register No" required>
				</div>

				<div class="form-group col-md-5">					
					<label>Name(*)</label>
					<input type="text" name="sname" class="form-control" placeholder="Name" required>
				</div>

				<div class="form-group col-md-5">					
					<label>Department(*)</label>
					<select class="form-control" name="dname" required>				 						
						<option value='-'>Select Department</option>
						<?php
							$qry="select * from department";
							$res=$con->query($qry);
							if($res->num_rows>0)
							{								
								while($row=$res->fetch_assoc())
								{
									echo"
										<option value='{$row['did']}'>{$row['dname']}</option>
									";
								}
							}
						?>
					</select>					
				</div>
				<div class="form-group col-md-5">										
					<label>Year(*)</label>					
					<select class="form-control" name="year">				 						
						<option>Select Year</option>						
						<option value='I'>I</option>						
						<option value='II'>II</option>						
						<option value='III'>III</option>						
					</select>					
				</div>
				<div class="form-group col-md-5">										
					<label>Shift(*)</label>					
					<select class="form-control" name="shift">				 						
						<option>Select Shift</option>						
						<option value='I'>I</option>						
						<option value='II'>II</option>																	
					</select>					
				</div>

				<!-- <div class="form-group col-md-5">
					<label>Image</label>
					<input type="file" name="image" class="form-control" accept="image/png, image/gif, image/jpeg">
				</div>	-->

				<div class="form-group col-md-5">
					<label>Mail</label>
					<input type="email" name="email" class="form-control" placeholder="email">
				</div>


				<div class="form-group col-md-5">
					<label>Contact</label>
					<input type="number" name="contact" class="form-control" placeholder="Contact" min="1">
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