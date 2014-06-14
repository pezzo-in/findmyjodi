<?php
if(isset($_POST['submit']))
{
	
	$filetype= $_FILES['file']['type'];
	$filenm= $_FILES['file']['name'];	
	if($filenm != '')
	{
		if(move_uploaded_file($_FILES['file']['tmp_name'],"../upload/quicktour/".$filenm))
		{
			$insert = "insert into tbl_quick_tour(Id, Title, Photo) values(null, '".$_POST['name']."', '".$filenm."')";
			$db = $obj->insert($insert);
		}
	}
	echo "<script>window.location='list_quick_tour.php'</script>";
}

if(isset($_POST['update']))
{
	
	
	$filetype= $_FILES['file']['type'];
	$filenm= $_FILES['file']['name'];	
	if($filenm != '')
	{
		if(move_uploaded_file($_FILES['file']['tmp_name'],"../upload/quicktour/".$filenm))
		{
			$update = "update tbl_quick_tour set Title = '".$_POST['name']."', Photo = '".$filenm."' where Id = '".$_GET['id']."'";
			$obj->edit($update);
		}
	}
	echo "<script>window.location='list_quick_tour.php'</script>";
}

$select = "select * from tbl_quick_tour where Id = '".$_GET['id']."'";
$db_select = $obj->select($select);
?>
<div class="page-content"> 
  <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
  <div id="portlet-config" class="modal hide">
    <div class="modal-header">
      <button data-dismiss="modal" class="close" type="button"></button>
      <h3>portlet Settings</h3>
    </div>
    <div class="modal-body">
      <p>Here will be a configuration form</p>
    </div>
  </div>
  <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM--> 
  <!-- BEGIN PAGE CONTAINER-->
  <div class="container-fluid"> 
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
      <div class="span12"> 
        <!-- BEGIN STYLE CUSTOMIZER -->
        <div class="color-panel hidden-phone">
          <div class="color-mode-icons icon-color"></div>
          <div class="color-mode-icons icon-color-close"></div>
          <div class="color-mode">
            <p>THEME COLOR</p>
            <ul class="inline">
              <li class="color-black current color-default" data-style="default"></li>
              <li class="color-blue" data-style="blue"></li>
              <li class="color-brown" data-style="brown"></li>
              <li class="color-purple" data-style="purple"></li>
              <li class="color-grey" data-style="grey"></li>
              <li class="color-white color-light" data-style="light"></li>
            </ul>
            <label> <span>Layout</span>
              <select class="layout-option m-wrap small">
                <option value="fluid" selected>Fluid</option>
                <option value="boxed">Boxed</option>
              </select>
            </label>
            <label> <span>Header</span>
              <select class="header-option m-wrap small">
                <option value="fixed" selected>Fixed</option>
                <option value="default">Default</option>
              </select>
            </label>
            <label> <span>Sidebar</span>
              <select class="sidebar-option m-wrap small">
                <option value="fixed">Fixed</option>
                <option value="default" selected>Default</option>
              </select>
            </label>
            <label> <span>Footer</span>
              <select class="footer-option m-wrap small">
                <option value="fixed">Fixed</option>
                <option value="default" selected>Default</option>
              </select>
            </label>
          </div>
        </div>
        <!-- END BEGIN STYLE CUSTOMIZER -->
        <h3 class="page-title"> Quick Tour </h3>
        <ul class="breadcrumb">
          <li> <i class="icon-home"></i> <a href="dashboard.php">Home</a> <span class="icon-angle-right"></span> </li>
          <li> <a href="list_members.php">List Members</a> <span class="icon-angle-right"></span> </li>
          <li><a href="#">Members</a></li>
        </ul>
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    
    <div class="row-fluid">
      <div class="span12"> 
        <!-- BEGIN VALIDATION STATES-->
        <div class="btn-group" style="margin-bottom:10px; float:right"> <a href="list_quick_tour.php">
          <button id="sample_editable_1_new" class="btn green"> List Quick Tour </button>
          </a> </div>
        <div class="portlet box green">
          <div class="portlet-title">
            <div class="caption"><i class="icon-reorder"></i>Quick Tour</div>
          </div>
          <div class="portlet-body form">
            <form action="#" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
              <div class="alert alert-error hide">
                <button class="close" data-dismiss="alert"></button>
                You have some form errors. Please check below. </div>
              <div class="alert alert-success hide">
                <button class="close" data-dismiss="alert"></button>
                Your form validation is successful! </div>
              
              <div class="control-group">
                <label class="control-label">Name<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="name" data-required="1" value="<?php echo $db_select[0]['Title']; ?>" class="span6 m-wrap"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Filename:<span class="required">*</span></label>
                <div class="controls">
                  <input type="file" name="file" class="span6 m-wrap required" id="file" style="color:black" /> (For best view, upload 800 x 300 image)
                </div>
              </div>
              <?php if($_GET['id'] != '') { ?>
              <div class="control-group">
                <label class="control-label">&nbsp;</label>
                <div class="controls">
                  <img src="<?php echo "../upload/quicktour/".$db_select[0]['Photo']; ?>" width="50" height="50"  />
                </div>
              </div>
              <?php } ?>
              
              <div class="form-actions">
                <?php if($_GET['id'] == '') { ?>
                <input type="submit" name="submit" class="btn blue" value="Add">
                <?php } else { ?>
                <input type="submit" name="update" class="btn blue" value="Edit">
                <?php } ?>
                <!--<button type="submit" class="btn green">Validate</button>
                                <button type="button" class="btn">Cancel</button>--> 
              </div>
            </form>
            <!-- END FORM--> 
          </div>
        </div>
        <!-- END VALIDATION STATES--> 
      </div>
    </div>
    <!-- END PAGE CONTENT--> 
  </div>
  <!-- END PAGE CONTAINER--> 
</div>
<script type="text/javascript">
function validateFormOnSubmit(theForm) {
var reason = "";
  reason += validateUsername(theForm.name);
  reason += validatePhone(theForm.mobile_no);
      
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }
  return true;
}
function validateUsername(fld) {
    var error = "";
    var illegalChars = /[^a-z]/i; // allow characters and spaces
 	
    if (illegalChars.test(fld.value)) {
        error = "The Username should not be numeric.\n";
    } else {
        fld.style.background = 'White';
    } 
    return error;
}
function trim(s)
{
  return s.replace(/^\s+|\s+$/, '');
} 
function validatePhone(fld) {
    var error = "";
    var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');     
	if(fld.value != "")
	{
   		if(isNaN(parseInt(stripped))) {
        	error = "The phone number should be numeric only.\n";        
		}
    }  
    return error;
}
$(function() {
		$('#drpCountry').change( function() {
			var val = $(this).val();
				$.ajax({
				   url: 'findPhoneCode.php',
				   dataType: 'html',
				   data: { country : val },
				   success: function(data) {
					   $('#drpMobcodedata').html( data );
				   }
				});			
		});	
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
	
</script>
