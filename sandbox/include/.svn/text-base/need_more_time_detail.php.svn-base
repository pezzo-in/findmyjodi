<?php
session_start();
include('../lib/myclass.php');

	$insert = "update express_interest set is_more_time=1, more_time_date='".date('Y-m-d')."' where id='".$_POST['to_mem']."'";
					/*(id,from_mem,to_mem,date)
				values
				(NULL,'".$_SESSION['logged_user'][0]['member_id']."','".$_POST['to_mem']."',NOW())";
	$result = $obj->insert($insert);*/
	$result = $obj->edit($insert);
	
		$insert1="INSERT into notification_info(id, cdate, type, from_id,to_id,status)
			 values
			 		(NULL,  NOW(), '3', '".$_SESSION['logged_user'][0]['member_id']."', '".$_POST['to_id']."', 0)";	
					
	//echo $insert1;		
	$db_ins1=$obj->insert($insert1);
	
	/*$delete = "delete from express_interest
			   where
			   from_mem = '".$_POST['to_mem']."' and
			   to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
	$obj->sql_query($delete);
*/
	echo "1";						
?>