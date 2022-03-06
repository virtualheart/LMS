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
			.box11
			{
				position:relative;				
				box-shadow:0px 2px 5px 1px;								
				margin-right:5%;
				height:25%;
				width:25%;
				padding:25px;																	
			}					
			.text{
				position:relative;
				top:50px;				
				left:20px;
			}
			.text1{
				position:relative;
				top:25px;				
				left:30px;
			}
			.box11:hover
			{
				color:#199EB8;											
				
			}
		</style>
	</head>
	<body>
		<?php include"admin_home_nav.php";?>
		<div class="col-md-3" style="margin-top:50px">
			<?php
				include"admin_sidenav.php";
			?>
		</div>		
				<div class="col-md-9">			
			<div class="col-md-3 box11" style="margin-top:50px">			
				<a href="admin_book_entry.php" class="text"><span class="fa fa-book"> Book Entry</span></a>		
			</div>
			<div class="col-md-3 box11" style="margin-top:50px">			
				<a href="admin_book_return.php" class="text"><span class="fa fa-repeat"> Book Return</span></a>	
			</div>			
			<div class="col-md-3 box11" style="margin-top:50px">			
				<a href="add_staff.php"  class="text1"><span class="fa fa-users"> Add Staff</span></a><br><br>								
				<a href="view_staff.php" class="text1" ><span class="fa fa-edit"> View Staff</span></a>	
			</div>
		</div>		

		<div class="col-md-9">			
			<div class="col-md-3 box11" style="margin-top:50px">			
					<a href="add_dep.php" class="text1"><span class="fa fa-university"> Add Dept STD</span></a>	<br><br>							
					<a href="add_staff_dep.php" class="text1"><span class="fa fa-university"> Add Dept Staff</span></a>			
			</div>
			<div class="col-md-3 box11" style="margin-top:50px">			
				<a href="add_designation.php" class="text"><span class="fa fa-user-plus"> Add Designation</span></a>	
			</div>			
			<div class="col-md-3 box11" style="margin-top:50px">			
					<a href="add_students.php" class="text1"><span class="fa fa-users"> Add Student</span></a>	<br><br>							
					<a href="view_students_details.php" class="text1"><span class="fa fa-edit"> View Student</span></a>		
			</div>
		</div>			
		<!-- <div class="col-md-9">			
			<div class="col-md-3 box11" style="margin-top:50px">			
					<a href="add_students.php" class="text1"><span class="fa fa-users"> Add Student</span></a>	<br><br>							
					<a href="view_students_details.php" class="text1"><span class="fa fa-edit"> View Student</span></a>		
			</div>
			<div class="col-md-3 box11" style="margin-top:50px">			
					<a href="upload_book.php" ><span class="fa fa-upload"> Upload Books</span></a>	<br><br>
					<a href="add_books.php" ><span class="fa fa-book"> Add Books </span></a><br><br>																
					<a href="view_books.php" ><span class="fa fa-edit"> View/Edit Books</span></a>	
			</div>			
			<div class="col-md-3 box11" style="margin-top:50px">			
					<a href="admin_staff_requested_details.php" class="text1" ><span class="fa fa-user">  Staff Request</span></a><br><br>	
					<a href="admin_student_requested_details.php" class="text1"><span class="fa fa-users"> Student Request </span></a>																							
			</div>
		</div>	 -->
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>