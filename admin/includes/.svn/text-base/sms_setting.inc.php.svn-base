<?php
if(isset($_POST['submit']))
{
	$chk = "select * from sms_setting";
	$res = $obj->select($chk);
	if(empty($res))
	{
		$sql = "insert into sms_setting 
				(enable_sms_module,sms_after_registration,sms_after_email_verification,sms_after_accept_interest,
				 sms_after_reject_interest,sms_allow_to_membership_mem,sms_after_active_mem,sms_after_paid_mem,
				 sms_after_featured_mem,sms_after_suspend_mem,sms_after_expire_membership,matching_status_sms)
				 values
				 ('".$_POST['general_sms']."','".$_POST['after_register']."','".$_POST['after_email_verification']."',
				  '".$_POST['after_accept_interest']."','".$_POST['after_reject_interest']."'
				  ,'".$_POST['allow_mem_plan']."','".$_POST['after_active_mem']."'
				  ,'".$_POST['after_paid_mem']."','".$_POST['after_featured_mem']."'
				  ,'".$_POST['after_suspeneded_mem']."','".$_POST['after_expire_mem']."'
				  ,'".$_POST['match_status_sms']."')";
			  
		$result = $obj->insert($sql);	
		echo "<script> window.location.href = 'dashboard.php' </script>";		  
	}
	else
	{
		$update = "update sms_setting
				   set
				   enable_sms_module = '".$_POST['general_sms']."',
				   sms_after_registration = '".$_POST['after_register']."',
				   sms_after_email_verification = '".$_POST['after_email_verification']."',
				   sms_after_accept_interest = '".$_POST['after_accept_interest']."',
				   sms_after_reject_interest = '".$_POST['after_reject_interest']."',
				   sms_allow_to_membership_mem = '".$_POST['allow_mem_plan']."',
				   sms_after_active_mem = '".$_POST['after_active_mem']."',
				   sms_after_paid_mem = '".$_POST['after_paid_mem']."',
				   sms_after_featured_mem = '".$_POST['after_featured_mem']."',
				   sms_after_suspend_mem = '".$_POST['after_suspeneded_mem']."',
				   sms_after_expire_membership = '".$_POST['after_expire_mem']."',
				   matching_status_sms = '".$_POST['match_status_sms']."'";
		$ans = $obj->edit($update);
		echo "<script> window.location.href = 'dashboard.php' </script>";		 
				   
	}
	
}
$chk_data = "select * from sms_setting";
$record = $obj->select($chk_data);

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
                   SMS Settings                    
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                    </li>
                    <li>
                        <a href="sms_setting.php"> SMS Settings</a>
                    
                    </li>
                    
                </ul>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        
        
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="btn-group" style="margin-bottom:10px; float:right">
                    <a style="display:none" href="list_body_types.php"><button id="sample_editable_1_new" class="btn green">
                    List Body Types
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>SMS Settings</div>
                        
                    </div>
                    <div class="portlet-body form">
                        <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
							<div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>You have some form errors. Please check below.
							</div>
                            <h4 style="color:#930">General SMS Settings</h4> 
                            <div class="control-group">
                                <label class="control-label">Enable SMS Module:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" tabindex="4" name="general_sms" id="general_sms" value="Y" 
                                    <?php if($record[0]['enable_sms_module'] == "Y"){ echo 'checked=checked'; } ?> checked="checked"/>Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N"
                                    <?php if($record[0]['enable_sms_module'] == "N"){ ?> checked="checked" <?php } ?>
                                     name="general_sms" />No
                                </label>
                                </div>                               
                            </div> 
                            
                             <h4 style="color:#930">Registration SMS</h4> 
                            <div class="control-group">
                                <label class="control-label">SMS After Registration:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" tabindex="4" 
									<?php if($record[0]['sms_after_registration'] == "Y"){ echo 'checked=checked'; } ?>
                                    checked="checked" 
                                     name="after_register" id="after_register" value="Y"  />Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N" name="after_register"
                                    <?php if($record[0]['sms_after_registration'] == "N"){ ?>
                                     checked="checked" 
									 <?php } ?>  />No
                                </label>
                                </div>                               
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">SMS After Verification of E-mail:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" 
                                     <?php if($record[0]['sms_after_email_verification'] == "Y"){ echo 'checked=checked'; } ?>
                                     checked="checked"  
                                    tabindex="4" name="after_email_verification" id="after_email_verification" value="Y" />Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N" 
                                     <?php if($record[0]['sms_after_email_verification'] == "N"){ ?>
                                     checked="checked" 
									 <?php } ?> 
                                    name="after_email_verification" />No
                                </label>
                                </div>                               
                            </div>
                            
                            <h4 style="color:#930">Express Interest SMS</h4> 
                            <div class="control-group">
                                <label class="control-label">SMS After Accepting Express Interest:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" tabindex="4" name="after_accept_interest"
                                    <?php if($record[0]['sms_after_accept_interest'] == "Y"){ echo 'checked=checked'; } ?> checked="checked" id="after_accept_interest" value="Y" />Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N" name="after_accept_interest" 
                                    <?php if($record[0]['sms_after_accept_interest'] == "N"){ ?>
                                     checked="checked" 
									 <?php } ?> />No
                                </label>
                                </div>                               
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">SMS After Rejecting Express Interest:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" tabindex="4" name="after_reject_interest" 
                                     <?php if($record[0]['sms_after_reject_interest'] == "Y"){ echo 'checked=checked'; } ?> checked="checked" id="sms_after_reject_interest" value="Y" />Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N"
                                     <?php if($record[0]['sms_after_reject_interest'] == "N"){ ?>
                                     checked="checked" 
									 <?php } ?> name="after_reject_interest" />No
                                </label>
                                </div>                               
                            </div>
                            
                            
                             <h4 style="color:#930">SMS Permission As per Membership</h4> 
                            <div class="control-group">
                                <label class="control-label">SMS Allow to Membership Plan Members:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" tabindex="4" name="allow_mem_plan" 
                                     <?php if($record[0]['sms_allow_to_membership_mem'] == "Y"){ echo 'checked=checked'; } ?> 
                                     checked="checked" id="allow_mem_plan" value="Y" />Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N" name="allow_mem_plan"
                                     <?php if($record[0]['sms_allow_to_membership_mem'] == "N"){ ?>
                                     checked="checked" 
									 <?php } ?> />No
                                </label>
                                </div>                               
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">SMS After Active Members:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" tabindex="4" name="after_active_mem" 
									<?php if($record[0]['sms_after_active_mem'] == "Y"){ echo 'checked=checked'; } ?> checked="checked" id="after_active_mem" value="Y" />Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N" name="after_active_mem"
                                    <?php if($record[0]['sms_after_active_mem'] == "N"){ ?>
                                     checked="checked" 
									 <?php } ?> />No
                                </label>
                                </div>                               
                            </div>
                            <div class="control-group">
                                <label class="control-label">SMS After Paid Members:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" tabindex="4" name="after_paid_mem" 
                                     <?php if($record[0]['sms_after_paid_mem'] == "Y"){ echo 'checked=checked'; } ?> checked="checked" id="after_paid_mem" value="Y" />Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N" name="after_paid_mem"
                                     <?php if($record[0]['sms_after_paid_mem'] == "N"){ ?>
                                     checked="checked" 
									 <?php } ?> />No
                                </label>
                                </div>                               
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">SMS After Featured Members:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" tabindex="4" name="after_featured_mem"
                                     <?php if($record[0]['sms_after_featured_mem'] == "Y"){ echo 'checked=checked'; } ?> checked="checked" id="after_featured_mem" value="Y" />Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N" name="after_featured_mem" 
                                     <?php if($record[0]['sms_after_featured_mem'] == "N"){ ?>
                                     checked="checked" 
									 <?php } ?>/>No
                                </label>
                                </div>                               
                            </div>
                            <div class="control-group">
                                <label class="control-label">SMS After Suspended Members:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" tabindex="4" name="after_suspeneded_mem" 
                                     <?php if($record[0]['sms_after_suspend_mem'] == "Y"){ echo 'checked=checked'; } ?> checked="checked" id="after_suspeneded_mem" value="Y" />Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N" name="after_suspeneded_mem"
                                     <?php if($record[0]['sms_after_suspend_mem'] == "N"){ ?>
                                     checked="checked" 
									 <?php } ?>     />No
                                </label>
                                </div>                               
                            </div>
                            <div class="control-group">
                                <label class="control-label">SMS After Expire Membership:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" tabindex="4" name="after_expire_mem"
                                    <?php if($record[0]['sms_after_expire_membership'] == "Y"){ echo 'checked=checked'; } ?> checked="checked"  id="after_expire_mem" value="Y" />Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N" name="after_expire_mem"
                                    <?php if($record[0]['sms_after_expire_membership'] == "N"){ ?>
                                     checked="checked" 
									 <?php } ?>  />No
                                </label>
                                </div>                               
                            </div>
                             <h4 style="color:#930">SMS For Matching Profile</h4>
                            <div class="control-group">
                                <label class="control-label">Matching Status SMS:<span class="required">*</span></label>
                                <div class="controls">
                                <label class="radiobtn">
                                    <input type="radio" tabindex="4" name="match_status_sms" 
                                    <?php if($record[0]['matching_status_sms'] == "Y"){ echo 'checked=checked'; } ?> checked="checked"  id="match_status_sms" value="Y" />Yes
                                </label>
                                <label class="radiobtn">
                                    <input type="radio" tabindex="5" value="N" name="match_status_sms"
                                    <?php if($record[0]['matching_status_sms'] == "N"){ ?>
                                     checked="checked" 
									 <?php } ?> />No
                                </label>
                                </div>                               
                            </div>
                            
                                                                               
                            <div class="form-actions">
	                            <input type="submit" name="submit" class="btn blue" value="Submit">
                                
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