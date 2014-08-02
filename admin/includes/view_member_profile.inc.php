<?php
error_reporting(0);

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
      <h3 class="page-title">View Member</h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a href="dashboard.php">Home</a> <i class="icon-angle-right"></i> </li>
        <li>View Member</li>
      </ul>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="tabbable tabbable-custom boxless">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Profile</a></li>
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
                        <label class="control-label" for="firstName">Favourite cuisine:</label>
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
                        <label class="control-label" for="lastName">Dressing style:</label>
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
</div>
