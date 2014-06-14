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
    <title>Member Photo Approval | <?php echo $db_site[0]['Name']; ?></title>
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
    <link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
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
		<?php include('includes/crop_image.inc.php'); ?>
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
		});
	</script>
    
    <script>
	$(function() {
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
	 
	});
	</script>
    <script>
$(document).ready(function(){ //DOM
	var img_name='<?php echo $image[0]['photo']; ?>';
		document.getElementById('test_img').innerHTML="<img src='../upload/"+img_name+"' id='cropbox'/><div id='preview-pane'><div class='preview-container' id='preview_container'><img src='../upload/"+img_name+"' class='jcrop-preview' id='Preview' /></div></div>";
	//document.getElementById('preview_container').innerHTML="<img src='upload/"+img_name+"' class='jcrop-preview' id='Preview' />";
		test();
		$('#crop_submit').css('margin-top','10px');
		$('#crop_submit').addClass('btn green');
		document.getElementById('img_name').value=img_name;
		$('#crop_submit').show();
		
  });
    
    </script>
     <script src="../js/jquery.Jcrop.js"></script>
<script language="Javascript">
	function test()
	{
		var image_type='<?php echo $_REQUEST['imgtyp']; ?>';
		var jcrop_api,
        boundx,
        boundy,
        // Grab some information about the preview pane
        $preview = $('#preview-pane'),
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),
        xsize = $pcnt.width(),
        ysize = $pcnt.height();
    	
	    console.log('init',[xsize,ysize]);
		
		$(function(){
			if(image_type=='profile')
			{
				$('#cropbox').Jcrop({
					//setSelect:   [ 200, 200, 50, 50 ],
					//onChange: updatePreview,
					//aspectRatio: 1,
					//onSelect: updateCoords
					onChange: updatePreview,
					onSelect: updatePreview,
					setSelect: [10,10,160,160],
					minSize: [150, 150],
					//maxSize: [150, 150],
					aspectRatio: 0
					//aspectRatio: xsize / ysize
				},function(){
				  // Use the API to get the real image size
				  var bounds = this.getBounds();
				  boundx = bounds[0];
				  boundy = bounds[1];
				  // Store the API in the jcrop_api variable
				  jcrop_api = this;
			
				  // Move the preview into the jcrop container for css positioning
				  $preview.appendTo(jcrop_api.ui.holder);
				});
			}
			else
			{
				$('#cropbox').Jcrop({
					//setSelect:   [ 200, 200, 50, 50 ],
					//onChange: updatePreview,
					//aspectRatio: 1,
					//onSelect: updateCoords
					onChange: updatePreview,
					onSelect: updatePreview,
					aspectRatio: xsize / ysize
				},function(){
				  // Use the API to get the real image size
				  var bounds = this.getBounds();
				  boundx = bounds[0];
				  boundy = bounds[1];
				  // Store the API in the jcrop_api variable
				  jcrop_api = this;
			
				  // Move the preview into the jcrop container for css positioning
				  $preview.appendTo(jcrop_api.ui.holder);
				});
			}
		});
	
		function updateCoords(c)
		{	  
			$('#x').val(c.x);
			$('#y').val(c.y);
			$('#w').val(c.w);
			$('#h').val(c.h);
			
			if (parseInt(c.w) > 0)
			{
				var rx = xsize / c.w;
				var ry = ysize / c.h;
				$pimg.css({
				  width: Math.round(rx * boundx) + 'px',
				  height: Math.round(ry * boundy) + 'px',
				  marginLeft: '-' + Math.round(rx * c.x) + 'px',
				  marginTop: '-' + Math.round(ry * c.y) + 'px'
				});
			}
		};
		
		function updatePreview(c)
		{
			$('#x').val(c.x);
			$('#y').val(c.y);
			$('#w').val(c.w);
			$('#h').val(c.h);
		  if (parseInt(c.w) > 0)
		  {
			var rx = xsize / c.w;
			var ry = ysize / c.h;
	
			$pimg.css({
			  width: Math.round(rx * boundx) + 'px',
			  height: Math.round(ry * boundy) + 'px',
			  marginLeft: '-' + Math.round(rx * c.x) + 'px',
			  marginTop: '-' + Math.round(ry * c.y) + 'px'
			});
		  }
		}
	
		function checkCoords()
		{
			if (parseInt($('#w').val())) return true;
			alert('Please select a crop region then press submit.');
			return false;
		};
	}
	function checkCoords()
	{
		if (parseInt($('#w').val())) return true;
		alert('Please select a crop region then press submit.');
		return false;
	};
</script>
  
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>