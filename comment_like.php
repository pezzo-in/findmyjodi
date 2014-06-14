<?php
include('lib/myclass.php');
$val=explode('_',$_POST['val']);

$Cid=$val[0];
$Uid=$val[1];
$Pid=$val[2];

$select="select * from tbl_user_comment_like where Postid='".$Pid."' AND Commentid='".$Cid."' AND Userid='".$Uid."'";
$db_select=$obj->select($select);

if(count($db_select)==0)
{
	$insert_db="insert into tbl_user_comment_like(Id, Postid, Commentid, Userid)values(null, '".$Pid."', '".$Cid."', '".$Uid."')";
	$obj->insert($insert_db);
	echo 1;
}
else
{
	$delete_like="delete from tbl_user_comment_like where Id='".$db_select[0]['Id']."'";
	$obj->sql_query($delete_like);
	echo 0;
}

?>