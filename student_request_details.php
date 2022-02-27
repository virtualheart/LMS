<?php
	include"config.php";
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
				include "student_sidenav.php";
			?>
		</div>				
		<div class="col-md-8">		
			<?php
				 $qry="Select books.bid, student_barrow_books.bid, student_barrow_books.request_date,
  student_barrow_books.st_id, books.title, books.aname, books.publication,
  books.bno, books.sno
From student_barrow_books Inner Join
  books On books.bid = student_barrow_books.bid where  student_barrow_books.st_id='{$_SESSION["st_id"]}'";
			
			$res=$con->query($qry);
			if($res->num_rows>0)
			{
				$i=1;
				echo"<h3 class='page-header text-primary'><i class='fa fa-book'> Request Book Details</i></h3>";
				echo"
					<table class='table table-bordered'>
						<thead>
							<tr>
								<th>S.No</th>
								<th>Serial No</th>
								<th>Book No</th>
								<th>Title</th>
								<th>Author Name</th>
								<th>Publication</th>
								<th>Request Date</th>
							</tr>
						</thead>
						<tbody>
				";
				while($row=$res->fetch_assoc())
				{
					echo"						
							<tr>
								<td>{$i}</td>
								<td>{$row['sno']}</td>
								<td>{$row['bno']}</td>
								<td>{$row['title']}</td>
								<td>{$row['aname']}</td>
								<td>{$row['publication']}</td>								
								<td>{$row['request_date']}</td>								
							</tr>						
					";
					$i++;
				}
				echo"
					</tbody>
				</table>
				";
			}			
				else
			{
				echo"<div style='margin-top:80px' class='alert alert-danger'>Request Not Found..!!!</div>";
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