<?php 
if($_GET['did'] != '')
{
	$sqld="delete from education_course where Id = '".$_GET['did']."' ";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'list_education_course.php?eid=".$_GET['eid']."' </script>";
}
if(isset($_POST['submit']))
{
	$is_exist = "select * from education_course where Title = '".$_POST['title']."'";
	$db_exist_course = $obj->select($is_exist);
	if(empty($db_exist_course))
	{
		//$insert="INSERT into education_details(id, degree_in,degree)values(NULL,'".$_POST['drpDegreeIn']."', '".$_POST['d_name']."')";	
		$insert="INSERT into education_course(Id,Eid,Title)values(NULL, '".$_GET['eid']."', '".$_POST['title']."')";	
		$db_ins=$obj->insert($insert);	
		echo "<script>window.location='list_education_course.php?eid=".$_GET['eid']."'</script>";
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Education course already exist")';
		echo '</script>';
	}
}
if(isset($_POST['update']))
{	
	$is_exist = "select * from education_course where Title = '".$_POST['title']."'";
	$db_exist_course = $obj->select($is_exist);
	if(empty($db_exist_course))
	{
		//$update_page="UPDATE education_details SET degree = '".$_POST['d_name']."',degree_in = '".$_POST['drpDegreeIn']."' where id = '".$_GET['id']."'";
		$update_page="UPDATE education_course SET Title = '".$_POST['title']."', Eid='".$_POST['eid']."' where Id = '".$_GET['id']."'";		
		$db_updatepage=$obj->edit($update_page);	
		echo "<script>window.location='list_education_course.php?eid=".$_POST['eid']."'</script>";
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Education course already exist")';
		echo '</script>';
	}
}
$select_category = "select * from education_course where Id = '".$_GET['id']."'";
//echo $select_category; 
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
                    Education Course                     
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                    </li>
                    <li>
                        <a href="list_education_course.php?eid=<?php echo $_GET['eid'];?>">List Education Course</a>
                        <span class="icon-angle-right"></span>
                    </li>
                    <li><a href="#">Education Course</a></li>
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
                   List Education Course
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Education Course</div>
                        
                    </div>
                    <div class="portlet-body form">
                        
                        <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
							<div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>You have some form errors. Please check below.
							</div>
                           <input type="hidden" name="eid" value="<?php echo  $db_category[0]['Eid']; ?>"/>           
                            <div class="control-group">
                                <label class="control-label">Title<span class="required">*</span></label>
                                <div class="controls">
                                	<input type="text" name="title" value="<?php echo $db_category[0]['Title']; ?>" class="span6 m-wrap required"/>
                                   
                                </div>                               
                            </div> 
                                                                    
                            <div class="form-actions">
	                            <?php if($_GET['eid']!='' && $_GET['id']=='') { ?>
                                <input type="submit" name="submit" class="btn blue" value="Add">
                                <?php } else if($_GET['id']!=''){ ?>
                                <input type="submit" name="update" class="btn blue" value="Edit Course">
                                <a href="add_new_education_course.php?did=<?php echo $_GET['id']; ?>&eid=<?php echo $_GET['eid']; ?>" onclick="return delete_order('<?php echo $_GET['id']; ?>');"  class="btn red" >Delete Course</a>
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