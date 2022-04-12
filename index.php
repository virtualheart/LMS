<?php

		include "./include/config.php";
		$qry="select app_name from settings";
		$res=$con->query($qry);

		if($res->num_rows>0){
			$row=$res->fetch_assoc();
		}	
				
?>
<html>
	<head>
		<title><?php echo $row["app_name"]; ?></title>	
		<link rel="stylesheet" type="text/css" href="./css/_font-awesome.min.css">	
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link rel="shortcut icon" href="./img/favicon/favicon.ico" type="image/x-icon">  
	</head>

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand"><i><img src="./img/logo.png" width="55px"></i> <?php echo $row["app_name"]; ?></a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="#"><span class="fa fa-home"> Home</span></a></li>
			<li><a href="./admin/admin_login_page.php"><span class="fa fa-user"> Admin</span></a></li>
			<li><a href="./staff/staff_login_page.php"><span class="fa fa-users"> Staff</span></a></li>
			<li><a href="./student/student_login_page.php"><span class="fa fa-users"> Student</span></a></li>
		</ul>
	</div>
</nav>
				<style>
			#image{
				height:88.2%;
				width:100%;
			}
		</style>
	</head>
	<body>
		<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top:-20px;">
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="item active">
						<img src="img/banner/1.jpg" id="image"> 
					</div>
					<div class="item">
						<img src="img/banner/2.jpg" id="image">
					</div>
					<div class="item">
						<img src="img/banner/3.jpg" id="image">
					</div>
				</div>
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		<footer>
			<script src="./js/jquery.min.js"></script>
			<script src="./js/bootstrap.min.js"></script>
			<script src="./js/custom.js"></script>
		<script>	
			$(".alert").hide(3000);
		</script>

		</footer>
	</body>
</html>