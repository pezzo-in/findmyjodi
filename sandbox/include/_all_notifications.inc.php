<?php session_start(); 
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
														to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and
														is_replied = 'N' and interested = 'Y'";
											$count_total_msgs=$obj->select($total_msgs);	
											?>
                                            <li><a href="#" id="new_msg">New</a> (<?php echo count($count_total_msgs); ?>)</li>
                                            
                                            <?php
											$total_replies = "SELECT * 
															  from replies 
															  where 
															  from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
											$count_total_replies=$obj->select($total_replies);	
											?>
                                            <li><a href="#" id="replied">Replied</a> (<?php echo count($count_total_replies); ?>)</li>
                                            
                                             <?php
											$total_not_int_mem = "SELECT * 
													from not_interested_members 
													where 
														from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
											$count_not_int_mem=$obj->select($total_not_int_mem);	
											?>
                                            <li><a href="#" id="not_interested">Not Interested</a> (<?php echo count($count_not_int_mem); ?>)</li>
                                            <li><a href="#">Filtered</a> (0)</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sidebar-main">
                                    <h2>Sent</h2>
                                    <div class="sidebar-cont">
                                		<ul class="list1">
                                            <li><a href="#">Replies received</a> (0)</li>
                                            <li><a href="#">Read by members</a> (0)</li>
                                            <li><a href="#">Unread</a> (0)</li>
                                            <li><a href="#">Not Interested</a> (0)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                        <?php
							$sql = "SELECT id,message,from_mem 
									from messages 
									where to_mem = '".$_SESSION['logged_user'][0]['member_id']."'
									and is_replied = 'N' and interested = 'Y'";
							$messages=$obj->select($sql);
							
						?>
                            <div class="content">
                            <?php if(!empty($messages)) { ?>
                            	Listed here are the new messages you have received. We recommend you reply at the earliest.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                    <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										  
										  $sql2 = "SELECT members.*,member_photos.photo,messages.* FROM messages,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													 members.member_id = '".$messages[$i]['from_mem']."' 
													 and messages.to_mem ='".$_SESSION['logged_user'][0]['member_id']."' 
													 and messages.is_replied = 'N' and messages.interested = 'Y'";	
												 
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[0]['msg_id'];
										?>
                                       
                                    <div class="floatr">
                                    <a class="ajax send_email_btn" id="rpl_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>" href="include/send_reply.php?to=<?php echo $each_msg[0]['email_id']; ?>&to_mem_id=<?php echo $each_msg[0]['member_id']; ?>&msg_id=<?php echo $messages[0]['id']; ?>">Reply</a> 
                                       <a  href="#" class="not_int_class" id="not_int_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>" >| Not Interested</a>
</div>
                                </div>
                                <div class="basicview"  id="id_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                            <input type="checkbox" />
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> <?php echo "(".$each_msg[0]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" onClick="return doYouWantTo('<?php echo $msg_id; ?>')" class="icon-delete"><img src="images/delete-icon.png" /></a></div></div><br />
    <span class="smalltxt">Last Login : 2 hours ago</span><br />
    <p><?php echo $each_msg[0]['age']; ?> | <?php echo $each_msg[0]['religion']; ?>: <?php echo $each_msg[0]['caste']; ?> | Location : <?php echo $each_msg[0]['city']; ?>, <?php echo $each_msg[0]['country']; ?>| Education : <?php echo $each_msg[0]['education']; ?>| Occupation : <?php echo $each_msg[0]['occupation']; ?></p>
    <a href="view_profile.php?id=<?php echo $each_msg[0]['id']; ?>">View Full Profile</a>
    <a href="#inline_content" class="inline comm-history">Communication History</a>
                    <div class="lightbox" style="display:none;">
                        <div id="inline_content">
                            <div class="lightbox_cont full">
                                <h2>All Communication with this member</h2>
                                <div class="showbasiccontent">
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
    <p>30 Yrs, 5Ft 6In / 168 Cms | Hindu: Prajapati (Caste No Bar) | Location : Vadodara, Gujarat, India | Education : MBA | Occupation : Marketing Professional</p><a href="#">View Full Profile</a> </div>
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
     	<div class="left-msg"><strong>Message:</strong> <?php echo $messages[$i]['message']; ?>
        	
             <a href="#" class="more">More</a></div><div class="floatr">
              <a class="ajax send_email_btn" id="rpl_<?php echo $each_msg[$i]['member_id']."_".$msg_id; ?>" href="include/send_reply.php?to=<?php echo $each_msg[$i]['email_id']; ?>&to_mem_id=<?php echo $each_msg[$i]['member_id']; ?>&msg_id=<?php echo $messages[$i]['id']; ?>">Reply</a> 
             <a  href="#" class="not_int_class" id="not_int_<?php echo $each_msg[$i]['member_id']."_".$msg_id; ?>" >| Not Interested</a>
        </div>
     </div>
                                    
                                        </div>
                                <?php } $j++; ?>
                                    
                                </div>
                                <div class="title_select_all">
                                    <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All
                                    <div class="floatr"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a>
</div>
                                </div>   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
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
												$total_new_int = "select * from express_interest
															  where
															  to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and
															  is_accepted = 'N'";
												$count_new_int = $obj->select($total_new_int);			  
											?>
                                            <li><a href="#" id="new_int">New</a> (<?php echo count($count_new_int); ?>)</li>
                                            
                                            <?php 
												$total_accepted = "select * from accept_interest
															  where
															  from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
												$count_total_accepted = $obj->select($total_accepted);			  
											?>
                                            <li><a href="#" id="accepted_intrest">Accepted</a> (<?php echo count($count_total_accepted); ?>)</li>
                                            
                                            <?php 
												$total_not_int = "select * from not_interested_members
															  where
															  from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
															  
												$count_total_not_int = $obj->select($total_not_int);			  
											?>
                                            <li><a href="#" id="not_interested_int">Not Interested</a> (<?php echo count($count_total_not_int); ?>)</li>
                                            <li><a href="#">Filtered</a> (0)</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sidebar-main">
                                    <h2>Sent</h2>
                                    <div class="sidebar-cont">
                                		<ul class="list1">
                                            <li><a href="#">Replies received</a> (0)</li>
                                            <li><a href="#">Read by members</a> (5)</li>
                                            <li><a href="#">Unread</a> (2)</li>
                                            <li><a href="#">Not Interested</a> (0)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php 
									$select_new_msgs = "select * from messages
											where
											to_mem = '".$_SESSION['logged_user'][0]['member_id']."'
											and
											is_replied = 'N' and interested = 'Y'";
			
									$messages = $obj->select($select_new_msgs);		  
							?>
                            <div class="content" id="interest_tab">
                            <?php if(!empty($messages)) { ?>
						Listed here are the new interests you have received. We recommend you to reply to the interest at the earliest.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                    <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										  
										  	$sql2 = "SELECT members.*,member_photos.photo,messages.* FROM messages,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													 members.member_id = '".$messages[$i]['from_mem']."' 
													 and messages.to_mem ='".$_SESSION['logged_user'][0]['member_id']."' 
													 and messages.is_replied = 'N' and messages.interested = 'Y'";	
												
												
										 
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[0]['msg_id'];
										?>
                                       
                                    <div class="floatr">
                                    <a class="need_more_info" id="needinfo_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']."_".$each_msg[0]['name']; ?>" href="#">Need More Info |</a> 
                                     <a class="need_more_time" id="needtime_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']."_".$each_msg[0]['name']; ?>" href="#">Need More Time |</a> 
                                    <a class="accept_interest" id="accept_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']; ?>" href="#">Accept</a> 
                                       <a  href="#" class="not_int_interest" id="not_int_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>" >| Not Interested</a>
</div>
                                </div>
                                <div class="basicview"  id="accept_div_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                            <input type="checkbox" />
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
    <p><?php echo $each_msg[0]['age']; ?> | <?php echo $each_msg[0]['religion']; ?>: <?php echo $each_msg[0]['caste']; ?> | Location : <?php echo $each_msg[0]['city']; ?>, <?php echo $each_msg[0]['country']; ?>| Education : <?php echo $each_msg[0]['education']; ?>| Occupation : <?php echo $each_msg[0]['occupation']; ?></p>
    <a href="view_profile.php?id=<?php echo $each_msg[0]['id']; ?>">View Full Profile</a>
    <a href="#inline_content" class="inline comm-history">Communication History</a>
                    <div class="lightbox" style="display:none;">
                        <div id="inline_content">
                            <div class="lightbox_cont full">
                                <h2>All Communication with this member</h2>
                                <div class="showbasiccontent">
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
    <p>30 Yrs, 5Ft 6In / 168 Cms | Hindu: Prajapati (Caste No Bar) | Location : Vadodara, Gujarat, India | Education : MBA | Occupation : Marketing Professional</p><a href="#">View Full Profile</a> </div>
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
     <div class="msg-interest"><div class="left-msg">Interested in your profile. Kindly respond at the earliest.</div><div class="floatr"></div> </div>
                                    
                                        </div>
                                <?php } $j++; ?>
                                    
                                </div>
                                <div class="title_select_all">
                                    <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All
                                    <div class="floatr"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a>
</div>
                                </div>   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
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
                                            <li><a href="#">New</a> (0)</li>
                                            <li><a href="#">Awaiting My Reply</a> (0)</li>
                                            <li><a href="#">Replied</a> (0)</li>
                                            <li><a href="#">Not Interested</a> (0)</li>
                                            <li><a href="#">Filtered</a> (0)</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sidebar-main">
                                    <h2>Sent</h2>
                                    <div class="sidebar-cont">
                                		<ul class="list1">
                                            <li><a href="#">Replies received</a> (0)</li>
                                            <li><a href="#">Read by members</a> (5)</li>
                                            <li><a href="#">Unread</a> (2)</li>
                                            <li><a href="#">Not Interested</a> (0)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                            	 <span class="floatl">Listed here are members who have requested you to add photo. &nbsp;&nbsp;</span><a class="btn-pink btn nofloat" href="#"><span>Add Photo</span></a>
                                 <br />
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                    <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All
                                    <div class="floatr"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a>
</div>
                                </div>
                                <div class="basicview">
                                	<div class="showbasiccontent">
                                		<input type="checkbox" />
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
                                        <div class="row-top"><a href="#" class="floatl">Darshak Mehta (G1062018)</a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete"><img src="images/delete-icon.png" /></a></div></div><br />
<span class="smalltxt">Last Login : 2 hours ago</span><br />
<p>30 Yrs, 5Ft 6In / 168 Cms | Hindu: Prajapati (Caste No Bar) | Location : Vadodara, Gujarat, India | Education : MBA | Occupation : Marketing Professional</p>
<a href="#">View Full Profile</a>
<a href="#request_content" class="inline comm-history">Communication History</a>
				<div class="lightbox" style="display:none;">
					<div id="request_content">
                    	<div class="lightbox_cont full">
                        	<h2>All Communication with this member</h2>
                            <div class="showbasiccontent">
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
<p>30 Yrs, 5Ft 6In / 168 Cms | Hindu: Prajapati (Caste No Bar) | Location : Vadodara, Gujarat, India | Education : MBA | Occupation : Marketing Professional</p><a href="#">View Full Profile</a> </div>
                                	</div>
                                    <div class="cb-msgs">
                                    	<h2>Interests</h2>
                                        <div class="cb-msgbox">
                                        	<div class="left-msgbox">
                                            	<p>without photo how can we judge. please submit photo and contect no.</p>
                                            </div>
                                            <div class="smalltxt floatr">Received : 20 hours ago</div>
                                            <div class="msg-interest"><div class="floatr"><a class="btn-pink btn" href="#"><span>Add Photo</span></a></div> </div>
                                        </div>
                                        
                                        <div class="cb-msgbox">
                                        	<div class="left-msgbox">
                                            	<p>without photo how can we judge. please submit photo and contect no.</p>
                                            </div>
                                            <div class="smalltxt floatr">Received : 20 hours ago</div>
                                            <div class="msg-interest"><div class="floatr"><a class="btn-pink btn" href="#"><span>Add Photo</span></a></div> </div>
                                        </div>
                                    </div>     
                        </div>
                    </div>
               	</div>
 </div>
 
								
                                	</div>
                                    <div class="showbasiccontent">
                                		<input type="checkbox" />
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
                                        <div class="row-top"><a href="#">Darshak Mehta (G1062018)</a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete"><img src="images/delete-icon.png" /></a></div></div>
<span class="smalltxt">Last Login : 2 hours ago</span><br />
<p>30 Yrs, 5Ft 6In / 168 Cms | Hindu: Prajapati (Caste No Bar) | Location : Vadodara, Gujarat, India | Education : MBA | Occupation : Marketing Professional</p>
<a href="#">View Full Profile</a>
<a href="#request_content1" class="inline comm-history">Communication History</a>
<div class="lightbox" style="display:none;">
					<div id="request_content1">
                    	<div class="lightbox_cont full">
                        	<h2>All Communication with this member</h2>
                            <div class="showbasiccontent">
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
<p>30 Yrs, 5Ft 6In / 168 Cms | Hindu: Prajapati (Caste No Bar) | Location : Vadodara, Gujarat, India | Education : MBA | Occupation : Marketing Professional</p><a href="#">View Full Profile</a> </div>
                                	</div>
                                    <div class="cb-msgs">
                                    	<h2>Interests</h2>
                                        <div class="cb-msgbox">
                                        	<div class="left-msgbox">
                                            	<p>without photo how can we judge. please submit photo and contect no.</p>
                                            </div>
                                            <div class="smalltxt floatr">Received : 20 hours ago</div>
                                            <div class="msg-interest"><div class="floatr"><a class="btn-pink btn" href="#"><span>Add Photo</span></a></div> </div>
                                        </div>
                                        
                                        <div class="cb-msgbox">
                                        	<div class="left-msgbox">
                                            	<p>without photo how can we judge. please submit photo and contect no.</p>
                                            </div>
                                            <div class="smalltxt floatr">Received : 20 hours ago</div>
                                            <div class="msg-interest"><div class="floatr"><a class="btn-pink btn" href="#"><span>Add Photo</span></a></div> </div>
                                        </div>
                                    </div>     
                        </div>
                    </div>
               	</div>

 </div>
 
								
                                	</div>
                                </div>
                                
								<div class="title_select_all">
                                    <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All
                                    <div class="floatr"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a>
</div>
                                </div>   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>                             
                            </div>
                        </div>
                    </div>
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
				to_mem:exploded[1],
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
				to_mem:exploded[1],
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
				   url: 'include/refine_search.php?hint=accepted_intrest',
				   success: function(data) {
					   $('#interest_tab').html( data );
				   }
				});
		});
		$('#new_int').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/refine_search.php?hint=new_int',
				   success: function(data) {
					   $('#interest_tab').html( data );
				   }
				});
		});
		$('#new_msg').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=new_msg',
				   success: function(data) {
					   $('.content').html( data );
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
				   url: 'include/refine_search.php?hint=not_interested_int',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
		
		$('#not_interested').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/refine_search.php?hint=not_interested',
				   success: function(data) {
					   $('.content').html( data );
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
   