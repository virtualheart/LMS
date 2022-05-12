<?php
	include"../include/config.php";
	session_start();
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
		<div class="col-md-offset-3">
			<?php
				$qry="
				 Select students.st_id, student_barrow_books.request_date,
  student_barrow_books.Return_date, student_barrow_books.today,
  department.dname, students.did, students.sname, students.regno, books.bno,
  books.title, books.bid
From students Inner Join
  student_barrow_books On students.st_id = student_barrow_books.st_id Inner Join
  department On students.did = department.did Inner Join
  books On books.bid = student_barrow_books.bid
				where books.bid='{$_GET["id"]}'  			
				";
				$res=$con->query($qry);
				if($res->num_rows>0)
				{
					$row=$res->fetch_assoc();
				}
			?>
			<h3 class='page-header text-primary'><i class='fa fa-book'> Staff Books Return Details</i></h3>
			<?php
				if(isset($_POST["submit"]))
				{
					$sql="update student_barrow_books set today='{$_POST["returned_date"]}' where bid={$_GET['id']}";
					if($con->query($sql))
					{						
						$qry1="update books set sstatus='4' where bid='{$_GET["id"]}'";
						if($con->query($qry1))
						{
							$qry2="delete from student_barrow_books where stbid={$_GET['id1']}";
							if($con->query($qry2))
							{
								header("location:admin_student_requested_details.php?msg=Return Details Updated Successfuly");
							}							
						}						
					}
				}
			?>
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
				<div class="form-group col-md-5">
					<label>Register No</label>
					<input type="text" value="<?php echo $row['regno']?>" name="rno" class="form-control">
				</div>
				<div class="form-group col-md-5">
					<label>Name</label>
					<input type="text" value="<?php echo $row['sname']?>" name="name" class="form-control">
				</div>				
				<div class="form-group col-md-5">
					<label>Department</label>
					<input type="text" value="<?php echo $row['dname']?>" name="dep" class="form-control">
				</div>
				<div class="form-group col-md-5">
					<label>Book No</label>
					<input type="text" value="<?php echo $row['bno']?>" name="bno" class="form-control">
				</div>
				<div class="form-group col-md-5">
					<label>Title</label>
					<input type="text" value="<?php echo $row['title']?>" name="title" class="form-control">
				</div>
				<div class="form-group col-md-5">
					<label>Rquest Date</label>
					<input type="text" value="<?php echo $row['request_date']?>" name="request_date" class="form-control">
				</div>
				<div class="form-group col-md-5">
					<label>Return Date</label>
					<input type="text" value="<?php echo $row['Return_date']?>" name="return_date" class="form-control">
				</div>
				<div class="form-group col-md-5">
					<label>Returned Date</label>
					<input type="date" name="returned_date" class="form-control">
					<input type="submit" style="margin-top:25px" name="submit" class="btn btn-primary pull-right" value="Update">					
				</div>
				<div class="form-group col-md-5" >
					
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

