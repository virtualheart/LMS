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
		
	</head>
	<body>
		<?php include"admin_home_nav.php";?>
		
		<div class="col-md-12" >
			<?php

				$strSQL ="select count(bid) as count from books";

				$num=$con->query($strSQL);
				if($num->num_rows>0)
				{
					$row=$num->fetch_assoc();
					$Num_Rows = $row['count'];
				}
				
				$Per_Page = 50000000;   
				if (!isset($_GET['page'])) {
				    $Page = 1;
				} else {
				    $Page = $_GET['page'];
				}

				$Prev_Page = $Page - 1;
				$Next_Page = $Page + 1;

				$Page_Start = (($Per_Page * $Page) - $Per_Page);
				if ($Num_Rows <= $Per_Page) {
				    $Num_Pages = 1;
				} elseif (($Num_Rows % $Per_Page) == 0) {
				    $Num_Pages = ($Num_Rows / $Per_Page) ;
				} else {
				    $Num_Pages = ($Num_Rows / $Per_Page) + 1;
				    $Num_Pages = (int) $Num_Pages;
				}
				

				$qry="select * from books LIMIT $Page_Start , $Per_Page";
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
								<td>{$row['barcode']}</td>
								<td>{$row['title']}</td>
								<td>{$row['aname']}</td>
								<td>{$row['publication']}</td>
								<td>{$row['price']}</td>
								<td>{$row['alamara']}</td>
								<td>{$row['rack']}</td>
								<td style='text-align:center'>
									<a class='btn btn-primary'href='update_books.php?id={$row['bid']}'><i class='fa fa-edit'> Update</i></a>
								</td>
								<td style='text-align:center'>
									<a class='btn btn-danger' href='delete_books.php?id={$row['bid']}'><i class='fa fa-trash'> Delete</i></a>
								</td>
							</tr>
						
						";
					
					}
					echo "</tbody></table></div>";
				}

			?>
		</div>
		<?php

	//		echo "<div><center>";
	//		echo "<a class='btn btn-primary ' href='./view_books.php?page=".$Prev_Page."'> Pervious</i></a>";
	//		echo "<a class='btn btn-primary ' href='./view_books.php?page=".$Next_Page."'> Next    </i></a>";
	//		echo "</div></center>";
		?>

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