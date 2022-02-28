<?php
	include"../include/config.php";
	session_start();
?>
<html>
	<head>
		<?php
			include"../include/head.php";
		?>
		<style> 
			.center td{
				line-height:5!important;
				text-align:center;
			}
			#cen{
				margin-top:25px;
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
			<?php
			
				$qry="Select staff.sid, staff.regno, staff.sname, staff.did, staff.id, staff.contact,
  staff.image, designation.designation, department.dname
From staff Inner Join
  department On staff.did = department.did Inner Join
  designation On staff.id = designation.id";
  
				$res=$con->query($qry);
				if($res->num_rows>0)
				{
					$i=1;
					echo"
					<div class='asset-inner'>
					<h3 class='page-header text-primary'><span class='fa fa-users'> View Staff Details</span></h3>
						";
							if(isset($_GET["msg"]))
							{
								echo"<div class='alert alert-success'>{$_GET["msg"]}</div>";
							}
						echo"
					
						<table class='table table-bordered'>
							<tr>
								<th><center>S.No 		</center></th>
								<th><center>Photo		</center></th>
								<th><center>Regno       </center></th>
								<th><center>Name	    </center></th>
								<th><center>Department  </center></th>
								<th><center>Designation </center></th>
								<th><center>Contact     </center></th>
								<th><center>Update    </center></th>
								<th><center>Delete     </center></th>
							</tr>
					";
					while($row=$res->fetch_assoc())
					{
						echo"
							<tr class='center'>
								<td>{$i}</td>
								<td><center><img class='img-circle'src='{$row["image"]}' height='100' width='100'></img></center></td>
								<td>{$row["regno"]}</td>
								<td>{$row["sname"]}</td>
								<td>{$row["dname"]}</td>
								<td>{$row["designation"]}</td>
								<td>{$row["contact"]}</td>
								<td><a id='cen' href='update_staff.php?id={$row["sid"]}' class='btn btn-success'><i class='fa fa-edit'> Update</i></a></td>
								<td><a id='cen' href='staff_delete.php?id={$row["sid"]}' class='btn btn-danger'><i class='fa fa-trash'> Delete</i></a></td>
							</tr>
						";
						$i++;
						}
					echo"
						</table>
						</div>
					";
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