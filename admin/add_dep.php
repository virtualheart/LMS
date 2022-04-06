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
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">	
				
				<h3 class="page-header text-primary">Add Student Department</h3>
				
				<?php
				if(isset($_POST["save"]) )
				{
					$dname=$_POST["dname"];

					if (!$dname==null) {
						
						$sql="insert into department(dname) value('$dname')";

						if($con->query($sql))
						{
							echo"<div class='alert alert-success'>Insert Successfully</div>";
						}				
						else
						{
							echo"<div class='alert alert-danger'>Insert Failed</div>";
						}
					} else {
							echo"<div class='alert alert-danger'>Please Enter Name</div>";

					}
				}
				?>
				<div class="form-group">
					<label>Department Name</label>
					<input type="text" class="form-control"  name="dname">
				</div>				
				<div class="form-group pull-right">						
					<input type="submit" name="save" value="Save" class="btn btn-primary">
					<input type="submit" value="Clear" class="btn btn-danger">
				</div>	
			</form>
		</div>
		<div class="col-md-5">


			<h3 class="page-header text-primary">View Department</h3>
			<div class='form-group pull-right col-md-3'> 
				<input type='text' class='form-control' id='search' placeholder='Search Here' style='margin-top:5px'>
			</div>

			<?php

				if(isset($_GET['msg']))
				{	
					if ($_GET['msg'] ==5 || $_GET['msg'] ==2) {
						echo"<div class='alert alert-success'>{$mgsarr[$_GET['msg']]}</div>";
					}
				}
			?>
			
			<table class="table table-bordered">
				<tr>
					<th>S.No</th>
					<th>Department Name</th>
					<th>Update</th> 	
					<th>Delete</th>
				</tr><tbody id='mytable'>
				<?php
					$sql="select * from department";
					$res=$con->query($sql);
					if($res->num_rows>0)
					{
						$i=1;
						while($row=$res->fetch_assoc())
						{
							echo"<tr>";
								echo"<td>{$i}</td>";
								echo"<td>{$row["dname"]}</td>";
								echo"<td><center><a href='update_dep.php?id=$row[did]' class='btn btn-success'><span class='fa fa-edit'></span> Update</a></center></td>";
								echo"<td><center><a href='delete_dep.php?id=$row[did]' onClick='return delConfirm();' class='btn btn-danger'> <span class='fa fa-trash'></span> Delete</a></center></td>";
								$i++;
							echo"</tr>";
						}
					}
				?>				
			</table>
		</div>
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
		<script>
		$(document).ready(function(){
			$('#search').on("keyup",function(){								
				$("#mytable tr").each(function(){
					var txt=$(this).text().toUpperCase();
					var s=$("#search").val().toUpperCase();
					if(txt.indexOf(s)==-1)
					{
						$(this).css({"display":"none"});
					}
					else
					{
						$(this).css({"display":""});						
					}
				});
			});
		});

function delConfirm() {

if (confirm("Do you want to delect the record...!")) {
       // do stuff
} else {
    return false;
    }
}

	</script>

</html>