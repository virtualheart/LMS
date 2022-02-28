<?php
	include"./include/config.php";
	session_start();
?>
<html>
	<head>
		<?php
			include"head.php";
		?>
	</head>
	<body>
		<?php include"student_home_nav.php";?>
		<div class="col-md-3" style="margin-top:50px">
			<?php
				include"student_sidenav.php";
			?>
		</div>						
		<div class="col-md-offset-3">
			<?php
				$qry="select * from books where bid='{$_GET['id']}'";
				$res=$con->query($qry);
				if($res->num_rows>0)
				{
					$row=$res->fetch_assoc();
					
				}
			?>
			<form method="post" action="<?php $_SERVER["REQUEST_URI"]?>">
				<h3 class="page-header text-primary" style="margin-top:70px"><i class='fa fa-book'> View Request Book</i></h3>
				<?php
					if(isset($_POST["submit"]))
					{						
						
							$qry1="insert into student_barrow_books(bid,st_id,request_date)value('{$row["bid"]}','{$_SESSION["st_id"]}',now())";
							if($con->query($qry1))
							{							
								$qry3="update student_barrow_books set status='1' where bid='{$row["bid"]}'";
								if($con->query($qry3))
								{
									header("location:student_view_books.php?msg=Request Send Successfully..!!!");													
								}							
							}
																
						$qry2="update books set sstatus='1' where bid='{$row["bid"]}'";
						$con->query($qry2);
					}					
				?>
				<div class="form-group col-md-5">
					<label>Serial No</label>
					<input type="text" name="sno" class="form-control" value="<?php echo $row["sno"]?>" readonly>
				</div>
				<div class="form-group col-md-5">
					<label>Book No</label>
					<input type="text" name="bno" class="form-control" value="<?php echo $row["bno"]?>" readonly>
				</div><div class="form-group col-md-5">
					<label>Book Name</label>
					<input type="text" name="bname" class="form-control" value="<?php echo $row["title"]?>" readonly>
				</div>
				<div class="form-group col-md-5">
					<label>Author Name</label>
					<input type="text" name="aname" class="form-control" value="<?php echo $row["aname"]?>" readonly>
				</div>
				<div class="form-group col-md-5">
					<label>Publication</label>
					<input type="text" name="publication" class="form-control" value="<?php echo $row["publication"]?>" readonly>
				</div>
				<div class="form-group col-md-5" style="margin-top:35px">					
					<input type="submit" name="submit" class="btn btn-primary" value="Confirm Request">
				</div>
			</form>			
		</div>
		<footer>
			<?php
				include"footer.php";
			?>
		</footer>
	</body>
</html>