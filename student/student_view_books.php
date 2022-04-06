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
		<?php include"student_home_nav.php";?>
								
		<div class="col-md-offset-1 col-md-10" >
			<?php
				$qry="select * from books where sstatus!=2";
				$res=$con->query($qry);
				if($res->num_rows>0)
				{
					$i=1;					
					echo"
											
							<a type='text' class='btn btn-primary' href='student_home.php' style='margin-left:95%'>Back</a>														
						
					";
					echo"<h3 class='page-header text-primary'><i class='fa fa-search'> Search Books</i></h3>";
					
					echo"
						<div class='form-group pull-right col-md-3'> 
							<input type='text' class='form-control' id='search' placeholder='Search Here' style='margin-top:5px'>
							</div>
						";						
					if(isset($_GET["msg"]))
					{
						echo"<div class='alert alert-success'>{$_GET['msg']}</div>";
					}
					echo "<div id='dis'>";
					echo"						
						<table class='table table-bordered' >
						<thead>
							<tr>
								<th style='text-align:center'>S.No</th>
								<th style='text-align:center'>Serial No</th>
								<th style='text-align:center'>Book No</th>
								<th style='text-align:center'>Title</th>
								<th style='text-align:center'>Author Name</th>
								<th style='text-align:center'>Publication</th>								
								<th style='text-align:center'>Request</th>								
							</tr>
						</thead><tbody id='mytable'>
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
								";
							$qry="select * from student_barrow_books where bid='{$row["bid"]}' and st_id='{$_SESSION["st_id"]}'";
								$res1=$con->query($qry);								
								$row1=$res1->fetch_assoc();		
								if($row1["bid"]==$row["bid"]&&$row1["st_id"]==$_SESSION["st_id"]&&$row1["status"]=='1')
								{
									echo"<td><center><a href='student_request_book.php?id={$row['bid']}' class='btn btn-danger disabled'><i class='fa fa-bell'> Request </i></a></center></td>";
								}
								else
								{
									echo"<td><center><a href='student_request_book.php?id={$row['bid']}' class='btn btn-primary'><i class='fa fa-bell'> Request</i></a></center></td>";
								}
								echo"								
							</tr>
						
						";
						$i++;
					}
					echo "</tbody></table></div>";
				}
			?>
		</div>
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
	<script>
		$(document).ready(function(){
			$('#search').on("keyup",function(){								
				$("#mytable tr").each(function(){
					var txt=$(this).text().toUpperCase();
					var s=$("#search").val().toUpperCase();
					if(txt.indexOf(s)==-1)
					{
						$(this).css({"display":"none"});
					}
					else
					{
						$(this).css({"display":""});						
					}
				});
			});
		});
	</script>
</html>