<?php
if($_GET['did'] != '')
{
	$sqld="delete from role where id = '".$_GET['did']."' ";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'list_role.php' </script>";	
}
if(isset($_POST['submit']))
{
	$mem_per = implode(",",$_POST['chkMem_Permission']);
	$mem_arr["mem_per"] = ($mem_per);
 	
	$story_per = implode(",",$_POST['chkStory_Permission']);
	$mem_str["story_per"] = $story_per;
	
	$plan_per = implode(",",$_POST['chkPlan_Permission']);
	$mem_plan['plan_per'] = $plan_per;
	
	$is_exist = "select * from role where role = '".$_POST['role']."'";
	$db_exist_role = $obj->select($is_exist);
	if(empty($db_exist_role))
	{
		$insert="INSERT into role(id, role,member_access,member_story_access,member_plan_access)
				 values(NULL, 
				 			'".$_POST['role']."','".$mem_arr["mem_per"]."','".$mem_str["story_per"]."','".$mem_plan['plan_per']."')";
							
		$db_ins=$obj->insert($insert);	
		echo "<script>window.location='list_role.php'</script>";
	}
	else
	{
		$error= "Error : Role already exist";
	}
}
if(isset($_POST['update']))
{	
	$is_exist = "select * from role where role = '".$_POST['role']."' and id != '".$_GET['id']."'";
	$db_exist_role = $obj->select($is_exist);
	if(empty($db_exist_role))
	{
	$mem_per = implode(",",$_POST['chkMem_Permission']); 
	$mem_arr["mem_per"] = ($mem_per);
 	
	$story_per = implode(",",$_POST['chkStory_Permission']);
	$mem_str["story_per"] = $story_per;
	
	$plan_per = implode(",",$_POST['chkPlan_Permission']);
	$mem_plan['plan_per'] = $plan_per;
		$update_page="UPDATE role
					  SET 
					 	 role = '".$_POST['role']."',member_access = '".$mem_arr["mem_per"]."',
						 member_story_access = '".$mem_str["story_per"]."', 
						 member_plan_access = '".$mem_plan['plan_per']."'
					  where 
					  		id = '".$_GET['id']."'";
		$db_updatepage=$obj->edit($update_page);	
		echo "<script>window.location='list_role.php'</script>";
	}
	else
	{
		$error= "Error : Role already exist";
	}
}
$select_category = "select * from role where id = '".$_GET['id']."'";
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
                    Role                    
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                    </li>
                    <li>
                        <a href="list_role.php">List Role</a>
                        <span class="icon-angle-right"></span>
                    </li>
                    <li><a href="#">Role</a></li>
                </ul>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        
        
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="btn-group" style="margin-bottom:10px; float:right">
                    <a href="list_role.php"><button id="sample_editable_1_new" class="btn green">
                    List Role
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Role</div>
                        
                    </div>
                    <div class="portlet-body form">
                        <form action="#" id="form_sample_2" class="form-horizontal" method="post">
                            <div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <div class="alert alert-success hide">
                                <button class="close" data-dismiss="alert"></button>
                               
                                Your form validation is successful!
                            </div>
                            <div class="control-group">
                             <?php if (isset($error)) { echo "<p class='message'>" .$error. "</p>" ;} ?>
                                <label class="control-label">Role<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="role" value="<?php echo $db_category[0]['role']; ?>" data-required="1" class="span6 m-wrap required"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Member<span class="required">*</span></label>
                                <div class="controls">
                                	<input type="checkbox" name="chkMem_Permission[]" id="chkMem_Permission" value="add" />Add
                                    <input type="checkbox" name="chkMem_Permission[]" id="chkMem_Permission" value="edit" />Edit
                                    <input type="checkbox" name="chkMem_Permission[]" id="chkMem_Permission" value="view" />View
                                    <input type="checkbox" name="chkMem_Permission[]" id="chkMem_Permission" value="delete" />Delete
                                </div>                               
                            </div>                                                    
                            <div class="control-group">
                                <label class="control-label">Success Story<span class="required">*</span></label>
                                <div class="controls">
                                	<input type="checkbox" name="chkStory_Permission[]" id="chkStory_Permission" value="add" />Add
                                    <input type="checkbox" name="chkStory_Permission[]" id="chkStory_Permission" value="edit" />Edit
                                    <input type="checkbox" name="chkStory_Permission[]" id="chkStory_Permission" value="view" />View
                                    <input type="checkbox" name="chkStory_Permission[]" id="chkStory_Permission" value="delete" />Delete
                                </div>                               
                            </div>
                            <div class="control-group">
                                <label class="control-label">Plans<span class="required">*</span></label>
                                <div class="controls">
                                	<input type="checkbox" name="chkPlan_Permission[]" id="chkPlan_Permission" value="add" />Add
                                    <input type="checkbox" name="chkPlan_Permission[]" id="chkPlan_Permission" value="edit" />Edit
                                    <input type="checkbox" name="chkPlan_Permission[]" id="chkPlan_Permission" value="view" />View
                                    <input type="checkbox" name="chkPlan_Permission[]" id="chkPlan_Permission" value="delete" />Delete
                                </div>                               
                            </div> 
                            
                            <div class="form-actions">
                            	<?php if($_GET['id'] == '') { ?>
                                <input type="submit" name="submit" class="btn blue" value="Add">
                                <?php } else { ?>
                                <input type="submit" name="update" class="btn blue" value="Edit Role">
                                <a href="add_new_role.php?did=<?php echo $_GET['id']; ?>" onclick="return delete_order('<?php echo $_GET['id']; ?>');"  class="btn red" >Delete Role</a>
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
<style type="text/css" >
	.message{
	color: red; 
	font-weight:normal; 
	margin-right:850px;
	border:1px solid red;
	text-align:center;
	}
</style>
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