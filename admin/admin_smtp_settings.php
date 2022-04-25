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
	<style>
			.tooltipoo .tooltiptextoo {
			  visibility: hidden;
			  width: 460px;
			  background-color: black;
			  color: #fff;
			  text-align: center;
			  border-radius: 6px;
			  padding: 5px 0;
			
			  /* Position the tooltip */
			  position: absolute;
			  z-index: 1;
			}
			
			.tooltipoo:hover .tooltiptextoo {
			  visibility: visible;
			}
	</style>


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

			<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
			<h3 class='page-header text-primary'><i class='fa fa-envelope'> SMTP Settings</i></h3>

	<?php
					if(isset($_POST["save"]))
					{					
						
						$host=$_POST["host"];
						$port=$_POST["port"];
						$user=$_POST["email"];
						$pass=$_POST["Password"];
						$sectyp=$_POST["server_type"];						
						
		
						$qry="update settings set smtp_host='$host',smtp_port='$port',smtp_user='$user',smtp_pass='$pass',smtp_sec_type='$sectyp' where id=1";
						//echo $qry;
						if($con->query($qry))
						{
							echo"<div class='alert alert-success'>Update Success</div>";			
						} else {
							echo"<div class='alert alert-danger'>Update Falied</div>";			
						}								
					}

			 $qry="SELECT smtp_host,smtp_port,smtp_user,smtp_pass,smtp_sec_type
			 		FROM settings 
			 ";
	
				$res=$con->query($qry);
			
				if($res->num_rows>0)
			
				{
			
					$row=$res->fetch_assoc();
			
				}								
				
				?>					
			
				<!-- <div class="form-group col-md-5">
					<label>Server Type</label>
					<select class="form-control" name="server_type">
						<option value="Choose any one">Select one any</option>
						<option value="email">Email</option>
						<option value="custom mail">Custom Server</option>
					</select>
				</div> -->

				<div class="form-group col-md-5">
					<label>Host(*)</label>
					<input type="text" name="host" value="<?php echo $row['smtp_host']?>" class="form-control" placeholder="smtp.server.com OR xxx.xxx.xxx.xx">
				</div>	

				<div class="form-group col-md-5">
					<label>Port(*)</label>
					<input type="number" name="port" class="form-control" value="<?php echo $row['smtp_port']?>" placeholder="SMTP Port" required>
				</div>

				<div class="form-group col-md-5">
					<label>Username(*)</label>
					<input type="text" name="email" class="form-control" value="<?php echo $row['smtp_user']?>" placeholder="Username" required>
				</div>
				
				<div class="form-group col-md-5">
					<label>Password(*)</label>
					<input type="Password" name="Password" value="<?php echo $row['smtp_pass']?>" class="form-control" placeholder="Password" required>
				</div>
				
				<div class="form-group col-md-5">
					<label>Server Type</label>
					<select class="form-control" name="server_type">
					<?php if ($row['smtp_sec_type']=="ssl") {
						echo "<option value='ssl' selected>ssl</option>";
						echo "<option value='tls'>tls</option>";
					} else  {
						echo "<option value='ssl'>ssl</option>";
						echo "<option value='tls' selected>tls</option>";
					}
					?>
					</select><br>

					<div class="tooltipoo">If you use GMAIL click<a href="https://myaccount.google.com/security" target="_blank"> here</a>  <span class="tooltiptextoo">* open link and turnon <b>Less secure app access</b><br>
					*  Disable 2 step verification<br>
					*  Host : smtp.gmail.com	<br>
					*  Port : 465 or 587	<br>
					*  Server Type : SSL or TLS<br>
					</span>
					</div>
				</div>



				<div class=" form-group col-md-5"style="position:relative;top:30px;">
					<label></label>
					<input type="submit" class="btn btn-primary btn-md " name="save" value="Save" style="margin-left:5px">					
					<input type="reset" class="btn btn-danger btn-md " value="Clear">
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
</html>