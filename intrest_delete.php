<?php 



session_start();



include('lib/myclass.php');



//$_POST['id'];

$sqld="delete from express_interest where id = '".$_POST['id']."' ";



$sel_delete	= $obj->sql_query($sqld);





	

echo '1';	





 

?>