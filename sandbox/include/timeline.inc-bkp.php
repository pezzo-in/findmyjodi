<?php
if(($_POST['Comment'] != '' OR $_POST['img_name'] != '') AND $_GET['postid'] != '' AND $_GET['profileid'] != '')
{
	//echo"1"; exit;
	$cdate = date('Y-m-d H:i:s');
	$profileid = $_GET['profileid'];
	$select_member = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
	$db_select_member = $obj->select($select_member);
	
	$insert = "insert into tbl_user_post_comment(Id, UserId, PostId, Comment, Cdate, Image) values(null, '".$db_select_member[0]['id']."', '".$_GET['postid']."', '".$_POST['Comment']."', '".$cdate."', '".$_POST['img_name']."')";
	$obj->insert($insert);
	echo "<script> window.location.href = 'timeline.php?id=$profileid' </script>";	
}
if(($_POST['Comment'] != '' OR $_POST['img_name'] != '') AND $_GET['postid'] != '' AND $_GET['profileid'] == '')
{
	//echo"2"; exit;	
	$cdate = date('Y-m-d H:i:s');
	$select_member = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
	$db_select_member = $obj->select($select_member);
	
	$insert = "insert into tbl_user_post_comment(Id, UserId, PostId, Comment, Cdate, Image) values(null, '".$db_select_member[0]['id']."', '".$_GET['postid']."', '".$_POST['Comment']."', '".$cdate."', '".$_POST['img_name']."')";
	$obj->insert($insert);
	echo "<script> window.location.href = 'timeline.php' </script>";	
}
if($_GET['action'] == 'delete' AND $_GET['delid'] != '')
{
	$delid = $_GET['delid'];
	$delete = "delete from tbl_user_post where Id = '".$delid."'";
	$obj->sql_query($delete);
	echo "<script> window.location.href = 'timeline.php' </script>";
}
if($_GET['action'] == 'like' AND $_GET['likeid'] != '' AND $_GET['userid'] != '')
{
	$likeid = $_GET['likeid'];
	$userid = $_GET['userid'];
	$cdate = date('Y-m-d H:i:s');
	$ctime = date('H:i');
	
	$select_post_user = "select * from tbl_user_post where Id = '".$likeid."'";
	$db_post_user = $obj->select($select_post_user);
	
//	$select_member_id = "select * from members where id = '".$db_post_user[0]['UserId']."'";
//	$db_select_member_id = $obj->select($select_member_id);
	$postuser = $db_post_user[0]['UserId'];
	
	$insert_like = "insert into tbl_user_post_like(Id, PostId, UserId, Cdate, Ctime) values(null, '".$likeid."', '".$userid."', '".$cdate."', '".$ctime."')";
	$obj->insert($insert_like);
	echo "<script> window.location.href = 'timeline.php?id=$postuser' </script>";
}
if($_GET['action'] == 'unlike' AND $_GET['likeid'] != '' AND $_GET['userid'] != '')
{
	$likeid = $_GET['likeid'];
	$userid = $_GET['userid'];
	$cdate = date('Y-m-d H:i:s');
	$ctime = date('H:i');
	
	$select_post_user = "select * from tbl_user_post where Id = '".$likeid."'";
	$db_post_user = $obj->select($select_post_user);
	$postuser = $db_post_user[0]['UserId'];
	
	$delete_like = "delete from tbl_user_post_like where PostId = '".$likeid."' AND UserId = '".$userid."'";
	$obj->sql_query($delete_like);
	echo "<script> window.location.href = 'timeline.php?id=$postuser' </script>";
}
if($_GET['action'] == 'like' AND $_GET['likeid'] != '' AND $_GET['userid'] == '')
{
	$likeid = $_GET['likeid'];
	$cdate = date('Y-m-d H:i:s');
	$ctime = date('H:i');
	
	$select_member_id = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
	$db_select_member_id = $obj->select($select_member_id);
	
	$insert_like = "insert into tbl_user_post_like(Id, PostId, UserId, Cdate, Ctime) values(null, '".$likeid."', '".$db_select_member_id[0]['id']."', '".$cdate."', '".$ctime."')";
	$obj->insert($insert_like);
	echo "<script> window.location.href = 'timeline.php' </script>";
}
if($_GET['action'] == 'unlike' AND $_GET['likeid'] != '' AND $_GET['userid'] == '')
{
	$likeid = $_GET['likeid'];
	$cdate = date('Y-m-d H:i:s');
	$ctime = date('H:i');
	
	$select_member_id = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
	$db_select_member_id = $obj->select($select_member_id);
	
	$delete_like = "delete from tbl_user_post_like where PostId = '".$likeid."' AND UserId = '".$db_select_member_id[0]['id']."'";
	$obj->sql_query($delete_like);
	echo "<script> window.location.href = 'timeline.php' </script>";
}
if(isset($_POST['postsubmit']))
{
	$cdate = date('Y-m-d H:i:s');
	$ctime = date('H:i');
	$select_member = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
	$db_select_member = $obj->select($select_member);
	$insert_post = "insert into tbl_user_post(Id, UserId, PostText, Cdate, Ctime, Image) values(null, '".$db_select_member[0]['id']."', '".$_POST['PostText']."', '".$cdate."', '".$ctime."', '".$_POST['img_name']."')";
	$db_insert_post = $obj->insert($insert_post);
		
}
?>
<?php if($_GET['id'] == '') { ?>
<div class="content col-md-9 col-sm-12 col-xs-12">
	<div class="about_right">
        
            <div class="top_textarea">
                <form action="" method="post" name="frmpost">
                <textarea name="PostText" cols="" rows=""></textarea>
                <div class="right_btn">
                    <input type="hidden" id="img_name" name="img_name" />
                    <input name="postsubmit" type="submit" value="Post" />
                </div>
				</form>
				<form name="file_upload" action="upload_file_post.php" method="post" target="frame" enctype="multipart/form-data">
                <div class="photo_attach">
                        <label for="file">
                    	<img src="images/photo_btn1.png"/>
                    </label>
                    <input type="file" id="file" name="file" onchange="this.form.submit(); display_block1();" />                    
                </div>
                </form>
                <div id="prepage" class="prepage" style="border:1px solid #CCC;width:520px;left:0px;border-top:none;top:64px;"></div>
            </div>
            
            <iframe src="upload_file_post.php" style="display:none" id="frame" name="frame" target="_blank" onload="clearPreloadPage1()"></iframe>   
            <script>
			check1=0;
			function display_block1()
			 {	
				 var temp=document.getElementById('file').value;
				 var n=temp.split("\\");
				 img_name=n[n.length-1];
				 document.getElementById('prepage').innerHTML='<img src="uploading.gif" class="loading_image" />';
				 //document.getElementById('prepage'+id).style.visibility='visible';
				 document.getElementById('prepage').style.display='block';
				 document.getElementById('file').disabled=true;
				 check1=1;
			 }
			 function clearPreloadPage1() { //DOM
				if (document.getElementById){	
					//document.getElementById('prepage'+id).style.visibility='hidden';
				}else{
					if (document.layers){ //NS4
						//document.prepage.visibility = 'hidden';
						document.prepage.display= 'none';
					}
					else { //IE4
						//document.all.prepage.style.visibility = 'hidden';
						document.all.prepage.style.display = 'none';
					}
				}	
				document.getElementById('file').disabled=false;
			
				if(check1==1)
				{
					document.getElementById('prepage').innerHTML="<img src='upload/"+img_name+"' id='cropbox"+id+"' /><a href='javascript:;' class='close_comment_photo' onclick='delete_photo_comment1()' ></a>";
					//document.getElementById('preview_container').innerHTML="<img src='upload/"+img_name+"' class='jcrop-preview' id='Preview' />";
					
					//test();
			
					document.getElementById('img_name').value=img_name;
			
					//$('#crop_submit').css('display','block');
			
				}
			
			}
			</script>
        <?php
		$select_member_id = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
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
         <div id="post_wrapper<?php echo $db_select_post[$i]['Id']; ?>">
        <div class="mid_prof" id="mid_prof_<?php echo $db_select_post[$i]['Id']; ?>"> 
        	<?php if($db_select_photo[0]['photo']!='') { ?>
            <img src="upload/<?php echo $db_select_photo[0]['photo']; ?>" width="47" height="46" alt="" />
            <?php 
			} else { 
				if($db_select_member_id[0]['gender']=='M')
				{
			?>
            		<img src="images/male-user1.png" alt="" style="width:47px;height:46px;" />
            <?php }else{ ?>
            		<img src="images/female-user1.png" alt="" style="width:47px;height:46px;" />
            <?php 
				}
			} ?>
            <div class="prof_name"><a href="#"><?php echo ucfirst($db_mem[0]['name']); ?></a><br /><span style="font-size:12px;"><?php echo date('d F, Y',strtotime($db_select_post[$i]['Cdate'])); ?></span>
            <!--<div class="update_right">Updated his <a href="#">About me</a>Text</div>-->
            </div>
            <p><?php echo $db_select_post[$i]['PostText']; ?></p>
            
            <?php if($db_select_post[$i]['Image']!=''){ ?><div class="comment_img"><a href="timeline_photo_post.php?id=<?php echo $db_select_post[$i]['Id']; ?>" class="ajax "><img src="upload/<?php echo $db_select_post[$i]['Image']; ?>" /></a></div><?php } ?>
            
            <?php
			$select_liked = "select * from tbl_user_post_like where PostId = '".$db_select_post[$i]['Id']."' AND UserId = '".$db_select_member_id[0]['id']."'";
			$db_liked = $obj->select($select_liked);
			?>
                        
            <div class="like_row">
            
            
           <?php /*<?php if(count($db_liked) > 0) { ?>
            <a class="btn icon-unlike" href="timeline.php?action=unlike&likeid=<?php echo $db_select_post[$i]['Id']; ?>"><span>UnLike</span></a>
            <?php } else { ?>
            <a class="btn icon-like" href="timeline.php?action=like&likeid=<?php echo $db_select_post[$i]['Id']; ?>"><span>Like</span></a>
            <?php } ?> */?>
            
            
           
            <a href="javascript:;" class="btn icon-like" id="<?php echo $db_select_post[$i]['Id']; ?>"><span class="<?php if(count($db_liked)>0){ echo 'span-unlike'; }else{ echo 'span-like'; } ?>"><?php if(count($db_liked)>0){ echo 'Unlike'; }else{ echo 'Like'; } ?></span></a> 
           
            
            
           
            
            
            
            <a class="btn icon-comment" href="#" style="display:none;"><span>Comment</span></a>
            <!--<a class="btn icon-share" href="#"><span>Share</span></a>-->
           <!-- <a class="btn icon-delete" href="timeline.php?action=delete&delid=<?php echo $db_select_post[$i]['Id']; ?>"><span>Delete</span></a>-->
           <a class="btn icon-delete" href="javascript:void(0);" onclick="comment_delete('post_wrapper<?php echo $db_select_post[$i]['Id']; ?>')"><span>Delete</span></a>
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
            
            <div class="commnt_part">
            
            <div class="wholikes_new" id="wholikes_new_<?php echo $db_select_post[$i]['Id']; ?>">
            
				<?php
            
			    $select_liked_total = "select * from tbl_user_post_like where PostId = '".$db_select_post[$i]['Id']."'";
                $db_liked_total = $obj->select($select_liked_total);
                ?>
            	<?php if(count($db_liked_total) > 0) { ?>
                <?php //echo count($db_liked_total); ?>
                <div class="wholikes"><a href="#" class="like"></a><?php echo count($db_liked_total); ?> like this. </div>
                <?php }else{ ?>
                 <div class="wholikes"><a href="#" class="like"></a>0 like this. </div>
                <?php } ?>
               </div> 
               
                <!--<div class="viewmore"><a href="#" class="viewmorecmmnts">View 4 more comments</a></div>-->
            
			
			<div id="comment-set-<?php echo $db_select_post[$i]['Id']; ?>">
			
			<?php
			$select_comment = "select * from tbl_user_post_comment where PostId = '".$db_select_post[$i]['Id']."' ORDER BY Id DESC";
			
			$db_comment = $obj->select($select_comment); ?>
           
            <div class="comment-div-repeat" id="comment_dev_<?php echo $db_select_post[$i]['Id']; ?>" style="overflow: hidden; float: left; <?php if(count($db_comment) == 0){ ?>height:0px;<?php }elseif(count($db_comment) == 1){?>height:75px;<?php }elseif(count($db_comment) == 2){ ?>height:125px;<?php }else{ ?>height:125px; <?php } ?> ">
			
            <div class="wholikes">Total Comment Count: <?php echo count($db_comment);  ?> <?php if(count($db_comment)> 2) { ?><a class="view_all" id="view_all_<?php echo $db_select_post[$i]['Id'];?>_<?php echo count($db_comment);  ?>" onclick="viewall(this.id)"><?php echo "View All"; ?></a><?php } ?></div>
            
			<?php //echo count($db_comment);
			if(count($db_comment)>0)
			{
				for($j=0;$j<count($db_comment);$j++)
				{
				$select_photo = "select * from member_photos where member_id = '".$db_comment[$j]['UserId']."' AND Approve = 1 ORDER BY id DESC";
				$db_select_photo = $obj->select($select_photo);
				
				$select_mem = "select * from members where id = '".$db_comment[$j]['UserId']."'";
				$db_mem = $obj->select($select_mem);
				//echo"<pre>";print_r($db_mem); 
			?>
            
                <div class="cmmnts">
                <a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>" class="pimg">
				<?php if($db_select_photo[0]['photo']!='') { ?>
                <img src="upload/<?php echo $db_select_photo[0]['photo']; ?>" width="32" height="32" alt="" />
                <?php } else { ?>
                
					<?php if($db_mem[0]['gender'] == 'M') { ?>
                    <img src="images/male-user1.png" width="32" height="32" alt="" />
                    <?php } else { ?>
                     <img src="images/female-user1.png" width="32" height="32" alt="" />
                    <?php } ?>
                
				<?php } ?>
                </a>
                <div class="ptext"><a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>" class="ptitle"><?php echo ucfirst($db_mem[0]['name']); ?></a><?php echo $db_comment[$j]['Comment']; ?><br />
                <?php if($db_comment[$j]['Image']!='' && $db_comment[$j]['Image']!='undefined'){ ?><div class="comment_img"><a href="timeline_photo.php?id=<?php echo $db_comment[$j]['Id']; ?>" class="ajax "><img src="<?php echo $db_comment[$j]['Image']; ?>" /></a></div><?php } ?>
                
                
				<?php 
				$currentdatetime = date('Y-m-d');
				$postdatetime = date('Y-m-d',strtotime($db_comment[$j]['Cdate']));
				if($postdatetime == $currentdatetime)
				{ 
					$currenttime = (date('H')*60)+date('i');
					//echo date('H');
					//echo date('i');
					//$currenttime = ((date('H')+6)*60)+(date('i')-30);
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
            	</div>
                <div class="cmmnts add-comments-div">
                    <a href="#" class="pimg"><img src="images/male-user1.png" width="32" height="32"></a>
                    <div class="ptext">
                    	<div class="inputtxt" style="width:495px;">
                        
                        	 <input type="text" name="Comment" id="post_comment_<?php echo $db_select_post[$i]['Id']; ?>_<?php echo $_GET['id']; ?>" value="">
                            <a class="rightsend_btn" id="post_comment_<?php echo $db_select_post[$i]['Id']; ?>_<?php echo $_GET['id']; ?>" onclick="add_comment(this.id);">click</a>
                        
                            <?php /*<form action="timeline.php?postid=<?php echo $db_select_post[$i]['Id']; ?>" method="post" name="frmcomm">
                                <input type="text" name="Comment" value="">
                                <input type="hidden" id="img_name<?php echo $db_select_post[$i]['Id']; ?>" name="img_name" />
                             </form>*/ ?>
<form name="file_upload<?php echo $db_select_post[$i]['Id']; ?>" action="upload_file_comment.php" method="post" target="frame<?php echo $db_select_post[$i]['Id']; ?>" enctype="multipart/form-data">
                <div class="photo_attach1">
                        <label for="file">
                    	<img src="images/icon-upload-pic1.png">
                    </label>
                    <input type="file" id="file<?php echo $db_select_post[$i]['Id']; ?>" name="file" onchange="this.form.submit(); display_block(<?php echo $db_select_post[$i]['Id']; ?>);" />              
                </div>
                </form>
                            <div id="prepage<?php echo $db_select_post[$i]['Id']; ?>" class="prepage" style="margin-top:10px;"></div>
						</div>
                        
                    </div>
                    <iframe src="upload_file_comment.php" style="display:none" id="frame<?php echo $db_select_post[$i]['Id']; ?>" name="frame<?php echo $db_select_post[$i]['Id']; ?>" target="_blank" onload="clearPreloadPage(<?php echo $db_select_post[$i]['Id']; ?>)"></iframe>   
				</div>
            </div>
            </div>
            
        </div>
        </div>
        <?php } ?>
        
        <script>
		check=0;
		function display_block(id)
		 {	
			 var temp=document.getElementById('file'+id).value;
			 var n=temp.split("\\");
			 img_name=n[n.length-1];
			 document.getElementById('prepage'+id).innerHTML='<img src="uploading.gif" class="loading_image" />';
			 //document.getElementById('prepage'+id).style.visibility='visible';
			 document.getElementById('prepage'+id).style.display='block';
			 document.getElementById('file'+id).disabled=true;
			 check=1;
		 }
		 function clearPreloadPage(id) { //DOM
		
			if (document.getElementById){	
				//document.getElementById('prepage'+id).style.visibility='hidden';
			}else{
				if (document.layers){ //NS4
					//document.prepage.visibility = 'hidden';
					document.prepage.display= 'none';
				}
				else { //IE4
					//document.all.prepage.style.visibility = 'hidden';
					document.all.prepage.style.display = 'none';
				}
			}	
			document.getElementById('file'+id).disabled=false;
		
			if(check==1)
			{
				document.getElementById('prepage'+id).innerHTML="<img src='upload/"+img_name+"' id='cropbox"+id+"' /><a href='javascript:;' class='close_comment_photo' onclick='delete_photo_comment("+id+")' ></a>";
				//document.getElementById('preview_container').innerHTML="<img src='upload/"+img_name+"' class='jcrop-preview' id='Preview' />";
				
				//test();
		
				document.getElementById('img_name'+id).value=img_name;
		
				//$('#crop_submit').css('display','block');
		
			}
		
		}
		</script>
        
        <!--<div class="mid_prof last">
            <img src="images/about_pix.png" alt="" />
            <div class="prof_name"><a href="#">Sunil Reddy</a><br /><span>13 November, 2013</span>
            <div class="update_right">Updated his <a href="#">Photo</a></div>
            </div>
            <div class="couple_img"><img src="images/couple.jpg" alt="" /></div>
            <div class="like_row"><a href="#">Like - </a><a href="#">Comment - </a><a href="#">Share </a><span> 15 min ago</span></div>
        </div>-->
    </div>
</div>
<?php } else { ?>
<div class="content col-md-9 col-sm-12 col-xs-12">
	<div class="about_right">
        
        <?php
		$select_member_id = "select * from members where id = '".$_GET['id']."'";
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
        <div id="post_wrapper<?php echo $db_select_post[$i]['Id']; ?>">
        <div class="mid_prof">
        	
            
			
			<?php if($db_select_photo[0]['photo']!='') { ?>
            <a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>"><img src="upload/<?php echo $db_select_photo[0]['photo']; ?>" width="47" height="46" alt="" /></a>
            <?php } else { ?>
				<?php if($db_select_member_id[0]['gender'] == 'M' ){ ?>
                <a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>"><img src="images/male-user1.png" alt="" style="width:47px;height:46px;" /></a>
                <?php }else{ ?>
                 <a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>"><img src="images/female-user1.png" alt="" style="width:47px;height:46px;" /></a>
                <?php } ?>
            <?php } ?>
            
            
            <div class="prof_name"><a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>"><?php echo $db_mem[0]['name']; ?></a><br /><span style="font-size:15px;"><?php echo date('d F, Y',strtotime($db_select_post[$i]['Cdate'])); ?></span>
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
           
           <?php /* <?php if(count($db_liked) > 0) { ?>
            <a class="btn icon-unlike" href="timeline.php?action=unlike&likeid=<?php echo $db_select_post[$i]['Id']; ?>&userid=<?php echo $db_select_member_id_like[0]['id']; ?>"><span>Like</span></a>
            <?php } else { ?>
            <a class="btn icon-like" href="timeline.php?action=like&likeid=<?php echo $db_select_post[$i]['Id']; ?>&userid=<?php echo $db_select_member_id_like[0]['id']; ?>"><span>Like</span></a>
            <?php } ?> */?>
            
             <a href="javascript:;" class="btn icon-like" id="<?php echo $db_select_post[$i]['Id']; ?>"><span class="<?php if(count($db_liked)>0){ echo 'span-unlike'; }else{ echo 'span-like'; } ?>"><?php if(count($db_liked)>0){ echo 'Unlike'; }else{ echo 'Like'; } ?></span></a> 
            
            
            
            
            
            <a class="btn icon-comment" href="#" style="display:none;"><span>Comment</span></a>
            <!--<a class="btn icon-share" href="#"><span>Share</span></a>-->
            
            <?php 
				$currentdatetime = date('Y-m-d');
				$postdatetime = date('Y-m-d',strtotime($db_select_post[$i]['Cdate']));
				if($postdatetime == $currentdatetime)
				{ 
					$currenttime = (date('H')*60)+date('i');
					//$currenttime = ((date('H')+6)*60)+(date('i')-30);
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
            	
                
                
                 <div class="wholikes_new" id="wholikes_new_<?php echo $db_select_post[$i]['Id']; ?>">
            
				<?php
            
			    $select_liked_total = "select * from tbl_user_post_like where PostId = '".$db_select_post[$i]['Id']."'";
                $db_liked_total = $obj->select($select_liked_total);
                ?>
            	<?php if(count($db_liked_total) > 0) { ?>
                <?php //echo count($db_liked_total); ?>
                <div class="wholikes"><a href="#" class="like"></a><?php echo count($db_liked_total); ?> like this. </div>
                <?php }else{ ?>
                
                	 <div class="wholikes"><a href="#" class="like"></a>0 like this. </div>
                <?php }?>
               </div> 
				
				<?php /*<?php if(count($db_liked_total) > 0) { ?>
                <div class="wholikes"><a href="#" class="like"></a><?php echo count($db_liked_total); ?> like this. </div>
                <?php } */?>
                <!--<div class="viewmore"><a href="#" class="viewmorecmmnts">View 4 more comments</a></div>-->
            
			
			<div id="comment-set-<?php echo $db_select_post[$i]['Id']; ?>">
			<?php
			$select_comment = "select * from tbl_user_post_comment where PostId = '".$db_select_post[$i]['Id']."' ORDER BY Id DESC";
			$db_comment = $obj->select($select_comment);
			?>
			 <div class="comment-div-repeat" id="comment_dev_<?php echo $db_select_post[$i]['Id']; ?>" style="overflow: hidden; float: left; <?php if(count($db_comment) == 0){ ?>height:0px;<?php }elseif(count($db_comment) == 1){?>height:75px;<?php }elseif(count($db_comment) == 2){ ?>height:125px;<?php }else{ ?>height:125px; <?php } ?> ">
			
            <div class="wholikes">Total Comment Count: <?php echo count($db_comment);  ?> <?php if(count($db_comment)> 2) { ?><a class="view_all" id="view_all_<?php echo $db_select_post[$i]['Id'];?>_<?php echo count($db_comment);  ?>" onclick="viewall(this.id)"><?php echo "View All"; ?></a><?php } ?></div>
		
        	<?php //echo"<pre>";print_r($db_comment); exit;
			if(count($db_comment)>0)
			{
				for($j=0;$j<count($db_comment);$j++)
				{
				$select_photo = "select * from member_photos where member_id = '".$db_comment[$j]['UserId']."' AND Approve = 1 ORDER BY id DESC";
				$db_select_photo = $obj->select($select_photo);
				
				
				$select_mem = "select * from members where id = '".$db_comment[$j]['UserId']."'";
				$db_mem = $obj->select($select_mem);
				//echo"<pre>";print_r($db_mem); exit;
			?>
            	
                <div class="cmmnts">
                <a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>" class="pimg">
				
				<?php if($db_select_photo[0]['photo']!='') { ?>
                <img src="upload/<?php echo $db_select_photo[0]['photo']; ?>" width="32" height="32" alt="" />
                <?php } else { ?>
  		              <?php if($db_mem[0]['gender'] == 'M') { ?>
                      <img src="images/male-user1.png" width="32" height="32" alt="" />
                      <?php } else { ?>
                      <img src="images/female-user1.png" width="32" height="32" alt="" />
                        <?php } ?>
                <?php } ?>
                </a>
                <div class="ptext"><a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>" class="ptitle"><?php echo ucfirst($db_mem[0]['name']); ?></a><?php echo $db_comment[$j]['Comment']; ?><br />
                <?php if($db_comment[$j]['Image']!='' && $db_comment[$j]['Image']!='undefined'){ ?><div class="comment_img"><a href="timeline_photo.php?id=<?php echo $db_comment[$j]['Id']; ?>" class="ajax "><img src="<?php echo $db_comment[$j]['Image']; ?>" height="100" width="100" /></a></div><?php } ?>
                <?php 
				$currentdatetime = date('Y-m-d');
				$postdatetime = date('Y-m-d',strtotime($db_comment[$j]['Cdate']));
				//echo $currentdatetime."</br>";
				//echo $postdatetime; 
				if($postdatetime == $currentdatetime)
				{ 
					//$currenttime = ((date('H')+6)*60)+(date('i')-30);
					$currenttime = (date('H')*60)+date('i');
					//echo $currenttime."</br>"; 
					$posttime = (date('H',strtotime($db_comment[$j]['Cdate']))*60)+date('i',strtotime($db_comment[$j]['Cdate']));
					//echo $posttime."</br>";
					$difftime = ($currenttime - $posttime);
					if($difftime < 59)
					{
						$finaltime = $difftime." mins ";
						//echo $finaltime;
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
                    	<div class="inputtxt" style="width:495px;">
                        	<?php /*<form action="timeline.php?postid=<?php echo $db_select_post[$i]['Id']; ?>&profileid=<?php echo $_GET['id']; ?>" method="post" name="frmcomm">
           		             	<input type="text" name="Comment" value="">
                                <input type="hidden" id="img_name<?php echo $db_select_post[$i]['Id']; ?>" name="img_name" />
							</form>     */  ?>
                            
                            <input type="text" name="Comment" id="post_comment_<?php echo $db_select_post[$i]['Id']; ?>_<?php echo $_GET['id']; ?>" value="">
                            <a class="rightsend_btn" id="post_comment_<?php echo $db_select_post[$i]['Id']; ?>_<?php echo $_GET['id']; ?>" onclick="add_comment(this.id);">click</a>
                           
                           
                            
                            <form name="file_upload<?php echo $db_select_post[$i]['Id']; ?>" action="upload_file_comment.php" method="post" target="frame<?php echo $db_select_post[$i]['Id']; ?>" enctype="multipart/form-data">
                                <input type="file" id="file<?php echo $db_select_post[$i]['Id']; ?>" name="file" onchange="this.form.submit(); display_block(<?php echo $db_select_post[$i]['Id']; ?>);" />
                            </form>
                            <div id="prepage<?php echo $db_select_post[$i]['Id']; ?>" class="prepage" style="margin-top:10px;"></div>
						</div>
                    </div>
                    <iframe src="upload_file_comment.php" style="display:none;" id="frame<?php echo $db_select_post[$i]['Id']; ?>" name="frame<?php echo $db_select_post[$i]['Id']; ?>" target="_blank" onload="clearPreloadPage(<?php echo $db_select_post[$i]['Id']; ?>)"></iframe>   
				</div>
            </div>
            </div>
            </div>
           </div>
        <?php } ?>
        
        <script>
		check=0;
		function display_block(id)
		 {	 
			 var temp=document.getElementById('file'+id).value;
			 var n=temp.split("\\");
			 img_name=n[n.length-1];
			 document.getElementById('prepage'+id).innerHTML='<img src="uploading.gif" class="loading_image" />';
			 //document.getElementById('prepage'+id).style.visibility='visible';
			 document.getElementById('prepage'+id).style.display='block';
			 document.getElementById('file'+id).disabled=true;
			 check=1;
		 }
		 function clearPreloadPage(id) { //DOM
			if (document.getElementById){	
				//document.getElementById('prepage'+id).style.visibility='hidden';
			}else{
				if (document.layers){ //NS4
					//document.prepage.visibility = 'hidden';
					document.prepage.display = 'none';
				}
				else { //IE4
					//document.all.prepage.style.visibility = 'hidden';
					document.all.prepage.style.display = 'none';
				}
			}	
			document.getElementById('file'+id).disabled=false;
		
			if(check==1)
			{
				document.getElementById('prepage'+id).innerHTML="<img src='upload/"+img_name+"' id='cropbox"+id+"' /><a href='javascript:;' class='close_comment_photo' id='"+id+"' onclick='delete_photo_comment("+id+")' ></a>";
				//document.getElementById('preview_container').innerHTML="<img src='upload/"+img_name+"' class='jcrop-preview' id='Preview' />";
				
				//test();
		
				document.getElementById('img_name'+id).value=img_name;
		
				//$('#crop_submit').css('display','block');
		
			}
		
		}
		</script>
        
        <!--<div class="mid_prof last">
            <img src="images/about_pix.png" alt="" />
            <div class="prof_name"><a href="#">Sunil Reddy</a><br /><span>13 November, 2013</span>
            <div class="update_right">Updated his <a href="#">Photo</a></div>
            </div>
            <div class="couple_img"><img src="images/couple.jpg" alt="" /></div>
            <div class="like_row"><a href="#">Like - </a><a href="#">Comment - </a><a href="#">Share </a><span> 15 min ago</span></div>
        </div>-->
    </div>
</div>
<?php } ?>         
       
       <script>
	   
	   function delete_photo_comment(id)
	   {
			$('#prepage'+id).css('display','none');
			document.getElementById('img_name'+id).value='';
	   }
	   
	   function delete_photo_comment1()
	   {
			$('#prepage').css('display','none');
			document.getElementById('img_name').value='';
	   }
	   
	  
	   </script>
       
  <script>
  			$(document).ready(function(){
				 //var actid = $(this).data().id;
				 var numItems = $('.cmmnts').length;
				 //alert(numItems);
				//$('.comment-div-repeat').height();
					
			})
  
		$(document).ready(function(){
		  $(".view_all").click(function(){
			  	var id = $(this).attr('id');
				//alert(id);
				var n=id.split("_");
				//alert(n);
				//alert(n[2]);
				var temp_id = n[2];
				var count = n[3];
				//alert(count);
				//alert('#comment_dev_'+temp_id);
				/*if(count == 0){
					var h = 0;
				}else{
					var h = $('#comment_dev_'+temp_id).height();
				}
				alert(h);
				$('#comment_dev_'+temp_id).animate({'height':h+'px'}, 1000);*/
				//alert(h);
			  	var height = $('#comment_dev_'+temp_id).height();
				//alert(height);
				if(height == '125'){
					//h = count+50;
					$('#comment_dev_'+temp_id).css({'height':'auto'}, 1000);
					$('.mid_prof').css({'float':'none'}, 1000);
					
					 
				}else{
					 $("#comment_dev_"+temp_id).animate( { height:'125px' }, { queue:false, duration:500 });
				}
		  });
		});
	   </script>      
       
      
