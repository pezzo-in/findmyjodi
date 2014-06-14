<?php
session_start();
include('lib/myclass.php');
//echo"<pre>";print_r($_POST); exit;

$like_id= $_POST['val'];
//echo $like_id; exit;
$post_date = date('Y-m-d H:i:s');
$post_time = date('H:i');

$select_member_id = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
$db_select_member_id = $obj->select($select_member_id);

$select_post_user = "select * from tbl_user_post_like where PostId = '".$like_id."' AND UserId = '".$db_select_member_id[0]['id']."'";
//echo $select_post_user;
$db_select=$obj->select($select_post_user);

//echo count($db_select)."</br>";
//echo"<pre>";print_r($db_select); exit;

if(count($db_select)==0)
{
	
	$insert_like = "insert into tbl_user_post_like(Id, PostId, UserId, Cdate, Ctime) values(null, '".$like_id."', '".$db_select_member_id[0]['id']."', '".$post_date."', '".$post_time."')";
	//echo $insert_like; exit;
	$obj->insert($insert_like);
	echo 1;
}
else
{
	$delete_like = "delete from tbl_user_post_like where PostId = '".$like_id."' AND UserId = '".$db_select_member_id[0]['id']."'";
	//echo $delete_like; exit;
	$obj->sql_query($delete_like);
	echo 0; 
}

?>