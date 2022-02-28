<?php

	include"../include/config.php";
	include "../Classes/PHPExcel/IOFactory.php";
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
		<div class="col-md-3">
			<form method="post" enctype="multipart/form-data" role="form" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">			
				<h3 class="page-header text-primary"><span class="fa fa-upload"> Upload Books<span></h3>	
				<?php
					if(isset($_POST["upload"]))
					{						
							$target_dir ="../books/";
							$target_file = $target_dir . rand(1000,9999).basename($_FILES["fileToUpload"]["name"]);
							if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
							{
								$objPHPExcel=PHPExcel_IOFactory::load($target_file);
								 $sql="INSERT INTO books(sno,bno,barcode,title,aname,publication,price,alamara,rack) VALUES ";
								$i=0;
								$html="";
								foreach($objPHPExcel->getWorksheetIterator() as $worksheet)
								{
									$i++;
									$higestRow=$worksheet->getHighestRow();
									for($row=2;$row<=$higestRow;$row++)
									{
										$sno=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
										$bno=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(1,$row)->getValue());
										$barcode=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(2,$row)->getValue());
										$title=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(3,$row)->getValue());
										$aname=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(4,$row)->getValue());
										$publication=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(5,$row)->getValue());
										$price=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(6,$row)->getValue());
										$alamara=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(7,$row)->getValue());
										$rack=mysqli_escape_string($con,$worksheet->getCellByColumnAndRow(8,$row)->getValue());
										$sql.="('{$sno}','{$bno}','{$barcode}','{$title}','{$aname}','{$publication}','{$price}','{$alamara}','{$rack}'),";
									}
								}										
								$sql=substr($sql,0,strlen($sql)-1);
								if($con->query($sql))
								{								
									echo "<div class='alert alert-success'>Books Details Uploaded</div>";									
								}															
							} 
							else 
							{
								echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
							}						
					}									
				?>
				<div class="form-group col-md-12">
					<label> Upload</label>
					<input type="file" class="form-control" name="fileToUpload" required><br>
					<button class="btn btn-primary pull-right" type="submit" name="upload"><span class="fa fa-upload"> Upload</span></button>
				</div>												
			</form>
		</div>
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>