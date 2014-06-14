<?php
session_start();
include('lib/myclass.php');
?>
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

<?php
	$select_new_msgs = "select photo_request.*, photo_request.Id as photo_request_id from photo_request,members where photo_request.To_mem_id = '".$_SESSION['logged_user'][0]['id']."' AND members.id=photo_request.From_mem_id AND members.is_profile_active='Y' order by photo_request.Id DESC";
	$messages = $obj->select($select_new_msgs);
?>
<?php
	for($i=0;$i<count($messages);$i++)
	{
		$sql2 = "SELECT members.*,members.id as mem_id,member_photos.photo,messages.id as msg_id,messages.* FROM messages,members LEFT JOIN member_photos ON members.id = member_photos.member_id where members.id = '".$messages[$i]['From_mem_id']."'";
		$each_msg = $obj->select($sql2); 							
		$msg_id = $each_msg[0]['msg_id'];
?>

<div class=""> <!--basicview-->
  <div class="showbasiccontent">
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
      <div class="row-top"><a href="#" class="floatl"><?php echo $each_msg[0]['name']; ?> (<?php echo $each_msg[0]['member_id']; ?>)</a> <a href="#"><span class="icon phoneicon "></span></a>
        <div class="smalltxt floatr">Received : 20 hours ago <!--<a href="#" class="icon-delete"><img src="images/delete-icon.png" /></a>--></div>
      </div>
      <br />
      <span class="smalltxt">Last Login : 2 hours ago</span><br />
      <p><?php echo $each_msg[0]['age']; ?> Yrs, <?php echo $each_msg[0]['height']." Inch" ?> | <?php echo $each_msg[0]['religion']; ?>: <?php echo $each_msg[0]['caste']; ?> | Location : <?php echo $each_msg[0]['city']; ?>, <?php echo $each_msg[0]['country']; ?> | Education : 
	  <?php
			$select_education="select * from education_course where Id='".$each_msg[0]['education']."'";
			$db_education=$obj->select($select_education);
			echo $db_education[0]['Title'];
			?>
	  <?php if($each_msg[0]['occupation'] != "") { ?> | Occupation : <?php echo $each_msg[0]['occupation'];  } ?></p>
      <a href="view_profile.php?id=<?php echo $each_msg[0]['mem_id']; ?>">View Full Profile</a> </div>
  </div>
</div>
<?php } ?>
<?php
if(count($messages)==0)
{
	echo '<br /><h3>Currently You have no any Photo Request by anyone</h3>';
}
?>
