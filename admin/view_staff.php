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

						echo"
						<div class='form-group pull-right col-md-3'> 
							<input type='text' class='form-control' id='search' placeholder='Search Here' style='margin-top:5px'>
							</div>
						";			
			
				$qry="Select staff.sid, staff.regno, staff.sname, staff.did, staff.id, staff.contact,staff.gender,
  staff.image, designation.designation, staff_department.s_d_name
From staff Inner Join
  staff_department On staff.did = staff_department.id
  Inner Join
  designation On staff.id = designation.id order by staff.regno";
  
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

								if ($_GET['msg'] ==10 || $_GET['msg'] ==2) {
									echo"<div class='alert alert-success'>{$mgsarr[$_GET['msg']]}</div>";
								}							
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
							</tr><tbody id='mytable'>
					";
					while($row=$res->fetch_assoc())
					{
						echo"
							<tr class='center'>
								<td>{$i}</td>";

						echo "<td><center><img class='img-circle'src='{$row["image"]}' height='100' width='100'></img></center></td>";

						echo "	
								<td>{$row["regno"]}</td>
								<td>{$row["sname"]}</td>
								<td>{$row["s_d_name"]}</td>
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
				} else{
						echo"<div class='alert alert-danger'>Record Not Found....!!!</div>";

				}
	
			?>			
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

	</script>
</html>