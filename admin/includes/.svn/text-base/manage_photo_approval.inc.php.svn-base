<?php
if(isset($_POST['update']))
{	
	
		$update_page="UPDATE member_photo_gallery SET photo = '".$_FILES['file']['name']."' where id = '".$_GET['eid']."'";
		$db_updatepage=$obj->edit($update_page);	
	
		if(!empty($_FILES['file']['name'])) 
	{
	
			$fileLink =  '../second/upload/crop_'. $_FILES['file']['name'];			
			$fileType = $_FILES['file']['type'];
			$fileSize = ($_FILES['file']['type']) / 1024;
			$source = "$fileLink";
			move_uploaded_file($_FILES["file"]["tmp_name"], $source);
					
				
		}

		echo "<script> window.location.href = 'member_photo_approval.php' </script>";	
	
}

$sql="select * from member_photo_gallery where id='".$_GET['eid']."'";
//echo $sql;
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
                    Member Photo Approval                    
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                    </li>
                    <li>
                        <a href="member_photo_approval.php">Member Photo Approval List</a>
                        <span class="icon-angle-right"></span>
                    </li>
                    <li><a href="#">Member Photo Approval</a></li>
                </ul>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        
        
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="btn-group" style="margin-bottom:10px; float:right">
                    <a href="member_photo_approval.php"><button id="sample_editable_1_new" class="btn green">
                   Member Photo Approval List
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Member Photo Approval</div>
                        
                    </div>
                    <div class="portlet-body form">
                        <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
							<div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert">You have some form errors. Please check below.
							</button>
                            </div>
                              
                            <div class="control-group">
                                <label class="control-label"> Photo Image<span class="required">*</span></label>
                                <div class="controls">
                               <?php		 
											if(!empty($ans[0]['photo']))
											{
												$path = '../second/upload/crop_'.$ans[0]['photo'];												
												if (file_exists($path)) { 
													echo '<img class="size" src="'."../upload/".$path.'" height="251" width="201"/>';
												}else{
													
													echo '<img class="size" src="../images/a1.jpg"/>';
												}
											}
											else
											{
												
												echo '<img class="size" src="../images/a1.jpg"/>';
											}	
								?>
                                	  
                                </div>                               
                            </div> 
                            <div class="control-group">
                                <label class="control-label"> </label>
                                <div class="controls">  
                                  <input type="file" name="file"  class="m-wrap medium required"  id="file" style="color:black" /> 
                                   	  
                                </div>                               
                            </div>                                           
                            <div class="form-actions">
	         
                                <input type="submit" name="update" class="btn blue" value="Edit">
            
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

