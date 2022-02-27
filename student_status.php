<?php
	include"config.php";
	session_start();
	$student_id=$_SESSION["st_id"];
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
		<div class="col-md-9">
		
			
			<?php
				 $sql="Select books.bid, books.bno, books.title, books.aname,
  student_barrow_books.request_date,student_barrow_books.return_date,
  student_barrow_books.today, books.sstatus
From student_barrow_books Inner Join
  books On books.bid = student_barrow_books.bid where student_barrow_books.st_id = $student_id ";
			$res=$con->query($sql);
			if($res->num_rows>0)
			{
				echo"
				<h3 class='page-header text-primary'><i class='fa fa-calendar'> View Status</i></h3>
				<table class='table table-striped'>
					<thead>
						<tr>
							<th>S.No</th>					
							<th>Book Number</th>
							<th>Title</th>
							<th>Author Name</th>
							<th>Request Date</th>
							<th>Return Book</th>							
							<th>Status</th>									
						</tr>
					</thead>
					<tbody>
				";
				$i=1;
				while($row=$res->fetch_assoc())
				{								
					if($row["sstatus"]==1)
					{
						echo"
							<tr>
								<td>{$i}</td>
								<td>{$row["bno"]}</td>
								<td>{$row["title"]}</td>
								<td>{$row["aname"]}</td>
								<td>{$row["request_date"]}</td>
								<td>{$row["return_date"]}</td>							
								<td><button class='btn btn-warning' type='button'>Request Pending</button></td>							
							</tr>
						";
						$i++;
					}					
					else if($row["sstatus"]==2)
					{
						echo"
							<tr>
								<td>{$i}</td>
								<td>{$row["bno"]}</td>
								<td>{$row["title"]}</td>
								<td>{$row["aname"]}</td>
								<td>{$row["request_date"]}</td>
								<td>{$row["return_date"]}</td>							
								<td><button class='btn btn-success' type='button'>Request Accepted</button></td>							
							</tr>
						";
						$i++;
					}
					else if($row["sstatus"]==3)
					{
						echo"
							<tr>
								<td>{$i}</td>
								<td>{$row["bno"]}</td>
								<td>{$row["title"]}</td>
								<td>{$row["aname"]}</td>
								<td>{$row["request_date"]}</td>
								<td>{$row["return_date"]}</td>							
								<td>Request Cancelled</td>							
							</tr>
						";
						$i++;
					}					
				}

				echo"
					</tbody>
					</table>
				";
			}
			else
			{
				echo"<div style='margin-top:80px' class='alert alert-danger'>Status Not Found..!!!</div>";
			}
			?>										
		</div>
		<footer>
			<?php
				include"footer.php";
			?>
		</footer>
	</body>
</html>