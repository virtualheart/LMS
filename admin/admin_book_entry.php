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
	/*					
			$host=$_POST["host"];
			$port=$_POST["port"];
			$user=$_POST["email"];
			$pass=$_POST["Password"];
			$sectyp=$_POST["server_type"];						
						
		*/
			$qry="";
			//echo $qry;
			if($con->query($qry)){
				echo"<div class='alert alert-success'>Update Success</div>";			
			} else {	
				echo"<div class='alert alert-danger'>Update Falied</div>";			
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
			<input type="text" name="sname" id='sname' value="jjj" class="form-control" disabled required>
		</div>

		<div class="form-group col-md-5">
			<label>Book No</label>
			<input type="text" name="bno" id="bno" value="" class="form-control" disabled>
		</div>
		<div class="form-group col-md-5">
			<label>Title</label>
			<input type="text" name="title" id="title" value="" class="form-control" disabled>
		</div>
		<div class="form-group col-md-5">
			<label>Author Name</label>
			<input type="text" name="aname" id="aname" value="" class="form-control" disabled>
		</div>
		<div class="form-group col-md-5">
			<label>Publication</label>
			<input type="text" name="publication" id="publication" value="" class="form-control" disabled>
		</div>
		<div class="form-group col-md-5">	
			<label>Request Date</label>
			<input type="text" name="reqdate" value="<?php echo date("d-m-Y");?>" class="form-control" disabled>
		</div>
		<div class="form-group col-md-5">
			<label>ETA Return Date</label>
			<input type="text" name="retdate" value="<?php echo date("d-m-Y",strtotime("+30 days"))?>" class="form-control" disabled>					
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
                        document.getElementById("publication").value = info[0].title;
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
     return;

	} else{

		var xmlhttpreq = new XMLHttpRequest();
        xmlhttpreq.onreadystatechange = function () {

			if (this.status == 200 ) {
				var uinfo = JSON.parse(this.responseText)
			     document.getElementById("sname").value = uinfo[0].sname;
			}

		};

		xmlhttpreq.open("GET", "ajax.php?u=" + usr, true);
        xmlhttpreq.send();
	}

}

	</script>
</html>