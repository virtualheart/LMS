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
		<style>
			.image{
				height:100px;
				width:100px;
			}
			.btn-primary
			{
				margin-top:30px;				
			}
			.btn-danger
			{
				margin-top:30px;				
			}
			
		</style>
	</head>
	<body>
		<?php include"admin_home_nav.php";?>
		<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">			
		<div class="col-md-12">												
						<?php
						if(isset($_GET['msg']))
						{
							echo"<div class='alert alert-success'>{$_GET['msg']}</div>";
						}	
						?>						
																	
							<?php
			$qry="
					Select books.bid, student_barrow_books.request_date,student_barrow_books.stbid,
  student_barrow_books.Return_date, student_barrow_books.today,
  student_barrow_books.st_id, books.bno, books.title, books.aname,
  books.sstatus, students.regno, students.sname, students.did, students.img,
  students.year, students.shift, books.sno, department.dname, department.did,
  students.st_id, student_barrow_books.bid
From student_barrow_books Inner Join
  students On students.st_id = student_barrow_books.st_id Inner Join
  department On department.did = students.did Inner Join
  books On student_barrow_books.bid = books.bid
				where books.sstatus>0 and books.sstatus<3				
				";
				
				$res=$con->query($qry);
				if($res->num_rows>0)
				{					
					echo"
					<h3 class='page-header text-primary'><i class='fa fa-users'> Student Request details</i></h3>
					<table class='table table-bordered'>
							<tr>
								<th style='text-align:center'>S.No</th>
								<th style='text-align:center'>Image</th>
								<th style='text-align:center'>Name</th>
								<th style='text-align:center'>Department</th>								
								<th style='text-align:center'>Book Number</th>
								<th style='text-align:center'>Title</th>
								<th style='text-align:center'>Author Name</th>								
								<th style='text-align:center'>Requested Date</th>
								<th style='text-align:center'>Return Date</th>
								<th style='text-align:center'>Accept Request</th>
								<th style='text-align:center'>Cancel Request</th>
							</tr>";
					$i=1;					
					while($row=$res->fetch_assoc())
					{	
						echo"							
							<tr id='hei'>
								<td style='text-align:center; line-height:6' >{$i}</td>
								<td style='text-align:center; line-height:6' ><img src='{$row['img']}' class='img img-circle image'></td>
								<td style='text-align:center; line-height:6' >{$row['sname']}</td>
								<td style='text-align:center; line-height:6' >{$row['dname']}</td>								
								<td style='text-align:center; line-height:6' >{$row['bno']}</td>
								<td style='text-align:center; line-height:6' >{$row['title']}</td>
								<td style='text-align:center; line-height:6' >{$row['aname']}</td>
								<td style='text-align:center; line-height:6' >{$row['request_date']}</td>							
								";
								if($row['sstatus']==1)
								{
									echo"<td style='text-align:center;' ><i class='fa fa-mail-reply-all btn btn-primary disabled'></i></td>";
									echo"<td style='text-align:center;' ><a href='update_student_status.php?id={$row['bid']}'><i class='fa fa-check-square-o' style='line-height:6'></i></a></td>";
									echo"<td style='text-align:center;' ><a href='student_request_cancel.php?id={$row['bid']}&id1={$row['stbid']}'><i class='fa fa-close' style='line-height:6'></i></a></td>";
								}
								if($row['sstatus']==2)
								{
									echo"<td style='text-align:center;' ><a href='student_return_book.php?id={$row['bid']}&id1={$row['stbid']}'><i class='fa fa-mail-reply-all' style='line-height:6'></i></a></td>";
									echo"<td style='text-align:center;' ><a href='update_student_status.php?id={$row['bid']}'><i class='fa fa-check-square-o' style='line-height:6'></i></a></td>";
									echo"<td style='text-align:center;' ><i class='fa fa-close btn btn-danger disabled'></i></td>";
								}							
								echo"																																									
							</tr>                           
						";
						$i++;
					}
					echo"
						
						</table>
					";
				}
				else
				 {
					 echo"<div class='alert alert-danger'>No Resule Found...!!!</div>";
				 }
			?>
		</div>
		</form>
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>