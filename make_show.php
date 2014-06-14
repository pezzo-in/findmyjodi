<?php
session_start();
include('lib/myclass.php');
$to=$_REQUEST['To'];
$read="update notification_info set status=1 where to_id='".$_REQUEST['To']."'";
$obj->edit($read);
?>