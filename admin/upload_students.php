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
			<h3 class="page-header text-primary"><span class="fa fa-users"> Upload Student</span></h3>
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
					<label>Year</label>					
					<select class="form-control" name="year">				 						
						<option>Select Year</option>						
						<option value='I'>I</option>						
						<option value='II'>II</option>						
						<option value='III'>III</option>						
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
				<div class="form-group col-md-5">									

					<label> Upload</label>
					<input type="file" class="form-control" name="fileToUpload" required><br>
					<button class="btn btn-primary pull-right" type="submit" name="upload"><span class="fa fa-upload"> Upload</span></button>

					<button class="btn btn-success " onclick="down()"><span class="fa fa-download"> sample download</span></button>
				</div>												
			</form>				
				


						
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
		<script type="text/javascript">
		function down(){
			window.open('../books/sample/sample studend.xls');
		}
	</script>

</html>