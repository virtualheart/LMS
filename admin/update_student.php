<?php
	include"./include/config.php";
	session_start();
	include"./admin_security.php";
?>
<html>
	<head>
		<?php
			include"head.php";
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
		<div class="col-md-8">
			<form method="post"  enctype="multipart/form-data" action="<?php $_SERVER["REQUEST_URI"]?>">				
				<h3 class="page-header text-primary"><i class="fa fa-users"> Update Student</i></h3>				
				<?php
					if(isset($_POST["update"]))
					{					
						
						$regno=$_POST["regno"];
						$sname=$_POST["sname"];
						$dname=$_POST["dname"];						
						$year=$_POST["year"];
						$shift=$_POST["shift"];
						/*						
						if(isset($_FILES["image"]))						
						{						
							$path="img/student/";
							$path=$path.basename($_FILES["image"]["name"]);
							if(move_uploaded_file($_FILES["image"]["tmp_name"],$path))
							{	*/							
								$qry="update students set regno='$regno',sname='$sname',did='$dname',year='$year',shift='$shift',img='$path' where st_id={$_GET['id']}";
								if($con->query($qry))
								{
									//header("location:view_students_details.php?msg=Update Successfully");
									echo"<div class='alert alert-success'>Update Successfully</div>";
								}/*
							}									
						}*/						
					}					
				
				?>		
				<?php
					$qry="Select department.dname, students.year, students.did, students.shift,
   students.regno, students.sname, students.st_id
From students Inner Join
  department On students.did = department.did where st_id='{$_GET["id"]}'";
  
					$res1=$con->query($qry);
					if($res1->num_rows>0)
					{
						$row1=$res1->fetch_assoc();
					}
				?>
				<!--<div class="col-md-3">
					<img src="<?php echo $row1["img"];?>" class="img-thumbnail" id="img">
				</div>-->
				<div class="form-group col-md-4">					
					<label>Roll No</label>
					<input type="text" name="regno" value="<?php echo $row1['regno']?>" class="form-control">
				</div>
				<div class="form-group col-md-4">					
					<label>Name</label>
					<input type="text" name="sname" value="<?php echo $row1['sname']?>" class="form-control">
				</div>
				<div class="form-group col-md-4">					
					<label>Department</label>
					<select class="form-control"  name="dname">				 						
						<option value="<?php echo $row1['did']?>"><?php echo $row1['dname']?></option>
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
				<div class="form-group col-md-4">										
					<label>Year</label>					
					<select class="form-control" name="year">				 						
						<option value="<?php echo $row1['year']?>"><?php echo $row1['year']?></option>						
						<option value='I'>I</option>						
						<option value='II'>II</option>						
						<option value='III'>III</option>						
					</select>					
				</div>
				<div class="form-group col-md-4">										
					<label>Shift</label>					
					<select class="form-control" name="shift">				 						
						<option value="<?php echo $row1['shift']?>"><?php echo $row1['shift']?></option>						
						<option value='I'>I</option>						
						<option value='II'>II</option>																	
					</select>					
				</div>				
				<div class="form-group col-md-4">					
					<!--<label>Image</label>
					<input type="file" name="image" class="form-control" required><br>-->
					<input type="submit" name="update" value="Update" class="btn btn-primary"style=" margin-right:5px;POSITION:RELATIVE;TOP:30PX;">	
					<a type="text" class="btn btn-DANGER " href="view_students_details.php" style="margin-left:5PX;POSITION:RELATIVE;TOP:30PX;">Back</a>					
										
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