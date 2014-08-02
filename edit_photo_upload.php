<?php
session_start();
include('lib/myclass.php');
include('simpleimage.php');
if($_SESSION['UserEmail']=='')
{
	echo "<script>window.location='login.php' </script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<title>Upload your photo</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
  <!--<script type="text/javascript" src="assets/css/lightbox.css"></script> 
  <script type="text/javascript" src="assets/images/close.png"></script> 
  <script type="text/javascript" src="assets/images/loading.gif"></script> 
  <script type="text/javascript" src="assets/images/next.png"></script> -->
<link rel="stylesheet" href="css/colorbox.css" />
<!-- <link rel="stylesheet" href="assets/css/colorbox.css" />-->
<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1"/>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
</head>
		
<body>
<?php
include("common_user_fetch.php");
/*if($_SESSION['UserEmail']!='')
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
}*/
?>
<?php if(count($db_member_plan)==0){ ?>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script src="js/jquery.min.js"></script>
<?php } ?>
   
<!--<script src="js/jquery.min.js"></script>-->
<script src="js/jquery.Jcrop.js"></script>
<script language="Javascript">
	function test()
	{
		var jcrop_api,
        boundx,
        boundy,
        // Grab some information about the preview pane
        $preview = $('#preview-pane'),
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),
        xsize = $pcnt.width(),
        ysize = $pcnt.height();
    	
	    console.log('init',[xsize,ysize]);
		
		$(function(){
			if(document.getElementById('photo_type').value=='Profile')
			{
				$('#cropbox').Jcrop({
					//setSelect:   [ 200, 200, 50, 50 ],
					//onChange: updatePreview,
					//aspectRatio: 1,
					//onSelect: updateCoords
					onChange: updatePreview,
					onSelect: updatePreview,
					setSelect: [10,10,160,160],
					minSize: [150, 150],
					//maxSize: [150, 150],
					aspectRatio: 0
					//aspectRatio: xsize / ysize
				},function(){
				  // Use the API to get the real image size
				  var bounds = this.getBounds();
				  boundx = bounds[0];
				  boundy = bounds[1];
				  // Store the API in the jcrop_api variable
				  jcrop_api = this;
			
				  // Move the preview into the jcrop container for css positioning
				  $preview.appendTo(jcrop_api.ui.holder);
				});
			}
			else
			{
				$('#cropbox').Jcrop({
					//setSelect:   [ 200, 200, 50, 50 ],
					//onChange: updatePreview,
					//aspectRatio: 1,
					//onSelect: updateCoords
					onChange: updatePreview,
					onSelect: updatePreview,
					aspectRatio: xsize / ysize
				},function(){
				  // Use the API to get the real image size
				  var bounds = this.getBounds();
				  boundx = bounds[0];
				  boundy = bounds[1];
				  // Store the API in the jcrop_api variable
				  jcrop_api = this;
			
				  // Move the preview into the jcrop container for css positioning
				  $preview.appendTo(jcrop_api.ui.holder);
				});
			}
		});
	
		function updateCoords(c)
		{	  
			$('#x').val(c.x);
			$('#y').val(c.y);
			$('#w').val(c.w);
			$('#h').val(c.h);
			
			if (parseInt(c.w) > 0)
			{
				var rx = xsize / c.w;
				var ry = ysize / c.h;
				$pimg.css({
				  width: Math.round(rx * boundx) + 'px',
				  height: Math.round(ry * boundy) + 'px',
				  marginLeft: '-' + Math.round(rx * c.x) + 'px',
				  marginTop: '-' + Math.round(ry * c.y) + 'px'
				});
			}
		};
		
		function updatePreview(c)
		{
			$('#x').val(c.x);
			$('#y').val(c.y);
			$('#w').val(c.w);
			$('#h').val(c.h);
		  if (parseInt(c.w) > 0)
		  {
			var rx = xsize / c.w;
			var ry = ysize / c.h;
	
			$pimg.css({
			  width: Math.round(rx * boundx) + 'px',
			  height: Math.round(ry * boundy) + 'px',
			  marginLeft: '-' + Math.round(rx * c.x) + 'px',
			  marginTop: '-' + Math.round(ry * c.y) + 'px'
			});
		  }
		}
	
		function checkCoords()
		{
			if (parseInt($('#w').val())) return true;
			alert('Please select a crop region then press submit.');
			return false;
		};
	}
	function checkCoords()
	{
		if (parseInt($('#w').val())) return true;
		alert('Please select a crop region then press submit.');
		return false;
	};
</script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
	$(function() {
		var dates = $( "#dob" ).datepicker({
			changeYear: true,
			changeMonth: true,
			numberOfMonths: 1,
							});
	});
</script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery.accordion.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#acc-list").accordion({
			alwaysOpen: false,
			header: '.sidebar h3'
		});
	});
</script>
<!--<script src="js/jquery.colorbox.js"></script>-->
<script>
	/*$(document).ready(function(){
		$(".inline").colorbox({inline:true, maxWidth:"900px"});
	});*/
</script> 
<script>
		var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
		s.parentNode.insertBefore(g,s)}(document,"script"));
	</script>
<script type="text/javascript">
$(document).ready(function(){
	$("ul.profl-list li:nth-child(3n+1)").addClass("first");
	return false;
});
</script> 
<script src="js/jquery.easytabs.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready( function() {
      $('#tab-container').easytabs();
    });
</script>
<script>
var $=jQuery.noConflict();
</script>
<div class="container">
    <div class="row">
        <div class="topMain col-md-12 col-sm-12 col-xs-12 nopadding">
            <div class="wrapper col-md-12 col-sm-12 col-xs-12 nopadding">
    	<?php include('include/header.inc.php'); ?>
        <?php include('include/slider1.inc.php'); ?>
                <div class="header inn">
                    <div class="titlebox col-md-12">
            	Edit Profile
            </div>
        </div>
    </div>
</div>
    <div class="col-md-12 mid">
        <div class="wrapper col-md-12 col-sm-12 col-xs-12 nopadding">
	   	 <?php include('include/edit_profile_top.inc.php'); ?>
         <?php include('include/profile_leftbar.inc.php'); ?>
		 <?php include('include/edit_photo_upload.inc.php'); ?>
	</div>
     <?php include('include/footer.inc.php'); ?>
</div>
</div>
</div>
<script>
	$(function() {
		var moveLeft = 0;
		var moveDown = 0;
		$('a.popper').hover(function(e) {
			var target = '#' + ($(this).attr('data-popbox'));
			$(target).show();
			moveLeft = $(this).outerWidth();
			moveDown = ($(target).outerHeight() / 2);
		}, function() {
			var target = '#' + ($(this).attr('data-popbox'));
			$(target).hide();
		});
	 
		$('a.popper').mousemove(function(e) {
			var target = '#' + ($(this).attr('data-popbox'));
			 
			//leftD = e.pageX + parseInt(moveLeft);
			leftD = e.pageX + 30;
			maxRight = leftD + $(target).outerWidth();
			windowLeft = $(window).width() - 40;
			windowRight = 0;
			maxLeft = e.pageX - (parseInt(moveLeft) + $(target).outerWidth() + 20);
			 
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
	});
	</script>
    <script src="js/jquery.colorbox.js"></script>
	<script>
		$(document).ready(function(){
			$(".inline").colorbox({inline:true, initialWidth:"1000px;"});
			$(".cover_error").colorbox({innerWidth:"500px;", maxWidth:"500px;", innerHeight:"130px;", height:"130px;", xhrError: "Please First Select picture and make it Cover Picture."});
			$(".cover_delete").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Please First Select picture."});
		});
	</script>
</body>
</html>
