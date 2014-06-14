<?php
include('../lib/myclass.php');

session_start();
if($_POST['member_id'] != "")
{
	$update_page="UPDATE express_interest SET is_accepted = 'Y' where id = '".$_POST['member_id']."'";
	$db_updatepage=$obj->edit($update_page);
	echo $update_page;			
}
else
{
	echo $update_page;
}
	
?>