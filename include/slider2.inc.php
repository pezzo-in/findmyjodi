<?php
$sql_login = "SELECT members.*,member_photos.photo,member_photos.Approve FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.id = '".$_GET['id']."'";	
	$logged_in_member=$obj->select($sql_login);
	
$select_cover_img = "SELECT * FROM member_photo_gallery WHERE member_id = '".$_GET['id']."'";	
$db_cover_img=$obj->select($select_cover_img);
$cover_img='';
for($i=0;$i<count($db_cover_img);$i++)
{
	if($db_cover_img[$i]['Cover_photo']==1)
	{
		$cover_img=$db_cover_img[$i]['photo'];
	}
}
?>
<div class="header">
	<?php 
	if($cover_img!=''){ 
		//$img_path=str_replace('crop_','',$cover_img);
		list($width, $height, $type, $attr) = getimagesize("upload/".$cover_img);
	if($width>999 || $height >431)
	
{ ?>
	<img src="timthumb.php?src=<?php echo $obj->SITEURL; ?>upload/<?php echo $cover_img; ?>&amp;w=999&amp;h=431"/>
 	<?php }else{ ?>
	 <img src="upload/<?php echo $cover_img; ?>" width="999px" height="431px"  />
	
    <?php } }else{ ?>
	<img src="images/header_img1.jpg"  />
    <?php } ?>
     <div class="searchbox profilebox col-md-12 col-sm-12 col-xs-12">
		<div class="timeline-thumb"><a href="#">
        <?php
			if(!empty($logged_in_member[0]['photo']) AND $logged_in_member[0]['Approve'] == 1)
			{
				//$path =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/".$logged_in_member[0]['photo'];
				$path = "upload/".$logged_in_member[0]['photo'];
				if (file_exists($path)) {
					
					list($width, $height, $type, $attr) = getimagesize($path);
					$newwidth = 130;
					$newheight = ($height * 130)/$width;
					list($width1, $height1, $type1, $attr1) = getimagesize(str_replace('crop_','',$path));
					if($width1 > 200)
					{						
						$height1 = (($height1*200)/$width1);
						$width1 = 200;
					}
					else
					{						
						$width1 = (($width1*200)/$height1);
						$height1 = 200;
					}
					echo '<a href="javascript:;" class="popper_profile" data-popbox="pop_profile"><img class="size" src="'.$path.'"  width="'.$newwidth.'" height="'.$newheight.'" style="width:130px;height:130px;" />';
					echo '<div id="pop_profile" class="popbox"><img src="'.$path.'" width="'.$width1.'"  height="'.$height1.'" /></div></a>';
				}
				else{
					if($logged_in_member[0]['gender']=='M')
						echo '<img  class="" src="'."images/male-user1.png".' width="130" height="130""/>';
					else
						echo '<img  class="" width="130" height="130" src="'."images/female-user1.png".'"/>';
				}
			}
			else{
					if($logged_in_member[0]['gender']=='M')
						echo '<img  class="" width="130" height="130" src="'."images/male-user1.png".'"/>';
					else
						echo '<img  class="" width="130" height="130" src="'."images/female-user1.png".'"/>';
				}?>
        
        <!--<img src="images/timeline-thumb.jpg" />--></a></div>
        <ul class="list-prfl">
        	<li><a href="timeline.php?id=<?php echo $_GET['id']; ?>">Timeline</a></li>
            <li><a href="view_profile.php?id=<?php echo $_GET['id']; ?>">Profile</a></li>
<?php
$select_member_id = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
$db_select_member_id = $obj->select($select_member_id);
$select_followers = "select tbl_user_followers.* from tbl_user_followers right join members on tbl_user_followers.UserId=members.id  where tbl_user_followers.FollowerId = '".$_GET['id']."'";
$db_followers = $obj->select($select_followers);
$select_following = "select tbl_user_followers.* from tbl_user_followers right join members on tbl_user_followers.FollowerId=members.id where UserId = '".$_GET['id']."'";
$db_following = $obj->select($select_following);
?>
<li><a href="<?php if(count($db_followers)>0) { ?>followers.php?id=<?php echo $_GET['id']; ?> <?php }else { ?>javascript:void(0); <?php } ?>">Followers</a><span><?php echo count($db_followers); ?></span></li>
            <li><a href="<?php if(count($db_following)>0) { ?>following.php?id=<?php echo $_GET['id']; ?><?php }else { ?>javascript:void(0); <?php } ?>">Following</a><span><?php echo count($db_following); ?></span></li>
            
            <li><a href="gallery.php?id=<?php echo $_GET['id']; ?>">Album</a></li>
            <!--<li><a href="#"><img src="images/notifi-icon.png" /><span class="total-noti">0</span></a></li>-->
            <?php
			$select_follow = "select * from tbl_user_followers where UserId = '".$db_select_member_id[0]['id']."' AND FollowerId = '".$_GET['id']."'";
			$db_follow = $obj->select($select_follow);
			if(count($db_follow) > 0) {
			?>
            <li style="float:right"><a href="followers.php?id=<?php echo $_GET['id']; ?>&status=unfollow" class="following-btn"></a></li>
            <?php } else { ?>
            <li style="float:right"><a href="followers.php?id=<?php echo $_GET['id']; ?>&status=follow" class="follow-btn"></a></li>
			<?php } ?>
        </ul>
        <?php /*?><form method="post" name="search_form" action="search_list.php">
            <div class="rdGender" style="font-size:15px;float:left;">
                <input type="radio" name="drpLookingFor" id="drpLookingFor" value="M" style="padding-left:15px" /><label>&nbsp;Groom&nbsp;&nbsp;</label>
                <input type="radio" name="drpLookingFor" id="drpLookingFor" value="F" checked="checked" /><label>&nbsp;Bride&nbsp;&nbsp;</label>
            </div>
            <span style="float:left; margin:0;font-size:15px;">Age</span>
            <div class="select-age" id="age_from" style="margin:-5px 0 0 10px">
                <select name="drpAgeFrom" id="drpAgeFrom">
					<?php for($i=18;$i<=50;$i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>                    
                </select>
            </div>
            <span style="margin:0 10px;font-size:15px;">to</span>
            <div class="select-age" id="age_to" style="margin:-5px 0 0 0px">
			 <select name="drpAgeTo" id="drpAgeTo">
             	<?php for($i=19;$i<=50;$i++) { ?>
            	   <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>   
             </select>     
            </div>
           
               <?php
				$caste_list = "select * from caste";
				$data = $obj->select($caste_list);
		    ?>
            <div class="select-gender select-country" style="margin:-5px 10px">
                <select name="drpCaste" id="drpCaste">
                	<option value="">Caste</option>
                	<?php foreach($data as $res) { ?>
                    <option value="<?php echo $res['caste']; ?>"><?php echo $res['caste']; ?></option>
                    <?php } ?>
                </select>
            </div>
          
            <?php
				$lang_list = "select * from mother_tongues";
				$data = $obj->select($lang_list);
			?>
            <div class="select-gender select-country" style="margin:-5px 0px">
                <select name="drpLang" id="drpLang">
                <option value=""> Mother Tongue</option>
                    <?php foreach($data as $res) { ?>
                    		<option value="<?php echo $res['name']; ?>"><?php echo $res['name']; ?></option>
                    <?php } ?>
                    
                </select>
            </div>
            
            <input type="submit" class="searchnow-btn" name="submit" style="margin:-8px -4px 0 0" />
        </form><?php */?>
    </div>
</div>
<script>
$('#drpGender').change( function() {
			var val = $('#drpGender').val();
			if(val == 'M')
			{
				$("#drpLookingFor").val("F");
			}else
			{
				$("#drpLookingFor").val("M");
			}
		});	
$('#drpLookingFor').change( function() {
			var val = $('#drpLookingFor').val();
			if(val == 'M')
			{
				$("#drpGender").val("F");
			}else
			{
				$("#drpGender").val("M");
			}
		});	
$('.rdGender').change( function() {
	
	var gender = $('input[name=drpLookingFor]:checked').val();	
	if(gender == 'M')
	{
		var age_from = "20"; 
	}
	else
	{
		var age_from = "17";
	}
	$.ajax({
				url: 'makeAgeDrp.php',
				dataType: 'html',
				data: { drpFor :"age_from",age_from : age_from },
				success: function(data) {
					$('#age_from').html( data );
					var from = $('#drpAgeFrom').val();
						$.ajax({
	
						url: 'makeAgeDrp.php',
		
						dataType: 'html',
		
						data: {age_from : from},
		
						success: function(data) {
							$('#age_to').html( data );
		
						}
	
				});	
				}
			});	
});
$('#drpAgeFrom').change( function() {
	
	var age_from = $('#drpAgeFrom').val();
			$.ajax({
				url: 'makeAgeDrp.php',
				dataType: 'html',
				data: { age_from : age_from },
				success: function(data) {
					$('#age_to').html( data );
				}
			});	
});
</script>
<script>
	$(function() {
		var moveLeft = 0;
		var moveDown = 0;
		$('a.popper_profile').hover(function(e) {
	   
			var target = '#' + ($(this).attr('data-popbox'));
			 
			$(target).show();
			moveLeft = $(this).outerWidth();
			moveDown = ($(target).outerHeight() / 2);
		}, function() {
			var target = '#' + ($(this).attr('data-popbox'));
			$(target).hide();
		});
	 
		$('a.popper_profile').mousemove(function(e) {
			var target = '#' + ($(this).attr('data-popbox'));
			 
			//leftD = e.pageX + parseInt(moveLeft);
			leftD = 136;
			maxRight = leftD + $(target).outerWidth();
			windowLeft = $(window).width() - 40;
			windowRight = 0;
			maxLeft = e.pageX - (parseInt(moveLeft) + $(target).outerWidth() + 20);
			 
			if(maxRight > windowLeft && maxLeft > windowRight)
			{
				leftD = maxLeft;
			}
			topD = -37;
			maxBottom = parseInt(e.pageY + parseInt(moveDown) + 20);
			windowBottom = parseInt(parseInt($(document).scrollTop()) + parseInt($(window).height()));
			maxTop = topD;
			windowTop = parseInt($(document).scrollTop());
			/*if(maxBottom > windowBottom)
			{
				topD = windowBottom - $(target).outerHeight() - 20;
			} else if(maxTop < windowTop){
				alert(windowTop);
				topD = windowTop + 20;
			}*/
			$(target).css('top', topD).css('left', leftD);
		 
		 
		});
	 
	});
	</script>
<style>
.rdGender label {
    padding-right: 9px;
}
/*.profilebox .popbox{ top:auto !important; bottom:0 !important; }*/
</style>