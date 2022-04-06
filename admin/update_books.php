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
			<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]?>">
				<?php
					if(isset($_POST["update"]))
					{
						$qry1="update books set sno='{$_POST["sno"]}',bno='{$_POST["bno"]}',bcode='{$_POST["bcno"]}',title='{$_POST["title"]}',aname='{$_POST["aname"]}',publication='{$_POST["publication"]}',price='{$_POST["price"]}',alamara='{$_POST["alamara"]}',rack='{$_POST["rack"]}' where bid='{$_GET["id"]}'";
						if($con->query($qry1))
						{
							header("location:view_books.php?msg=Book Updated Successfully...!!!");
						}
					}
				?>				
				<?php
					$qry="select * from books where bid='{$_GET["id"]}'";
					$res=$con->query($qry);
					if($res->num_rows>0)
					{
						$row=$res->fetch_assoc();
					} else {
						header("location:./admin_home.php");
					}
				?>
				<h3 class='page-header text-primary'><i class='fa fa-edit'> Update Book Details</i></h3>
				<div class="form-group col-md-5">
					<label>Serial No</label>
					<input type="text" class="form-control" value="<?php echo $row['sno']?>" name="sno">
				</div>
				<div class="form-group col-md-5">
					<label>Book No</label>
					<input type="text" class="form-control" value="<?php echo $row['bno']?>" name="bno">
				</div>
				<div class="form-group col-md-5">
					<label>Barcode No</label>
					<input type="text" class="form-control" value="<?php echo $row['bcode']?>" name="bcno">
				</div>
				<div class="form-group col-md-5">
					<label>Title</label>
					<input type="text" class="form-control" value="<?php echo $row['title']?>" name="title">
				</div>
				<div class="form-group col-md-5">
					<label>Author Name</label>
					<input type="text" class="form-control" value="<?php echo $row['aname']?>" name="aname">
				</div>
				<div class="form-group col-md-5">
					<label>Publication</label>
					<input type="text" class="form-control" value="<?php echo $row['publication']?>" name="publication">
				</div>
				<div class="form-group col-md-5">
					<label>Price</label>
					<input type="text" class="form-control" value="<?php echo $row['price']?>" name="price">
				</div>
				<div class="form-group col-md-5">
					<label>Alamara</label>
					<input type="text" class="form-control" value="<?php echo $row['alamara']?>" name="alamara">
				</div>
				<div class="form-group col-md-5">
					<label>Rack</label>
					<input type="text" class="form-control" value="<?php echo $row['rack']?>" name="rack"><br>
				
				</div>
					
				<div class=" form-group col-md-5"style="position:relative;top:30px;">
					<label></label>
					<input type="submit" class="btn btn-primary btn-md " name="update" value="Update" 
					style="margin-left:5px" >
				</div>					
			</form>
		</div>
		<footer>

			<?php
				include"../include/footer.php";
			?>

		</footer>
	</body>
</html>
