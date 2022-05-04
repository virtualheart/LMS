<?php

	include"../include/config.php";
	//include "../Classes/PHPExcel/IOFactory.php";
	session_start();
	include"./admin_security.php";
?>

<?php 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "brrow book-data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('ID', 'NAME','ROLE', 'BARCODE', 'TITLE', 'AUTHER NAME', 'PUBLICATION','REQUEST DATE','FINEDAY','FINE'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $con->query("select sbb.sbid,sbb.sid,sbb.bid,sbb.request_date,sbb.role,sb.bno,sb.bcode,sb.title,sb.aname,sb.publication, GREATEST(DATEDIFF(CURDATE(),sbb.return_date) , 0) as fineday, se.fine from barrow_books sbb join books sb on sb.bid = sbb.bid join settings se order by sbid"); 

if($query->num_rows > 0){ 
	$i=1;
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 

    	if ($row['role']=='staff') {
    		$qru = "select * from staff where sid='{$row['sid']}'";
    	} else {
    		$qru="select * from students where st_id='{$row['sid']}'";
    	}
    		$qery = $con->query($qru); 

		$row1 = $qery->fetch_assoc();

		$id = $i;
		$name = $row1['sname'];
		$bcode = $row['bcode'];
		$title = str_replace(","," | ",$row['title']);
		$aname = str_replace(","," | ",$row['aname']);
		$req_date = $row['request_date'];
		$role = $row['role'];
        
		$public = str_replace(","," | ",$row['publication']);
		$fineday = $row['fineday'];
    	$fine = $row['fineday'] * $row['fine'];

        $lineData = array("{$id}", "{$name}", "{$role}", "{$bcode}", "{$title}", "{$aname}", "{$public}" ,$req_date, "{$fineday}", "{$fine}"); 

        array_walk($lineData, 'filterData'); 

        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        $i++;
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
?>