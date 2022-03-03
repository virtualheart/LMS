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
						header("location:./admin_home.php");
				}
				
						 $qry="Select staff.id, staff.did, staff.regno, staff.sid, staff.sname, staff.contact,
								designation.designation, staff_department.s_d_name, staff.image
								From staff_department Inner Join
								staff On staff.did = staff_department.id Inner Join
								designation On staff.id = designation.id where sid={$_GET['id']}";
								
								$res=$con->query($qry);
								if($res->num_rows>0)
								{
									$row=$res->fetch_assoc();
								} else {
									header("location:./admin_home.php");
								}
											
				?>
			<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["REQUEST_URI"]?>">
				<h3 class="page-header text-info"><span class="fa fa-users"> Add Staff Details</span></h3>				
				<div class="col-md-3">
					<img src="<?php echo '../'.$row["image"];?>" class="img-thumbnail" id="img">
				</div>
				
				<?php
					if(isset($_POST["update"]))
					{					
						
						$regno=$_POST["regno"];
						$name=$_POST["sname"];
						$dep=$_POST["dep"];
						$design=$_POST["design"];
						$contact=$_POST["contact"];						
						
						if(isset($_FILES["image"]))						
						{
						
							$path="img/staff/";
							$path=$path.basename($_FILES["image"]["name"]);
							if(move_uploaded_file($_FILES["image"]["tmp_name"],$path))
							{								

							}

							$qry="update staff set regno='$regno',sname='$name',did='$dep',id='$design',contact='$contact' where sid={$_GET['id']}";
								if($con->query($qry))
								{
									header("location:view_staff.php?msg=Update Successfully");
								} else {
									echo"<div class='alert alert-danger'>Update Falied</div>";

								}								
						}						
					}					
				
				?>					
				<div class="col-md-4">
				<div class="form-group ">
					<label>Register No</label>
					<input type="text" value="<?php echo $row["regno"];?>" name="regno" class="form-control" disabled>
				</div>
				<div class="form-group ">
					<label>Name</label>
					<input type="text" value="<?php echo $row["sname"];?>" name="sname" class="form-control">
				</div>
				<div class="form-group ">
					<label>Department</label>
					<select class="form-control" name="dep">
						<option value="<?php echo $row["id"];?>"><?php echo $row["s_d_name"];?></option>
						<?php
							$qry1="select * from staff_department";
							$res1=$con->query($qry1);
							if($res1->num_rows>0)
							{
								while($row1=$res1->fetch_assoc())
								{	
									echo"<option value='{$row1["did"]}'>{$row1["s_d_name"]}</option>";
								}
							}
						?>
					</select>
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
				<div class="form-group ">
					<label>Image</label>					
					<input type="file"  name="image" class="form-control">
						<div class="form-group pull-right" style="margin-top:15px">					
							<input type="submit" name="update" value="Update" class="btn btn-primary">							
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