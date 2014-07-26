<?php
include('../lib/myclass.php');
session_start();	
$sql = "select * from members where id = '".$_SESSION['logged_user'][0]['id']."'";
$ans = $obj->select($sql);

$pref_partner = "select * from preferred_partner_details where from_mem = '".$_SESSION['logged_user'][0]['id']."'";
$ans2 = $obj->select($pref_partner);

?>
<div  class="mid col-md-12 col-sm-12 col-xs-12 nopadding">
<?php if($_GET['hint'] == "add_pic") { ?>
<h3>Add/Edit Photo</h3>
	<form name="photo_upload_form" method="post" style="padding-top:30px" enctype="multipart/form-data">
       	<div class="new_acc">
           <input type="file" name="file[]" multiple="multiple"id="file" style="color:black" /><br clear="all" />
           <input type="submit" name="upload_pic">
         </div>
      </form>
      <?php } ?>
      
<?php if($_GET['hint'] == "edit_mobile") { ?>
<h3>Edit Mobile No</h3>
	<form name="photo_upload_form" method="post" style="padding-top:30px" enctype="multipart/form-data">
       	<div class="new_acc">
           <input type="text" name="mobile_no" id="mobile_no" value="<?php if(isset($ans[0]['mobile_no'])){ echo $ans[0]['mobile_no']; } ?>" />
           <input type="submit" name="save_mobile_no" value="Update">
         </div>
      </form>
      <?php } ?>  
      
<?php if($_GET['hint'] == "add_horoscope") { ?>
<h3>Add/Edit Horoscope</h3>
	<form name="photo_upload_form" method="post" style="padding-top:30px" enctype="multipart/form-data">
       	<div class="new_acc">
           <input type="text" name="horoscope" id="horoscope" value="<?php if(isset($ans[0]['horoscope_match'])){ echo $ans[0]['horoscope_match']; } ?>" />
           <input type="submit" name="save_horoscope_match" value="Update">
         </div>
      </form>
      <?php } ?> 
<?php if($_GET['hint'] == "partner_pref") { ?>
<h3>Add/Edit Partner Preference</h3>
	<form name="photo_upload_form" method="post" style="padding-top:30px" enctype="multipart/form-data">
		<div class="new_acc" style="height:250px;">           
         <div style="width:100%">
        
     		 <label>Preferred Age</label>
                    <div class="preff-age">
		                <select name="drpAgeFrom" id="drpAgeFrom" style="width:70px;margin-left:140px;">
                			<?php for($i=19;$i<=50;$i++) { ?>
			                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					        <?php } ?>
                		</select>
            		<span>to</span>
            <div id="age_to">
			 <select name="drpAgeTo" id="drpAgeTo" style="width:70px;margin-left:140px;">
             	<?php for($i=20;$i<=50;$i++) { ?>
            	   <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>   
             </select>
            </div>    
            </div>                
                    
                   
         </div>
         <label>Marital Status</label>
        <select id="drpMaritalStatus" name="drpMaritalStatus"  tabindex="1" style="clear:none; margin-left:70px;">
                        <option value="">-Select-</option>
                        <option value="UnMarried" <?php if($ans2[0]['marital_status'] == "UnMarried") { ?> selected="selected" <?php } ?> >UnMarried</option>
                        <option value="Married"  <?php if($ans2[0]['marital_status'] == "Married") { ?> selected="selected" <?php } ?>>Married</option>
                        <option value="Divorced"  <?php if($ans2[0]['marital_status'] == "Divorced") { ?> selected="selected" <?php } ?>>Divorced</option>
                        <option value="Widowed"  <?php if($ans2[0]['marital_status'] == "Widowed") { ?> selected="selected" <?php } ?>>Widowed</option>
                    </select>
                    <label>Height</label>
                    <select id="drpHeight" name="drpHeight"  tabindex="6" style="clear:none; margin-left:116px;">
                       <option value="">- Feet/Inches -</option>
                       <option value="4-6" <?php if($ans2[0]['height'] == "4-6") { ?> selected="selected" <?php } ?>>4ft 6in</option>
					   <option value="4-7" <?php if($ans2[0]['height'] == "4-7") { ?> selected="selected" <?php } ?>>4ft 7in</option>
					   <option value="4-8 <?php if($ans2[0]['height'] == "4-8") { ?> selected="selected" <?php } ?>">4ft 8in</option>
					   <option value="4-9" <?php if($ans2[0]['height'] == "4-9") { ?> selected="selected" <?php } ?>>4ft 9in</option>
					   <option value="4-10" <?php if($ans2[0]['height'] == "4-10") { ?> selected="selected" <?php } ?>>4ft 10in</option>
					   <option value="4-11" <?php if($ans2[0]['height'] == "4-11") { ?> selected="selected" <?php } ?>>4ft 11in</option>
					   <option value="5"  <?php if($ans2[0]['height'] == "5") { ?> selected="selected" <?php } ?>>5ft</option>
					   <option value="5-1" <?php if($ans2[0]['height'] == "5-1") { ?> selected="selected" <?php } ?>>5ft 1in</option>
					   <option value="5-2" <?php if($ans2[0]['height'] == "5-2") { ?> selected="selected" <?php } ?>>5ft 2in</option>
					   <option value="5-3" <?php if($ans2[0]['height'] == "5-3") { ?> selected="selected" <?php } ?>>5ft 3in</option>
					   <option value="5-4" <?php if($ans2[0]['height'] == "5-4") { ?> selected="selected" <?php } ?>>5ft 4in</option>
					   <option value="5-5" <?php if($ans2[0]['height'] == "5-5") { ?> selected="selected" <?php } ?>>5ft 5in</option>
					   <option value="5-6" <?php if($ans2[0]['height'] == "5-6") { ?> selected="selected" <?php } ?>>5ft 6in</option>
					   <option value="5-7" <?php if($ans2[0]['height'] == "5-7") { ?> selected="selected" <?php } ?>>5ft 7in</option>
					   <option value="5-8" <?php if($ans2[0]['height'] == "5-8") { ?> selected="selected" <?php } ?>>5ft 8in</option>
					   <option value="5-9" <?php if($ans2[0]['height'] == "5-9") { ?> selected="selected" <?php } ?>>5ft 9in</option>
					   <option value="5-10" <?php if($ans2[0]['height'] == "5-10") { ?> selected="selected" <?php } ?>>5ft 10in</option>
					   <option value="5-11" <?php if($ans2[0]['height'] == "5-11") { ?> selected="selected" <?php } ?>>5ft 11in</option>
					   <option value="6" <?php if($ans2[0]['height'] == "6") { ?> selected="selected" <?php } ?>>6ft</option>
					   <option value="6-2 <?php if($ans2[0]['height'] == "6-2") { ?> selected="selected" <?php } ?>">6ft 1in</option>
					   <option value="6-2" <?php if($ans2[0]['height'] == "6-2") { ?> selected="selected" <?php } ?>>6ft 2in</option>
					   <option value="6-3" <?php if($ans2[0]['height'] == "6-3") { ?> selected="selected" <?php } ?>>6ft 3in</option>
					   <option value="6-4" <?php if($ans2[0]['height'] == "6-4") { ?> selected="selected" <?php } ?>>6ft 4in</option>
					   <option value="6-5" <?php if($ans2[0]['height'] == "6-5") { ?> selected="selected" <?php } ?>>6ft 5in</option>
					   <option value="6-6" <?php if($ans2[0]['height'] == "6-6") { ?> selected="selected" <?php } ?>>6ft 6in</option>
					   <option value="6-7" <?php if($ans2[0]['height'] == "6-7") { ?> selected="selected" <?php } ?>>6ft 7in</option>
				       <option value="6-8" <?php if($ans2[0]['height'] == "6-8") { ?> selected="selected" <?php } ?>>6ft 8in</option>
					   <option value="6-9" <?php if($ans2[0]['height'] == "6-9") { ?> selected="selected" <?php } ?>>6ft 9in</option>
					   <option value="6-10" <?php if($ans2[0]['height'] == "6-10") { ?> selected="selected" <?php } ?>>6ft 10in</option>
					   <option value="6-11" <?php if($ans2[0]['height'] == "6-11") { ?> selected="selected" <?php } ?>>6ft 11in</option>
					   <option value="7" <?php if($ans2[0]['height'] == "7") { ?> selected="selected" <?php } ?>>7ft</option>
                    </select>
                    <label>Physical status</label>
                    <select id="drpPhysicalStatus" name="drpPhysicalStatus"  tabindex="10" style="clear:none; margin-left:67px;">
                       <option value="">-Select-</option>
                       <option value="normal"<?php if($ans2[0]['physical_status'] == "normal") { ?> selected="selected" <?php } ?> >Normal</option>
                       <option value="physically_challenged" <?php if($ans2[0]['physical_status'] == "physically_challenged") { ?> selected="selected" <?php } ?>>Physically challenged</option>                       
                    </select> 
                     <label>Religion</label>
                    <?php
						$religion_list = "select * from religions";
						$data = $obj->select($religion_list);
					?>
                    <select name="drpReligion" id="drpReligion" tabindex="5" style="clear:none;margin-left:107px;">
                        <option value=""> -Select- </option>
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['religion']; ?>"  <?php if($ans2[0]['religion'] == $res['religion']) { ?> selected="selected" <?php } ?> ><?php echo $res['religion']; ?></option>
                        <?php } ?>
                    </select>
                    <?php
						$list = "select * from mother_tongues";
						$data = $obj->select($list);
					?>	
											
                    <label>Mother Tongue</label>    
                    <select name="drpMotherlanguage" id="drpMotherlanguage" tabindex="10" style="clear:none;margin-left:60px;" >
                        <option value=""> -Select- </option>
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['name']; ?>"
                            	<?php if($ans2[0]['mother_tongue'] == $res['name']) { ?> selected="selected" <?php } ?>><?php echo $res['name']; ?></option>
                        <?php } ?>
                    </select>
                    <label>Caste</label>
                    <?php
						$caste_list = "select * from caste"; 
						$data = $obj->select($caste_list);
					?>
                    <select name="drpCaste" id="drpCaste" tabindex="7" style="clear:none;margin-left:125px;">
                        <option value=""> -Select- </option>
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['caste']; ?>" <?php if($ans2[0]['caste'] == $res['caste']) { ?> selected="selected" <?php } ?>><?php echo $res['caste']; ?></option>
                        <?php } ?>
                    </select>
                     <label>Manglik</label>
             <select id="drpManglik" name="drpManglik"  tabindex="16" style="clear:none; margin-left:110px;">	
                    	<option value="">--Select--</option>
                        <option value="N" <?php if($ans2[0]['manglik'] == "N") { ?> selected="selected" <?php } ?>>No</option>
                        <option value="Y" <?php if($ans2[0]['manglik'] == "Y") { ?> selected="selected" <?php } ?>>Yes</option>
                        <option value="" <?php if($ans2[0]['manglik'] == "") { ?> selected="selected" <?php } ?>>Don't know</option>                        
             </select>
             
             <label>Eating Habits</label>
             <select id="drpFood" name="drpFood"  tabindex="15" style="clear:none; margin-left:73px;">	
                    	<option value="">--Select--</option>
                        <option value="vegetarian"  <?php if($ans2[0]['food'] == "vegetarian") { ?> selected="selected" <?php } ?>>Vegetarian</option>
                        <option value="non-vegetarian"  <?php if($ans2[0]['food'] == "non-vegetarian") { ?> selected="selected" <?php } ?>>Non-Vegetarian</option>
                        <option value="eggetarian"  <?php if($ans2[0]['food'] == "eggetarian") { ?> selected="selected" <?php } ?>>Eggetarian</option>                        
              </select>
              <label>Smoking Habits</label>
              <select id="drpSmoking" name="drpSmoking"  tabindex="16" style="clear:none; margin-left:58px;">	
                    	<option value="">--Select--</option>
                        <option value="N" <?php if($ans2[0]['is_smoker'] == "N") { ?> selected="selected" <?php } ?>>No</option>
                        <option value="Y" <?php if($ans2[0]['is_smoker'] == "Y") { ?> selected="selected" <?php } ?>>Yes</option>
                        <option value="O" <?php if($ans2[0]['is_smoker'] == "O") { ?> selected="selected" <?php } ?>>Occasionally</option>                        
              </select>  
              <label>Drinking Habits</label>
              <select id="drpDrinking" name="drpDrinking"  tabindex="17" style="clear:none; margin-left:60px;">	
                    	<option value="">--Select--</option>
                        <option value="N" <?php if($ans2[0]['is_drinker'] == "N") { ?> selected="selected" <?php } ?>>No</option>
                        <option value="Y" <?php if($ans2[0]['is_drinker'] == "Y") { ?> selected="selected" <?php } ?>>Yes</option>
                        <option value="O" <?php if($ans2[0]['is_drinker'] == "O") { ?> selected="selected" <?php } ?>>Occasionally</option>                        
              </select>
               <label>Country Living In</label>
                    <?php
						$country_list = "select * from mobile_codes";
						$data = $obj->select($country_list);
					?>
                    <select name="drpCountry" id="drpCountry"  tabindex="6" style="clear:none;margin-left:50px;">
                        <option value="">- Select -</option>
                        <?php foreach($data as $res) { ?>
                        <option value="<?php echo $res['country']; ?>" <?php if($ans2[0]['country'] == $res['country']) { ?> selected="selected" <?php } ?>><?php echo $res['country']; ?></option>
                        <?php } ?>
                    </select>
                     <label>Residing city</label>
                    	<input type="text" name="city" id="city" value="<?php echo $ans2[0]['city']; ?>" tabindex="5" style="clear:none;margin-left:80px;"> 
                        
                     <label>Occupation</label>
                    <select id="drpOccupation" name="drpOccupation"  tabindex="12" style="clear:none; margin-left:88px;">
                    	<option value="">--Select--</option>
                      <?php
					  	$sql = "select * from occupation_master";
						$ans3 = $obj->select($sql);
						foreach($ans3 as $a)
						{ ?>
	                        <option value="<?php echo $a['occupation']; ?>" <?php if($ans2[0]['occupation'] == $a['occupation']) { ?> selected="selected" <?php } ?>><?php echo $a['occupation']; ?></option>
						<?php }
					   ?>
                                                
                    </select> 
                    <label>Annual Income</label>
                    <select id="drpAnnualIncome" name="drpAnnualIncome"  tabindex="14" style="clear:none; margin-left:68px;">	
                    	<option value="">--Select--</option>
                        <?php
							$sql = "select * from annual_income_master";
							$ans3 = $obj->select($sql);
							foreach($ans3 as $a)
							{ 
							if(($a['annual_income']!="Optional") && ($a['annual_income'] != "Any" )){ ?>
                            <option value="<?php echo $a['annual_income']; ?>" <?php if($ans2[0]['annual_income'] == $a['annual_income']) { ?> selected="selected" <?php } ?>><?php echo $a['annual_income']; ?></option>
                            <?php } } ?>
                    </select> 
                    <label>Partner Description</label>
                    <input type="text" name="partner_description" value="<?php echo $ans2[0]['partner_description']; ?>" id="partner_description" style='clear:none; margin-left:39px;'/>
                     <input type="submit" name="save_pref_partner" value="Save">                    
                    </div> 
</form> 
                          
<?php } ?> 


<?php if($_GET['hint'] == "family_detail") { ?>
<h3>Add/Edit Family Details </h3>
	<form name="photo_upload_form" method="post" style="padding-top:30px" enctype="multipart/form-data">
       	<div class="new_acc">
         <label>Family Status</label>
             <select id="drpFamilyStatus" name="drpFamilyStatus" onchange="return check_form()"  tabindex="17" style="clear:none; margin-left:68px;">	
                    	<option value="">--Select--</option>
                        <option value="middle" <?php if($ans[0]['family_status'] == "middle") { ?> selected="selected" <?php } ?>>Middle class</option>
                        <option value="upper_middle" <?php if($ans[0]['family_status'] == "upper_middle") { ?> selected="selected" <?php } ?>>Upper middle class</option>
                        <option value="rich" <?php if($ans[0]['family_status'] == "rich") { ?> selected="selected" <?php } ?>>Rich</option>                        
                        <option value="affluent" <?php if($ans[0]['family_status'] == "affluent") { ?> selected="selected" <?php } ?>>Affluent</option>
             </select>
              <label>Family Type</label>
             <select id="drpFamilyType" name="drpFamilyType" onchange="return check_form()"  tabindex="18" style="clear:none; margin-left:75px;">	
                    	<option value="">--Select--</option>
                        <option value="joint" <?php if($ans[0]['family_type'] == "joint") { ?> selected="selected" <?php } ?>>Joint</option>
                        <option value="nuclear" <?php if($ans[0]['family_type'] == "nuclear") { ?> selected="selected" <?php } ?>>Nuclear</option>                       
             </select>
             <label>Family Values</label>
             <select id="drpFamilyValues" name="drpFamilyValues" onchange="return check_form()"  tabindex="19" style="clear:none; margin-left:65px;">	
                    	<option value="">--Select--</option>
                        <option value="orthodox" <?php if($ans[0]['family_value'] == "orthodox") { ?> selected="selected" <?php } ?>>Orthodox</option>
                        <option value="traditional" <?php if($ans[0]['family_value'] == "traditional") { ?> selected="selected" <?php } ?>>Traditional</option>                       
                        <option value="moderate" <?php if($ans[0]['family_value'] == "moderate") { ?> selected="selected" <?php } ?>>Moderate</option>
                        <option value="liberal" <?php if($ans[0]['family_value'] == "liberal") { ?> selected="selected" <?php } ?>>Liberal</option>
             </select>
                <input type="submit" name="save_family_details" value="Update">
        </div>
    </form>    
<?php } ?> 


<?php if($_GET['hint'] == "hobbies") { 
$sql = "SELECT * FROM memebr_hobbies_interest
		where member_id = '".$_SESSION['logged_user'][0]['id']."'";
$result = $obj->select($sql); 		
?>
<form name="photo_upload_form" method="post"  enctype="multipart/form-data">
       	<div class="new_acc">
        <?php $sql = "select * from hobbies";
			  $hobbies = $obj->select($sql);
			?>  
			<div class="hobbieslist-label">
     		 <label>Hobbies</label>
            
             	<div class="list-chkbox">
                 <?php   foreach($hobbies as $h) { ?>
                  		 <label><input type="checkbox" name="chkHobbies[]"  value="<?php echo $h['name']; ?>"
                         <?php if(in_array($h['name'],$result[0]['hobbies'])) { ?> checked="checked" <?php } ?>><?php echo $h['name']; ?></label>
                        <?php }  ?>                
                </div>

             </div>
             
             
             
             <?php $sql = "select * from interest";
			  	   $interests = $obj->select($sql);
			?> 
             <div class="hobbieslist-label">
     		 <label>Interests</label>
            
             	<div class="list-chkbox">
                 <?php   foreach($interests as $int) { ?>
                  		 <label><input type="checkbox" name="chkInterests[]" value="<?php echo $int['name']; ?>"><?php echo $int['name']; ?></label>											                 <?php }  ?>                
                </div>

             </div>
             
              
             <?php $sql = "select * from music";
			  	   $musics = $obj->select($sql);
			?> 
             <div class="hobbieslist-label">
     		 <label>Favourite music</label>
            
             	<div class="list-chkbox">
                 <?php   foreach($musics as $m) { ?>
                  		 <label><input type="checkbox" name="chkMusic[]" value="<?php echo $m['name']; ?>"><?php echo $m['name']; ?></label>											                 <?php }  ?>                
                </div>

             </div>
             
              <?php $sql = "select * from tbl_read";
			  	   $reads = $obj->select($sql);
			?> 
             <div class="hobbieslist-label">
     		 <label>Favourite read</label>
            
             	<div class="list-chkbox">
                 <?php   foreach($reads as $r) { ?>
                  		 <label><input type="checkbox" name="chkRead[]" value="<?php echo $r['name']; ?>"><?php echo $r['name']; ?></label>											                 <?php }  ?>                
                </div>
             </div>
             
               <?php $sql = "select * from movies";
			  	   $movies = $obj->select($sql);
			?> 
             <div class="hobbieslist-label">
     		 <label>Favourite movie</label>
            
             	<div class="list-chkbox">
                 <?php   foreach($movies as $m) { ?>
                  		 <label><input type="checkbox" name="chkMovies[]" value="<?php echo $m['name']; ?>"><?php echo $m['name']; ?></label>											                 <?php }  ?>                
                </div>
             </div>
             
             
             <?php $sql = "select * from activities";
			  	   $activities = $obj->select($sql);
			?> 
             <div class="hobbieslist-label">
     		 <label>Sports/fitness activities</label>
            
             	<div class="list-chkbox">
                 <?php   foreach($activities as $act) { ?>
                  		 <label><input type="checkbox" name="chkSports[]" value="<?php echo $act['name']; ?>"><?php echo $act['name']; ?></label>											                 <?php }  ?>                
                </div>
             </div>
            
           <?php $sql = "select * from couisine";
			  	   $couisine = $obj->select($sql);
			?> 
             <div class="hobbieslist-label" style="display:none">
     		 <label>Favourite couisine</label>
            
             	<div class="list-chkbox">
                 <?php   foreach($couisine as $cou) { ?>
                  		 <label><input type="checkbox" name="chkCouisine[]" value="<?php echo $cou['name']; ?>"><?php echo $cou['name']; ?></label>											                 <?php }  ?>                
                </div>
             </div>  

             
             
             
        <input type="submit" name="save_hobbies" value="Update">     

        </div>
</form>             

<?php  } ?>
         
</div>
<style>
.list-chkbox
{
	width:760px;
}

</style>