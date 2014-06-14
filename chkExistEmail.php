<?php
include('lib/myclass.php');
 $email=($_GET['email']);
 $select_category = "select * from members where email_id = '".$email."'";
 $db_category = $obj->select($select_category);
echo $db_category[0]['id']
 ?>
