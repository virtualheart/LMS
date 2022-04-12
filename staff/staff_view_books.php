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
								
		<div class="col-md-12" >
			<?php
				$qry="select * from books";
				$res=$con->query($qry);
				if($res->num_rows>0)
				{
					$i=1;					
					echo"
												
					<a type='text' class='btn btn-primary' href='staff_home.php' style='margin-left:95%'>Back</a>														
						
					";
					echo"<h3 class='page-header text-primary'><i class='fa fa-search'> Search Books</i></h3>";
					
					echo"
						<div class='form-group pull-right col-md-3'> 
							<input type='text' class='form-control' id='search' placeholder='Search Here' style='margin-top:5px'>
							</div>
						";						

					echo"						
						<table class='table table-bordered' >
						<thead>
							<tr>
							<!--	<th style='text-align:center'>S.No</th> -->
								<th style='text-align:center'>Serial No</th>
								<th style='text-align:center'>Book No</th>
								<th style='text-align:center'>Title</th>
								<th style='text-align:center'>Author Name</th>
								<th style='text-align:center'>Publication</th>
								<th style='text-align:center'>Status</th>								
							</tr>
						</thead><tbody id='mytable'>
					";
					while($row=$res->fetch_assoc())
					{
						echo"
						
							<tr>
								<td>{$i}</td>
							<!--	<td>{$row['sno']}</td> -->
								<td>{$row['bno']}</td>
								<td>{$row['title']}</td>
								<td>{$row['aname']}</td>
								<td>{$row['publication']}</td>
								";	
								if($row['status'] == 1)
								{
									echo"<td><center><a class='btn btn-danger disabled'><i class='fa fa-bell'> Unavaliable </i></a></center></td>";
								}
								else
								{
									echo"<td><center><a class='btn btn-primary'><i class='fa fa-bell' > Avaliable</i></a></center></td>";
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