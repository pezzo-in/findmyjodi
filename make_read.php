<?php
session_start();
include('lib/myclass.php');
$to=$_REQUEST['To'];
$read="update messages set is_read=1 where to_mem='".$to."'";
$obj->edit($read);

?>