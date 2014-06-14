<?php
session_start();
include('../lib/myclass.php');
$ids = explode('_',$_GET['id']);
$from_mem_id = $ids[0];
$msg_id = $ds[1];

$delete_msg = "delete from messages
			   where 
			   from _mem = '".$from_mem_id."' and
			   to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and
			   id = '".$msg_id."'";
$obj->sql_query($sqld);
echo "<script> window.location.href = '../all_notifications.php' </script>";				   
?>