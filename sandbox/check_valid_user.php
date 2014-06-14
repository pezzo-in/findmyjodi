<?php
include('lib/myclass.php');

if($_POST['user']=='1')
{
	$select_bridge = "select gender from members where member_id = '".$_POST['val']."' and status='active' and is_profile_active='Y'";
	$db_bride = $obj->select($select_bridge);
	if(count($db_bride)!=1 || $db_bride[0]['gender']!='F'){echo '1';}
}
elseif($_POST['user']=='2')
{
	$select_groom = "select gender from members where member_id = '".$_POST['val']."' and status='active' and is_profile_active='Y'";
	$db_groom = $obj->select($select_groom);
	if(count($db_groom)!=1 || $db_groom[0]['gender']!='M'){echo '1';}
}
?>