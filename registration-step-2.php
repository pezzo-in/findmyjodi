<?php
session_start();
include('lib/myclass.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<title>Registration Step 2 - Matrimonial</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/script.js"></script>
<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>  



<script type="text/javascript" src="assets/js/script.js"></script>

<script type="text/javascript" src="assets/js/jquery-1.7.1.min.js"></script>


<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1"/>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>

<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" media="all" />
	<!--<link rel="stylesheet" href="assets/validation_css/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="assets/validation_css/template.css" type="text/css"/>
	<script src="assets/validation_js/jquery-1.7.2.min.js" type="text/javascript"></script>
	<script src="assets/validation_js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
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
<div class="container">
    <div class="row">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="topMain col-md-12 col-sm-12 col-xs-12 nopadding">
            <div class="wrapper col-md-12 col-sm-12 col-xs-12 nopadding">
                <?php include('include/header.inc.php'); ?>
                <div class="header inn">
                    <div class="titlebox col-md-12">
                        <h2>Registration Step 2</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 nopadding">
            <div class="wrapper col-md-12 col-sm-12 col-xs-12 nopadding">
                 <?php include('include/registration-step-2.inc.php'); ?>
                 <?php include('include/footer.inc.php'); ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
