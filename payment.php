<?php
session_start();
include('lib/myclass.php');
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
		<?php if($_POST['paypal']=='paypal')   {  ?>
<body onLoad="redirectTopaypal();">
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
	 <?php include('include/payment.inc.php'); ?>
     <?php include('include/footer.inc.php'); ?>
</div>
<?php } ?>
<?php if($_POST['ccavenue']=='ccavenue')   {  ?>
<body>
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
	 <?php include('include/ccavRequestHandler.inc.php'); ?>
     <?php include('include/footer.inc.php'); ?>
</div>
<?php } ?>


</body>
</html>
