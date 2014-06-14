<?php
if(isset($_POST['submit']))
{
	
	if(!empty($_FILES['file']['name'])) 
	{
		$image_name = time().'_'.$_FILES["file"]["name"];
		move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/upload/success_story/".$image_name );
	
	
	$insert = "INSERT into success_member_details(id, bride_name, groom_name,address, bride_matr_id, groom_matr_id, email_id, engag_or_marriage_date, photo, country, country_code, contact_no, story, status) values(NULL, '".$_POST['bride_name']."', '".$_POST['groom_name']."','".$_POST['address']."', '".$_POST['bride_id']."', '".$_POST['groom_id']."', '".$_POST['email_id']."', '".date('Y-m-d',strtotime($_POST['datepicker']))."', '".$image_name."', '".$_POST['drpCountry']."', '".$_POST['drpMobcode']."',  '".$_POST['contact_no']."', '".$_POST['story']."', '".$_POST['drpStatus']."')";
	$db_ins=$obj->insert($insert);	
	echo "<script>window.location='list_members_story.php'</script>";
	
	}
}
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
                    Add New Story                    
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                    </li>
                    <li>
                        <a href="list_members_story.php">List Story</a>
                        <span class="icon-angle-right"></span>
                    </li>
                    <li><a href="#">List Story</a></li>
                </ul>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        
        
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="btn-group" style="margin-bottom:10px; float:right">
                    <a href="list_members_story.php"><button id="sample_editable_1_new" class="btn green">
                    List Story
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Add Story</div>                        
                    </div>
                    <div class="portlet-body form">
            <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
              <div class="alert alert-error hide">
                <button class="close" data-dismiss="alert"></button>
                You have some form errors. Please check below. </div>
              <div class="control-group">
                <label class="control-label">Bride Name (Female)<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="bride_name" id="bride_name" class="span6 m-wrap required"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Groom Name (Male)<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="groom_name" id="groom_name" class="span6 m-wrap required"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Bride Membership Id<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="bride_id" id="bride_id" onblur="check_user(this.value,1)" class="span6 m-wrap required"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Groom Membership Id<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="groom_id" id="groom_id" onblur="check_user(this.value,2)" class="span6 m-wrap required"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email-ID<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="email_id" class="span6 m-wrap required"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Engagement/Marriage Date<span class="required">*</span></label>
                <div class="controls">
                <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
                  <script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
                  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
                  <?php /*?><link rel="stylesheet" href="/resources/demos/style.css" /><?php */?>
                  <script>
					  $(function() {
						$( "#datepicker" ).datepicker({
						  showOn: "button",
						  buttonImage: "/Kannadalagna/calendar/calendar/images/iconCalendar.gif",
						  buttonImageOnly: true,
						  class:"m-wrap medium required",
						});
						datepick('setDate', '<?php echo date('m/d/Y',strtotime($db_member[0]['date_of_birth'])); ?>');
					  });
				 </script>
                 <p>
                    <input type="text" id="datepicker" name="datepicker" class="span6 m-wrapb required"/>
                </div>
              </div>
              </p>
              <div class="control-group">
                <label class="control-label">Photo<span class="required">*</span></label>
                <div class="controls">
                   <input type="file" name="file" class="span6 m-wrap required" id="file" style="color:black" /><br/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Address<span class="required">*</span></label>
                <div class="controls">
                  <textarea name="address" rows="5" class="span6 m-wrap required"/></textarea>
                </div>
              </div>
              <?php
				$select_codes = "select * from mobile_codes";
				 $db_code = $obj->select($select_codes);
				?>
              <div class="control-group">
                <label class="control-label">Country living in<span class="required">*</span></label>
                <div class="controls">
                  <select name="drpCountry"  id="drpCountry" class="span6 m-wrap required">
                     <?php foreach($db_code as $db) {  ?>
                    	<option value="<?php echo $db['country']; ?>"><?php echo $db['country']; ?></option>
                    <?php  } ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                 <label class="control-label">Country Code<span class="required">*</span></label>
                <div class="controls">
                  <select name="drpMobcode" class="span6 m-wrap required">
                    <?php foreach($db_code as $db) {  ?>
                    <option value="<?php echo $db['mob_code']; ?>"><?php echo $db['mob_code']; ?></option>
                    <?php  } ?>
                  </select>
                </div>
              
              </div>
              <div class="control-group">
                <label class="control-label">Contact No<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="contact_no" class="span6 m-wrap required"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Success Story<span class="required">*</span></label>
                <div class="controls">
                  <textarea name="story" id="story" cols="15" rows="5" class="span6 m-wrap required"/></textarea>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Status<span class="required">*</span></label>
                <div class="controls">
					<select id="drpStatus" name="drpStatus" class="span6 m-wrap required">
                    	<option value="">---select---</option>
                    	<option value="Approve">Approve</option>
                        <option value="UnApprove">UnApprove</option>
                    </select>
				
                </div>
              </div>
              <div class="form-actions">
               <input type="submit" name="submit" class="btn blue" value="Add">
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
 function check_user(val,user)
{
	$.ajax({
		url:'../check_valid_user.php',
		type:'POST',
		data:{val:val,user:user},
		success: function(data)
		{
			if(data=='1')
			{
				if(user=='1'){$('#bride_id').val(null); $('#bride_id').css('border','1px solid red');}
				else if(user=='2'){$('#groom_id').val(null); $('#groom_id').css('border','1px solid red');}
			}
		}
	});
}
</script>