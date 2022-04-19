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
		<!-- BODY -->

<div class="col-md-9">
	<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>" onsubmit="return confirm('Do you really submit the Book?');">
	<h3 class='page-header text-primary'><i class='fa fa-book'>Return Books</i></h3>

	<?php

		if(isset($_POST["submit"])){
						
			$bcode = $_POST['barcode'];
			$book_id = $_POST['book_id'];
			$role = $_POST['role'];

		// Check student or staff			

			$qry="insert into barrow_books_history (sid,bid,request_date,returned_date,today,role,status) select sid,bid,request_date,'".date("Y-m-d")."',today,'{$role}',status from barrow_books where bid='{$book_id}'";
			
			$qry2="delete from barrow_books where bid='{$book_id}'";		

			$qry3="update books set status='0' where bid='{$book_id}'";

			if($con->query($qry)){

				if ($con->query($qry2)) {

					if ($con->query($qry3)) {
						
						echo"<div class='alert alert-success'>Update success</div>";
					}else {	
					
						echo"<div class='alert alert-danger'>Update Falied3</div>";			
					}	
				}else {	
				
					echo"<div class='alert alert-danger'>Update Falied2</div>";			
				}	
			} else {	
				echo"<div class='alert alert-danger'>Update Falied1</div>";			
			}								
		} 
 
	?>   

		<div class="form-group col-md-5">
			<label>Barcode</label>
			<input type="text" name="barcode" id='barcode' value="" class="form-control" onkeyup="GetDetail(this.value)" maxlength="13" required>
		</div>
		<div class="form-group col-md-5">
			<label>Reg Number</label>
			<input type="text" name="regno" id='regno' value="" class="form-control" readonly="true" >
		</div>
		<div class="form-group col-md-5">
			<label>Std/staff name</label>
			<input type="text" name="sname" id='sname' value="" class="form-control" readonly="true" required>
 		</div>

		<div class="form-group col-md-5">
			<label>Book No</label>
			<input type="text" name="bno" id="bno" value="" class="form-control" readonly="true">
			<input type="hidden" name="role" id="role" value="">
			<input type="hidden" name="book_id" id="book_id" value="">
<!-- 			<input type="hidden" name="staff_id" id="staff_id" value="">-->
 <!-- 			<input type="hidden" name="stat" id="stat" value=""> -->
		</div>
		<div class="form-group col-md-5">
			<label>Title</label>
			<input type="text" name="title" id="title" value="" class="form-control" readonly="true">
		</div>
		<div class="form-group col-md-5">
			<label>Author Name</label>
			<input type="text" name="aname" id="aname" value="" class="form-control" readonly="true">
		</div>
		<div class="form-group col-md-5">
			<label>Publication</label>
			<input type="text" name="publication" id="publication" value="" class="form-control" readonly="true">
		</div>
		<div class="form-group col-md-5">	
			<label>Request Date</label>
			<input type="text" name="request_date" id="request_date" value  class="form-control" readonly="true">
		</div>
		<div class="form-group col-md-5">
			<label>Returned Date</label>
			<input type="text" name="retdate" value="<?php echo date("d-m-Y"); ?>" class="form-control" readonly="true">					
				</div>
		<div class="form-group col-md-5" style="margin-top:35px">
			<input type="submit" name="submit" class="btn btn-primary" value="Return">			
			<a href='./admin_home.php' class='btn btn-danger'> Back</a>	
		</div>
				
	</form>
		</div>

		<!-- END -->
	<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>

	<script type="text/javascript">

        function GetDetail(str) {
            if (str.length == 0) {
                document.getElementById("bno").value = "";
                document.getElementById("title").value = "";
                document.getElementById("sname").value = "";
                document.getElementById("aname").value = "";
                document.getElementById("publication").value = "";
                document.getElementById("request_date").value = "";
                document.getElementById("regno").value = "";
                document.getElementById("role").value = "";
                return;
            }
            else {
  
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
  
                    if (this.status == 200) {
                          
                        var info = JSON.parse(this.responseText);  
                          
                        document.getElementById("bno").value = info[0].bno;
                        document.getElementById("title").value = info[0].title;
                        document.getElementById("aname").value = info[0].aname;
                        document.getElementById("publication").value = info[0].publication;
                        document.getElementById("request_date").value = info[0].request_date;

                        document.getElementById("regno").value = info[0].regno;
                        document.getElementById("sname").value = info[0].sname;
                        document.getElementById("book_id").value = info[0].bid;
                        document.getElementById("role").value = info[0].role;
                    }
                };
  
                xmlhttp.open("GET", "ajax.php?r=" + str, true);
                xmlhttp.send();
            }
        }


function validate(form) {

    // validation code here ...
    if(!valid) {
        alert('Please correct the errors in the form!');
        return false;
    }
    else {
        return confirm('Do you really want to return the Book?');
    }
}

	</script>
</html>

		