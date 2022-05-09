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
		<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]?>">
			<?php

					if(isset($_POST["upload"])) {

						$depart=$_POST['dname'];
						$year=$_POST['year'];
						$Shift=$_POST['shift'];

						$target_dir ="../books/";
						$target_file = $target_dir.rand(1000,9999).basename($_POST["fileToUpload"]);

							if (@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
							{
								$objPHPExcel=PHPExcel_IOFactory::load($target_file);

								$sql="INSERT INTO `students` (`regno`, `sname`, `gender`, `stemail`, `Contact`, `did`, `year`, `shift`, `img`, `role`) VALUES";

								$i=0;
								$html="";

								foreach($objPHPExcel->getWorksheetIterator() as $worksheet)
								{
									$i++;
									$higestRow=$worksheet->getHighestRow();
									for($row=2;$row<=$higestRow;$row++)
									{
										$regno=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
										$sname=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(1,$row)->getValue());
										$gender=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(2,$row)->getValue());
										$stemail=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(3,$row)->getValue());
										$Contact=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(4,$row)->getValue());

										if ($gender=="male") {
											$img="img/student/boy.png";
										} else if ($gender=="female") {
											$img="img/student/girl.png";
										} else {
											$img="img/student/boy.png";
										}
										$role="student";

										$sql.="('{$regno}','{$sname}','{$gender}','{$stemail}','{$Contact}','{$depart}','{$year}','{$shift}','$img','{$role}'";
									}
								}										
								$sql=substr($sql,0,strlen($sql)-1);
							//	echo $sql;
								if($con->query($sql))
								{								
									echo "<div class='alert alert-success'>Books Details Uploaded</div>";									
								} else {
								echo "<div class='alert alert-danger'>Books Details Upload Falied.</div>";
								}													
							} 
							else 
							{
								echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
							}						
					}									
				?>

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
							<option value='-'>Select Year</option>

						<?php
						    for($i = 2020 ; $i <= date('Y'); $i++){
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
				<div class="form-group col-md-5">									

					<label> Upload</label>
					<input type="file" class="form-control" name="fileToUpload" required><br>
					<button class="btn btn-primary pull-right" type="submit" name="upload"><span class="fa fa-upload"> Upload</span></button>

			</form>				
					<button class="btn btn-success " onclick="down()"><span class="fa fa-download"> sample download</span></button>
				
				</div>												
				<!-- ??? -->			
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
		<script type="text/javascript">
		function down(){
			window.open('../books/sample/sample student.xls');
		}
	</script>

</html>