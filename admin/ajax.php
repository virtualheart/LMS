<?php

  include"../include/config.php";
  session_start();
  include"./admin_security.php";


if (isset($_GET['q'])) {

$q=$_GET["q"];

$sql="SELECT bid,bcode,title,bno,aname,publication FROM books WHERE bcode = '".$q."' limit 1";

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

    $info[] = array( 'bid' => $bid, 'bcode' => $bcode, 'title' => $title, 'bno' => $bno, 'aname' => $aname, 'publication' => $publication );

  //  $info[] =array($bid,$bcode,$title,$bno,$aname,$publication);

  //header('Content-Type: application/json; charset=utf-8');
  echo json_encode($info);

}
}
if (isset($_GET['u'])) {

  $u=$_GET["u"];

$sql="SELECT sid,sname FROM staff WHERE regno = '".$u."' limit 1";

$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result))
  {
    $uinfo = array();
     $sid = $row['sid'];
     $sname = $row['sname'];

     $uinfo[] = array('sid' => $sid, 'sname' => $sname);
     
     echo json_encode($uinfo);

  }
}
?> 