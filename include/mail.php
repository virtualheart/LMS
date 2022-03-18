<?php
	
	// cusmail("k.dhanajayan1999@gmail.com","dhana",'2');

function cusmail($getmail,$sname,$book_id){

$name = 'GAC-7 LIB';
$email = '';
$subject = 'You borrowed a book from your GAC-7 library';
//$body = file_get_contents('../include/mail.phtml');

	$con=mysqli_connect("localhost","smk","","sinpro");
	
	$qry="select app_name,smtp_host,smtp_port,smtp_user,smtp_pass,smtp_sec_type from settings";
	

	$res=$con->query($qry);									
	if($res->num_rows>0){
		$row=$res->fetch_assoc();
		$app_name = $row["app_name"];
		$host = $row["smtp_host"];
		$port = $row["smtp_port"];
		$user = $row["smtp_user"];
		$pass = $row["smtp_pass"];
		$sec_type = $row["smtp_sec_type"];
	}
	require '../Classes/PHPMailer/class.phpmailer.php';

	$qery="select title,aname,publication from books where bid='".$book_id."'";
	$res1=$con->query($qery);	

	if($res1->num_rows>0){
		$row1=$res1->fetch_assoc();
		$title = $row1["title"];
		$aname = $row1["aname"];
		$publication = $row1["publication"];
		$reqdate = date("d-m-Y");
		$etadate = date("d-m-Y",strtotime("+60 days"));
	
		$body = str_replace(array('{name}', '{caname}', '{ctitle}', '{cpublic}', '{crdate}', '{cetdate}'),array($sname, $aname, $title, $publication, $reqdate, $etadate, ),file_get_contents('../include/mail.phtml'));
		
		//echo $body;
	}

	
		$mail = new PHPMailer;
		$mail->IsSMTP();										//Sets Mailer to send message using SMTP
		$mail->Mailer = "smtp";
		$mail->Host = $host;									//Sets the SMTP hosts of your Email hosting, this for Godaddy
		$mail->Port = $port;									//Sets the default SMTP server port
		$mail->SMTPAuth = true;									//Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = $user;								//Sets SMTP username
		$mail->Password = $pass;								//Sets SMTP password
		$mail->SMTPSecure = $sec_type;							//Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->From = $user;									//Sets the From email address for the message
		$mail->FromName = $app_name;							//Sets the From name of the message
		$mail->AddAddress($getmail, $sname);					//Adds a "To" address
		//$mail->AddCC($_POST["email"], $_POST["name"]);		//Adds a "Cc" address
		$mail->WordWrap = 50;									//Sets word wrapping on the body of the message to a given number of characters
		$mail->IsHTML(true);									//Sets message type to HTML				
		$mail->Subject = $subject;								//Sets the Subject of the message
		//$mail->Body = $_POST["message"];						//An HTML or plain text message body
		
		$mail->MsgHTML($body);
		
		// help to easy to debug (1 - warring + mgs / 2 - mgs )
		//$mail->SMTPDebug = 1;

		if($mail->Send()){										//Send an Email. Return true on success or false on error
		
		}		
}
?>
