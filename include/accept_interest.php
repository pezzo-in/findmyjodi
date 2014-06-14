<?php
session_start();
include('../lib/myclass.php');

	$insert="INSERT into accept_interest(id, from_mem,to_mem,date)
			 values
			 		(NULL,'".$_SESSION['logged_user'][0]['member_id']."','".$_POST['to_mem']."', NOW() )";	
	$db_ins=$obj->insert($insert);
	
	$insert1="INSERT into notification_info(id, cdate, type, from_id,to_id,status)
			 values
			 		(NULL,  NOW(), '2', '".$_SESSION['logged_user'][0]['member_id']."', '".$_POST['to_mem']."', 0)";	
					
	//echo $insert1;		  exit;		
	$db_ins1=$obj->insert($insert1);
	
	$update = "update express_interest 
				set is_accepted = 'Y'
	           where
			   from_mem = '".$_POST['to_mem']."' and
			   to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";

	$res = $obj->edit($update);
	echo "1";
	//echo "Congrats! You have successfully accepted intereste.";		   
	
?>