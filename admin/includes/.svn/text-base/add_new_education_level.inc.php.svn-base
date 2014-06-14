<?php 
if($_GET['did'] != '')
{
	$sqld="delete from education_details where id = '".$_GET['did']."' ";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'list_education_levels.php' </script>";	
}
if(isset($_POST['submit']))
{
	$is_exist = "select * from education_details where degree = '".$_POST['d_name']."'";
	$db_exist_role = $obj->select($is_exist);
	if(empty($db_exist_role))
	{
		//$insert="INSERT into education_details(id, degree_in,degree)values(NULL,'".$_POST['drpDegreeIn']."', '".$_POST['d_name']."')";	
		$insert="INSERT into education_details(id, degree)values(NULL, '".$_POST['d_name']."')";	
		$db_ins=$obj->insert($insert);	
		echo "<script>window.location='list_education_levels.php'</script>";
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Education Level already exist")';
		echo '</script>';
	}
}
if(isset($_POST['update']))
{	
	$is_exist = "select * from education_details where degree = '".$_POST['d_name']."' and id != '".$_GET['id']."'";
	$db_exist_role = $obj->select($is_exist);
	if(empty($db_exist_role))
	{
		//$update_page="UPDATE education_details SET degree = '".$_POST['d_name']."',degree_in = '".$_POST['drpDegreeIn']."' where id = '".$_GET['id']."'";
		$update_page="UPDATE education_details SET degree = '".$_POST['d_name']."' where id = '".$_GET['id']."'";		
		$db_updatepage=$obj->edit($update_page);	
		echo "<script>window.location='list_education_levels.php'</script>";
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Education Level already exist")';
		echo '</script>';
	}
}
$select_category = "select * from education_details where id = '".$_GET['id']."'";
echo $select_category; 
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
                    Education Level                    
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                    </li>
                    <li>
                        <a href="list_education_levels.php">List Education Level</a>
                        <span class="icon-angle-right"></span>
                    </li>
                    <li><a href="#">Education Level</a></li>
                </ul>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        
        
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="btn-group" style="margin-bottom:10px; float:right">
                    <a href="list_education_levels.php"><button id="sample_editable_1_new" class="btn green">
                    List Education Level
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Education Level</div>
                        
                    </div>
                    <div class="portlet-body form">
                        
                        <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
							<div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>You have some form errors. Please check below.
							</div>
                            <?php /*?><div class="control-group">
                                <label class="control-label">Degree In<span class="required">*</span></label>
                                <div class="controls">
                                <?php $data = "select * from degrees";
									  $ans=$obj->select($data);	 ?>
                                	<select id="drpDegreeIn" name="drpDegreeIn" class="span6 m-wrap required">
                                    	<option value="">---Select---</option>
                                    	<?php foreach($ans as $d) { ?>
                                        <option value="<?php echo $d['id'] ?>"
                                         <?php 
										 	if($d['id'] == $db_category[0]['degree_in'])
											{?> selected="selected" <?php } ?> ><?php echo $d['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>                               
                            </div><?php */?>
                            <div class="control-group">
                                <label class="control-label">Degree<span class="required">*</span></label>
                                <div class="controls">
                                	<input type="text" name="d_name" value="<?php echo $db_category[0]['degree']; ?>" class="span6 m-wrap required"/>
                                </div>                               
                            </div>                                                    
                            <div class="form-actions">
	                            <?php if($_GET['id'] == '') { ?>
                                <input type="submit" name="submit" class="btn blue" value="Add">
                                <?php } else { ?>
                                <input type="submit" name="update" class="btn blue" value="Edit Level">
                                <a href="add_new_education_level.php?did=<?php echo $_GET['id']; ?>" onclick="return delete_order('<?php echo $_GET['id']; ?>');"  class="btn red" >Delete Level</a>
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