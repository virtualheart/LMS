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
		<div class="col-md-offset-1 col-md-4" style="margin-top:30px;">		
			<?php
				if (!isset($_GET['id'])) {
					header("location:./add_dep.php");
				}
				$sql="select * from department where did={$_GET['id']}";
				$res=$con->query($sql);
				if($res->num_rows>0)
				{
					if($row=$res->fetch_assoc())
					{									
			
			?>
			<form method="post" action="<?php echo $_SERVER["REQUEST_URI"];?>">	
				<?php
					if(isset($_POST["update"]))
					{
						$dname=$_POST["dname"];						
						$qry="update department set dname='$dname' where did={$_GET['id']}";
						if($con->query($qry))
						{
							//echo"<script>window.open('add_department.php','_self')</script>";
							header("location:add_dep.php?msg=5");
						}						
					}
				?>
				<h3 class="page-header text-success">Update Department</h3>			
				<div class="form-group">
					<label>Department Name</label>
					<input type="text" class="form-control"  name="dname" value="<?php echo $row["dname"];?>">
				</div>				
				<div class="form-group pull-right">						
					<input type="submit" name="update" value="Update" class="btn btn-success">	
					<a href='./add_dep.php' class='btn btn-danger'> Back</a>				
				</div>	
			</form>
			
			<?php
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