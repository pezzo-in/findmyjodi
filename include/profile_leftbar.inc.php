<div class="sidebar col-md-3">
           <div class="sidebar-main sidebar-main-tab">
                <div id="tab-container">
                        <ul class="msgtab">
                            <li style="width:110px;margin-left:0px;"><a href="#msgtab-1" style="font-size:14px;">My Profile</a></li>
                            <li style="width:109px;font-size:14px;"><a href="#msgtab-2" style="padding: 5px 2px; font-size:14px;">Conversations</a></li>
                        </ul>
                        <div class="msgtab_content" id="msgtab-1">
							<div class="list-msgs">
                                <ul class="list1">
                                    <li><a href="edit_profile.php"><span class="iconprf msgedit1"></span>Edit Profile</a></li>
                                    <li><a href="edit_photo_upload.php"><span class="iconprf reqphoto1"></span>Upload Photo</a></li>
                                    <!--<li><a href="edit_mobile_no.php"><span class="icon phoneicon"></span>Edit Mobile Number</a></li>-->
                                    <li><a href="change_password.php"><span class="iconprf chngpwd1"></span>Change Password</a></li>
                                    <!--<li><a href="edit_horoscope.php"><span class="icon horoscopeicon"></span>Add Horoscope</a></li>-->
                                    <li><a href="edit_partner_pref.php"><span class="iconprf paidmembenicon5"></span>Partner Preference</a></li>
                                    <!--<li><a href="edit_family_detail.php"><span class="icon memviewedme"></span>Family Details</a></li>-->
                                    <li><a href="edit_hobbies.php"><span class="iconprf hobbiint1"></span>Hobbies & Interests</a></li>
                                    <li><a href="save_search.php"><span class="iconprf saved1"></span>Saved Search</a></li>
                                    <?php
                                    $sql = "select * from members where id = '".$_SESSION['logged_user'][0]['id']."'";
                                    $res = $obj->select($sql);
                                    ?>
                                    <?php if($res[0]['status'] == 'Active') { ?>
                                    <li><a href="javascript:;" class="deactive_profile"><span class="iconprf listignore1"></span>Deactivate Profile</a></li>
                                    <?php }  else { ?>
                                    <li><a href="edit_profile.php?flag=active"><span class="icon listshort"></span>Activate Profile</a></li>
                                    <?php } ?>
                                    <li class="morelink"><a href="javascript:;" class="more-view more-view1"><span class="iconprf delprf1"></span>Delete Profile</a>
                                    <div class="more_div">
                                    <div class="searchby1">
                                        <div class="searchbubblebox1">
                                        	<h4>My marriage is fixed through</h4>
                                            <form method="post">
											<label><input type="radio" name="radio3" id="radio3" value="1"/>This website</label>
                                            <label><input type="radio" name="radio3" value="1" id="radio4"/>Someother sources</label>
                                            <input type="submit" name="Delete" onclick="return delete_check('<?php echo $_SESSION['logged_user'][0]['id']; ?>');" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                	</div>
                                    </li>
                                </ul>   
                            </div>                               
                        </div>
                        
                        
                        <div class="msgtab_content" id="msgtab-2">
                        	
                            <div class="list-msgs">
                                <h3>Personalize Messages</h3>
                                <?php
                                    $sql="select * from messages where to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND is_read=0";
                                    $ans=$obj->select($sql);
									
									$sent_msg="select * from messages where from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND is_read=0";
                                    $db_sent_msg=$obj->select($sent_msg);
								 ?>
                                 
                                <ul class="list1">
                                <?php /*<li><a href="received_msgs.php#msgtab-2"><span class="icon msgnew"></span>Inbox(<?php echo count($ans); ?>)</a></li>
                                 <li><a href="sent_messages.php#msgtab-2"><span class="icon msgnew"></span>Outbox(<?php echo count($db_sent_msg); ?>)</a></li> */ ?>
								 <li><a href="received_msgs.php#msgtab-2"><span class="icon msgnew"></span>Messages</a></li>
                                 <?php
/*
										$sql = "select * from messages where from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
										$data = $obj->select($sql);*/		
									 ?>
<!--                                    <li><a href="sent_messages.php#msgtab-2"><span class="icon msgreadpaid"></span>Messages sent (<?php //echo count($data); ?>)</a></li>-->
                                </ul>                               
                            </div>
                            
                            <div class="list-msgs">
                                <h3>Interest Received</h3>
                                <?php
                                    //$sql="select express_interest.* from express_interest,members where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=0 AND is_more_info=0";
                                    $sql="select express_interest.*, express_interest.id as exp_int_id from express_interest right join members on express_interest.from_mem=members.member_id where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=0 AND is_more_info=0";     
                                    $new_int=$obj->select($sql);
                                ?>
                                <ul class="list1">
                                    <li><a href="new_interest.php#msgtab-2" id="new_interest"><span class="icon expnew"></span>New (<?php echo count($new_int); ?>)</a></li>
                                    <?php
                                    //$sql="select * from express_interest where to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and is_accepted='Y'";
                                    $sql="select express_interest.* from express_interest,members where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted=1";										  
                                    $accpted=$obj->select($sql);
                                     ?>	
                                    <li><a href="accepted_interest.php#msgtab-2" id="accepted"><span class="icon expacpt"></span>Accepted (<?php echo count($accpted); ?>)</a></li>
                                    <?php
                                    /*$sql="select * from need_more_info_detail 
                                          where
                                          to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";*/
										 // echo $_SESSION['logged_user'][0]['member_id'];
$sql="select express_interest.* from express_interest right join members on  express_interest.from_mem=members.member_id where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.is_profile_active='Y' AND express_interest.is_more_info=1 AND  express_interest.is_accepted='N'";
                                          
                                    $need_info=$obj->select($sql);
                                     ?>	
                                    <li><a href="<?php if(count($need_info)>0){ ?>need_more_info.php#msgtab-2 <?php }else{?> javascript:void(0); <?php } ?>"><span class="icon expinfo"></span>Need More Info (<?php echo count($need_info); ?>)</a></li>
                                    <?php
                                    //$sql="select * from need_more_info_time where to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
$sql="select express_interest.* from express_interest right join members on express_interest.from_mem=members.member_id where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.is_profile_active='Y' AND express_interest.is_more_time=1 AND  express_interest.is_accepted='N'";
                                    $need_time=$obj->select($sql);
                                     ?>	
                                    <li><a href="<?php if(count($need_time)>0){ ?>need_more_time.php#msgtab-2<?php }else{?> javascript:void(0); <?php } ?>"><span class="icon expinfo"></span>Need More Time (<?php echo count($need_time); ?>)</a></li>
                                </ul>
                                
                            </div>
   
                            <div class="list-msgs">
                             <?php
									$sql="select * from express_interest 
				  						  where
									      to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and is_accepted='Y'";				  
									$total_acc=$obj->select($sql);
								?>
                                <h3>Interest Sent</h3>
                                <ul class="list1">
                                	<?php
									//$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=0 AND is_more_info=0";
									$sql="select express_interest.*, express_interest.id as exp_int_id from express_interest right join members on express_interest.to_mem=members.member_id where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=0 AND is_more_info=0";
									$r_pend=$obj->select($sql);
									?>
                                    <li><a href="sent_reply_panding.php#msgtab-2"><span class="icon expinfo"></span>Reply Pending (<?php echo count($r_pend); ?>)</a></li>
									<?php
									//$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='Y'";
									$sql = "select express_interest.*, express_interest.id as exp_int_id from express_interest right join members on express_interest.to_mem=members.member_id where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.is_profile_active='Y' AND express_interest.is_accepted='Y'";
									$new_int=$obj->select($sql);
									?>
                                    <li><a href="reply_accept.php#msgtab-2"><span class="icon expacpt"></span>Accepted (<?php echo count($new_int); ?>)</a></li>
                                    <?php
									$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_info=1";
									$more_info=$obj->select($sql);
									?>
                                    <li><a href="reply_more_info.php#msgtab-2"><span class="icon expdec"></span>Need More Info(<?php echo count($more_info); ?>)</a></li>
                                     <?php
									$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=1";
									$more_time=$obj->select($sql);
									?>
                                    <li><a href="reply_more_time.php#msgtab-2"><span class="icon expdec"></span>Need More Time (<?php echo count($more_time); ?>)</a></li>
                                </ul>
							</div>   
                            <div class="list-msgs">
                                <h3>Photo Requests</h3>
                                <ul class="list1">
                                    <?php
									$select_photo_request_received = "select photo_request.*, photo_request.Id as photo_request_id from photo_request right join members on photo_request.From_mem_id=members.id where photo_request.To_mem_id = '".$_SESSION['logged_user'][0]['id']."' AND members.is_profile_active='Y' order by photo_request.Id DESC";
                                    //$select_photo_request_received="select * from photo_request where To_mem_id='".$_SESSION['logged_user'][0]['id']."' AND is_accept=0";
                                    $db_photo_request_received=$obj->select($select_photo_request_received);
                                    ?>
                                    <li><a href="photo_request_received.php#msgtab-2"><span class="icon reqphoto"></span>Received(<?php echo count($db_photo_request_received); ?>)</a></li>
                                    <?php
									$select_photo_request_sent = "select photo_request.*, photo_request.Id as photo_request_id from photo_request right join members on photo_request.To_mem_id=members.id where photo_request.From_mem_id = '".$_SESSION['logged_user'][0]['id']."' AND members.is_profile_active='Y' order by photo_request.Id DESC";
									//$select_photo_request_sent="select * from photo_request where From_mem_id='".$_SESSION['logged_user'][0]['id']."'";
									$db_photo_request_sent=$obj->select($select_photo_request_sent);
									?>
                                    <li><a href="photo_request_send.php#msgtab-2"><span class="icon reqphoto"></span>Sent (<?php echo count($db_photo_request_sent); ?>)</a></li>
                                    <!--<li><a href="#"><span class="icon referenceicon "></span>Reference Received(0)</a></li>
                                    <li><a href="#"><span class="icon referenceicon "></span>Reference Sent(0)</a></li>-->
                                </ul>
                               
                            </div>                               
                        </div>
                    </div>
            </div>
            
            
            
            <?php /*?><div class="sidebar-main sidebar-main-tab">
            	<h2>Messages</h2>
                    <div id="tab-container">
                        <ul class="msgtab">
                            <li><a href="#msgtab-1">Inbox</a></li>
                            <li><a href="#msgtab-2">Sent</a></li>
                        </ul>
                        <div class="msgtab_content" id="msgtab-1">
                        	<div class="list-msgs">
                                <h3>Personalised Messages</h3>
                                <?php
									$sql="select * from messages
				  						  where
									      to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
									$ans=$obj->select($sql);
								?>
                                <ul class="list1">
                                 <li><a href="received_msgs.php"><span class="icon msgnew"></span>Message received(<?php echo count($ans); ?>)</a></li>

                                    <div class="colorbox">
                                        <div id="inline_content">
                                            <div class="colorbox-content">
                                                Lorem ipsum dolor sit amet,
                                            </div>
                                        </div>
                                    </div>
                                     <?php
									$sql="select * from not_interested_members
				  						  where
									      from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
									$ans=$obj->select($sql);
								?>
                                </ul>

							</div>
                            <div class="list-msgs">
                            	<h3>New Interest</h3>
                                <?php
									$sql="select express_interest.* from express_interest,members where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=0 AND is_more_info=0";

									$new_int=$obj->select($sql);
								?>
                                <ul class="list1">
                                    <li><a href="new_interest.php" id="new_interest"><span class="icon expnew"></span>New (<?php echo count($new_int); ?>)</a></li>
                                    <?php
									//$sql="select * from express_interest where to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and is_accepted='Y'";
									$sql="select express_interest.* from express_interest,members where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted=1";
									$accpted=$obj->select($sql);
									 ?>
                                    <li><a href="accepted_interest.php" id="accepted"><span class="icon expacpt"></span>Accepted (<?php echo count($accpted); ?>)</a></li>
                                    <?php
									$sql="select express_interest.* from express_interest,members where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_more_info=1 AND  express_interest.is_accepted='N'";

									$need_info=$obj->select($sql);
									 ?>
                                    <li><a href="need_more_info.php"><span class="icon expinfo"></span>Need More Info (<?php echo count($need_info); ?>)</a></li>
                                    <?php
									//$sql="select * from need_more_info_time where to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
									$sql="select express_interest.* from express_interest,members where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_more_time=1 AND  express_interest.is_accepted='N'";
									$need_time=$obj->select($sql);
									 ?>
                                    <li><a href="need_more_time.php"><span class="icon expinfo"></span>Need More Time (<?php echo count($need_time); ?>)</a></li>
                                </ul>

							</div>
                            <div class="list-msgs">
                                <h3>Requests</h3>
                                <ul class="list1">
                                	<?php
									$select_photo_request_received="select * from photo_request where To_mem_id='".$_SESSION['logged_user'][0]['id']."' AND is_accept=0";
									$db_photo_request_received=$obj->select($select_photo_request_received);
									?>
                                    <li><a href="photo_request_received.php"><span class="icon reqphoto"></span>Photo (<?php echo count($db_photo_request_received); ?>)</a></li>
                                    <li><a href="#"><span class="icon referenceicon "></span>Reference (0)</a></li>
                                </ul>

							</div>

                            <div class="list-msgs">
                                <h3><a href="daily_match_watch.php">Daily Match Watch</a></h3>
							</div>

                        </div>
                        <div class="msgtab_content" id="msgtab-2">
                            <div class="list-msgs">
                                <h3>Personalised Messages</h3>
                                <ul class="list1">

                                    <?php
										$sql = "select * from messages
												where from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
										$data = $obj->select($sql);
									 ?>
                                    <li><a href="sent_messages.php"><span class="icon msgreadpaid"></span>Messages sent (<?php echo count($data); ?>)</a></li>
                                </ul>

							</div>
                            <div class="list-msgs">
                             <?php
									$sql="select * from express_interest
				  						  where
									      to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and is_accepted='Y'";
									$total_acc=$obj->select($sql);
								?>
                                <h3>Express Interest</h3>
                                <ul class="list1">
                                	<?php
									$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=0 AND is_more_info=0";
									$r_pend=$obj->select($sql);
									?>
                                    <li><a href="sent_reply_panding.php"><span class="icon expinfo"></span>Reply Pending (<?php echo count($r_pend); ?>)</a></li>
									<?php
									$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='Y'";
									$new_int=$obj->select($sql);
									?>
                                    <li><a href="reply_accept.php"><span class="icon expacpt"></span>Accepted (<?php echo count($new_int); ?>)</a></li>
                                    <?php
									$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_info=1";
									$more_info=$obj->select($sql);
									?>
                                    <li><a href="reply_more_info.php"><span class="icon expdec"></span>Need More Info(<?php echo count($more_info); ?>)</a></li>
                                     <?php
									$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=1";
									$more_time=$obj->select($sql);
									?>
                                    <li><a href="reply_more_time.php"><span class="icon expdec"></span>Need More Time (<?php echo count($more_time); ?>)</a></li>
                                </ul>
							</div>
                            <div class="list-msgs">
                                <h3>Requests</h3>
                                <ul class="list1">
                                	<?php
									$select_photo_request_sent="select * from photo_request where From_mem_id='".$_SESSION['logged_user'][0]['id']."'";
									$db_photo_request_sent=$obj->select($select_photo_request_sent);
									?>
                                    <li><a href="photo_request_send.php"><span class="icon reqphoto"></span>Photo (<?php echo count($db_photo_request_sent); ?>)</a></li>
                                    <li><a href="#"><span class="icon referenceicon "></span>Reference (0)</a></li>
                                </ul>

							</div>
                            <div class="list-msgs">
                                <h3>Voice Messages <span>(0)</span></h3>
							</div>
                        </div>
                    </div>
            </div><?php */?>
            
            
        </div>
        
<script>
$(document).ready(function(e) {
    $('.deactive_profile').click(function(e) {
        if(confirm('Are you sure about deactivating your profile?'))
		{
			window.location.href = 'edit_profile.php?flag=deactive';
		}
    });
	
	$('.delete_profile').click(function(e) {
        if(confirm('Are you sure about deleting your profile?'))
		{
			window.location.href = 'edit_profile.php?flag=delete';
		}
    });
});
</script>
<style>
.size
{
	height:152px;
	width:152px;
}
.back_btn
{
	text-align:right;
	padding-right:5px;	
}
.back_btn_size
{
	height:15px;
	padding-top:5px;
}
ul.profl-list li .profile-img-box{ position:inherit !important }
/*.profile-img-box{ position:inherit !important; }*/
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$('.list-toggle').find('h3').click(function(e) {
			if($(this).next('ul').css('display')!='block')
			{
				$('.searchby1').css('display','none');
				$('.list-toggle').find('ul').slideUp('slow');
	            $(this).next('ul').slideToggle('slow');
				$('.list-toggle').find('h3').removeClass('selected');
				$(this).addClass('selected');
			}
        });
		
		$('.morelink .more-view').click(function(e) {
            $(this).next('div').find('.searchby1').fadeIn(150);
        });
		
		$('.close-more-search').click(function(e) {
            $(this).parent('.searchby1').fadeOut(150);
        });
		
		/*$("#acc-list").accordion({
			alwaysOpen: false,
			header: '.sidebar-cont > .list-toggle h3'
		});*/
	});
</script>
<script>
function delete_check(aa){
//alert();
if(document.getElementById('radio3').checked){
	//alert(aa);
	window.location='success_story.php?id='+aa+'#success_story-2';
	return false;
}
if(document.getElementById('radio4').checked){
	
	var x = confirm('Are sure delete?');
		 if(x)
		 {
			
			window.location='my_account.php?did='+aa;
			return false;
			
		 }
		 else
		 {
			 return false;
		 }	
	
}
}
</script>