<?php
session_start();
include('lib/myclass.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<title>Matrimonial</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("ul.profl-list li:nth-child(3n+1)").addClass("first");
	return false;
});

var mouse_is_inside = false;

$(document).ready(function()
{
    $('.loginlink').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").mouseup(function(){ 
        if(! mouse_is_inside)
		{
			
			$(".loginbox").removeClass("open");
			$(".link-signin").toggle(function(){
				$(".loginbox").addClass("open");
			}, function () {
				$(".loginbox").removeClass("open");
			});
		}
    });
});

</script>
</head>
		
<body>
<div class="topMain">
	<div class="wrapper">
    	<?php include('include/header.inc.php'); ?>
		<div class="header inn">
        	<div class="titlebox">
            	<h2>Login</h2>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
	 <?php include('include/success.inc.php'); ?>
     <?php include('include/footer.inc.php'); ?>
</div>

</body>
</html>
