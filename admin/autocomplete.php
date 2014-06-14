<?php
session_start();
include('../lib/myclass.php');



$q=$_GET['q'];
 
 $sql="select * from members where name LIKE '%$my_data%' and gender = '".$_GET['gender']."' ORDER BY name";
 //$result = mysqli_query($mysqli,$sql) or die(mysqli_error());
 $result=$obj->select($sql);	
if($result)
 {
  //while($row=mysqli_fetch_array($result))
  foreach($result as $res)
  {
   echo $res['name']." - ".$res['member_id']."\n";
  }
 }
?>