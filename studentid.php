<?php 
include "config.php";
$sql="SELECT regno FROM students ORDER By regno DESC LIMIT 1";
			$res=$con->query($sql);
			$cp="";			
			if($res->num_rows>0)
			{
				$row=$res->fetch_assoc();
				$cp=$row["regno"];
				$cp1=substr($cp,0,2);
				$cp2=substr($cp,2,strlen($cp));
				$num=(int)$cp2;
				$num++;
				$cp=$cp1.$num;
				echo $cp;				
			}
			else
			{
				echo $cp="ST1001";
			}
?>