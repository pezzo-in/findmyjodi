<?php
	if(isset($_POST['submit']))
	{
               /* $select_last_id = "SELECT max(id) as last_id from members";
                $last_ins_id =  $obj->select($select_last_id);*/
				
				//occupation = '".$_POST['drpOccupation']."',
				//annual_income = '".$_POST['drpAnnualIncome']."',
				//manglik_dosham = '".$_POST['drpManglik']."',
				//star = '".$_POST['drpStar']."',
				$eid="select * from education_course where id='".$_POST['drpEducation']."'";
				$course_eid=$obj->select($eid);
				
				
				//$lev="select * from education_details where id='".$course_eid[0]['Eid']."'";
				//$level=$obj->select($lev);
				
				$update="update members 
		 		 set 
					 relationship_status ='".$_POST['drpMaritalStatus']."',
					 subcaste = '".$_POST['sub_caste']."',
					 gothram = '".$_POST['Gothra']."',
					 state = '".$_POST['state']."',
					 city = '".$_POST['city']."',
					 height =  '".$_POST['drpHeight']."',
					 weight = '".$_POST['drpWeight']."',
					 body_type = '".$_POST['drpBodyType']."',
					 complexion = '".$_POST['drpComplexion']."',
					 physical_status = '".$_POST['drpPhysicalStatus']."',
					 education = '".$_POST['drpEducation']."',
					 degree_in='".$course_eid[0]['Eid']."',
					 employed_in = '".$_POST['drpEmployedIn']."',
					 food = '".$_POST['drpFood']."',
					 is_smoker = '".$_POST['drpSmoking']."',
					 is_drinker = '".$_POST['drpDrinking']."',
					
					 living_with_parents = '".$_POST['live_parent']."',
						
					 family_status = '".$_POST['drpFamilyStatus']."',
					 family_type = '".$_POST['drpFamilyType']."',
					 family_value = '".$_POST['drpFamilyValues']."',
					 no_of_brothers = '".$_POST['num_bro']."',
					 no_of_sisters = '".$_POST['num_sis']."',
					 bro_married = '".$_POST['num_bro_married']."',
					 sis_married = '".$_POST['num_sis_married']."',
					 about_me = '".$_POST['about']."'
				 where email_id = '".$_SESSION['UserEmail']."'";
        		//echo $update; 
					  
			$db_ins=$obj->edit($update);
             echo "<script>window.location='registration-step-3.php'</script>";
	}
$select_member="select * from members where id='".$_SESSION['logged_user'][0]['id']."'";
$db_member=$obj->select($select_member);
$select_caste = "select * from caste where caste = '".$db_member[0]['caste']."'";
$db_select_caste = $obj->select($select_caste);
 
?>
    <div  class="mid col-md-12 col-sm-12 col-xs-12">
 		<div class="cont_left col-md-8">
        	<?php
		$select_banner = "select * from advertise where adv_position = 'Registration-step-2 Top (622 X 197)' AND status = 'Active'";
		$db_banner = $obj->select($select_banner);
		if(count($db_banner) > 0) 
		{
			if($db_banner[0]['banner_file'] != '') 
				{
					if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {
		?>
		<div class="banner_inner"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>
		<?php } } } ?>
            	
     		<h2>You're just a step away from discovering a life partner.</h2>
            
    <form id="formID" class="form-horizontal" method="post" onsubmit="return check_form()" >
    
    <div class="new_acc col-md-12">
         <div class="left" style="width:100%">
         <h3 style="color:#C33">More Personal Details</h3>
         <hr />
     		<table width="100%" align="center" border="0" cellpadding="5" cellspacing="0" class="tbl_control">
             	<tr>
                	<td width="20%"><label style="margin-top:-18px">Marital Status<font color="#FF0000">*</font></label></td>
                    <td><?php $sql = "select * from relationship_status"; 
					  $result = $obj->select($sql); ?>
                    <select class="form-control"id="drpMaritalStatus" name="drpMaritalStatus" onchange="change_status_fun(this.id)"  tabindex="1" style="clear:none;">
                        <option value="">-Select-</option>
                        <?php
							foreach($result as $res)
							{ ?>
                            <option value="<?php echo $res['status']; ?>"><?php echo $res['status']; ?></option>
							<?php } ?>
                        
                    </select>
                     <span id="mstatus" class="err_msg">Select your marrital status</span> 
                    </td>
                </tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Sub Caste</label></td>
                    <td>
                    <?php
						$select_subcaste = "select * from subcaste where caste_id = '".$db_select_caste[0]['id']."'";
						$db_select_subcaste = $obj->select($select_subcaste);
					?>
                    <select class="form-control"id="sub_caste" name="sub_caste" tabindex="2" style="clear:none;">
                        <option value="" selected="selected">-Select-</option>
                        <?php for($i=0;$i<count($db_select_subcaste);$i++) { ?>
                        <option value="<?php echo $db_select_subcaste[$i]['subcaste']; ?>"><?php echo $db_select_subcaste[$i]['subcaste']; ?></option>
                        <?php } ?>
                    </select>
                    <!--<input class="form-control"type="text" name="sub_caste" id="sub_caste" tabindex="2" style="clear:none;">-->
                     <span id="scast" class="err_msg">&nbsp;</span> 
                    </td>
                </tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Gothra(m)</label></td>
                    <td><input class="form-control"type="text" name="Gothra" id="Gothra" tabindex="3" style="clear:none;">
                     <span id="scast" class="err_msg">&nbsp;</span> 
                    </td>
                </tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Residing state<font color="#FF0000">*</font></label></td>
                    <td><input class="form-control"type="text" name="state" id="state" onchange="change_status_fun(this.id)" tabindex="4" style="clear:none;">
                     <span id="rstate" class="err_msg">Enter your residing state</span> 
                    </td>
                </tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Residing city<font color="#FF0000">*</font></label></td>
                    <td><input class="form-control"type="text" name="city" id="city" onchange="change_status_fun(this.id)" tabindex="5" style="clear:none;"> 
                    <span id="rcity" class="err_msg">Enter your city</span> 
                    </td>
                </tr>
			</table>
             
           
         </div>
         <div class="left">
         <h3 style="color:#C33">Physical Attributes</h3>
         <hr /> 
          <table width="100%" align="center" border="0" cellpadding="5" cellspacing="0" class="tbl_control">
             	<tr>
                	<td width="20%"><label style="margin-top:-18px">Height<font color="#FF0000">*</font></label></td>
                    <td><select class="form-control"id="drpHeight" name="drpHeight" onchange="change_status_fun(this.id)"  tabindex="6" style="clear:none;">
                       <option value="">- Feet/Inches -</option>
                       <?php 
							$select_height="select * from height";
							$db_height=$obj->select($select_height);
							for($i=0;$i<count($db_height);$i++){
							?>
                           <option value="<?php echo $db_height[$i]['Id']; ?>"><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>
                           <?php } ?>
                    </select>
                                        <span id="hight" class="err_msg">Select your height</span> 
                    
                     </td>
                </tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Weight</label></td>
                    <td><select class="form-control"id="drpWeight" name="drpWeight"  tabindex="7" style="clear:none;">
                       <option value="">- Kgs -</option>
                       <?php for($i=41;$i<=140;$i++) { ?>
	                       <option value="<?php echo $i." kg"; ?>"><?php echo $i." kg"; ?></option>					  
                       <?php } ?>                       
                    </select>
                     <span id="scast" class="err_msg">&nbsp;</span> 
                     </td>
                </tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Body Type</label></td>
                    <td><select class="form-control"id="drpBodyType" name="drpBodyType"  tabindex="8" style="clear:none;">
                    <option value="">- Select -</option>
                    <?php $sql = "select * from body_type"; 
					  $result = $obj->select($sql); ?>
                        <?php
							foreach($result as $res)
							{ ?>
                            <option value="<?php echo $res['type']; ?>"><?php echo $res['type']; ?></option>
							<?php } ?>
                       
                    </select>
                     <span id="scast" class="err_msg">&nbsp;</span> 
                     </td>
                </tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Complexion</label></td>
                    <td><select class="form-control"id="drpComplexion" name="drpComplexion"  tabindex="9" style="clear:none;">
                       <option value="">-Select-</option>
                       <option value="Very Fair">Very Fair</option>
                       <option value="Fair">Fair</option>
                       <option value="Wheatish">Wheatish</option>
                       <option value="Wheatish Brown">Wheatish Brown</option>
                       <option value="Dark">Dark</option>
                    </select>
                     <span id="scast" class="err_msg">&nbsp;</span> 
                     </td>
                </tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Physical status<font color="#FF0000">*</font></label></td>
                    <td><select class="form-control"id="drpPhysicalStatus" onchange="change_status_fun(this.id)" name="drpPhysicalStatus"  tabindex="10" style="clear:none; " >
                       <option value="">-Select-</option>
                       <option value="normal">Normal</option>
                       <option value="Physically Challenged">Physically challenged</option>                       
                    </select>
                     <span id="pstatus" class="err_msg">Select physical status</span> 
                    </td>
                </tr>
			</table>
         </div>
         <div class="left">
         <h3 style="color:#C33">Education & Occupation</h3>
         <hr />
         <table width="100%" align="center" border="0" cellpadding="5" cellspacing="0" class="tbl_control">
             	<tr>
                	<td width="20%"><label style="margin-top:-18px">Education<font color="#FF0000">*</font></label></td>
                    <td><select class="form-control"id="drpEducation" onchange="change_status_fun(this.id)" name="drpEducation"  tabindex="11" style="clear:none;">
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
                            <option value="<?php echo $cor[$j]['Id'];?>"><?php echo $cor[$j]['Title'];?></option>
                            <?php } ?>
                     </optgroup>
                          <?php } ?>  
                       
                                                
                    </select>
                    <span id="edu" class="err_msg">Select education</span> 
                    </td>
                </tr>
                <?php /*?><tr>
                	<td width="20%"><label style="margin-top:-18px">Occupation</label></td>
                    <td> <select class="form-control"id="drpOccupation" name="drpOccupation" tabindex="12" style="clear:none;">
                    	<option value="">--Select--</option>
                      <?php
					  	$sql = "select * from occupation_master";
						$ans = $obj->select($sql);
						foreach($ans as $a)
						{ ?>
	                        <option value="<?php echo $a['occupation']; ?>" <?php if($a['occupation']==$db_member[0]['occupation']){ ?> selected="selected" <?php } ?> ><?php echo $a['occupation']; ?></option>
						<?php }
					   ?>
                                                
                    </select> </td>
				</tr><?php */?>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Employed in<font color="#FF0000">*</font></label></td>
                    <td><select class="form-control"id="drpEmployedIn" onchange="change_status_fun(this.id)" name="drpEmployedIn"  tabindex="13" style="clear:none;">	
                    	<option value="">--Select--</option>
                        <option value="Government">Government</option>
                        <option value="Private">Private</option>
                        <option value="Business">Business</option>
                        <option value="Defence">Defence</option>
                        <option value="Self Employed">Self Employed</option>
                    </select>
                    <span id="occupation" class="err_msg">Select your occupation</span> 
                     </td>
				</tr>
               <?php /*?> <tr>
                	<td width="20%"><label style="margin-top:-18px">Annual Income</label></td>
                    <td><select class="form-control"id="drpAnnualIncome" name="drpAnnualIncome"  tabindex="14" style="clear:none;">	
                    	<option value="">--Select--</option>
                        <?php
							$sql = "select * from annual_income_master";
							$ans = $obj->select($sql);
							foreach($ans as $a)
							{ 
							if(($a['annual_income']!="Optional") && ($a['annual_income'] != "Any" )){ ?>
                            <option value="<?php echo $a['annual_income']; ?>" <?php if($db_member[0]['annual_income']==$a['annual_income']){ ?> selected="selected" <?php } ?> ><?php echo $a['annual_income']; ?></option>
                            <?php } } ?>
                    </select></td>
				</tr><?php */?>
			</table>                        
         </div>
         <div class="left">
         	<h3 style="color:#C33">Habits</h3>
         	<hr />
            <table width="100%" align="center" border="0" cellpadding="5" cellspacing="0" class="tbl_control">
             	<tr>
                	<td width="20%"><label style="margin-top:0px">Food</label></td>
                    <td><select class="form-control"id="drpFood" name="drpFood"  tabindex="15" style="clear:none;">	
                    	<option value="">--Select--</option>
                        <option value="Vegetarian">Vegetarian</option>
                        <option value="Non-vegetarian">Non-Vegetarian</option>
                        <option value="Eggetarian">Eggetarian</option>                        
              </select>
               <span id="scast" class="err_msg">&nbsp;</span> 
              </td>
				</tr>
                <tr>
                	<td width="20%"><label style="margin-top:0px">Smoking</label></td>
                    <td><select class="form-control"id="drpSmoking" name="drpSmoking"  tabindex="16" style="clear:none;">	
                    	<option value="">--Select--</option>
                        <option value="N">No</option>
                        <option value="Y">Yes</option>
                        <option value="O">Occasionally</option>                        
              </select>
               <span id="scast" class="err_msg">&nbsp;</span> 
              </td>
				</tr>
                <tr>
                	<td width="20%"><label style="margin-top:0px">Drinking</label></td>
                    <td><select class="form-control"id="drpDrinking" name="drpDrinking"  tabindex="17" style="clear:none;">	
                    	<option value="">--Select--</option>
                        <option value="N">No</option>
                        <option value="Y">Yes</option>
                        <option value="O">Occasionally</option>                        
              </select> 
               <span id="scast" class="err_msg">&nbsp;</span> 
              </td>
				</tr>
			</table>
                      
         </div>
         
         
         <?php /*?><div class="left">
         	<h3 style="color:#C33">Astrological Info</h3>
         	<hr />
            <p>You may not believe in horoscope matching, yet we recommend that you fill in your Astro details as a lot of members would be interested in these details.</p>
            <table width="100%" align="center" border="0" cellpadding="5" cellspacing="0">
             	<tr>
                	<td width="20%"><label style="margin-top:-18px">Manglik</label></td>
                    <td><select class="form-control"id="drpManglik" name="drpManglik"  tabindex="16" style="clear:none;">	
                    	<option value="">--Select--</option>
                        <option value="N" <?php if($db_member[0]['manglik_dosham']=='N'){ ?> selected="selected" <?php } ?> >No</option>
                        <option value="Y" <?php if($db_member[0]['manglik_dosham']=='Y'){ ?> selected="selected" <?php } ?> >Yes</option>
                        <option value="Dont Know" <?php if($db_member[0]['manglik_dosham']=='Dont Know'){ ?> selected="selected" <?php } ?> >Don't know</option>                        
             </select></td>
				</tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Star</label></td>
                    <td><select class="form-control"id="drpStar" name="drpStar"  tabindex="17" style="clear:none;">	
                    	<option value="">--Select--</option>
                        <?php
							$sql = "select * from horoscope_star_master";
							$ans = $obj->select($sql);
							foreach($ans as $a){?>
	                            <option value="<?php echo $a['star']; ?>" <?php if($db_member[0]['star']==$a['star']){ ?> selected="selected" <?php } ?> ><?php echo $a['star']; ?></option>
                            <?php } ?>
             </select> </td>
				</tr>
			</table>
         </div><?php */?> 
          <div class="left">
         	<h3 style="color:#C33">Family Profile</h3>
         	<hr />
            <p>You may not believe in horoscope matching, yet we recommend that you fill in your Astro details as a lot of members would be interested in these details.</p>
            <table width="100%" align="center" border="0" cellpadding="5" cellspacing="0" class="tbl_control">
				
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Living with parents<font color="#FF0000">*</font></label></td>
                    <td><select class="form-control" id="live_parent" name="live_parent" tabindex="17" style="clear:none;">	
                    	<option value="">--Select--</option>
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
             </select>
             <span id="fstatus" class="err_msg">Select Living with parents</span> 
             </td>
				</tr>
                
             	<tr>
                	<td width="20%"><label style="margin-top:-18px">Family Status<font color="#FF0000">*</font></label></td>
                    <td><select class="form-control"id="drpFamilyStatus" onchange="change_status_fun(this.id)" name="drpFamilyStatus" tabindex="17" style="clear:none;">	
                    	<option value="">--Select--</option>
                        <option value="Middle">Middle class</option>
                        <option value="Upper Middle">Upper middle class</option>
                        <option value="rich">Rich</option>                        
                        <option value="affluent">Affluent</option>
             </select>
             <span id="fstatus" class="err_msg">Select family status</span> 
             </td>
				</tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Family Type<font color="#FF0000">*</font></label></td>
                    <td><select class="form-control"id="drpFamilyType" onchange="change_status_fun(this.id)" name="drpFamilyType" tabindex="18" style="clear:none; ">	
                    	<option value="">--Select--</option>
                        <option value="joint">Joint</option>
                        <option value="nuclear">Nuclear</option>                       
             </select>
             <span id="ftype" class="err_msg">Select family type</span> 
             </td>
				</tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Family Values<font color="#FF0000">*</font></label></td>
                    <td><select class="form-control"id="drpFamilyValues" onchange="change_status_fun(this.id)" name="drpFamilyValues" tabindex="19" style="clear:none;">	
                    	<option value="">--Select--</option>
                        <option value="orthodox">Orthodox</option>
                        <option value="traditional">Traditional</option>                       
                        <option value="moderate">Moderate</option>
                        <option value="liberal">Liberal</option>
             </select>
             <span id="fvalue" class="err_msg">Select family values</span>              
             </td>
				</tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Brothers</label></td>
                    <td>
              <select class="form-control"id="num_bro" name="num_bro" style="width:100px;clear: none;">	
                    	<option value="">--Select--</option>
                        <?php for($i=1;$i<=10;$i++) { ?>
                        <option value=<?php echo $i; ?>><?php echo $i; ?></option>
                        <?php } ?>
             </select><span style="float:left; margin-left:3px;margin-right:3px;font-family: 'avenir_45_bookregular';padding-top:4px;"> Of them </span> 
             <select class="form-control"id="num_bro_married" name="num_bro_married" style="width:100px;clear: none;">	
                    	<option value="">--Select--</option>
             </select><span style="margin-left:3px;padding-top:4px;float:left;">are married</span> 
             <span id="fvalue" class="err_msg">Select family values</span>              
             </td>
				</tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Sisters</label></td>
                    <td><select class="form-control"id="num_sis" name="num_sis" style="width:100px;clear: none;">
                    	<option value="">--Select--</option>
                        <?php for($i=1;$i<=10;$i++) { ?>
                        <option value=<?php echo $i; ?>><?php echo $i; ?></option>
                        <?php } ?>
             </select><span style="float:left; margin-left:3px;margin-right:3px;padding-top:4px;"> Of them </span> 
             <select class="form-control"id="num_sis_married" name="num_sis_married" style="width:100px;clear: none;">	
                    	<option value="">--Select--</option>
             </select><span style="margin-left:3px;padding-top:4px;float:left;">are married</span> 
             <span id="fvalue" class="err_msg">Select family values</span>              
             </td>
				</tr>
                <tr>
                	<td width="20%"><label style="margin-top:-18px">About Yourself<font color="#FF0000">*</font></label></td>
                    <td><input class="form-control"type="text" name="about" onchange="change_status_fun(this.id)" id="about" tabindex="20" style="clear:none;">
                                 <span id="abt" class="err_msg">Write about your self</span> 
                    </td>
				</tr>
			</table>
         </div>
        <br class="clear" />
        <div class="terms_line">
        <label class="checkbox"><input class="form-control"checked="checked" type="checkbox" id="chk"  tabindex="21" value="1" />I agree to the Find My Jodi <a href="privacy_policy.php">Privacy Policy</a> and <a href="terms_conditions.php">Terms and Conditions.</a></label>
        <span id="chkmsg" class="err_msg">Check Terms and condition box</span>
        <input class="form-control"type="submit" name="submit" tabindex="22" class="btn btn-success" value="Save" />
    </div>
</div>
</form>
</div>
    
    <div class="sidebarr col-md-4">
        	<div class="box contact">
                <h2>LIVE Support</h2>
                <p>Customer Service Help line:</p>
               <p>+91 9886355564</p>
                <p>Office Hours 8:00 AM to 6:00 PM (IST)<br /><span>[Sunday Holiday]</span></p>
           	</div>    
            <?php
			$select_banner_right = "select * from advertise where adv_position = 'Registration-step-2 Right (280 X 245)' AND status = 'Active'";
			$db_banner_right = $obj->select($select_banner_right);
			if(count($db_banner_right) > 0) 
			{
				if($db_banner_right[0]['banner_file'] != '') 
				{
					if(file_exists('upload/banners/'.$db_banner_right[0]['banner_file'])) {
			?>    
            <div class="box">
            	<a href="<?php echo $db_banner_right[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner_right[0]['banner_file']; ?>" /></a>
            </div>
            <?php } } } ?>
            <div class="box" class="success_story">
            	<h2>Success Story</h2>
            	<?php 
					$select_success_story="select * from success_member_details where status='Approve' order by id DESC Limit 3"; 
					$db_success_story=$obj->select($select_success_story);
					for($i=0;$i<count($db_success_story);$i++)
					{
				?>
            	<div class="story_box">
                	<div class="story_img"><a href="javascript:;"><img src="upload/<?php echo $db_success_story[$i]['photo']; ?>" /></a></div>
                    <div class="story_text">
                    	<a href="javascript:;"><?php echo $db_success_story[$i]['bride_name']; ?></a> | <a href="javascript:;"><?php echo $db_success_story[$i]['groom_name']; ?></a>
                        <br />
                        Marriage Date : <?php echo date('d-m-Y',strtotime($db_success_story[$i]['engag_or_marriage_date'])); ?>
                        <br />
                        <?php echo substr($db_success_story[$i]['story'],0,100); ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="box">
            	<div class="fb-like-box" data-href="https://www.facebook.com/findmyjodi?ref=hl" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
            </div>
        </div>
                
                
   </div>
    
    <script>
function change_status_fun(id)
{
	if(document.getElementById(id).value!='')
	{
		$('#'+id).css('border','1px solid #ccc');
	}
	else
	{
		$('#'+id).css('border','1px solid red');
	}
}	
function check_form()
{
	
	$('#drpMaritalStatus').css('border','1px solid #ccc');
	$('#state').css('border','1px solid #ccc');	
	$('#city').css('border','1px solid #ccc');	
	$('#drpHeight').css('border','1px solid #ccc');
	$('#drpPhysicalStatus').css('border','1px solid #ccc');
    $('#drpEducation').css('border','1px solid #ccc');
	//$('#drpOccupation').css('border','1px solid #ccc');
	$('#drpEmployedIn').css('border','1px solid #ccc');
	$('#drpFamilyStatus').css('border','1px solid #ccc');
	$('#drpFamilyType').css('border','1px solid #ccc');
	$('#drpFamilyValues').css('border','1px solid #ccc');
	$('#about').css('border','1px solid #ccc');
	error = 0;
	if(document.getElementById('about').value=='')
	{
		$('#about').css('border','1px solid red');
		$('#abt').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#abt').css('visibility','hidden');
	}
	
	if(document.getElementById('drpFamilyValues').value=='')
	{
		$('#drpFamilyValues').css('border','1px solid red');
		$('#fvalue').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#fvalue').css('visibility','hidden');
	}
	
	if(document.getElementById('drpFamilyType').value=='')
	{
		$('#drpFamilyType').css('border','1px solid red');
		$('#ftype').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#ftype').css('visibility','hidden');
	}
	
	if(document.getElementById('drpFamilyStatus').value=='')
	{
		$('#drpFamilyStatus').css('border','1px solid red');
		$('#fstatus').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#fstatus').css('visibility','hidden');
	}
	
	if(document.getElementById('drpEmployedIn').value=='')
	{
		$('#drpEmployedIn').css('border','1px solid red');
		$('#occupation').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#occupation').css('visibility','hidden');
	}
	
	/*if(document.getElementById('drpOccupation').value=='')
	{
		$('#drpOccupation').css('border','1px solid red');
		
		error=1
	}*/
	
	if(document.getElementById('drpEducation').value=='')
	{
		$('#drpEducation').css('border','1px solid red');
		$('#edu').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#edu').css('visibility','hidden');
	}
	if(document.getElementById('drpPhysicalStatus').value=='')
	{
		$('#drpPhysicalStatus').css('border','1px solid red');
		$('#pstatus').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#pstatus').css('visibility','hidden');
	}
	
	if(document.getElementById('drpHeight').value=='')
	{
		$('#drpHeight').css('border','1px solid red');
		$('#hight').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#hight').css('visibility','hidden');
	}
	
	if(document.getElementById('city').value=='')
	{
		$('#city').css('border','1px solid red');
		$('#rcity').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#rcity').css('visibility','hidden');
	}
	
	if(document.getElementById('state').value=='')
	{
		$('#state').css('border','1px solid red');
		$('#rstate').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#rstate').css('visibility','hidden');
	}
	
	if(document.getElementById('drpMaritalStatus').value=='')
	{
		$('#drpMaritalStatus').css('border','1px solid red');
		$('#mstatus').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#mstatus').css('visibility','hidden');
	}
	if(!$("#chk").is(':checked'))
	{
		$('#chk').css('border','1px solid red');
		$('#chkmsg').css('visibility','visible');
		return false;
	}
	else
	{
		$('#chkmsg').css('visibility','hidden');
	}
	$(document).scrollTop(0);
	if(error==0)
		return true;
	else
		return false;
}
</script>  
<script>
	$('#drpMaritalStatus').change(function(){
		if($('#drpMaritalStatus').val()!='')
		{
			$('#mstatus').css('visibility','hidden');
		}
	});
	
	$('#state').blur(function(){
		if($('#state').val()!='')
		{
			$('#rstate').css('visibility','hidden');
		}
	});	
	
	$('#city').blur(function(){
		if($('#city').val()!='')
		{
			$('#rcity').css('visibility','hidden');
		}
	});	
	
	$('#drpHeight').change(function(){
		if($('#drpHeight').val()!='')
		{
			$('#hight').css('visibility','hidden');
		}
	});
	
	$('#drpPhysicalStatus').change(function(){
		if($('#drpPhysicalStatus').val()!='')
		{
			$('#pstatus').css('visibility','hidden');
		}
	});
	
    $('#drpEducation').change(function(){
		if($('#drpEducation').val()!='')
		{
			$('#edu').css('visibility','hidden');
		}
	});
	//$('#drpOccupation').css('border','1px solid #ccc');
	$('#drpEmployedIn').change(function(){
		if($('#drpEmployedIn').val()!='')
		{
			$('#occupation').css('visibility','hidden');
		}
	});
	
	$('#drpFamilyStatus').change(function(){
		if($('#drpFamilyStatus').val()!='')
		{
			$('#fstatus').css('visibility','hidden');
		}
	});
	
	$('#drpFamilyType').change(function(){
		if($('#drpFamilyType').val()!='')
		{
			$('#ftype').css('visibility','hidden');
		}
	});
	
	$('#drpFamilyValues').change(function(){
		if($('#drpFamilyValues').val()!='')
		{
			$('#fvalue').css('visibility','hidden');
		}
	});
	
	$('#about').blur(function(){
		if($('#about').val()!='')
		{
			$('#abt').css('visibility','hidden');
		}
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
</script>
<style>
.test
{
	border:1px solid red;
	padding-top:20px;
	height:5px;
}
</style>
	