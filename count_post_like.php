<?php
include('lib/myclass.php');

$like_id1= $_POST['val'];

$select="select * from tbl_user_post_like where Postid='".$like_id1."'";
$db_liked_total=$obj->select($select);

echo count($db_liked_total);

?>