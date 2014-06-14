<?php
if(isset($_POST['update']))
{	
	$update_page="UPDATE member_plans SET plan_id = '".$_POST['drpPlan']."' where id = '".$_GET['id']."'";
	$db_updatepage=$obj->edit($update_page);
	
	echo '<script>window.location.href="members_plan.php"</script>';	
}
$sql="select name from members where id = '".$_GET['user_id']."'";
$ans=$obj->select($sql);

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
                    Degree                    
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                    </li>
                    <li>
                        <a href="members_plan.php">Member Plans</a>
                        <span class="icon-angle-right"></span>
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
                    <a href="members_plan.php"><button id="sample_editable_1_new" class="btn green">
                    Member Plans
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Member Plans</div>                        
                    </div>
                    <div class="portlet-body form">
                        <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
							<input type="hidden" name="user_id" value="<?php echo $_GET['id']; ?>">
                            <div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>You have some form errors. Please check below.
							</div>
                            <div class="control-group">
                                <label class="control-label">Name</label>
                                <div class="controls"> 
                                	<input type="text" disabled="disabled" name="name" value="<?php echo $ans[0]['name']; ?>" class="span6 m-wrap required"/>
                                </div>                               
                            </div>
                            <div class="control-group">
                                <label class="control-label">Plan<span class="required">*</span></label>
                                <div class="controls">
                                <?php
									$select_plans="SELECT * FROM new_membership_plans";
									$plans=$obj->select($select_plans);
								?>
                                	<select class="span6 m-wrap required" name="drpPlan">
                                    	<option value="">Select Plan</option>
                                        <?php foreach($plans as $res) { ?>
<option value="<?php echo $res['id']; ?>" <?php if($res['id']==$_GET['plan_id']) { ?> selected="selected"<?php } ?>><?php echo $res['plan_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>                               
                            </div>                                                                                
                            <div class="form-actions">
	                            <input type="submit" name="update" class="btn blue" value="Submit">                                
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