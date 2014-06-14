<?php
if(isset($_POST['submit']))
{
	if(!empty($_FILES['file']['name'][0]))
	{
		for ($i = 0; $i < count($_FILES['file']); $i++) {
			$fileLink =  $_SERVER['DOCUMENT_ROOT']."Kannadalagna/upload/banners/". $_FILES['file']['name'][$i];
			$fileType = $_FILES['file']['type'][$i];
			$fileSize = ($_FILES['file']['type'][$i]) / 1024;
			$source = "$fileLink";
			move_uploaded_file($_FILES["file"]["tmp_name"][$i], $source);					
		}
		//end photo  upload
	}
	$insert="INSERT into advertisement(id,title,adv_position,banner_type,banner_file,banner_link,banner_text,status,Pagename)
			 values
			 		(NULL,'".$_POST['title']."','".$_POST['drp_position']."',
						  '".$_POST['rdBannerType']."','".$_FILES['file']['name'][0]."','".$_POST['banner_link']."',
						  '".$_POST['detail']."',
						  '".$_POST['drpStatus']."','".$_POST['Pagename']."')";
			$db_ins=$obj->insert($insert);	
		
	echo "<script>window.location='list_advertisements.php'</script>";
}
if(isset($_POST['update']))
{	
if(!empty($_FILES['file']['name'][0]))
	{
		for ($i = 0; $i < count($_FILES['file']); $i++) {
			$fileLink =  $_SERVER['DOCUMENT_ROOT']."Kannadalagna/upload/banners/". $_FILES['file']['name'][$i];
			$fileType = $_FILES['file']['type'][$i];
			$fileSize = ($_FILES['file']['type'][$i]) / 1024;
			$source = "$fileLink";
			move_uploaded_file($_FILES["file"]["tmp_name"][$i], $source);
					
		}
		//end photo  upload
	}
	$update_page="UPDATE advertisement
				  SET 
				  		title = '".$_POST['title']."',adv_position = '".$_POST['drp_position']."',banner_type = '".$_POST['rdBannerType']."',
						banner_file = '".$_FILES['file']['name'][0]."',banner_link = '".$_POST['banner_link']."',
						banner_text = '".$_POST['detail']."',status= '".$_POST['drpStatus']."', Pagename = '".$_POST['Pagename']."' 
				 where 
				 		id = '".$_GET['id']."'";
						
	$db_updatepage=$obj->edit($update_page);	
	echo "<script>window.location='list_advertisements.php'</script>";
}
$select_category = "SELECT * FROM advertisement where id = '".$_GET['id']."'";
$db_category = $obj->select($select_category);
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
                        <label>
                            <span>Layout</span>
                            <select class="layout-option m-wrap small">
                                <option value="fluid" selected>Fluid</option>
                                <option value="boxed">Boxed</option>
                            </select>
                        </label>
                        <label>
                            <span>Header</span>
                            <select class="header-option m-wrap small">
                                <option value="fixed" selected>Fixed</option>
                                <option value="default">Default</option>
                            </select>
                        </label>
                        <label>
                            <span>Sidebar</span>
                            <select class="sidebar-option m-wrap small">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected>Default</option>
                            </select>
                        </label>
                        <label>
                            <span>Footer</span>
                            <select class="footer-option m-wrap small">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected>Default</option>
                            </select>
                        </label>
                    </div>
                </div>
                <!-- END BEGIN STYLE CUSTOMIZER -->     
                <h3 class="page-title">
                    Advertisement                    
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                    </li>
                    <li>
                        <a href="list_advertisements.php">List Advertisement</a>
                        <span class="icon-angle-right"></span>
                    </li>
                    <li><a href="#">Advertisement</a></li>
                </ul>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        
        
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="btn-group" style="margin-bottom:10px; float:right">
                    <a href="list_advertisements.php"><button id="sample_editable_1_new" class="btn green">
                    List Advertisement
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Advertisement</div>
                        
                    </div>
                    <div class="portlet-body form">
                        <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal"  onsubmit="return validateFormOnSubmit(this)" enctype="multipart/form-data">
							<div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>You have some form errors. Please check below.
							</div>                            
                            <div class="control-group">
                                <label class="control-label">Title<span class="required">*</span></label>
                                <div class="controls">
                                	<input type="text" name="title" value="<?php echo $db_category[0]['title']; ?>" class="span6 m-wrap required"/>
                                </div>                               
                            </div>
                            <div class="control-group">
                                <label class="control-label">Page Name<span class="required">*</span></label>
                                <div class="controls">
                                	<select name="Pagename" class="span6 m-wrap required">
                                        <?php if($db_category[0]['Pagename'] == '') { ?>
                                        <option value="" selected="selected">---Select---</option>                                    	
                                        <?php } ?>
                                        <option value="Login" <?php if($db_category[0]['Pagename'] == 'Login') { ?> selected="selected" <?php } ?>>Login</option>
                                        <option value="Register" <?php if($db_category[0]['Pagename'] == 'Register') { ?> selected="selected" <?php } ?>>Register</option>
                                        <option value="Home" <?php if($db_category[0]['Pagename'] == 'Home') { ?> selected="selected" <?php } ?>>Home</option>
                                        <option value="Search" <?php if($db_category[0]['Pagename'] == 'Search') { ?> selected="selected" <?php } ?>>Search</option>
                                        <option value="Profile" <?php if($db_category[0]['Pagename'] == 'Profile') { ?> selected="selected" <?php } ?>>Profile</option>                                        
                                    </select>
                                </div>                               
                            </div>
                            <div class="control-group">
                                <label class="control-label">Position<span class="required">*</span></label>
                                <div class="controls">
                                	<select name="drp_position" class="span6 m-wrap required">
                                        <option value="">---Select---</option>
                                    	<option value="top" <?php if($db_category[0]['adv_position'] == "top") { ?> echo selected="selected"; <?php } ?>>Top</option>
                                        <option value="bottom" <?php if($db_category[0]['adv_position'] == "bottom") { ?> echo selected="selected"; <?php } ?>>Bottom</option>
                                        <option value="right" <?php if($db_category[0]['adv_position'] == "right") { ?> echo selected="selected"; <?php } ?>>Right</option>
                                        <option value="left" <?php if($db_category[0]['adv_position'] == "left") { ?> echo selected="selected"; <?php } ?>>Left</option>  
                                    </select>
                                </div>                               
                            </div>
                            <style>
							.controls > .radio, .controls > .checkbox { margin-top:0px !important;}
							.radio input[type="radio"], .checkbox input[type="checkbox"] { margin-left:0px;}
							</style>
                            
                            
                             <div class="control-group">
                                <label class="control-label">Banner Type<span class="required">*</span></label>
                                <div class="controls" id="bannerRadio">
                                	Text<input type="radio" name="rdBannerType" id="rdBannerType" value="text" onclick="chkval('text');"
                                     <?php if($db_category[0]['banner_type'] == "text")  { ?> checked="checked" <?php } ?> />
                                    Banner<input type="radio" name="rdBannerType" id="rdBannerType" value="banner" onclick="chkval('banner');"
                                    <?php if($db_category[0]['banner_type'] == "banner") { ?>  checked="checked" <?php } ?> />                                    
                                </div>                               
                            </div>
                            	<input type="hidden" name="test" id="test" value="<?php echo $db_category[0]['banner_type']; ?>" />
                            <div class="" id="banner_file" style="display:none">
                            <label class="control-label">Banner<span class="required">*</span></label>
                              <div class="controls">
                                   <input  type="file" name="file[]" multiple="true" class="span6 m-wrap medium" id="file" style="color:black" /><br/>
                               
                                <?php
									  if($_GET['id'] != ""){	
									  $path =  $_SERVER['DOCUMENT_ROOT']."Kannadalagna/upload/banners/".$db_category[0]['banner_file']; 
									  if (file_exists($path)) {
										  echo '<img class="size" src="'."../upload/banners/".$db_category[0]['banner_file'].'"/>';	
									  }
									  else
										{
											//echo '<img class="size" src="'."../images/a1.jpg".'"/>';
											echo 'No file selected';
										}
									  }
										?>
                                         </div>
                              </div>
                            <div class="control-group" id="banner_text">
                                <label class="control-label">Detail<span class="required">*</span></label>
                                <div class="controls">
                                	<script type="text/javascript" src="../administrator/assets/ckeditor/ckeditor.js" ></script>    
									<textarea cols="80" id="detail" name="detail" rows="10" class="span6 m-wrap required">
									<?php echo $db_category[0]['banner_text']; ?></textarea>
    									<script type="text/javascript">
							  				CKEDITOR.replace( 'detail' );
							   			</script>       
                                </div>                               
                            </div>
                            <div class="control-group" id="banner_link" style="display:none">
                                <label class="control-label">Banner Link<span class="required">*</span></label>
                                <div class="controls">
                                	<input type="text" name="banner_link" value="<?php echo $db_category[0]['banner_link']; ?>" class="span6 m-wrap"/>
                                </div>                               
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Status<span class="required">*</span></label>
                                <div class="controls">
                                <select name="drpStatus"  class="span6 m-wrap required">
                                	<option value="">---Select Status---</option>
                                   <option value="Active" <?php if($db_category[0]['status'] == 'Active') { ?> selected="selected"<?php } ?>>Active</option>
                                    <option value="InActive" <?php if($db_category[0]['status'] == 'InActive') { ?> selected="selected"<?php } ?>>InActive</option>
                                </select> 	                                
                                </div>                               
                            </div>
                            
                            <div class="form-actions">
	                            <?php if($_GET['id'] == '') { ?>
                                <input type="submit" name="submit" class="btn blue" value="Add">
                                <?php } else { ?>
                                <input type="submit" name="update" class="btn blue" value="Edit">
                                <a href="add_new_advertisement.php?id=<?php echo $_GET['id']; ?>" onclick="return delete_order('<?php echo $_GET['id']; ?>');"  class="btn red" >Delete Advertisement</a>
                                <?php } ?>
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
<script>
window.onload=function(){
	if(document.forms[0].test.value == "banner")
	{
		$('#banner_file').show();
		$('#banner_link').show();			
		$('#banner_text').hide();
	}
	else
	{
		$('#banner_file').hide();
		$('#banner_link').hide();
		$('#banner_text').show();
	}
}
function myFunction()
{
	for (var i = 0;i < document.forms[0].rdBannerType.length; i++)
	{
		if (document.forms[0].rdBannerType[i].checked)
		{
			return (document.forms[0].rdBannerType[i].value);
			
		}
	}
// should be "M" or "F" but it's "undefined"
}
function validateFormOnSubmit(theForm) {
	
	var banner_type = myFunction();
	
	if(banner_type == "text")
	{
		if(theForm.detail.value == "")
		{
			//alert('hello'+banner_type);
			alert("Please Enter text for banner");
		}
	}
	if(banner_type == "banner")
	{
		var error = "";
		if(theForm.banner_link.value == "")
		{
			error = ("Please Enter link for banner\n");
		}
		if(theForm.file.value == "")
		{
			error += ("Please Enter file for banner");
		}
		if(error != "")
		{		
			alert(error);
		}
	}
	
  return true;
}
	function chkval(banner_type)
	{
		if(banner_type == 'banner')
		{
			$('#banner_file').show();
			$('#banner_link').show();			
			$('#banner_text').hide();
			
		}
		if(banner_type == 'text')
		{
			$('#banner_file').hide();
			$('#banner_link').hide();
			$('#banner_text').show();
			
		}
	}
</script>
<script>
function delete_order(id)
	{
		 var x=confirm('Do you want to delete this record?');
		 if(x)
		 {
			 return true;
			 //window.location.href = 'manage_order.php?ordid='+;
		 }
		 else
		 {
			 return false;
		 }
	}
</script>
<style>
.size
{
	width:150px;
}
</style>