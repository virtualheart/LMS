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
		<?php include"admin_home_nav.php";?>
		
		<div class="col-md-12" >
			<?php
				$qry="select * from books";
				$res=$con->query($qry);
				if($res->num_rows>0)
				{
					$i=1;					
					echo"
												
							<a type='text' class='btn btn-primary' href='admin_home.php' style='margin-left:95%'>Back</a>														
						
					";
					echo"<h3 class='page-header text-primary'><i class='fa fa-book'> View Book Details</i></h3>";
					
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
								<th style='text-align:center'>Serial No</th>
								<th style='text-align:center'>Book No</th>
								<th style='text-align:center'>Barcode No</th>
								<th style='text-align:center'>Title</th>
								<th style='text-align:center'>Author Name</th>
								<th style='text-align:center'>Publication</th>
								<th style='text-align:center'>Price</th>
								<th style='text-align:center'>Alamara</th>
								<th style='text-align:center'>Rack</th>
								<th style='text-align:center'>Update</th>
								<th style='text-align:center'>Delete</th>
							</tr>
						</thead><tbody id='mytable'>
					";
					while($row=$res->fetch_assoc())
					{
						echo"
						
							<tr>
								<td>{$row['sno']}</td>
								<td>{$row['bno']}</td>
								<td>{$row['bcode']}</td>
								<td>{$row['title']}</td>
								<td>{$row['aname']}</td>
								<td>{$row['publication']}</td>
								<td>{$row['price']}</td>
								<td>{$row['alamara']}</td>
								<td>{$row['rack']}</td>
								<td style='text-align:center'><a class='btn btn-primary'href='update_books.php?id={$row['bid']}'><i class='fa fa-edit'> Update</i></a></td>
								<td style='text-align:center'><a class='btn btn-danger' href='delete_books.php?id={$row['bid']}'><i class='fa fa-trash'> Delete</i></a></td>
							</tr>
						
						";
					
					}
					echo "</tbody></table></div>";
				}
			?>
		</div>
		<footer>
			<?php
				include"footer.php";
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