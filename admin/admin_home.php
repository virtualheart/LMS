<?php

	include"../include/config.php";
	session_start();
	include"./admin_security.php";

?>
<html>
	<head>
		<?php
			include"../include/head.php";
			//$server = file_get_contents("https://raw.githubusercontent.com/virtualheart/LMS/master/version.txt");
			$server = 2.2;
			$myfile = fopen("../version.txt", "r");
			$locver = fread($myfile,filesize("../version.txt"));
			fclose($myfile);
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
		<?php 
			include"admin_home_nav.php";
				if ($server!=$locver) {
		           echo '<center><div class="update-split"><i class="glyphicon glyphicon-refresh"></i> Lms Update is available! <a href="https://github.com/virtualheart/LMS">Update Now</a></div></center>';
   				}
		?>
		<div class="col-md-3" style="margin-top:50px">
			<?php
				include"admin_sidenav.php";
			?>
		</div>		
		<div class="col-md-9">			
			<div class="col-md-3 box11" style="margin-top:50px">			
				<a href="admin_book_entry.php" class="text1"><span class="fa fa-book"> Book Entry</span></a><br><br>		
				<a href="admin_book_return.php" class="text1"><span class="fa fa-repeat"> Book Return</span></a>	
			</div>

			<div class="col-md-3 box11" style="margin-top:50px">			
				<a href="add_staff.php"  class="text1"><span class="fa fa-users"> Add Staff</span></a><br><br>								
				<a href="view_staff.php" class="text1" ><span class="fa fa-edit"> View Staff</span></a>	
			</div>

			<div class="col-md-3 box11" style="margin-top:50px">			
					<a href="add_students.php" class="text1"><span class="fa fa-users"> Add Student</span></a>	<br><br>							
					<a href="view_students_details.php" class="text1"><span class="fa fa-edit"> View Student</span></a>		
			</div>
		</div>		

		<div class="col-md-9">			
			<div class="col-md-3 box11" style="margin-top:50px">			
					<a href="add_dep.php" class="text1"><span class="fa fa-university"> Add Dept STD</span></a>	<br><br>							
					<a href="add_staff_dep.php" class="text1"><span class="fa fa-university"> Add Dept Staff</span></a>			
			</div>

			<div class="col-md-3 box11" style="margin-top:50px">			
					<a href="add_books.php" class="text1"><span class="fa fa-edit"> Add Books</span></a>	<br><br>							
					<a href="upload_book.php" class="text1"><span class="fa fa-upload"> Upload Books</span></a>			
			</div>

			<div class="col-md-3 box11" style="margin-top:50px">			
					<a href="admin_gen_settings.php" class="text1"><span class="fa fa-gear"> General Setting</span></a>	<br><br>							
					<a href="admin_app_settings.php" class="text1"><span class="fa fa-edit"> App Setting</span></a>			
			</div>

			</div>	
		</div>			

		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>