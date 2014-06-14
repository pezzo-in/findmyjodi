<?php

if(isset($_POST['submit']))
{
	
	$insert = "INSERT INTO website_parameter_setting( `Web_name`, `web_frienly_name`, `Title`,
	 `Description`, `Keywords`, `Google_analytics_code`, `Footer_text`, `DB_server`, `DB_user`, `Db_password`,
	  `DB_name`, `From_email`, `To_email`, `Feedback_email`, `Contact_email`, `Sales_email`, `Managing_newsline1`, 
	  `Managing_newsline2`, `Managing_newsline3`, `Noof_record_perpage`, `Noof_record_search_result`, `Noof_video_allow`, 
	  `Watermark_text`, `Noof_record_perpage_admin`, `Allow_chat`, `Allow_Vedio`, `Block_mem_by_ip`, `Wedplan_search_onpage`) 
	
	VALUES ( '".$_POST['name']."', '".$_POST['wname']."', '".$_POST['title']."', '".$_POST['descriptions']."', '".$_POST['keywords']."',
	 '".$_POST['google']."', '".$_POST['footer']."', '".$_POST['DB_Server']."', '".$_POST['DB_User']."', '".$_POST['DB_Password']."', 
	 '".$_POST['DB_Name']."', '".$_POST['Femail']."', '".$_POST['Temail']."', '".$_POST['Feedback_Email']."', '".$_POST['Contact_Email']."', 
	  '".$_POST['Sales_Email']."', '".$_POST['managing1']."', '".$_POST['managing2']."', '".$_POST['managing3']."',
	  '".$_POST['record']."', '".$_POST['search']."', '".$_POST['vedio']."', '".$_POST['watermark']."', '".$_POST['admin']."', '".$_POST['Chat']."',
	   '".$_POST['vedioallow']."', '".$_POST['Block']."', '".$_POST['Wed']."')";

	
	$record_insert = $obj->insert($insert);
	
	
	
	$fileType =	$_FILES['file1']['type'];
	$fileName = $record_insert.$_FILES['file1']['name'];
	if($fileName!='')
	{
		if(!move_uploaded_file($_FILES['file1']['tmp_name'],'web_setting_image/'.$fileName))			
		{
			$msg = "";
		}
		else
		{
			$update_image = "update website_parameter_setting set Web_logo_path = '".$fileName."' where Id = '".$record_insert."'";
			$db_image = $obj->edit($update_image);
		}
	}
	
	$fileType1 =	$_FILES['file2']['type'];
	$fileName1 = $record_insert.$_FILES['file2']['name'];
	if($fileName1!='')
	{
		if(!move_uploaded_file($_FILES['file2']['tmp_name'],'web_setting_image/'.$fileName1))			
		{
			$msg = "";
		}
		else
		{
			$update_image1 = "update website_parameter_setting set Favicon = '".$fileName1."' where Id = '".$record_insert."'";
			$db_image1 = $obj->edit($update_image1);
		}
	}
	
	
	

	
}
if(isset($_POST['submit1']))
{
	
		$update = "update seller set company_reg_no= '".$_POST['Company_no']."', Location = '".$_POST['Location']."', Firstname = '".$_POST['Firstname']."', Lastname = '".$_POST['Lastname']."', Companyname = '".$_POST['Companyname']."', Tel = '".$_POST['Tel']."', Fax = '".$_POST['Fax']."', Mobile = '".$_POST['Mobile']."', Email = '".$_POST['Email']."', Password = '".$_POST['Password']."', Subject = '".$_POST['Subject']."', Message = '".$_POST['Message']."', Type = '".$_POST['user_type']."', Ooption = '".$_POST['Ooption']."', sub_user = '".$_POST['sub_user']."' where Id = ".$_GET['id']."";
		$db_update = $obj->edit($update);	
	$fileType =	$_FILES['file']['type'];
	$fileName = $_GET['id'].$_FILES['file']['name'];
	if($fileName!='')
	{
		if(!move_uploaded_file($_FILES['file']['tmp_name'],'seller/'.$fileName))			
		{
			$msg = "";
		}
		else
		{
			$update_image = "update seller set Ephoto = '".$fileName."' where Id = ".$_GET['id']."";
			$db_image = $obj->edit($update_image);
		}
	}
	
	echo "<script>window.location.href = 'list_seller.php'</script>";
}
$select_seller = "select * from seller where Id = ".$_GET['id']."";
$db_seller = $obj->select($select_seller);
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
            <label> <span>Layout</span>
              <select class="layout-option m-wrap small">
                <option value="fluid" selected>Fluid</option>
                <option value="boxed">Boxed</option>
              </select>
            </label>
            <label> <span>Header</span>
              <select class="header-option m-wrap small">
                <option value="fixed" selected>Fixed</option>
                <option value="default">Default</option>
              </select>
            </label>
            <label> <span>Sidebar</span>
              <select class="sidebar-option m-wrap small">
                <option value="fixed">Fixed</option>
                <option value="default" selected>Default</option>
              </select>
            </label>
            <label> <span>Footer</span>
              <select class="footer-option m-wrap small">
                <option value="fixed">Fixed</option>
                <option value="default" selected>Default</option>
              </select>
            </label>
          </div>
        </div>
        <!-- END BEGIN STYLE CUSTOMIZER -->
        <h3 class="page-title"> Website Parameter Setting </h3>
        <ul class="breadcrumb">
          <li> <i class="icon-home"></i> <a href="dashboard.php">Home</a> <span class="icon-angle-right"></span> </li>
         <!-- <li> <a href="list_members.php">List Members</a> <span class="icon-angle-right"></span> </li>-->
          <li>Website Parameter Setting</li>
        </ul>
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    
    <div class="row-fluid">
      <div class="span12"> 
        <!-- BEGIN VALIDATION STATES-->
        <!--<div class="btn-group" style="margin-bottom:10px; float:right"> <a href="list_members.php">
          <button id="sample_editable_1_new" class="btn green"> List Members </button>
          </a> </div>-->
        <div class="portlet box green">
          <div class="portlet-title">
            <div class="caption"><i class="icon-reorder"></i>Parameter Setting</div>
          </div>
          <div class="portlet-body form">
            <form action="#" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
              <div class="alert alert-error hide">
                <button class="close" data-dismiss="alert"></button>
                You have some form errors. Please check below. </div>
              <div class="alert alert-success hide">
                <button class="close" data-dismiss="alert"></button>
                Your form validation is successful! </div>
              
              <div class="control-group">
                <label class="control-label">Web Name:<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="name" data-required="1" class="span6 m-wrap" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Web Frienly Name:<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="wname" data-required="1" class="span6 m-wrap" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Web Logo Path:<span class="required">*</span></label>
                <div class="controls">
                  
                   <input type="file" name="file1" class="span6 m-wrap required" id="file1" style="color:black" /><br/>
                            
                </div>
              </div>
      
             
             
                     <div class="control-group">
                      <label class="control-label">Title:</label>
                      <div class="controls">
                        <input type="text" id="title" name="title" class="span6 m-wrap"  />
                      </div>
                    </div>
                     
                    <div class="control-group">
                      <label class="control-label">Descriptions:</label>
                      <div class="controls">
                       <textarea name="descriptions" cols="50" rows="5"  class="m-wrap medium required" ></textarea> 
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">keywords:</label>
                      <div class="controls">
                      <textarea name="keywords" cols="50" rows="5"  class="m-wrap medium required" ></textarea> 
                      </div>
                    </div>
                     
             <div class="control-group">
                <label class="control-label">Favicon:<span class="required">*</span></label>
                <div class="controls">
                  
                   <input type="file" name="file2" class="span6 m-wrap required" id="file2" style="color:black" /><br/>
                            
                </div>
              </div>
              <div class="control-group">
                      <label class="control-label">Google Analytics Code:</label>
                      <div class="controls">
                      <textarea name="google" cols="50" rows="5"  class="m-wrap medium required" ></textarea> 
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Footer Text:</label>
                      <div class="controls">
                        <textarea name="footer" cols="50" rows="5"  class="m-wrap medium required" ></textarea> 
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">DB_Server:</label>
                      <div class="controls">
                        <input type="text" id="DB_Server" name="DB_Server" class="span6 m-wrap"  />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">DB_User:</label>
                      <div class="controls">
                        <input type="text" id="DB_User" name="DB_User" class="span6 m-wrap"   />
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">DB_Password:</label>
                      <div class="controls">
                        <input type="text" id="DB_Password" name="DB_Password" class="span6 m-wrap"   />
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">DB_Name:</label>
                      <div class="controls">
                        <input type="text" id="DB_Name" name="DB_Name" class="span6 m-wrap"   />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">FROM Email:</label>
                      <div class="controls">
                        <input type="text" id="Femail" name="Femail" class="span6 m-wrap"   />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">T0 Email:</label>
                      <div class="controls">
                        <input type="text" id="Temail" name="Temail" class="span6 m-wrap"  />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Feedback Email:</label>
                      <div class="controls">
                        <input type="text" id="Feedback_Email" name="Feedback_Email" class="span6 m-wrap"   />
                      </div>
                    </div>
                
                    <div class="control-group">
                      <label class="control-label">Contact Email:</label>
                      <div class="controls">
                        <input type="text" id="Contact_Email" name="Contact_Email" class="span6 m-wrap"  />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Sales Email:</label>
                      <div class="controls">
                        <input type="text" id="Sales_Email" name="Sales_Email" class="span6 m-wrap"   />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Managing News Line1:</label>
                      <div class="controls">
                        <input type="text" id="Managing1" name="managing1" class="span6 m-wrap"  />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Managing News Line2:</label>
                      <div class="controls">
                        <input type="text" id="Managing2" name="managing2" class="span6 m-wrap"  />
                      </div>
                    </div>
                  
                    
                    <div class="control-group">
                      <label class="control-label">Managing News Line3:</label>
                      <div class="controls">
                        <input type="text" id="Managing3" name="managing3" class="span6 m-wrap"  />
                      </div>
                    </div>
                    

              
              			<div class="control-group">
                                <label class="control-label">No Records Per Page:<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="record" data-required="1" class="span6 m-wrap required"/>
                                </div>
                            </div>
              			<div class="control-group">
                                <label class="control-label">No Records On Search Result:<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="search" data-required="1" class="span6 m-wrap required"/>
                                </div>
                        </div>
                            
                            
                            <div class="control-group">
                                <label class="control-label">No of Videos Allow:<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="vedio" data-required="1" class="span6 m-wrap"/>
                                </div>
                            </div>
	
    				 <div class="control-group">
                                <label class="control-label">Watermark Text:<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="watermark" data-required="1" class="span6 m-wrap required"/>
                                </div>
                            </div>
 	                        <div class="control-group">
                                <label class="control-label">No Records Per Page(Admin):<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="admin" data-required="1" class="span6 m-wrap required"/>
                                </div>
                            </div>
                            
            
           
                <div class="control-group">
                <label class="control-label">Allow Chat:<span class="required">*</span></label>
                <div id="genderRadio">
                  <div class="controls"> Yes
                    <input type="radio"  id="chatyes" name="Chat" value="Y" />
                    NO
                    <input type="radio" id="chatno" name="Chat" value="N" />
                  </div>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Allow Vedio:<span class="required">*</span></label>
                <div id="genderRadio">
                  <div class="controls"> Yes
                    <input type="radio"  id="vedioyes" name="vedioallow" value="Y" />
                    No
                    <input type="radio" id="vediono" name="vedioallow" value="N" />
                  </div>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Block Member By IP:<span class="required">*</span></label>
                <div id="genderRadio">
                  <div class="controls"> Yes
                    <input type="radio"  id="blockyes" name="Block" value="Y" />
                    No
                    <input type="radio" id="blockno" name="Block" value="N" />
                  </div>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Wedding Planner Search Show On Page:<span class="required">*</span></label>
                <div id="genderRadio">
                  <div class="controls"> Yes
                    <input type="radio"  id="wedyes" name="Wed" value="Y" />
                    No
                    <input type="radio" id="wedno" name="Wed" value="N" />
                  </div>
                </div>
              </div> 
   
                 
                            
              <div class="form-actions">
                <?php if($_GET['id'] == '') { ?>
                <input type="submit" name="submit" class="btn blue" value="Add">
                <?php } else { ?>
                <input type="submit" name="update" class="btn blue" value="Edit">

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
function validateFormOnSubmit(theForm) {
var reason = "";
  reason += validateUsername(theForm.name);
  reason += validatePhone(theForm.mobile_no);
      
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }
  return true;
}
function validateUsername(fld) {
    var error = "";
    var illegalChars = /[^a-z]/i; // allow characters and spaces
 	
    if (illegalChars.test(fld.value)) {
        error = "The Username should not be numeric.\n";
    } else {
        fld.style.background = 'White';
    } 
    return error;
}
function trim(s)
{
  return s.replace(/^\s+|\s+$/, '');
} 
function validatePhone(fld) {
    var error = "";
    var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');     
	if(fld.value != "")
	{
   		if(isNaN(parseInt(stripped))) {
        	error = "The phone number should be numeric only.\n";        
		}
    }  
    return error;
}
$(function() {
		$('#drpCountry').change( function() {
			var val = $(this).val();
				$.ajax({
				   url: 'findPhoneCode.php',
				   dataType: 'html',
				   data: { country : val },
				   success: function(data) {
					   $('#drpMobcodedata').html( data );
				   }
				});			
		});	
		$('#drpMobcodedata').change( function() {
			var val = $('#drpMobcode').val();
				$.ajax({
				   url: 'findCountry.php',
				   dataType: 'html',
				   data: { phoneCode : val },
				   success: function(data) {
					   $('#drpCountry').html( data );
				   }
				});			
		});		
		$('#drpProfile_for').click( function() {
			var val = $('#drpProfile_for').val();
				$.ajax({
				   url: 'makeSelect.php',
				   dataType: 'html',
				   data: { pro_for : val },
				   success: function(data) {
					   $('#genderRadio').html( data );
				   }
				});			
		});	
	});
	
</script>
