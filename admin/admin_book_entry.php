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
	<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>" onsubmit="return confirm('Do you really want to Barrow the Book?');">
	<h3 class='page-header text-primary'><i class='fa fa-book'> Barrow Books</i></h3>

	<?php

		if(isset($_POST["submit"])){

			$stat = $_POST['stat'];

			if ($stat==0) {
						
			$bcode = $_POST['barcode'];
			$regno = $_POST['regno'];
			$sname = $_POST['sname'];
			$bno = $_POST['bno'];
			$title = $_POST['title'];
			$aname = $_POST['aname'];
			$Publication = $_POST['publication'];
			$reqdate = $_POST['reqdate'];
			$retdate = $_POST['retdate'];
			$staff_id = $_POST['staff_id'];
			$book_id = $_POST['book_id'];

			$newreqdate = date("Y-m-d", strtotime($reqdate));
			$newretdate = date("Y-m-d", strtotime($retdate));
			
			//Testing echo
			//echo "bcode : ".$bcode."<br>regno : ".$regno."<br>sname : ".$sname."<br>bno : ".$bno."<br>title : ".$title."<br>aname : ".$aname."<br>publ : " .$Publication."<br>reqdate : ".$newreqdate."<br>retdate : ".$newretdate."<br>staff_id : ".$staff_id."<br>book_id : ".$book_id;
						
		
			$qry="INSERT INTO staff_barrow_books (`sid`, `bid`, `request_date`, `return_date`, `today`, `status`)
					VALUES ('{$staff_id}', '{$book_id}', '{$newreqdate}', '{$newretdate}', '{$newreqdate}', '1');";
			//echo $qry;
			if($con->query($qry)){
				echo"<div class='alert alert-success'>Update Success</div>";	
				$qury="update books set status='1' where bid='{$book_id}'";
				//echo $qury;	
				if ($con->query($qury)) {

				}
			} else {	
				echo"<div class='alert alert-danger'>Update Falied</div>";			
			}								
		} else {
				echo"<div class='alert alert-danger'>Book unavaliable </div>";			
		}
	}

 
	?>   

		<div class="form-group col-md-5">
			<label>Barcode</label>
			<input type="text" name="barcode" id='barcode' value="" class="form-control" onkeyup="GetDetail(this.value)" maxlength="13" required>
		</div>
		<div class="form-group col-md-5">
			<label>Reg Number</label>
			<input type="text" name="regno" id='regno' value="" class="form-control" onkeyup="GetUser(this.value)" required>
		</div>
		<div class="form-group col-md-5">
			<label>Std/staff name</label>
			<input type="text" name="sname" id='sname' value="" class="form-control" readonly="true" required>
			<input type="hidden" name="staff_id" id="staff_id" value="">
		</div>

		<div class="form-group col-md-5">
			<label>Book No</label>
			<input type="text" name="bno" id="bno" value="" class="form-control" readonly="true">
			<input type="hidden" name="book_id" id="book_id" value="">
			<input type="hidden" name="stat" id="stat" value="">
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
			<input type="text" name="reqdate" value="<?php echo date("d-m-Y");?>" class="form-control" readonly="true">
		</div>
		<div class="form-group col-md-5">
			<label>ETA Return Date</label>
			<input type="text" name="retdate" value="<?php echo date("d-m-Y",strtotime("+30 days"))?>" class="form-control" readonly="true">					
				</div>
		<div class="form-group col-md-5" style="margin-top:35px">
			<input type="submit" name="submit" class="btn btn-primary" value="Barrow">			
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
                document.getElementById("book_id").value = "";
                document.getElementById("staff_id").value = "";
                document.getElementById("stat").value = "";
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
                        document.getElementById("book_id").value = info[0].bid;
                        document.getElementById("stat").value = info[0].stat;
                       // document.getElementById("title").value = info[0].title;
                    }
                };
  
                xmlhttp.open("GET", "ajax.php?q=" + str, true);
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
        return confirm('Do you really want to Barrow the Book?');
    }
}

function GetUser(usr){
	if (usr.length == 0) {
     document.getElementById("sname").value = "";
     document.getElementById("staff_id").value = "";
     return;

	} else{

		var xmlhttpreq = new XMLHttpRequest();
        xmlhttpreq.onreadystatechange = function () {

			if (this.status == 200 ) {
				var uinfo = JSON.parse(this.responseText)
			     document.getElementById("sname").value = uinfo[0].sname;
			     document.getElementById("staff_id").value = uinfo[0].sid;
			}

		};

		xmlhttpreq.open("GET", "ajax.php?u=" + usr, true);
        xmlhttpreq.send();
	}

}

	</script>
</html>