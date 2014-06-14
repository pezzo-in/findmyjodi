<?php
session_start();
include('lib/myclass.php');


if(isset($_POST['val']))
{
	$id = str_replace('post_wrapper','',$_POST['val']);
	$delete = "delete from tbl_user_post where Id = '".$id."'";
	$obj->sql_query($delete);
	
	$delete_comment = "delete from tbl_user_post_comment where PostId = '".$id."'";
	$obj->sql_query($delete_comment);
	
	$delete_post_like = "delete from tbl_user_post_like where PostId = '".$id."'";
	$obj->sql_query($delete_post_like);
	
	$delete_comment_like = "delete from tbl_user_comment_like where PostId = '".$id."'";
	$obj->sql_query($delete_comment_like);
	
	echo '1';
}
?>