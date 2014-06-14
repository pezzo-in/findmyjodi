<?php
session_start();
include('lib/myclass.php');
if($_SESSION['UserEmail']!='' && $_SESSION['IsActive']=='Yes')
{
	echo '<script>window.location.href ="my_account.php"</script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<title>Create your profile - Matrimonial</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<!--<link rel="stylesheet" href="http://cod	e.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" media="all" />-->
<link rel="stylesheet" href="css/jquery-ui-1.10.1.css" />

<link rel="stylesheet" href="css/vigo.datepicker.css" />
<link rel="stylesheet" href="assets/validation_css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="assets/validation_css/template.css" type="text/css"/>

<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>  
<script type="text/javascript" src="assets/js/script.js"></script>
<script type="text/javascript" src="assets/js/jquery-1.7.1.min.js"></script>
<!--<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>-->
<script src="js/jquery-ui.js"></script>
 <script>
					 var d = new Date();

							var year = d.getFullYear() - 18;

						$(function() {

							var dates = $( "#dob" ).datepicker({

								changeYear: true,

								changeMonth: true,

								numberOfMonths: 1,

								dateFormat  : 'dd/mm/yy',

								yearRange: '-50:-18',

								reverseYearRange: true,

								defaultDate: '-18y'

												});

						});
							/* var d = new Date();
							var year = d.getFullYear() - 18;
						$(function() {
							var dates = $( "#dob" ).datepicker({
								changeYear: true,
								changeMonth: true,
								numberOfMonths: 1,
								dateFormat  : 'dd/mm/yy',
								yearRange: '-50:-18',
								reverseYearRange: true,
								defaultDate: '-18y'
												});
						});*/
					</script>
<!--<script src="assets/validation_js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="assets/validation_js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#formID").validationEngine();
		});

		
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
	</script>-->
</head>
		
<body>
<div class="topMain">
	<div class="wrapper">
    	<?php include('include/header.inc.php'); ?>
		<div class="header inn">
        	<div class="titlebox">
            	<h2>New Account</h2>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
	 <?php include('include/register.inc.php'); ?>
     <?php include('include/footer.inc.php'); ?>
</div>

<script>
function change_religion(val)
{
	$.ajax({
		type:'POST',
		url:"ajax_caste.php",
		data:'religion='+val,
		success: function(result)
		{
			$('#caste_drp_div').html(result);
		}
	});
}
</script>

</body>
</html>
