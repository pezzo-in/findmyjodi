<?php
include('../lib/myclass.php');

session_start();
if($_GET['flag'] == "interest")
{
	$update_mem = "update express_interest 
				   set interested = 'N'	
				   where 
				   from_mem = '".$_SESSION['logged_user'][0]['member_id']."' and
				   to_mem = '".$_POST['to_member_id']."'";				   

	$update = $obj->edit($update_mem);
	echo "1";	
}
else
{
	$insert = "insert into not_interested_members
					(id,from_mem,to_mem,date,msg_id)
				values
				(NULL,'".$_SESSION['logged_user'][0]['member_id']."','".$_POST['to_member_id']."',NOW(),'".$_POST['msg_id']."')";
	$result = $obj->insert($insert);
	
	$update_mem = "update messages 
				   set interested = 'N'	
				   where 
				   to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and
				   from_mem = '".$_POST['to_member_id']."' and
				   id = '".$_POST['msg_id']."'";

	$update = $obj->edit($update_mem);
	echo "1";						
}
	
?>