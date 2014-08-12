<?php
if(isset($_POST['submit']))
{
	$today = date('Y-m-d');
	$birthdate = date('Y-m-d',strtotime($_POST['datepicker']));
	$diff = abs(strtotime($birthdate) - strtotime($today));
	$age = floor($diff / (365*60*60*24));
	
	$insert="INSERT into members(id,profile_for,name,date_of_birth,age,gender,email_id,password,status,reg_date,day,month,year,country,mob_code,mobile_no,religion,caste,mother_tongue,occupation,annual_income,star,manglik_dosham,Activation_code) values(NULL,'".$_POST['drpProfile_for']."','".$_POST['name']."','".date('Y-m-d',strtotime($_POST['datepicker']))."','".$age."','".$_POST['Rdgender']."','".$_POST['email']."','".md5($_POST['password'])."','Deactive','".date('Y-m-d')."','".date('d')."','".date('m')."','".date('Y')."','".$_POST['drpCountry']."','".$_POST['mob_code']."','".$_POST['txtMobNo']."','".$_POST['religion']."', '".$_POST['caste']."','".$_POST['mother_tongue']."','".$_POST['drpOccupation']."','".$_POST['drpIncome']."','".$_POST['drpStar']."','".$_POST['rdManglik']."','99999999')";
	$insert_data = $obj->insert($insert);		 
		
	$inserted_id =  mysql_insert_id();
	
	if(strlen($inserted_id) == "1")
	{
		$mem_id = "FMJ000".$inserted_id;
	}
	elseif(strlen($inserted_id) == "2")
	{
		$mem_id = "FMJ00".$inserted_id;
	}
	elseif(strlen($inserted_id) == "3")
	{
		$mem_id = "FMJ0".$inserted_id;
	}
	$update_page="UPDATE members SET member_id = '".$mem_id."' where id = '".$inserted_id."'";
	$db_updatepage=$obj->edit($update_page);
	
	$user_id = base64_encode($inserted_id);
	
	$to=$_POST['email'];
	$subject = "Registration with Find My Jodi";
	
	$message = '<div style="width:98%;border:1px solid #ccc;padding:10px;border-radius:5px">
		<a href="'.$obj->SITEURL.'"><img src="'.$obj->SITEURL.'images/logo2.png" height="100" width="160" /></a><br /><br />';
	$message .= '<strong>Dear Sir/Madam,</strong><br /><br />';
	
	$message .= "Congrats!..You have successfully registered with our site<br /><br />
				To activate your account <a href='".$obj->SITEURL."registration-step-2.php?member=".$user_id."' style='font-size:13px; font-weight:bold;'>Click Here</a><br><br>
						 Your registration detail is as follow:<br>
						 Email ID : ". $_POST['email']."<br />
						 Password : ".$_POST['password']."<br /><br />";					
	//$message.= "To activate your account. <a href='".$loginurl."'><strong>Click here</strong></a>\n\n";
	
	$message.= "<br /><br /><strong>Thank You,</strong><br />";
	$message.= "<strong>Find My Jodi</strong><br />";
	$message .= '</div>';
				 
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";	
	$headers .= 'From: Find My Jodi <info@findmyjodi.com>';
	mail($to,$subject,$message,$headers);
		echo "<script>window.location='all_members.php'</script>";				
		/*				   
		//$db_ins=$obj->insert($insert);
		$inserted_id =  mysql_insert_id();
	
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
			
		//$select_last_id = "select max(id) as last_id from members";
	//	$last_id = $obj->select($select_last_id); 	
		$insert = "insert into memebr_hobbies_interest
						(id,member_id,hobbies,interests,music,read_book,movies,sports,cuisine,dress_style,spoken_lang)
					VALUES
						(NULL,'".$inserted_id."','".$final_mem_hobbies["mem_hobbies"]."',
						 '".$final_mem_int["mem_int"]."','".$final_mem_music["mem_music"]."',
						 '".$final_mem_read["mem_read"]."','".$final_mem_movies["mem_movies"]."',
						 '".$final_mem_sports["mem_sports"]."','".$final_mem_couisine["mem_couisine"]."',
						 '".$final_mem_dress["mem_dress"]."','".$fianl_mem_lang["mem_lang"]."')";
		
		$result = $obj->insert($insert);	
		
		
		
		$update_mem_int = "update members set
						  Interest = '".$final_mem_int["mem_int"]."'
						  where
						  id = '".$inserted_id."'";
		$update_sql = $obj->edit($update_mem_int);
		
		
		$select_prefix = "SELECT prefix FROM matrimony_id_prefix";
		$prefix = $obj->select($select_prefix);
		
		$id_prefix = $prefix[0]['prefix'];
	if(strlen($inserted_id) == "1")
	{
		$mem_id = $id_prefix."000".$inserted_id;
	}
	elseif(strlen($inserted_id) == "2")
	{
		$mem_id = $id_prefix."00".$inserted_id;
	}
	elseif(strlen($inserted_id) == "3")
	{
		$mem_id = $id_prefix."0".$inserted_id;
	}
	$update_page="UPDATE members SET member_id = '".$mem_id."' where id = '".$inserted_id."'";
	$db_updatepage=$obj->edit($update_page);
	
	if(!empty($_FILES['file']['name'][0])) 
	{
	
		$select_category = "SELECT max(id) as id FROM members";
		$db_member = $obj->select($select_category);
		for ($i = 0; $i < count($_FILES['file']); $i++) {
			$fileLink =  "../second/upload/". $_FILES['file']['name'][$i];
			
			$fileType = $_FILES['file']['type'][$i];
			$fileSize = ($_FILES['file']['type'][$i]) / 1024;
			$source = "$fileLink";
			if ((move_uploaded_file($_FILES["file"]["tmp_name"][$i], $source))) {
					$insert="INSERT into member_photos(id,member_id,photo)
						 values
					 		(NULL,'".$db_member[0]['id']."','".$_FILES["file"]["name"][$i]."')";						
				$db_ins=$obj->insert($insert);
			}		
		}
		//end photo  upload
	}*/
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
        <h3 class="page-title"> Member </h3>
        <ul class="breadcrumb">
          <li> <i class="icon-home"></i> <a href="dashboard.php">Home</a> <span class="icon-angle-right"></span> </li>
          <li> <a href="list_members.php">List Members</a> <span class="icon-angle-right"></span> </li>
          <li>Members</li>
        </ul>
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    
    <div class="row-fluid">
      <div class="span12"> 
        <!-- BEGIN VALIDATION STATES-->
        <div class="btn-group" style="margin-bottom:10px; float:right"> <a href="list_members.php">
          <button id="sample_editable_1_new" class="btn green"> List Members </button>
          </a> </div>
        <div class="portlet box green">
          <div class="portlet-title">
            <div class="caption"><i class="icon-reorder"></i>Members</div>
          </div>
          <div class="portlet-body form">
            <form action="" method="post" id="form_sample_2" class="form-horizontal form_validate" enctype="multipart/form-data">
              <div class="alert alert-error hide">
                <button class="close" data-dismiss="alert"></button>
                You have some form errors. Please check below. </div>
              <div class="alert alert-success hide">
                <button class="close" data-dismiss="alert"></button>
                Your form validation is successful! </div>
               <h3 style="color:#C33">Personal Details</h3>
               
                 <div class="control-group">
                <label class="control-label">Matrimony Profile for<span class="required">*</span></label>
                <div class="controls">
                  <select class="span6 m-wrap required" name="drpProfile_for" id="drpProfile_for">
                    	<option value="">Select</option>
                  		<option value="Myself">Myself</option>
                        <option value="Son">Son</option>
                        <option value="Daughter">Daughter</option>
                        <option value="Brother">Brother</option>
                        <option value="Sister">Sister</option>
                        <option value="Relative">Relative</option>
                        <option value="Friend">Friend</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Name<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="name" data-required="1" class="span6 m-wrap required"/>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Date of Birth<span class="required">*</span></label>
                <div class="controls">
                  	<input type="text"  style="width: 25.5%;" class="m-wrap span3 date-picker required" id="datepicker" name="datepicker" />
                </div>
              </div>
             <!-- <div class="control-group">
                <label class="control-label">Photo:<span class="required">*</span></label>
                <div class="controls">
                  <input type="file" name="file[]" multiple="true" class="span6 m-wrap required" id="file" style="color:black" />
                </div>
              </div>-->
              <div class="control-group">
                <label class="control-label">Gender<span class="required">*</span></label>
                <div id="genderRadio">
                  <div class="controls"> Male
                    <input type="radio"  id="gendermale" name="Rdgender" value="M" checked="checked" style="margin-left:7px;" />
                    Female
                    <input type="radio" id="genderfemale" name="Rdgender" value="F" style="margin-left:7px;"/>
                  </div>
                </div>
              </div>
              <div class="control-group">
                    <label class="control-label">Email Id<span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" name="email" id="email" data-required="1" onblur="valid_email()" class="span6 m-wrap required"/>
                    </div>
                </div>
			  <div class="control-group">
                    <label class="control-label">Password<span class="required">*</span></label>
                    <div class="controls">
                        <input type="password" name="password" data-required="1" class="span6 m-wrap required"/>
                    </div>
                </div>
              
              <div class="control-group">
                <label class="control-label">Country living in<span class="required">*</span></label>
                <div class="controls">
                <?php $country_list = "select * from mobile_codes";
					$data = $obj->select($country_list);
				?>
                  <select class="span6 m-wrap required" name="drpCountry" id="drpCountry" onchange="showmobcode(this.value)">
                     <option value="">Select</option>
					<?php foreach($data as $res) { ?>
                    <option value="<?php echo $res['country']; ?>" style="color:#004F00"><?php echo $res['country']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
             <!-- <div class="control-group">
                          <label class="control-label">State<span class="required">*</span></label>
                          <div class="controls">
                          <div id="state_container">
                              <input type="text" name="state" data-required="1" class="span6 m-wrap required"/>
                              </div>
                          </div>
                  </div>
               <div class="control-group">
                    <label class="control-label">City<span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" name="city" data-required="1" class="span6 m-wrap required"/>
                    </div>
                     </div>--> 
           		
              <div class="control-group">
              <label class="control-label">Mobile No<span class="required">*</span></label>
  			  <div class="controls">
             		<div id="drpMobcodedata">
                       <select id="drpMobcode" class="span6 m-wrap" name="mob_code" style="width:75px;">
						<option value="">Select</option>
						</select>
                      </div> 
               <input type="text" name="txtMobNo" id="txtMobNo" onkeypress="return isNumber(event)" onblur="valid_mobile()" style="width:342px;" data-required="1" class="span6 m-wrap required" />
                   </div>      
                    </div>
               
                <h3 style="color:#C33">More Personal Details</h3> 
              <!--<div class="control-group">
                <label class="control-label">Relationship Status<span class="required">*</span></label>
                <?php //$relations = "select * from relationship_status";
					 // $db_rel = $obj->select($relations);	 ?>
                <div class="controls">
                  <select class="span6 m-wrap required" name="drpRel">
                    <option value="">Select</option>
                        <?php //foreach($db_rel as $rel) { ?>
                        	<option value="<?php //echo $rel['status']; ?>"><?php //echo $rel['status']; ?></option>
                        <?php //}?>
                  </select>
                </div>
              </div>-->
                <div class="control-group">
                <label class="control-label">Religion<span class="required">*</span></label>
                <div class="controls">
                  <select class="span6 m-wrap required" name="religion" onchange="showcaste(this.value);">
                    <option value="" >Select</option>
                    <?php $sel="select * from religions";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{			 
					    ?>
                    <option value="<?php echo $intr[$i]['religion'];?>"><?php echo $intr[$i]['religion'];?></option>
                   
                        <?php } ?>
                  </select>
                </div>
              </div>
               <div class="control-group">
                      <label class="control-label">Caste/Division<span class="required">*</span></label>
                      <div class="controls">
                         <div id="txtHint456">
                        <select name="caste" class="span6 m-wrap required">
   						 <option value="" >Select</option>
           				 </select>
                        </div>    
                      </div>
              </div>
              <div class="control-group">
                <label class="control-label">Mother Tongue<span class="required">*</span></label>
                <div class="controls">
                  <select class="span6 m-wrap required" name="mother_tongue">
                   <option value="">Select</option>
                   <?php $sel="select * from mother_tongues";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{			 
					    ?>
                    <option value="<?php echo $intr[$i]['name'];?>"><?php echo $intr[$i]['name'];?></option>
                   
                        <?php } ?>
                  </select>
                </div>
              </div>
                <!--<div class="control-group">
                      <label class="control-label">Gothram<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="gothram" name="gothram" class="span6 m-wrap required"  />
                      </div>
                    </div>
               <h3 style="color:#C33">Physical Attributes</h3>   
                    <div class="control-group">
                                <label class="control-label">Height<span class="required">*</span></label>
                                <div class="controls">
                                <select class="span6 m-wrap required" name="height">
				                   <option value="">Select</option>
                                   <?php 
									/*$select_height="select * from height";
									$db_height=$obj->select($select_height);
									for($i=0;$i<count($db_height);$i++){*/
									?>
								   <option value="<?php //echo $db_height[$i]['Id']; ?>"><?php //echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>
								   <?php //} ?>
				                  </select>


                                </div>
                            </div>
                         <div class="control-group">
                      <label class="control-label">Weight<span class="required">*</span></label>
                      <div class="controls">
                       <select class="span6 m-wrap required" name="mother_tongue">
				                   <option value="">Select Weight</option>
							<?php
							//for($i=41;$i<140;$i++)					{
								?>
                             <option value="<?php // echo $i;?>"><?php //echo $i.' Kg'; ?></option>   
                                <?php
							//}
							?>
				                  </select>
                      
                      </div>
                    </div>    
                         <div class="control-group">
                                <label class="control-label">Body Type<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="btype" class="span6 m-wrap required">
                                     <option value="" >Select Body Type</option>
                    				 <?php $sel="select * from body_type";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{			 
					    ?>
                    <option value="<?php echo $intr[$i]['id'];?>"><?php echo $intr[$i]['type'];?></option>
                   
                        <?php } ?>
                                    </select>
                                    
                                    
                                </div>
                        </div>
                        
                        <div class="control-group">
                      <label class="control-label">Complexion<span class="required">*</span></label>
                      <div class="controls">
                      <select id="complexion" name="complexion" class="span6 m-wrap required">
                           <option value="">Select</option>
                           <option value="Very Fair">Very Fair</option>
                           <option value="Fair">Fair</option>
                           <option value="Wheatish">Wheatish</option>
                           <option value="Wheatish Brown">Wheatish Brown</option>
                           <option value="Dark">Dark</option>
                    </select>
                      </div>
                    </div>
                    <div class="control-group">
                                <label class="control-label">Physical Status<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="phy_status" class="span6 m-wrap required">
                                     <option value="" >Select</option>
                                        <option value="Normal">Normal</option>
                                        <option value="Physically Challenged">Physically Challenged</option>
                                    </select>
                                </div>
                        </div>--> 
                        <div class="control-group">
                      <label class="control-label">Occupation<span class="required">*</span></label>
                      <div class="controls">
                          <select name="drpOccupation" id="drpOccupation" class="span6 m-wrap required">
                             	<option value="">Select</option>
								<?php
									$occu_list="select * from occupation_master";
									$occupation=$obj->select($occu_list);
									foreach($occupation as $occup)
									{ ?> 
                                    	<option value="<?php echo $occup['occupation']; ?>"><?php echo $occup['occupation']; ?></option>
                                <?php } ?>
                         </select>
                      </div>
                    </div>
                    <!--<div class="control-group">
                                <label class="control-label">Education<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="education" class="span6 m-wrap required">
                                    <option value="">Select Education</option>
                                    <?php
                                   /* $level="SELECT education_details.* FROM `education_details` join education_course on Eid=education_details.id group by education_details.id";
                                    
                                  $sel=$obj->select($level);
                                    for($i=0;$i<count($sel);$i++)
                                    {*/
                                     ?>
                                     <optgroup label="--<?php// echo $sel[$i]['degree']; ?>--" class="a">
                                     
                                     <?php	/*$course="select * from education_course where Eid='".$sel[$i]['id']."'";
                                            $cor=$obj->select($course);
                                            for($j=0;$j<count($cor);$j++)
                                            {*/
                                     ?>        
                                            <option value="<?php //echo $cor[$j]['Id'];?>"><?php echo $cor[$j]['Title'];?></option>
                                            <?php //} ?>
                                     </optgroup>
                                          <?php //} ?>  
                                       
                                                                
                                    </select>
                                </div>
                            </div>
                     <div class="control-group">
                      <label class="control-label">Employed In<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="employed_in" class="span6 m-wrap required" name="employed_in"   />
                      </div>
                    </div>-->
                    <div class="control-group">
                      <label class="control-label">Annual Income<span class="required">*</span></label>
                      <div class="controls">
                      <div id="drpcurrcodedata">
                      <select id="txtcurr" name="txtcurr" style="width:75px;" class="span6 m-wrap">
                        	<option value="">Select</option>
                       	</select>
                        </div>
                       <select name="drpIncome" id="drpIncome" class="span6 m-wrap required" style="width:342px;">
                             	<option value="">Select</option>
								<?php
									$income_list="select * from annual_income_master";
									$income=$obj->select($income_list);
									foreach($income as $inc)
									{ ?>
                                    	<option value="<?php echo $inc['annual_income']; ?>" ><?php echo $inc['annual_income']; ?></option>
                                <?php } ?>
                       </select>
                      </div>
                    </div>
                    
                    <!--<h3 style="color:#C33">Habits</h3> 
                     
                     <div class="control-group">
                      <label class="control-label">Food<span class="required">*</span></label>
                       <div class="controls">
                       <select name="food" class="span6 m-wrap required">
                            <option value="">Select</option>
                            <option value="Vegetarian">Vegetarian</option>
                            <option value="Non-vegetarian">Non-Vegetarian</option>
                            <option value="Eggetarian">Eggetarian</option> 
                      </select>
                      </div>
                    </div>
                    <div class="control-group">
                                <label class="control-label">Smoking<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="smoke" class="span6 m-wrap required">
                                     <option value="" >Select</option>
                    				<option value="No">No</option>
                    				<option value="Yes">Yes</option>
                                    <option value="Occasionally">Occasionally</option>
                                    </select>
                                    
                                    
                                </div>
                        </div>
                         <div class="control-group">
                                <label class="control-label">Drinking<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="drink" class="span6 m-wrap required">
                                     <option value="" >Select</option>
                    				<option value="No">No</option>
                    				<option value="Yes">Yes</option>
                                    <option value="Occasionally">Occasionally</option>
                                    </select>
                                    
                                    
                                </div>
                        </div>-->
                      
                         <h3 style="color:#C33">  Astrological Info</h3> 
                       <div class="control-group">
                      <label class="control-label">Manglik/Dosham</label>
                      <div class="controls">
                      <select name="rdManglik" class="span6 m-wrap">
                             <option value="" >Select</option>
                            <option value="N">No</option>
                            <option value="Y">Yes</option>
                            <option value="Dont Know">Don't know</option>
                       </select>
                     </div>
                    </div>
                      <div class="control-group">
                      <label class="control-label">Star</label>
                      <div class="controls">
                        <select name="drpStar" id="drpStar" class="span6 m-wrap">
                        	<option value="">Select</option>
                             	<?php
									$star_list="select * from horoscope_star_master";
									$star=$obj->select($star_list);
									foreach($star as $st)
									{ ?>
                                    	<option value="<?php echo $st['star']; ?>" ><?php echo $st['star']; ?></option>
                                <?php } ?>
                              </select>
						</div>
                    </div>
                    
                <!--<h3 style="color:#C33">  Family Profile</h3>  
                    
                    
                     <div class="control-group">
                      <label class="control-label">Family Type<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="family_type" name="family_type" class="span6 m-wrap required"   />
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">Family Status<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="family_status" name="family_status" class="span6 m-wrap required"   />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Family values<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="family_values" name="family_values" class="span6 m-wrap required" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Family Origin<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="family_origin" name="family_origin" class="span6 m-wrap required"   />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Father Occupation<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="father_occupation" name="father_occupation" class="span6 m-wrap required"  />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Mother Occupation<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="mother_occupation" name="mother_occupation" class="span6 m-wrap required"   />
                      </div>
                    </div>
                
                    <div class="control-group">
                      <label class="control-label">No. of Brothers<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="no_of_brothers" name="no_of_brothers" class="span6 m-wrap required" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">No. of Sisters<span class="required">*</span></label>
                      <div class="controls">
                        <input type="text" id="no_of_sisters" name="no_of_sisters" class="span6 m-wrap required"   />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">About Yourself<span class="required">*</span></label>
                      <div class="controls">
                      <textarea name="about_me" id="about_me" class="span6 m-wrap required"> </textarea>
                  </div>
                    </div>
                                    
     				 
                      <h3 style="color:#C33"> About Hobbies and likings</h3>  
                            
                              
                    <div class="control-group">
                      <label class="control-label">Hobbies<span class="required">*</span></label>
                      <div class="controls">
                 	 
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php/* $sel="select * from hobbies";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{*/			 
					    ?>
                   
                   <li><input type="checkbox" name="chkHobbies[]" value="<?php //echo $intr[$i]['id'];?>"><?php //echo $intr[$i]['name'];?></li>
                   <?php //} ?>
                  </ul>
                  
                </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Interest<span class="required">*</span></label>
                      <div class="controls">
                 	 
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php /*$sel="select * from interest";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{*/			 
					    ?>
                   
                   <li><input type="checkbox" name="chkInterests[]" value="<?php //echo $intr[$i]['id'];?>"><?php //echo $intr[$i]['name'];?></li>
                   <?php //} ?>
                  </ul>
                                  </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Favourite Music<span class="required">*</span></label>
                      <div class="controls">
                 	
                   
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php /*$sel="select * from music";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{*/			 
					    ?>
                   
                   <li><input type="checkbox" name="chkMusic[]" value="<?php //echo $intr[$i]['id'];?>"><?php //echo $intr[$i]['name'];?></li>
                   <?php //} ?>
                  </ul>
                  
                  
                </div>
                    </div>
                    
                      <div class="control-group">
                      <label class="control-label">Favourite Read<span class="required">*</span></label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php /*$sel="select * from tbl_read";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{	*/		 
					    ?>
                   
                   <li><input type="checkbox" name="chkRead[]" value="<?php //echo $intr[$i]['id'];?>"><?php //echo $intr[$i]['name'];?></li>
                   <?php //} ?>
                  </ul>
                  
                </div>
                    </div>
                    
                     
                      <div class="control-group">
                      <label class="control-label">Favourite Movie<span class="required">*</span></label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php /*$sel="select * from movies";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{	*/		 
					    ?>
                   
                   <li><input type="checkbox" name="chkMovies[]" value="<?php //echo $intr[$i]['id'];?>"><?php //echo $intr[$i]['name'];?></li>
                   <?php //} ?>
                  </ul>
                  
                </div>
                    </div>
                      <div class="control-group">
                      <label class="control-label">Favourite Sports/Fitness<span class="required">*</span></label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                   <ul class="checkbox_list">
                     <?php /*$sel="select * from activities";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{*/			 
					    ?>
                   
                   <li><input type="checkbox" name="chkSports[]" value="<?php //echo $intr[$i]['id'];?>"><?php //echo $intr[$i]['name'];?></li>
                   <?php //} ?>
                  </ul>
                  
                </div>
                    </div>
                      <div class="control-group">
                      <label class="control-label">Favourite Couisine<span class="required">*</span></label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php /*$sel="select * from couisine";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{*/			 
					    ?>
                   
                   <li><input type="checkbox" name="chkCouisine[]" value="<?php //echo $intr[$i]['id'];?>"><?php //echo $intr[$i]['name'];?></li>
                   <?php //} ?>
                  </ul>
                  
                </div>
                    </div>
                    
                    
                      <div class="control-group">
                      <label class="control-label">Preferred Dress Style<span class="required">*</span></label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php /*$sel="select * from dress_style";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{*/			 
					    ?>
                   
                   <li><input type="checkbox" name="chkDress[]" value="<?php //echo $intr[$i]['id'];?>"><?php //echo $intr[$i]['name'];?></li>
                   <?php //} ?>
                  </ul>
                  
                </div>
                    </div>
                    
                    
                      <div class="control-group">
                      <label class="control-label">Spoken Languages<span class="required">*</span></label>
                      <div class="controls">
                 	
                    <style>
					.checkbox_list{ list-style:none }
					.checkbox_list li{ float:left;width:20% }
					</style>
                    
                   <ul class="checkbox_list">
                     <?php /*$sel="select * from languages";
					 		$intr=$obj->select($sel);
							for($i=0;$i<count($intr);$i++)
							{*/			 
					    ?>
                   
                   <li><input type="checkbox" name="chkLang[]" value="<?php //echo $intr[$i]['id'];?>"><?php //echo $intr[$i]['name'];?></li>
                   <?php //} ?>
                  </ul>
                  
                </div>
                    </div>-->
                    
            
              <div class="form-actions">
                <input type="submit" name="submit" class="btn blue" value="Add" onclick="return validate()">
               
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
var email_error=0;
var mobile_error=0;
function valid_email()
{
	if(document.getElementById('email').value!=null)
	{
		var val = document.getElementById('email').value;
			$.ajax({
				url: '../chkExistEmail.php',
				dataType: 'html',
				data: { email : val },
				success: function(data) {
					if(data != "")
					{
						email_error = 1;
						$('#email').css('border-color','red');
					}
					else {email_error = 0;}
				}
			});	
		}
}

function valid_mobile()
{
	if(document.getElementById('txtMobNo').value!=null)
	{
		var val = document.getElementById('txtMobNo').value;
		var phoneno = /^\d{10}$/;
		if(!val.match(phoneno)){
			
			$('#txtMobNo').css('border-color','red');
			mobile_error=1;
		}
		else {mobile_error=0;}
		$.ajax({
			url: '../chkExistPhone.php',
			dataType: 'html',
			data: { phone : val },
			success: function(data) {
				if(data != "")
				{
					mobile_error=1;
					$('#txtMobNo').css('border-color','red');
				}
				else {mobile_error=0;}
			}
		});
	}

}

function validate() {
	if(mobile_error == '1' || email_error == '1')
	{
		alert('Mobile number or email alredy exist');
		return false;
	}
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

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
<style type="text/css">
	#drpMobcodedata {float:left;margin-right:10px;}
	#txtcurr {float:left;margin-right:10px;}
</style>