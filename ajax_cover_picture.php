<?php
include('lib/myclass.php');

$update_cover_pic="update member_photo_gallery set Cover_photo='0' where member_id='".$_POST['uid']."'";
$obj->edit($update_cover_pic);

$update_cover="update member_photo_gallery set Cover_photo='1' where id='".$_POST['pid']."'";
$obj->edit($update_cover);
?>