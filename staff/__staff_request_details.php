<?php
	include"../include/config.php";
	session_start();
	include"staff_security.php";
	
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
				include "staff_sidenav.php";
			?>
		</div>				
		<div class="col-md-8">		
			<?php
				 $qry="Select books.bid, staff_barrow_books.bid, staff_barrow_books.request_date,
  staff_barrow_books.sid, books.title, books.aname, books.publication,
  books.bno, books.sno
From staff_barrow_books Inner Join
  books On books.bid = staff_barrow_books.bid where  staff_barrow_books.sid='{$_SESSION["sid"]}'";
			
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
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>