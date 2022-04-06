<?php

  include"../include/config.php";
  session_start();
  include"./admin_security.php";

//get barrow book detiles

if (isset($_GET['q'])) {

$q=$_GET["q"];

$sql="SELECT bid,bcode,title,bno,aname,publication,status,sstatus FROM books WHERE bcode = '".$q."' limit 1";

$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result))
  {
    $info = array();

     $bid = $row['bid'];
     $bcode = $row['bcode'];
     $title = $row['title'];
     $bno = $row['bno'];
     $aname = $row['aname'];
     $publication = $row['publication'];
     $stat = $row['status'];
     $sstat = $row['sstatus'];

    $info[] = array( 'bid' => $bid, 'bcode' => $bcode, 'title' => $title, 'bno' => $bno, 'aname' => $aname, 'publication' => $publication, 'stat' => $stat, 'sstat' => $sstat );

  //  $info[] =array($bid,$bcode,$title,$bno,$aname,$publication);

  //header('Content-Type: application/json; charset=utf-8');
  echo json_encode($info);

  }
}

// get return book detiles

if (isset($_GET['r'])) {

$r=$_GET["r"];

$sql="select sbb.sbid,sbb.sid,sbb.bid,sbb.request_date,sbb.return_date,sbb.today,sbb.status,sb.bid,sb.sno,sb.bno,sb.bcode,sb.title,sb.aname,sb.publication,sb.status,sb.sstatus,stf.regno,stf.sname,stf.did,stf.id,stf.role
from  staff_barrow_books sbb 
  join books sb 
    on sb.bid = sbb.bid 
  join staff stf 
    on stf.sid = sbb.sid
where bcode='{$r}'";

$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result))
  {
    $retinfo = array();
    
   
    $sbid = $row['sbid'];
    $sid = $row['sid'];  
    $bid = $row['bid'];  
    $request_date = $row['request_date'];  
    $return_date = $row['return_date'];  
    $today = $row['today'];  
    $status = $row['status'];  
    $bid = $row['bid'];  
    $sno = $row['sno'];  
    $bno = $row['bno'];  
    $bcode = $row['bcode'];  
    $title = $row['title'];  
    $aname = $row['aname'];  
    $publication = $row['publication'];    
    $status = $row['status'];  
    $sstatus = $row['sstatus'];  
    $regno = $row['regno'];  
    $sname = $row['sname'];  
    $did = $row['did'];  
    $id = $row['id'];    
    $role = $row['role'];

//test
//echo $sbid.$sid.$bid.$request_date.$return_date.$today.$status.$bid.$sno.$bno.$bcode.$title.$aname.$publication.$status.$sstatus.$sid.$regno.$sname.$did.$id.$role;

   
    $retinfo[] = array( 'sbid' => $sbid ,'sid' => $sid ,'bid' => $bid ,'request_date' => $request_date ,'return_date' => $return_date ,'today' => $today ,'status' => $status ,'bid' => $bid ,'sno' => $sno ,'bno' => $bno ,'bcode' => $bcode ,'title' => $title ,'aname' => $aname ,'publication' => $publication ,'status' => $status ,'sstatus' => $sstatus ,'sid' => $sid ,'regno' => $regno ,'sname' => $sname ,'did' =>  $did ,'id' => $id ,'role' => $role );

  //header('Content-Type: application/json; charset=utf-8');
  echo json_encode($retinfo);

  }
}

//user get ajax php staff and student

if (isset($_GET['u'])) {

  $u=$_GET["u"];

  if($u[0]=='S'){ //Start Regno start with 'S' for staff

    $sql="SELECT sid,sname,role,semail FROM staff WHERE regno = '".$u."' limit 1";
  } else{  // Student Regno Start joining year
    $sql="SELECT st_id,sname,role,stemail FROM students WHERE regno = '".$u."' limit 1";
  }

    $result = mysqli_query($con,$sql);

      while($row = mysqli_fetch_array($result)){
        $uinfo = array();

        if ($u[0]=='S') {
          $sid = $row['sid'];
          $mail = $row['semail'];
        } else {
          $sid = $row['st_id'];
          $mail = $row['stemail'];
        }

          $sname = $row['sname'];
          $role = $row['role'];

        $uinfo[] = array('sid' => $sid, 'sname' => $sname,'email' => $mail, 'role' => $role);
     
        echo json_encode($uinfo);
      }
  }
?> 