<?php
	include"./include/config.php";
	session_start();
	
	$qry="select * from books where title like '%{$_POST['item']}%'";
	$res=$con->query($qry);
	if($res->num_rows>0)
	{
		echo"
			<table class='table table-bordered'>
				<tr>
					
					<th>Serial No</th>
					<th>Book No</th>
					<th>Title</th>
					<th>Author</th>
					<th>Publication</th>
					<th>Price</th>
					<th>Alamara</th>
					<th>Rack</th>
				</tr>			
		";
		while($row=$res->fetch_assoc())
		{
			echo"
				<tr>
					<td>{$row['sno']}</td>
					<td>{$row['bno']}</td>
					<td>{$row['title']}</td>
					<td>{$row['aname']}</td>
					<td>{$row['publication']}</td>
					<td>{$row['price']}</td>
					<td>{$row['alamara']}</td>
					<td>{$row['rack']}</td>
				</tr>
			";
		}
		echo"</table>";
	}
?>