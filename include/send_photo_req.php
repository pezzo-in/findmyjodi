<?php
session_start(); 
include('../lib/myclass.php');
if(isset($_POST['from_mem']))
{
	$insert_photo_request="insert into photo_request(Id, From_mem_id, To_mem_id)values(null, '".$_POST['from_mem']."', '".$_POST['to_mem']."')";
	$obj->insert($insert_photo_request);
	echo '1';
}