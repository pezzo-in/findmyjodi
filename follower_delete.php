<?php 

session_start();

include('lib/myclass.php');

//$_POST['id'];
$sqld="delete from tbl_user_followers where Id = '".$_POST['id']."' ";

$sel_delete	= $obj->sql_query($sqld);


	
echo '1';	


 
?>