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
				  		date_of_birth = '".date('Y-m-d',strtotime($_POST['datepicker']))."',age = '".$age."',religion = '".$_POST['religion']."',
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
	$update_page="UPDATE members 
				  SET 
				  	password = '".md5($_POST['new_pwd'])."' 
				  where 
				  	id = '".$_GET['id']."'";
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

if(isset($_GET['memid']))
{
	$select_member="select * from members where member_id='".$_GET['memid']."'";
	$db_member=$obj->select($select_member);
}
else
{
	$select_member="select * from members where id='".$_GET['id']."'";
	$db_member=$obj->select($select_member);
}

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
            <li><a class="advance_form_with_chosen_element" href="#tab_2" data-toggle="tab">Basic Information</a></li>
            <li><a class="advance_form_with_chosen_element" href="#tab_3" data-toggle="tab">Education and Occupation</a></li>
            <li><a class="advance_form_with_chosen_element" href="#tab_4" data-toggle="tab">Socio Religious</a></li>
            <li><a class="advance_form_with_chosen_element" href="#tab_5" data-toggle="tab">Physical Status and LifeStyle</a></li>
            <li><a class="advance_form_with_chosen_element" href="#tab_6" data-toggle="tab">Family Details</a></li>
            <li><a class="advance_form_with_chosen_element" href="#tab_7" data-toggle="tab">Partener Preference</a></li>
          </ul>
          <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Profile</div>
                <div class="tools"  style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
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
                        <div class="controls"> <span class="text"><?php echo date('d-m-Y',strtotime($db_member[0]['date_of_birth'])); ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Religion:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['religion']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Mother Tongue:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['mother_tongue']; ?></span> </div>
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
                    
                  </div>
                  <!-- END FORM--> 
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane " id="tab_2">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Basic Information</div>
                <div class="tools" style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              </div>
              <div class="portlet-body form"> 
                <!-- BEGIN FORM-->
                <div class="form-horizontal form-view">
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Name:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['name']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Gender:</label>
                        <div class="controls"> <span class="text"><?php if($db_member[0]['gender'] == "M") { echo "Male"; } else { echo "Female"; } ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Age:</label>
                        <div class="controls"> <span class="text">
                         <?php echo $db_member[0]['age']." Years"; ?>
                          </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Date of Birth:</label>
                        <div class="controls"> <span class="text"><?php echo date('d-m-Y',strtotime($db_member[0]['date_of_birth'])); ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Place of Birth:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['place_of_birth']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label">Marital Status:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['relationship_status']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                    
                    <!--/row--> 
                    
                    <!--/row-->
                    <div class="row-fluid">
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >No of Children & Living Status:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['noof_children_living_status']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span-->
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Time of Birth:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['time_of_birth']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span--> 
                    </div>                    
                  </div>
                  <!-- END FORM--> 
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane " id="tab_3">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Education and Occupation</div>
                <div class="tools" style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              </div>
              <div class="portlet-body form"> 
                <!-- BEGIN FORM-->
                <div class="form-horizontal form-view">
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Education:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['education']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Employed in :</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['employed_in']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Occupation:</label>
                        <div class="controls"> <span class="text">
                        <?php echo $db_member[0]['occupation']; ?>
                          </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Annual Income:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['annual_income']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  
                  <!-- END FORM--> 
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane " id="tab_4">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Socio Religious</div>
                <div class="tools" style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              </div>
              <div class="portlet-body form"> 
                <!-- BEGIN FORM-->
                <div class="form-horizontal form-view">
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Religion:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['religion']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Subcaste/Sec :</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['subcaste']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Language:</label>
                        <div class="controls"> <span class="text">
                        <?php echo $db_member[0]['mother_tongue']; ?>
                          </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Moonsign:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['moonsign']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Manglik/Dosham:</label>
                        <div class="controls"> <span class="text">
                        <?php echo $db_member[0]['manglik_dosham']; ?>
                          </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Caste/Division:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['caste']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Gothram:</label>
                        <div class="controls"> <span class="text">
                        <?php echo $db_member[0]['gothram']; ?>
                          </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Star:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['star']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Horoscope Match:</label>
                        <div class="controls"> <span class="text">
                        <?php echo $db_member[0]['horoscope_match']; ?>
                          </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    
                    <!--/span--> 
                  </div>
                  
                  <!--/row-->
                  
                  <!-- END FORM--> 
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane " id="tab_5">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Physical Status and LifeStyle</div>
                <div class="tools" style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              </div>
              <div class="portlet-body form"> 
                <!-- BEGIN FORM-->
                <div class="form-horizontal form-view">
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Height:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['height']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Blood Group :</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['blood_group']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Weight:</label>
                        <div class="controls"> <span class="text">
                        <?php echo $db_member[0]['weight']; ?>
                          </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Diet:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['diet']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  
                  <!-- END FORM--> 
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane " id="tab_6">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Family Details</div>
                <div class="tools" style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              </div>
              <div class="portlet-body form"> 
                <!-- BEGIN FORM-->
                <div class="form-horizontal form-view">
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Family Status:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['family_status']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Mother Occupation:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['mother_occupation']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >No of Brothers:</label>
                        <div class="controls"> <span class="text">
                         <?php echo $db_member[0]['no_of_brothers']; ?>
                          </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Family Type:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['family_type']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Father Occupation:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['father_occupation']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label">Family Origin:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['family_origin']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                    
                    <!--/row--> 
                    
                    <!--/row-->
                    <div class="row-fluid">
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >No of Sisters:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['no_of_sisters']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span--> 
                    </div>                    
                  </div>
                  <!-- END FORM--> 
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane " id="tab_7">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Partener Preference</div>
                <div class="tools"  style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              </div>
              <div class="portlet-body form"> 
                <!-- BEGIN FORM-->
                <div class="form-horizontal form-view">
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Looking for:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['looking_for']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Education:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['education']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" >Hobbies:</label>
                        <div class="controls"> <span class="text">
                         <?php echo $db_member[0]['hobbies']; ?>
                          </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" >Interest:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['Interest']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" >Relationship Status:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['relationship_status']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label">Height:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['height']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                    
                    <!--/row--> 
                    
                    <!--/row-->
                    <div class="row-fluid">
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Weight:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['no_of_sisters']; ?></span> </div>
                        </div>
                      </div>
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Star:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['star']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span--> 
                    </div> 
                    <div class="row-fluid">
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Horoscope Match:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['horoscope_match']; ?></span> </div>
                        </div>
                      </div>
                      
                      <!--/span--> 
                    </div>                   
                  </div>
                  <!-- END FORM--> 
                </div>
              </div>
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

	  reason += validatePassword(theForm.new_pwd,theForm.confirm_pwd);
	  
	  if (reason != "") {
		alert("Some fields need correction:\n" + reason);
		return false;
	  }
	  return true;
}

function validatePassword(fld,lid) {
	var error = "";
	
	if ((fld.value == "")) {
        error = "Please Enter new Password";				
    } 
	else if ((lid.value == "")) {
        error = "Please Enter confirm Password";		
    }     else if ((fld.value != lid.value)) {
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
</style>
