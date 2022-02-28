
<?php
	include"./include/config.php";
	session_start();
?>
<html>
	<head>
		<?php
			include"head.php";
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
				<a href="student_request_details.php" class="text"><span class="fa fa-bell"> Request Details</span></a>											
			</div>			
			<div class="col-md-3 box11" style="margin-top:50px">			
				<a href="student_status.php" class="text"><span class="fa fa-bell"> View Status</span></a>	
			</div>
		</div>
		<footer>
			<?php
				include"footer.php";
			?>
		</footer>
	</body>
</html>