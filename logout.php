<?php
session_start();	
include('lib/myclass.php');
$select_online = "select * from chat_users where email = '".$_SESSION['UserEmail']."'";
$db_select_online = $obj->select($select_online);
if(count($db_select_online) > 0)
{
	$update_chat_user="update chat_users set status='0' where email='".$_SESSION['UserEmail']."'";
	$obj->edit($update_chat_user);
	
	//$delete = "delete from chat_users where email = '".$_SESSION['UserEmail']."'";
	//$db = $obj->sql_query($delete);
}
$_SESSION['UserEmail']='';
$_SESSION['chatUserId']='';
$_SESSION['chatUserName']='';
$_SESSION['chatUserEmail']='';
$_SESSION['chatStat']='';
$_SESSION['inserted_id']='';
session_unset();
session_destroy();

echo"<script language='javascript'>window.location.href='login.php'</script>";
?>

