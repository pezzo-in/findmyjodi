<?php

session_start();

//to edit partner pref

if(isset($_POST['save_pref_partner']))

{

		$sql = "select * from preferred_partner_details

				   where from_mem = '".$_SESSION['logged_user'][0]['id']."'";

		$select_sql = $obj->select($sql);	

		if(empty($select_sql))

		{

			$pref_age = $_POST['drpAgeFrom']."to".$_POST['drpAgeTo'];
			$pref_height = $_POST['drpHeight']."to".$_POST['drptoHeight'];

                $select_last_id = "SELECT max(id) as last_id from members";

                $last_ins_id =  $obj->select($select_last_id);

		$insert = "insert into preferred_partner_details

				  	(from_mem,id,preferred_age,marital_status,height,physical_status,religion,mother_tongue,caste,				   	 manglik,star,food,is_drinker,is_smoker,country,city,education,occupation,annual_income,partner_description)

				  values

				    ('".$_SESSION['logged_user'][0]['id']."',NULL,'".$pref_age."','".$_POST['drpMaritalStatus']."',

					 '".$pref_height."','".$_POST['drpPhysicalStatus']."','".$_POST['drpReligion']."',

					 '".$_POST['drpMotherlanguage']."','".$_POST['drpCaste']."','".$_POST['drpManglik']."',

					 '".$_POST['drpStar']."','".$_POST['drpFood']."','".$_POST['drpDrinking']."','".$_POST['drpSmoking']."'

					 ,'".$_POST['drpCountry']."','".$_POST['city']."','".$_POST['drpEducation']."','".$_POST['drpOccupation']."'

					 ,'".$_POST['drpAnnualIncome']."','".$_POST['partner_description']."')";

		$db_ins=$obj->insert($insert);

		}

		else

		{

			$pref_age = $_POST['drpAgeFrom']."to".$_POST['drpAgeTo'];
			$pref_height = $_POST['drpHeight']."to".$_POST['drptoHeight'];

			 $update_page = "update preferred_partner_details

			 				set

							preferred_age = '".$pref_age."',marital_status = '".$_POST['drpMaritalStatus']."',

							height = '".$pref_height."',physical_status = '".$_POST['drpPhysicalStatus']."' ,

							religion = '".$_POST['drpReligion']."',mother_tongue = '".$_POST['drpMotherlanguage']."' ,

							caste = '".$_POST['drpCaste']."' ,manglik = '".$_POST['drpManglik']."',

							star ='".$_POST['drpStar']."' ,food ='".$_POST['drpFood']."' ,is_drinker = '".$_POST['drpDrinking']."',

							country = '".$_POST['drpCountry']."',city = '".$_POST['city']."',is_smoker = '".$_POST['drpSmoking']."',

							education = '".$_POST['drpEducation']."',occupation = '".$_POST['drpOccupation']."',

							annual_income = '".$_POST['drpAnnualIncome']."' ,partner_description = '".$_POST['partner_description']."'

							where from_mem = '".$_SESSION['logged_user'][0]['id']."'";
							

			$update_sql = $obj->edit($update_page);
		}
		$_SESSION['profile_update'] = "1";
		echo "<script>window.location='my_account.php'</script>";	

}

//LOGGED-IN USER'S PREFERRED PARTNER DETAIL //



	$sql_login = "SELECT * from preferred_partner_details 

				  where

				  from_mem ='".$_SESSION['logged_user'][0]['id']."'";



 //echo $sql_login;

	$logged_in_member=$obj->select($sql_login);
$ag=explode("to",$logged_in_member[0]['preferred_age']);
$ht=explode("to",$logged_in_member[0]['height']);	

?>

      <div class="content">

		      <h3>Add/Edit Partner Preference</h3>

             

				<form name="photo_upload_form" method="post" style="padding-top:20px" enctype="multipart/form-data">

		<div class="new_acc">

        	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="editpartpref">

				<tr>

                	<td width="20%" valign="top"><label>Preferred Age</label></td>

                    <td>

                        <div class="preff-age" style="margin-left:0px;">

                            <select name="drpAgeFrom" id="drpAgeFrom" style="width:70px;">

                                <?php 
								
								for($i=19;$i<=50;$i++) { ?>

                                    <option <?php if($i==$ag[0]){ ?> selected="selected" <?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                <?php } ?>

                            </select>

                            

                        <span>to</span>

                        <div id="age_to">

                         <select name="drpAgeTo" id="drpAgeTo" style="width:70px;">

                            <?php for($i=20;$i<=50;$i++) { ?>

                               <option <?php if($i==$ag[1]){ ?> selected="selected" <?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>

                            <?php } ?>   

                         </select>

                        </div> </div></td>

                 </tr>

                 <tr>

                	<td width="20%" valign="top"><label>Marital Status</label></td>

                    <td><select id="drpMaritalStatus" name="drpMaritalStatus" style="clear:none;">

                        <option value="">-Select-</option>

                        <option value="UnMarried" <?php if($logged_in_member[0]['marital_status'] == "UnMarried") { ?> selected="selected" <?php } ?> >UnMarried</option>

                        <?php /*?><option value="Married"  <?php if($logged_in_member[0]['marital_status'] == "Married") { ?> selected="selected" <?php } ?>>Married</option><?php */?>

                        <option value="Divorced"  <?php if($logged_in_member[0]['marital_status'] == "Divorced") { ?> selected="selected" <?php } ?>>Divorced</option>

                        <option value="Widowed"  <?php if($logged_in_member[0]['marital_status'] == "Widowed") { ?> selected="selected" <?php } ?>>Widowed</option>

                    </select></td>

				</tr>

                <tr>

                    <td width="20%" valign="top"><label>Height</label></td>

                    <td>
                    <div class="preff-age" style="margin-left:0px;">

                           <select id="drpHeight" name="drpHeight" style="width:130px;">

                       <option value="">Feet/Inches</option>
                       
                       <?php 
							$select_height="select * from height";
							$db_height=$obj->select($select_height);
							for($i=0;$i<count($db_height);$i++){
							?>
                           <option value="<?php echo $db_height[$i]['Id']; ?>" <?php if($ht[0]==$db_height[$i]['Id']){ ?> selected="selected" <?php } ?> ><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>
                           <?php } ?>

                    </select>

                            

                        <span>to</span>

                        <div id="age_to">
							<select id="drptoHeight" name="drptoHeight"  style="width:130px;">

                       <option value="">Feet/Inches</option>
                       
                       <?php 
							for($i=0;$i<count($db_height);$i++){
							?>
                           <option value="<?php echo $db_height[$i]['Id']; ?>" <?php if($ht[1]==$db_height[$i]['Id']){ ?> selected="selected" <?php } ?> ><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>
                           <?php } ?>

                    </select>
                         </div> </div>
                      </td>

                </tr>

                <tr>

                    <td width="20%" valign="top"><label>Physical status</label></td>

                    <td><select id="drpPhysicalStatus" name="drpPhysicalStatus"  style="clear:none;">

                       <option value="">-Select-</option>

                       <option value="normal"<?php if($logged_in_member[0]['physical_status'] == "normal") { ?> selected="selected" <?php } ?> >Normal</option>

                       <option value="physically_challenged" <?php if($logged_in_member[0]['physical_status'] == "physically_challenged") { ?> selected="selected" <?php } ?>>Physically challenged</option>                       

                    </select></td>

                </tr>

                <tr>

                    <td width="20%" valign="top"><label>Religion</label></td>

                    <td><?php

						$religion_list = "select * from religions";

						$data = $obj->select($religion_list);

					?>

                    <select name="drpReligion" id="drpReligion" onchange="change_religion(this.value);" style="clear:none;">

                        <option value=""> -Select- </option>

                        <?php foreach($data as $res) { ?>

                        	<option value="<?php echo $res['religion']; ?>"  <?php if($logged_in_member[0]['religion'] == $res['religion']) { ?> selected="selected" <?php } ?> ><?php echo $res['religion']; ?></option>

                        <?php } ?>

                    </select></td>

                </tr>

                

                <tr>

                    <td width="20%" valign="top"><label>Caste</label></td>

                    <td><?php						

						$select_religions="select * from religions where religion='".$logged_in_member[0]['religion']."'";

						$db_religions=$obj->select($select_religions);

						

						$caste_list="select * from caste where religion_id='".$db_religions[0]['id']."'";

						$data=$obj->select($caste_list);

					?>

                    <div id="caste_drp_div">

                    <select name="drpCaste" id="drpCaste" style="clear:none;">

                        <option value=""> -Select- </option>

                        <?php foreach($data as $res) { ?>

                        	<option value="<?php echo $res['caste']; ?>" <?php if($logged_in_member[0]['caste'] == $res['caste']) { ?> selected="selected" <?php } ?>><?php echo $res['caste']; ?></option>

                        <?php } ?>

                    </select>

                    </div>

                    </td>

                </tr>

				

				

				<?php

						$list = "select * from mother_tongues";

						$data = $obj->select($list);

					?>	

                <tr>

                    <td width="20%" valign="top"><label>Mother Tongue</label></td>

                    <td><select name="drpMotherlanguage" id="drpMotherlanguage" style="clear:none;" >

                        <option value=""> -Select- </option>

                        <?php foreach($data as $res) { ?>

                        	<option value="<?php echo $res['name']; ?>"

                            	<?php if($logged_in_member[0]['mother_tongue'] == $res['name']) { ?> selected="selected" <?php } ?>><?php echo $res['name']; ?></option>

                        <?php } ?>

                    </select></td>

                </tr>

                

                <tr>

                    <td width="20%" valign="top"><label>Manglik</label></td>

                    <td><select id="drpManglik" name="drpManglik"  style="clear:none;">	

                    	<option value="">--Select--</option>

                        <option value="N" <?php if($logged_in_member[0]['manglik'] == "N") { ?> selected="selected" <?php } ?>>No</option>

                        <option value="Y" <?php if($logged_in_member[0]['manglik'] == "Y") { ?> selected="selected" <?php } ?>>Yes</option>

                        <option value="" <?php if($logged_in_member[0]['manglik'] == "") { ?> selected="selected" <?php } ?>>Don't know</option>                        

             </select></td>

                </tr>

                <tr>

                    <td width="20%" valign="top"><label>Eating Habits</label></td>

                    <td><select id="drpFood" name="drpFood"   style="clear:none;">	

                    	<option value="">--Select--</option>

                        <option value="vegetarian"  <?php if($logged_in_member[0]['food'] == "vegetarian") { ?> selected="selected" <?php } ?>>Vegetarian</option>

                        <option value="non-vegetarian"  <?php if($logged_in_member[0]['food'] == "non-vegetarian") { ?> selected="selected" <?php } ?>>Non-Vegetarian</option>

                        <option value="eggetarian"  <?php if($logged_in_member[0]['food'] == "eggetarian") { ?> selected="selected" <?php } ?>>Eggetarian</option>                        

              </select></td>

                </tr>

                <tr>

                    <td width="20%" valign="top"><label>Smoking Habits</label></td>

                    <td><select id="drpSmoking" name="drpSmoking"  style="clear:none;">	

                    	<option value="">--Select--</option>

                        <option value="N" <?php if($logged_in_member[0]['is_smoker'] == "N") { ?> selected="selected" <?php } ?>>No</option>

                        <option value="Y" <?php if($logged_in_member[0]['is_smoker'] == "Y") { ?> selected="selected" <?php } ?>>Yes</option>

                        <option value="O" <?php if($logged_in_member[0]['is_smoker'] == "O") { ?> selected="selected" <?php } ?>>Occasionally</option>                        

              </select>  </td>

                </tr>

                <tr>

                    <td width="20%" valign="top"><label>Drinking Habits</label></td>

                    <td><select id="drpDrinking" name="drpDrinking"  style="clear:none;">	

                    	<option value="">--Select--</option>

                        <option value="N" <?php if($logged_in_member[0]['is_drinker'] == "N") { ?> selected="selected" <?php } ?>>No</option>

                        <option value="Y" <?php if($logged_in_member[0]['is_drinker'] == "Y") { ?> selected="selected" <?php } ?>>Yes</option>

                        <option value="O" <?php if($logged_in_member[0]['is_drinker'] == "O") { ?> selected="selected" <?php } ?>>Occasionally</option>                        

              </select></td>

                </tr>

                <tr>

                    <td width="20%" valign="top"><label>Country Living In</label></td>

                    <td><?php

						$country_list = "select * from mobile_codes";

						$data = $obj->select($country_list);

						

					?>

                    <select name="drpCountry" id="drpCountry"  style="clear:none;">

                    

                        <option value="">- Select -</option>

                        <?php foreach($data as $res) { ?>

                        <option value="<?php echo $res['country']; ?>" <?php if($logged_in_member[0]['country'] == $res['country']) { ?> selected="selected" <?php } ?>><?php echo $res['country']; ?></option>

                        <?php } ?>

                    </select></td>

                </tr>
                <tr>
            <td width="20%" valign="top"><label>Education</label></td>
            <td><select id="drpEducation" name="drpEducation"  style="clear:none;">
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
                            <option value="<?php echo $cor[$j]['Id'];?>" <?php if($logged_in_member[0]['education']==$cor[$j]['Id']) { ?> selected="selected" <?php } ?>><?php echo $cor[$j]['Title'];?></option>
                            <?php } ?>
                     </optgroup>
                          <?php } ?> 
      </select></td>
        </tr>

                <tr>

                    <td width="20%" valign="top"><label>Residing city</label></td>

                    <td><input type="text" name="city" id="city" value="<?php echo $logged_in_member[0]['city']; ?>" style="clear:none;"> </td>

                </tr>

                <tr>

                    <td width="20%" valign="top"><label>Occupation</label></td>

                    <td><select id="drpOccupation" name="drpOccupation"  style="clear:none;">

                    	<option value="">--Select--</option>

                      <?php

					  	$sql = "select * from occupation_master";

						$ans3 = $obj->select($sql);

						foreach($ans3 as $a)

						{ ?>

	                        <option value="<?php echo $a['occupation']; ?>" <?php if($logged_in_member[0]['occupation'] == $a['occupation']) { ?> selected="selected" <?php } ?>><?php echo $a['occupation']; ?></option>

						<?php }

					   ?>

                                                

                    </select> </td>

                </tr>

                <tr>

                    <td width="20%" valign="top"><label>Annual Income</label></td>

                    <td><select id="drpAnnualIncome" name="drpAnnualIncome" style="clear:none;">	

                    	<option value="">--Select--</option>

                        <?php

							$sql = "select * from annual_income_master";

							$ans3 = $obj->select($sql);

							foreach($ans3 as $a)

							{ 

							if(($a['annual_income']!="Optional") && ($a['annual_income'] != "Any" )){ ?>

                            <option value="<?php echo $a['annual_income']; ?>" <?php if($logged_in_member[0]['annual_income'] == $a['annual_income']) { ?> selected="selected" <?php } ?>><?php echo $a['annual_income']; ?></option>

                            <?php } } ?>

                    </select> </td>

                </tr>

                <tr>

                    <td width="20%" valign="top"><label>Partner Description</label></td>

                    <td><textarea name="partner_description" id="partner_description" rows="3" cols="42" style='clear:none;'><?php echo $logged_in_member[0]['partner_description']; ?></textarea>
                   </td>

                </tr>

                <tr>

                    <td width="20%" valign="top">&nbsp;</td>

                    <td><input type="submit" name="save_pref_partner" class="update_btn_new1" value="Update"></td>

                </tr>

			</table>

                    

                                         

                    </div> 

</form>   

      </div>    

     <script>

	 function check_form()

	 {



		$('#drpProfFor').css('border','1px solid #ccc');

		$('#username').css('border','1px solid #ccc');

		$('#drpReligion').css('border','1px solid #ccc');

		$('#drpCaste').css('border','1px solid #ccc');

		$('#drpCountry').css('border','1px solid #ccc');

		$('#email').css('border','1px solid #ccc');

		$('#dob').css('border','1px solid #ccc');

		$('#drpMotherlanguage').css('border','1px solid #ccc');

		$('#txtMobNo').css('border','1px solid #ccc');

		$('#about_me').css('border','1px solid #ccc');

		$('#drpBodyType').css('border','1px solid #ccc');

		$('#drpLiving').css('border','1px solid #ccc');

		$('#drpFamilyValue').css('border','1px solid #ccc');

		$('#drpSmoking').css('border','1px solid #ccc');

		$('#drpDrinking').css('border','1px solid #ccc');

		$('#drpEatingHabits').css('border','1px solid #ccc');

		$('#partner_preference').css('border','1px solid #ccc');

		

		

		

				

		

		error = 0;

		if(document.getElementById('partner_preference').value=='')

		{

			$('#partner_preference').css('border','1px solid red');

			

			partner_preference=1

		}

		else

		{

			partner_preference=0

		}

		if(document.getElementById('drpEatingHabits').value=='')

		{

			$('#drpEatingHabits').css('border','1px solid red');

			

			drpEatingHabits=1

		}

		else

		{

			drpEatingHabits=0

		}

		if(document.getElementById('drpDrinking').value=='')

		{

			$('#drpDrinking').css('border','1px solid red');

			

			drpDrinking=1

		}

		else

		{

			drpDrinking=0

		}

		if(document.getElementById('drpSmoking').value=='')

		{

			$('#drpSmoking').css('border','1px solid red');

			

			drpSmoking=1

		}

		else

		{

			drpSmoking=0

		}

		if(document.getElementById('drpFamilyValue').value=='')

		{

			$('#drpFamilyValue').css('border','1px solid red');

			

			drpFamilyValue=1

		}

		else

		{

			drpFamilyValue=0

		}

		if(document.getElementById('drpLiving').value=='')

		{

			$('#drpLiving').css('border','1px solid red');

			

			drpLiving=1

		}

		else

		{

			drpLiving=0

		}



		if(document.getElementById('drpBodyType').value=='')

		{

			$('#drpBodyType').css('border','1px solid red');

			

			drpBodyType=1

		}

		else

		{

			drpBodyType=0

		}

		if(document.getElementById('about_me').value=='')

		{

			$('#about_me').css('border','1px solid red');

			

			about_me=1

		}

		else

		{

			about_me=0

		}

		if(document.getElementById('drpProfFor').value=='')

		{

			$('#drpProfFor').css('border','1px solid red');

			

			drpProfFor=1

		}

		else

		{

			drpProfFor=0

		}

		if(document.getElementById('username').value=='')

		{

			

			$('#username').css('border','1px solid red');			

			username=1

		}

		else

		{

			username=0

		}

		if(document.getElementById('drpReligion').value=='')

		{

			$('#drpReligion').css('border','1px solid red');

			drpReligion=1

		}

		else

		{

			drpReligion=0

		}

		if(document.getElementById('drpCaste').value=='')

		{

			$('#drpCaste').css('border','1px solid red');

			

			drpCaste=1

		}

		else

		{

			drpCaste=0

		}

		if(document.getElementById('drpCountry').value=='')

		{

			$('#drpCountry').css('border','1px solid red');

			

			drpCountry=1

		}

		else

		{

			drpCountry=0

		}

		if(document.getElementById('email').value!=null)

		{

			var x=document.getElementById('email').value;

			var atpos=x.indexOf("@");

			var dotpos=x.lastIndexOf(".");

			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)

			{

				  $('#email').css('border','1px solid red');

				  email=1

			}

			else

			{

				var val = document.getElementById('email').value;

				$.ajax({

					url: 'chkExistEmail_whileEdit.php',

					dataType: 'html',

					data: { email : val },

					success: function(data) {

					if(data != "")

					{

						$('#email').css('border','1px solid red');

						email=1

					}

					else

					{

						email=0

					}

					}

				});	

			}

		}

		else

		{

			error=0

		} 

		if(document.getElementById('dob').value=='')

		{

			$('#dob').css('border','1px solid red');

			

			dob=1

		}

		else

		{

			dob=0

		}

		if(document.getElementById('drpMotherlanguage').value=='')

		{

			$('#drpMotherlanguage').css('border','1px solid red');

			

			drpMotherlanguage=1

		}

		else

		{

			drpMotherlanguage=0

		}

		if(document.getElementById('txtMobNo').value=='')

		{

			$('#txtMobNo').css('border','1px solid red');

			

			txtMobNo=1

		}

		else

		{

			txtMobNo=0

		}



	

	if(drpProfFor == 0 && username== 0 && drpReligion == 0 && drpCaste==0 && drpCountry==0 && email==0 && dob==0 && drpMotherlanguage==0 && txtMobNo==0 && about_me == 0 && drpBodyType == 0 && drpLiving == 0 && drpFamilyValue == 0 && drpSmoking == 0 && drpDrinking == 0 && drpEatingHabits == 0 && partner_preference == 0)

	{

		return true;

	}

	else

	{

		return false;

	}

}







$('#hobbies').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=hobbies',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

$('#family_detail').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=family_detail',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

$('#partner_pref').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=partner_pref',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

	$('#add_horoscope').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=add_horoscope',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

		$('#upload_pic').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=add_pic',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

		

		$('#edit_mobile').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=edit_mobile',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

		

       $('#accepted').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'showIntMembers.php',

				   data:{flag: '1'},

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

	

	$('#submit_btn').click( function() {

		

		

	$('#drpAgeFrm').css('border','1px solid #ccc');

	$('#drpAgeTo').css('border','1px solid #ccc');

	$('#drpReligion').css('border','1px solid #ccc');

	$('#drpCaste').css('border','1px solid #ccc');

	$('#drpMaritalStatus').css('border','1px solid #ccc');

	$('#drpBodyType').css('border','1px solid #ccc');

	$('#about_me').css('border','1px solid #ccc');

	$('#drpLiving').css('border','1px solid #ccc');	

	$('#drpFamilyValue').css('border','1px solid #ccc');	

	$('#drpSmoking').css('border','1px solid #ccc');

	$('#drpDrinking').css('border','1px solid #ccc');	

	$('#drpEatingHabits').css('border','1px solid #ccc');

	$('#partner_preference').css('border','1px solid #ccc');

		

	

	if(document.getElementById('partner_preference').value=='')

	{

		$('#partner_preference').css('border','1px solid red');

		partner_preference=1

	}

	else

	{

		partner_preference=0

	}

	if(document.getElementById('drpEatingHabits').value=='')

	{

		$('#drpEatingHabits').css('border','1px solid red');

		drpEatingHabits=1

	}

	else

	{

		drpEatingHabits=0

	}

	if(document.getElementById('drpDrinking').value=='')

	{

		$('#drpDrinking').css('border','1px solid red');

		drpDrinking=1

	}

	else

	{

		drpDrinking=0

	}

	if(document.getElementById('drpSmoking').value=='')

	{

		$('#drpSmoking').css('border','1px solid red');

		drpSmoking=1

	}

	else

	{

		drpSmoking=0

	}

	if(document.getElementById('drpFamilyValue').value=='')

	{

		$('#drpFamilyValue').css('border','1px solid red');

		drpFamilyValue=1

	}

	else

	{

		drpFamilyValue=0

	}

	

	if(document.getElementById('drpLiving').value=='')

	{

		$('#drpLiving').css('border','1px solid red');

		drpLiving=1

	}

	else

	{

		drpLiving=0

	}

	

	if(document.getElementById('about_me').value=='')

	{

		$('#about_me').css('border','1px solid red');

		about_me=1

	}

	else

	{

		about_me=0

	}

	

	if(document.getElementById('drpBodyType').value=='')

	{

		$('#drpBodyType').css('border','1px solid red');

		drpBodyType=1

	}

	else

	{

		drpBodyType=0

	}

	

	if(document.getElementById('drpMaritalStatus').value=='')

	{

		$('#drpMaritalStatus').css('border','1px solid red');

		drpMaritalStatus=1

	}

	else

	{

		drpMaritalStatus=0

	}

	if(document.getElementById('drpCaste').value=='')

	{

		$('#drpCaste').css('border','1px solid red');

		drpCaste=1

	}

	else

	{

		drpCaste=0

	}

	if(document.getElementById('drpReligion').value=='')

	{

		$('#drpReligion').css('border','1px solid red');

		drpReligion=1

	}

	else

	{

		drpReligion=0

	}

	

	if(document.getElementById('drpAgeFrm').value=='')

	{

		$('#drpAgeFrm').css('border','1px solid red');

		drpAgeFrm=1

	}

	else

	{

		drpAgeFrm=0

	}

	if(document.getElementById('drpAgeTo').value=='')

	{

		$('#drpAgeTo').css('border','1px solid red');

		

		drpAgeTo=1

	}

	else

	{

		drpAgeTo=0

	}

	if(drpAgeFrm==0 && drpAgeTo==0 && drpReligion==0 && drpCaste==0 && drpMaritalStatus==0 && drpBodyType==0 && about_me == 0 && drpLiving == 0 && drpFamilyValue == 0 && drpEatingHabits == 0 && partner_preference == 0)

		{

			//var val = $('#drpProfFor').val();

			 //var formData = $(this).serialize(); 

			 var ageFrom = $('#drpAgeFrm').val();

 			 var ageTo = $('#drpAgeTo').val();

			 

			 var HgtFrom = $('#drpHeightFrm').val();

 			 var HgtTo = $('#drpHeightTo').val();

			 

			 var status = $('#drpMaritalStatus').val();

			 var language = $('#drpLanguage').val();

			 var religion = $('#drpReligion').val();

			 var caste = $('#drpCaste').val();

				

				$.ajax({

				   type: "GET",		

				   url: 'ajaxSearch.php',

				   data :{ageFrom :ageFrom,

				   		  ageTo : ageTo,

						  HgtFrom: HgtFrom,

						  HgtTo:HgtTo,

						  status : status,

						  language : language,

						  religion : religion,

						  caste :caste

						 } ,      

				   success: function(data) {

					   $('.content').html( data );

				   }

				});	

		}

		else

		{

			return false;

		}

		});	

		$('#drpProfFor').click( function() {

			var val = $('#drpProfFor').val();

				$.ajax({

				   url: 'makeSelect.php',

				   dataType: 'html',

				   data: { pro_for : val },

				   success: function(data) {

					   $('#genderRadio').html( data );

				   }

				});			

		});	

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

	

	

</script> 

        

<style>

.size

{

	height:181px;

	width:171px;

}

.back_btn

{

	text-align:right;

	padding-right:5px;	

}

.back_btn_size

{

	height:15px;

	padding-top:5px;

}

.profile_pic{

	/*height:150px;*/

	width:75px;

}

.upload_pic

{

	float: left;

    margin-right: 20px;

    padding: 24px 13px;

}



</style>     

