<?php
if(isset($_POST['update']))
{	
	
	$is_exist="select * from  admin where password='".md5($_POST['old_pwd'])."'";
	//echo $is_exist;
	$db_exist = $obj->select($is_exist);
	if(!empty($db_exist))
	{
		$update_page="UPDATE admin
					  SET 
					  password = '".md5($_POST['new_pwd'])."' where id='".$_GET['id']."'";
		$db_updatepage=$obj->edit($update_page);	
		echo "<script>window.location='dashboard.php'</script>";	
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Some error")';
		echo '</script>';
	}
}
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
                    Set Password                    
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                    </li>
                    <li><a href="">Set Password</a></li>
                </ul>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        
        
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="btn-group" style="margin-bottom:10px; float:right">
                 </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Set Password</div>
                        
                    </div>
                    <div class="portlet-body form">
                        <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" onSubmit="check_form();">
							<div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>You have some form errors. Please check below.
							</div>
                            
                             <div class="control-group">
                    <label class="control-label">Old Password<span class="required">*</span></label>
                    <div class="controls">
                      <input type="password" id="old_pwd" name="old_pwd" class="span6 m-wrap required"/>
                      
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">New Password<span class="required">*</span></label>
                    <div class="controls">
                      <input type="password" id="new_pwd" name="new_pwd" class="span6 m-wrap required"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Confirm Password<span class="required">*</span></label>
                    <div class="controls">
                      <input type="password" id="confirm_pwd" name="confirm_pwd" class="span6 m-wrap required"/>
                    </div>
                  </div>
                            <div class="form-actions">
	                            <input type="submit" name="update" class="btn blue" value="Update">                                
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
function check_form()
{
	
	error = 0;
	if(document.getElementById('new_pwd').value==document.getElementById('confirm_pwd').value)
	{
	
		error=0
	}
	else
	{
		alert("Both password should same");
		error=1;
	}

	if(error==0)
		return true;
	else
		return false;
}


</script>


