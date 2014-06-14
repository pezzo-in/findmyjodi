<?php 
session_start();
include('../lib/myclass.php');
if($_SESSION['adminid']=='')
{
	echo "<script>window.location='login.php' </script>";
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
<?php
$select_site = "select * from tbl_sitename where Id = '1'";
$db_site = $obj->select($select_site);
?>  
    <title>Inactive Members | <?php echo $db_site[0]['Name']; ?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<?php include('includes/header.inc.php'); ?>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<?php include('includes/leftbar.inc.php'); ?>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<?php include('includes/inactive_members.inc.php'); ?>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			<?php include('includes/footer.inc.php'); ?>
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   
	<!-- BEGIN CORE PLUGINS -->   <script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="assets/scripts/app.js"></script>
	<script src="assets/scripts/table-advanced.js"></script>     
	<script>
		jQuery(document).ready(function() {       
		   App.init();
		   TableAdvanced.init();
		});
	</script>
    
     <script>
	
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
			 
			leftD = e.pageX + parseInt(moveLeft);
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
	</script>
    
	<!-- END JAVASCRIPTS -->
</body>
<div id="sms_poup" class="modal hide" style="top:25% !important;">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Send SMS</h3>
                </div>
                <form name="message_from" id="message_from" method="post" style="margin-bottom:0;">
                <div class="modal-body">
                    <div class="control-group">
                    <input type="hidden" name="user_mobile" value="" id="user_mobile">
                                <label class="control-label">Message<span class="required">*</span></label>
                                <div class="controls"> 
                            <textarea name="msg" class="span6 m-wrap required" style="width:88%;" rows="4"></textarea>
                                </div>                               
                   	</div>
				</div>
                <div class="modal-footer">
					<input type="submit" name="submit_sms" class="btn blue" value="Send" style="float:left;">   
				</div>
                </form>
			</div>
<!-- END BODY -->
<script>
var mobiles = '';
	function user_mob_chk(mob,this_id,country_code)
	{
		if(this_id.checked){
		mobiles += country_code+mob+',';
		$('#user_mobile').val(mobiles);
		}
		else
		{
			mobiles = mobiles.replace(country_code+mob+',','');
			$('#user_mobile').val(mobiles);
		}
	}
</script>
</html>