<?php
session_start();
include('lib/myclass.php');
if($_SESSION['UserEmail']=='')
{
	$_SESSION['redirect_profile']=$_GET['id'];
	echo "<script>window.location='login.php' </script>";
}
else{unset($_SESSION['redirect_profile']);}
if($_SESSION['logged_user'][0]['id']==$_GET['id'])
{echo "<script>window.location='my_account.php' </script>";}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<title>Matrimonial</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/colorbox.css" />
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
<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script> 
<?php } ?>
  <script type="text/javascript" src="assets/js/lightbox.js"></script>
  <!--<link rel="stylesheet" href="assets/css/colorbox.css" />-->
  
<script type="text/javascript" src="js/script.js"></script>
<!--<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>-->
<script type="text/javascript" src="js/jquery.accordion.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#acc-list").accordion({
			alwaysOpen: false,
			header: '.sidebar h3'
		});
	});
</script>
<script>
		var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
		s.parentNode.insertBefore(g,s)}(document,"script"));
	</script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
		<script src="assets/js/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
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
<script src="js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, maxWidth:"900px;"});
		$(".ajax").colorbox({width:502,height:452,initialWidth: "460",initialHeight: "410"});
		$(".ajax1").colorbox({width:492,height:242,initialWidth: "450",initialHeight: "200"});
		$(".ajax3").colorbox({innerWidth:"450px;", maxWidth:"450px;"});
		$(".user_offline").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "This user is offline."});
		$(".paid_error").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"130px;", height:"130px;", xhrError: "This feature is available for paid member."});
		$(".exid_mobile").colorbox({innerWidth:"500px;", maxWidth:"500px;", innerHeight:"130px;", height:"130px;", xhrError: "Sorry! You exceed maximum number of mobile from your plan."});
		$(".exid_msg").colorbox({innerWidth:"500px;", maxWidth:"500px;", innerHeight:"130px;", height:"130px;", xhrError: "Sorry! You exceed maximum number of message from your plan."});
		$(".same_gender").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"130px;", height:"130px;", xhrError: "Interest can not be send to same gender."});
		$(".alredy_sent").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Interest is already sent."});
	});	
</script>
<div class="container">
    <div class="row">
        <div class="topMain col-md-12 col-sm-12 col-xs-12 nopadding">
            <div class="wrapper col-md-12 col-sm-12 col-xs-12 nopadding">
    	<?php include('include/header.inc.php'); ?>
        <?php include('include/slider2.inc.php'); ?>
                <div class="header inn">
                    <div class="titlebox col-md-12">
            	Search
            </div>
        </div>
    </div>
</div>
        <div class="col-md-12 mid">
            <div class="wrapper col-md-12 col-sm-12 col-xs-12 nopadding">
	 <?php include('include/view_profile.inc.php'); ?>
     <?php //include('include/profile_leftbar.inc.php'); ?>
	</div>
     <?php include('include/footer.inc.php'); ?>
	
</div>
</div>
</div>
</body>
</html>
