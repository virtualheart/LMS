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
		<div class="col-md-8">
		<?php	
			if(isset($_GET["msg"])){
				if ($_GET['msg'] ==5 || $_GET['msg'] ==2) {
						echo"<div class='alert alert-success'>{$mgsarr[$_GET['msg']]}</div>";
						}							
				}		

		?>
			<h3 class="page-header text-primary"><span class="fa fa-users"> Select Details</span></h3>

		<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
			<div class="form-group col-md-5">					
					<label>Department</label>
					<select class="form-control" name="dname">				 						
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
					<label>Year of Joining(*)</label>					
						<select class="form-control" name="year">
							<option value='-'>Select Year</option>

						<?php
						    for($i = 2017 ; $i <= date('Y'); $i++){
      						echo "<option value='{$i}'>$i</option>";
				   		}
						?>
						</select>					
				</div>
				<div class="form-group col-md-5">										
					<label>Shift</label>					
					<select class="form-control" name="shift">				 						
						<option>Select Shift</option>						
						<option value='I'>I</option>						
						<option value='II'>II</option>																	
					</select>					
				</div>	
				<div class="form-group col-md-5" style="margin-top:35px">
					<input type="submit" class="btn btn-success" value="View" name="view">			
					<!-- <button type='text' class='btn btn-danger' onClick='down()' style='margin-left:1%'>Delect all</button> -->

				</div>

				<div class='form-group pull-right col-md-3'> 
						<input type='text' class='form-control' id='search' placeholder='Search Here' style='margin-top:5px'>
				</div>
								

 			</div>

			<div class="col-md-offset-3 col-md-9">			
			<?php
			if(isset($_POST["view"]))
			{ 

			$qry="Select department.dname, students.regno, students.st_id, students.sname,
  					students.did, students.year, students.shift, students.img
						From students Inner Join
  					department On students.did = department.did where students.did='{$_POST['dname']}' and students.year='{$_POST['year']}' and students.shift='{$_POST['shift']}'";

				$res=$con->query($qry);
				if($res->num_rows>0){
					$i=1;

					echo "<h3 class='page-header text-primary'><span class='fa fa-users'> View Students Details</span></h3>";
					echo"
					
						<table class='table table-bordered'>
							<tr>
								<th><center>S.No 		</center></th>
								<th><center>Photo		</center></th>
								<th><center>Regno       </center></th>
								<th><center>Name	    </center></th>
								<th><center>Department  </center></th>
								<th><center>Year </center></th>
								<th><center>shift	    </center></th>
								<th><center>Update   	</center></th>
								<th><center>Delete      </center></th>
							</tr><tbody id='stmytable'>
					";
					while($row=$res->fetch_assoc()) {

						echo"
							<tr class='center'>
								<td>{$i}</td>";

						echo "<td><center><img class='img-circle'src='../{$row["img"]}' height='100' width='100'></img></center></td>";

						echo "	
								<td>{$row["regno"]}</td>
								<td>{$row["sname"]}</td>
								<td>{$row["dname"]}</td>
								<td>{$row["year"]}</td>
								<td>{$row["shift"]}</td>
								<td><a id='cen' href='update_student.php?id={$row["st_id"]}' class='btn btn-success'><i class='fa fa-edit'> Update</i></a></td>
								<td><a id='cen' href='staff_student.php?id={$row["st_id"]}' class='btn btn-danger'><i class='fa fa-trash'> Delete</i></a></td>
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

			}
	
			
?>
		</div>						


<!-- 							<div class="col-md-4" id="mydata">
								<div class="panel panel-primary">									
									<div class="panel-heading" >
										Name : <?php //echo $row1["sname"];?><br>
									</div>
									<div class="panel-body">
														
										Register No : <?php // echo $row1["regno"];?><br>
										Department : <?php // echo $row1["dname"];?><br>
										Year : <?php //echo $row1["year"];?><br>
										Shift : <?php// echo $row1["shift"];?><br>
									</div>
									<div class="panel-footer" >
										<a type="submit" href='update_student.php?id=<?php //echo $row1["st_id"]?>' name="update" class='btn btn-primary btn-block'>Update</a>
										<a type="submit" href='student_delete.php?id=<?php //echo $row1["st_id"]?>' name="delete" class='btn btn-danger btn-block'>Delete</a>
									</div>
								</div>
							</div> -->
						
			</tr>
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
				$("#stmytable tr").each(function(){
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