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
								
		<div class="col-md-3" >
			<?php
				include"student_sidenav.php";
			?>
		</div>
		<div class="col-md-9" >

			<a type='text' class='btn btn-primary' href='student_home.php' style='margin-left:95%'>Back</a>
			
			<h3 class='page-header text-primary'><i class='fa fa-History'> History Books</i></h3>

			<?php
				$qry="select sbb.sid,sbb.bid,sbb.request_date,sbb.role,sb.bno,sb.bcode,sb.title,sb.aname,sb.publication from barrow_books_history sbb join books sb on sb.bid = sbb.bid where sid='{$_SESSION["st_id"]}' and role='student'";
				//echo $qry;
				$res=$con->query($qry);
				if($res->num_rows>0)
				{
					$i=1;
				
					echo"
						<div class='form-group pull-right col-md-3'> 
							<input type='text' class='form-control' id='search' placeholder='Search Here' style='margin-top:5px'>
							</div>
						";						

					echo"						
						<table class='table table-bordered' >
						<thead>
							<tr>
								<th style='text-align:center'>S.No</th>
								<th style='text-align:center'>Book No</th>
								<th style='text-align:center'>Title</th>
								<th style='text-align:center'>Author Name</th>
								<th style='text-align:center'>Publication</th>
							</tr>
						</thead><tbody id='mytable'>
					";
					while($row=$res->fetch_assoc())
					{
						echo"
						
							<tr>
								<td>{$i}</td>
								<td>{$row['bno']}</td>
								<td>{$row['title']}</td>
								<td>{$row['aname']}</td>
								<td>{$row['publication']}</td>
								<!--<td><center><a class='btn btn-primary'><i class='fa fa-bell' > Avaliable</i></a></center></td>-->";
								
								echo"								
							</tr>						
						";
						$i++;
					}
					echo "</tbody></table></div>";
				} else{
					
					echo"<div class='alert alert-danger'>No Resule Found...!</div>";

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