<?php
session_start();
include('lib/myclass.php');
include('class.paging.php');

if($_SESSION['UserEmail']!='')
{
	$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$_SESSION['logged_user'][0]['id']."' AND members.id=member_plans.member_id";
	$db_member_plan=$obj->select($select_member_plan);
	
	$exp_date=date('Y-m-d');
	
	if(count($db_member_plan)>0)
	{
		$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
		$db_plan=$obj->select($select_plan);
		
		$exp_date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_date[0]['reg_date']));
	}

	if(count($db_member_plan)>0 && date('Y-m-d',strtotime($exp_date))>=date('Y-m-d'))
	{
		include('include/chat.php'); 
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<title>Matrimonial</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php if($_SESSION['UserEmail']=='' || (count($db_member_plan)==0 && date('Y-m-d',strtotime($exp_date))<=date('Y-m-d'))){ ?>
<script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
<?php } ?>
  <script type="text/javascript" src="assets/js/lightbox.js"></script>
  <link rel="stylesheet" href="css/colorbox.css" />
  
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery.accordion.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		/*$('.list-toggle').find('h3').click(function(e) {
            $(this).next('ul').toggle('slow');
        });*/
		$("#acc-list").accordion({
			alwaysOpen: false,
			header: '.sidebar-cont > .list-toggle h3'
		});
	});
</script>
<script>
		var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
		s.parentNode.insertBefore(g,s)}(document,"script"));
	</script>
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
		</script>-->
<script type="text/javascript">
$(document).ready(function(){
	$("ul.profl-list li:nth-child(4n+1)").addClass("first");
	return false;
});
</script>
<script src="js/jquery.easytabs.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready( function() {
      $('#tab-container').easytabs();
    });
</script>
<link rel="stylesheet" href="css/colorbox.css" />
<script src="js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, maxWidth:"900px;"});
		$(".ajax").colorbox({innerWidth:"500px;", maxWidth:"500px;"});
		$(".ajax1").colorbox({innerWidth:"450px;", maxWidth:"450px;", innerHeight:"200px;"});
		$(".ajax3").colorbox({innerWidth:"450px;", maxWidth:"450px;"});
	});	
</script> 
</head>
<body>

<div class="topMain">
	<div class="wrapper">
    	<?php include('include/header.inc.php'); ?>
        <?php include('include/slider1.inc.php'); ?>
		<div class="header inn" style="display:none">
        	<div class="titlebox">
            	<h2>Search</h2>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
	<div  class="mid col-md-12 col-sm-12 col-xs-12 nopadding">
    <?php include('include/edit_profile_top.inc.php'); ?>
    <?php include('include/profile_leftbar.inc.php'); ?>
	<?php include('include/save_search_listing.inc.php'); ?>
     </div>
     <?php include('include/footer.inc.php'); ?>
</div>

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
	
	</script>

</body>
</html>