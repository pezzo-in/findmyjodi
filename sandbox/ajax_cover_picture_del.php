<?php
include('lib/myclass.php');

$update_cover="delete from member_photo_gallery where id='".$_POST['pid']."'";
$obj->sql_query($update_cover);
?>