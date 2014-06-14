<?php
if(isset($_POST['submit']))

{

	$usertype = $_POST['UserType'];

	$subject = $_POST['Subject'];

	$message = $_POST['Message'];

	

	$insert = "insert into newsletter(Id, UserType, Subject, Message) values(null, '".$usertype."', '".$subject."', '".$message."')";

	$db_insert = $obj->insert($insert);

	if($usertype == '')

	{

		$select_mem = "select * from members";

	}

	else

	{

		$select_mem = "select * from members where status = '".$usertype."'";

	}

	$db_mem = $obj->select($select_mem);

	for($i=0;$i<count($db_mem);$i++)

	{

		$to = $db_mem[$i]['email_id'];

		$subject = $subject;

		$message = $message;

		$headers = "MIME-Version: 1.0" . "\r\n";

		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";	

		$headers .= 'From: Catholic HUB Matrimonial <info@catholichub.com>';

		mail($to,$subject,$message,$headers);

	}

	echo "<script> alert('Message Sent !!!'); </script>";

	echo "<script> window.location.href = 'list_newsletter.php' </script>";

}

$select_category = "select * from newsletter where Id = '".$_GET['id']."'";

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

                        <a href="list_newsletter.php">List Newsletter</a>

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

                    <a href="list_newsletter.php"><button id="sample_editable_1_new" class="btn green">

                    List Newsletter

                    </button></a>

                </div>

                <div class="portlet box green">

                    <div class="portlet-title">

                        <div class="caption"><i class="icon-reorder"></i>Newsletter</div>

                        

                    </div>

                    <div class="portlet-body form">

                        <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">

							<div class="alert alert-error hide">

                                <button class="close" data-dismiss="alert"></button>You have some form errors. Please check below.

							</div>                            

                            <div class="control-group">

                                <label class="control-label">To<span class="required">*</span></label>

                                <div class="controls">

                                	<select class="span6 m-wrap required" name="UserType">

	                                    <option value="" selected="selected">---Select---</option>

                                    	<option value="All" <?php if($db_category[0]['UserType'] == "All")  { ?> selected="selected" <?php } ?>>All</option>

                                        <option value="Active" <?php if($db_category[0]['UserType'] == "Active")  { ?> selected="selected" <?php } ?>>Active</option>

                                        <option value="Deactive" <?php if($db_category[0]['UserType'] == "Deactive")  { ?> selected="selected" <?php } ?>>Inactive</option>

                                    </select>

                                </div>                               

                            </div>

                            <div class="control-group">

                                <label class="control-label">Subject<span class="required">*</span></label>

                                <div class="controls">

                                	<input type="text" name="Subject" value="<?php echo $db_category[0]['Subject']; ?>" class="span6 m-wrap required"/>

                                </div>                               

                            </div>

                            <div class="control-group">

                                <label class="control-label">Detail<span class="required">*</span></label>

                                <div class="controls">

                                	<script type="text/javascript" src="../administrator/assets/ckeditor/ckeditor.js" ></script>    

									<textarea cols="80" id="Message" name="Message" rows="10" class="span6 m-wrap required"><?php echo $db_category[0]['Subject']; ?></textarea>

    									<script type="text/javascript">

							  				CKEDITOR.replace( 'Message' );

							   			</script>       

                                </div>                               

                            </div>                             

                                                    

                            <div class="form-actions">	  
                            	<?php if($_GET['id'] == "")  { ?>                          
						        <input type="submit" name="submit" class="btn blue" value="Send"> <?php } ?>
                                <a href="send_newsletter.php?Id=<?php echo $_GET['id']; ?>" onclick="return delete_order('<?php echo $_GET['id']; ?>');"  class="btn red" >Delete Newsletter</a>                                
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