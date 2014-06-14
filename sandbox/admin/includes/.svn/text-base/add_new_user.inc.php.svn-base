<?php
if($_GET['did'] != '')
{
	$sqld="delete from admin where id = '".$_GET['did']."' ";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'list_user.php' </script>";	
}
if(isset($_POST['submit']))
{
	$is_exist = "select * from admin where username = '".$_POST['username']."'";
	$db_exist_role = $obj->select($is_exist);
	if(empty($db_exist_role))
	{
		$is_email_exist = "select * from admin where email = '".$_POST['email']."'";
		$db_exist_email = $obj->select($is_email_exist);
		if(empty($db_exist_email))
		{
			$insert="INSERT into admin(id, username,password,email,status,role_id)
				 values
			 	(NULL,'".$_POST['username']."','".md5($_POST['password'])."',
			 	   '".$_POST['email']."','".$_POST['drpStatus']."','".$_POST['drpRole']."')";
			$db_ins=$obj->insert($insert);	
			echo "<script>window.location='list_user.php'</script>";
		}
		else
		{
			$error= "Error : Email already exist";
		}
	}
	else
	{
		$error= "Error : Username already exist";
	}
}
if(isset($_POST['update']))
{	
	$is_exist = "select * from admin where username = '".$_POST['username']."' and id != '".$_GET['id']."'";
	$db_exist_role = $obj->select($is_exist);
	if(empty($db_exist_role))
	{
		$is_email_exist = "select * from admin where email = '".$_POST['email']."'and id != '".$_GET['id']."'";
		$db_exist_email = $obj->select($is_email_exist);
		if(empty($db_exist_email))
		{
			if($_POST['password_edit'] == '') 
			{
				$update_page="UPDATE admin SET username = '".$_POST['username']."', email = '".$_POST['email']."', status = '".$_POST['drpStatus']."', role_id = '".$_POST['drpRole']."' where id = '".$_GET['id']."'";
			}
			else
			{
				$update_page="UPDATE admin SET username = '".$_POST['username']."', password = '".md5($_POST['password_edit'])."', email = '".$_POST['email']."', status = '".$_POST['drpStatus']."', role_id = '".$_POST['drpRole']."' where id = '".$_GET['id']."'";
			}
		
			$db_updatepage=$obj->edit($update_page);	
			echo "<script>window.location='list_user.php'</script>";
		}
		else
		{
			$error= "Error : Email already exist";
		}
	}
	else
	{
		$error= "Error : Username already exist";
	}
}
$select_category = "SELECT * FROM admin JOIN role ON admin.role_id = role.id where admin.id = '".$_GET['id']."'";
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
                    Administrator                    
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                    </li>
                    <li>
                        <a href="list_user.php">List Administrator</a>
                        <span class="icon-angle-right"></span>
                    </li>
                    <li><a href="#">Administrator</a></li>
                </ul>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        
        
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="btn-group" style="margin-bottom:10px; float:right">
                    <a href="list_user.php"><button id="sample_editable_1_new" class="btn green">
                    List Admin
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Administrator</div>
                        
                    </div>
                    <div class="portlet-body form">
                        <form action="#" method="post" id="form_sample_2" class="form-horizontal">
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
                                <label class="control-label">Username<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="username" id="user" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } echo $db_category[0]['username']; ?>" data-required="1" class="span6 m-wrap required"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" >Password<?php  if($_GET['id']== "") { ?><span class="required">*</span><?php } ?></label>
                                <div class="controls">
                                    <?php  if($_GET['id']== "") { ?> 
                                	<input type="text" name="password" value="" class="span6 m-wrap required"/><?php } ?>
                                    <?php  if($_GET['id']!= "") { ?> 
                                   <input type="text" name="password_edit" value="" class="span6 m-wrap"/> (If you want to change please add value else leave it blank) <?php } ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="email" type="text" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } else{ echo $db_category[0]['email']; } ?>" class="span6 m-wrap"/>
                                </div>
                            </div>                            
                            <div class="control-group">
                                <label class="control-label">Status<span class="required">*</span></label>
                                <div class="controls">
                                    <select class="span6 m-wrap required" name="drpStatus" id="drpStatus">
                                        <option value="" <?php if($db_category[0]['status'] == '') { ?> selected="selected" <?php } ?> > Select... </option>
                                        <option value="1"   <?php  if($_POST['drpStatus'] == "1") { ?> selected="selected" <?php  } elseif($db_category[0]['status'] == '1') { ?> selected="selected"<?php } ?>>Active</option>
                                        <option value="0" <?php if($_POST['drpStatus'] == "0") { ?> selected="selected" <?php  } elseif($db_category[0]['status'] == '0') { ?> selected="selected"<?php } ?>>Inactive</option>                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Role<span class="required">*</span></label>
                                <div class="controls">
                                    <select class="span6 m-wrap required" name="drpRole">
                                    <?php
								 $select_role = "select * from role";
								 $db_role = $obj->select($select_role);
								 ?>
                                 <option value="" <?php if($db_category[0]['role_id'] == '') { ?> selected="selected" <?php } ?> >---Select Role---</option>
                                 <?php for($i=0;$i<count($db_role);$i++) { ?>						
								 <option value="<?php  echo $db_role[$i]['id'] ?>" <?php if($_POST['drpRole'] == $db_role[$i]['id']) { ?> selected="selected" <?php  } elseif($db_category[0]['role_id'] == $db_role[$i]['id']) { ?> selected="selected" <?php }  ?> > <?php echo $db_role[$i]['role']; ?> </option>
                                 <?php } ?>                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                            	<?php if($_GET['id'] == '') { ?>
                                <input type="submit" name="submit" class="btn blue" value="Add">
                                <?php } else { ?>
                                <input type="submit" name="update" class="btn blue" value="Edit User">
                                <a href="add_new_user.php?did=<?php echo $_GET['id']; ?>" onclick="return delete_order('<?php echo $_GET['id']; ?>');"  class="btn red" >Delete User</a>
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
$(function() {
	$('#drpStatus').change( function() {
		alert('hello');
		})
	});	
</script>
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