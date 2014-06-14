<?php
include('lib/myclass.php');
 $mob_no=($_GET['phone']);
 $select_category = "select * from members where mobile_no = '".$mob_no."'";
 $db_category = $obj->select($select_category);
echo $db_category[0]['id']
 ?>
