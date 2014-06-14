<?php

if(isset($_POST['submit']))

{

	$page_url = strtolower(str_replace(" ","-",$_POST['page_name']));

	

	$insert="INSERT into contents(id, page_name,detail,seo_title,seo_meta,seo_keywords,page_url)

				values(NULL,'".$_POST['page_name']."','".$_POST['detail']."','".$_POST['seo_title']."',

							'".$_POST['seo_meta']."', '".$_POST['seo_keywords']."','".$page_url."')";

	$db_ins=$obj->insert($insert);	

	echo "<script>window.location='list_contents.php'</script>";

}

if(isset($_POST['update']))

{	

	$page_url = strtolower(str_replace(" ","-",$_POST['page_name']));

	$update_page="UPDATE contents SET page_name = '".$_POST['page_name']."',detail = '".$_POST['detail']."',

									  seo_title = '".$_POST['seo_title']."',seo_meta = '".$_POST['seo_meta']."',

									  seo_keywords = '".$_POST['seo_keywords']."',page_url = '".$page_url."'

									  where id = '".$_GET['id']."'";

	$db_updatepage=$obj->edit($update_page);	

	echo "<script>window.location='list_contents.php'</script>";

}

$select_category = "SELECT * FROM contents where id = '".$_GET['id']."'";

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

                    Content                    

                </h3>

                <ul class="breadcrumb">

                    <li>

                        <i class="icon-home"></i>

                        <a href="dashboard.php">Home</a> 

                        <span class="icon-angle-right"></span>

                    </li>

                    <li>

                        <a href="list_contents.php">List Content</a>

                        <span class="icon-angle-right"></span>

                    </li>

                    <li><a href="#">Content</a></li>

                </ul>

            </div>

        </div>

        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->

        

        

        <div class="row-fluid">

            <div class="span12">

                <!-- BEGIN VALIDATION STATES-->

                <div class="btn-group" style="margin-bottom:10px; float:right">

                    <a href="list_contents.php"><button id="sample_editable_1_new" class="btn green">

                    List Content

                    </button></a>

                </div>

                <div class="portlet box green">

                    <div class="portlet-title">

                        <div class="caption"><i class="icon-reorder"></i>Content</div>

                        

                    </div>

                    <div class="portlet-body form">

                        <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">

							<div class="alert alert-error hide">

                                <button class="close" data-dismiss="alert"></button>You have some form errors. Please check below.

							</div>                            

                            <div class="control-group">

                                <label class="control-label">Page Name<span class="required">*</span></label>

                                <div class="controls">

                                	<input type="text" name="page_name" value="<?php echo $db_category[0]['page_name']; ?>" class="span6 m-wrap required"/>

                                </div>                               

                            </div>

                            <div class="control-group">

                                <label class="control-label">Detail<span class="required">*</span></label>

                                <div class="controls">

                                	<script type="text/javascript" src="../admin/assets/plugins/ckeditor/ckeditor.js" ></script>    

									<textarea cols="80" id="detail" name="detail" rows="10" class="span6 m-wrap required"><?php echo $db_category[0]['detail']; ?></textarea>

    									<script type="text/javascript">

							  				CKEDITOR.replace( 'detail' );

							   			</script>       

                                </div>                               

                            </div>

                             <div class="control-group">

                                <label class="control-label">SEO Title<span class="required">*</span></label>

                                <div class="controls">

                                	<input type="text" name="seo_title" value="<?php echo $db_category[0]['seo_title']; ?>" class="span6 m-wrap required"/>

                                </div>                               

                            </div>

                            <div class="control-group">

                                <label class="control-label">SEO Meta<span class="required">*</span></label>

                                <div class="controls">

                                	<input type="text" name="seo_meta" value="<?php echo $db_category[0]['seo_meta']; ?>" class="span6 m-wrap required"/>

                                </div>                               

                            </div>

                             <div class="control-group">

                                <label class="control-label">SEO Keywords<span class="required">*</span></label>

                                <div class="controls">

                                	<input type="text" name="seo_keywords" value="<?php echo $db_category[0]['seo_keywords']; ?>" class="span6 m-wrap required"/>

                                </div>                               

                            </div>

                                                    

                            <div class="form-actions">

	                            <?php if($_GET['id'] == '') { ?>

                                <input type="submit" name="submit" class="btn blue" value="Add">

                                <?php } else { ?>

                                <input type="submit" name="update" class="btn blue" value="Edit">
                                <?php
								 $page_ids = array('5','17','6','20'); 
								 if(!in_array($_GET['id'],$page_ids)) { ?>
								 <a href="add_new_content.php?did=<?php echo $_GET['id']; ?>" onclick="return delete_order('<?php echo $_GET['id']; ?>');"  class="btn red" >Delete Page</a><?php } ?>
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