<?php 
if(isset($_GET['del_id']))
{
	$sqld="delete from success_member_details where id = '".$_GET['del_id']."' ";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'list_members_story.php' </script>";	
}
if(isset($_GET['del_pic']))
{
	$del_img =  $_SERVER['DOCUMENT_ROOT']."/upload/success_story/".$_GET['del_pic'];
	unlink($del_img);
	echo "<script>window.location='manage_story.php?id='".$_GET['id']."''</script>"; 
}
if(isset($_POST['update_pic']))
{
	if(!empty($_FILES['file']['name'])) 
	{
		$image_name = time().'_'. $_FILES["file"]["name"];
		move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/upload/success_story/" .$image_name);
	}
  	$update_page="UPDATE success_member_details SET photo = '".$image_name."' where id = '".$_GET['id']."'";
		
  $db_updatepage=$obj->edit($update_page);	
  echo "<script>window.location='manage_story.php?id='".$_GET['id']."''</script>";
}
if(isset($_POST['submit']))
{
		$update_page="UPDATE success_member_details
					  SET 
					  	bride_name = '".$_POST['bride_name']."',groom_name = '".$_POST['groom_name']."',address='".$_POST['address']."',
						bride_matr_id = '".$_POST['bride_id']."',groom_matr_id = '".$_POST['groom_id']."',
						email_id = '".$_POST['email_id']."',
						engag_or_marriage_date = '".date('Y-m-d',strtotime($_POST['datepicker']))."',country = '".$_POST['drpCountry']."',
						country_code = '".$_POST['drpMobcode']."',contact_no = '".$_POST['contact_no']."',
						story = '".$_POST['story']."',status = '".$_POST['drpStatus']."'
					  where 
					  	id = '".$_GET['id']."'";						
		
		$db_updatepage=$obj->edit($update_page);	
	   echo "<script>window.location='manage_story.php?id=".$_GET['id']."'</script>";					
}
$select_member="select * from success_member_details where id='".$_GET['id']."'";
$db_member=$obj->select($select_member);
//query to check access permission
$sql="select * from  admin where id='".$_SESSION['id']."'";
$ans=$obj->select($sql);	
$sql2="select * from  role where id='".$ans[0]['role_id']."'";
$ans2=$obj->select($sql2);	
$mem_permission = explode(",",$ans2[0]['member_access']); 
$story_permission = explode(",",$ans2[0]['member_story_access']); 
$plan_permission = explode(",",$ans2[0]['member_plan_access']); 
//end
?>
<div class="page-content">
<div id="portlet-config" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button"></button>
    <h3>portlet Settings</h3>
  </div>
  <div class="modal-body">
    <p>Here will be a configuration form</p>
  </div>
</div>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
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
            <li class="color-white color-light" data-style="light"></li>
          </ul>
          <label class="hidden-phone">
            <input type="checkbox" class="header" checked value="" />
            <span class="color-mode-label">Fixed Header</span> </label>
        </div>
      </div>
      <h3 class="page-title">Manage Story</h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a href="dashboard.php">Home</a> <i class="icon-angle-right"></i> </li>
        <li>Manage Story</li>
      </ul>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="tabbable tabbable-custom boxless">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Profile</a></li>
          <li><a  href="#tab_2" data-toggle="tab">Edit</a></li>
          <li><a href="#tab_3" data-toggle="tab">Photo</a></li>         
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Story Details</div>
                <div class="tools" style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              </div>
              <div class="portlet-body form"> 
                <!-- BEGIN FORM-->
                <div class="form-horizontal form-view">
                  <h3 class="form-section">Person Info</h3>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Bride Name:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['bride_name']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Groom Name:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['groom_name']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" >Bride Matrimony ID:</label>
                        <div class="controls"> <span class="text">
                         <?php echo $db_member[0]['bride_matr_id']; ?>
                          </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label">Groom Matrimony ID:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['groom_matr_id']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" >Engagement/Marriage Date:</label>
                        <div class="controls"> <span class="text"><?php echo date('d-m-Y',strtotime($db_member[0]['engag_or_marriage_date'])); ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Country:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['country']; ?></span> </div>
                      </div>
                    </div>
                  </div>
                   <div class="row-fluid">
                      <div class="span6 ">
                     	<div class="control-group">
                          <label class="control-label" >Email:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['email_id']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span-->
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Contact No:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['country_code']; ?> <?php echo $db_member[0]['contact_no']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span--> 
                  </div>
                   <div class="row-fluid">
                    <div class="span6">
                    	<div class="control-group">
                          <label class="control-label" >Story:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['story']; ?></span> </div>
                        </div>
                    </div>
                    <div class="span6">
                    	<div class="control-group">
                          <label class="control-label" >Address:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['address']; ?></span> </div>
                        </div>
                    </div>
                    </div> 
                </div>
              </div>
<div class="btn-group" style="margin-bottom:10px; float:right">
                    <a onClick="return doYouWantTo('<?php echo $_GET['id']; ?>')">
                    <button style="margin-top:5px" id="sample_editable_1_new" class="btn red">
                	    Delete This Story
                    </button></a>
                </div>
            </div>
           
            
          </div>
          <div class="tab-pane " id="tab_2">
            <div class="portlet box green">
                                  <div class="portlet-title">
                                     <h4><i class="icon-reorder"></i>Edit Story Details</h4>
                                     <div class="tools" style="display:none">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                        <a href="javascript:;" class="reload"></a>
                                        <a href="javascript:;" class="remove"></a>
                                     </div>
                                  </div>
                            <div class="portlet-body form">
            				<form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
                              <div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                                You have some form errors. Please check below. </div>
                              <div class="control-group">
                                <label class="control-label">Bride Name (Female)<span class="required">*</span></label>
                                <div class="controls">
                                  <input type="text" name="bride_name" id="bride_name" value="<?php echo $db_member[0]['bride_name']; ?>" class="span6 m-wrap required"/>
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label">Groom Name (Male)<span class="required">*</span></label>
                                <div class="controls">
                                  <input type="text" name="groom_name" value="<?php echo $db_member[0]['groom_name']; ?>" id="groom_name" class="span6 m-wrap required"/>
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label">Bride Membership Id<span class="required">*</span></label>
                                <div class="controls">
                                  <input type="text" name="bride_id" id="bride_id" value="<?php echo $db_member[0]['bride_matr_id']; ?>" onblur="check_user(this.value,1)" class="span6 m-wrap required"/>
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label">Groom Membership Id<span class="required">*</span></label>
                                <div class="controls">
                                  <input type="text" name="groom_id" id="groom_id" value="<?php echo $db_member[0]['groom_matr_id']; ?>" onblur="check_user(this.value,2)" class="span6 m-wrap required"/>
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label">Email-ID<span class="required">*</span></label>
                                <div class="controls">
                                  <input type="text" name="email_id" value="<?php echo $db_member[0]['email_id']; ?>" class="span6 m-wrap required"/>
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
                                        datepick('setDate', '<?php echo date('m/d/Y',strtotime($db_member[0]['engag_or_marriage_date'])); ?>');
                                      });
                                 </script>
                                 <p>
                                    <input type="text" id="datepicker" value="<?php echo $db_member[0]['engag_or_marriage_date']; ?>" name="datepicker" class="span6 m-wrapb required"/>
                                </div>
                              </div>
                              </p>
                              <div class="control-group">
                                <label class="control-label">Address<span class="required">*</span></label>
                                <div class="controls">
                                  <textarea name="address" rows="5" class="span6 m-wrap required"/><?php echo $db_member[0]['address']; ?></textarea>
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
                                        <option value="<?php echo $db['country']; ?>" <?php if($db['country']==$db_member[0]['country']) { ?> selected="selected"<?php } ?>><?php echo $db['country']; ?></option>
                                    <?php  } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="control-group">
                                 <label class="control-label">Country Code<span class="required">*</span></label>
                                <div class="controls">
                                  <select name="drpMobcode" class="span6 m-wrap required">
                                    <?php foreach($db_code as $db) {  ?>
                                    <option value="<?php echo $db['mob_code']; ?>" <?php if($db['mob_code']==$db_member[0]['country_code']) { ?> selected="selected"<?php } ?>><?php echo $db['mob_code']; ?></option>
                                    <?php  } ?>
                                  </select>
                                </div>
                              
                              </div>
                              <div class="control-group">
                                <label class="control-label">Contact No<span class="required">*</span></label>
                                <div class="controls">
                                  <input type="text" name="contact_no" value="<?php echo $db_member[0]['contact_no']; ?>" class="span6 m-wrap required"/>
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label">Success Story<span class="required">*</span></label>
                                <div class="controls">
                                  <textarea name="story" id="story" cols="15" rows="5" class="span6 m-wrap required"/><?php echo $db_member[0]['story']; ?></textarea>
                                </div>
                              </div>
                              
                              <div class="control-group">
                                <label class="control-label">Status<span class="required">*</span></label>
                                <div class="controls">
                               <select id="drpStatus" name="drpStatus" class="span6 m-wrap required">
                                        <option value="">select</option>
                                <option value="Approve" <?php if($db_member[0]['status']=="Approve") { ?> selected="selected" <?php } ?>>Approve</option>
                             <option value="UnApprove" <?php if($db_member[0]['status']=="UnApprove") { ?> selected="selected" <?php } ?>>UnApprove</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-actions">
                               <input type="submit" name="submit" class="btn blue" value="Save">
                              </div>
            			</form>
          </div>                              
          </div>
          </div>
          <div class="tab-pane " id="tab_3">
            <div class="portlet box green">
                                  <div class="portlet-title">
                                     <h4><i class="icon-reorder"></i>Edit Photo</h4>
                                     <div class="tools" style="display:none">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                        <a href="javascript:;" class="reload"></a>
                                        <a href="javascript:;" class="remove"></a>
                                     </div>
                                  </div>
                            <div class="portlet-body form">
            <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data" >
              <div class="alert alert-error hide">
                <button class="close" data-dismiss="alert"></button>
                You have some form errors. Please check below. </div>
              
              <div class="control-group">
                <label class="control-label" style="width:96px;">Photo<span class="required numeric">*</span></label>
                <?php
				if($db_member[0]['photo'] != "")
				{
					echo '<img class="size" src="'."/upload/success_story/".$db_member[0]['photo'].'"/>';
				 }
				else
				{
					echo '<img class="size" src="'."../images/default.jpg".'"/>';
				}
				?> 
                <input type="hidden"  id="old_photo" name="old_photo" value="<?php echo $db_member[0]['photo']; ?>" />  
                            
              </div>
              <div class="control-group" id="edit_photo" style="display:none">
                <label class="control-label">Photo<span class="required"></span></label>
                <div class="controls">
                  <input type="file" name="file" id="file">
                </div>
              </div>
              <div class="form-actions">
                <input type="button" id="edit_pic" name="edit" class="btn blue" value="Change">
                <input type="submit" id="update_pic" name="update_pic" class="btn blue" value="Save" style="display:none;">
    <a href="manage_story.php?del_pic=<?php echo $db_member[0]['photo']; ?>&id=<?php echo $db_member[0]['id']; ?>" class="btn red">Delete This Photo</a>
              </div>
            </form>
          </div>                              
         </div>
          </div>
         </div>
      </div>
    </div>
  </div>
</div>
<script>
	$('#edit_pic').click(function(){
		$('#edit_photo').css('display','block');
		$('#edit_pic').css('display','none');
		$('#update_pic').css('display','block');
	});
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

function doYouWantTo(id){
	  doIt=confirm('Do you want to delete it?');
	  if(doIt){
		window.location.href = 'manage_story.php?del_id='+id;
	  }
	  else{
		  return false;
	  }
	  return true;
	}
</script>