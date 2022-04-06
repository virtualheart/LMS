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
		<div class="col-md-9">

		<?php

		if (!isset($_GET['id'])) {
			header("location:./admin_home.php");
		}

		 $qry="Select books.bid, staff_barrow_books.request_date, staff_barrow_books.sid,
			   books.bno, books.sno, books.title, books.aname, books.publication,
			   staff_barrow_books.bid,staff_barrow_books.return_date
				From staff_barrow_books Inner Join
  				books On books.bid = staff_barrow_books.bid where books.bid={$_GET['id']}";
		$res=$con->query($qry);
		if($res->num_rows>0)
		{
			$row=$res->fetch_assoc();
		} else {
			header("location:./admin_home.php");
		}
		?>
		<?php
			if(isset($_POST["submit"])){
				
				$sql="update staff_barrow_books where bid={$_GET["id"]}";

				if($con->query($sql))						
				{
					header("location:admin_staff_requested_details.php?msg=Return Date Update Successfully");					
				}						
			}
		?>
			<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]?>">
				
				<h3 class="page-header text-primary"><i class='fa fa-book'> View Book Details</i></h3>
				<div class="form-group col-md-5">
					<label>Serial No</label>
					<input type="text" name="sno" value="<?php echo $row['sno']?>" class="form-control" disabled>
				</div>
				<div class="form-group col-md-5">
					<label>Book No</label>
					<input type="text" name="sno" value="<?php echo $row['bno']?>" class="form-control" disabled>
				</div>
				<div class="form-group col-md-5">
					<label>Title</label>
					<input type="text" name="sno"  value="<?php echo $row['title']?>" class="form-control" disabled>
				</div>
				<div class="form-group col-md-5">
					<label>Author Name</label>
					<input type="text" name="sno" value="<?php echo $row['aname']?>" class="form-control" disabled>
				</div>
				<div class="form-group col-md-5">
					<label>Publication</label>
					<input type="text" name="sno" value="<?php echo $row['publication']?>" class="form-control" disabled>
				</div>
				<div class="form-group col-md-5">
			
					<label>Request Date</label>
					<input type="text" name="sno" value="<?php echo $row['request_date']?>" class="form-control" disabled>
				</div>
				<div class="form-group col-md-5">
					<label>Return Date</label>
					<input type="text" name="rdate" value="<?php echo $row['return_date']?>" class="form-control">					
				</div>
				<div class="form-group col-md-5" style="margin-top:35px">
					<input type="submit" name="submit" class="btn btn-primary" value="Accept">			
					<input type="submit" name="submit" class="btn btn-primary" value="reject">					
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