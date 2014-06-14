<?php
if(isset($_POST['submit']))
{
	/*$email=$_POST['members'];
	$str_email='';
	for($i=0;$i<count($email);$i++)
	{
	
			
		if($str_email=='')
		{			
			$select_mem = "select * from members where Id='".$email[$i]."'";
			$db_mem = $obj->select($select_mem);
			
			$str_email=$db_mem[0]['email_id'];
		}
		else
		{
			$select_mem = "select * from members where Id='".$email[$i]."'";
			$db_mem = $obj->select($select_mem);
			
			$str_email.=','.$db_mem[0]['email_id'];
		}
	}*/
	if($_POST['drpMembers'] == "All")
	{
		$select_mem = "select * from members";
	}
	else
	{
		$select_mem = "select * from members where status = '".$_POST['drpMembers']."'";
	}
	$db_mem = $obj->select($select_mem);
	for($i=0;$i<count($db_mem);$i++)
	{
		$str_email[]=$db_mem[$i]['email_id'];		
	}
	
	for($i=0;$i<count($str_email);$i++)
	{
		$to  = $str_email[$i];
		$subject = $_POST['Subject'];
		$message = $_POST['Email_body'];
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";	
		$headers .= 'From: Kannada Lagna <info@kannadalagna.com>';
		mail($to, $subject, $message, $headers);		
	}
	echo '<script>alert("Email Send Successfully.")</script>';
	echo "<script> window.location.href = 'send_group_emails.php' </script>";
}
	
$select_member= "select * from members";
$db_member = $obj->select($select_member);
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
                   Send Group Email                   
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                    </li>
                   
                    <li>Send Group Email</li>
                </ul>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        
        
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <!--<div class="btn-group" style="margin-bottom:10px; float:right">
                    <a href="list_body_types.php"><button id="sample_editable_1_new" class="btn green">
                    List Body Types
                    </button></a>
                </div>-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Group Email</div>
                        
                    </div>
                    <div class="portlet-body form">
                        <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
                            <div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>You have some form errors. Please check below.
                            </div>
                            <div class="control-group">
	                            <label class="control-label">To<span class="required">*</span></label>
                                <div class="controls">
	                              <select id="drpMembers" name="drpMembers" class="m-wrap medium required">
                                  	<option value="Active">Active</option>
                                    <option value="Deactive">Inactive</option>
                                    <option value="Paid">Paid</option>
                                    <option value="All">All</option>
                                  </select>Members
                                </div>
                            </div>
                            <div class="control-group">
	                            <label class="control-label">Subject<span class="required">*</span></label>
                                <div class="controls">
	                                <input type="text" name="Subject" id="Subject" value="" class="m-wrap medium required"/>
                                </div>
                            </div>                            
                            <div class="control-group">
	                            <label class="control-label">Body of Email<span class="required">*</span></label>
                                <div class="controls">
                                	<textarea name="Bemail" class="m-wrap Large required" style="width:50%;height:150px;"></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" name="submit" class="btn blue" value="Send">
                            </div>
                        </form>
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