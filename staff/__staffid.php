<?php 
	include"../include/config.php";
	$sql="SELECT regno FROM staff ORDER By regno DESC LIMIT 1";
			$res=$con->query($sql);
			$cp="";
			
			if($res->num_rows>0)
			{
				$row=$res->fetch_assoc();
				 $cp=$row["regno"];
				$cp1=substr($cp,0,1);
				$cp2=substr($cp,1,strlen($cp));
				$num=(int)$cp2;
				$num++;
				$cp=$cp1.$num;
				echo $cp.' ';
				echo $cp1.' ';
				echo $cp2.' ';
				echo $num.' ';
			}
			else
			{
				echo $cp="S1001";
			}
?>