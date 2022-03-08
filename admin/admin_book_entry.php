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
		<!-- BODY -->
	<div class="col-md-9">
	<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
	<h3 class='page-header text-primary'><i class='fa fa-book'> Barrow Books</i></h3>

	<?php

		if(isset($_POST["save"])){					
						
			$host=$_POST["host"];
			$port=$_POST["port"];
			$user=$_POST["email"];
			$pass=$_POST["Password"];
			$sectyp=$_POST["server_type"];						
						
		
			$qry="";
						//echo $qry;
			if($con->query($qry)){
				echo"<div class='alert alert-success'>Update Success</div>";			
			} else {	
				echo"<div class='alert alert-danger'>Update Falied</div>";			
			}								
		}
 
	?>   



		<div class="form-group col-md-5">
			<label>Barcode</label>
			<input type="text" name="barcode" id='live_search' value="<?php echo @$row['bcode']?>" class="form-control" >
		</div>
		<div class="form-group col-md-5">
			<label>Reg Number</label>
			<input type="text" name="barcode" id='live_search' value="<?php echo @$row['bcode']?>" class="form-control" >
		</div>
		<div class="form-group col-md-5">
			<label>Std/staff name</label>
			<input type="text" name="barcode" id='live_search' value="<?php echo @$row['bcode']?>" class="form-control" disabled>
		</div>

		<div class="form-group col-md-5">
			<label>Book No</label>
			<input type="text" name="sno" value="<?php echo @$row['bno']?>" class="form-control" disabled>
		</div>
		<div class="form-group col-md-5">
			<label>Title</label>
			<input type="text" name="sno"  value="<?php echo @$row['title']?>" class="form-control" disabled>
		</div>
		<div class="form-group col-md-5">
			<label>Author Name</label>
			<input type="text" name="sno" value="<?php echo @$row['aname']?>" class="form-control" disabled>
		</div>
		<div class="form-group col-md-5">
			<label>Publication</label>
			<input type="text" name="sno" value="<?php echo @$row['publication']?>" class="form-control" disabled>
		</div>
		<div class="form-group col-md-5">	
			<label>Request Date</label>
			<input type="text" name="sno" value="<?php echo date("d-m-Y");?>" class="form-control" disabled>
		</div>
		<div class="form-group col-md-5">
			<label>ETA Return Date</label>
			<input type="text" name="rdate" value="<?php echo date("d-m-Y",strtotime("+30 days"))?>" class="form-control" disabled>					
				</div>
		<div class="form-group col-md-5" style="margin-top:35px">
			<input type="submit" name="submit" class="btn btn-primary" value="Accept">			
			<a href='./admin_home.php' class='btn btn-danger'> Back</a>	
		</div>
				
	</form>
		</div>



		<!-- END -->
	<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>