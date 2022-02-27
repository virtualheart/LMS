<html>
	<head>
		<?php
			include"head.php";	
			include"nav.php";
		?>	
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
			<?php
				include"footer.php";
			?>
		</footer>
	</body>
</html>