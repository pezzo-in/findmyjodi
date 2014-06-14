<?php

session_start();

include('lib/myclass.php');

$select_content = "select * from tbl_seo_content where Id = '11'";

$db_content = $obj->select($select_content);



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="shortcut icon" href="images/favicon.ico" />

<title><?php echo $db_content[0]['SeoTitle']; ?></title>

<meta name="description" content="<?php echo $db_content[0]['SeoMeta']; ?>" />

<meta name="keywords" content="<?php echo $db_content[0]['SeoKeywords']; ?>" />

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

    



</head>

		

<body>

<?php 
include("common_user_fetch.php");
?>

<div class="topMain">

	<div class="wrapper">

    	<?php include('include/header.inc.php'); ?>

		<div class="header inn">

        	<div class="titlebox">

            	<h2>About Us</h2>

            </div>

        </div>

    </div>

</div>

<div class="wrapper">

	 <?php include('include/aboutus.inc.php'); ?>

     <?php include('include/footer.inc.php'); ?>

</div>



</body>

</html>

