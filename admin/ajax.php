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

$sql="select  sbb.sid,sbb.bid,sbb.request_date,sbb.role,sb.bno,sb.bcode,sb.title,sb.aname,sb.publication, GREATEST(DATEDIFF(CURDATE(),sbb.return_date) , 0) as fineday, se.fine from barrow_books sbb join books sb on sb.bid = sbb.bid join settings se where bcode='{$r}'";

$result=$con->query($sql);

if($row = mysqli_fetch_array($result)) {
  
    $retinfo = array();  
   
    $sid = $row['sid'];  
    $bid = $row['bid'];  
    $request_date = $row['request_date'];  
    $bno = $row['bno'];  
    $bcode = $row['bcode'];  
    $title = $row['title'];  
    $aname = $row['aname'];  
    $publication = $row['publication'];    
    $role = $row['role'];
    $fineday = $row['fineday'];
    $fine = $fineday * $row['fine'];

      if ($role=="staff") {
        $sql1="select regno,sname from staff where sid='{$sid}'";
      } else {
        $sql1="select regno,sname from students where st_id='{$sid}'";
      }

      $res1=$con->query($sql1);
      if($row1=$res1->fetch_assoc()){        
        $regno = $row1['regno'];  
        $sname = $row1['sname'];  

      }
    
   
    $retinfo[] = array( 'sid' => $sid ,'bid' => $bid ,'request_date' => $request_date ,'bno' => $bno ,'bcode' => $bcode ,'title' => $title ,'aname' => $aname ,'publication' => $publication ,'regno' => $regno ,'sname' => $sname ,'role' => $role,'fineday' => $fineday, 'fine' => $fine );

  //header('Content-Type: application/json; charset=utf-8');
  echo json_encode($retinfo);

  }
}

//user get ajax php staff and student

if (isset($_GET['u'])) {

  $u=$_GET["u"];

  if($u[0]=='S' || $u[0]=='s'){ //Start Regno start with 'S' for staff

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