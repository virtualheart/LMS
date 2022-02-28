<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand"><i class="fa fa-book"></i> Library Management System</a>
		</div>
		<ul class="nav navbar-nav navbar-right">			
			<li><a href="#"><span class="fa fa-user"> Welcome : <?php echo $_SESSION['sname']?></span></a></li>
			<li><a href="staff_home.php"><span class="fa fa-home"> Home</span></a></li>
			<li><a href="logout.php"><span class="fa fa-sign-out"> Logout</span></a></li>
		</ul>
	</div>
</nav>