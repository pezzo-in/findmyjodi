<?php
date_default_timezone_set('Asia/Calcutta');
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
<title>Timeline - Matrimonial</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
  <!--<script type="text/javascript" src="assets/css/lightbox.css"></script> 
  <script type="text/javascript" src="assets/images/close.png"></script> 
  <script type="text/javascript" src="assets/images/loading.gif"></script> 
  <script type="text/javascript" src="assets/images/next.png"></script> -->
<link rel="stylesheet" href="assets/css/colorbox.css" />
<link rel="stylesheet" href="css/colorbox.css" />
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
}
*/
?>
<?php if(count($db_member_plan)==0){ ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php } ?>
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
<div class="topMain">
	<div class="wrapper">
    	<?php include('include/header.inc.php'); ?>
        <?php 
		if($_GET['id'] == '') 
		{ 
			include('include/slider1.inc.php'); 
		}
		else
		{
			include('include/slider2.inc.php'); 
		}
		
		?>
		<div class="header inn" style="display:none">
        	<div class="titlebox">
            	<h2>Timeline</h2>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
	<div  class="mid col-md-12 col-sm-12 col-xs-12">
    	
    	 <?php include('include/edit_profile_top.inc.php'); ?>
         <?php include('include/profile_leftbar.inc.php'); ?>
		 <?php include('include/timeline.inc.php'); ?>
    </div>
     <?php include('include/footer.inc.php'); ?>
</div>
<script>
$('.like_btn').click(function(e) {
	//alert('hi');
    var id=$(this).attr('id');
	var this_a=$(this);
	$.ajax({
		type:'POST',
		url:"comment_like.php",
		data:'val='+id,
		async:false,
		success: function(result){
			if(result==1)
				this_a.text('Unlike');
			else
				this_a.text('Like');
		}
	});
	
	$.ajax({
		type:'POST',
		url:"count_comment_like.php",
		data:'val='+id,
		success: function(result){
				//alert(result);
				this_a.next('.like').text(result);
		}
	});
});
</script>
<script>
function comment_delete(id)
{
	$.ajax({
		type:'POST',
		url:"comment_dlt.php",
		data:'val='+id,
		async:false,
		success: function(result){
			if(result==1) { $('#'+id).remove(); }
		}
	});
}
</script>
 <script>
				$('.icon-like').click(function(e) {
					var url = window.location;
					
					var id=$(this).attr('id');
					//alert(id);
					var this_a=$(this);
					//alert(this_a);
					$.ajax({
						type:'POST',
						url:"post_like.php",
						data:'val='+id,
						async:false,
						success: function(result){
							//alert(window.location);
							//$(".wholikes_new").load(window.location);
							if(result==1)
								this_a.html('<span class="span-unlike">Unlike</span>');
								
							else
								this_a.html('<span span="span-like">Like</span>');
						}
					});
					
					$.ajax({
						type:'POST',
						url:"count_post_like.php",
						data:'val='+id,
						success: function(result){
								 $('#wholikes_new_'+id).load(document.URL + " #wholikes_new_"+id);
							}
					});
				});
			</script>
            
			
			
          
            <script>
			
				function add_comment(id){
					var comment = document.getElementById(id).value;
					var res = id.split("_");
					var new_id = res[2];
					//alert(new_id);
					//var image = images.length ? images[0] : null;
					var p = $("#prepage"+new_id).children().length;
					
					//alert(image);
					
					//alert(new_id);
					if(p != 0){
					var imgSource = document.getElementById('cropbox'+new_id).src ;
					}
					//var someimage = document.getElementById('cropbox').src;
					//alert(imgSource);
					$.ajax({
						type: "POST",
						url: "comment_update.php",
						data: "toid=" + id + "&comment=" + comment + "&image=" + imgSource,
						success: function(result){
							$('#comment-set-'+new_id).html(result);
							//alert('success');
							}
					});	
				
				}
			
			</script>
           
			
</body>
</html>
