<?php 

session_start();

include('lib/myclass.php');

//$_POST['id'];
$sqld="delete from photo_request where Id = '".$_POST['id']."' ";

$sel_delete	= $obj->sql_query($sqld);


	
echo '1';	


 
?>