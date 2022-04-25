<?php
	include"../include/config.php";
	session_start();
?>
<html>
	<head>
		<?php
			include"../include/head.php";
		?>
		<style>
			.box11
			{
				position:relative;				
				box-shadow:0px 2px 5px 1px;								
				margin-right:5%;
				height:25%;
				width:25%;
				padding:25px;																	
				
			}	
			.box11:hover
			{
				color:#199EB8;											
				
			}
			.text{
				position:relative;
				top:45px;				
				left:20px;
			}
			.text1{
				position:relative;
				top:25px;				
				left:30px;
			}
		</style>
	</head>
	<body>
		<?php include"student_home_nav.php";?>
		<div class="col-md-3" style="margin-top:50px">
			<?php
				include"student_sidenav.php";
			?>
		</div>						
		<div class="col-md-9">			
			<div class="col-md-3 box11" style="margin-top:50px">							
				<a href="student_view_books.php" class="text"><span class="fa fa-search"> Search Books</span></a>											
			</div>
			<div class="col-md-3 box11" style="margin-top:50px">			
				<a href="student_request_details.php" class="text"><span class="fa fa-book"> Inhand</span></a>											
			</div>			
			<div class="col-md-3 box11" style="margin-top:50px">			
				<a href="student_status.php" class="text"><span class="fa fa-info-circle"> View Status</span></a>	
			</div>
			<div class="col-md-3 box11" style="margin-top:50px">			
				<a href="student_book_history.php" class="text"><span class="fa fa-history"> View History</span></a>	
			</div>
		</div>

		<!----------------------------------------------------------------------------->
<?php
$qry="select sbb.sid,sbb.bid,sbb.request_date,sbb.role,sb.bno,sb.bcode,sb.title,sb.aname,sb.publication from barrow_books sbb join books sb on sb.bid = sbb.bid where sid='{$_SESSION["st_id"]}' and role='student'";
				//echo $qry;
				$res=$con->query($qry);

			if($res->num_rows>0)
				{

?>
	
		<div class="col-md-2" style="margin-top:50px">

		</div>	
		<div class="col-md-9">
			
			<div class='asset-inner'>
			<h3 class='page-header text-primary'><span class='fa fa-users'> Current books</span></h3>
						
			<?php
			
				
					$i=1;					
										

					echo"						
						<table class='table table-bordered' >
						<thead>
							<tr>
								<th style='text-align:center'>Serial No</th>
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
							</tr>						
						";
						$i++;
					}
					echo "</tbody></table></div>";
				}
			?>
		</div>
<!----------------------------------------------------------------------------->



		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>