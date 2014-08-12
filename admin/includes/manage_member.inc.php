<?php
error_reporting(0);
if(isset($_POST['update']))
{
	$today = date('Y-m-d');
	$birthdate = date('Y-m-d',strtotime($_POST['datepicker']));
	$age = ($today-$birthdate);
	if($_POST['new_password'] == "")
	{
		$password = $_POST['old_password'];
	}
	else
	{
		$password = md5($_POST['new_password']);
	}
	
	$eid="select * from education_course where id='".$_POST['education']."'";
	$course_eid=$obj->select($eid);
	
	$update_page="UPDATE members 
				  SET 
				  		profile_for = '".$_POST['drpProfile_for']."',
						name = '".$_POST['name']."',
						date_of_birth = '".date('Y-m-d',strtotime($_POST['datepicker']))."',
						age = '".$age."',
						gender = '".$_POST['Rdgender']."',
						country = '".$_POST['drpCountry']."',
						state= '".$_POST['state']."',
						city= '".$_POST['city']."',
						password = '".$password."',
						mob_code = '".$_POST['mob_code']."',
						mobile_no= '".$_POST['mobile_no']."',
						relationship_status='".$_POST['drpRel']."',
						religion = '".$_POST['religion']."',
						caste = '".$_POST['caste']."',
						mother_tongue = '".$_POST['mother_tongue']."',
						gothram = '".$_POST['gothram']."',
						height = '".$_POST['height']."',
						weight = '".$_POST['weight']."',
						body_type='".$_POST['btype']."',
						complexion = '".$_POST['complexion']."',
						physical_status= '".$_POST['phy_status']."',
						education = '".$_POST['education']."',
						degree_in = '".$course_eid[0]['Eid']."',
						occupation = '".$_POST['drpOccupation']."',
						employed_in = '".$_POST['employed_in']."',
						annual_income = '".$_POST['drpIncome']."',
						food='".$_POST['food']."',
						is_smoker='".$_POST['smoke']."',
						is_drinker='".$_POST['drink']."',
						star = '".$_POST['drpStar']."',
						manglik_dosham	= '".$_POST['rdManglik']."',
						subcaste='".$_POST['subcaste']."',
						no_of_brothers = '".$_POST['num_bro']."',
						no_of_sisters = '".$_POST['num_sis']."',
						bro_married = '".$_POST['num_bro_married']."',
						sis_married = '".$_POST['num_sis_married']."',
						living_with_parents = '".$_POST['live_parents']."',
						family_status = '".$_POST['family_status']."',
						family_type = '".$_POST['family_type']."',
						family_value = '".$_POST['family_values']."',
						about_me = '".$_POST['about_me']."'
		
						where 
						 
				 		id = '".$_GET['id']."'";
						$db_updatepage=$obj->edit($update_page);	
						
		$mem_hobbies = implode(",",$_POST['chkHobbies']);
		$final_mem_hobbies["mem_hobbies"] = ($mem_hobbies);
		
		$mem_int = implode(",",$_POST['chkInterests']);
		$final_mem_int["mem_int"] = ($mem_int);
		
		$mem_music = implode(",",$_POST['chkMusic']);
		$final_mem_music["mem_music"] = ($mem_music);
		
		$mem_read = implode(",",$_POST['chkRead']);
		$final_mem_read["mem_read"] = ($mem_read);
		
		$mem_movies = implode(",",$_POST['chkMovies']);
		$final_mem_movies["mem_movies"] = ($mem_movies);
		
		$mem_sports = implode(",",$_POST['chkSports']);
		$final_mem_sports["mem_sports"] = ($mem_sports);
		
		$mem_couisine = implode(",",$_POST['chkCouisine']);
		$final_mem_couisine["mem_couisine"] = ($mem_couisine);
		
		$mem_dress = implode(",",$_POST['chkDress']);
		$final_mem_dress["mem_dress"] = ($mem_dress);
		
		$mem_lang = implode(",",$_POST['chkLang']);
		$fianl_mem_lang["mem_lang"] = ($mem_lang);
		
		
		
		$upd = "update memebr_hobbies_interest set hobbies='".$final_mem_hobbies["mem_hobbies"]."',
		interests= '".$final_mem_int["mem_int"]."',
		music='".$final_mem_music["mem_music"]."',read_book='".$final_mem_read["mem_read"]."',
		movies='".$final_mem_movies["mem_movies"]."',
		sports= '".$final_mem_sports["mem_sports"]."',
		cuisine='".$final_mem_couisine["mem_couisine"]."',
		dress_style= '".$final_mem_dress["mem_dress"]."',
		spoken_lang='".$fianl_mem_lang["mem_lang"]."'
					 where 
				 		member_id = '".$_GET['id']."'";
						
					//	echo $upd;
		
		$updt = $obj->edit($upd);	
		
		
		
		$update_mem_int = "update members 
						  set
						  Interest = '".$final_mem_int["mem_int"]."'
						  where
						  id = '".$_GET['id']."'";
					//echo $update_mem_int;	 
						 
		$update_sql = $obj->edit($update_mem_int);
						
		echo "<script>window.location.href='manage_member.php?id='".$_GET['id']."'</script>";
						
						
						
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
if(isset($_GET['del_id']))
{
	$sqld="delete from members where id = '".$_GET['del_id']."' ";
	$obj->sql_query($sqld);
	$del="delete from memebr_hobbies_interest where member_id='".$_GET['del_id']."'";
	$obj->sql_query($del);
	echo "<script> window.location.href = 'list_members.php' </script>";	
}
if(isset($_GET['del']))
{
	$sqld="update members 
		   set 
		   		is_deleted = 'Y', status='Deactive' 
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
			$fileLink = "../second/upload/".$_FILES['file']['name'][$i];
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

$select_religion="select * from religions";
$data=$obj->select($select_religion);

$select_caste ="select * from caste";
$caste=$obj->select($select_caste);


$select_member="select * from members where id='".$_GET['id']."'";
$db_member=$obj->select($select_member);
$select_photo="select * from member_photos where member_id='".$_GET['id']."'";
$db_photo=$obj->select($select_photo);

$select_lang="select * from mother_tongues";
$languages=$obj->select($select_lang);

$select_country="select * from mobile_codes";
$countries=$obj->select($select_country);


 
 
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
          <li><a href="#tab_5" data-toggle="tab">Edit</a></li>
          <!--<li><a  href="#tab_2" data-toggle="tab">Password</a></li>
          <li><a href="#tab_3" data-toggle="tab">Photo</a></li>-->
          <li><a  href="#tab_4" data-toggle="tab">Plan</a></li>          
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Member Details</div>
                
              </div>
              <div class="portlet-body form"> 
                <!-- BEGIN FORM-->
                <div class="form-horizontal form-view">
                  <h3 class="form-section">Person Info</h3>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Matrimony Profile for:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['profile_for']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Name:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['name']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6">
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
                          <label class="control-label" >Email Id:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['email_id']; ?></span> </div>
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
                      
                      
                    </div>
                 
                  </div>
                  
                  <h3 class="form-section">Physical Info</h3>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Height:</label>
                        <div class="controls"> 
                        	<span class="text">
                            <?php 
							$select_height="select * from height where Id='".$db_member[0]['height']."'";
							$db_height=$obj->select($select_height);
							echo $db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
							if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }
							?>
                            </span> 
                        </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Weight:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['weight']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <!--/row-->
                  
                  <!--/row-->
                  <div class="row-fluid">
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Body Type:</label>                       
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['body_type']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                      <div class="control-group">
                        <label class="control-label" >Complexion:</label>
                         
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['complexion']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                    
                    <!--/row--> 
                    
                    <!--/row-->
                    <div class="row-fluid">
                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Physical Status:</label>
                          
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['physical_status']; ?></span> </div>
                        </div>
                      </div>
                      
                      <!--/span-->

                      <div class="span6 ">
                        <div class="control-group">
                          <label class="control-label" >Food:</label>
                          <div class="controls"> <span class="text"><?php echo $db_member[0]['food']; ?></span> </div>
                        </div>
                      </div>
                      <!--/span--> 
                    </div>
                    
                    <h3 class="form-section">Education & Occupation</h3>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Education:</label>
                        <?php
						$select_education="select * from education_course where Id='".$db_member[0]['education']."'";
						$db_education=$obj->select($select_education);
						?>
                        <div class="controls"> <span class="text"><?php echo $db_education[0]['Title']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Occupation:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['occupation']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Employee In:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['employed_in']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Annual Income:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['annual_income']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <h3 class="form-section">Habits</h3>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Smoking:</label>
                        <div class="controls"> <span class="text"><?php if($db_member[0]['is_smoker'] == 'O') { echo "Occasionally"; } if($db_member[0]['is_smoker'] == 'N') { echo "No"; } if($db_member[0]['is_smoker'] == 'Y') { echo "Yes"; }  ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Drinking:</label>
                        <div class="controls"> <span class="text"><?php if($db_member[0]['is_drinker'] == 'O') { echo "Occasionally"; } if($db_member[0]['is_drinker'] == 'N') { echo "No"; } if($db_member[0]['is_drinker'] == 'Y') { echo "Yes"; }  ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <h3 class="form-section">Family Info</h3>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Family Type:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['family_type']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Family Status:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['family_status']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Family Values:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['family_value']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Your Self:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['about_me']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <?php
				  
				$select_memebr_hobbies_interest="select * from memebr_hobbies_interest where member_id='".$_GET['id']."'";
				$db_memebr_hobbies_interest=$obj->select($select_memebr_hobbies_interest);
				?>
				  
                  <h3 class="form-section">Hobbies & Interests</h3>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Hobbies:</label>
                        <div class="controls"> <span class="text">
                        <?php
						$select_hobbies="select * from hobbies where id IN(".$db_memebr_hobbies_interest[0]['hobbies'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Interests:</label>
                        <div class="controls"> <span class="text">
                        <?php
						$select_hobbies="select * from interest where id IN(".$db_memebr_hobbies_interest[0]['interests'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Favourite Music:</label>
                        <div class="controls"> <span class="text">
                        <?php
						$select_hobbies="select * from music where id IN(".$db_memebr_hobbies_interest[0]['music'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Favourite Read:</label>
                        <div class="controls"> <span class="text">
                        <?php
						$select_hobbies="select * from tbl_read where id IN(".$db_memebr_hobbies_interest[0]['read_book'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Favourite movie:</label>
                        <div class="controls"> <span class="text">
                        <?php
						$select_hobbies="select * from movies where id IN(".$db_memebr_hobbies_interest[0]['movies'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Sports Activities:</label>
                        <div class="controls"> <span class="text">
                        <?php
						$select_hobbies="select * from activities where id IN(".$db_memebr_hobbies_interest[0]['sports'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Favourite Couisine:</label>
                        <div class="controls"> <span class="text">
                        <?php
						$select_hobbies="select * from couisine where id IN(".$db_memebr_hobbies_interest[0]['cuisine'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Dress Style:</label>
                        <div class="controls"> <span class="text">
                        <?php
						$select_hobbies="select * from dress_style where id IN(".$db_memebr_hobbies_interest[0]['dress_style'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Spoken Languages:</label>
                        <div class="controls"> <span class="text">
                        <?php
						$select_hobbies="select * from languages where id IN(".$db_memebr_hobbies_interest[0]['spoken_lang'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    
                    <!--/span--> 
                  </div>
                  
                  <?php
				  $select_preferred_partner="select * from preferred_partner_details where from_mem=".$_GET['id'];
				 $db_preferred_partner=$obj->select($select_preferred_partner);
				  ?>
                  <h3 class="form-section">Partner Prefrence</h3>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Age:</label>
                        <div class="controls"> <span class="text">
                        <?php 
							$newage = str_replace('to',' to ',$db_preferred_partner[0]['preferred_age']);
							echo $newage;//$db_preferred_partner[0]['preferred_age']; ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Marital Status:</label>
                        <div class="controls"> <span class="text"><?php echo $db_member[0]['family_status']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Height:</label>
                        <div class="controls"> <span class="text">
                        <?php 
								$select_height="select * from height where Id='".$db_preferred_partner[0]['height']."'";
								$db_height=$obj->select($select_height);
								echo $db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
								if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }
								?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Physical Status:</label>
                        <div class="controls"> <span class="text"><?php echo $db_preferred_partner[0]['physical_status']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Religion:</label>
                        <div class="controls"> <span class="text">
                        <?php echo $db_preferred_partner[0]['religion']; ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Mother Tongue:</label>
                        <div class="controls"> <span class="text"><?php echo $db_preferred_partner[0]['mother_tongue']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Caste:</label>
                        <div class="controls"> <span class="text">
                        <?php echo $db_preferred_partner[0]['caste']; ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Manglik:</label>
                        <div class="controls"> <span class="text"><?php if($db_preferred_partner[0]['manglik']=='Y'){ echo 'Yes'; }else{ echo 'No'; } ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Star:</label>
                        <div class="controls"> <span class="text">
                        <?php echo $db_preferred_partner[0]['star']; ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Food:</label>
                        <div class="controls"> <span class="text"><?php echo $db_preferred_partner[0]['food']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  
                  
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Drinking:</label>
                        <div class="controls"> <span class="text">
                        <?php if($db_preferred_partner[0]['is_drinker']=='N'){ echo 'No'; }else{ echo 'Yes'; } ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Smoking:</label>
                        <div class="controls"> <span class="text"><?php if($db_preferred_partner[0]['is_smoker']=='N'){ echo 'No'; }else{ echo 'Yes'; } ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Country:</label>
                        <div class="controls"> <span class="text">
                       <?php echo $db_preferred_partner[0]['country']; ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">City:</label>
                        <div class="controls"> <span class="text"><?php echo $db_preferred_partner[0]['city']; ?></span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  <?php
				  	$select_education_details="select * from education_details where id='".$db_preferred_partner[0]['education']."'"; 
					$db_education_details=$obj->select($select_education_details);
				  ?>
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Education:</label>
                        <div class="controls"> <span class="text">
                       <?php echo $db_education_details[0]['degree']; ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Manglik:</label>
                        <div class="controls"> <span class="text">
						<?php if($db_preferred_partner[0]['manglik']=='N') {?>
                        <?php echo "No"; ?>
                        <?php } else { ?>
                        <?php echo "Yes"; ?>
                        <?php } ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Occupation:</label>
                        <div class="controls"> <span class="text">
                       <?php echo $db_preferred_partner[0]['occupation']; ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="lastName">Annual Income:</label>
                        <div class="controls"> <span class="text">
						<?php echo $db_preferred_partner[0]['annual_income']; ?>
                        </span> </div>
                      </div>
                    </div>
                    <!--/span--> 
                  </div>
                  
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="firstName">Partner Description:</label>
                        <div class="controls"> <span class="text">
                       <?php echo $db_preferred_partner[0]['partner_description']; ?>
                        </span> </div>
                      </div>
                    </div>
                    
                  </div>
                    
                        <div class="btn-group" style="margin-bottom:10px; float:right">
                        <a onClick="return doYouWantTo('<?php echo $db_member[0]['id']; ?>')"><button id="sample_editable_1_new" class="btn red">
                            Delete Member
                        </button></a>                    
                        </div>   
                  </div>
                  
                  
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab_5">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Edit Member Details</div>
                <div class="tools"  style="display:none"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              </div>
              <div class="portlet-body form">
                  <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal form_validate" enctype="multipart/form-data"  onsubmit="return validateFormOnSubmit(this)" >
                    <div class="alert alert-error hide">
                      <button class="close" data-dismiss="alert"></button>
                      You have some form errors. Please check below. </div>
                      
                      
                      <h3 style="color:#C33">Personal Details</h3>
                      
                      
                    <div class="control-group">
                      <label class="control-label">Matrimony Profile for<span class="required">*</span></label>
                      <div class="controls">
                        <select name="drpProfile_for"  id="drpProfile_for" class="span6 m-wrap required" onchange="gender_track(this.value);">
                          <option value="">Select</option>
                          <option value="Myself" <?php if($db_member[0]['profile_for']=="Myself") { ?> selected="selected" <?php }?>>Myself</option>
                          <option value="Son" <?php if($db_member[0]['profile_for']=="Son") { ?>selected="selected" <?php }?>>Son</option>
                          <option value="Daughter" <?php if($db_member[0]['profile_for']=="Daughter") { ?>selected="selected" <?php }?>>Daughter</option>
                          <option value="Brother" <?php if($db_member[0]['profile_for']=="Brother") { ?>selected="selected" <?php }?>>Brother</option>
                          <option value="Sister" <?php if($db_member[0]['profile_for']=="Sister") { ?>selected="selected" <?php }?>>Sister</option>
                          <option value="Relative" <?php if($db_member[0]['profile_for']=="Relative") { ?>selected="selected" <?php }?>>Relative</option>
                          <option value="Friend" <?php if($db_member[0]['profile_for']=="Friend") { ?>selected="selected" <?php }?>>Friend</option>
                        </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Name<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="name" name="name" value="<?php echo $db_member[0]['name']; ?>" class="span6 m-wrap required"  />
                      </div>
                    </div>
                    <div class="control-group">
                <label class="control-label">Date of Birth<span class="required">*</span></label>
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
         <input size="10" type="text" class="span6 m-wrap required" id="datepicker" name="datepicker"  value="<?php echo date('d/m/Y',strtotime($db_member[0]['date_of_birth'])); ?>  " />
                </div>
              </div>
              <div class="control-group">
                      <label class="control-label">Place of Birth</label>
                      <div class="controls">
                        <input type="text" id="birth_place" name="birth_place" value="<?php echo $db_member[0]['place_of_birth']; ?>" class="span6 m-wrap"  />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Gender<span class="required">*</span></label>
                      <div id="genderRadio">
                        <div class="controls">
						  <label class="radio">
                          <input type="radio" id="gendermale" class="required" name="Rdgender" value="M" <?php if($db_member[0]['gender']=="M"){ ?> checked="checked" <?php } ?> />Male
                          </label>
                          <label class="radio">
                          <input type="radio" id="genderfemale" class="required" name="Rdgender" value="F"<?php if($db_member[0]['gender']=="F"){ ?> checked="checked" <?php } ?>  />Female
                          </label>
                        </div>
                      </div>
                    </div>
                    
                     <div class="control-group">
                      <label class="control-label">Country living in<span class="required">*</span></label>
                      <div class="controls">
                      <?php $country_list = "select * from mobile_codes";
						$data = $obj->select($country_list);
					?>
                        <select name="drpCountry"  id="drpCountry" class="span6 m-wrap required" onchange="showmobcode(this.value)">
                          <option value="">Select</option>
							<?php foreach($data as $res) { ?>
                            <option value="<?php echo $res['country']; ?>" <?php if($db_member[0]['country']==$res['country']) { ?> selected="selected"<?php } ?>><?php echo $res['country']; ?></option>
                            <?php } ?>
                          </select>
                        </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">State<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="state" name="state" value="<?php echo $db_member[0]['state']; ?>" class="span6 m-wrap required"/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">City<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="city" name="city" value="<?php echo $db_member[0]['city']; ?>" class="span6 m-wrap required"/>
                      </div>
                    </div>
   					<div class="control-group">
                      <label class="control-label">Password<span class="required">*</span></label>
                      <div class="controls">
                        <input type="hidden" name="old_password" class="m-wrap medium"  id="old_password" value="<?php echo $db_member[0]['password']; ?>" />
                        <input type="password" name="new_password" class="m-wrap medium" id="new_password" /> Leave Blank if You don't want to change Password
                      </div>
                    </div>
                 
                  <?php $code = "select * from mobile_codes";
					  $db_code = $obj->select($code);	 ?>
                  <div class="control-group">
                      <label class="control-label">Mobile No<span class="required">*</span></label>
                      <div class="controls">
                        <div id="drpMobcodedata">
                           <select id="drpMobcode" class="span6 m-wrap" name="mob_code" style="width:75px;">
                           <?php foreach($db_code as $inc) { ?>
                           <option value="<?php echo $inc['mob_code']; ?>"<?php if($db_member[0]['mob_code'] == $inc['mob_code']) { ?> selected="selected" <?php } ?>><?php echo $inc['mob_code']; ?></option>
                           <?php } ?>
                            </select>
                      </div>
                        <input type="text" name="mobile_no" style="width:342px;" class="span6 m-wrap required" onkeyup="phonenumber(document.form_sample_3.mobile_no)"  placeholder="Enter Mobile Number" value="<?php echo $db_member[0]['mobile_no']; ?>" />
                      </div>
                    </div>
                <h3 style="color:#C33">More Personal Details</h3> 
                 <div class="control-group">
                <label class="control-label">Relationship Status<span class="required">*</span></label>
                <?php $relations = "select * from relationship_status";
					  $db_rel = $obj->select($relations);	 ?>
                <div class="controls">
                  <select class="span6 m-wrap required" name="drpRel">
                    <option value="" >---Select---</option>
                        <?php foreach($db_rel as $inc) { ?>
                        	<option value="<?php echo $inc['status']; ?>"<?php if($db_member[0]['relationship_status'] == $inc['status']) { ?> selected="selected" <?php } ?>><?php echo $inc['status']; ?></option>
                            
                        <?php }?>
                  </select>
 
                 
                </div>
              </div>
                    <div class="control-group">
                      <label class="control-label">Religion<span class="required">*</span></label>
                      <div class="controls">
                      
                       <select class="span6 m-wrap required" name="religion" onchange="showcaste(this.value);">
                       <option value="" >---Select---</option>
                   
                    <?php
							 $sel="select * from religions";
					 		$intr=$obj->select($sel);
						
							foreach($intr as $inc)
							{	?>
                         
                        <option value="<?php echo $inc['religion'];?>" <?php if($db_member[0]['religion'] == $inc['religion']) { ?> selected="selected" <?php } ?> ><?php echo $inc['religion'];?></option>
                        <?php  }?>
                  </select>
                  </div>
                     
                    </div>
                    <div class="control-group">
                      <label class="control-label">Caste/Division<span class="required">*</span></label>
                      <div class="controls">
                      <div id="txtHint456">
                       <select class="span6 m-wrap required" name="caste">
                       <option value="" >---Select---</option>
                   
                    <?php
							 $sel="select * from caste";
					 		$intr=$obj->select($sel);
						
							foreach($intr as $inc)
							{	?>
                         
                        <option value="<?php echo $inc['caste'];?>" <?php if($db_member[0]['caste'] == $inc['caste']) { ?> selected="selected" <?php } ?> ><?php echo $inc['caste'];?></option>
                        <?php  }?>
                  </select>
                  </div>
                      </div>
                    </div>
                  
                    <div class="control-group">
                      <label class="control-label">Mother Tongue<span class="required">*</span></label>
                      <div class="controls">
                        <select class="span6 m-wrap required" name="mother_tongue">
                   <option value="">---Select---</option>
                   <?php $sel="select * from mother_tongues";
					 		$intr=$obj->select($sel);
							foreach($intr as $inc)
							{			 
					    ?>
                    <option value="<?php echo $inc['name'];?>"<?php if($db_member[0]['mother_tongue'] == $inc['name']) { ?> selected="selected" <?php } ?> ><?php echo $inc['name'];?></option>
                   
                        <?php } ?>
                  </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Gothram</label>
                      <div class="controls">
                        <input type="text" id="gothram" name="gothram" class="span6 m-wrap" value="<?php echo $db_member[0]['gothram']; ?>"  />
                      </div>
                    </div>
                        <h3 style="color:#C33">Physical Attributes</h3>   
                                  <div class="control-group">
                      <label class="control-label">Height<span class="required">*</span></label>
                      <div class="controls">
                      <select name="height" class="span6 m-wrap required">
                      	<option value="">Select</option>
                        <?php 
							$select_height="select * from height";
							$db_height=$obj->select($select_height);
							for($i=0;$i<count($db_height);$i++){
							?>
                           <option value="<?php echo $db_height[$i]['Id']; ?>" <?php if($db_member[0]['height']==$db_height[$i]['Id']){ ?> selected="selected" <?php } ?> ><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>
                           <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Weight<span class="required">*</span></label>
                      <div class="controls">
                      <select id="weight" name="weight" class="span6 m-wrap required">
                      	 <option value="">- Kgs -</option>
                       <?php for($i=41;$i<=140;$i++) { ?>
	                       <option value="<?php echo $i." kg"; ?>" <?php if($db_member[0]['weight']==$i) { ?> selected="selected"<?php } ?>><?php echo $i." kg"; ?></option>					  
                       <?php } ?>   
                      </select>
                      </div>
                    </div>
                    
                    
                     <div class="control-group">
                                <label class="control-label">Body Type<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="btype" class="span6 m-wrap required">
                                     <?php $sql = "select * from body_type"; 
									  $result = $obj->select($sql); ?>
										<?php
											foreach($result as $res)
											{ ?>
											<option value="<?php echo $res['type']; ?>" <?php if($db_member[0]['body_type']==$res['type']) { ?> selected="selected"<?php } ?>><?php echo $res['type']; ?></option>
									<?php } ?>
                                    </select>
                               </div>
                        </div>
                          <div class="control-group">
                      <label class="control-label">Complexion<span class="required">*</span></label>
                      <div class="controls">
                      <select id="complexion" name="complexion" class="span6 m-wrap required">
                            <option value="Very Fair" <?php if($db_member[0]['complexion']=='Very Fair') { ?> selected="selected"<?php } ?>>Very Fair</option>
                           <option value="Fair" <?php if($db_member[0]['complexion']=='Fair') { ?> selected="selected"<?php } ?>>Fair</option>
                           <option value="Wheatish" <?php if($db_member[0]['complexion']=='Wheatish') { ?> selected="selected"<?php } ?>>Wheatish</option>
                           <option value="Wheatish Brown" <?php if($db_member[0]['complexion']=='Wheatish Brown') { ?> selected="selected"<?php } ?>>Wheatish Brown</option>
                           <option value="Dark" <?php if($db_member[0]['complexion']=='Dark') { ?> selected="selected"<?php } ?>>Dark</option>
                      </select>
                      </div>
                    </div>	
                          <div class="control-group">
                                <label class="control-label">Physical Status<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="phy_status" class="span6 m-wrap required">
                                     <option value="" >---Select---</option>
                    				<option value="normal"<?php if($db_member[0]['physical_status']=="normal") { ?> selected="selected" <?php }?>>Normal</option>
                    				<option value="Physically Challenged" <?php if($db_member[0]['physical_status']=="Physically Challenged") { ?> selected="selected" <?php }?>>Challanged</option>
                                   
                                    </select>  
                                    
                                </div>
                        </div>
                   
                    <h3 style="color:#C33">Education & Occupation</h3> 
                    
                    <div class="control-group">
                      <label class="control-label">Education<span class="required">*</span></label>
                      <div class="controls">
                        <?php /*?><input type="text" id="education" name="education" value="<?php echo $db_member[0]['education']; ?>" class="span6 m-wrap required"  /><?php */?>
                        <select name="education" class="span6 m-wrap required">
                        <option value="">--Select--</option>
                        <?php
                        $level="SELECT education_details.* FROM `education_details` join education_course on Eid=education_details.id group by education_details.id";
                        
                    //	SELECT e.*,c.* FROM education_details e JOIN education_course c ON e.id = c.Eid
                        $sel=$obj->select($level);
                        for($i=0;$i<count($sel);$i++)
                        {
                         ?>
                         <optgroup label="--<?php echo $sel[$i]['degree']; ?>--" class="a">
                         
                         <?php	$course="select * from education_course where Eid='".$sel[$i]['id']."'";
                                $cor=$obj->select($course);
                                for($j=0;$j<count($cor);$j++)
                                {
                         ?>        
                                <option value="<?php echo $cor[$j]['Id'];?>" <?php if($db_member[0]['education']==$cor[$j]['Id']){ ?> selected="selected" <?php } ?> ><?php echo $cor[$j]['Title'];?></option>
                                <?php } ?>
                         </optgroup>
                              <?php } ?>  
                           
                                                    
                        </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Occupation<span class="required">*</span></label>
                      <div class="controls">
                          <select name="drpOccupation" id="drpOccupation" class="span6 m-wrap required">
                             	<?php
									$occu_list="select * from occupation_master";
									$occupation=$obj->select($occu_list);
									foreach($occupation as $occup)
									{ ?> 
                                    	<option value="<?php echo $occup['occupation']; ?>" <?php if($db_member[0]['occupation'] == $occup['occupation']) { ?> selected="selected" <?php } ?> ><?php echo $occup['occupation']; ?></option>
                                <?php } ?>
                                    </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Employed In<span class="required">*</span></label>
                      <div class="controls">
                      <select name="employed_in" class="span6 m-wrap required" id="employed_in">
                            <option value="">--Select--</option>
                            <option value="Government" <?php if($db_member[0]['employed_in']=="Government"){ ?> selected="selected" <?php } ?>>Government</option>
                            <option value="Private" <?php if($db_member[0]['employed_in']=="Private"){ ?> selected="selected" <?php } ?>>Private</option>
                            <option value="Business" <?php if($db_member[0]['employed_in']=="Business"){ ?> selected="selected" <?php } ?>>Business</option>
                            <option value="Defence" <?php if($db_member[0]['employed_in']=="Defence"){ ?> selected="selected" <?php } ?>>Defence</option>
                            <option value="Self Employed" <?php if($db_member[0]['employed_in']=="Self Employed"){ ?> selected="selected" <?php } ?>>Self Employed</option>
                       </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Annual Income<span class="required">*</span></label>
                      <div class="controls">
                      <div id="drpcurrcodedata">
                      <select id="drpcurrcodedata" name="txtcurr" style="width:75px;" class="span6 m-wrap">
                        	<?php for($i=1;$i<=count($db_code);$i++) { ?>
                           <option value="<?php echo $db_code[$i]['curr_code']; ?>"><?php echo $db_code[$i]['curr_code']; ?></option>
                           <?php } ?>
                            
                       	</select>
                        </div>
                       <select name="drpIncome" id="drpIncome"  class="span6 m-wrap required" >
                             	<?php
									$income_list="select * from annual_income_master";
									$income=$obj->select($income_list);
									foreach($income as $inc)
									{ ?>
                                    	<option value="<?php echo $inc['annual_income']; ?>"  <?php if($db_member[0]['annual_income'] == $inc['annual_income']) { ?> selected="selected" <?php } ?> ><?php echo $inc['annual_income']; ?></option>
                                <?php } ?>
                              </select>
                      </div>
                    </div>
                     <h3 style="color:#C33">Habits</h3> 
                      <div class="control-group">
                      <label class="control-label">Food<span class="required">*</span></label>
                      <div class="controls">
                      <select name="food" class="span6 m-wrap required">
                            <option value="">Select</option>
                            <option value="Vegetarian" <?php if($db_member[0]['food']=="Vegetarian") { ?> selected="selected" <?php } ?>>Vegetarian</option>
                            <option value="Non-vegetarian" <?php if($db_member[0]['food']=="Non-vegetarian") { ?> selected="selected" <?php } ?>>Non-Vegetarian</option>
                            <option value="Eggetarian" <?php if($db_member[0]['food']=="Eggetarian") { ?> selected="selected" <?php } ?>>Eggetarian</option> 
                      </select>
                      </div>
                    </div>
                         <div class="control-group">
                                <label class="control-label">Smoking<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="smoke" class="span6 m-wrap required">
                                     <option value="" >Select</option>
                    				<option value="N" <?php if($db_member[0]['is_smoker']=="N") { ?> selected="selected" <?php }?>>No</option>
                    				<option value="Y" <?php if($db_member[0]['is_smoker']=="Y") { ?> selected="selected" <?php }?>>Yes</option>
                                    <option value="O" <?php if($db_member[0]['is_smoker']=="O") { ?> selected="selected" <?php }?>>Occasionally</option>
                                    </select>
                                    
                                    
                                </div>
                        </div>
                         <div class="control-group">
                                <label class="control-label">Drinking<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="drink" class="span6 m-wrap required">
                                     <option value="" >Select</option>
                    				<option value="N" <?php if($db_member[0]['is_drinker']=="N") { ?> selected="selected" <?php }?>>No</option>
                    				<option value="Y" <?php if($db_member[0]['is_drinker']=="Y") { ?> selected="selected" <?php }?>>Yes</option>
                                    <option value="O" <?php if($db_member[0]['is_drinker']=="O") { ?> selected="selected" <?php }?>>Occasionally</option>
                                    </select>
                                  
                                    
                                </div>
                        </div>
                        
                         <h3 style="color:#C33">  Astrological Info</h3> 
                         
                          <div class="control-group">
                      <label class="control-label">Manglik/Dosham</label>
                      <div class="controls">  
 <label class="radio1"><input type="radio" id="rdManglik" name="rdManglik" value="Y" <?php if($db_member[0]['manglik_dosham']=="Y"){ ?> checked="checked" <?php } ?> />Yes</label>
 <label class="radio1"><input type="radio" id="rdManglik" name="rdManglik" value="N"<?php if($db_member[0]['manglik_dosham']=="N"){ ?> checked="checked" <?php } ?>/>No</label>
<label class="radio1"><input type="radio" id="rdManglik" name="rdManglik" value="Dont Know" <?php if($db_member[0]['manglik_dosham']=="Dont Know"){ ?> checked="checked" <?php } ?> />Don't know</label>
                      </div>
                    </div>
                    
                     <div class="control-group">
                      <label class="control-label">Star</label>
                      <div class="controls">
                        <select name="drpStar" id="drpStar" class="span6 m-wrap">
                        	<option value="0">Optional</option>
                             	<?php
									$star_list="select * from horoscope_star_master";
									$star=$obj->select($star_list);
									foreach($star as $st)
									{ ?>
                                    	<option value="<?php echo $st['star']; ?>" <?php if($db_member[0]['star'] == $st['star']) { ?> selected="selected" <?php } ?> ><?php echo $st['star']; ?></option>
                                <?php } ?>
                              </select>

                      </div>
                    </div>
                   <h3 style="color:#C33">  Family Profile</h3>  
    				 <div class="control-group">
                      <label class="control-label">Brothers</label>
                      <div class="controls">
                        <select id="num_bro" name="num_bro" style="width:100px;">	
                    	<option value="">--Select--</option>
                        <?php for($i=1;$i<=10;$i++) { ?>
                        <option value=<?php echo $i; ?><?php if($db_member[0]['no_of_brothers']==$i) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
                        <?php } ?>
                         </select><span style="margin-left:3px;margin-right:3px;padding-top:4px;"> Of them </span> 
                         <select id="num_bro_married" name="num_bro_married" style="width:100px;clear: none;">	
                                    <option value="<?php echo $db_member[0]['bro_married']; ?>"><?php echo $db_member[0]['bro_married']; ?></option>
                         </select><span style="margin-left:3px;padding-top:4px;">Are Married</span> 
                      </div>
                    </div>
                      <div class="control-group">
                      <label class="control-label">Sisters</label>
                      <div class="controls">
                        <select id="num_sis" name="num_sis" style="width:100px;">	
                    	<option value="">--Select--</option>
                        <?php for($i=1;$i<=10;$i++) { ?>
                        <option value=<?php echo $i; ?><?php if($db_member[0]['no_of_sisters']==$i) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
                        <?php } ?>
                         </select><span style="margin-left:3px;margin-right:3px;padding-top:4px;"> Of them </span> 
                         <select id="num_sis_married" name="num_sis_married" style="width:100px;clear: none;">	
                                    <option value="<?php echo $db_member[0]['sis_married']; ?>"><?php echo $db_member[0]['sis_married']; ?></option>
                         </select><span style="margin-left:3px;padding-top:4px;">Are Married</span> 
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">Living with parents</label>
                      <div class="controls">
                        <select id="live_parents" name="live_parents" class="span6 m-wrap">
                            <option value="">Select</option>
                            <option value="Y" <?php if($db_member[0]['living_with_parents']=="Y") { ?> selected="selected"<?php } ?>>Yes</option>
                            <option value="N" <?php if($db_member[0]['living_with_parents']=="N") { ?> selected="selected"<?php } ?>>No</option>
                        </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Family Status<span class="required">*</span></label>
                      <div class="controls">
                        <select id="family_status" name="family_status" class="span6 m-wrap required">
                            <option value="">Select</option>
                            <option value="Middle" <?php if($db_member[0]['family_status']=="Middle") { ?> selected="selected"<?php } ?>>Middle class</option>
                            <option value="Upper Middle" <?php if($db_member[0]['family_status']=="Upper Middle") { ?> selected="selected"<?php } ?>>Upper middle class</option>
                            <option value="rich" <?php if($db_member[0]['family_status']=="rich") { ?> selected="selected"<?php } ?>>Rich</option>                        
                            <option value="affluent" <?php if($db_member[0]['family_status']=="affluent") { ?> selected="selected"<?php } ?>>Affluent</option>
                        </select>
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">Family Type<span class="required">*</span></label>
                      <div class="controls">
                      <select id="family_type" name="family_type" class="span6 m-wrap required">
                      	<option value="">--Select--</option>
                        <option value="joint" <?php if($db_member[0]['family_type']=="joint") { ?> selected="selected"<?php } ?>>Joint</option>
                        <option value="nuclear" <?php if($db_member[0]['family_type']=="nuclear") { ?> selected="selected"<?php } ?>>Nuclear</option>
                       </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Family values<span class="required">*</span></label>
                      <div class="controls">
                      <select id="family_values" name="family_values" class="span6 m-wrap required">
                      	<option value="orthodox" <?php if($db_member[0]['family_value']=="orthodox") { ?> selected="selected"<?php } ?>>Orthodox</option>
                        <option value="traditional" <?php if($db_member[0]['family_value']=="traditional") { ?> selected="selected"<?php } ?>>Traditional</option>                       
                        <option value="moderate" <?php if($db_member[0]['family_value']=="moderate") { ?> selected="selected"<?php } ?>>Moderate</option>
                        <option value="liberal" <?php if($db_member[0]['family_value']=="liberal") { ?> selected="selected"<?php } ?>>Liberal</option>
                      </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">About Yourself<span class="required">*</span></label>
                      <div class="controls">
                      <textarea name="about_me" id="about_me" class="span6 m-wrap required"> <?php echo $db_member[0]['about_me']; ?></textarea>
                  </div>
                    </div>
                    
                       <h3 style="color:#C33"> About Hobbies and likings</h3>  
                    
                    <div class="control-group">
                      <label class="control-label">Hobbies</label>
                      <div class="controls">
                 	 
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                    <?php $sel="select * from hobbies";
					 		$intr=$obj->select($sel);
							
							for($i=0;$i<count($intr);$i++)
							{
								$select_member_ho = "select * from memebr_hobbies_interest where member_id = '".$db_member[0]['id']."'";			 
								$db_m_ho = $obj->select($select_member_ho);
								
								$hobbies = array();
								$hdata = explode(",",$db_m_ho[0]['hobbies']);
								for($k=0;$k<count($hdata);$k++)
								{
									$hobbies[] = $hdata[$k];
								}
					    ?>
                   
                   <li><input type="checkbox" name="chkHobbies[]" value="<?php echo $intr[$i]['id'];?>" <?php if(in_array($intr[$i]['id'],$hobbies)) { ?> checked="checked"<?php } ?>><?php echo $intr[$i]['name'];?></li>
                   <?php } ?>
                  </ul>
                  
                </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Interest</label>
                      <div class="controls">
                 	 
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php $sel="select * from interest";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{
								$select_member_ho = "select * from memebr_hobbies_interest where member_id = '".$db_member[0]['id']."'";			 
								$db_m_ho = $obj->select($select_member_ho);
								
								$interests = array();
								$hdata = explode(",",$db_m_ho[0]['interests']);
								for($k=0;$k<count($hdata);$k++)
								{
									$interests[] = $hdata[$k];
								}			 
					    ?>
                   
                   <li><input type="checkbox" name="chkInterests[]" value="<?php echo $intr[$i]['id'];?>" <?php if(in_array($intr[$i]['id'],$interests)) { ?> checked="checked"<?php } ?>><?php echo $intr[$i]['name'];?></li>
                   <?php } ?>
                  </ul>
                                  </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Favourite Music</label>
                      <div class="controls">
                 	
                   
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php $sel="select * from music";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{	
								$select_member_ho = "select * from memebr_hobbies_interest where member_id = '".$db_member[0]['id']."'";			 
								$db_m_ho = $obj->select($select_member_ho);
								
								$music = array();
								$hdata = explode(",",$db_m_ho[0]['music']);
								for($k=0;$k<count($hdata);$k++)
								{
									$music[] = $hdata[$k];
								}				 
					    ?>
                   
                   <li><input type="checkbox" name="chkMusic[]" value="<?php echo $intr[$i]['id'];?>"<?php if(in_array($intr[$i]['id'],$music )) { ?> checked="checked"<?php } ?>><?php echo $intr[$i]['name'];?></li>
                   <?php } ?>
                  </ul>
                  
                  
                </div>
                    </div>
                    
                      <div class="control-group">
                      <label class="control-label">Favourite Read</label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php $sel="select * from tbl_read";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{	
							$select_member_ho = "select * from memebr_hobbies_interest where member_id = '".$db_member[0]['id']."'";			 
								$db_m_ho = $obj->select($select_member_ho);
								
								$rea = array();
								$hdata = explode(",",$db_m_ho[0]['read_book']);
								for($k=0;$k<count($hdata);$k++)
								{
									$rea[] = $hdata[$k];
								}				 
					    ?>
                   
                   <li><input type="checkbox" name="chkRead[]" value="<?php echo $intr[$i]['id'];?>"<?php if(in_array($intr[$i]['id'],$rea )) { ?> checked="checked"<?php } ?>><?php echo $intr[$i]['name'];?></li>
                   <?php } ?>
                  </ul>
                  
                </div>
                    </div>
                    
                     
                      <div class="control-group">
                      <label class="control-label">Favourite Movie</label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php $sel="select * from movies";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{	
							$select_member_ho = "select * from memebr_hobbies_interest where member_id = '".$db_member[0]['id']."'";			 
								$db_m_ho = $obj->select($select_member_ho);
								
								$movie = array();
								$hdata = explode(",",$db_m_ho[0]['movies']);
								for($k=0;$k<count($hdata);$k++)
								{
									$movie[] = $hdata[$k];
								}						 
					    ?>
                   
                   <li><input type="checkbox" name="chkMovies[]" value="<?php echo $intr[$i]['id'];?>"<?php if(in_array($intr[$i]['id'],$movie)) { ?> checked="checked"<?php } ?>><?php echo $intr[$i]['name'];?></li>
                   <?php } ?>
                  </ul>
                  
                </div>
                    </div>
                    
                    
            
                      <div class="control-group">
                      <label class="control-label">Favourite Sports/Fitness</label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php $sel="select * from activities";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{	
							$select_member_ho = "select * from memebr_hobbies_interest where member_id = '".$db_member[0]['id']."'";			 
								$db_m_ho = $obj->select($select_member_ho);
								
								$sport = array();
								$hdata = explode(",",$db_m_ho[0]['sports']);
								for($k=0;$k<count($hdata);$k++)
								{
									$sport[] = $hdata[$k];
								}			 
					    ?>
                   
                   <li><input type="checkbox" name="chkSports[]" value="<?php echo $intr[$i]['id'];?>"<?php if(in_array($intr[$i]['id'],$sport )) { ?> checked="checked"<?php } ?>><?php echo $intr[$i]['name'];?></li>
                   <?php } ?>
                  </ul>
                  
                </div>
                    </div>
                    
                    
                    
                    
                      <div class="control-group">
                      <label class="control-label">Favourite Couisine</label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php $sel="select * from couisine";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{	
							$select_member_ho = "select * from memebr_hobbies_interest where member_id = '".$db_member[0]['id']."'";			 
								$db_m_ho = $obj->select($select_member_ho);
								
								$couisine = array();
								$hdata = explode(",",$db_m_ho[0]['cuisine']);
								for($k=0;$k<count($hdata);$k++)
								{
									$couisine[] = $hdata[$k];
								}			 
					    ?>
                   
                   <li><input type="checkbox" name="chkCouisine[]" value="<?php echo $intr[$i]['id'];?>"<?php if(in_array($intr[$i]['id'],$couisine )) { ?> checked="checked"<?php } ?>><?php echo $intr[$i]['name'];?></li>
                   <?php } ?>
                  </ul>
                  
                </div>
                    </div>
                    
                    
                      <div class="control-group">
                      <label class="control-label">Preferred Dress Style</label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php $sel="select * from dress_style";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{
								$select_member_ho = "select * from memebr_hobbies_interest where member_id = '".$db_member[0]['id']."'";			 
								$db_m_ho = $obj->select($select_member_ho);
								
								$style = array();
								$hdata = explode(",",$db_m_ho[0]['dress_style']);
								for($k=0;$k<count($hdata);$k++)
								{
									$style[] = $hdata[$k];
								}				 
					    ?>
                   
                   <li><input type="checkbox" name="chkDress[]" value="<?php echo $intr[$i]['id'];?>"<?php if(in_array($intr[$i]['id'],$style )) { ?> checked="checked"<?php } ?>><?php echo $intr[$i]['name'];?></li>
                   <?php } ?>
                  </ul>
                  
                </div>
                    </div>
                    
                    
                      <div class="control-group">
                      <label class="control-label">Spoken Languages</label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php $sel="select * from languages";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{	
							$select_member_ho = "select * from memebr_hobbies_interest where member_id = '".$db_member[0]['id']."'";			 
								$db_m_ho = $obj->select($select_member_ho);
								
								$lang = array();
								$hdata = explode(",",$db_m_ho[0]['spoken_lang']);
								for($k=0;$k<count($hdata);$k++)
								{
									$lang[] = $hdata[$k];
								}			 
					    ?>
                   
                   <li><input type="checkbox" name="chkLang[]" value="<?php echo $intr[$i]['id'];?>"<?php if(in_array($intr[$i]['id'],$lang )) { ?> checked="checked"<?php } ?>><?php echo $intr[$i]['name'];?></li>
                   <?php } ?>
                  </ul>
                  
                </div>
                    </div>
                    <div class="form-actions">
                      <input type="submit" name="update" class="btn blue" value="Save" onclick="return validate()">
                      <a href="manage_member.php?del=<?php echo $_GET['id']; ?>" class="btn red">Delete This Member</a>
                     </div>
                  </form>
                </div>
              </div>
            </div>
         
          <div class="tab-pane" id="tab_4">
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
                      <h3>Purhased Plan detail</h3>
                      <?php $mem_plans = "SELECT m.*,ms.* FROM member_plans m JOIN new_membership_plans ms ON ms.id = m.plan_id 
										  where m.member_id='".$_GET['id']."'";
					  		$mem_ans=$obj->select($mem_plans);
					   ?>
                      <table class="table table-striped table-bordered table-hover" id="sample_1">
                         <thead>
                                <tr>
                                	<th>Plan</th>
                                    <th>Duration</th>
                                    <th>Amount</th>
                                    <th>Purchase Date</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
								if(!empty($mem_ans)) {
							 		for($i=0;$i<count($mem_ans);$i++)
									{?>
									<tr class="odd gradeX">
										<input type="hidden" name="member_id" value="<?php echo $_GET['id']; ?>" />
										<td><?php echo $mem_ans[$i]['plan_name'];?></td>
										<td><?php echo $mem_ans[$i]['plan_duration']." Days";?></td>	
										<td><?php echo $mem_ans[$i]['plan_amount'];?></td>	                                        
                                        <td><?php echo date('d-m-Y',strtotime($mem_ans[$i]['purchase_date']));?></td>
                                        <td><?php echo date('d-m-Y',strtotime($mem_ans[$i]['expiry_date']));?></td>
									</tr>
							<?php } }
							else
							{	?>
                            	<tr>
                                	<td colspan="3">This member not purhased any Plan yet</td>
                                </tr>
							<?php }
								
								
								?>
                            </tbody>
                        </table>
                  </form>
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

	  doIt=confirm('Do you want to delete this member?');

	  if(doIt){

		window.location.href = 'manage_member.php?del_id='+id;

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
	
	$('#num_bro').change(function(){
		if($('#num_bro').val()!='')
		{
			$('#num_bro_married').find('option').remove();
			for(var i=0;i<=$('#num_bro').val();i++) {
			$('#num_bro_married').append($('<option>', {
				value: i,
				text: i
			}));
			}
		}else {$('#num_bro_married').find('option').remove();$('#num_bro_married').append($('<option>', {value: "",text: "- select -"}));}
	});
	
	$('#num_sis').change(function(){
		if($('#num_sis').val()!='')
		{
			$('#num_sis_married').find('option').remove();
			for(var i=0;i<=$('#num_sis').val();i++) {
			$('#num_sis_married').append($('<option>', {
				value: i,
				text: i
			}));
			}
		}else {$('#num_sis_married').find('option').remove();$('#num_sis_married').append($('<option>', {value: "",text: "- select -"}));}
	});
	
	function validate() {
	var age_date = $('#datepicker').val();
	var date = age_date.split('/');
	var this_year = new Date().getFullYear()
	if($('#gendermale').is(":checked"))
	{
		if((parseInt(this_year-date[2]))<21)
		{
			alert("Age should be 21 years");return false;
		}
	}
	else if($('#genderfemale').is(":checked"))
	 {
		if((parseInt(this_year-date[2]))<18)
		{
			alert("Age should be 18 years");return false;
		}
	}
}
</script>
<style>
.size
{
	height:60px;
}
.details { display:none; }
</style>

 
