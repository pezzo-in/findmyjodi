<?php
session_start();
include('lib/myclass.php');
if($_SESSION['UserEmail']=='')
{
	echo "<script>window.location='login.php' </script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<title>Matrimonial</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
  <!--<script type="text/javascript" src="assets/css/lightbox.css"></script> 
  <script type="text/javascript" src="assets/images/close.png"></script> 
  <script type="text/javascript" src="assets/images/loading.gif"></script> 
  <script type="text/javascript" src="assets/images/next.png"></script> -->
  <link rel="stylesheet" href="assets/css/colorbox.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
		$(".inline").colorbox({inline:true, maxWidth:"900px"});
	});
</script> 
<script>
		var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
		s.parentNode.insertBefore(g,s)}(document,"script"));
	</script>
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
<div class="topMain">
	<div class="wrapper">
    	<?php include('include/header.inc.php'); ?>
		<?php include('include/slider1.inc.php'); ?>
		<div class="header inn" style="display:none">
        	<div class="titlebox">
            	<h2>Sent Replies</h2>
                
               
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
	<div class="mid">
    	 <?php include('include/edit_profile_top.inc.php'); ?>
         <?php include('include/profile_leftbar.inc.php'); ?>
		 <?php include('include/sent_replies.inc.php'); ?>
    </div>
     <?php include('include/footer.inc.php'); ?>
</div>


<div style='display:none'>
    <div id='upload_photo' style='padding:10px; background:#fff;'>
    	<form enctype="multipart/form-data" method="post" action="edit_profile.php" >
            <div class="new_acc">
            <p><strong><h3>Upload Your Photo</h3></strong></p>
            <?php
			if (file_exists($path)) { 
			echo '<img title="click here to upload photo" class="profile_pic" src="'.$path.'" style="width:75px;" />';
			}			
			else if($_SESSION['logged_user'][0]['gender']=='M')
				echo '<img title="click here to upload photo" class="profile_pic" src="'."images/male-user2.png".'"/>';
			else
				echo '<img title="click here to upload photo" class="profile_pic" src="'."images/female-user2.png".'"/>';
			?><br /><br />
            <input type="file" name="file[]" multiple="true" class="span6 m-wrap required" id="file" style="color:black" /><br />
            <input type="submit" name="upload" value="Upload" style="padding:5px">	
            </div>
        </form>
    </div>
</div>

<div style='display:none'>
    <div id='parent_number' style='padding:10px; background:#fff;'>
    	<form method="post" action="edit_profile.php" >
            <p><strong><h3>Parents' Contact Number</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>Contact Number</label>
                    <input type="text" value="" id="parent_number" name="parent_number">
                 </div>
                 <input type="submit" name="parent_form" value="parent_form">
			</div>            
        </form>
    </div>
</div>


<div style='display:none'>
    <div id='refenece' style='padding:10px; background:#fff;'>
    	<form method="post"action="edit_profile.php" >
            <p><strong><h3>Reference</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>Reference</label>
                    <input type="text" value="" id="Reference" name="Reference">
                 </div>
                 <input type="submit" name="Reference_form" value="Reference_form">
			</div>            
        </form>
    </div>
</div>


<div style='display:none'>
    <div id='family_details' style='padding:10px; background:#fff;'>
    	<form method="post" action="edit_profile.php">
            <p><strong><h3>Family Details</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>Father's Occupation</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['father_occupation']; ?>" id="father_occupation" name="father_occupation">
                    
                    <label>Brothers</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['no_of_brothers']; ?>" id="no_of_brothers" name="no_of_brothers">
                    
                    <label>Living with parents?</label>
                    <select name="living_with_parents">
                    	<option value="">Select</option>
                        <option value="Y" <?php if($logged_in_member[0]['living_with_parents']=='Y'){ ?> selected="selected" <?php } ?> >Yes</option>
                        <option value="N" <?php if($logged_in_member[0]['living_with_parents']=='N'){ ?> selected="selected" <?php } ?>>No</option>
                    </select>                    
                    
                    <label>Family Type</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['family_type']; ?>" id="family_type" name="family_type">
                 </div>
                 
                 <div class="right">
                 	<label>Mother's Occupation</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['mother_occupation']; ?>" id="mother_occupation" name="mother_occupation">
                    
                    <label>Sisters</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['no_of_sisters']; ?>" id="no_of_sisters" name="no_of_sisters">
                    
                    <label>Family values</label>
                    <select name="family_value" id="family_value" />
                    	<option value="">Select</option>
                        <option value="Orthodox" <?php if($logged_in_member[0]['family_value'] == "Orthodox"){?> selected="selected" <?php } ?>> Orthodox</option>
                        <option value="Traditional" <?php if($logged_in_member[0]['family_value'] == "Traditional"){?> selected="selected" <?php } ?>>Traditional</option>
                        <option value="Moderate" <?php if($logged_in_member[0]['family_value'] == "Moderate"){?> selected="selected" <?php } ?>>Moderate</option>
                        <option value="Liberal" <?php if($logged_in_member[0]['family_value'] == "Liberal"){?> selected="selected" <?php } ?>>Liberal</option>
                    </select>
                    
                    <label>Family Status</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['family_status']; ?>" id="family_status" name="family_status">
                    
                 </div>
                 <input type="submit" name="family_details_form" value="family_details_form">
			</div>            
        </form>
    </div>
</div>


<div style='display:none'>
    <div id='facebook_member' style='padding:10px; background:#fff;'>
    	<form method="post" action="edit_profile.php" >
            <p><strong><h3>Facebook Url</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>Facebook Url</label>
                    <input type="text" value="" id="Facebook" name="Facebook">
                 </div>
                 <input type="submit" name="Facebook_form" value="Facebook_form">
			</div>            
        </form>
    </div>
</div>

<div style='display:none'>
    <div id='linkedin_member' style='padding:10px; background:#fff;'>
    	<form method="post" action="edit_profile.php" >
            <p><strong><h3>LinkedIn Url</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>LinkedIn Url</label>
                    <input type="text" value="" id="LinkedIn" name="LinkedIn">
                 </div>
                 <input type="submit" name="LinkedIn_form" value="LinkedIn_form">
			</div>            
        </form>
    </div>
</div>

<div style='display:none'>
    <div id='twitter_member' style='padding:10px; background:#fff;'>
    	<form method="post" action="edit_profile.php" >
            <p><strong><h3>Twitter Url</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>Twitter Url</label>
                    <input type="text" value="" id="Twitter" name="Twitter">
                 </div>
                 <input type="submit" name="Twitter_form" value="Twitter_form">
			</div>            
        </form>
    </div>
</div>

</body>
</html>
