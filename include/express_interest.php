<?php
session_start();
include('../lib/myclass.php');
if($_POST['site'] == '2')
{
	//echo"1"; exit;	
	$date1 = date('Y-m-d H:i:s');
	$insert="INSERT into express_interest(id, from_mem,to_mem,created_date) values(NULL,'".$_SESSION['logged_user'][0]['member_id']."','".$_POST['to_mem']."', '".$date1."')";	
	$db_ins=$obj->insert($insert);
	
	$insert1="INSERT into notification_info(id, cdate, type, from_id, to_id, status)
			 values
			 		(NULL, '".$date1."','1', '".$_SESSION['logged_user'][0]['member_id']."','".$_POST['to_mem']."','0')";	
	//echo $insert1;				exit;
	$db_ins1=$obj->insert($insert1);
	echo '1';
}
else
{
	//echo"2"; exit;
	$date1 = date('Y-m-d H:i:s');
	$insert="INSERT into express_interest(id, from_mem,to_mem,created_date)
			 values
			 		(NULL,'".$_SESSION['logged_user'][0]['member_id']."','".$_POST['to_mem']."','".$date1."')";	
	$db_ins=$obj->insert($insert);
	
	$insert1="INSERT into notification_info(id, cdate, type, from_mem, to_mem, status)
			 values
			 		(NULL, '".$date1."',1, '".$_SESSION['logged_user'][0]['member_id']."','".$_GET['to_mem']."',0)";	
	$db_ins1=$obj->insert($insert1);
	/*echo "<script> alert('Message Sent!!!'); </script>"; */
	echo '1';
}
?>