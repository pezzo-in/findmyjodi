<?php
session_start();
include('lib/myclass.php');
if($_SESSION['UserEmail']=='')
{
	echo "<script>window.location='login.php' </script>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<title>Find My Jodi - Payment</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
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
<script type="text/javascript">
$(document).ready(function(){
	$("#category_1").click(function(){
		$(".pdet1").css({display:'block'});
		$(".pdet2").css({display:'none'});
		$(".pdet3").css({display:'none'});
		$("#summary1").css({display:'block'});
		$("#summary2").css({display:'none'});
		$("#summary3").css({display:'none'});
	});
	$("#category_2").click(function(){
		$(".pdet1").css({display:'none'});
		$(".pdet2").css({display:'block'});
		$(".pdet3").css({display:'none'});
		$("#summary1").css({display:'none'});
		$("#summary2").css({display:'block'});
		$("#summary3").css({display:'none'});
	});
	$("#category_3").click(function(){
		$(".pdet1").css({display:'none'});
		$(".pdet2").css({display:'none'});
		$(".pdet3").css({display:'block'});
		$("#summary1").css({display:'none'});
		$("#summary2").css({display:'none'});
		$("#summary3").css({display:'block'});
	});
	$("#pmode1").click(function(){
		$(".paypal-btn").css({display:'block'});
		$(".other-btn").css({display:'none'});
	});
	$("#pmode2").click(function(){
		$(".paypal-btn").css({display:'none'});
		$(".other-btn").css({display:'block'});
	});	
	
	if($("#category_1").attr('disabled'))
	{$('.payment-mode-sel').css('display','none');}
	else{$('.payment-mode-sel').css('display','block');}
	
	
	for(var i=1;i<=3;i++)
	{
		$("#category_"+i).click(function(){
		$('.payment-mode-sel').css('display','block');
		});	
	}
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

<link rel="stylesheet" href="css/colorbox.css" />
<script src="js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, maxWidth:"900px;"});
	});
</script> 
    

</head>
		
<body>
<?php
include("common_user_fetch.php");
/*if($_SESSION['UserEmail']!='')
{
	$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$_SESSION['logged_user'][0]['id']."' AND members.id=member_plans.member_id and member_plans.expiry_date>'".date('Y-m-d')."'";
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
		<div class="header inn">
        	<div class="titlebox">
            	<h2>Packages</h2>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
	 <?php include('include/packages.inc.php'); ?>
     <?php include('include/footer.inc.php'); ?>
</div>

</body>
</html>
