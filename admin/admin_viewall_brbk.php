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
			.center td{
				text-align:center;
			}
			#cen{
				margin-top:25px;
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
		<div class=" col-md-9">
			<?php

				echo"	<div class='form-group pull-right col-md-3'> 
							<input type='text' class='form-control' id='search' placeholder='Search Here' style='margin-top:5px'>
							</div>
						";			
			
				$qry="select sbb.sbid,sbb.sid,sbb.bid,sbb.request_date,sbb.role,sb.bno,sb.bcode,sb.title,sb.aname,sb.publication, GREATEST(DATEDIFF(CURDATE(),sbb.return_date) , 0) as fineday, se.fine from barrow_books sbb join books sb on sb.bid = sbb.bid join settings se order by sbid";
  
				$res=$con->query($qry);
				if($res->num_rows>0)
				{
					$i=1;
					echo"<button type='text' class='btn btn-primary' onClick='down()' style='margin-left:1%'>Export all</button>";
					echo"
					<div class='asset-inner'>
					<h3 class='page-header text-primary'><span class='fa fa-list'> View Issued books</span></h3>
						";
				
						echo"
					
						<table class='table table-bordered'>
							<tr>
								<th><center>S.No 			</center></th>
								<th><center>NAME	</center></th>
								<th>
									<center>ROLE
										<select class='form-control' name='role' id='role' onchange='myFun()' width='5'>
											<option value=''>all</option>
											<option value='staff'>staff</option>
											<option value='student'>student</option>
										</select>

								    </center>
								</th>
								<th><center>BARCODE	    </center></th>
								<th><center>TITLE 		</center></th>
							<!--	<th><center>AUTHER NAME </center></th>-->
							<!--	<th><center>PUBLICATION </center></th>--->
								<th><center>REQUEST DATE</center></th>
								<th><center>DAY   		</center></th>
								<th><center>FINE  	    </center></th>
							</tr><tbody id='mytable'>
					";
					while($row=$res->fetch_assoc())
					{

						$fine = $row['fineday'] * $row['fine'];
						$req_date = $row['request_date'];
						$newreqdate = date("d-m-Y", strtotime($req_date));

						if ($row['role']=='staff') {
    						$qru = "select * from staff where sid='{$row['sid']}'";
    					} else {
    						$qru="select * from students where st_id='{$row['sid']}'";
    					}
    						$qery = $con->query($qru); 

							$row1 = $qery->fetch_assoc();
						
						echo"
							<tr class='center'>
								<td>{$i}</td>";

				    	$fine = $row['fineday'] * $row['fine'];

						echo "	
								<td>{$row1['sname']}</td>
								
								<td>{$row['role']}</td>
								<td>{$row['bcode']}</td>
								<td>{$row['title']}</td>
							<!--	<td>{$row['aname']}</td>-->
								<td>{$newreqdate}</td>
								<td>{$row['fineday']}</td>
								<td>{$fine}</td>
								
							</tr>
						";
						$i++;
						}
					echo"
						</table>
						</div>
					";
				} else{
						echo"<div class='alert alert-danger'>Record Not Found....!!!</div>";

				}
	
			?>			
		</div>						
		<footer>
			<?php
				include"../include/footer.php";
			?>
		</footer>
	</body>

	<script>
		$(document).ready(function(){
			$('#search').on("keyup",function(){								
				$("#mytable tr").each(function(){
					var txt=$(this).text().toUpperCase();
					var s=$("#search").val().toUpperCase();
					if(txt.indexOf(s)==-1)
					{
						$(this).css({"display":"none"});
					}
					else
					{
						$(this).css({"display":""});						
					}
				});
			});
		});

		function myFun(){
			var input,filter,table,tr,td,i;
			input = document.getElementById("role");
			filter = input.value.toUpperCase();
			table = document.getElementById("mytable");
			tr = table.getElementsByTagName("tr");

			for (var i = 0; tr.length ; i++) {

				td = tr[i].getElementsByTagName("td")[2];
				if (td) {
					
					if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} 
					else {
						tr[i].style.display = "none";

					}
				}
			}
		}

		function down(){
			window.location.href='admin_issuebk_export.php';
		}

	</script>
</html>