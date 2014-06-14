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
<title>Matrimonial</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://cod	e.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" media="all" />
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
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
</head>
		
<body>
<div class="topMain">
	<div class="wrapper">
    	<?php include('include/header.inc.php'); ?>
		<div class="header inn">
        	<div class="titlebox">
            	<h2>New account</h2>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
	 <?php include('include/activation.inc.php'); ?>
     <div class="wrapper">
	 <?php include('include/footer.inc.php'); ?>
     </div>
</div>

</body>
</html>
