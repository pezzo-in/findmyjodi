<?php
session_start();
include('lib/myclass.php');
$action = $_POST['str'];

$id = $_POST['pid'];

if($action==2 && $id!='')
{
	
	$likeid = $_POST['pid'];
	$cdate = date('Y-m-d H:i:s');
	$ctime = date('H:i');
	
	$select_member_id = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
	$db_select_member_id = $obj->select($select_member_id);
	
	$insert_like = "insert into tbl_user_post_like(Id, PostId, UserId, Cdate, Ctime) values(null, '".$likeid."', '".$db_select_member_id[0]['id']."', '".$cdate."', '".$ctime."')";
	$db_user = $obj->insert($insert_like);
	
}
if($action == 3 && $id != '')
{
	
	$likeid = $_POST['pid'];
	$cdate = date('Y-m-d H:i:s');
	$ctime = date('H:i');
	
	$select_member_id = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
	$db_select_member_id = $obj->select($select_member_id);
	
	$delete_like = "delete from tbl_user_post_like where PostId = '".$likeid."' AND UserId = '".$db_select_member_id[0]['id']."'";
	$obj->sql_query($delete_like);
	
	$select_liked_total = "select * from tbl_user_post_like where UserId = '".$db_select_member_id[0]['id']."'";
	$db_user = $db_liked_total = $obj->select($select_liked_total);
	
}
echo count($db_user);
?>

        <?php if(count($db_user) > 0) { ?>
                <div class="wholikes"><a href="#" class="like"></a><?php echo count($db_user); ?> like this. </div>
         <?php }?>
       


