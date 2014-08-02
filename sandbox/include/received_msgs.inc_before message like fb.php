<?php
$url=explode('/',$_SERVER['REQUEST_URI']);
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
	
	/*$update_msg_status = "update messages 
							  set 
							  	is_replied = 'Y' 
							  where 
							  	from_mem = '".$_POST['to_mem']."' and
								to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and id = '".$_POST['msg_id']."'";*/
							//and id='".$_POST['msg_id']."'	
	
		$update = $obj->edit($update_msg_status);
}
if(isset($_GET['delete_msg_id']))
{
	$sqld="delete from messages where id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld);
	
	$sqld2="delete from not_interested_members where msg_id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld2);
	
	$sqld3="delete from need_more_info_detail where msg_id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld3);
	
	$sqld4="delete from need_more_time_detail where msg_id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld4);
	
	echo "<script> window.location.href = 'my_account.php' </script>";	
}
if(isset($_GET['id']))
{
	if($_GET['flag'] == 'y')
	{
		$sqld="delete from messages where id = '".$_GET['id']."' ";
		$obj->sql_query($sqld);
		
		$del_from_notint_mem = "delete from not_interested_members where msg_id = '".$_GET['id']."'";
		$obj->sql_query($del_from_notint_mem);
	}
	else
	{
		$sqld="delete from messages where id = '".$_GET['id']."'";
		$obj->sql_query($sqld);
	}
	echo "<script> window.location.href = 'my_account.php' </script>";	
}
if(isset($_GET['reply_msg_id']))
{
	$sqld="delete from replies where id = '".$_GET['reply_msg_id']."' ";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'my_account.php' </script>";	
}
if(isset($_POST['send_reply']))
	{
		$update_msg_status = "update messages 
							  set 
							  	is_replied = 'Y' 
							  where 
							  	from_mem = '".$_POST['to_mem_id']."'and
								to_mem = '".$_POST['from_mem_id']."'";
							//and id='".$_POST['msg_id']."'	
	
		$update = $obj->edit($update_msg_status);
		$insert_reply = "insert into replies (id,to_mem,from_mem,message,to_msg_id)
						 values
						 (NULL,'".$_POST['to_mem_id']."','".$_POST['from_mem_id']."','".$_POST['message']."','".$_POST['msg_id']."')";
		$insert = $obj->insert($insert_reply);		
		echo "<script>window.location='my_account.php'</script>";
		 
						 
	}	
//LOGGED-IN USER'S DETAIL //
	$sql_login = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.id = '".$_SESSION['logged_user'][0]['id']."'";	
	$logged_in_member=$obj->select($sql_login);
	
		
?>
<?php		$select_new_msgs = "select * from messages
								where
								to_mem = '".$_SESSION['logged_user'][0]['member_id']."' 
								group by from_mem order by id desc";
		//$messages = $obj->select($select_new_msgs);
		
		$PAGING=new PAGING($select_new_msgs,5);
		$sql=$PAGING->sql;
		$messages = $obj->select($sql);
		if(!empty($messages)) { ?>

<div class="content col-md-9 col-sm-12 col-xs-12">
  <?=$PAGING->show_paging("received_msgs.php")?>
  <!--<div class="title_select_all"></div>-->
    <?php
		 for($i=0;$i<count($messages);$i++)
									  {
										  
										  	$sql2 = "SELECT members.*,members.id as mem_id,member_photos.photo,messages.id as 
													msg_id,messages.* FROM messages,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													 members.member_id = '".$messages[$i]['from_mem']."' 
";			 
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[0]['msg_id'];
										
											$select_not_int_msgs = "select * from not_interested_members
																	where from_mem = '".$_SESSION['logged_user'][0]['member_id']."'
																	and to_mem = '".$messages[$i]['from_mem']."'
																	and msg_id = '".$msg_id."'";
											$not_int_msgs = $obj->select($select_not_int_msgs);	
									 
									  ?>
	<div class=""> <!--basicview-->
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
        		<div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> (<?php echo $each_msg[0]['member_id']; ?>)</a> <a href="#"><span class="icon phoneicon "></span></a></div>
				<div class="smalltxt floatr">Received : 20 hours ago <a href="#" onClick="return doYouWantTo('<?php echo $msg_id; ?>')" class="icon-delete">	<img src="images/delete-icon.png" /></a></div></div>
			<br />
        	<span class="smalltxt">Last Login : 2 hours ago</span><br />
        	<p><?php echo $each_msg[0]['age']; ?> Yrs
			<?php 
			if($each_msg[0]['height']!='')
			{
				$select_height="select * from height where Id='".$each_msg[0]['height']."'";
				$db_height=$obj->select($select_height);
				echo ', Height: '.$db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
				if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }
			}
			?>
			| <?php echo $each_msg[0]['religion']; ?>: <?php echo $each_msg[0]['caste']; ?>(Caste No Bar) | Location : <?php echo $each_msg[0]['city']; ?>, <?php echo $each_msg[0]['country']; ?> | Education : 
			<?php
			$select_education="select * from education_course where Id='".$each_msg[0]['education']."'";
			$db_education=$obj->select($select_education);
			echo $db_education[0]['Title'];
			?>
			<?php if($each_msg[0]['occupation'] != "") { ?> | Occupation : <?php echo $each_msg[0]['occupation'];  } ?></p>
        	<a href="view_profile.php?id=<?php echo $each_msg[0]['mem_id']; ?>">View Full Profile</a> <a href="#request_content1<?php echo $each_msg[0]['mem_id']; ?>" class="inline comm-history1">View Messages</a>
        	<div class="lightbox" style="display:none;">
          		<div id="request_content1<?php echo $each_msg[0]['mem_id']; ?>">
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
                  				<div class="row-top"><a href="#" class="floatl"></a><?php echo $each_msg[0]['name']; ?> (<?php echo $each_msg[0]['member_id']; ?>)</a> <a href="#"><span class="icon phoneicon "></span></a></div>
                    			<div class="smalltxt floatr">Received : 20 hours ago </div>
                  			</div>
                  			<br />
                  			<span class="smalltxt">Last Login : <?php echo $each_msg[0]['last_login']; ?></span><br />
                  			<p><?php echo $each_msg[0]['age']; ?> Yrs
                            <?php 
								if($each_msg[0]['height']!='')
								{
									$select_height="select * from height where Id='".$each_msg[0]['height']."'";
									$db_height=$obj->select($select_height);
									echo ', Height: '.$db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
									if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }
								}
								?>
                              | <?php echo $each_msg[0]['religion']; ?>: <?php echo $each_msg[0]['caste']; ?> (Caste No Bar) | Location : <?php echo $each_msg[0]['city']; ?>, <?php echo $each_msg[0]['country']; ?> | Education : 
							  <?php
								$select_education="select * from education_course where Id='".$each_msg[0]['education']."'";
								$db_education=$obj->select($select_education);
								echo $db_education[0]['Title'];
								?>
							  <?php if($each_msg[0]['occupation'] != "Any" ) { ?>| Occupation : <?php echo $each_msg[0]['occupation']; } ?></p>
                  			<a href="view_profile.php?id=<?php echo $each_msg[0]['mem_id']; ?>">View Full Profile</a> 
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
                                <div class="msg-interest">
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
                                <div class="msg-interest">
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
                                <div class="msg-interest">
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
                                <div class="msg-interest">
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
              		</div></div>
              <?php } else {
									  echo "<h2 style='color:green'>You have sent not interested notification to this member</h2>"; } ?>
				</div>
			</div>
		</div>
	</div>
	<!--<div class="msg-interest">
		<div class="left-msg int" style="display:none">Interested in your profile. Kindly respond at the earliest.</div>
        <div class="floatr" style="display:none"><a href="#" class="btn-pink btn"><span>Accept</span></a><a href="#" class="btn-blue1 btn"><span>Need More Info</span></a><a href="#" class="btn-blue1 btn"><span>Need More Time</span></a><a href="#" class="btn-blue1 btn"><span>Not Interested</span></a></div>
	</div>-->
    <?php } ?>
  
  <!--<div class="title_select_all"> 
    <!--<input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All
    <div class="floatr" style="display:none;"><a href="#">Accept</a> | <a href="#">Need more Time</a> | <a href="#">Need more Info</a> | <a href="#">Not Interested</a> | <a href="#">Delete</a> </div>
  </div>
  -->
  <?=$PAGING->show_paging("received_msgs.php")?>
  </div>
  <?php } $j++; ?>
<style>
.upload_pic
{
	float: left;
    margin-right: 20px;
    padding: 24px 13px;
}
.size
{
	height:181px;
	width:171px;
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
.profile_pic{
	/*height:150px;*/
	width:75px;
}
</style>
<script>
function check_msg(id)
{
	$('#txtMsg'+id).css('border','1px solid #ccc');
	error = 0;
	if($('#txtMsg'+id).val().trim()=='')
	{
		$('#txtMsg'+id).css('border','1px solid red');
		error =1;
	}
	if(error==1)
	{
		return false;
	}
	return true;
}
//on not-interest msg click
$('.not_int_msg_class').click(function() {
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
						$('.cb-msgs').html("Member has been notified that you're not interested.");
						$('.cb-msgs').css('color','green');						
					}					
			});
		 
	});
	function doYouWantTo(id,data){
	 doIt=confirm('Are you sure you want to delete this message?');
	  if(doIt){
		  if(data == "del_frm_notint_mem")
		  {
			//window.location.href = 'my_account.php?id='+id+&flag=y';		
		  }
		  else
		  {
			  window.location.href = 'my_account.php?id='+id;		
		  }
	  }
	  else{ 
		  return false;
	  }
	  return true;
	}
</script> 
