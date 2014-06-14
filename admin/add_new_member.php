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
    <title>Member | <?php echo $db_site[0]['Name']; ?></title>
	<title>Kannadalagna | Form Stuff - Form Validation</title>
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
	<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/chosen-bootstrap/chosen/chosen.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
<script type="text/javascript">
/*function showmobcode(str)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
  	if(xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		var val=xmlhttp.responseText.split('~');
	   	document.getElementById("txtHint234").innerHTML=val[0];
		document.getElementById("state_container").innerHTML=val[1];
    }
  }
xmlhttp.open("GET","selectcode.php?q="+str,true);
xmlhttp.send();
}*/
</script>
<script type="text/javascript">

/*var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint456").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","showcaste.php?q="+str,true);
xmlhttp.send();*/

</script>
<script type="text/javascript">
function showsubcaste(str)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  	xmlhttp=new XMLHttpRequest();
  }
else
  {
   	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
	xmlhttp.onreadystatechange=function()
  {
  if(xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	document.getElementById("txtHint567").innerHTML=xmlhttp.responseText;
    }
  }
	xmlhttp.open("GET","showsubcaste.php?q="+str,true);
	xmlhttp.send();
}
</script>
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
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<?php include('includes/leftbar.inc.php'); ?>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->  
		<?php include('includes/add_new_member.inc.php'); ?>
		<!-- END PAGE -->  
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			<?php echo date('Y'); ?> &copy; <?php echo $db_site[0]['Name']; ?>
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
   <!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
  <script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
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
	<script type="text/javascript" src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
	<script type="text/javascript" src="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
	<script type="text/javascript" src="assets/plugins/ckeditor/ckeditor.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<script src="assets/scripts/form-components.js"></script>
	<script src="assets/scripts/app.js"></script>
	<script src="assets/scripts/form-validation.js"></script> 
    
	<!-- END PAGE LEVEL STYLES -->    
	<script>
		jQuery(document).ready(function() {   
		   // initiate layout and plugins
		   App.init();
		   FormValidation.init();
		   FormComponents.init();
		});
	</script>
    <script>
	
	function showmobcode(val) {
			$.ajax({
				   url: '../findPhoneCode.php',
				   dataType: 'html',
				   data: { country : val },
				   success: function(data) {
					  // $('#drpMobcodedata').html( data );
					   var aa = data.split('~')
					  $('#drpMobcodedata').html( aa[0] );
					   $('#drpcurrcodedata').html( aa[1] );
				   }
				});			
		}	
    $(function() {
			
		$('#drpMobcodedata').change( function() {
			var val = $('#drpMobcode').val();
				$.ajax({
				   url: 'findCountry.php',
				   dataType: 'html',
				   data: { phoneCode : val },
				   success: function(data) {
					   $('#drpCountry').html( data );
				   }
				});			
		});		
		$('#drpProfile_for').click( function() {
			var val = $('#drpProfile_for').val();
				$.ajax({
				   url: 'makeSelect.php',
				   dataType: 'html',
				   data: { pro_for : val },
				   success: function(data) {
					   $('#genderRadio').html( data );
				   }
				});			
		});	
	});
	
	function showcaste(val)
		{
		$.ajax({
				type:'POST',
				url:"ajax_caste.php",
				data:'religion='+val,
				success: function(result)
				{
					$('#txtHint456').html(result);
				}
			});
		}
    </script>
	<!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>