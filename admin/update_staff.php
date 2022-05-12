<?php
	include"../include/config.php";
	session_start();
	include"./admin_security.php";
	include"../include/msg.php";

?>
<html>
	<head>
		<?php
			include"../include/head.php";
		?>
		<style>
			#img
			{
				height:240px;
				width:240px;
			}
		</style>
	</head>
	<body>
		<?php include"admin_home_nav.php";?>
		
		
		<div class="col-md-3" style="margin-top:50px">
			<?php
				include"admin_sidenav.php";
			?>			
		</div>						
		<div class="col-md-9">		
			
		<?php

			if (!isset($_GET['id'])) {
					header("location:./view_staff.php");
			} else{	

			$qry="Select staff.id, staff.did, staff.regno, staff.sid, staff.sname, staff.contact,staff.semail,staff.gender,
					designation.designation, staff_department.s_d_name, staff.image
					From staff_department Inner Join
					staff On staff.did = staff_department.id Inner Join
					designation On staff.id = designation.id where sid={$_GET['id']}";
								
				$res=$con->query($qry);
				if($res->num_rows>0)
				{
					$row=$res->fetch_assoc();
				} else {
					header("location:./view_staff.php");
				}
			}

		?>
			<?php
				if(isset($_GET['msg']) && $_GET['msg']=='11')	{
					echo"<div class='alert alert-success'>{$mgsarr[$_GET['msg']]} New Password is <b>PASS</b></div>";
					
				} else if (isset($_GET['msg']) && $_GET['msg']=='12') {
					
					echo"<div class='alert alert-danger'>{$mgsarr[$_GET['msg']]}</div>";
				}
			?>	

			<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["REQUEST_URI"]?>">
				<h3 class="page-header text-info"><span class="fa fa-users"> Update Staff Details</span></h3>				
				<div class="col-md-3">
					<img src="<?php echo $row["image"];?>" class="img-thumbnail" id="img">
				</div>
				
				<?php
					if(isset($_POST["update"]))
					{					
						
						$regno=$row["regno"];
						$name=$_POST["sname"];
						$dep=$_POST["dep"];
						$design=$_POST["design"];
						$contact=$_POST["contact"];						
						$email=$_POST["email"];		
						$gender=$_POST["gender"];	
						
						if(isset($_FILES["image"])!=null){

						$path="../img/staff/";
						$path=$path.time().rand(5,9).basename($_FILES["image"]["name"]);

							if(move_uploaded_file($_FILES["image"]["tmp_name"],$path))
							{								
								
							}elseif ($gender == "male") {

								$path = "../img/staff/male.png";

							} elseif ($gender == "female") {

								$path = "../img/staff/female.png";
						
							} 
						} else {
							$path = $row["image"];
						} 
							$qry="update staff set regno='$regno',sname='$name',did='$dep',id='$design',contact='$contact',semail='$email',gender='$gender', image='$path' where sid={$_GET['id']}";
								if($con->query($qry))
								{
									header("location:view_staff.php?msg=5");
								} else {
									echo"<div class='alert alert-danger'>Update Falied...!</div>";
								}								
						}						
										
				?>					
				<div class="col-md-4">
				<div class="form-group ">
					<label>Staff ID</label>
					<input type="text" value="<?php echo $row["regno"];?>" class="form-control" disabled>
				</div>
				<div class="form-group ">
					<label>Name</label>
					<input type="text" value="<?php echo $row["sname"];?>" name="sname" class="form-control">
				</div>

				<div class="form-group ">
					<label>Department</label>
					<select class="form-control" name="dep">
						<option value="<?php echo $row["did"];?>"><?php echo $row["s_d_name"];?></option>
						<?php
							$qry1="select * from staff_department";
							$res1=$con->query($qry1);
							if($res1->num_rows>0)
							{
								while($row1=$res1->fetch_assoc())
								{	
									echo"<option value='{$row1["id"]}'>{$row1["s_d_name"]}</option>";
								}
							}
						?>
					</select>
				</div>

				<div class="form-group col-md">
					
					<label > Geneder(*)</label><br>

					<?php

						if ($row["gender"]== 'male') {
							echo '<input type="radio" id="male" name="gender" value="male" required checked>'; 
							echo '<label for="male">Male</label>';

							echo '<input type="radio" id="female" name="gender" value="female" required>';
							echo '<label for="female">Female</label>';

						} elseif ($row["gender"]== 'female'){
							echo '<input type="radio" id="male" name="gender" value="male" required>'; 
							echo '<label for="male"> Male</label>';

							echo '<input type="radio" id="female" name="gender" value="female" required checked>';
							echo '<label for="female"> Female</label>';
						}

					?>

					
				</div>

				</div>

				<div class="col-md-4">
				<div class="form-group ">
					<label>Designation</label>
					<select class="form-control" name="design">
						<option value="<?php echo $row["id"];?>"><?php echo $row["designation"];?></option>
						<?php

							$qry2="select * from designation";
							$res2=$con->query($qry2);
							if($res2->num_rows>0)
							{
								while($row2=$res2->fetch_assoc())
								{	
									echo"<option value='{$row2["id"]}'>{$row2["designation"]}</option>";
								}
							}
						?>
					</select>
				</div>


				<div class="form-group ">
					<label>Contact</label>
					<input type="number" value="<?php echo $row["contact"];?>" name="contact" min="1" class="form-control" >
				</div>

				<div class="form-group col-md">
					<label>Mail(*)</label>
					<input type="email" name="email" value="<?php echo $row["semail"];?>" class="form-control" placeholder="email" required>
				</div>

				<div class="form-group">
					<label>Image</label>					
					<input type="file" name="image" class="form-control">


					<div class="form-group pull-right" style="margin-top:15px">					
						<input type="submit" name="update" value="Update" class="btn btn-primary">	
						<a href="admin_staff_pass_reset.php?id=<?php echo $_GET['id'] ?>" class='btn btn-warning'>password Reset</a>
						<a href='view_staff.php' class='btn btn-danger'> Back</a>
						
					</div>
				</div>




			</form>			
			
		</div>
		</div>
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>