<div  class="mid col-md-12 col-sm-12 col-xs-12">

<?php
	
$select_banner = "select * from advertise where adv_position = 'Search Top (954 X 100)' AND status = 'Active'";

$db_banner = $obj->select($select_banner);

if(count($db_banner) > 0) 

{

	if($db_banner[0]['banner_file'] != '') 

	{

		if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {

?>

<div style="margin: 0px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>

<?php } } } ?>

    <div id="tab-container">

                <ul class="msgtab">

                    <li><a id="rag" href="#searchtab-1">Simple Search</a></li>

                    <li><a id="adv" href="#searchtab-2">Advanced Search</a></li>

                    <?php /*?><li><a id="soul" href="#searchtab-3">Soulmate Search</a></li><?php */?>

                    <li><a id="key" href="#searchtab-3">Keyword Search</a></li>

                   <!-- <li><a id="online" href="#searchtab-4">Who's Online</a></li>-->

                    <li><a id="id" href="#searchtab-5">Search By ID</a></li>

                   

                </ul> 

                <div class="msgtab_content <?php if($_GET['flag'] == 'rag'){ echo "active"; } ?>" id="searchtab-1">

                    <p>Simple Search is the most popular search based on a few important criteria one would look for in a life partner. </p>

                    <div class="partner_search1">

                    <h2>Basic Search Criteria</h2>

                <form name="regular_search_form" id="regular_search_form" method="post" action="load_data.php">

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Gender</label>

                    <?php

                    $user2 = "select * from members where member_id = '".$_SESSION['logged_user'][0]['member_id']."' AND Status = 'Active'";

					$db_user2 = $obj->select($user2); ?>

                    <?php if($_SESSION['logged_user'][0]['member_id'] != '' ){ ?>

                    <label class="radio1"><input class="form-control" type="radio" id="regular_rdGender" name="Search_rdGender" value="M"<?php if($db_user2['0']['gender'] == 'F'){ ?> checked="checked"<?php } ?>/>Male</label>

                    <label class="radio1"><input class="form-control" type="radio" id="regular_rdGender" name="Search_rdGender" value="F" <?php if($db_user2['0']['gender'] == 'M'){ ?> checked="checked"<?php } ?> />Female</label>

                    <?php }else{ ?>

                    <label class="radio1"><input class="form-control" type="radio" id="regular_rdGender" name="Search_rdGender" value="M"/>Male</label>

                    <label class="radio1"><input class="form-control" type="radio" id="regular_rdGender" name="Search_rdGender" value="F" checked="checked"/>Female</label>

                    <?php } ?>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Age</label> 

                        <input class="form-control col-md-1 age1" type="text" name="Search_from_age" id="regular_from_age" onkeypress="return isNumber(event)" value="18" >

                            <span class="bet_text">to</span>

                        <input class="form-control col-md-1 age1 no-clear" type="text" name="Search_to_age" onkeypress="return isNumber(event)" id="regular_to_age" value="40" ><span class="bet_text">years</span>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Height</label>

                    <select name="Search_from_drpHeight" style="width:175px;">                       

                       		<?php 

							$select_height="select * from height";

							$db_height=$obj->select($select_height);

							for($i=0;$i<count($db_height);$i++){

							?>

                           <option value="<?php echo $db_height[$i]['Id']; ?>" <?php if($i==0) { ?> selected="selected"<?php } ?>><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>

                           <?php } ?>

                    </select>

                    <span class="bet_text">to</span>

                    <select name="Search_to_drpHeight" style="width:175px;">

                       

                       		<?php 

							$select_height="select * from height";

							$db_height=$obj->select($select_height);

							for($i=0;$i<count($db_height);$i++){

							?>

                           <option value="<?php echo $db_height[$i]['Id']; ?>" <?php if($i==(count($db_height)-1)) { ?> selected="selected"<?php } ?>><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>

                           <?php } ?>

                    </select>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                        <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Marital Status</label>

                        <label class="checkbox1"><input class="form-control" type="checkbox" name="Search_chk_marital_status[]" id="regular_chk_marital_status" value="Unmarried"/>Unmarried</label>

                        <label class="checkbox1"><input class="form-control" type="checkbox" name="Search_chk_marital_status[]" id="regular_chk_marital_status" value="Widowed"/>Widow</label>

                        <label class="checkbox1"><input class="form-control" type="checkbox" name="Search_chk_marital_status[]" id="regular_chk_marital_status" value="Divorced"/>Divorced</label>

                        <!--<label class="checkbox1"><input class="form-control" type="checkbox" name="Search_chk_marital_status[]" id="regular_chk_marital_status" value="Awaiting divorce"/>Awaiting divorce</label>-->

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                            <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Mother Tongue</label>

                            <select name="Search_drpMotherTongue[]" id="regular_drpMotherTongue" >

                            <option value="">Any</option>

                                <?php

                            $lang_list="select * from mother_tongues";

                            $languages=$obj->select($lang_list);

                            foreach($languages as $lang)

                            { ?>

                                <option value="<?php echo $lang['name']; ?>"><?php echo $lang['name']; ?></option>

                        <?php } ?>

                            </select>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Religion</label>

                    <select name="Search_drpReligion" id="regular_drpReligion" onchange="change_religion(this.value,1);">

                        <option value="">Any</option>

                        <?php

                            $religion_list="select * from religions";

                            $religion=$obj->select($religion_list);

                            foreach($religion as $rel)

                            { ?>

                                <option value="<?php echo $rel['religion']; ?>"><?php echo $rel['religion']; ?></option>

                        <?php } ?>

                    </select>

                    </div>                            

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Caste</label>

                    <div id="caste_drp_div">

                    <select name="drpCaste" id="regular_drpCaste" >

                    <option value="">Any</option>

                                <?php

                            $caste_list="select * from caste order by religion_id";

                            $caste=$obj->select($caste_list);

                            foreach($caste as $c)

                            { ?>

                                <option value="<?php echo $c['caste']; ?>"><?php echo $c['caste']; ?></option>

                        <?php } ?>

                    </select>

                    </div>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Country</label>

                     <select name="Search_drpCountry" id="regular_drpCountry" >

                     <option value="">Any</option>

                                <?php

                            $country_list="select * from mobile_codes";

                            $country=$obj->select($country_list);

                            foreach($country as $cnt)

                            { ?>

                                <option value="<?php echo $cnt['country']; ?>"><?php echo $cnt['country']; ?></option>

                        <?php } ?>

                            </select>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Education</label>

                    

                    <select id="regular_drpEducation" name="Search_drpEducation[]">

                    		<option value="">Any</option>

							<?php

                            $level="SELECT * FROM `education_details`";

                            

	                        $sel=$obj->select($level);

                            for($i=0;$i<count($sel);$i++)

                            {

                             ?>

								<option value="<?php echo $sel[$i]['id'];?>"><?php echo $sel[$i]['degree']; ?></option>

							<?php } ?>

                               <?php /*?> <?php

                            $education_list="select * from education_details";

                            $education=$obj->select($education_list);

                            foreach($education as $edu)

                            { ?>

                                <option value="<?php echo $edu['degree']; ?>"><?php echo $edu['degree']; ?></option>

                        <?php } ?><?php */?>

                            </select>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Show Profile</label>

                    <label class="checkbox1"><input class="form-control" type="checkbox" name="chk_with_photo" value="1" />With Photo</label>

                    <label class="checkbox1"><input class="form-control" type="checkbox" name="chk_with_horoscope" value="1" />With Horoscope</label>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">&nbsp;</label>

                    <input type="submit" class="btn btn-danger" name="regular_search" id="regular_search" value="Search" />

                    <?php if($_SESSION['logged_user'][0]['id']!=''){ ?>

                    <a class="inline save_and_search regular_search saved_search_new1 btn btn-danger" href="#save_search_div">Save &amp; Search</a>

                    <input class="form-control" type="hidden" name="regular_search_save" id="regular_search_save" value="" />

                    <?php } ?>

                    </div>

                    

                    <div style='display:none'>

                        <div id='save_search_div' style='padding:10px; background:#fff;'>

                                <div class="new_acc">           

                                     <div class="left">

                                        <label>Search Lable</label>

                                        <input class="form-control" type="text" value="" id="Search_lable" name="Search_lable">

                                     </div>

                                     <input type="submit" class="btn btn-danger" name="regular_search_save_popup" onclick=" return regular_search_submit()" />

                                </div>            

                        </div>

                    </div>

                </form>    

            </div>          

                </div>

                <div class="msgtab_content  <?php if($_GET['flag'] == 'adv'){ echo "class='active'"; } ?>" id="searchtab-2">

                    <p>Advanced Search is the most comprehensive search that searches across all profile information.<br />

The results of this search will be closer to your expectations. </p>

                    <div class="partner_search1">

                    <h2>Advanced Search Criteria</h2>

                <form name="advanced_search_form" id="advanced_search_form" method="post" action="load_data.php">

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Gender</label>

                    <?php if($_SESSION['logged_user'][0]['member_id'] != '' ){ ?>

                     <label class="radio1"><input class="form-control" type="radio" id="advanced_rdGender" name="Search_rdGender" value="M" <?php if($db_user2['0']['gender'] == 'F'){ ?> checked="checked"<?php } ?> />Male</label>

                    <label class="radio1"><input class="form-control" type="radio" id="advanced_rdGender" name="Search_rdGender" value="F" <?php if($db_user2['0']['gender'] == 'M'){ ?> checked="checked"<?php } ?> />Female</label>

                    <?php }else { ?>

                    <label class="radio1"><input class="form-control" type="radio" id="advanced_rdGender" name="Search_rdGender" value="M" />Male</label>

                    <label class="radio1"><input class="form-control" type="radio" id="advanced_rdGender" name="Search_rdGender" value="F" checked="checked" />Female</label>

                    <?php } ?>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Age</label>

                        <input class="form-control age1 col-md-1" type="text" name="Search_from_age" id="advanced_from_age" onkeypress="return isNumber(event)" value="18" >

                            <span class="bet_text">to</span>

<input class="form-control age1 no-clear col-md-1" type="text" name="Search_to_age" id="advanced_to_age" onkeypress="return isNumber(event)" value="40" ><span class="bet_text">years</span>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Height</label>

                    <select name="Search_from_drpHeight" style="width:175px;">                      

                       		<?php 

							$select_height="select * from height";

							$db_height=$obj->select($select_height);

							for($i=0;$i<count($db_height);$i++){

							?>

                           <option value="<?php echo $db_height[$i]['Id']; ?>" <?php if($i==0) { ?> selected="selected"<?php } ?>><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>

                           <?php } ?>

                    </select>

                    <span class="bet_text">to</span>

                    <select name="Search_to_drpHeight" style="width:175px;">

                       <option value="">- Feet/Inches -</option>

                       		<?php 

							$select_height="select * from height";

							$db_height=$obj->select($select_height);

							for($i=0;$i<count($db_height);$i++){

							?>

                           <option value="<?php echo $db_height[$i]['Id']; ?>" <?php if($i==(count($db_height)-1)) { ?> selected="selected"<?php } ?>><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>

                           <?php } ?>

                    </select>

                    

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                        <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Marital Status</label>

           

    <label class="checkbox1"><input class="form-control" type="checkbox" name="Search_chk_marital_status[]" id="advanced_chk_marital_status" value="Unmarried"/>Unmarried</label>

    <label class="checkbox1"><input class="form-control" type="checkbox" name="Search_chk_marital_status[]" id="advanced_chk_marital_status" value="Widowed"/>Widow</label>

    <label class="checkbox1"><input class="form-control" type="checkbox" name="Search_chk_marital_status[]" id="advanced_chk_marital_status" value="Divorced"/>Divorced</label>  <!--<label class="checkbox1"><input class="form-control" type="checkbox" name="Search_chk_marital_status[]" id="advanced_chk_marital_status" value="Awaiting divorce"/>Awaiting divorce</label>-->

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                            <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Mother Tongue</label>

                            <select name="Search_drpMotherTongue[]" id="advanced_drpMotherTongue" >

                            <option value="">-Any-</option>

                                <?php

                            $lang_list="select * from mother_tongues";

                            $languages=$obj->select($lang_list);

                            foreach($languages as $lang)

                            { ?>

                                <option value="<?php echo $lang['name']; ?>"><?php echo $lang['name']; ?></option>

                        <?php } ?>

                            </select>

                    </div>   

                     <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Religion</label>

                    <select name="Search_drpReligion" id="advanced_drpReligion" onchange="change_religion(this.value,2);">

                        <option value="">-Any-</option>

                        <?php

                            $religion_list="select * from religions";

                            $religion=$obj->select($religion_list);

                            foreach($religion as $rel)

                            { ?>

                                <option value="<?php echo $rel['religion']; ?>"><?php echo $rel['religion']; ?></option>

                        <?php } ?>

                    </select>

                    </div>                         

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Caste</label>

                   <div id="drp_adv_caste">

                    <select name="Search_drpCaste" id="advanced_drpCaste" >

                    <option value="">-Any-</option>

                                <?php

                            $caste_list="select * from caste order by religion_id";

                            $caste=$obj->select($caste_list);

                            foreach($caste as $c)

                            { ?>

                                <option value="<?php echo $c['caste']; ?>"><?php echo $c['caste']; ?></option>

                        <?php } ?>

                            </select>

                    </div>

                    </div>

                   <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Country</label>

                     <select name="Search_drpCountry" id="advanced_drpCountry" >

                     <option value="">-Any-</option>

                                <?php

                            $country_list="select * from mobile_codes";

                            $country=$obj->select($country_list);

                            foreach($country as $cnt)

                            { ?>

                                <option value="<?php echo $cnt['country']; ?>"><?php echo $cnt['country']; ?></option>

                        <?php } ?>

                            </select>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Education</label>

                    

                    <select id="advanced_drpEducation" name="Search_drpEducation[]">

                    	<option value="">Any</option>

							<?php

                            $level="SELECT * FROM `education_details`";

                            

	                        $sel=$obj->select($level);

                            for($i=0;$i<count($sel);$i++)

                            {

                             ?>

								<option value="<?php echo $sel[$i]['id'];?>"><?php echo $sel[$i]['degree']; ?></option>

							<?php } ?>

                            <?php /*?><?php

                            $education_list="select * from education_details";

                            $education=$obj->select($education_list);

                            foreach($education as $edu)

                            { ?>

                                <option value="<?php echo $edu['degree']; ?>"><?php echo $edu['degree']; ?></option>

                        <?php } ?><?php */?>

                            </select> 

                    </div>

                    

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Occupation</label>

                    <select name="advanced_drpOccupation" id="advanced_drpOccupation" >

                        <option value="">-Any-</option>

                        <?php

                            $occu_list="select * from occupation_master";

                            $occupation=$obj->select($occu_list);

                            foreach($occupation as $occup)

                            { ?> 

                                <option value="<?php echo $occup['occupation']; ?>"><?php echo $occup['occupation']; ?></option>

                        <?php } ?>

                            </select>

                    </div>

                    

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Annual Income</label>

                       <?php /*?><select name="advanced_drpIncome" id="advanced_drpIncome" >

                        <option value="">-Any-</option>

                        <?php

                            $income_list="select * from annual_income_master";

                            $income=$obj->select($income_list);

                            foreach($income as $inc)

                            { ?>

                                <option value="<?php echo $inc['annual_income']; ?>"><?php echo $inc['annual_income']; ?></option>

                        <?php } ?>

                      </select><?php */?>

                      <input class="form-control" type="text" name="advanced_drpIncome" id="advanced_drpIncome" value="" style="width:350px;" />

                    </div>

                    <h2>Horoscope</h2>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Star</label>

                        <select name="advanced_drpStar" id="advanced_drpStar" >

                        <option value="">-Any-</option>

                        <?php

                            $star_list="select * from horoscope_star_master";

                            $star=$obj->select($star_list);

                            foreach($star as $st)

                            { ?>

                                <option value="<?php echo $st['star']; ?>"><?php echo $st['star']; ?></option>

                        <?php } ?>

                      </select> 

                    </div>

                   

                   <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Manglik</label>

                        <label class="radio1"><input class="form-control" type="radio" id="advanced_rdManglik" name="advanced_rdManglik" value="Y" />Yes</label>

                       <label class="radio1"><input class="form-control" type="radio" id="advanced_rdManglik" name="advanced_rdManglik" value="N" />No</label>

                       <label class="radio1"><input class="form-control" type="radio" id="advanced_rdManglik" name="advanced_rdManglik" value="Any" />Doesn't matter</label>

                    </div>

                    

                    

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Show Profile</label>

                    <label class="checkbox1"><input class="form-control" type="checkbox" name="chk_with_photo" value="1" />With Photo</label>

                    <label class="checkbox1"><input class="form-control" type="checkbox" name="chk_with_horoscope" value="1" />With Horoscope</label>

                    </div>

                    

                    <h2>Mutual Interest</h2>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <?php

                        $interest_list="select * from interest";

                        $interest=$obj->select($interest_list);

                        ?>

                             <?php

                        

                        foreach($interest as $int)

                        { ?>

                            <label class="checkbox1" style="width:220px;"> 

                            <input class="form-control" type="checkbox" id="soulmate_chkInterest[]" name="soulmate_chkInterest[]" value="<?php echo $int['id']; ?>" />	<?php echo $int['name'];  ?>				

							</label>

                           

                          

                       <?php } ?>

                    </div>

                    

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">&nbsp;</label>

                    <input type="submit" name="advanced_search" id="advanced_search" class="advanced_search search_new1 btn btn-danger" value="Search" />

                    <?php if($_SESSION['logged_user'][0]['id']!=''){ ?>

                    <a class="inline save_and_search advanced_search saved_search_new1 btn btn-danger" href="#save_search_adv_div">Save & Search</a>

                    <input class="form-control" type="hidden" name="regular_search_save" id="advanced_search_save" value="" />

                    <?php } ?>

                    </div>

                    

                    <div style='display:none'>

                        <div id='save_search_adv_div' style='padding:10px; background:#fff;'>

                                <div class="new_acc">           

                                     <div class="left">

                                        <label>Search Lable</label>

                                        <input class="form-control" type="text" value="" id="Adv_Search_lable" name="Adv_Search_lable">

                                     </div>

                                     <input type="submit" class="btn btn-danger" name="advanced_search_save_save_popup" onclick="advanced_search_save_submit()" />

                                </div>            

                        </div>

                    </div>

                </form>    

            </div>          

                </div>

                <div class="msgtab_content <?php if($_GET['f'] == 'soul'){ echo "class='active'"; } ?>" id="searchtab-41" style="display:none">

            <p>Soulmate Search is the most popular search based on a few important criteria one would look for in a life partner. </p>

                 <!--<div class="partner_search1">

                    <h2>Soulmate Search Criteria</h2>

                <form name="soulmate_search" id="soulmate_search" method="post" action="load_data.php">

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Gender</label>

                    <label class="radio1"><input class="form-control" type="radio" id="soulmate_rdGender" name="soulmate_rdGender" value="M" checked />Male</label>

                    <label class="radio1"><input class="form-control" type="radio" id="soulmate_rdGender" name="soulmate_rdGender" value="F" />Female</label>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Age</label>

                        <input class="form-control" type="text" class="age1" name="soulmate_from_age" id="soulmate_from_age" >

                            <span class="bet_text">to</span>

                        <input class="form-control" type="text" class="age1 no-clear" name="soulmate_to_age" id="soulmate_to_age" ><span class="bet_text">years</span>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Height</label>

                    <select name="soul_drpHeight" style="width:175px;">

                       <option value="">- Feet/Inches -</option>

                           <option value="4-6">4ft 6in</option>

                           <option value="4-7">4ft 7in</option>

                           <option value="4-8">4ft 8in</option>

                           <option value="4-9">4ft 9in</option>

                           <option value="4-10">4ft 10in</option>

                           <option value="4-11">4ft 11in</option>

                           <option value="5">5ft</option>

                           <option value="5-1">5ft 1in</option>

                           <option value="5-2">5ft 2in</option>

                           <option value="5-3">5ft 3in</option>

                           <option value="5-4">5ft 4in</option>

                           <option value="5-5">5ft 5in</option>

                           <option value="5-6">5ft 6in</option>

                           <option value="5-7">5ft 7in</option>

                           <option value="5-8">5ft 8in</option>

                           <option value="5-9">5ft 9in</option>

                           <option value="5-10">5ft 10in</option>

                           <option value="5-11">5ft 11in</option>

                           <option value="6">6ft</option>

                           <option value="6-1">6ft 1in</option>

                           <option value="6-2">6ft 2in</option>

                           <option value="6-3">6ft 3in</option>

                           <option value="6-4">6ft 4in</option>

                           <option value="6-5">6ft 5in</option>

                           <option value="6-6">6ft 6in</option>

                           <option value="6-7">6ft 7in</option>

                           <option value="6-8">6ft 8in</option>

                           <option value="6-9">6ft 9in</option>

                           <option value="6-10">6ft 10in</option>

                           <option value="6-11">6ft 11in</option>

                           <option value="7">7ft</option>

                    </select>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                        <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Marital Status</label>

                    

                        <label class="checkbox1"><input class="form-control" type="checkbox" name="soulmate_chk_marital_status[]" id="soulmate_chk_marital_status" value="Unmarried"/>Unmarried</label>

                        <label class="checkbox1"><input class="form-control" type="checkbox" name="soulmate_chk_marital_status[]" id="soulmate_chk_marital_status" value="Widow"/>Widow</label>

                        <label class="checkbox1"><input class="form-control" type="checkbox" name="soulmate_chk_marital_status[]" id="soulmate_chk_marital_status" value="Divorced"/>Divorced</label>

                        <label class="checkbox1"><input class="form-control" type="checkbox" name="soulmate_chk_marital_status[]" id="soulmate_chk_marital_status" value="Awaiting divorce"/>Awaiting divorce</label>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Religion</label>

                    <select name="soulmate_drpReligion" id="soulmate_drpReligion" >

                        <option value="">-Any-</option>

                        <?php

                            $religion_list="select * from religions";

                            $religion=$obj->select($religion_list);

                            foreach($religion as $rel)

                            { ?>

                                <option value="<?php echo $rel['religion']; ?>"><?php echo $rel['religion']; ?></option>

                        <?php } ?>

                    </select>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                            <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Mother Tongue</label>

                            <select name="soulmate_drpMotherTongue" id="soulmate_drpMotherTongue" >

                            <option value="">-Any-</option>

                                <?php

                            $lang_list="select * from mother_tongues";

                            $languages=$obj->select($lang_list);

                            foreach($languages as $lang)

                            { ?>

                                <option value="<?php echo $lang['name']; ?>"><?php echo $lang['name']; ?></option>

                        <?php } ?>

                            </select>

                    </div>                            

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Caste</label>

                    <select name="soulmate_drpCaste" id="soulmate_drpCaste" >

                    <option value="">-Any-</option>

                                <?php

                            $caste_list="select * from caste order by religion_id";

                            $caste=$obj->select($caste_list);

                            foreach($caste as $c)

                            { ?>

                                <option value="<?php echo $c['caste']; ?>"><?php echo $c['caste']; ?></option>

                        <?php } ?>

                            </select>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Country</label>

                     <select name="soulmate_drpCountry" id="soulmate_drpCountry" >

                     <option value="">-Any-</option>

                                <?php

                            $country_list="select * from mobile_codes";

                            $country=$obj->select($country_list);

                            foreach($country as $cnt)

                            { ?>

                                <option value="<?php echo $cnt['country']; ?>"><?php echo $cnt['country']; ?></option>

                        <?php } ?>

                            </select>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Education</label>

                    

                    <select id="soulmate_drpEducation" name="soulmate_drpEducation">

                    <option value="Any">Any</option>

                                <?php

                            $education_list="select * from education_details";

                            $education=$obj->select($education_list);

                            foreach($education as $edu)

                            { ?>

                                <option value="<?php echo $edu['degree']; ?>"><?php echo $edu['degree']; ?></option>

                        <?php } ?>

                            </select>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">       

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Mutual Interest</label>

                    

                     <?php

                        $interest_list="select * from interest";

                        $interest=$obj->select($interest_list);

                        ?>

                             <div class="list-chkbox">      								

                             <?php

                        

                        foreach($interest as $int)

                        { ?>

                            <label class="checkbox1"> 

                            <input class="form-control" type="checkbox" id="soulmate_chkInterest[]" name="soulmate_chkInterest[]" value="<?php echo $int['id']; ?>" />	<?php echo $int['name'];  ?>				

                         </label>

                           

                          

                       <?php } ?>

                         </div>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Show Profile</label>

                    <label class="checkbox1"><input class="form-control" type="checkbox" name="chk_with_photo" value="1" />With Photo</label>

                    <label class="checkbox1"><input class="form-control" type="checkbox" name="chk_with_horoscope" value="1" />With Horoscope</label>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">&nbsp;</label>

                    <input type="submit" class="btn btn-danger" name="soulmate_search" id="soulmate_search" />

                    </div>

                </form>

            </div>-->

            </div>

                <div class="msgtab_content <?php if($_GET['flag'] == 'key'){ echo "class='active'"; } ?>" id="searchtab-3">

            <p>Keyword Search is the most popular search based on a few important criteria one would look for in a life partner. </p>

                    <div class="partner_search1">

                    <h2>Keyword Search</h2>

                <form name="keyword_search" id="keyword_search" method="post" action="load_data.php">

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                        <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Enter Keyword</label>

                        <input class="form-control" type="text" name="txtKeyword" id="txtKeyword" onkeypress="return IsAlphaNumeric(event);" ondrop="return false;"

        onpaste="return false;" />

                         

                        <span id="err_keyword" class="err_msg" style="margin-left:150px;">Enter valid keyword</span>

                        <span id="err_key" style="color:red; padding-left:6px;"></span>

                    </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <?php

                    $user4 = "select * from members where member_id = '".$_SESSION['logged_user'][0]['member_id']."' AND Status = 'Active'";

					$db_user5 = $obj->select($user4); ?>

                        <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Show Profile</label>

                       <?php if($_SESSION['logged_user'][0]['member_id'] != '' ){ 

					   if($db_user5[0]['gender'] =='F'){

					   ?>

                    <label class="radio1"><input class="form-control" type="hidden" id="regular_rdGender" name="Search_rdGender" value="M"<?php if($db_user5['0']['gender'] == 'F'){ ?> checked="checked"<?php } ?>/></label><?php }else { ?>

                    <label class="radio1"><input class="form-control" type="hidden" id="regular_rdGender" name="Search_rdGender" value="F" <?php if($db_user5['0']['gender'] == 'M'){ ?> checked="checked"<?php } ?> /></label>

                        <?php }} ?>

                        <label class="checkbox1"><input class="form-control" type="checkbox" name="chk_with_photo" value="1" />With Photo</label>

                        <label class="checkbox1"><input class="form-control" type="checkbox" name="chk_with_horoscope" value="1" />With Horoscope</label>

                        </div>

                    <div class="search-row col-md-12 col-xs-12 col-sm-12">

                    <label class="col-md-2 col-sm-4 col-xs-12 nopadding">&nbsp;</label>

<input type="submit" class="btn btn-danger keyword_search search_new1 btn btn-danger" name="keyword_search" id="keyword_search" value="Search" onclick="return validate1111();" />

                    <?php if($_SESSION['logged_user'][0]['id']!=''){ ?>

                    <a class="inline save_and_search keyword_search saved_search_new1 btn btn-danger" href="#save_search_key_div">Save & Search</a>

                    <input class="form-control" type="hidden" name="regular_search_save" id="keyword_search_save" value="" />

                    <?php } ?>

                    </div>

                    

                    <div style='display:none'>

                        <div id='save_search_key_div' style='padding:10px; background:#fff;'>

                                <div class="new_acc">           

                                     <div class="left">

                                        <label>Search Lable</label>

                                        <input class="form-control" type="text" value="" id="keyword_search_lable" name="keyword_search_lable">

                                     </div>

                                     <input type="submit" class="btn btn-danger" name="keyword_search_save_save_popup" onclick=" return keyword_search_save_submit()" />

                                </div>            

                        </div>

                    </div>

                </form>

            </div>

            </div>

            

            <?php /*?><div class="msgtab_content" id="searchtab-4">

                    <!--<p>Who's Online is the most popular search based on a online memb. </p>-->

                    <div class="partner_search1">

    	                <h2>Who's Online</h2>

                        <form name="who_online_form" id="who_online_form" method="post" action="search_list.php">

                            <div class="search-row col-md-12 col-xs-12 col-sm-12">

                            <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Search By</label>

                            <label class="radio1"><input class="form-control" type="radio" id="who_online" name="who_online" value="1" checked />Online Member</label>

                            <label class="radio1"><input class="form-control" type="radio" id="who_online" name="who_online" value="0" />Offline Member</label>

                            </div>

                            

                            

                            <div class="search-row col-md-12 col-xs-12 col-sm-12">

                            <label class="col-md-2 col-sm-4 col-xs-12 nopadding">&nbsp;</label>

                            <input type="submit" class="btn btn-danger" name="who_online_search" id="who_online_search" class="search_new1" value="Search" />

                            </div>

                        </form>    

		            </div>          

                </div><?php */?>

                

                <div class="msgtab_content" id="searchtab-5">

                    <!--<p>Who's Online is the most popular search based on a online memb. </p>-->

                    <div class="partner_search1">

    	                <h2>Search By ID</h2>

                        <form name="by_id_form" id="by_id_form" method="post" action="load_data.php">

                            <div class="search-row col-md-12 col-xs-12 col-sm-12">

                            <label class="col-md-2 col-sm-4 col-xs-12 nopadding">Member ID</label>

                            <input class="form-control" type="text" name="txt_by_id" id="txt_by_id" />

                             <span id="err_id" class="err_msg" style="margin-left:150px;">Enter valid Member ID</span>

                            </div>

                            

                            

                            <div class="search-row col-md-12 col-xs-12 col-sm-12">

                            <label class="col-md-2 col-sm-4 col-xs-12 nopadding">&nbsp;</label>

                            <input type="submit" class="btn btn-danger by_id_form search_new1" name="search_by_id" id="search_by_id" value="Search" />

                            </div>

                        </form>    

		            </div>          

                </div>

                

                

            

            

                

            </div>

<?php

$select_banner = "select * from advertise where adv_position = 'Search Bottom (954 X 100)' AND status = 'Active'";

$db_banner = $obj->select($select_banner);

if(count($db_banner) > 0) 

{

	if($db_banner[0]['banner_file'] != '') 

	{

		if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {

?>

<div style="margin: 10px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>

<?php } } }  ?>

</div>

        

<script>

$(".by_id_form").click(function(){ 

	$('#txt_by_id').css('border','1px solid #ccc');

	

	var len=document.getElementById('txt_by_id').value;

	if(document.getElementById('txt_by_id').value =='' || len.length>10)

	{

		$('#txt_by_id').css('border','1px solid red');

		$('#err_id').css('visibility','visible');

		txtKeyword=1

	}

	else

	{

		txtKeyword=0

		$('#err_id').css('visibility','hidden');

	}

	

	if(txtKeyword==0)

		return true;

	else

		return false;

	

	

});

$(".keyword_search").click(function(){ 

	var keyw=$('#txtKeyword').val();

	document.getElementById('keyword_search_save').value=document.getElementById('keyword_search_lable').value;

	if(document.getElementById('txtKeyword').value =='' || keyw.length>10)

	{

		$('#txtKeyword').css('border','1px solid red');

		$('#err_keyword').css('visibility','visible');

		txtKeyword=1;

	}

	else

	{

		txtKeyword=0;

	}

	if(txtKeyword==0)

		return true;

	else

		return false;

	

	

});

$(".regular_search").click(function(){ 

	$('#regular_from_age').css('border','1px solid #ccc');

	$('#regular_to_age').css('border','1px solid #ccc');

	$('#regular_drpReligion').css('border','1px solid #ccc');

	$('#regular_drpMotherTongue').css('border','1px solid #ccc');

	$('#regular_drpCaste').css('border','1px solid #ccc');

	$('#regular_drpCountry').css('border','1px solid #ccc');

	document.getElementById('regular_search_save').value=document.getElementById('Search_lable').value;

	

	var fage=$('#regular_from_age').val();

	var tage=$('#regular_to_age').val();

	

	

	if(document.getElementById('regular_from_age').value =='' || fage.length>3)

	{

		$('#regular_from_age').css('border','1px solid red');

		regular_from_age=1

	}

	else

	{

		regular_from_age=0

	}

	if(document.getElementById('regular_to_age').value =='' || tage.length>3)

	{

		$('#regular_to_age').css('border','1px solid red');

		regular_to_age=1

	}

	else

	{

		regular_to_age=0

	}

	$(window).scrollTop(0);

	if(regular_from_age==0 && regular_to_age==0)

		return true;

	else

		return false;

	//}

});

$(".advanced_search").click(function(){

	

	$('#advanced_from_age').css('border','1px solid #ccc');

	$('#advanced_to_age').css('border','1px solid #ccc');

	var fage=$('#advanced_from_age').val();

	var tage=$('#advanced_to_age').val();

	document.getElementById('advanced_search_save').value=document.getElementById('Adv_Search_lable').value;

	 

	if(document.getElementById('advanced_from_age').value =='' || fage.length>3 )

	{

		$('#advanced_from_age').css('border','1px solid red');		

		advanced_from_age=1

	}

	else

	{

		advanced_from_age=0

	}

	if(document.getElementById('advanced_to_age').value=='' || tage.length>3)

	{

		

		$('#advanced_to_age').css('border','1px solid red');

		advanced_to_age=1

	}

	else

	{

		advanced_to_age=0

	}

	

		

	$(window).scrollTop(0);

	if(advanced_from_age==0 && advanced_to_age==0)

		return true;

	else

		return false;

	

	//}

});

$("#soulmate_search").click(function(){ 

	$('#soulmate_from_age').css('border','1px solid #ccc');

	$('#soulmate_to_age').css('border','1px solid #ccc');

	

	if(document.getElementById('soulmate_from_age').value =='')

	{

		$('#soulmate_from_age').css('border','1px solid red');

		soulmate_from_age=1

	}

	else

	{

		soulmate_from_age=0

	}

	if(document.getElementById('soulmate_to_age').value=='')

	{

		$('#soulmate_to_age').css('border','1px solid red');

		soulmate_to_age=1

	}

	else

	{

		soulmate_to_age=0

	}

	

	

	if(soulmate_from_age==0 && soulmate_to_age==0)

		return true;

	else

		return false;

	//}

});

 

function validate1111()

{

		var keycode = $('#txtKeyword').val();

		if(keycode == '')

		{

			$('#err_key').html('Enter Keyword').fadeIn();

			return false;

		}

		return true;

 }

</script> 



<script type="text/javascript">

        var specialKeys = new Array();

        specialKeys.push(8); //Backspace

        specialKeys.push(9); //Tab

        specialKeys.push(46); //Delete

        specialKeys.push(36); //Home

        specialKeys.push(35); //End

        specialKeys.push(37); //Left

        specialKeys.push(39); //Right



function IsAlphaNumeric(e) {

            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;

            var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode==32) || (keyCode==190) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));

            return ret;

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

        