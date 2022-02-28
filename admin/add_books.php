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
		<div class="col-md-3" style="margin-top:50px">
			<?php
				include"admin_sidenav.php";
			?>
		</div>						
		<div class="col-md-9">
			
				<?php
						
					if(isset($_POST["save"]))
					{			
						$s=$_POST["snoid"];
						 $qry="insert into books(sno,bno,bcode,title,aname,publication,price,alamara,rack)values('{$s}','{$_POST["bno"]}','{$_POST["bcno"]}','{$_POST["title"]}','{$_POST["aname"]}','{$_POST["publication"]}','{$_POST["price"]}','{$_POST["alamara"]}','{$_POST["rack"]}')";
						if($con->query($qry))
						{							
							echo"<div class='alert alert-success'>Insert Successfully...!!!</div>";
						}
						
					}
					
				?>											
				<?php
					$no="";
					 $qry="select * from books order by sno desc limit 1";
					$res=$con->query($qry);
					if($res->num_rows>0)
					{
						$row=$res->fetch_assoc();
						$no=$row["sno"]+1;
					}					
					else
					{
						$no="1001";
					}					
				?>
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
			<h3 class='page-header text-primary'><i class='fa fa-book'> Add Books</i></h3>
				<div class="form-group col-md-5">
					<label>Serial No</label>
					<input type="text" class="form-control" name="snoid">
				</div>
				<div class="form-group col-md-5">
					<label>Book No</label>
					<input type="text" class="form-control"  name="bno">
				</div>
				<div class="form-group col-md-5">
					<label>Barcode No</label>
					<input type="text" class="form-control"  name="bcno">
				</div>
				<div class="form-group col-md-5">
					<label>Title</label>
					<input type="text" class="form-control"  name="title">
				</div>
				<div class="form-group col-md-5">
					<label>Author Name</label>
					<input type="text" class="form-control"  name="aname">
				</div>
				<div class="form-group col-md-5">
					<label>Publication</label>
					<input type="text" class="form-control"  name="publication">
				</div>
				<div class="form-group col-md-5">
					<label>Price</label>
					<input type="text" class="form-control"  name="price" >
				</div>
				<div class="form-group col-md-5">
					<label>Alamara</label>
					<input type="text" class="form-control"  name="alamara" value="A6">
				</div>
				<div class="form-group col-md-5">
					<label>Rack</label>
					<input type="text" class="form-control" name="rack" value="R4"><br>	
				</div>
				<div class=" form-group col-md-5"style="position:relative;top:30px;">
					<label></label>
					<input type="submit" class="btn btn-primary btn-md " name="save" value="Save" style="margin-left:5px">					
					<input type="reset" class="btn btn-danger btn-md " value="Clear">
				</div>				
			</form>
		</div>
		<script>
			$(document).ready(function(){
				alert("hi");
			});
			
		</script>
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>
</html>
