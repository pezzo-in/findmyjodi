<?php session_start(); 

if(isset($_POST['reply']))

{

	$insert = "insert into messages(id,from_mem,to_mem,message,parent_id,send_date)

			   values

			   (NULL,'".$_SESSION['logged_user'][0]['member_id']."',

			   	 	 '".$_POST['to_mem']."',

					 '".$_POST['txtMsg']."',

					 '".$_POST['msg_id']."',

					 '".date('Y-m-d H:i:s')."'

					 )";

	$save_rpl = $obj->insert($insert);				 	

	$update = $obj->edit($update_msg_status);

}

if(isset($_GET['id']))

{

	$sqld="delete from messages where id = '".$_GET['id']."' ";

	$obj->sql_query($sqld);

	echo "<script> window.location.href = 'all_notifications.php' </script>";	

}

	if(isset($_POST['send_reply']))

	{

		$update_msg_status = "update messages 

							  set 

							  	is_replied = 'Y' 

							  where 

							  	from_mem = '".$_POST['to_mem_id']."'and

								to_mem = '".$_POST['from_mem_id']."' and id='".$_POST['msg_id']."' ";

		$update = $obj->edit($update_msg_status);



		$insert_reply = "insert into replies (id,to_mem,from_mem,message)

						 values

						 (NULL,'".$_POST['to_mem_id']."','".$_POST['from_mem_id']."','".$_POST['message']."')";

		$insert = $obj->insert($insert_reply);		

		echo "<script>window.location='all_notifications.php'</script>";

		 

						 

	}

?>

    

<div  class="mid col-md-12 col-sm-12 col-xs-12">

<?php

$select_banner = "select * from advertise where adv_position = 'Notification Top (954 X 100)' AND status = 'Active'";

$db_banner = $obj->select($select_banner);

if(count($db_banner) > 0) 

{

	if($db_banner[0]['banner_file'] != '') 

	{

		if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {

?>

<div style="margin: 0px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>

<?php } } } ?>

<div id="tab-container">

                        <ul class="msgtab">

                            <li><a href="#msgtab-1">Messages</a></li>

                            <li><a href="#msgtab-2">Interests</a></li>

                            <li><a href="#msgtab-3">Requests</a></li>

                        </ul>

                        <div class="msgtab_content" id="msgtab-1">

                        	<div class="sidebar">

                                <div class="sidebar-main">

                                    <h2>Received</h2>

                                    <div class="sidebar-cont">

                                		<ul class="list1">

                                        	<?php

											$total_msgs = "SELECT * 

													from messages 

													where 

														to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";

											$count_total_msgs=$obj->select($total_msgs);	

											?>

                                            <li><a href="javascript:;" id="new_msg">Message received</a> (<?php echo count($count_total_msgs); ?>)</li>

                                            

                                            <?php /*?><?php

											$total_replies = "SELECT * 

															  from replies 

															  where 

															  from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";

											$count_total_replies=$obj->select($total_replies);	

											?>

                                            <li><a href="javascript:;" id="replied">Replied</a> (<?php echo count($count_total_replies); ?>)</li>

                                            

                                             <?php

											$total_not_int_mem = "SELECT * 

													from not_interested_members 

													where 

														from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";

											$count_not_int_mem=$obj->select($total_not_int_mem);	

											?>

                                            <li><a href="javascript:;" id="not_interested">Not Interested</a> (<?php echo count($count_not_int_mem); ?>)</li>

                                            <li><a href="javascript:;">Filtered</a> (0)</li><?php */?>

                                        </ul>

                                    </div>

                                </div>

                                <div class="sidebar-main">

                                    <h2>Sent</h2>

                                    <div class="sidebar-cont">

                                		<ul class="list1">

                                        	<?php

											$sql = "select * from messages where from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";

											$data = $obj->select($sql);		

											?>

                                            <li><a href="javascript:;" id="msg_sent">Messages sent</a> (<?php echo count($data); ?>)</li>

                                            <?php /*?><li><a href="javascript:;">Read by members</a> (0)</li>

                                            <li><a href="javascript:;">Unread</a> (0)</li>

                                            <li><a href="javascript:;">Not Interested</a> (0)</li><?php */?>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                            

                        <?php

							$select_new_msgs = "select * from messages

												where

												to_mem = '".$_SESSION['logged_user'][0]['member_id']."'

												group by from_mem order by id desc";

							$messages=$obj->select($select_new_msgs);

							

						?>

                            <div class="content message_content">

                            <?php if(!empty($messages)) { ?>

                            	Listed here are the new messages you have received. We recommend you reply at the earliest.

                                <ul class="pagination" style="display:none"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>

								<div class="title_select_all" style="display:none;">

                                    <?php /*?><input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">

                                    Select All<?php */?>

                                     <?php

									 $j=0; 

									 for($i=0;$i<count($messages);$i++)

									  {

										  

										 $sql2 = "SELECT members.*,members.id as mem_id,member_photos.photo,messages.id as 

													 msg_id,messages.* FROM messages,members 

								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id

								                     where

													 members.member_id = '".$messages[$i]['from_mem']."' 

													 and messages.to_mem ='".$_SESSION['logged_user'][0]['member_id']."'

													 and messages.id = '".$messages[$i]['id']."'";	

												 

										$each_msg = $obj->select($sql2); 

										$msg_id = $each_msg[0]['msg_id'];

										?>

                                       

                                    <div class="floatr" style="display:none">

                                    <?php if($messages[$i]['is_replied'] == 'N') { ?>

                                    <a class="ajax send_email_btn" id="rpl_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>" href="include/send_reply.php?to=<?php echo $each_msg[0]['email_id']; ?>&to_mem_id=<?php echo $each_msg[0]['member_id']; ?>&msg_id=<?php echo $messages[0]['id']; ?>">Reply |</a> <?php } ?>

                                       <a  href="javascript:;" class="not_int_class" id="not_int_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>" > Not Interested</a>

</div>

                                </div>

                                <div class=""  id="id_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>"> <!--basicview-->

                               <?php

									

										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];

										

										?>

                                     

                                        <div class="showbasiccontent col-md-12 col-sm-12 col-xs-12">

                                           <?php /*?> <input type="checkbox" /><?php */?>

                                            <div class="prfl-pic">

                                                <div id="slideshow" class="pics">

                                                    <?php

													$select_profile_photo="select * from member_photos where member_id='".$each_msg[0]['mem_id']."' AND Approve=1";

													$db_profile_photo=$obj->select($select_profile_photo);

											

													$select_gallery_photo="select * from member_photo_gallery where member_id='".$each_msg[0]['mem_id']."' AND Approve=1";

													$db_gallery_photo=$obj->select($select_gallery_photo);

													

													if(count($db_profile_photo)>0 || count($db_gallery_photo)>0)

													{

														if(count($db_profile_photo)>0)

														{

														?>

														<img src="upload/<?php echo $db_profile_photo[0]['photo'] ?>" width="70" />

														<?php

														}

														

														for($p=0;$p<count($db_gallery_photo);$p++)

														{

														?>

														<img src="upload/<?php echo $db_gallery_photo[$p]['photo'] ?>" width="70" />

														<?php

														}

													?>

													<?php }else{ ?>

													<img src="images/usericon.png" width="70" />

													<?php } ?>

                                                </div>

                                                <div class="img-count controls"><a href="#" class="prev"><img src="images/blue-arrow2.png" /></a><span class="caption">&nbsp;</span><a href="#" class="next"><img src="images/blue-arrow1.png" /></a></div>

                                        </div>

                                            <div class="prfl-details">

                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> <?php echo "(".$each_msg[0]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" onClick="return doYouWantTo('<?php echo $msg_id; ?>')" class="icon-delete"><img src="images/delete-icon.png" /></a></div></div><br />

    <span class="smalltxt">Last Login : 2 hours ago</span><br />

    <p><?php echo $each_msg[0]['age']; ?> | <?php echo $each_msg[0]['religion']; ?>: <?php echo $each_msg[0]['caste']; ?> | Location : <?php echo $each_msg[0]['city']; ?>, <?php echo $each_msg[0]['country']; ?>| Education : 
	<?php
	$select_education="select * from education_course where Id='".$each_msg[0]['education']."'";
	$db_education=$obj->select($select_education);
	echo $db_education[0]['Title'];
	?>
	| Occupation : <?php echo $each_msg[0]['occupation']; ?></p>

    <a href="view_profile.php?id=<?php echo $each_msg[0]['mem_id']; ?>" class="floatl">View Full Profile</a>

    <a href="#request_content1<?php echo $each_msg[0]['id']; ?>" class="inline comm-history">View Messages</a>

                    <div class="lightbox" style="display:none;">

                        <div id="request_content1<?php echo $each_msg[0]['id']; ?>">

                    	<div class="lightbox_cont full" style="width:710px;">

                        	<h2>All Communication with this member</h2>

                            <div class="showbasiccontent col-md-12 col-sm-12 col-xs-12">

                                        <div class="prfl-pic">

                                            <div id="slideshow" class="pics">

                                                <?php

												$select_profile_photo="select * from member_photos where member_id='".$each_msg[0]['mem_id']."' AND Approve=1";

												$db_profile_photo=$obj->select($select_profile_photo);

										

												$select_gallery_photo="select * from member_photo_gallery where member_id='".$each_msg[0]['mem_id']."' AND Approve=1";

												$db_gallery_photo=$obj->select($select_gallery_photo);

												

												if(count($db_profile_photo)>0 || count($db_gallery_photo)>0)

												{

													if(count($db_profile_photo)>0)

													{

													?>

													<img src="upload/<?php echo $db_profile_photo[0]['photo'] ?>" width="70" />

													<?php

													}

													

													for($p=0;$p<count($db_gallery_photo);$p++)

													{

													?>

													<img src="upload/<?php echo $db_gallery_photo[$p]['photo'] ?>" width="70" />

													<?php

													}

												?>

												<?php }else{ ?>

												<img src="images/usericon.png" width="70" />

												<?php } ?>

                                            </div>

                                            <div class="img-count controls"><a href="#" class="prev"><img src="images/blue-arrow2.png" /></a><span class="caption">&nbsp;</span><a href="#" class="next"><img src="images/blue-arrow1.png" /></a></div>

           							</div>

                                        <div class="prfl-details">

                                        <div class="row-top"><a href="#" class="floatl"></a><?php echo $each_msg[0]['name']; ?> (<?php echo $each_msg[0]['member_id']; ?>)</a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete"><img src="images/delete-icon.png" /></a></div></div><br />

<span class="smalltxt">Last Login : <?php echo $each_msg[0]['last_login']; ?></span><br />

<p><?php echo $each_msg[0]['age']; ?> Yrs, Height <?php echo $each_msg[0]['height']; ?> | <?php echo $each_msg[0]['religion']; ?>: 

<?php echo $each_msg[0]['caste']; ?> (Caste No Bar) | Location : <?php echo $each_msg[0]['city']; ?>, <?php echo $each_msg[0]['country']; ?> | Education : 
<?php
$select_education="select * from education_course where Id='".$each_msg[0]['education']."'";
$db_education=$obj->select($select_education);
echo $db_education[0]['Title'];
?>
<?php if($each_msg[0]['occupation'] != "Any" ) { ?>| Occupation : <?php echo $each_msg[0]['occupation']; } ?></p><a href="view_profile.php?id=<?php echo $each_msg[0]['mem_id']; ?>" class="floatl">View Full Profile</a> </div>

                                	</div>

                                    <?php 

											$chk_not_int = "select * from not_interested_members

															where from_mem = '".$_SESSION['logged_user'][0]['member_id']."' and

															to_mem = '".$messages[$i]['from_mem']."'";

															

											$select_data = $obj->select($chk_not_int);

											if(empty($select_data)) { ?>

                                    <div class="cb-msgs">

						<h2>Interests</h2>

                <?php

					$select_new_msgs2 = "select * from messages where to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and parent_id = '0' and from_mem = '".$messages[$i]['from_mem']."' order by id desc";

					$messages2 = $obj->select($select_new_msgs2);				

						if(count($messages2) > 0)

						{				

										foreach($messages2 as $msg) { 

										

											$datestr2 = $msg['send_date'];

											$date2=strtotime($datestr2);

											$diff2=$date2-time();

											$days2=abs(floor($diff2/(60*60*24)));

										if($days2 == "1")

										{

											$final_days2 = "day";

										}

										else

										{

											$final_days2 = "days";

										}

										$hours2=abs(round(($diff2-$days2*60*60*24)/(60*60)));?>

						<div class="cb-msgbox">

                  			<div class="left-msgbox"><p><?php echo $msg['message']; ?></p></div>

                  			<div class="smalltxt floatr">Received : <?php echo $days2.$final_days2." ago"; ?></div>

			                  <?php 

							  	$replies_to_mem = "select * from messages 

								

															  where parent_id = '".$msg['id']."' order by id asc";

									  $sel_replies = $obj->select($replies_to_mem);

								

									  if(!empty($sel_replies))

									  {

										  foreach($sel_replies as $rel) { ?>

                                      <div class="left-msgbox">

                                        <p><?php 

										if($rel['from_mem'] == $_SESSION['logged_user'][0]['member_id']) 

										{

											echo "Me: ";

										}echo $rel['message']; ?></p>

                                      </div>

			                          		<?php  } 

									  }

									  else

									  {

									  ?>

                                         <form name="reply_form" method="post" class="form-horizontal">

                                <div class="msg-interest" style="display:none;">

                                  <div class="floatr" style="padding-right:30px;">

                                    <textarea name="txtMsg" id="txtMsg" id="txtMsg<?php echo $msg['id']; ?>"></textarea>

                                    <input type="hidden" value="<?php echo $msg['id']; ?>" name="msg_id" id="msg_id" />

                                    <input type="hidden" value="<?php echo $msg['from_mem']; ?>" name="to_mem" id="to_mem" />

                                    <input type="submit" value="Reply" name="reply" onclick="return check_msg('<?php echo $msg['id']; ?>')"/>

                                  </div>

                                </div>

                                </form>

                                      <?php } ?>

                                      <?php

									  if($rel['to_mem'] == $_SESSION['logged_user'][0]['member_id'])

									  {

										 ?>

                              <form name="reply_form" method="post" class="form-horizontal">

                                <div class="msg-interest" style="display:none;">

                                  <div class="floatr" style="padding-right:30px;">

                                    <textarea name="txtMsg" id="txtMsg" id="txtMsg<?php echo $msg['id']; ?>"></textarea>

                                    <input type="hidden" value="<?php echo $msg['id']; ?>" name="msg_id" id="msg_id" />

                                    <input type="hidden" value="<?php echo $msg['from_mem']; ?>" name="to_mem" id="to_mem" />

                                    <input type="submit" value="Reply" name="reply" onclick="return check_msg('<?php echo $msg['id']; ?>')"/>

                                  </div>

                                </div>

                              </form>

                              <?php } ?>

                              

                		</div>

                <?php } 

						}

								$select_new_msgs2 = "select * from messages

																where

																from_mem = '".$_SESSION['logged_user'][0]['member_id']."' and parent_id = '0' and to_mem = '".$messages[$i]['from_mem']."' order by id desc";

											

											$messages2 = $obj->select($select_new_msgs2);

											if(count($messages2) > 0)

											{

												

												foreach($messages2 as $msg) { 

										

											$datestr2 = $msg['send_date'];

											$date2=strtotime($datestr2);

											$diff2=$date2-time();

											$days2=abs(floor($diff2/(60*60*24)));

										if($days2 == "1")

										{

											$final_days2 = "day";

										}

										else

										{

											$final_days2 = "days";

										}

										$hours2=abs(round(($diff2-$days2*60*60*24)/(60*60)));?>

						<div class="cb-msgbox">

                  			<div class="left-msgbox"><p><?php echo $msg['message']; ?></p></div>

                  			<div class="smalltxt floatr">Received : <?php echo $days2.$final_days2." ago"; ?></div>

			                  <?php 

							  	$replies_to_mem = "select * from messages 

								

															  where parent_id = '".$msg['id']."' order by id asc";

									  $sel_replies = $obj->select($replies_to_mem);

								

									  if(!empty($sel_replies))

									  {

										  foreach($sel_replies as $rel) { ?>

                                      <div class="left-msgbox">

                                        <p><?php 

										if($rel['from_mem'] == $_SESSION['logged_user'][0]['member_id']) 

										{

											echo "Me: ";

										}echo $rel['message']; ?></p>

                                      </div>

			                          		<?php  } 

									  }

									  else

									  {

									  ?>

                                         <form name="reply_form" method="post" class="form-horizontal">

                                <div class="msg-interest" style="display:none;">

                                  <div class="floatr" style="padding-right:30px;">

                                    <textarea name="txtMsg" id="txtMsg" id="txtMsg<?php echo $msg['id']; ?>"></textarea>

                                    <input type="hidden" value="<?php echo $msg['id']; ?>" name="msg_id" id="msg_id" />

                                    <input type="hidden" value="<?php echo $msg['from_mem']; ?>" name="to_mem" id="to_mem" />

                                    <input type="submit" value="Reply" name="reply" onclick="return check_msg('<?php echo $msg['id']; ?>')"/>

                                  </div>

                                </div>

                                </form>

                                      <?php } ?>

                                      <?php

									  if($rel['to_mem'] == $_SESSION['logged_user'][0]['member_id'])

									  {

										 ?>

                              <form name="reply_form" method="post" class="form-horizontal">

                                <div class="msg-interest" style="display:none;">

                                  <div class="floatr" style="padding-right:30px;">

                                    <textarea name="txtMsg" id="txtMsg" id="txtMsg<?php echo $msg['id']; ?>"></textarea>

                                    <input type="hidden" value="<?php echo $msg['id']; ?>" name="msg_id" id="msg_id" />

                                    <input type="hidden" value="<?php echo $msg['to_mem']; ?>" name="to_mem" id="to_mem" />

                                    <input type="submit" value="Reply" name="reply" onclick="return check_msg('<?php echo $msg['id']; ?>')"/>

                                  </div>

                                </div>

                              </form>

                              <?php } ?>

                              

                		</div>

                <?php } 

											

											

				?>

                <?php } ?>

              		</div>

              <?php } else {

									  echo "<h2 style='color:green'>You have sent not interested notification to this member</h2>"; } ?> 

                        </div>

                    </div>

                    </div>

     </div>

     <div class="msg-interest" style="display:none;">

     	<div class="left-msg">

        	

            </div><div class="floatr" style="display:none">

              <a class="ajax send_email_btn" id="rpl_<?php echo $each_msg[$i]['member_id']."_".$msg_id; ?>" href="include/send_reply.php?to=<?php echo $each_msg[$i]['email_id']; ?>&to_mem_id=<?php echo $each_msg[$i]['member_id']; ?>&msg_id=<?php echo $messages[$i]['id']; ?>">Reply</a> 

             <a  href="#" class="not_int_class" id="not_int_<?php echo $each_msg[$i]['member_id']."_".$msg_id; ?>" >| Not Interested</a>

        </div>

     </div>

                                    

                                        </div>

                                <?php } $j++; ?>

                                    

                                </div>

                                <div class="title_select_all" style="display:none">

                                    <?php /*?><input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">

                                    Select All <?php */?>

                                    <div class="floatr" style="display:none"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a></div>

                                </div>   

                                <ul class="pagination" style="display:none"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>

                           <?php  } 

						   else

						   {

							   echo "No Messages you have got";

						   }?>                                     

                            </div>

                        </div>

                        <div class="msgtab_content" id="msgtab-2">

                        	<div class="sidebar">

                                <div class="sidebar-main">

                                    <h2>Received</h2>

                                    <div class="sidebar-cont">

                                		<ul class="list1">

                                        	<?php 

												$total_new_int="select express_interest.* from express_interest,members where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=0 AND is_more_info=0";

												//$total_new_int = "select * from express_interest where to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and is_accepted = 'N'";

												$count_new_int = $obj->select($total_new_int);			  

											?>

                                            <li><a href="javascript:;" id="new_int">New</a> (<?php echo count($count_new_int); ?>)</li>

                                            

                                            <?php 

												$total_accepted="select express_interest.* from express_interest,members where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted=1";										  

												//$total_accepted = "select * from accept_interest where from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";

												$count_total_accepted = $obj->select($total_accepted);			  

											?>

                                            <li><a href="javascript:;" id="accepted_intrest">Accepted</a> (<?php echo count($count_total_accepted); ?>)</li>

                                            

                                            <?php 

												$sql="select express_interest.* from express_interest,members where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_more_info=1 AND  express_interest.is_accepted='N'";

												$more_info=$obj->select($sql);			  

											?>

                                            <li><a href="javascript:;" id="not_interested_int">Need More Info</a> (<?php echo count($more_info); ?>)</li>

                                            <?php

											$sql="select express_interest.* from express_interest,members where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_more_time=1 AND  express_interest.is_accepted='N'";

											$more_time=$obj->select($sql);

											?>

                                            <li><a href="javascript:;" id="need_more_time_receiv" >Need More Time</a> (<?php echo count($more_time); ?>)</li>

                                        </ul>

                                    </div>

                                </div>

                                <div class="sidebar-main">

                                    <h2>Sent</h2>

                                    <div class="sidebar-cont">

                                		<ul class="list1">

                                        	<?php

											$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=0 AND is_more_info=0";

											$r_pend=$obj->select($sql);

											?>

                                            <li><a href="javascript:;" id="reply_pending_sent">Reply Pending</a> (<?php echo count($r_pend); ?>)</li>

                                            <?php

											$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='Y'";

											$new_int=$obj->select($sql);

											?>

                                            <li><a href="javascript:;" id="accepted_sent">Accepted</a> (<?php echo count($new_int); ?>)</li>

                                            <?php

											$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_info=1";

											$more_info=$obj->select($sql);

											?>

                                            <li><a href="javascript:;" id="need_more_info_sent">Need More Info</a> (<?php echo count($more_info); ?>)</li>

                                             <?php

											$sql="select express_interest.* from express_interest,members where express_interest.from_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=1";

											$more_time=$obj->select($sql);

											?>

                                            <li><a href="javascript:;" id="need_more_time_sent">Need More Time</a> (<?php echo count($more_time); ?>)</li>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                            <?php 

									//$select_new_msgs = "select * from messages where to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and is_replied = 'N' and interested = 'Y'";

									$select_new_msgs = "select express_interest.*, express_interest.id as exp_int_id from express_interest,members where express_interest.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' AND members.member_id=express_interest.to_mem AND members.is_profile_active='Y' AND express_interest.is_accepted='N' AND is_more_time=0 AND is_more_info=0";

									$messages = $obj->select($select_new_msgs);		  

							?>

                            <div class="content" id="interest_tab">

                            <?php if(!empty($messages)) { ?>

						Listed here are the new interests you have received. We recommend you to reply to the interest at the earliest.

                                <!--<ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>-->

								<div class="title_select_all" style="display:none">

                                   <?php /*?> <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">

                                    Select All<?php */?>

                                     <?php

									 $j=0; 

									 for($i=0;$i<count($messages);$i++)

									  {

										  

										  	$sql2 = "SELECT members.*,members.id as mem_id,member_photos.photo,messages.* FROM messages,members 

								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id

								                     where

													 members.member_id = '".$messages[$i]['from_mem']."' 

													 and messages.to_mem ='".$_SESSION['logged_user'][0]['member_id']."' 

													 and messages.is_replied = 'N' and messages.interested = 'Y'";	

											

										$each_msg = $obj->select($sql2); 

										$msg_id = $each_msg[0]['msg_id'];

										?>

                                       

                                    <div class="floatr">

                                    <a class="need_more_info" id="needinfo_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']."_".$each_msg[0]['name']; ?>" href="javascript:;">Need More Info |</a> 

                                     <a class="need_more_time" id="needtime_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']."_".$each_msg[0]['name']; ?>" href="javascript:;">Need More Time |</a> 

                                    <a class="accept_interest" id="accept_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']; ?>" href="javascript:;">Accept</a> 

                                       <a  href="javascript:;" class="not_int_interest" id="not_int_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>" >| Not Interested</a>

</div>

                                </div>

                                <div class=""  id="accept_div_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']; ?>"> <!--basicview-->

                               <?php

									

										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];

										

										?>

                                     

                                        <div class="showbasiccontent col-md-12 col-sm-12 col-xs-12">

                                            <?php /*?><input type="checkbox" /><?php */?>

                                            <div class="prfl-pic">

                                                <div id="slideshow" class="pics">

                                                    <img src="images/usericon.png" width="70" />

                                                    <img src="http://malsup.github.com/images/beach1.jpg" width="70" />

                                                    <img src="http://malsup.github.com/images/beach2.jpg" width="70" />

                                                    <img src="http://malsup.github.com/images/beach3.jpg" width="70" />

                                                </div>

                                                <div class="img-count controls"><a href="#" class="prev"><img src="images/blue-arrow2.png" /></a><span class="caption">&nbsp;</span><a href="#" class="next"><img src="images/blue-arrow1.png" /></a></div>

                                        </div>

                                            <div class="prfl-details">

                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> <?php echo "(".$each_msg[0]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete"><img src="images/delete-icon.png" /></a></div></div><br />

    <span class="smalltxt">Last Login : 2 hours ago</span><br />

    <p><?php echo $each_msg[0]['age']; ?> | <?php echo $each_msg[0]['religion']; ?>: <?php echo $each_msg[0]['caste']; ?> | Location : <?php echo $each_msg[0]['city']; ?>, <?php echo $each_msg[0]['country']; ?>| Education : 
	<?php
	$select_education="select * from education_course where Id='".$each_msg[0]['education']."'";
	$db_education=$obj->select($select_education);
	echo $db_education[0]['Title'];
	?>
	| Occupation : <?php echo $each_msg[0]['occupation']; ?></p>

    <a href="view_profile.php?id=<?php echo $each_msg[0]['mem_id']; ?>" class="floatl">View Full Profile</a>

    <a href="#inline_content" class="inline comm-history" style="display:none">Communication History</a>

                    <div class="lightbox" style="display:none;">

                        <div id="inline_content">

                            <div class="lightbox_cont full">

                                <h2>All Communication with this member</h2>

                                <div class="showbasiccontent col-md-12 col-sm-12 col-xs-12">

                                            <div class="prfl-pic">

                                                <div id="slideshow" class="pics">

                                                    <img src="images/usericon.png" width="70" height="70" />

                                                    <img src="http://malsup.github.com/images/beach1.jpg" width="70" height="70" />

                                                    <img src="http://malsup.github.com/images/beach2.jpg" width="70" height="70" />

                                                    <img src="http://malsup.github.com/images/beach3.jpg" width="70" height="70" />

                                                </div>

                                                <div class="img-count controls"><a href="#" class="prev"><img src="images/blue-arrow2.png" /></a><span class="caption">&nbsp;</span><a href="#" class="next"><img src="images/blue-arrow1.png" /></a></div>

                                        </div>

                                            <div class="prfl-details">

                                            <div class="row-top"><a href="#" class="floatl">Darshak Mehta (G1062018)</a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete"><img src="images/delete-icon.png" /></a></div></div><br />

    <span class="smalltxt">Last Login : 2 hours ago</span><br />

    <p>30 Yrs, 5Ft 6In / 168 Cms | Hindu: Prajapati (Caste No Bar) | Location : Vadodara, Gujarat, India | Education : MBA | Occupation : Marketing Professional</p><a href="#" class="floatl">View Full Profile</a> </div>

                                        </div>

                                        <div class="cb-msgs">

                                            <h2>Messages</h2>

                                            <div class="cb-msgbox">

                                                <div class="left-msgbox">

                                                    <p>without photo how can we judge. please submit photo and contect no.</p>

                                                </div>

                                                <div class="smalltxt floatr">Received : 20 hours ago</div>

                                                <div class="msg-interest"><div class="floatr">

                                                    <a class="btn-pink btn" href="#"><span>Reply</span></a>

                                                    <a class="btn-blue1 btn" href="#"><span>Not Interested</span></a>

                                                </div> </div>

                                            </div>

                                            

                                            <div class="cb-msgbox">

                                                <div class="left-msgbox">

                                                    <p>without photo how can we judge. please submit photo and contect no.</p>

                                                </div>

                                                <div class="smalltxt floatr">Received : 20 hours ago</div>

                                                <div class="msg-interest"><div class="floatr"><a class="btn-pink btn" href="#"><span>Reply</span></a><a class="btn-blue1 btn" href="#"><span>Not Interested</span></a></div> </div>

                                            </div>

                                        </div>     

                            </div>

                        </div>

                    </div>

     </div>

     <div class="msg-interest">

		<?php if(empty($result)){	?>

        <a class="accept_interest" id="accept_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']; ?>" href="javascript:;">Accept</a>

        <?php } ?>

        <?php

                 $select_new_msgs = "select * from express_interest where to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and from_mem = '".$each_msg[0]['member_id']."' AND is_more_info=1";

                $data = $obj->select($select_new_msgs);

                if(empty($data)) { ?>

        | <a class="need_more_info" id="needinfo_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']."_".$each_msg[0]['name']; ?>" href="javascript:;">Need More Info</a>

        <?php } ?>

        <?php

                 $select_new_msgs = "select * from express_interest

                                    where to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and from_mem = '".$each_msg[0]['member_id']."' AND is_more_time=1";

                $data = $obj->select($select_new_msgs);

                if(empty($data)) {

        ?>

        | <a class="need_more_time" id="needtime_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']."_".$each_msg[0]['name']; ?>" href="javascript:;">Need More Time</a>

        <?php } ?>

         <div class="left-msg" style="display:none">Interested in your profile. Kindly respond at the earliest.</div>

     </div>

                                    

                                        </div>

                                <?php } $j++; ?>

                                    

                                </div>

                                <div class="title_select_all" style="display:none">

                                    <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">

                                    Select All

                                    <div class="floatr"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="javascript:;">Not Interested</a>  |  <a href="#">Delete</a>

</div>

                                </div>   

                                <!--<ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>-->

                               <?php  }

							   else

							   {

								   echo "No new interest you have got.";

							   } ?>                                 

                            </div>

                        </div>

                        <div class="msgtab_content" id="msgtab-3">

                        	<div class="sidebar">

                                <div class="sidebar-main">

                                    <h2>Received</h2>

                                    <div class="sidebar-cont">

                                		<ul class="list1">

                                        	<?php

											$select_photo_request_received="select * from photo_request where To_mem_id='".$_SESSION['logged_user'][0]['id']."' AND is_accept=0";

											$db_photo_request_received=$obj->select($select_photo_request_received);

											?>

                                            <li><a href="javascript:;" class="photo_received_href" >Photo</a> (<?php echo count($db_photo_request_received); ?>)</li>

                                        </ul>

                                    </div>

                                </div>

                                <div class="sidebar-main">

                                    <h2>Sent</h2>

                                    <div class="sidebar-cont">

                                		<ul class="list1">

                                        	<?php

											$select_photo_request_sent="select * from photo_request where From_mem_id='".$_SESSION['logged_user'][0]['id']."'";

											$db_photo_request_sent=$obj->select($select_photo_request_sent);

											?>

                                            <li><a href="javascript:;" class="photo_sent_href">Photo</a> (<?php echo count($db_photo_request_sent); ?>)</li>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                            <div class="content photo_request">

                            	 <!--<span class="floatl">Listed here are members who have requested you to add photo. &nbsp;&nbsp;</span><a class="btn-pink btn nofloat" href="#"><span>Add Photo</span></a>

                                 <br />-->

                                 <?php

						$select_new_msgs = "select photo_request.*, photo_request.Id as photo_request_id from photo_request,members where photo_request.To_mem_id = '".$_SESSION['logged_user'][0]['id']."' AND members.id=photo_request.From_mem_id AND members.is_profile_active='Y' order by photo_request.Id DESC";

		

						//$PAGING=new PAGING($select_new_msgs,10);

						//$sql=$PAGING->sql;

						$messages = $obj->select($select_new_msgs);

								 ?>

                                 

							<?php /*?><?=$PAGING->show_paging("all_notifications.php#msgtab-3");?><?php */?>

                                

                                <?php

						for($i=0;$i<count($messages);$i++)

						{

							$sql2 = "SELECT members.*,members.id as mem_id,member_photos.photo,messages.id as msg_id,messages.* FROM messages,members LEFT JOIN member_photos ON members.id = member_photos.member_id where members.id = '".$messages[$i]['From_mem_id']."'";

							$each_msg = $obj->select($sql2); 							

							$msg_id = $each_msg[0]['msg_id'];

								?> 

								

                                <div class=""> <!--basicview-->

                                	<div class="showbasiccontent col-md-12 col-sm-12 col-xs-12">

                                		<?php /*?><input type="checkbox" /><?php */?>

                                        <div class="prfl-pic">

                                            <div id="slideshow" class="pics">

                                                <?php

												$select_profile_photo="select * from member_photos where member_id='".$each_msg[0]['mem_id']."' AND Approve=1";

												$db_profile_photo=$obj->select($select_profile_photo);

										

												$select_gallery_photo="select * from member_photo_gallery where member_id='".$each_msg[0]['mem_id']."' AND Approve=1";

												$db_gallery_photo=$obj->select($select_gallery_photo);

												

												if(count($db_profile_photo)>0 || count($db_gallery_photo)>0)

												{

													if(count($db_profile_photo)>0)

													{

													?>

													<img src="upload/<?php echo $db_profile_photo[0]['photo'] ?>" width="70" />

													<?php

													}

													

													for($p=0;$p<count($db_gallery_photo);$p++)

													{

													?>

													<img src="upload/<?php echo $db_gallery_photo[$p]['photo'] ?>" width="70" />

													<?php

													}

												?>

												<?php }else{ ?>

												<img src="images/usericon.png" width="70" />

												<?php } ?>

                                            </div>

                                            <div class="img-count controls"><a href="#" class="prev"><img src="images/blue-arrow2.png" /></a><span class="caption">&nbsp;</span><a href="#" class="next"><img src="images/blue-arrow1.png" /></a></div>

           							</div>

                                        <div class="prfl-details">

                                        <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> (<?php echo $each_msg[0]['member_id']; ?>)</a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <!--<a href="#" class="icon-delete"><img src="images/delete-icon.png" /></a>--></div></div><br />

<span class="smalltxt">Last Login : 2 hours ago</span><br />

<p><?php echo $each_msg[0]['age']; ?> Yrs, <?php echo $each_msg[0]['height']." Inch" ?> | <?php echo $each_msg[0]['religion']; ?>: <?php echo $each_msg[0]['caste']; ?> | Location : <?php echo $each_msg[0]['city']; ?>, <?php echo $each_msg[0]['country']; ?> | Education : 
<?php
$select_education="select * from education_course where Id='".$each_msg[0]['education']."'";
$db_education=$obj->select($select_education);
echo $db_education[0]['Title'];
?>
<?php 
	if($each_msg[0]['occupation'] != "") { ?> | Occupation : <?php echo $each_msg[0]['occupation'];  } ?></p>

    

<a href="view_profile.php?id=<?php echo $each_msg[0]['mem_id']; ?>" class="floatl">View Full Profile</a>			

		</div>

	</div>

</div>

 <?php } ?>			



 		<?php

		if(count($messages)==0)

		{

			echo '<br /><h3>Currently You have no any Photo Request by anyone</h3>';

		}

		?>

 		

		<?php /*?><?=$PAGING->show_paging("all_notifications.php#msgtab-3");?><?php */?>

		</div>

	</div>

</div>

<?php

$select_banner = "select * from advertise where adv_position = 'Notification Bottom (954 X 100)' AND status = 'Active'";

$db_banner = $obj->select($select_banner);

if(count($db_banner) > 0) 

{

	if($db_banner[0]['banner_file'] != '') 

	{

		if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {

?>

<div style="margin: 10px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>

<?php } } } ?>

</div>



<script>

function doYouWantTo(id){

	  doIt=confirm('Are you sure you want to delete this message?');

	  if(doIt){

		window.location.href = 'all_notifications.php?id='+id;

	  }

	  else{ 

		  return false;

	  }

	  return true;

	}

	$('.need_more_time').click(function() {

		 var ids = this.id;

		 var exploded = ids.split('_');

		 var name = exploded[3];

		 

				jQuery.post("include/need_more_time_detail.php", {

				to_mem:exploded[2],

				},

				function(data, to_mem)

				{

					if(data == "1")

					{

						$('#accept_div_'+exploded[1]+"_"+exploded[2]).html("Your request for more time to respond has been conveyed to "+name+"("+exploded[1]+")");

						$('#accept_div_'+exploded[1]+"_"+exploded[2]).css('color','green');						

					}

					

			});

		 

	});

	$('.need_more_info').click(function() {

		 var ids = this.id;

		 var exploded = ids.split('_');

		 var name = exploded[3];

		 

				jQuery.post("include/need_more_info_detail.php", {

				to_mem:exploded[2],

				},

				function(data, to_mem)

				{

					if(data == "1")

					{

						$('#accept_div_'+exploded[1]+"_"+exploded[2]).html("Your request for more information to respond has been conveyed to "+name+"("+exploded[1]+")");

						$('#accept_div_'+exploded[1]+"_"+exploded[2]).css('color','green');						

					}

					

			});

		 

	});

	$('.accept_interest').click(function() {

		 var ids = this.id;

		 var exploded = ids.split('_');

				jQuery.post("include/accept_interest.php", {

				to_mem:exploded[1],

				},

				function(data, to_mem)

				{

					if(data == "1")

					{

						$('#accept_div_'+exploded[1]+"_"+exploded[2]).html("Congratulations! YOu have successfully accepted interest.");

						$('#accept_div_'+exploded[1]+"_"+exploded[2]).css('color','green');						

					}

					

			});

		 

	});

		$('.not_int_interest').click(function() {

		 var ids = this.id;

		 var exploded = ids.split('_');

		 

		 jQuery.post("include/save_not_int.php", {

			 	//flag:interest,

				to_member_id:exploded[2],

				msg_id:exploded[3]				

				},

				function(data, to_member_id,msg_id,flag)

				{

					if(data == "1")

					{

						$('#id_'+exploded[2]+"_"+exploded[3]).html("Member has been notified that you're not interested.");

						$('#id_'+exploded[2]+"_"+exploded[3]).css('color','green');

						$("#not_int_"+exploded[2]+"_"+exploded[3]).css('display','none');

						$("#rpl_"+exploded[2]+"_"+exploded[3]).css('display','none');

					}

					

			});

		 

	});

	

	//to display accepted interest data

	$('#accepted_intrest').click( function() {

			$.ajax({

				   type: "GET",		

				   //url: 'include/refine_search.php?hint=accepted_intrest',

				   url: 'accepted_interest_ajax.php',

				   success: function(data) {

					   $('#interest_tab').html( data );

					   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

				   }

				});

		});

		$('#new_int').click( function() {

			$.ajax({

				   type: "GET",		

				   //url: 'include/refine_search.php?hint=new_int',

				   url: 'new_interest_ajax.php',

				   success: function(data) {

					   $('#interest_tab').html( data );

					   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

				   }

				});

		});

		$('#new_msg').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/home_refine_search.php?hint=new_msg',

				   success: function(data) {

					   $('.message_content').html( data );

					   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

				   }

				});

		});

		$('#msg_sent').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/home_refine_search.php?hint=msg_sent',

				   success: function(data) {

					   $('.message_content').html( data );

					   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

				   }

				});

		});

		$('#replied').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/refine_search.php?hint=replied',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

		$('#not_interested_int').click( function() {

			$.ajax({

				   type: "GET",		

				   //url: 'include/refine_search.php?hint=not_interested_int',

				   url: 'need_more_info_ajax.php',

				   success: function(data) {

					   $('#interest_tab').html( data );

					   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

				   }

				});

		});

		$('#need_more_time_receiv').click( function() {

			$.ajax({

				   type: "GET",		

				   //url: 'include/refine_search.php?hint=not_interested_int',

				   url: 'need_more_time_ajax.php',

				   success: function(data) {

					   $('#interest_tab').html( data );

					   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

				   }

				});

		});

		

		$('#reply_pending_sent').click( function() {

			$.ajax({

				   type: "GET",		

				   //url: 'include/refine_search.php?hint=not_interested_int',

				   url: 'sent_reply_panding_ajax.php',

				   success: function(data) {

					   $('#interest_tab').html( data );

					   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

				   }

				});

		});

		

		$('#accepted_sent').click( function() {

			$.ajax({

				   type: "GET",		

				   //url: 'include/refine_search.php?hint=not_interested_int',

				   url: 'reply_accept_ajax.php',

				   success: function(data) {

					   $('#interest_tab').html( data );

					   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

				   }

				});

		});

		

		$('#need_more_info_sent').click( function() {

			$.ajax({

				   type: "GET",		

				   //url: 'include/refine_search.php?hint=not_interested_int',

				   url: 'reply_more_info_ajax.php',

				   success: function(data) {

					   $('#interest_tab').html( data );

					   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

				   }

				});

		});

		

		$('#need_more_time_sent').click( function() {

			$.ajax({

				   type: "GET",		

				   //url: 'include/refine_search.php?hint=not_interested_int',

				   url: 'reply_more_time_ajax.php',

				   success: function(data) {

					   $('#interest_tab').html( data );

					   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

				   }

				});

		});

		

		$('#not_interested').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'refine_search.php?hint=not_interested',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});		

		

		$('.photo_received_href').click(function(e) {

            $.ajax({

			   type: "POST",		

			   url: 'message_photo_received.php',

			   success: function(data) {

				   $('.photo_request').html( data );

				   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

			   }

			});

        });

		

		$('.photo_sent_href').click(function(e) {

            $.ajax({

			   type: "POST",		

			   url: 'message_photo_sent.php',

			   success: function(data) {

				   $('.photo_request').html( data );

				   $(".inline").colorbox({inline:true, maxWidth:"900px;", minWidth:"700px;"});

			   }

			});

        });

	

	

	



	//from msgs tab not interested

	$('.not_int_class').click(function() {

		 var ids = this.id;

		 var exploded = ids.split('_');

		 

		 jQuery.post("include/save_not_int.php", {

				to_member_id:exploded[2],

				msg_id:exploded[3]				

				},

				function(data, to_member_id,msg_id)

				{

					if(data == "1")

					{

						$('#id_'+exploded[2]+"_"+exploded[3]).html("Member has been notified that you're not interested.");

						$('#id_'+exploded[2]+"_"+exploded[3]).css('color','green');

						$("#not_int_"+exploded[2]+"_"+exploded[3]).css('display','none');

						$("#rpl_"+exploded[2]+"_"+exploded[3]).css('display','none');

					}

					

			});

		 

	});

</script>

   