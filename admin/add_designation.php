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
	</head>
	<body>
		<?php include"admin_home_nav.php";?>
		<div class="col-md-3" style="margin-top:50px">
			<?php
				include"admin_sidenav.php";
			?>
		</div>						
		<div class="col-md-4">
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
				<h3 class="page-header text-info">Add Staff Designation</h3>
				<?php
				if(isset($_POST["save"]))
				{
					$design=$_POST["design"];
					if (!$design==null) {
						 $qry="insert into designation(designation) values('$design')" ;
						if($con->query($qry))
						{
							echo"<div class='alert alert-success'>Insert Successfully</div>";
						}
						else
						{
							echo"<div class='alert alert-danger'>Insert Failed</div>";
						}
					} else {
							echo"<div class='alert alert-danger'>Please Enter Designation</div>";
					}
				}
			?>					
				<div class="form-group">
					<label>Designation</label>
					<input type="text" class="form-control" name="design">
				</div>
				<div class="form-group pull-right">					
					<button type="submit" class="btn btn-primary" name="save">Save</button>
					<input type="reset" class="btn btn-danger" value="Clear">
				</div>
			</form>			
		</div>
		<div class="col-md-5">
					
			<h3 class="page-header text-info">View Designation<h3>	
			<?php
				if(isset($_GET["msg"]))
				{	
					if ($_GET['msg'] ==5 || $_GET['msg'] ==2) {
						echo"<div class='alert alert-success'>{$mgsarr[$_GET['msg']]}</div>";
					}
				}
			?>
			<?php
				$qry="select * from designation";
				$res=$con->query($qry);
				if($res->num_rows)
				{
					$i=1;
					echo"
						<table class='table table-bordered'>
							<tr>
								<th><center>S.No</center></th>
								<th><center>Designation</center></th>
								<th><center>Update</center></th>
								<th><center>Delete</center></th>
							</tr>
					";
					while($row=$res->fetch_assoc())
					{
						echo"
							<tr>
								<td><center>{$i}</center></td>
								<td><center>{$row["designation"]}</center></td>
								<td><center><a href='update_design.php?id={$row["id"]}' class='btn btn-success'><span class='fa fa-edit'></span> Update</a></center></td>
								<td><center><a href='delete_design.php?id={$row["id"]}' class='btn btn-danger'><span class='fa fa-trash'></span> Delete</a></center></td>
							</tr>
						";
						$i++;
					}
				}
				
			?>
		</div>
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>