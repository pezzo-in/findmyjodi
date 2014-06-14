<?php
session_start();
include('lib/myclass.php');
 $email=($_GET['email']);
 $select_category = "select * from members 
 					 where email_id = '".$email."' and 
					 id != '".$_SESSION['logged_user'][0]['id']."'";
 $db_category = $obj->select($select_category);
echo $db_category[0]['id']
 ?>
