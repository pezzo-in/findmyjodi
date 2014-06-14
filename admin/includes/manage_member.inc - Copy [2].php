<?php
 
if(isset($_POST['update']))
{
	$today = new DateTime();
	$birthdate = new DateTime($_POST['datepicker']);
	$interval = $today->diff($birthdate);
	$age = $interval->format('%y years');
	
	$update_page="UPDATE members 
				  SET 
				  		profile_for = '".$_POST['drpProfile_for']."',name = '".$_POST['name']."',gender = '".$_POST['Rdgender']."',
				  		date_of_birth = '".date('Y-m-d',strtotime($_POST['datepicker']))."',
						place_of_birth = '".$_POST['birth_place']."',
						noof_children_living_status = '".$_POST['noof_children_living_status']."',
						time_of_birth = '".$_POST['birth_hr'].":".$_POST['birth_min'].":".$_POST['birth_sec']."',
						education = '".$_POST['education']."',occupation = '".$_POST['occupation']."',
						employed_in = '".$_POST['employed_in']."',annual_income = '".$_POST['annual_income']."',
						gothram = '".$_POST['gothram']."',star = '".$_POST['star']."',
						moonsign = '".$_POST['moonsign']."',horoscope_match = '".$_POST['horoscope_match']."',
						manglik_dosham	= '".$_POST['manglik_dosham']."',height = '".$_POST['height']."',
						weight = '".$_POST['weight']."',blood_group = '".$_POST['blood_group']."',
						complexion = '".$_POST['complexion']."',diet = '".$_POST['diet']."',
						family_type = '".$_POST['family_type']."',family_status = '".$_POST['family_status']."',
						family_origin = '".$_POST['family_origin']."',father_occupation = '".$_POST['father_occupation']."',
						mother_occupation = '".$_POST['mother_occupation']."',no_of_brothers = '".$_POST['no_of_brothers']."',
						no_of_sisters = '".$_POST['no_of_sisters']."',resident_status = '".$_POST['resident_status']."',
						looking_for = '".$_POST['looking_for']."',partner_prefrence = '".$_POST['partner_prefrence']."',
						hobbies = '".$_POST['hobbies']."',					 
						age = '".$age."',religion = '".$_POST['religion']."',
						mother_tongue = '".$_POST['mother_tongue']."',caste = '".$_POST['caste']."',country = '".$_POST['drpCountry']."',
						mob_code = '".$_POST['mob_code']."',email_id = '".$_POST['email']."', password = '".md5($_POST['password'])."',
						reg_date = '".date('Y-m-d',strtotime($_POST['reg_datepicker']))."',day = '".date('d')."',month = '".date('m')."',year = '".date(Y)."'
				 where 
				 		id = '".$_GET['id']."'";
						
						$db_updatepage=$obj->edit($update_page);	
						echo "<script>window.location='manage_members.php?id = '".$_GET['id']."''</script>";
}
if(isset($_POST['save_pwd']))
{
	if($_POST['new_pwd']!="")
	{
	$update_page="UPDATE members 
				  SET 
				  	password = '".md5($_POST['new_pwd'])."' 
				  where 
				  	id = '".$_GET['id']."'";
	}
	else
	{
		$update_page="UPDATE members 
				  SET 
				  	password = '".md5($_POST['saved_pwd'])."' 
				  where 
				  	id = '".$_GET['id']."'";
	}
	$db_updatepage=$obj->edit($update_page);	
	echo "<script>window.location='list_members.php'</script>";
}

if(isset($_GET['del']))
{
	$sqld="update members 
		   set 
		   		is_deleted = 'Y' 
			where 
				id = '".$_GET['del']."' ";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'list_members.php' </script>";	
}
if(isset($_POST['del_pic']))
{
	for($i=0;$i<count($_POST['chkPic']);$i++)
	{
		$sqld="delete from member_photos where member_id = '".$_GET['id']."' and photo = '".$_POST['chkPic'][$i]."' ";
		$obj->sql_query($sqld);
	}
	echo "<script> window.location.href = 'manage_member.php?id='".$_GET['id']."''; </script>";	
}
if(isset($_POST['update_pic']))
{
	for ($i = 0; $i < count($_FILES['file']); $i++) {
			$fileLink =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/". $_FILES['file']['name'][$i];
			$fileType = $_FILES['file']['type'][$i];
			$fileSize = ($_FILES['file']['type'][$i]) / 1024;
			$source = "$fileLink";			
			if ((move_uploaded_file($_FILES["file"]["tmp_name"][$i], $source))) {
				$insert="INSERT into member_photos(id,member_id,photo)
						 values
						 (NULL,'".$_GET['id']."','".$_FILES["file"]["name"][$i]."')";											
				$db_ins=$obj->insert($insert);
			}			
		}
	echo "<script> window.location.href = 'manage_member.php?id='".$_GET['id']."''; </script>";	
}

$select_member="select * from members where id='".$_GET['id']."'";
$db_member=$obj->select($select_member);

$select_photo="select * from member_photos where member_id='".$_GET['id']."'";
$db_photo=$obj->select($select_photo);
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
      <h3 class="page-title">Manage Member</h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a href="dashboard.php">Home</a> <i class="icon-angle-right"></i> </li>
        <li>Manage Client</li>
      </ul>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="tabbable tabbable-custom boxless">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Profile</a></li>
          <li><a  href="#tab_2" data-toggle="tab">Password</a></li>
          <li><a href="#tab_3" data-toggle="tab">Photo</a></li>
          <li><a  href="#tab_4" data-toggle="tab">Plan</a></li>          
        </ul>
        <div class="tab-content">
          <div class="tab-pane " id="tab_1">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Member Details</div>
                <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              </div>
              <div class="portlet-body form"> 
                <!-- BEGIN FORM-->
                <div class="form-horizontal form-view">
                  <h3 class="form-section">Person Info</h3>
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Matrimony Profile for:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['profile_for']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Name:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['name']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Gender:</label>
                        <div class="controls"> <span class="text">
                          <?php 
													if($db_member[0]['gender'] == "F"){ 
													echo "Female";
													} 
													else
													 {
														  echo "Male";
														   } ?>
                          </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Date of Birth:</label>
                        <div class="controls"> <span class="text bold"><?php echo date('d-m-Y',strtotime($db_member[0]['date_of_birth'])); ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Religion:</label>
                        <div class="controls"> <span class="text bold"><?php echo $db_member[0]['religion']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Mother Tongue:</label>
                        <div class="controls"> <span class="text bold"><?php echo $db_member[0]['mother_tongue']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                    
                    <!--/row--> 
                    
                    <!--/row-->
                    <div class="row-fluid">
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Caste/Division:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['caste']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span-->
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Country living in:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['country']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span--> 
                    </div>
                    <div class="row-fluid">
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Mobile Code:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['mob_code']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span-->
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Mobile:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['mobile_no']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span--> 
                    </div>
                    <div class="row-fluid">
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Email Id:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['email_id']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span-->
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Registration Date:</label>
                          <div class="controls"> <span class="text"><?php echo date('d-m-Y',strtotime($db_member[0]['reg_date'])); ?></span> </div>
                        </div>
                      </div>
                      <!--/span--> 
                    </div>
                    <div class="form-actions">
                      <button type="submit" class="btn blue"><i class="icon-pencil"></i> Edit</button>
                      <button type="button" class="btn">Back</button>
                    </div>
                  </div>
                  <!-- END FORM--> 
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane " id="tab_2">
            <div class="portlet box green">
              <div class="portlet-title">
                <h4><i class="icon-reorder"></i>Edit Password</h4>
                <div class="tools" style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              </div>
              <div class="portlet-body form">
                <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data"  onsubmit="return validateFormOnSubmit(this)" >
                  <div class="alert alert-error hide">
                    <button class="close" data-dismiss="alert"></button>
                    You have some form errors. Please check below. </div>
                  <div class="control-group">
                    <label class="control-label">Old Password<span class="required">*</span></label>
                    <div class="controls">
                      <input type="text" id="old_pwd" name="old_pwd" 
                        value="" class="span6 m-wrap required"/>
                      <input type="hidden" id="saved_pwd" readonly="readonly" name="saved_pwd" 
                        value="<?php echo $db_member[0]['password']; ?>"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">New Password<span class="required">*</span></label>
                    <div class="controls">
                      <input type="text" id="new_pwd" name="new_pwd" class="span6 m-wrap required"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Confirm Password<span class="required">*</span></label>
                    <div class="controls">
                      <input type="text" id="confirm_pwd" name="confirm_pwd" class="span6 m-wrap required"/>
                    </div>
                  </div>
                  <div class="form-actions">
                    <?php if($_GET['id'] == '') { ?>
                    <input type="submit" name="submit" class="btn blue" value="Add">
                    <?php } else { ?>
                    <input type="submit" name="save_pwd" class="btn blue" value="Save">
                    <?php } ?>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="tab-pane " id="tab_3">
            <div class="portlet box green">
              <div class="portlet-title">
                <h4><i class="icon-reorder"></i>Edit Photo</h4>
                <div class="tools" style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              </div>
              <div class="portlet-body form">
                <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data"  onsubmit="return validateFormOnSubmit(this)" >
                  <div class="control-group">
                    <div class="controls">
                      <label for="file">Filename:</label>
                      <input type="file" name="file[]"  class="m-wrap medium required" multiple="true" id="file" style="color:black" />
                      <br/>
                    </div>
                  </div>
                  <div class="form-actions">
                    <input type="submit" name="update_pic" id="update_pic" class="btn blue" value="Upload" >
                  </div>
                </form>
                <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data"  onsubmit="return validateFormOnSubmit(this)" >
                  <div class="alert alert-error hide">
                    <button class="close" data-dismiss="alert"></button>
                    You have some form errors. Please check below. </div>
                  <div class="control-group">
                    <label class="control-label">Photo<span class="required numeric">*</span></label>
                    <?php
				if(!empty($db_photo))
				{
					foreach($db_photo as $db)
					{
						$path =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/".$db['photo'];
						if (file_exists($path)) {
							?>
                    <input type="checkbox" name="chkPic[]" id="chk" value="<?php echo $db['photo']; ?>" />
                    <?php
							echo '<img class="size" src="'."../upload/".$db['photo'].'"/>';
						}						
					}				
				}
				else
				{
					echo '<img class="size" src="'."../images/a1.jpg".'"/>';
				}
				?>
                    <input type="hidden"  id="old_photo" name="old_photo" value="<?php echo $db_photo[0]['photo']; ?>" />
                  </div>
                  <div class="control-group" id="edit_photo" style="display:none">
                    <label class="control-label">Photo<span class="required"></span></label>
                    <div class="controls">
                      <input type="file" name="file" id="file">
                    </div>
                  </div>
                  <div class="form-actions">
                    <input type="submit" name="del_pic" class="btn blue" value="Delete">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="tab-pane " id="tab_4">
              <div class="portlet box green">
                <div class="portlet-title">
                  <h4><i class="icon-reorder"></i>Plan Detail</h4>
                  <div class="tools" style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                </div>
                <div class="portlet-body form">
                  <form  method="post" id="form_sample_2" action="paypal.php" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data"  onsubmit="return validateFormOnSubmit(this)" >
                    <div class="alert alert-error hide">
                      <button class="close" data-dismiss="alert"></button>
                      You have some form errors. Please check below. </div>
                      <h3>Your Plan detail</h3>
                      <?php $mem_plans = "SELECT m.*,ms.* FROM member_plans m JOIN membership_plans ms ON ms.id = m.member_id 
									 where m.member_id='".$_GET['id']."'";
					  		$mem_ans=$obj->select($mem_plans);							
					   ?>
                      <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                	<th></th>
                                	<th>Plan</th>
                                    <th>Duration</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php for($i=0;$i<count($mem_ans);$i++){?>
                                <tr class="odd gradeX">
	                                <input type="hidden" name="member_id" value="<?php echo $_GET['id']; ?>" />
                                    <td><?php echo $mem_ans[$i]['plan_name'];?></td>
                                    <td><?php echo $mem_ans[$i]['plan_duration']." Days";?></td>	
                                    <td><?php echo $mem_ans[$i]['plan_amount'];?></td>	                                        
                                </tr>
                                <? }?>
                            </tbody>
                        </table>
                      <?php $plans = "select * from membership_plans";
							$ans=$obj->select($plans);							
					   ?>
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                                <tr>
                                	<th>Action</th>
                                    <th>Plan</th>
                                    <th>Duration</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>                            
                            <?php
							if(!empty($ans))
							{  
								for($i=0;$i<count($ans);$i++){?>
                                <tr class="odd gradeX">
	                                <td width="10px"><input type="radio" name="rdPlanId" value="<?php echo $ans[$i]['id']; ?>" /> </td>	
                                    <td><?php echo $ans[$i]['plan_name'];?></td>	
                                    <td><?php echo $ans[$i]['plan_duration']." Days";?></td>	
                                    <td><?php echo $ans[$i]['plan_amount'];?></td>	                                        
                                </tr>
                                <? }
							}
							else
							{
								?>
                                <tr class="odd gradeX">
                                <td colspan="4">No records found</td>
                                </tr>
								<?php
							}?>
                            </tbody>
                        </table>
                    <div class="form-actions">
                      <input type="submit" name="buy_plan" class="btn blue" value="Pay Now">
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
<script type="text/javascript">

function validateFormOnSubmit(theForm) {
		var check = $("input:checkbox:checked").length
        if(check == "0")
		{
			alert('Select atleast one product to comapre');
			return false;
		}				
	   var reason = "";

	  reason += validatePassword(theForm.new_pwd,theForm.confirm_pwd,theForm.old_pwd);
	  
	  if (reason != "") {
		alert("Some fields need correction:\n" + reason);
		return false;
	  }
	  return true;
}

function validatePassword(fld,lid,oid) {
	var error = "";
	
	if ((oid.value == "")) {
        error = "Please Enter old Password";		
    }
	else if ((fld.value == "")) {
        error = "Please Enter new Password";				
    } 
	else if ((lid.value == "")) {
        error = "Please Enter confirm Password";		
    }
	     else if ((fld.value != lid.value)) {
        error = "New Password & Confirm Password does not match";		
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
	function doYouWantTo(id){

	  doIt=confirm('Do you want to delete it?');

	  if(doIt){

		window.location.href = 'list_user.php?id='+id;

	  }

	  else{

		  return false;

	  }

	  return true;

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
<style>
.size
{
	height:90px;
}
.details { display:none; }
</style>


