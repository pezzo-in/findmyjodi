<?php session_start(); ?>
<html>
<head>
<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
<script type="text/javascript">
$(function() {
    $('.pics').each(function() {
    	var cycle = $(this), 
         controls = cycle.parent().find('.controls');
         
    	cycle.cycle({
			timeout:   0,
			speed:     200,
			fx:        'scrollHorz',
			next:      controls.find('.next'),
			prev:      controls.find('.prev'),
			caption:   cycle.parent().find('span.caption'),
			before:    function(curr, next, opts) {
				opts.caption.html( $(next).attr('title') );
			}
	    });
	});//
//	function onAfter(curr,next,opts) {
//	var caption = '' + (opts.currSlide + 1) + ' of ' + opts.slideCount;
//	$('.caption').html(caption);
//}
});
</script>

<link rel="stylesheet" href="css/colorbox.css" />
<script src="js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, maxWidth:"900px;"});
	});
</script> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="assets/js/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
</head>
</html>
<?php
include('../lib/myclass.php');

//MESSAGES
if($_GET['hint'] == "new_msg")
{
	$select_new_msgs = "select * from messages
								where
								to_mem = '".$_SESSION['logged_user'][0]['member_id']."'
								and
								is_replied = 'N' and interested = 'Y'";

	$messages = $obj->select($select_new_msgs);
	if(!empty($messages)) {
	?>
    Listed here are the new messages you have received. We recommend you reply at the earliest.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                    <!--<input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
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
										$msg_id = $each_msg[$i]['msg_id'];
										
										?>
                                       
                                    <div class="floatr">
                                    <a class="ajax send_email_btn" id="rpl_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>" href="include/send_reply.php?to=<?php echo $each_msg[0]['email_id']; ?>&to_mem_id=<?php echo $each_msg[0]['member_id']; ?>&msg_id=<?php echo $messages[0]['id']; ?>">Reply</a> 
                                       <a  href="#" class="not_int_msg_class" id="not_int_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>" >| Not Interested</a>
</div>
                                </div>
                                <div class="basicview"  id="id_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                          <!--  <input type="checkbox" />-->
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> <?php echo "(".$each_msg[0]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" <?php /*?>onClick="return doYouWantTo('<?php echo $msg_id; ?>')"<?php */?> class="icon-delete"><img src="images/delete-icon.png" /></a></div></div><br />
    <span class="smalltxt">Last Login : 2 hours ago</span><br />
    <p><?php echo $each_msg[0]['age']." Yrs"; ?> | <?php echo $each_msg[0]['religion']; ?>: <?php echo $each_msg[0]['caste']; ?> | Location : <?php echo $each_msg[0]['city']; ?>, <?php echo $each_msg[0]['country']; ?>| Education : <?php echo $each_msg[0]['education']; ?>| Occupation : <?php echo $each_msg[0]['occupation']; ?></p>
    <a href="view_profile.php?id=<?php echo $each_msg[$i]['id']; ?>">View Full Profile</a>
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
                                                <div class="msg-interest"><div class="floatr" style="display:none">
                                                    <a class="btn-pink btn" href="#"><span>Reply</span></a>
                                                    <a class="btn-blue1 btn" href="#"><span>Not Interested</span></a>
                                                </div> </div>
                                            </div>
                                            
                                            <div class="cb-msgbox">
                                                <div class="left-msgbox">
                                                    <p>without photo how can we judge. please submit photo and contect no.</p>
                                                </div>
                                                <div class="smalltxt floatr">Received : 20 hours ago</div>
                                                <div class="msg-interest"><div class="floatr" style="display:none"><a class="btn-pink btn" href="#"><span>Reply</span></a><a class="btn-blue1 btn" href="#"><span>Not Interested</span></a></div> </div>
                                            </div>
                                        </div>     
                            </div>
                        </div>
                    </div>
     </div>
     <div class="msg-interest"><div class="left-msg"><strong>Message:</strong> <?php echo $messages[0]['message']; ?></div><div class="floatr" style="display:none"><a href="#" class="btn-pink btn"><span>Reply</span></a><a href="#" class="btn-blue1 btn"><span>Not Interested</span></a></div> </div>
                                    
                                        </div>
                                <?php } $j++; ?> 
                                    
                                </div>
                                <div class="title_select_all">
                                    <!--<input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                    <div class="floatr" style="display:none;"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a>
</div>
                                </div>   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "Currently you have no new messages.";
	}
}
if($_GET['hint'] == "not_replied")
{
	$select_new_msgs = "select * from messages
								where
								to_mem = '".$_SESSION['logged_user'][0]['member_id']."'
								and
								is_replied = 'N' and interested = 'Y'";

	$messages = $obj->select($select_new_msgs);
	if(!empty($messages)) { 
	?>
Listed here are the messages you have read but not replied. We recommend you reply at the earliest.
<ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                    <!--<input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										  $sql2 = "SELECT members.*,member_photos.photo,messages.* FROM messages,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													  members.member_id = '".$messages[$i]['from_mem']."' 
													 and messages.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' 
													 and messages.is_replied = 'N'";	  
												
										 
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[$i]['msg_id'];
										?>
                                       
                                    <div class="floatr">
                                    <a class="ajax send_email_btn" id="rpl_<?php echo $each_msg[$i]['member_id']."_".$msg_id; ?>" href="include/send_reply.php?to=<?php echo $each_msg[$i]['email_id']; ?>&to_mem_id=<?php echo $each_msg[$i]['member_id']; ?>&msg_id=<?php echo $messages[$i]['id']; ?>">Reply</a> 
                                       <a  href="#" class="not_int_msg_class" id="not_int_<?php echo $each_msg[$i]['member_id']."_".$msg_id; ?>" >| Not Interested</a>
</div>
                                </div>
                                <div class="basicview"  id="id_<?php echo $each_msg[$i]['member_id']."_".$msg_id; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                           <!-- <input type="checkbox" />-->
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[$i]['name']; ?> <?php echo "(".$each_msg[$i]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" <?php /*?>onClick="return doYouWantTo('<?php echo $msg_id; ?>','<?php echo $_GET['page'] ?>')"<?php */?> class="icon-delete"><img src="images/delete-icon.png" /></a></div></div><br />
    <span class="smalltxt">Last Login : 2 hours ago</span><br />
    <p><?php echo $each_msg[$i]['age']; ?> | <?php echo $each_msg[$i]['religion']; ?>: <?php echo $each_msg[$i]['caste']; ?> | Location : <?php echo $each_msg[$i]['city']; ?>, <?php echo $each_msg[$i]['country']; ?>| Education : <?php echo $each_msg[$i]['education']; ?>| Occupation : <?php echo $each_msg[$i]['occupation']; ?></p>
    <a href="view_profile.php?id=<?php echo $each_msg[$i]['id']; ?>">View Full Profile</a>
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
                                                <div class="msg-interest"><div class="floatr" style="display:none">
                                                    <a class="btn-pink btn" href="#"><span>Reply</span></a>
                                                    <a class="btn-blue1 btn" href="#"><span>Not Interested</span></a>
                                                </div> </div>
                                            </div>
                                            
                                            <div class="cb-msgbox">
                                                <div class="left-msgbox">
                                                    <p>without photo how can we judge. please submit photo and contect no.</p>
                                                </div>
                                                <div class="smalltxt floatr">Received : 20 hours ago</div>
                                                <div class="msg-interest"><div class="floatr" style="display:none"><a class="btn-pink btn" href="#"><span>Reply</span></a><a class="btn-blue1 btn" href="#"><span>Not Interested</span></a></div> </div>
                                            </div>
                                        </div>     
                            </div>
                        </div>
                    </div>
     </div>
     <div class="msg-interest"><div class="left-msg"><strong>Message:</strong> <?php echo $messages[$i]['message']; ?></div><div class="floatr" style="display:none"><a href="#" class="btn-pink btn"><span>Reply</span></a><a href="#" class="btn-blue1 btn"><span>Not Interested</span></a></div> </div>
                                    
                                        </div>
                                <?php } $j++; ?> 
                                    
                                </div>
                                <div class="title_select_all">
                                    <!--<input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                    <div class="floatr" style="display:none;"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a>
</div>
                                </div>   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "Currently you have no unreplied messages.";
	}
}
if($_GET['hint'] == "not_interested_msgs")
{
	$total_not_int_mem = "SELECT not_interested_members.*,not_interested_members.id as not_int_msg_id
						  from not_interested_members
						  where 
						  not_interested_members.from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
						
	$messages=$obj->select($total_not_int_mem);	
		  
	if(!empty($messages)) {
	?>
    Listed here are the members whose proposals you have declined.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                   
                                     <?php
									 for($i=0;$i<count($messages);$i++)
									  {
										  $sql2 = "SELECT members.*,member_photos.photo,messages.* FROM messages,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													 members.member_id = '".$messages[$i]['to_mem']."' 
													 and messages.to_mem = '".$_SESSION['logged_user'][0]['member_id']."' 
													 and messages.interested = 'N'
													 and messages.id = '".$messages[$i]['msg_id']."'";		 

											$each_msg = $obj->select($sql2); 											
											
									  
									  $msg_id = $each_msg[0]['msg_id'];										
?>
                                    <div class="floatr">
                                  
</div>
                                </div>
                                <div class="basicview"  id="id_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                            <!--<input type="checkbox" />--> 
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> <?php echo "(".$each_msg[0]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete"  <?php /*?>onClick="return doYouWantTo('<?php echo $msg_id; ?>','del_frm_notint_mem')"<?php */?>><img src="images/delete-icon.png" /></a></div></div><br />
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
     <div class="msg-interest"><div class="left-msg"><strong>Message:</strong> <?php echo $each_msg[0]['message']; ?></div><div class="floatr"></div> </div>
                                    
                                        </div>
                                <?php }   ?>
                                    
                                </div>
                                   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "Currently there are no interests in this folder.";
	}
}

if($_GET['hint'] == "sent_msgs")
{
	$select_new_msgs = "select * from replies
								where
								from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
	$messages = $obj->select($select_new_msgs);
	if(!empty($messages)) {
	?>
    Listed here are the new messages you have received. We recommend you reply at the earliest.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                    <!--<input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										 $sql2 = "SELECT members.*,member_photos.photo,replies.* FROM replies,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													 where members.member_id = '".$messages[$i]['to_mem']."'
													and replies.from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";  
																	
										  
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[$i]['msg_id'];
										?>
                                       
                                    <div class="floatr">
                                    <a class="ajax send_email_btn" id="rpl_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>" href="include/send_reply.php?to=<?php echo $each_msg[0]['email_id']; ?>&to_mem_id=<?php echo $each_msg[0]['member_id']; ?>&msg_id=<?php echo $messages[0]['id']; ?>">Reply</a> 
                                       <a  href="#" class="not_int_msg_class" id="not_int_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>" >| Not Interested</a>
</div>
                                </div>
                                <div class="basicview"  id="id_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                          <!--  <input type="checkbox" />-->
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> <?php echo "(".$each_msg[0]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" <?php /*?>onClick="return doYouWantTo('<?php echo $msg_id; ?>')"<?php */?> class="icon-delete"><img src="images/delete-icon.png" /></a></div></div><br />
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
                                                <div class="msg-interest"><div class="floatr" style="display:none">
                                                    <a class="btn-pink btn" href="#"><span>Reply</span></a>
                                                    <a class="btn-blue1 btn" href="#"><span>Not Interested</span></a>
                                                </div> </div>
                                            </div>
                                            
                                            <div class="cb-msgbox">
                                                <div class="left-msgbox">
                                                    <p>without photo how can we judge. please submit photo and contect no.</p>
                                                </div>
                                                <div class="smalltxt floatr">Received : 20 hours ago</div>
                                                <div class="msg-interest"><div class="floatr" style="display:none"><a class="btn-pink btn" href="#"><span>Reply</span></a><a class="btn-blue1 btn" href="#"><span>Not Interested</span></a></div> </div>
                                            </div>
                                        </div>     
                            </div>
                        </div>
                    </div>
     </div>
     <div class="msg-interest"><div class="left-msg"><strong>Message:</strong> <?php echo $messages[$i]['message']; ?></div><div class="floatr" style="display:none"><a href="#" class="btn-pink btn"><span>Reply</span></a><a href="#" class="btn-blue1 btn"><span>Not Interested</span></a></div> </div>
                                    
                                        </div>
                                <?php } $j++; ?> 
                                    
                                </div>
                                <div class="title_select_all">
                                    <!--<input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                    <div class="floatr" style="display:none;"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a>
</div>
                                </div>   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "Currently you have no new messages.";
	}
} 

if($_GET['hint'] == "sent_interest")
{
	$total_new_int = "select *,id as exp_int_id from express_interest
					  where
					  from_mem = '".$_SESSION['logged_user'][0]['member_id']."' and
					  is_accepted = 'N'";
					echo $total_not_int;  
	$messages = $obj->select($total_new_int);	
	if(!empty($messages)) {
	?>

Listed here are the new interests you have sent.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                    <!--<input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										  
										 $sql2 = "SELECT members.*,member_photos.photo FROM members 
								  					 	  LEFT JOIN member_photos ON members.id = member_photos.member_id
								                    	  where
														  members.member_id = '".$messages[$i]['to_mem']."'";											
											
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[$i]['msg_id'];
										?>
                                       
                                    <div class="floatr" style="display:none">

                                    <a class="need_more_info" id="needinfo_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']."_".$each_msg[0]['name']; ?>" href="#">Need More Info |</a> 
                                     <a class="need_more_time" id="needtime_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']."_".$each_msg[0]['name']; ?>" href="#">Need More Time |</a>
        <a class="need_more_time" href="#"><span>Not Interested |</span></a> <a class="accept_interest" id="accept_<?php echo $each_msg[0]['member_id']."_".$messages[0]['exp_int_id']; ?>" href="#">Accept</a> 
                                       <a  href="#" class="not_int_interest" id="not_int_<?php echo $each_msg[0]['member_id']."_".$msg_id; ?>" >| Not Interested</a>
</div>
                                </div>
                                <div class="basicview"  id="accept_div_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                         <!--   <input type="checkbox" />-->
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> <?php echo "(".$each_msg[0]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete" <?php /*?>onClick="return doYouWantTo('<?php echo $msg_id; ?>','<?php echo $_GET['page']; ?>')"<?php */?>><img src="images/delete-icon.png" /></a></div></div><br />
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
     	<div class="left-msg"></div>
        <div class="floatr">
        </div> </div>
                                    
                                        </div>
                                <?php } $j++; ?>
                                    
                                </div>
                                <div class="title_select_all">
                                    <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All
                                    <div class="floatr" style="display:none"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a>
</div>
                                </div>   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "You have not sent any interests.";
	}
}




//INTERESTS 
if($_GET['hint'] == "new_int")
{
	$total_new_int = "select *,id as exp_int_id from express_interest
					  where
					  to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and
					  is_accepted = 'N'";
	$messages = $obj->select($total_new_int);	
	if(!empty($messages)) {
	?>

Listed here are the new interests you have received. We recommend you to reply to the interest at the earliest.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                    <!--<input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										  
										$sql2 = "SELECT members.*,member_photos.photo
												 FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id 
												 where 
												 members.member_id = '".$messages[$i]['from_mem']."'";	
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[$i]['msg_id']; 
										?>
                                       
                                    <div class="floatr">

                                    <a class="need_more_info" id="needinfo_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']."_".$each_msg[0]['name']; ?>" href="#">Need More Info |</a> 
                                     <a class="need_more_time" id="needtime_<?php echo $each_msg[0]['member_id']."_".$messages[$i]['exp_int_id']."_".$each_msg[0]['name']; ?>" href="#">Need More Time |</a>
        <a class="need_more_time" href="#"><span>Not Interested |</span></a> <a class="accept_interest" id="accept_<?php echo $each_msg[0]['member_id']."_".$messages[0]['exp_int_id']; ?>" href="#">Accept</a> 
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> <?php echo "(".$each_msg[0]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete" <?php /*?>onClick="return doYouWantTo('<?php echo $msg_id; ?>','<?php echo $_GET['page']; ?>')"<?php */?>><img src="images/delete-icon.png" /></a></div></div><br />
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
     	<div class="left-msg">Interested in your profile. Kindly respond at the earliest.</div>
        <div class="floatr">
        </div> </div>
                                    
                                        </div>
                                <?php } $j++; ?>
                                    
                                </div>
                                <div class="title_select_all">
                                    <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All
                                    <div class="floatr" style="display:none"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a>
</div>
                                </div>   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "Currently you have no any interests.";
	}
}
if($_GET['hint'] == "accepted_intrest")
{
	$total_accepted = "select *,accept_interest.id as acc_id from accept_interest
					   where
					   from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
	$messages = $obj->select($total_accepted);	
	if(!empty($messages)) {
	?>

Listed here are the members whose interest you have accepted.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                   <!-- <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										  
											/*$sql2 = "SELECT members.*, member_photos.photo 
												 FROM member_photos
												 RIGHT JOIN members ON member_photos.member_id=members.id 
												 where 
												 members.member_id = '".$messages[$i]['to_mem']."'";	*/
												 
										 $sql2 = "SELECT members.*,member_photos.photo,replies.* FROM replies,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													 members.member_id = '".$messages[$i]['to_mem']."'";	
												 		 	 
										 
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[$i]['msg_id'];
										?>
                                  
                                </div>
                                <div class="basicview"  id="accept_div_<?php echo $each_msg[0]['member_id']."_".$messages[0]['exp_int_id']; ?>">
                                        <div class="showbasiccontent">
                                           <!-- <input type="checkbox" />-->
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> <?php echo "(".$each_msg[0]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete" <?php /*?>onClick="return doYouWantToDeleteInt('<?php echo $messages[0]['acc_id']; ?>')"<?php */?>><img src="images/delete-icon.png" /></a></div></div><br />
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
     
                                    
                                        </div>
                                <?php } $j++; ?>
                                    
                                </div>
                                <div class="title_select_all" style="display:none">
                                   <!-- <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                    <div class="floatr"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a>
</div>
                                </div>   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "No new messages";
	}
}


if($_GET['hint'] == "my_accepted_intrest")
{
	$total_accepted = "select *,accept_interest.id as acc_id from accept_interest
					   where
					   to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
	$messages = $obj->select($total_accepted);	
	if(!empty($messages)) {
	?>

Listed here are the members whose interest you have accepted.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                   <!-- <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										  
											/*$sql2 = "SELECT members.*, member_photos.photo 
												 FROM member_photos
												 RIGHT JOIN members ON member_photos.member_id=members.id 
												 where 
												 members.member_id = '".$messages[$i]['from_mem']."'";	*/
												 
											 $sql2 = "SELECT members.*,member_photos.photo,replies.* FROM replies,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													 members.member_id = '".$messages[$i]['from_mem']."'";	 	 
										 
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[$i]['msg_id'];
										?>
                                  
                                </div>
                                <div class="basicview"  id="accept_div_<?php echo $each_msg[0]['member_id']."_".$messages[0]['exp_int_id']; ?>">
                                        <div class="showbasiccontent">
                                           <!-- <input type="checkbox" />-->
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> <?php echo "(".$each_msg[0]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete" <?php /*?>onClick="return doYouWantToDeleteInt('<?php echo $messages[0]['acc_id']; ?>')"<?php */?>><img src="images/delete-icon.png" /></a></div></div><br />
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
     
                                    
                                        </div>
                                <?php } $j++; ?>
                                    
                                </div>
                                <div class="title_select_all" style="display:none">
                                   <!-- <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                    <div class="floatr"><a href="#">Accept</a>  |  <a href="#">Need more Time</a>  |  <a href="#">Need more Info</a>  |  <a href="#">Not Interested</a>  |  <a href="#">Delete</a>
</div>
                                </div>   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "Currently no any interest accepted of you.";
	}
}

if($_GET['hint'] == "not_interested_int")
{
	$total_not_int = "select * from not_interested_members
					  where
					  from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
	$messages = $obj->select($total_not_int);	
	if(!empty($messages)) {
	?>

Listed here are the members whose interest you have declined.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                   <!-- <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										  
										  	/*$sql2 = "select members.*,member_photos.photo
												 from members,member_photos,messages
												 where members.id = member_photos.member_id
												 and members.member_id = '".$messages[$i]['to_mem']."'"; */
											/*	 
											$sql2 = "SELECT members.*, member_photos.photo 
												 FROM member_photos
												 RIGHT JOIN members ON member_photos.member_id=members.id 
												 where 
												 members.member_id = '".$messages[$i]['to_mem']."'";	*/
											
											 $sql2 = "SELECT members.*,member_photos.photo,replies.* FROM replies,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													  members.member_id = '".$messages[$i]['to_mem']."'";
												 
												 
												
										 
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[$i]['msg_id'];
										?>
                                  
                                </div>
                                <div class="basicview"  id="accept_div_<?php echo $each_msg[$i]['member_id']."_".$messages[$i]['exp_int_id']; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                           <!-- <input type="checkbox" />-->
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[$i]['name']; ?> <?php echo "(".$each_msg[$i]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete" <?php /*?>onClick="return doYouWantTo('<?php echo $msg_id; ?>','<?php echo $_GET['page']; ?>')"<?php */?>><img src="images/delete-icon.png" /></a></div></div><br />
    <span class="smalltxt">Last Login : 2 hours ago</span><br />
    <p><?php echo $each_msg[$i]['age']; ?> | <?php echo $each_msg[$i]['religion']; ?>: <?php echo $each_msg[$i]['caste']; ?> | Location : <?php echo $each_msg[$i]['city']; ?>, <?php echo $each_msg[$i]['country']; ?>| Education : <?php echo $each_msg[$i]['education']; ?>| Occupation : <?php echo $each_msg[$i]['occupation']; ?></p>
    <a href="view_profile.php?id=<?php echo $each_msg[$i]['id']; ?>">View Full Profile</a>
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
     
                                    
                                        </div>
                                <?php } $j++; ?>
                                    
                                </div>
                                   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "No new messages";
	}
}


if($_GET['hint'] == "need_more_info")
{
	$need_more_info = "select * from need_more_info_detail
					   where
					   to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
	$messages = $obj->select($need_more_info);
		
	if(!empty($messages)) {
	?>

Listed here are the members whose interest you have declined.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                   <!-- <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										  
										  	/*$sql2 = "select members.*,member_photos.photo
												 from members,member_photos,messages
												 where members.id = member_photos.member_id
												 and members.member_id = '".$messages[$i]['to_mem']."'"; */
												 
										/*	$sql2 = "SELECT members.*, member_photos.photo 
												 FROM member_photos
												 RIGHT JOIN members ON member_photos.member_id=members.id 
												 where 
												 members.member_id = '".$messages[$i]['from_mem']."'";	*/
												 
												  $sql2 = "SELECT members.*,member_photos.photo,replies.* FROM replies,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													  members.member_id = '".$messages[$i]['from_mem']."'";	
												
										 
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[$i]['msg_id'];
										?>
                                  
                                </div>
                                <div class="basicview"  id="accept_div_<?php echo $each_msg[$i]['member_id']."_".$messages[$i]['exp_int_id']; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                           <!-- <input type="checkbox" />-->
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[$i]['name']; ?> <?php echo "(".$each_msg[$i]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete" <?php /*?>onClick="return doYouWantTo('<?php echo $msg_id; ?>','<?php echo $_GET['page']; ?>')"<?php */?>><img src="images/delete-icon.png" /></a></div></div><br />
    <span class="smalltxt">Last Login : 2 hours ago</span><br />
    <p><?php echo $each_msg[$i]['age']; ?> | <?php echo $each_msg[$i]['religion']; ?>: <?php echo $each_msg[$i]['caste']; ?> | Location : <?php echo $each_msg[$i]['city']; ?>, <?php echo $each_msg[$i]['country']; ?>| Education : <?php echo $each_msg[$i]['education']; ?>| Occupation : <?php echo $each_msg[$i]['occupation']; ?></p>
    <a href="view_profile.php?id=<?php echo $each_msg[$i]['id']; ?>">View Full Profile</a>
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
     
                                    
                                        </div>
                                <?php } $j++; ?>
                                    
                                </div>
                                   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "Currently,no any notification for need more info.";
	}
}

if($_GET['hint'] == "need_more_time")
{
	$need_more_info = "select * from need_more_info_time
					   where
					   to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
	$messages = $obj->select($need_more_info);
		
	if(!empty($messages)) {
	?>

Listed here are the members whose interest you have declined.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                   <!-- <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										   $sql2 = "SELECT members.*,member_photos.photo,replies.* FROM replies,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													  members.member_id = '".$messages[$i]['from_mem']."'";		 	 
												
										 
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[$i]['msg_id'];
										?>
                                  
                                </div>
                                <div class="basicview"  id="accept_div_<?php echo $each_msg[$i]['member_id']."_".$messages[$i]['exp_int_id']; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                           <!-- <input type="checkbox" />-->
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[$i]['name']; ?> <?php echo "(".$each_msg[$i]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete" <?php /*?>onClick="return doYouWantTo('<?php echo $msg_id; ?>','<?php echo $_GET['page']; ?>')"<?php */?>><img src="images/delete-icon.png" /></a></div></div><br />
    <span class="smalltxt">Last Login : 2 hours ago</span><br />
    <p><?php echo $each_msg[$i]['age']; ?> | <?php echo $each_msg[$i]['religion']; ?>: <?php echo $each_msg[$i]['caste']; ?> | Location : <?php echo $each_msg[$i]['city']; ?>, <?php echo $each_msg[$i]['country']; ?>| Education : <?php echo $each_msg[$i]['education']; ?>| Occupation : <?php echo $each_msg[$i]['occupation']; ?></p>
    <a href="view_profile.php?id=<?php echo $each_msg[$i]['id']; ?>">View Full Profile</a>
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
     
                                    
                                        </div>
                                <?php } $j++; ?>
                                    
                                </div>
                                   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "Currently,no any notification for need more time.";
	}
}

if($_GET['hint'] == "need_more_info_byme")
{
	$need_more_info = "select * from need_more_info_detail
					   where
					   from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
	$messages = $obj->select($need_more_info);
		
	if(!empty($messages)) {
	?>

Listed here are the members whose interest you have declined.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                   <!-- <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										  
										  		  $sql2 = "SELECT members.*,member_photos.photo,replies.* FROM replies,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													  members.member_id = '".$messages[$i]['to_mem']."'";	 
												
										 
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[$i]['msg_id'];
										?>
                                  
                                </div>
                                <div class="basicview"  id="accept_div_<?php echo $each_msg[$i]['member_id']."_".$messages[$i]['exp_int_id']; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                           <!-- <input type="checkbox" />-->
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[$i]['name']; ?> <?php echo "(".$each_msg[$i]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete" <?php /*?>onClick="return doYouWantTo('<?php echo $msg_id; ?>','<?php echo $_GET['page']; ?>')"<?php */?>><img src="images/delete-icon.png" /></a></div></div><br />
    <span class="smalltxt">Last Login : 2 hours ago</span><br />
    <p><?php echo $each_msg[$i]['age']; ?> | <?php echo $each_msg[$i]['religion']; ?>: <?php echo $each_msg[$i]['caste']; ?> | Location : <?php echo $each_msg[$i]['city']; ?>, <?php echo $each_msg[$i]['country']; ?>| Education : <?php echo $each_msg[$i]['education']; ?>| Occupation : <?php echo $each_msg[$i]['occupation']; ?></p>
    <a href="view_profile.php?id=<?php echo $each_msg[$i]['id']; ?>">View Full Profile</a>
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
     
                                    
                                        </div>
                                <?php } $j++; ?>
                                    
                                </div>
                                   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "Currently,no any notification for need more info.";
	}
}

if($_GET['hint'] == "need_more_time_byme")
{
	$need_more_info = "select * from need_more_info_time
					   where
					   from_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
	$messages = $obj->select($need_more_info);
		
	if(!empty($messages)) {
	?>

Listed here are the members whose interest you have declined.
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
								<div class="title_select_all">
                                   <!-- <input type="checkbox" onclick="selallcheck()" name="selall" class="chkBox">
                                    Select All-->
                                     <?php
									 $j=0; 
									 for($i=0;$i<count($messages);$i++)
									  {
										  
										  	  $sql2 = "SELECT members.*,member_photos.photo,replies.* FROM replies,members 
								  					 LEFT JOIN member_photos ON members.id = member_photos.member_id
								                     where
													  members.member_id = '".$messages[$i]['to_mem']."'";	  
												
										 
										$each_msg = $obj->select($sql2); 
										$msg_id = $each_msg[$i]['msg_id'];
										?>
                                  
                                </div>
                                <div class="basicview"  id="accept_div_<?php echo $each_msg[$i]['member_id']."_".$messages[$i]['exp_int_id']; ?>">
                               <?php
									
										//echo "<br>nm =".$each_msg[0]['name']."<br>"."msg = ".$messages[$i]['message'];
										
										?>
                                     
                                        <div class="showbasiccontent">
                                           <!-- <input type="checkbox" />-->
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
                                            <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[$i]['name']; ?> <?php echo "(".$each_msg[$i]['member_id'].")"; ?></a> <a href="#"><span class="icon phoneicon "></span></a><div class="smalltxt floatr">Received : 20 hours ago <a href="#" class="icon-delete" <?php /*?>onClick="return doYouWantTo('<?php echo $msg_id; ?>','<?php echo $_GET['page']; ?>')"<?php */?>><img src="images/delete-icon.png" /></a></div></div><br />
    <span class="smalltxt">Last Login : 2 hours ago</span><br />
    <p><?php echo $each_msg[$i]['age']; ?> | <?php echo $each_msg[$i]['religion']; ?>: <?php echo $each_msg[$i]['caste']; ?> | Location : <?php echo $each_msg[$i]['city']; ?>, <?php echo $each_msg[$i]['country']; ?>| Education : <?php echo $each_msg[$i]['education']; ?>| Occupation : <?php echo $each_msg[$i]['occupation']; ?></p>
    <a href="view_profile.php?id=<?php echo $each_msg[$i]['id']; ?>">View Full Profile</a>
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
     
                                    
                                        </div>
                                <?php } $j++; ?>
                                    
                                </div>
                                   
                                <ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>&nbsp; of &nbsp;</li><li class="inactive"><a href="#">1</a></li></ul>
    <?php
	}
	else
	{
		echo "Currently,no any notification for need more time.";
	}
}


?>
<script>
//on need more time click
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
	
//on need more info click
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
						$('#id_'+exploded[2]+"_"+exploded[3]).html("Member has been notified that you're not interested.");
						$('#id_'+exploded[2]+"_"+exploded[3]).css('color','green');
						$("#not_int_"+exploded[2]+"_"+exploded[3]).css('display','none');
						$("#rpl_"+exploded[2]+"_"+exploded[3]).css('display','none');
					}					
			});
		 
	});
	
//on click accept interest
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

//on click not interested interest	
$('.not_int_interest').click(function() {
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
						$('#accdept_'+exploded[2]+"_"+exploded[3]).html("Member has been notified that you're not interested.");
						$('#accdept_'+exploded[2]+"_"+exploded[3]).css('color','green');
						$("#not_int_"+exploded[2]+"_"+exploded[3]).css('display','none');
						$("#rpl_"+exploded[2]+"_"+exploded[3]).css('display','none');
					}
					
			});
		 
	});
	
	
function doYouWantToDeleteInt(id){

	 doIt=confirm('Are you sure you want to delete this message?');
	  if(doIt){
			  window.location.href = 'my_account.php?int_id='+id;		
	  }
	  else{ 
		  return false;
	  }
	  return true;
}
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
	
