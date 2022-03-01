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
		<?php include"staff_home_nav.php";?>
		<div class="col-md-3" style="margin-top:50px">
			<?php
				include"staff_sidenav.php";
			?>
		</div>						
		<div class="col-md-9">
		
			
			<?php
				$sql="Select books.bid, books.bno, books.title, books.aname,
  staff_barrow_books.request_date, staff_barrow_books.return_date,
  staff_barrow_books.today, books.status
From staff_barrow_books Inner Join
  books On books.bid = staff_barrow_books.bid ";
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
					if($row["status"]==1)
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
					else if($row["status"]==2)
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
					else if($row["status"]==3)
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
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>