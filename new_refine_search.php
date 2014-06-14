<?php session_start(); ?>
<html>
<head>
<link rel="shortcut icon" href="images/favicon.ico" />
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
		$(".ajax").colorbox({innerWidth:"500px;", maxWidth:"500px;"});
	});
</script> 
		<script>
			<?php /*?>$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox({innerWidth:"500px;", maxWidth:"500px;"});
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
			});<?php */?>
		</script>
        
        <script>
	/*$(function() {
		var moveLeft = 0;
		var moveDown = 0;
		$('img.popper').hover(function(e) {
	   
			var target = '#' + ($(this).attr('data-popbox'));
			 
			$(target).show();
			moveLeft = $(this).outerWidth();
			moveDown = ($(target).outerHeight() / 2);
		}, function() {
			var target = '#' + ($(this).attr('data-popbox'));
			$(target).hide();
		});
	 
		$('img.popper').mousemove(function(e) {
			var target = '#' + ($(this).attr('data-popbox'));
			 
			//leftD = e.pageX + parseInt(moveLeft);
			leftD = e.pageX + 50;
			maxRight = leftD + $(target).outerWidth();
			windowLeft = $(window).width() - 40;
			windowRight = 0;
			//maxLeft = e.pageX - (parseInt(moveLeft) + $(target).outerWidth() + 20);
			maxLeft = e.pageX - ($(target).outerWidth() + 50);
			 
			if(maxRight > windowLeft && maxLeft > windowRight)
			{
				leftD = maxLeft;
			}
		 
			topD = e.pageY - parseInt(moveDown);
			maxBottom = parseInt(e.pageY + parseInt(moveDown) + 20);
			windowBottom = parseInt(parseInt($(document).scrollTop()) + parseInt($(window).height()));
			maxTop = topD;
			windowTop = parseInt($(document).scrollTop());
			if(maxBottom > windowBottom)
			{
				topD = windowBottom - $(target).outerHeight() - 20;
			} else if(maxTop < windowTop){
				topD = windowTop + 20;
			}
		 
			$(target).css('top', topD).css('left', leftD);
		 
		 
		});
	 
	});*/
	
	$(document).ready(function(e) {
        $('.list_view').click(function(e) {
			$('.profl-list').fadeOut('slow','',function(){
				$('.profl-list').addClass('thumb_view');	
				$('.profl-list').fadeIn('slow');
			});
		});
		$('.grid_view').click(function(e) {
			$('.profl-list').fadeOut('slow','',function(){
				$('.profl-list').removeClass('thumb_view');	
				$('.profl-list').fadeIn('slow');
			});
		});
    });
	
	$(document).ready(function(){
		$("ul.profl-list li:nth-child(4n+1)").addClass("first");
		return false;
	});
	</script>
    
    <style>
	ul.profl-list li{ position:inherit !important; }
	ul.profl-list li .profile-img-box{ position:inherit !important }
	.profile-img-box{ position:inherit !important; }
	</style>
</head>
</html>
<?php

include('lib/myclass.php');
$val=explode('@',htmlspecialchars($_POST['val']));

if($val[0]=='day')
{
	if($val[1]=='within_day')
		$sql="SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id where is_deleted = 'N' and month = '".(date('m'))."' and day = '".date('d')."' and status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
	if($val[1]=='within_month')
		$sql="SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id where is_deleted = 'N' and month = '".(date('m'))."' and status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
	if($val[1]=='within_year')
		$sql="SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id where is_deleted = 'N' and year = '".(date('Y'))."' and status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
	
}

if($val[0]=='age')
{
	$age=explode('_',$val[1]);
	if(count($age)==2)
	{
		$sql = "SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE members.age between ".$age[0]." and ".$age[1]." and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
	}
	else
	{
		$sql = "SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE members.age > ".$age[0]." and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
	}
}

if($val[0]=='Marital')
{
	$sql = "SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE members.relationship_status = '".$val[1]."' and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
}

if($val[0]=='star')
{
	$sql = "SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE members.star = '".$val[1]."' and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
}

if($val[0]=='occupation')
{
	$sql = 'SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE members.occupation = "'.$val[1].'" and members.status = "Active" AND members.id!="'.$_SESSION['logged_user'][0]['id'].'"';
}

if($val[0]=='complexion')
{
	$sql = "SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE members.complexion = '".$val[1]."' and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
}

if($val[0]=='manglik')
{
	$sql = "SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE members.manglik_dosham = '".$val[1]."' and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
}

if($val[0]=='religion')
{
	$sql = "SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE members.religion = '".$val[1]."' and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
}
//echo $sql;
$members=$obj->select($sql);

if(count($members)!=0)
				{ ?>
                
             <div class="mid_top_checkbox" style="clear: both;margin: 19px;float: right;margin-top: 0;"><a href="javascript:;" class="list_view">List View</a><a href="javascript:;" class="grid_view">Grid View</a></div><br clear="all" />
                
        	<ul class="profl-list"> <!-- thumb_view -->
            <?php
					foreach($members as $res) { ?>
            	<li>
                    <div class="profile-img-box">
                    <a href="view_profile.php?id=<?php echo $res['id']; ?>" class="popper" data-popbox="pop<?php echo $res['id']; ?>">
                        <?php
						if(!empty($res['photo']) && $res['Approve']==1)
						{
						 	//$path =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/".$members[0]['photo'];
							$path = "upload/".$res['photo'];
							if (file_exists($path)) {
									//echo '<a href="javascript:;" class="popper" data-popbox="pop'.$res['id'].'"><img src="'.$path.'" class="profile_pic" style="width:152px;height:161px;" /></a>'; 
									echo '<img title="click here to upload photo" data-popbox="pop'.$res['id'].'" class="profile_pic popper" src="'.$path.'" />';
									echo '<div id="pop'.$res['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" /></div>';
									//echo '<div id="pop'.$res['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" /></div>';
							}
							else{
								if($res['gender']=='M')
									echo '<img title="click here to upload photo" class="profile_pic" src="images/male-user1.png" />';
								else
									echo '<img title="click here to upload photo" class="profile_pic" src="images/female-user1.png" />';
							}
						}
						else{
								if($res['gender']=='M')
									echo '<img title="click here to upload photo" class="profile_pic" src="images/male-user1.png" />';
								else
									echo '<img title="click here to upload photo" class="profile_pic" src="images/female-user1.png" />';
							}?>
                            
                        
                        <div class="griddetail">
                        	<div><b><?php echo $res['name']; ?></b></div>
							<div><?php echo $res['age'] ?> <?php if($res['height'] != '') { ?> / <?php echo $res['height']; } ?></div>
						</div>
						<div class="listdetail">
                        	<div><label>Name : </label><?php echo $res['name']; ?></div>
							<div><label>Age / Height : </label><?php echo $res['age'] ?> / <?php echo $res['height']; ?></div>
                            <div><label>Religion : </label><?php echo $res['religion'] ?></div>
                            <div><label>Caste / Subcaste : </label><?php echo $res['caste'] ?> / <?php echo $res['subcaste'] ?></div>
                            <div><label>Location : </label><?php if($res['city'] != '') { echo $res['city'].", "; } ?><?php if($res['state'] != '') { echo $res['state'].", "; } ?><?php if($res['country'] != '') { echo $res['country']; } ?></div>
                            <div><label>Education : </label><?php echo $res['education'] ?></div>
                            <div><label>Occupation : </label><?php echo $res['occupation'] ?></div>
						</div>
</a>
						<div class="goto">
                        	<?php
							if($_SESSION['logged_user'][0]['member_id']!='')
							{
								$select_express_intrest="select * from express_interest where from_mem='".$_SESSION['logged_user'][0]['member_id']."' AND to_mem='".$res['member_id']."'";
								$db_express_intrest=$obj->select($select_express_intrest);
								if(count($db_express_intrest)==0){
								?>
								<a href="include/express_interest.php?to_mem_id=<?php echo $res['member_id']; ?>&from_mem_id=<?php echo $_SESSION['logged_user'][0]['member_id']; ?>&site=second" class="icon-heart"></a>
								<?php }else{ ?>
								<a href="javascript:;" onclick="alert('Already sent Intrest.')" class="icon-heart"></a>                            
								<?php } ?>
								<a href="javascript:;" class="icon-gift"></a>
								<a href="include/send_message.php?id=<?php echo $res['id']; ?>&email=<?php echo $res['email_id']; ?>&to_mem_id=<?php echo $res['member_id']; ?>" class="icon-mail ajax send_email_btn"></a>
								<a href="javascript:;" class="icon-chat"></a>
                           <?php 
							}else{
							?>
								<a href="login.php" class="icon-heart"></a>                            
								<a href="login.php" class="icon-gift"></a>
								<a href="login.php" class="icon-mail"></a>
								<a href="login.php" class="icon-chat"></a>
                            <?php } ?>
						</div>
                        
                        <div class="goto" style="display:none">
                            <a href="javascript:;" class="icon-heart"></a>
                            <?php /*?><a href="#" class="icon-mail"></a><?php */?>
                             <a href="include/express_interest.php?to_mem_id=<?php echo $res['member_id']; ?>&from_mem_id=<?php echo $_SESSION['logged_user'][0]['member_id']; ?>&site=second">| EI</a>
                           <a class="ajax send_email_btn" href="include/send_message.php?id=<?php echo $res['id']; ?>&email=<?php echo $res['email_id']; ?>&to_mem_id=<?php echo $res['member_id']; ?>">MSG</a>
                           <?php /*?> <a href="#" class="icon-chat"></a><?php */?>
                        </div>
                    </div>
                </li>
                <?php } 
				?>
            </ul>
            <?php }  
			else
			{
				echo "Sorry, No Matches found"; ?>
			<?php } ?>
<script>
function doYouWantTo(id,acc){

	 doIt=confirm('Are you sure you want to delete this message?');
	 
	  if(doIt){
	  	if(acc == "my_account.php")
		{
			window.location.href = 'my_account.php?id='+id;
		}
		else if(acc == "del_reply")
		{
			window.location.href = 'my_account.php?reply_msg_id='+id;
		}
		else
		{
			window.location.href = 'all_notifications.php?id='+id;
		}
	  }
	  else{ 
		  return false;
	  }
	  return true;
	}

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
		

		/*$('#new_msg').click( function() {
			 var ids = this.id;
			 var exploded = ids.split('_');
			$.ajax({
				   type: "GET",		
				   url: 'include/refine_search.php?hint=new_msg',
				   success: function(data) {
					   $('.content').html( data );
					 	$('#id_'+exploded[2]+"_"+exploded[3]).html("Member has been notified that you're not interested.");						
				   }
				});
		});*/
		$('#replied').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/refine_search.php?hint=replied',
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
						$('#accdept_'+exploded[2]+"_"+exploded[3]).html("Member has been notified that you're not interested.");
						$('#accdept_'+exploded[2]+"_"+exploded[3]).css('color','green');
						$("#not_int_"+exploded[2]+"_"+exploded[3]).css('display','none');
						$("#rpl_"+exploded[2]+"_"+exploded[3]).css('display','none');
					}
					
			});
		 
	});
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
</script>
	
