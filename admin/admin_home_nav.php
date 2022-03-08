
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand"><i class=""><img src="../img/logo.png" width="55px"></i> <?php echo $row["app_name"]; ?></a>
		</div>
		<ul class="nav navbar-nav navbar-right">			
			<li><a href="#"><span class="fa fa-home"> Welcome : <?php echo $_SESSION['aname']?></span></a></li>
			<li><a href="admin_home.php"><span class="fa fa-home"> Home</span></a></li>
			<li><a href="../logout.php"><span class="fa fa-sign-out"> Logout</span></a></li>
		</ul>
	</div>
</nav>