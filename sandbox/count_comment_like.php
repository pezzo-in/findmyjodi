<?php
include('lib/myclass.php');
$val=explode('_',$_POST['val']);

$Cid=$val[0];
$Uid=$val[1];
$Pid=$val[2];

$select="select * from tbl_user_comment_like where Postid='".$Pid."' AND Commentid='".$Cid."'";
$db_select=$obj->select($select);

echo count($db_select);

?>