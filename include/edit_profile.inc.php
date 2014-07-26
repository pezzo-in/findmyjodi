<?php
session_start();
//to deactivte account
if($_GET['flag'] == 'deactive')
{
	$update="UPDATE members SET status = 'Deactive' where id = '".$_SESSION['logged_user'][0]['id']."'";
	$db_updatepage=$obj->edit($update);	
   echo "<script>window.location='edit_profile.php'</script>";
}
//to activate account
if($_GET['flag'] == 'active')
{
	$update="UPDATE members 
				  SET 
				  	status = 'Active'				  		
				 where 
				 	id = '".$_SESSION['logged_user'][0]['id']."'";
					
		echo $update; 
	$db_updatepage=$obj->edit($update);	
   echo "<script>window.location='edit_profile.php'</script>";
}
//to delete account
if($_GET['flag'] == 'delete')
{
	$delete_acc="delete from members 
				 where 
				 id = '".$_SESSION['logged_user'][0]['id']."'";
	$obj->sql_query($delete_acc);
	session_unset();
	session_destroy();
	echo "<script>window.location='logout.php'</script>";
}
if(isset($_POST['submit']))
{
	$cnt = 0;
	if($_POST['occupation'] != "")
	{
		$cnt++;
	}
	if($_POST['employed_in'] != "")
	{
		$cnt++;
	}
	if($_POST['annual_income'] != "")
	{
		$cnt++;
	}
	$total_fields = ($cnt + 8);
	$ratio = ((round(($total_fields*70)/15,0))+30);
	
	$eid="select * from education_course where id='".$_POST['education']."'";
	$course_eid=$obj->select($eid);	
	//$new_date=$_POST['dob']; 
	//echo $_POST['dob'].'<br>';
	//echo strtotime($_POST['dob']).'<br>';
	$dob = date('Y-m-d',strtotime($_POST['dob']));
	//echo $dob;die;
	$update_page="UPDATE members 
				  SET 
				  		profile_for = '".$_POST['drpProfFor']."',name = '".$_POST['username']."',gender = '".$_POST['Rdgender']."',
						religion = '".$_POST['drpReligion']."',caste = '".$_POST['drpCaste']."',country = '".$_POST['drpCountry']."',
						place_of_birth = '".$_POST['place_of_birth']."',
						date_of_birth = '".$dob."',
						
						age = '".(date('Y')-date('Y',strtotime($_POST['dob'])))."',
						
						mother_tongue =  '".$_POST['drpMotherlanguage']."',
						mobile_no = '".$_POST['txtMobNo']."',education = '".$_POST['education']."',degree_in = '".$course_eid[0]['Eid']."',occupation =  '".$_POST['occupation']."',
						employed_in = '".$_POST['employed_in']."',annual_income = '".$_POST['annual_income']."',
						mob_code = '".$_POST['mob_code']."',about_me = '".$_POST['about_me']."',
						body_type = '".$_POST['drpBodyType']."',living_with_parents = '".$_POST['drpLiving']."',
						family_value = '".$_POST['drpFamilyValue']."',is_smoker = '".$_POST['drpSmoking']."',
						is_drinker = '".$_POST['drpDrinking']."',food = '".$_POST['drpEatingHabits']."',
						family_status = '".$_POST['drpFamilyStatus']."',
						family_value = '".$_POST['drpFamilyValues']."',
						family_type = '".$_POST['drpFamilyType']."',
						relationship_status = '".$_POST['mari_status']."',
						manglik_dosham = '".$_POST['manglik']."',
						weight = '".$_POST['drpWeight']."',
						height = '".$_POST['drpHeight']."',
						no_of_brothers = '".$_POST['num_bro']."',
					 	no_of_sisters = '".$_POST['num_sis']."',
					 	bro_married = '".$_POST['num_bro_married']."',
					 	sis_married = '".$_POST['num_sis_married']."',
						star = '".$_POST['drpstar']."',
						gothram = '".$_POST['gothram']."',
						complexion = '".$_POST['drpComplexion']."',
						state = '".$_POST['state']."',
						city = '".$_POST['city']."',
						physical_status = '".$_POST['drpPhysicalStatus']."',
						horoscope_match = '".$_POST['horoscope']."'
				 where 
				 		id = '".$_SESSION['logged_user'][0]['id']."'";
						
					$db_updatepage=$obj->edit($update_page);	
						//echo $update_page;exit;
		if($_POST['mail_alerts']==1)
		{
			$update_page="UPDATE members SET mail_alerts = '".$_POST['mail_alerts']."' where id = '".$_SESSION['logged_user'][0]['id']."'";
			$db_updatepage=$obj->edit($update_page);
		}
		else
		{
			$update_page="UPDATE members SET mail_alerts = '0' where id = '".$_SESSION['logged_user'][0]['id']."'";
			$db_updatepage=$obj->edit($update_page);
		}
		
		 $select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$_SESSION['logged_user'][0]['id']."' AND members.id=member_plans.member_id";
		$db_member_plan=$obj->select($select_member_plan);
		
		$exp_date=date('Y-m-d');
		
		if(count($db_member_plan)>0)
		{
			$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
			$db_plan=$obj->select($select_plan);
			
			$exp_date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_date[0]['reg_date']));
		}
	
		if(count($db_member_plan)>0 && date('Y-m-d',strtotime($exp_date))>=date('Y-m-d'))
		{
			if($_POST['is_featured']=='Y')
			{
				$update_page="UPDATE members SET is_featured = '".$_POST['is_featured']."' where id = '".$_SESSION['logged_user'][0]['id']."'";
				$db_updatepage=$obj->edit($update_page);
			}
			else
			{
				$update_page="UPDATE members SET is_featured = 'N' where id = '".$_SESSION['logged_user'][0]['id']."'";
				$db_updatepage=$obj->edit($update_page);
			}
		}
		
						
						echo "<script>window.location='my_account.php?ratio=".$ratio."'</script>";
}	
//LOGGED-IN USER'S DETAIL //
	$sql_login = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE 
			 	members.id = '".$_SESSION['logged_user'][0]['id']."'";	
	$logged_in_member=$obj->select($sql_login);		
?>
        <?php if(!empty($logged_in_member)) { ?>	  
        <div class="content col-md-9 col-xs-12 col-sm-12">
        
        	<div class="profile_details">
            
            	<form id="formID" class="form-horizontal" method="post" action="" onsubmit="return check_form()">
               <?php if (isset($error)) { echo "<p class='message'>" .$error. "</p>" ;} ?>
                <div class="row-detail new_acc editprof">
                  <h3>About Me</h3>
                   <textarea id="about_me" rows="5" class="col-md-12 col-xs-12 col-sm-12" name="about_me"><?php echo $logged_in_member[0]['about_me']; ?></textarea>
               </div>
               
               <div class="row-detail new_acc editprof">
                  <h3>More About Me</h3>
                   <ul class="col-md-6 col-xs-12 col-sm-6">
                   	<li> <label>Name</label>
                    <input class="form-control col-md-12 col-sm-12 col-xs-12" type="text" name="username" id="username" value="<?php echo $logged_in_member[0]['name']; ?>" />
                   </li></ul>
                   
                   <ul class="col-md-6 col-xs-12 col-sm-6">
                   	<li> <label>Gender</label>
                            <div id="genderRadio">
                            <label class="radiobtn">
                                <input class="form-control" style="float: left; margin:-7px 7px 0 0" type="radio" name="Rdgender" id="Rdgenderm" value="M" <?php if($logged_in_member[0]['gender'] == 'M') { ?> checked="checked"  <?php } ?> />Male
                            </label>
                            <label class="radiobtn">
                                <input class="form-control" style="float: left; margin:-7px 7px 0 0" type="radio" value="F" name="Rdgender" id="Rdgenderf" <?php if($logged_in_member[0]['gender'] == 'F') { ?> checked="checked" <?php } ?> />Female
                            </label>
                            </div>
                   </li></ul>
                   
                   <ul class="col-md-6 col-xs-12 col-sm-6">
                   	<li><label>Marital Status</label><?php
						$relation_list = "select * from relationship_status";
						$data = $obj->select($relation_list);
					?>
                    <select class="form-control col-md-12 col-sm-12 col-xs-12" name="mari_status" id="mari_status">
                        <option value=""> -Select- </option>
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['status']; ?>"
                            <?php if($logged_in_member[0]['relationship_status'] == $res['status']) {  ?> selected="selected" <?php } ?> >
							<?php echo $res['status']; ?></option>
                        <?php } ?>
                    </select>
                    </li></ul>
                    <ul class="col-md-6 col-xs-12 col-sm-6">
                    	<li><label>Matrimony Profile For</label><select class="form-control col-md-12 col-sm-12 col-xs-12" id="drpProfFor" name="drpProfFor">
                                <option value="">-Select-</option>
                                <option value="Myself" <?php if($logged_in_member[0]['profile_for'] == "Myself") { ?>  selected="selected" <?php } ?> >Myself</option>
                                <option value="Son" <?php if($logged_in_member[0]['profile_for'] == "Son") { ?>  selected="selected" <?php } ?>>Son</option>
                                <option value="Daughter" <?php if($logged_in_member[0]['profile_for'] == "Daughter") { ?>  selected="selected" <?php } ?>>Daughter</option>
                                <option value="Brother" <?php if($logged_in_member[0]['profile_for'] == "Brother") { ?>  selected="selected" <?php } ?>>Brother</option>
                                <option value="Sister" <?php if($logged_in_member[0]['profile_for'] == "Sister") { ?>  selected="selected" <?php } ?>>Sister</option>
                                <option value="Relative" <?php if($logged_in_member[0]['profile_for'] == "Relative") { ?>  selected="selected" <?php } ?>>Relative</option>
                                <option value="Friend" <?php if($logged_in_member[0]['profile_for'] == "Friend") { ?>  selected="selected" <?php } ?>>Friend</option>
                    		</select>
                    </li></ul>
                    
                    <ul class="col-md-6 col-xs-12 col-sm-6">
                    	<li><label>Country Living in</label><?php
								$country_list = "select * from mobile_codes";
								$data = $obj->select($country_list);
							?>
							<select class="form-control col-md-12 col-sm-12 col-xs-12" name="drpCountry" id="drpCountry" />
								<option value="">- Select -</option>
								<?php foreach($data as $res) { ?>
								<option value="<?php echo $res['country']; ?>"
								<?php if($logged_in_member[0]['country'] == $res['country']) {  ?> selected="selected" <?php } ?> >
								<?php echo $res['country']; ?></option>
								<?php } ?>
							</select>
                    </li></ul>
                    <ul class="col-md-6 col-xs-12 col-sm-6">
                    	<li><label>State</label>
                 			<input class="form-control col-md-12 col-sm-12 col-xs-12" type="text" name="state" id="state" value="<?php echo $logged_in_member[0]['state']; ?>">
                    </li></ul>
                    <ul class="col-md-6 col-xs-12 col-sm-6"><li><label>City</label>
                 			<input class="form-control col-md-12 col-sm-12 col-xs-12" type="text" name="city" id="city" value="<?php echo $logged_in_member[0]['city']; ?>">
                    </li></ul>
                    <ul class="col-md-6 col-xs-12 col-sm-6">
                    	<li> <label>Star</label>
                             <select class="form-control col-md-12 col-sm-12 col-xs-12" name="drpstar" id="drpstar"/>>
                                <option value="">Select</option>
                                <?php
                                    $fetch_star = "select * from horoscope_star_master";
                                    $db_star = $obj->select($fetch_star);
                                for($i=0;$i<count($db_star);$i++) { 
                                ?>
                                <option value="<?php echo $db_star[$i]['star']; ?>" <?php  if($db_star[$i]['star'] == $logged_in_member[0]['star']) { ?> selected="selected" <?php } ?>><?php echo $db_star[$i]['star']; ?></option>
                                <?php }    ?>
                            </select> 
                    </li></ul>
                    <ul class="col-md-6 col-xs-12 col-sm-6"><li><label>Mobile Number</label>
							 	<?php
									$select_category2 = "select * from mobile_codes";
									$db_category2 = $obj->select($select_category2);
                                ?>
                                <select id="drpMobcode" name="mob_code" class="col-md-2 col-sm-2 col-xs-12 form-control">
                                <?php foreach($db_category2 as $db) {  ?>
                                    <option value="<?php echo $db['mob_code']; ?>" <?php if($db['id'] == $logged_in_member[0]['mob_code']){ ?> selected="selected" <?php } ?>><?php echo $db['mob_code']; ?></option>
                                <?php } ?>
                                </select><input class="form-control col-md-10 col-sm-10 col-xs-12" type="text" name="txtMobNo" value="<?php echo $logged_in_member[0]['mobile_no']; ?>"  id="txtMobNo" />
                    </li></ul>
                     <ul class="col-md-6 col-xs-12 col-sm-6">
                     	<li><label>Horoscope</label>
							 	<input class="form-control col-md-12 col-sm-12 col-xs-12" type="text" name="horoscope" value="<?php echo $logged_in_member[0]['horoscope_match']; ?>"  id="horoscope" />
                    </li></ul>
                    </div>
                    <div class="row-detail new_acc editprof">
                          <h3>Education & Occupation</h3>
                           <ul class="col-md-6 col-xs-12 col-sm-6">
                           	<li><label>Education</label>
                                   <select class="form-control col-md-12 col-sm-12 col-xs-12" id="education"  name="education" >
                                    
                                        <option value="">--Select--</option>
                                        <?php
                                        $level="SELECT education_details.* FROM `education_details` join education_course on Eid=education_details.id group by education_details.id";
                                        
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
                                                <option value="<?php echo $cor[$j]['Id'];?>" <?php if($logged_in_member[0]['education']==$cor[$j]['Id']){ ?> selected="selected" <?php } ?> ><?php echo $cor[$j]['Title'];?></option>
                                                <?php } ?>
                                         </optgroup>
                                              <?php } ?>
                                    </select>
                            </li></ul>
                            
                            <ul class="col-md-6 col-xs-12 col-sm-6">
                            	<li><label>Employed In</label>
                                    <select class="form-control col-md-12 col-sm-12 col-xs-12" id="employed_in"  name="employed_in"  >	
                                        <option value="">--Select--</option>
                                        <option value="Government" <?php if($logged_in_member[0]['employed_in'] == "Government"){?> selected="selected" <?php } ?>>Government</option>
                                        <option value="Private" <?php if($logged_in_member[0]['employed_in'] == "Private"){?> selected="selected" <?php } ?>>Private</option>
                                        <option value="Business" <?php if($logged_in_member[0]['employed_in'] == "Business"){?> selected="selected" <?php } ?>>Business</option>
                                        <option value="Defence" <?php if($logged_in_member[0]['employed_in'] == "Defence"){?> selected="selected" <?php } ?>>Defence</option>
                                        <option value="Self_Employed" <?php if($logged_in_member[0]['employed_in'] == "Self_Employed"){?> selected="selected" <?php } ?>>Self Employed</option>
                                    </select>
                            </li></ul>
                             
                             <ul class="col-md-6 col-xs-12 col-sm-6">
                             	<li><label>Annual Income</label>
									<?php
                                        $income = "select * from annual_income_master";
                                        $data = $obj->select($income);
                                    ?>
                                    <select class="form-control col-md-12 col-sm-12 col-xs-12" name="annual_income" id="annual_income">
                                        <option value=""> -Select- </option>
                                        <?php foreach($data as $res) { ?>
                                            <option value="<?php echo $res['annual_income']; ?>"
                                            <?php if($logged_in_member[0]['annual_income'] == $res['annual_income']) {  ?> selected="selected" <?php } ?> >
                                            <?php echo $res['annual_income']; ?></option>
                                        <?php } ?>
                                    </select>
                            </li></ul>
                            
                            <ul class="col-md-6 col-xs-12 col-sm-6">
                            	<li> <label>Occupation</label>
									<?php
                                        $list = "select * from occupation_master";
                                        $data = $obj->select($list);
                                    ?>
                                    <select class="form-control col-md-12 col-sm-12 col-xs-12" name="occupation" id="occupation" />
                                        <option value="">Select</option>
                                        <?php foreach($data as $res) { ?>
                                            <option value="<?php echo $res['occupation']; ?>"
                                            <?php if($logged_in_member[0]['occupation'] == $res['occupation']) {  ?> selected="selected" <?php } ?> >
                                            <?php echo $res['occupation']; ?></option>
                                        <?php } ?>
                                    </select>
                            </li></ul>
                    
                    
                    </div>
                    
                    <div class="row-detail new_acc editprof">
                          <h3>Physical Appearance & Looks</h3>
                           <ul class="col-md-6 col-xs-12 col-sm-6">
                           	<li><label>Height</label>
                                    <select class="form-control col-md-12 col-sm-12 col-xs-12" id="drpHeight" name="drpHeight" >
                                       <option value="">- Feet/Inches -</option>
                                       <?php 
                                            $select_height="select * from height";
                                            $db_height=$obj->select($select_height);
                                            for($i=0;$i<count($db_height);$i++){
                                            ?>
                                           <option value="<?php echo $db_height[$i]['Id']; ?>" <?php if($logged_in_member[0]['height'] == $db_height[$i]['Id']) {  ?> selected="selected" <?php } ?>><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>
                                           <?php } ?>
                                    </select>
                            </li></ul>
                            
                             <ul class="col-md-6 col-xs-12 col-sm-6">
                             	<li><label>Weight</label>
                                        <select class="form-control col-md-12 col-sm-12 col-xs-12" id="drpWeight" name="drpWeight" >
                                           <option value="">- Kgs -</option>
                                           <?php for($i=41;$i<=140;$i++) { ?>
                                               <option value="<?php echo $i." kg"; ?>" <?php if($logged_in_member[0]['weight'] == $i." kg") {  ?> selected="selected" <?php } ?>><?php echo $i." kg"; ?></option>					  
                                           <?php } ?>                       
                                        </select>
                            </li></ul>
                            
                             <ul class="col-md-6 col-xs-12 col-sm-6">
                             	<li> <label>Complexion</label>
                                       <select class="form-control col-md-12 col-sm-12 col-xs-12" id="drpComplexion" name="drpComplexion">
                                           <option value="">-Select-</option>
                                           <option value="Very Fair" <?php if($logged_in_member[0]['complexion']=="Very Fair") { ?> selected="selected" <?php } ?>>Very Fair</option>
                                           <option value="Fair" <?php if($logged_in_member[0]['complexion']=="Fair") { ?> selected="selected" <?php } ?>>Fair</option>
                                           <option value="Wheatish" <?php if($logged_in_member[0]['complexion']=="Wheatish") { ?> selected="selected" <?php } ?>>Wheatish</option>
                                           <option value="Wheatish Brown" <?php if($logged_in_member[0]['complexion']=="Wheatish Brown") { ?> selected="selected" <?php } ?>>Wheatish Brown</option>
                                           <option value="Dark" <?php if($logged_in_member[0]['complexion']=="Dark") { ?> selected="selected" <?php } ?>>Dark</option>
                                        </select>
                            </li></ul>
                            
                             <ul class="col-md-6 col-xs-12 col-sm-6">
                             	<li><label>Body type</label>
                                         <select class="form-control col-md-12 col-sm-12 col-xs-12" name="drpBodyType" id="drpBodyType" >
                                            <option value="">Select</option>
                                            <option value="Slim" <?php if($logged_in_member[0]['body_type'] == "Slim") { ?> selected="selected" <?php } ?>>Slim</option>
                                            <option value="Athletic" <?php if($logged_in_member[0]['body_type'] == "Athletic") { ?> selected="selected" <?php } ?>>Athletic</option>
                                            <option value="Average" <?php if($logged_in_member[0]['body_type'] == "Average") { ?> selected="selected" <?php } ?>>Average</option>
                                            <option value="Heavy" <?php if($logged_in_member[0]['body_type'] == "Heavy") { ?> selected="selected" <?php } ?>>Heavy</option>   
                                        </select> 
                            </li></ul>
                            
                            <ul class="col-md-6 col-xs-12 col-sm-6">
                            	<li><label>Physical Status</label>
                                         <select class="form-control col-md-12 col-sm-12 col-xs-12" id="drpPhysicalStatus"  name="drpPhysicalStatus" >
                                           <option value="">-Select-</option>
                                           <option value="normal" <?php if($logged_in_member[0]['physical_status'] == "normal") { ?> selected="selected" <?php } ?>>Normal</option>
                                           <option value="Physically Challenged"  <?php if($logged_in_member[0]['physical_status'] == "Physically Challenged") { ?> selected="selected" <?php } ?>>Physically challenged</option>                       
                                        </select>
                            </li></ul>
                    </div>
                    <div class="row-detail new_acc editprof">
                          <h3>Religion and Social info</h3>
                           <ul class="col-md-6 col-xs-12 col-sm-6">
                           	<li> <label>Religion</label>
									<?php
                                        $religion_list = "select * from religions";
                                        $data = $obj->select($religion_list);
                                    ?>
                                    <select class="form-control col-md-12 col-sm-12 col-xs-12" name="drpReligion" id="drpReligion" onchange="change_religion(this.value);" />
                                         <option value="">- Select -</option>
                                        <?php foreach($data as $res) { ?>
                                            <option value="<?php echo $res['religion']; ?>" 
                                                <?php if($logged_in_member[0]['religion'] == $res['religion']) {  ?> selected="selected" <?php } ?> >
                                                <?php echo $res['religion']; ?></option>
                                        <?php } ?>
                                    </select>
                            </li></ul>
                            
                             <ul class="col-md-6 col-xs-12 col-sm-6">
                             	<li><label>Mother Tongue</label> 
										 <?php
                                            $list = "select * from mother_tongues";
                                            $data = $obj->select($list);
                                        ?>   
                                        <select class="form-control col-md-12 col-sm-12 col-xs-12" name="drpMotherlanguage" id="drpMotherlanguage"  />
                                            <option value=""> -Select- </option>
                                            <?php foreach($data as $res) { ?>
                                                <option value="<?php echo $res['name']; ?>"
                                                 <?php if($logged_in_member[0]['mother_tongue'] == $res['name']) {  ?> selected="selected" <?php } ?> >
                                                <?php echo $res['name']; ?></option>
                                            <?php } ?>
                                        </select> 
                            </li></ul>
                            
                             <ul class="col-md-6 col-xs-12 col-sm-6">
                             	<li><label>Caste</label>
										<?php
											$select_caste_rel = "select id from religions where religion='".$logged_in_member[0]['religion']."'";
											$db_rel_cast = $obj->select($select_caste_rel);
                                           
										    $caste_list = "select * from caste where religion_id = '".$db_rel_cast[0]['id']."'";
                                            $data = $obj->select($caste_list);
                                        ?>
                                        <div id="caste_drp_div">
                                        <select class="form-control col-md-12 col-sm-12 col-xs-12" name="drpCaste" id="drpCaste">
                                            <option value=""> -Select- </option>
                                            <?php foreach($data as $res) { ?>
                                                <option value="<?php echo $res['caste']; ?>"
                                                <?php if($logged_in_member[0]['caste'] == $res['caste']) {  ?> selected="selected" <?php } ?> >
                                                <?php echo $res['caste']; ?></option>
                                            <?php } ?>
                                        </select>
                                        </div>
                            </li></ul>
                            
                             <ul class="col-md-6 col-xs-12 col-sm-6">
                             	<li><label>Manglik</label>
                                       <select class="form-control col-md-12 col-sm-12 col-xs-12" name="manglik" id="manglik" />
                                            <option value="Dont Know" <?php if($logged_in_member[0]['manglik_dosham'] == 'Dont Know') {  ?> selected="selected" <?php } ?>>Don't Know</option>
                                            <option value="Y" <?php if($logged_in_member[0]['manglik_dosham'] == 'Y') {  ?> selected="selected" <?php } ?>>Yes</option>
                                            <option value="N" <?php if($logged_in_member[0]['manglik_dosham'] == 'N') {  ?> selected="selected" <?php } ?>>No</option>
                                        </select>
							</li></ul>
                            
                             <ul class="col-md-6 col-xs-12 col-sm-6">
                             	<li><label>Gotra /Gothram</label>
 									<input class="form-control col-md-12 col-sm-12 col-xs-12" type="text" name="gothram" value="<?php echo $logged_in_member[0]['gothram']; ?>" id="gothram">
                            </li></ul>
                    </div>
                    
                    <div class="row-detail new_acc editprof">
                          <h3>Astro info</h3>
                           <ul class="col-md-6 col-xs-12 col-sm-6">
                           	<li><label>Date of Birth</label>
                     		<div class="controls">
          <input class="form-control col-md-12 col-sm-12 col-xs-12 date-picker" type="text" value="<?php echo date('d-m-Y',strtotime($logged_in_member[0]['date_of_birth'])); ?>" id="dob" name="dob" />
                            </div>
                            </li></ul>
                            
                            <ul class="col-md-6 col-xs-12 col-sm-6">
                            	<li><label>Place of Birth</label>
                   					 <div><input class="form-control col-md-12 col-sm-12 col-xs-12" type="text" name="place_of_birth" id="place_of_birth" value="<?php echo $logged_in_member[0]['place_of_birth']; ?>"  /></div>
                    		</li></ul>
                    </div>
                    
                    <div class="row-detail new_acc editprof">
                          <h3>Family</h3>
                           <ul class="col-md-6 col-xs-12 col-sm-6">
                           	<li><label>Brothers</label>
                             <select class="form-control col-md-12 col-sm-12 col-xs-12" id="num_bro" name="num_bro" style="width:80px;">	
                
                                        <option value="">Select</option>
                                        <?php for($i=1;$i<=10;$i++) { ?>
                                        <option value=<?php echo $i; ?> <?php if($logged_in_member[0]['no_of_brothers'] == $i) { ?> selected="selected" <?php } ?>><?php echo $i; ?></option>
                                        <?php } ?>
                             </select><span style="padding:8px 4px 0; float:left;">of them </span>  
                             <select class="form-control col-md-12 col-sm-12 col-xs-12" id="num_bro_married" name="num_bro_married" style="width:80px; clear:none;">	
                
                                        <option value="">Select</option>
                                        <?php for($i=0;$i<=$logged_in_member[0]['no_of_brothers'];$i++) { ?>
                                        <option value=<?php echo $i; ?> <?php if($logged_in_member[0]['bro_married'] == $i) { ?> selected="selected" <?php } ?>><?php echo $i; ?></option>
                                        <?php } ?>
                             </select><span style="padding:8px 4px 0; float:left;">are married</span>  
                            </li></ul>
                            
                            <ul class="col-md-6 col-xs-12 col-sm-6"><li style="width:100%"><label>Sisters</label>			
                                     <select class="form-control col-md-12 col-sm-12 col-xs-12" id="num_sis" name="num_sis" style="width:80px;">	
                                                <option value="">Select</option>
                                                <?php for($i=1;$i<=10;$i++) { ?>
                                                <option value=<?php echo $i; ?> <?php if($logged_in_member[0]['no_of_sisters'] == $i) { ?> selected="selected" <?php } ?>><?php echo $i; ?></option>
                                                <?php } ?>
                                     </select><span style="padding:8px 4px 0; float:left;">of them </span>
                                  
                                     <select class="form-control col-md-12 col-sm-12 col-xs-12" id="num_sis_married" name="num_sis_married"  style="width:80px; clear:none;">
                                                <option value="">Select</option>
                                                <?php for($i=0;$i<=$logged_in_member[0]['no_of_sisters'];$i++) { ?>
                                                <option value=<?php echo $i; ?> <?php if($logged_in_member[0]['sis_married'] == $i) { ?> selected="selected" <?php } ?>><?php echo $i; ?></option>
                                                <?php } ?>
                                     </select><span style="padding:8px 4px 0; float:left;">are married</span>
             				</li></ul>
                            
                            <ul class="col-md-6 col-xs-12 col-sm-6">
                            	<li><label>Living with Parents?</label>
                                     <select class="form-control col-md-12 col-sm-12 col-xs-12" name="drpLiving" id="drpLiving" >
                                        <option value="">Select</option>
                                        <option value="Y" <?php if($logged_in_member[0]['living_with_parents'] == "Y"){?> selected="selected" <?php } ?>>Yes</option>	
                                        <option value="N" <?php if($logged_in_member[0]['living_with_parents'] == "N"){?> selected="selected" <?php } ?>>No</option>
                                     </select>
                            </li></ul>
                            
                            <ul class="col-md-6 col-xs-12 col-sm-6">
                            	<li><label>Family Values</label>
									<select class="form-control col-md-12 col-sm-12 col-xs-12" id="drpFamilyValues" name="drpFamilyValues" tabindex="19">	
                        				<option value="">--Select--</option>
                        		        <option value="orthodox" <?php if($logged_in_member[0]['family_value'] == "orthodox") { ?> selected="selected" <?php } ?>>Orthodox</option>
                                        <option value="traditional" <?php if($logged_in_member[0]['family_value'] == "traditional") { ?> selected="selected" <?php } ?>>Traditional</option>                       
                                        <option value="moderate" <?php if($logged_in_member[0]['family_value'] == "moderate") { ?> selected="selected" <?php } ?>>Moderate</option>
                                        <option value="liberal" <?php if($logged_in_member[0]['family_value'] == "liberal") { ?> selected="selected" <?php } ?>>Liberal</option>
                                    </select>
                            </li></ul>
                            
                            <ul class="col-md-6 col-xs-12 col-sm-6">
                            	<li><label>Family Type</label>
										<select class="form-control col-md-12 col-sm-12 col-xs-12" id="drpFamilyType" name="drpFamilyType" tabindex="18">	
                        			        <option value="">--Select--</option>
                        			        <option value="joint" <?php if($logged_in_member[0]['family_type'] == "joint") { ?> selected="selected" <?php } ?>>Joint</option>
                        		            <option value="nuclear" <?php if($logged_in_member[0]['family_type'] == "nuclear") { ?> selected="selected" <?php } ?>>Nuclear</option>                       
                        			    </select>
                            </li></ul>
                            
                            <ul class="col-md-6 col-xs-12 col-sm-6">
                            	<li><label>Family Status</label>
									 <select class="form-control col-md-12 col-sm-12 col-xs-12" id="drpFamilyStatus" name="drpFamilyStatus" tabindex="17">	
                        					<option value="">--Select--</option>
                        					<option value="Middle" <?php if($logged_in_member[0]['family_status'] == "Middle") { ?> selected="selected" <?php } ?>>Middle class</option>
                        					<option value="Upper Middle" <?php if($logged_in_member[0]['family_status'] == "Upper Middle") { ?> selected="selected" <?php } ?>>Upper middle class</option>
                        				    <option value="rich" <?php if($logged_in_member[0]['family_status'] == "rich") { ?> selected="selected" <?php } ?>>Rich</option>                        
                        			        <option value="affluent" <?php if($logged_in_member[0]['family_status'] == "affluent") { ?> selected="selected" <?php } ?>>Affluent</option>
                        			 </select>
                            </li></ul>
                     </div>
                    
                    <div class="row-detail new_acc editprof">
                          <h3>Lifestyle</h3>
                           <ul class="col-md-6 col-xs-12 col-sm-6">
                           	<li><label>Smoking Habits</label>
                                    <select class="form-control col-md-12 col-sm-12 col-xs-12" name="drpSmoking" id="drpSmoking" />
                                        <option value="">Select</option>
                                        <option value="Y" <?php if($logged_in_member[0]['is_smoker'] == "Y"){?> selected="selected"<?PHP } ?>>Yes</option>
                                        <option value="N" <?php if($logged_in_member[0]['is_smoker'] == "N"){?> selected="selected"<?PHP } ?>>No</option>
                                        <option value="O" <?php if($logged_in_member[0]['is_smoker'] == "O"){?> selected="selected"<?PHP } ?>>Occasionally</option>
                                    </select>
                            </li></ul>
                            
                             <ul class="col-md-6 col-xs-12 col-sm-6">
                             	<li> <label>Drinking Habits</label>
                                        <select class="form-control col-md-12 col-sm-12 col-xs-12" name="drpDrinking" id="drpDrinking"  />
                                            <option value="">Select</option>
                                            <option value="Y" <?php if($logged_in_member[0]['is_drinker'] == "Y"){?> selected="selected"<?PHP } ?>>Yes</option>
                                            <option value="N" <?php if($logged_in_member[0]['is_drinker'] == "N"){?> selected="selected"<?PHP } ?>>No</option>
                                            <option value="O" <?php if($logged_in_member[0]['is_drinker'] == "O"){?> selected="selected"<?PHP } ?>>Occasionally</option>
                                        </select> 
                            </li></ul>
                            
                             <ul class="col-md-6 col-xs-12 col-sm-6">
                             	<li> <label>Eating Habits</label>
                                        <select class="form-control col-md-12 col-sm-12 col-xs-12" name="drpEatingHabits" id="drpEatingHabits"  />
                                            <option value="">Select</option>
                                            <option value="Vegetarian" <?php if($logged_in_member[0]['food'] == "Vegetarian"){?> selected="selected"<?PHP } ?>>Vegetarian   </option>
                                            <option value="Non-Vegetarian" <?php if($logged_in_member[0]['food'] == "Non-Vegetarian"){?> selected="selected"<?PHP } ?>> Non Vegetarian</option>
                                            <option value="Eggetarian" <?php if($logged_in_member[0]['food'] == "Eggetarian"){?> selected="selected"<?PHP } ?>>Eggetarian</option>
                                        </select>
                            </li></ul>
                            
                    </div>
                    
                     <div class="row-detail new_acc editprof">
                           <ul class="col-md-6 col-xs-12 col-sm-6">
                           	<li><label><input class="form-control" type="checkbox" name="mail_alerts" style="margin-right:7px; float:left; margin-top:-7px;" value="1" <?php if($logged_in_member[0]['mail_alerts']==1){ ?> checked="checked" <?php } ?> />Do you want mail alerts?</label>
							<?php
								 $select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$_SESSION['logged_user'][0]['id']."' AND members.id=member_plans.member_id";
								$db_member_plan=$obj->select($select_member_plan);
								
								$exp_date=date('Y-m-d');
								
								if(count($db_member_plan)>0)
								{
									$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
									$db_plan=$obj->select($select_plan);
									
									$exp_date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_date[0]['reg_date']));
								}
							
								if(count($db_member_plan)>0 && date('Y-m-d',strtotime($exp_date))>=date('Y-m-d'))
								{
								?>
								<label><input class="form-control" type="checkbox" name="is_featured" value="Y" style="margin-right:7px; float:left; margin-top:-7px;" <?php if($logged_in_member[0]['is_featured']=="Y"){ ?> checked="checked" <?php } ?> />Featured Profile</label>
								 
								<?php
								}
								 ?>
                            </li>
                            </ul>
                            
                    </div>
                    
                    <div class="new_acc">           
                         <div class="left">
                        </div>
                         <div class="terms_line paddL-0">
                                <input class="btn btn-success btn-sm update_btn_new1" type="submit" name="submit" value="Update" onclick="return validate()" />
                         </div>
                    </div>            
          </form>
          </div>
        
		</div>
         
        <?php } ?>
     <script>
	 function check_form()
	 {
		$('#drpProfFor').css('border','1px solid #ccc');
		$('#username').css('border','1px solid #ccc');
		$('#drpReligion').css('border','1px solid #ccc');
		$('#drpCaste').css('border','1px solid #ccc');
		$('#drpCountry').css('border','1px solid #ccc');
		$('#dob').css('border','1px solid #ccc');
		$('#drpMotherlanguage').css('border','1px solid #ccc');
		$('#txtMobNo').css('border','1px solid #ccc');
		$('#about_me').css('border','1px solid #ccc');
		$('#mari_status').css('border','1px solid #ccc');
				
		error = 0;
		
		var letters = /^[A-Za-z]+$/;
		if(document.getElementById('username').value=='')
		{
			//alert('hello');	
			$('#username').css('border','1px solid red');	
			$('#username').focus();		
			username=1
		}
		else
		{
			username=0
		}
		if(!document.getElementById('username').value.match(letters))
		{
			//alert('hello');	
			$('#username').css('border','1px solid red');
			$('#username').focus();			
			username=1
		}
		else
		{
			username=0
		}
		
		if(document.getElementById('mari_status').value=='')
		{
			$('#mari_status').css('border','1px solid red');
			$('#mari_status').focus();
			mari_status=1
		}
		else
		{
			mari_status=0
		}
		
		if(document.getElementById('drpProfFor').value=='')
		{
			$('#drpProfFor').css('border','1px solid red');
			$('#drpProfFor').focus();
			drpProfFor=1
		}
		else
		{
			drpProfFor=0
		}
		
		
		if(document.getElementById('drpCountry').value=='')
		{
			$('#drpCountry').css('border','1px solid red');
			$('#drpCountry').focus();
			drpCountry=1
		}
		else
		{
			drpCountry=0
		}
		
		if(document.getElementById('txtMobNo').value=='')
		{
			$('#txtMobNo').css('border','1px solid red');
			$('#txtMobNo').focus();
			txtMobNo=1
		}
		else
		{
			txtMobNo=0
		}
		var phoneno = /^\d{10}$/;
		if(!document.getElementById('txtMobNo').value.match(phoneno))
		{
			$('#txtMobNo').css('border','1px solid red');
			$('#txtMobNo').focus();
			txtMobNo=1
		}
		else
		{
			txtMobNo=0
		}
		
		if(document.getElementById('drpReligion').value=='')
		{
			$('#drpReligion').css('border','1px solid red');
			$('#drpReligion').focus();
			drpReligion=1
		}
		else
		{
			drpReligion=0
		}
		if(document.getElementById('drpCaste').value=='')
		{
			$('#drpCaste').css('border','1px solid red');
			$('#drpCaste').focus();
			drpCaste=1
		}
		else
		{
			drpCaste=0
		}
		
		if(document.getElementById('drpMotherlanguage').value=='')
		{
			$('#drpMotherlanguage').css('border','1px solid red');
			$('#drpMotherlanguage').focus();
			drpMotherlanguage=1
		}
		else
		{
			drpMotherlanguage=0
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
		
		
	
	if(drpProfFor == 0 && username == 0 && drpReligion == 0 && drpCaste==0 && drpCountry==0 && dob==0 && drpMotherlanguage==0 && txtMobNo==0  && mari_status == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

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
					   var r = data.split('~');
					   $('#drpMobcode').html(r[0]);
				   }
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
	
	var age_date = $('#dob').val();
	var date = age_date.split('-');
	var this_year = new Date().getFullYear()
	if($('#Rdgenderm').is(":checked"))
	{
		if((parseInt(this_year-date[2]))<21)
		{
			alert("Age should be 21 years");
			$('#dob').css('border','1px solid red');
			return false;
		}
	}
	else if($('#Rdgenderf').is(":checked"))
	 {
		if((parseInt(this_year-date[2]))<18)
		{
			alert("Age should be 18 years");
			$('#dob').css('border','1px solid red');
			return false;
		}
	}
}
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
