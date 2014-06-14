<?php 
if($_SESSION['UserEmail']!='')
{
	$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$_SESSION['logged_user'][0]['id']."' AND members.id=member_plans.member_id and member_plans.expiry_date>'".date('Y-m-d')."'";
	
	$db_member_plan=$obj->select($select_member_plan);

	if(count($db_member_plan)>0)
	{
		include('include/chat.php'); 
		include('include/online_members.inc.php');
	}
}
?>