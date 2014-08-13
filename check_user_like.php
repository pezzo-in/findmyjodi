<?php
session_start();
include('lib/myclass.php');
$action = $_POST['str'];
$id = $_POST['pid'];
$userid = $_POST['userid']; 

if($action == 'unlike' && $id != '' && $userid != '')
{
	$likeid = $_POST['pid'];
	$userid = $_POST['userid'];
	$cdate = date('Y-m-d H:i:s');
	$ctime = date('H:i');
	
	$select_post_user = "select * from tbl_user_post where Id = '".$likeid."'";
	$db_post_user = $obj->select($select_post_user);
	$postuser = $db_post_user[0]['UserId'];
	
	$delete_like = "delete from tbl_user_post_like where PostId = '".$likeid."' AND UserId = '".$userid."'";
	$obj->sql_query($delete_like);
	
	
}
if($action == 'like' && $id != '' && $userid != '')
{
	$likeid = $_POST['pid'];
	$userid = $_POST['userid'];
	$cdate = date('Y-m-d H:i:s');
	$ctime = date('H:i');
	
	$select_post_user = "select * from tbl_user_post where Id = '".$likeid."'";
	$db_post_user = $obj->select($select_post_user);
	
//	$select_member_id = "select * from members where id = '".$db_post_user[0]['UserId']."'";
//	$db_select_member_id = $obj->select($select_member_id);
	$postuser = $db_post_user[0]['UserId'];
	
	$insert_like = "insert into tbl_user_post_like(Id, PostId, UserId, Cdate, Ctime) values(null, '".$likeid."', '".$userid."', '".$cdate."', '".$ctime."')";
	$obj->insert($insert_like);
	
}

		$select_member_id = "select * from members where id = '".$userid."'";
		$db_select_member_id = $obj->select($select_member_id);
		
		$select_post = "select * from tbl_user_post where UserId = '".$db_select_member_id[0]['id']."' ORDER BY Id DESC";
		$db_select_post = $obj->select($select_post);
		for($i=0;$i<count($db_select_post);$i++) 
		{
			$select_mem = "select * from members where id = '".$db_select_member_id[0]['id']."'";
			$db_mem = $obj->select($select_mem);
			
			$select_photo = "select * from member_photos where member_id = '".$db_select_member_id[0]['id']."' AND Approve = 1 ORDER BY id DESC";
			$db_select_photo = $obj->select($select_photo);
		?>
        
          <div class="mid_prof">
        	<?php if($db_select_photo[0]['photo']!='') { ?>
            <a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>"><img src="upload/<?php echo $db_select_photo[0]['photo']; ?>" width="47" height="46" alt="" /></a>
            <?php } else { ?>
            <a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>"><img src="images/about_pix.png" alt="" /></a>
            <?php } ?>
            <div class="prof_name"><a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>"><?php echo $db_mem[0]['name']." ".$db_mem[0]['caste']; ?></a><br /><span><?php echo date('d F, Y',strtotime($db_select_post[$i]['Cdate'])); ?></span>
            <!--<div class="update_right">Updated his <a href="#">About me</a>Text</div>-->
            </div>
            <p><?php echo $db_select_post[$i]['PostText']; ?></p>
            
            <?php if($db_select_post[$i]['Image']!=''){ ?><div class="comment_img"><a href="timeline_photo_post.php?id=<?php echo $db_select_post[$i]['Id']; ?>" class="ajax "><img src="upload/<?php echo $db_select_post[$i]['Image']; ?>" /></a></div><?php } ?>
            
            <?php
			
			$select_member_id_like = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
			$db_select_member_id_like = $obj->select($select_member_id_like);
		
			$select_liked = "select * from tbl_user_post_like where PostId = '".$db_select_post[$i]['Id']."' AND UserId = '".$db_select_member_id_like[0]['id']."'";
			$db_liked = $obj->select($select_liked);
			?>
            <div class="like_row">
            <?php if(count($db_liked) > 0) { ?>
            <a class="btn icon-unlike" href="javascript:void(0)" onclick="return check_user_like('unlike','<?php echo $db_select_post[$i]['Id']; ?>','<?php echo $db_select_member_id_like[0]['id']; ?>');"><span>UnLike</span></a>
            <?php } else { ?>
            <a class="btn icon-like" href="javascript:void(0)" onclick="return check_user_like('like','<?php echo $db_select_post[$i]['Id']; ?>','<?php echo $db_select_member_id_like[0]['id']; ?>');"><span>Like</span></a>
            <?php } ?>
            <a class="btn icon-comment" href="#"><span>Comment</span></a>
            <!--<a class="btn icon-share" href="#"><span>Share</span></a>-->
            
            <?php 
				$currentdatetime = date('Y-m-d');
				$postdatetime = date('Y-m-d',strtotime($db_select_post[$i]['Cdate']));
				if($postdatetime == $currentdatetime)
				{ 
					$currenttime = (date('H')*60)+date('i');
					$posttime = (date('H',strtotime($db_select_post[$i]['Cdate']))*60)+date('i',strtotime($db_select_post[$i]['Cdate']));
					$difftime = ($currenttime - $posttime);
					if($difftime < 59)
					{
						$finaltime = $difftime." mins ";
					}
					else
					{
						$hours = explode(".",($difftime / 60));
						$minute = ($difftime - ($hours[0]*60));
						
						$finaltime = $hours[0]." hrs ".$minute." mins ";
					}
			?>
            	<span> <?php echo $finaltime; ?> ago</span>
            <?php } else { 
					$dStart = new DateTime($postdatetime);
				   	$dEnd  = new DateTime($currentdatetime);
		   			$dDiff = $dStart->diff($dEnd);		  
			?>
            	<span> <?php echo $dDiff->days; ?> days ago</span>
            <?php } ?>
            </div>
            <?php
			$select_liked_total = "select * from tbl_user_post_like where PostId = '".$db_select_post[$i]['Id']."'";
			$db_liked_total = $obj->select($select_liked_total);
			?>
            <div class="commnt_part">
            	<?php if(count($db_liked_total) > 0) { ?>
                <div class="wholikes"><a href="#" class="like"></a><?php echo count($db_liked_total); ?> like this. </div>
                <?php } ?>
                <!--<div class="viewmore"><a href="#" class="viewmorecmmnts">View 4 more comments</a></div>-->
            <?php
			$select_comment = "select * from tbl_user_post_comment where PostId = '".$db_select_post[$i]['Id']."'";
			$db_comment = $obj->select($select_comment);
			if(count($db_comment)>0)
			{

				for($j=0;$j<count($db_comment);$j++)
				{
				$select_photo = "select * from member_photos where member_id = '".$db_comment[$j]['UserId']."' AND Approve = 1 ORDER BY id DESC";
				$db_select_photo = $obj->select($select_photo);
				
				$select_mem = "select * from members where id = '".$db_comment[$j]['UserId']."'";
				$db_mem = $obj->select($select_mem);
			?>
            
                <div class="cmmnts">
                <a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>" class="pimg">
				<?php if($db_select_photo[0]['photo']!='') { ?>
                <img src="upload/<?php echo $db_select_photo[0]['photo']; ?>" width="32" height="32" alt="" />
                <?php } else { ?>
                <img src="images/male-user1.png" width="32" height="32" alt="" />
                <?php } ?>
                </a>
                <div class="ptext"><a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>" class="ptitle"><?php echo ucfirst($db_mem[0]['name']); ?></a><?php echo $db_comment[$j]['Comment']; ?><br />
                <?php if($db_comment[$j]['Image']!=''){ ?><div class="comment_img"><a href="timeline_photo.php?id=<?php echo $db_comment[$j]['Id']; ?>" class="ajax "><img src="upload/<?php echo $db_comment[$j]['Image']; ?>" /></a></div><?php } ?>
                <?php 
				$currentdatetime = date('Y-m-d');
				$postdatetime = date('Y-m-d',strtotime($db_comment[$j]['Cdate']));
				if($postdatetime == $currentdatetime)
				{ 
					$currenttime = (date('H')*60)+date('i');
					$posttime = (date('H',strtotime($db_comment[$j]['Cdate']))*60)+date('i',strtotime($db_comment[$j]['Cdate']));
					$difftime = ($currenttime - $posttime);
					if($difftime < 59)
					{
						$finaltime = $difftime." mins ";
					}
					else
					{
						$hours = explode(".",($difftime / 60));
						$minute = ($difftime - ($hours[0]*60));
						
						$finaltime = $hours[0]." hrs ".$minute." mins ";
					}
			?>
            	<?php $finaltime=$finaltime.' ago'; ?>
            <?php } else { 
					$dStart = new DateTime($postdatetime);
				   	$dEnd  = new DateTime($currentdatetime);
		   			$dDiff = $dStart->diff($dEnd);		  
			?>
            	<?php $finaltime=$dDiff->days.' days ago'; ?> 
				<?php } ?>
                
                <div class="comment_wholikes">
	                <span class="time"><?php echo $finaltime; ?></span>
	                <?php
					$select_like_comment="select * from tbl_user_comment_like where Postid='".$db_comment[$j]['PostId']."' AND Commentid='".$db_comment[$j]['Id']."' AND Userid='".$_SESSION['logged_user'][0]['id']."'";
					$db_select_like_comment=$obj->select($select_like_comment);
					?>
                    <a href="javascript:;" class="like_btn" id="<?php echo $db_comment[$j]['Id'].'_'.$_SESSION['logged_user'][0]['id'].'_'.$db_comment[$j]['PostId']; ?>" ><?php if(count($db_select_like_comment)>0){ echo 'Unlike'; }else{ echo 'Like'; } ?></a> 
                    <?php
					$select_count_like_comment="select * from tbl_user_comment_like where Postid='".$db_comment[$j]['PostId']."' AND Commentid='".$db_comment[$j]['Id']."'";
					$db_select_count_like_comment=$obj->select($select_count_like_comment);
					?>
                    <a href="javascript:;" class="like"><?php echo count($db_select_count_like_comment); ?></a> 
				</div>
                
                </div></div>
            <?php } } ?>    
                
                <div class="cmmnts">
                    <a href="#" class="pimg"><img src="images/male-user1.png" width="32" height="32"></a>
                    <div class="ptext">
                    	<div class="inputtxt col-md-12 col-xs-12 col-sm-12">
                        	<form action="timeline.php?postid=<?php echo $db_select_post[$i]['Id']; ?>&profileid=<?php echo $_GET['id']; ?>" method="post" name="frmcomm">
           		             	<input type="text" name="Comment" value="">
                                <input type="hidden" id="img_name<?php echo $db_select_post[$i]['Id']; ?>" name="img_name" />
							</form>      
                            <form name="file_upload<?php echo $db_select_post[$i]['Id']; ?>" action="upload_file_comment.php" method="post" target="frame<?php echo $db_select_post[$i]['Id']; ?>" enctype="multipart/form-data">
                                <input type="file" id="file<?php echo $db_select_post[$i]['Id']; ?>" name="file" onchange="this.form.submit(); display_block(<?php echo $db_select_post[$i]['Id']; ?>);" />
                            </form>
                            <div id="prepage<?php echo $db_select_post[$i]['Id']; ?>" class="prepage"></div>
						</div>
                    </div>
                    <iframe src="upload_file_comment.php" style="display:none;" id="frame<?php echo $db_select_post[$i]['Id']; ?>" name="frame<?php echo $db_select_post[$i]['Id']; ?>" target="_blank" onload="clearPreloadPage(<?php echo $db_select_post[$i]['Id']; ?>)"></iframe>   
				</div>
            </div>
            </div>
            
        <?php } ?>
