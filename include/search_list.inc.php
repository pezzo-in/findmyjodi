<?php
$withphoto=0;
$horoscope1 = 0;
$unmarrid = 0;
$widow = 0;
$divorced = 0;
$aw_divorced = 0;
$my_self = 0;
$daughter = 0;
$son = 0;
$brother = 0;
$sister = 0;
$relative = 0;
$friend = 0;
if(isset($_POST['send_msg']))
{
	$dt=date('Y-m-d h:i:s');
 $insert="INSERT into messages(id, from_mem,to_mem,message, parent_id, is_replied, interested, is_read, send_date)values(NULL,'".$_POST['from_member_id']."','".$_POST['to_member_id']."','".$_POST['message']."', '1', 'N', 'Y', '0', '".$dt."')";
 $db_ins=$obj->insert($insert);
 
 $update_mob_counter = "update members set num_send_msg='".($_POST['num_send_msg']+1)."' where member_id='".$_SESSION['logged_user'][0]['member_id']."'"; 
$obj->edit($update_mob_counter);
	echo "<script> window.location.href = 'search_list.php?flag=msg_sent' </script>";
}
$conditions = "1=1 AND members.status = 'Active'";
$right_join = '';
if(!empty($_POST['Search_rdGender']) || $search_coockie_data['Search_rdGender']!='')
{
	if(isset($_POST['Search_rdGender']))
		$gender=$_POST['Search_rdGender'];
	else if($search_coockie_data['Search_rdGender']!='')
		$gender=$search_coockie_data['Search_rdGender'];
		
	$conditions .= " AND gender = '".$gender."'";
}
if((!empty($_POST['Search_from_age']) && !empty($_POST['Search_to_age'])) || ($search_coockie_data['Search_from_age']!='' && $search_coockie_data['Search_to_age']!=''))
{
	if(isset($_POST['Search_from_age']) && isset($_POST['Search_to_age']))
	{
		$from_age=$_POST['Search_from_age'];
		$to_age=$_POST['Search_to_age'];
	}
	else if($search_coockie_data['Search_from_age']!='' && $search_coockie_data['Search_to_age']!='')
	{
		$from_age=$search_coockie_data['Search_from_age'];
		$to_age=$search_coockie_data['Search_to_age'];
	}
	
	$conditions .= ' AND (age between ' .$from_age." and ".$to_age.")";
}
if((!empty($_POST['Search_from_drpHeight']) && !empty($_POST['Search_to_drpHeight'])) || ($search_coockie_data['Search_from_drpHeight']!='' && $search_coockie_data['Search_to_drpHeight']!=''))
{
	if(isset($_POST['Search_from_drpHeight']) && isset($_POST['Search_to_drpHeight']))
	{
		$from_height=$_POST['Search_from_drpHeight'];
		$to_height=$_POST['Search_to_drpHeight'];
	}
	else if($search_coockie_data['Search_from_drpHeight']!='' && $search_coockie_data['Search_to_drpHeight']!='')
	{
		$from_height=$search_coockie_data['Search_from_drpHeight'];
		$to_height=$search_coockie_data['Search_to_drpHeight'];
	}
	
	$height_from="select * from height where Id='".$from_height."'";
	$db_height_from=$obj->select($height_from);
	
	$height_to="select * from height where Id='".$to_height."'";
	$db_height_to=$obj->select($height_to);
	
	$conditions .= ' AND (height between '.$from_height.' AND '.$to_height.')';
	
	
	$right_join .= ' RIGHT JOIN height on members.height=height.Id';
	
}
if(count($_POST['Search_chk_marital_status'])>0 || count($search_coockie_data['Search_chk_marital_status'])>0)
{
	if(count($_POST['Search_chk_marital_status'])>0)
		$marital_status=$_POST['Search_chk_marital_status'];
	else if(count($search_coockie_data['Search_chk_marital_status'])>0)
		$marital_status=$search_coockie_data['Search_chk_marital_status'];
	$j=0;
	for($k=0;$k<count($marital_status);$k++)
	{
		
		if($marital_status[$k]!='Any')
		{
			if($k==0)
				$conditions .= " AND (relationship_status ='".$marital_status[$k]."'";
			else 
			{
				if($j==0)
				{
					$conditions .= " AND (relationship_status ='".$marital_status[$k]."'";
				}
				else
				{
					$conditions .=" OR relationship_status ='".$marital_status[$k]."'";
				}
			}
			$j++;
			
			if(count($marital_status)==($k+1))
				$conditions .= ")";
		}
	}	
}
if($_POST['Search_drpReligion']!='' || $search_coockie_data['Search_drpReligion']!='')
{
	if($_POST['Search_drpReligion']!='')
		$religion=$_POST['Search_drpReligion'];
	else if($search_coockie_data['Search_drpReligion']!='')
		$religion=$search_coockie_data['Search_drpReligion'];
		
	$conditions .= " AND religion = '".$religion."'";
}
if((count($_POST['Search_drpMotherTongue'])>0 && $_POST['Search_drpMotherTongue'][0]!='') || (count($search_coockie_data['Search_drpMotherTongue'])>0 && $search_coockie_data['Search_drpMotherTongue'][0]!=''))
{
	if((count($_POST['Search_drpMotherTongue'])>0 && $_POST['Search_drpMotherTongue'][0]!=''))
		$mother_tongue=$_POST['Search_drpMotherTongue'];
	else if((count($search_coockie_data['Search_drpMotherTongue'])>0 && $search_coockie_data['Search_drpMotherTongue'][0]!=''))
		$mother_tongue=$search_coockie_data['Search_drpMotherTongue'];
		
	for($k=0;$k<count($mother_tongue);$k++)
	{
		if($k==0)
			$conditions .= " AND (mother_tongue = '".$mother_tongue[$k]."'";
			else	
			$conditions .=" OR mother_tongue = '".$mother_tongue[$k]."'";
		
		if(count($mother_tongue)==($k+1))
			$conditions .= ")";
	}
}
if($_POST['Search_drpCaste']!='' || $search_coockie_data['Search_drpCaste']!='')
{
	if($_POST['Search_drpCaste']!='')
		$cast=$_POST['Search_drpCaste'];
	else if($search_coockie_data['Search_drpCaste']!='')
		$cast=$search_coockie_data['Search_drpCaste'];
		
	$conditions .= " AND caste = '".$cast."'";
}
if($_POST['Search_drpCountry']!='' || $search_coockie_data['Search_drpCountry']!='')
{
	if($_POST['Search_drpCountry']!='')
		$country=$_POST['Search_drpCountry'];
	else if($search_coockie_data['Search_drpCountry']!='')
		$country=$search_coockie_data['Search_drpCountry'];
		
	$conditions .= " and country = '".$country."'";
}
if((count($_POST['Search_drpEducation'])>0 && $_POST['Search_drpEducation'][0]!='') || (count($search_coockie_data['Search_drpEducation'])>0 && $search_coockie_data['Search_drpEducation'][0]!=''))
{
	if((count($_POST['Search_drpEducation'])>0 && $_POST['Search_drpEducation'][0]!=''))
		$education=$_POST['Search_drpEducation'];
	else if((count($search_coockie_data['Search_drpEducation'])>0 && $search_coockie_data['Search_drpEducation'][0]!=''))
		$education=$search_coockie_data['Search_drpEducation'];
	
	for($k=0;$k<count($education);$k++)
	{
		if($k==0)
			$conditions .= " AND (degree_in = '".$education[$k]."'";
		else	
			$conditions .=" OR degree_in = '".$education[$k]."'";
		
		if(count($education)==($k+1))
			$conditions .= ")";
	}
}
if(!empty($_POST['keyword_search']) || $search_coockie_data['keyword_search']!='')
{
	
	if(isset($_POST['txtKeyword']))
		$keyword=$_POST['txtKeyword'];
	else if($search_coockie_data['txtKeyword']!='')
		$keyword=$search_coockie_data['txtKeyword'];
		$sele_education = "select * from education_course where Title like '%".$keyword."%'";
		$db_select_edu = $obj->select($sele_education);
		if(count($db_select_edu)!=0)
		{ $conditions .= " AND (name like '%".$keyword."%' or  
					partner_prefrence like '%".$keyword."%' or  
					occupation like '%".$keyword."%' or 
					employed_in like '%".$keyword."%' or 
					subcaste like '%".$keyword."%' or  
					gothram like '%".$keyword."%' or  
					star like '%".$keyword."%' or
					horoscope_match like '%".$keyword."%' or
					height like '%".$keyword."%' or
					weight like '%".$keyword."%' or
					family_status like '%".$keyword."%' or
					family_type like '%".$keyword."%' or
					complexion like '%".$keyword."%' or
					hobbies like '%".$keyword."%' or
					place_of_birth like '%".$keyword."%' or
					city like '%".$keyword."%' or
					email_id like '%".$keyword."%' or
					relationship_status like '%".$keyword."%' or  
					religion like '%".$keyword."%' or  
					mother_tongue like '%".$keyword."%' or    
					caste like '%".$keyword."%' or 
					education = '".$db_select_edu[0]['Id']."' or
					country like '%".$keyword."%' or  
					Interest like '%".$keyword."%')"; }
	else {
		
	$conditions .= " AND (name like '%".$keyword."%' or  
					partner_prefrence like '%".$keyword."%' or  
					occupation like '%".$keyword."%' or 
					employed_in like '%".$keyword."%' or 
					subcaste like '%".$keyword."%' or  
					gothram like '%".$keyword."%' or  
					star like '%".$keyword."%' or
					horoscope_match like '%".$keyword."%' or
					height like '%".$keyword."%' or
					weight like '%".$keyword."%' or
					family_status like '%".$keyword."%' or
					family_type like '%".$keyword."%' or
					complexion like '%".$keyword."%' or
					hobbies like '%".$keyword."%' or
					place_of_birth like '%".$keyword."%' or
					city like '%".$keyword."%' or
					email_id like '%".$keyword."%' or
					relationship_status like '%".$keyword."%' or  
					religion like '%".$keyword."%' or  
					mother_tongue like '%".$keyword."%' or    
					caste like '%".$keyword."%' or  
					country like '%".$keyword."%' or  
					Interest like '%".$keyword."%')"; }
}

/*
	moonsign like '%".$keyword."%' or
	blood_group like '%".$keyword."%' or
	father_occupation like '%".$keyword."%' or
	mother_occupation like '%".$keyword."%' or
	family_origin like '%".$keyword."%' or
				
*/
if($_POST['advanced_drpOccupation'] != "" || $search_coockie_data['advanced_drpOccupation'] != "")
{
	if($_POST['advanced_drpOccupation'] != "" )
		$occupation=$_POST['advanced_drpOccupation'];
	else if($search_coockie_data['advanced_drpOccupation'] != "")
		$occupation=$search_coockie_data['advanced_drpOccupation'];
	
	$conditions .= " AND occupation = '".$occupation."'";		
}
if($_POST['advanced_drpIncome'] != "" || $search_coockie_data['advanced_drpIncome'] != "")
{
	if($_POST['advanced_drpIncome'] != "" )
		$income=$_POST['advanced_drpIncome'];
	else if($search_coockie_data['advanced_drpIncome'] != "")
		$income=$search_coockie_data['advanced_drpIncome'];
		
	$conditions .= " AND annual_income = '".$income."'";	
}
if($_POST['advanced_drpStar'] != "" || $search_coockie_data['advanced_drpStar'] != "")
{
	if($_POST['advanced_drpStar'] != "" )
		$star=$_POST['advanced_drpStar'];
	else if($search_coockie_data['advanced_drpStar'] != "")
		$star=$search_coockie_data['advanced_drpStar'];
		
	$conditions .= " AND star = '".$star."'";	
}
if(($_POST['advanced_rdManglik'] != "Any" && $_POST['advanced_rdManglik'] != '') || ($search_coockie_data['advanced_rdManglik'] != "Any" && $search_coockie_data['advanced_rdManglik'] != ''))
{
	if(($_POST['advanced_rdManglik'] != "Any" && $_POST['advanced_rdManglik'] != ''))
		$manglik=$_POST['advanced_rdManglik'];
	else if(($search_coockie_data['advanced_rdManglik'] != "Any" && $search_coockie_data['advanced_rdManglik'] != ''))
		$manglik=$search_coockie_data['advanced_rdManglik'];
	
	$conditions .= " AND manglik_dosham = '".$manglik."'";
}
if((!empty($_POST['soulmate_chkInterest'])) || count($search_coockie_data['soulmate_chkInterest'])>0)
{
	if(isset($_POST['soulmate_chkInterest']))
		$interest=$_POST['soulmate_chkInterest'];
	else if(count($search_coockie_data['soulmate_chkInterest'])>0)
		$interest=$search_coockie_data['soulmate_chkInterest'];
	
	for($i = 0; $i<count($interest);$i++)
	{
		if($i == 0)
		{
			$conditions .= " AND (Interest LIKE '%".$interest[$i]."%'";
		}
		else
		{
			$conditions .= " or Interest LIKE '%".$interest[$i]."%'";
		}
		
		if(count($interest)==($i+1))
		{
			$conditions .= ")";
		}
	}	
}
if(!empty($_POST['txt_by_id']) || $search_coockie_data['txt_by_id']!='')
{
	if(isset($_POST['txt_by_id']))
		$search_by_id=$_POST['txt_by_id'];
	else if($search_coockie_data['txt_by_id']!='')
		$search_by_id=$search_coockie_data['txt_by_id'];
		
	$conditions .= " AND (members.member_id = '".$search_by_id."' or  members.id = '".$search_by_id."')";
}
if(!empty($_POST['refine_submit_btn']) || $search_coockie_data['refine_submit_btn']!='')
{
	
	
	/*if(isset($_POST['who_online']))
		$who_online=$_POST['who_online'];
		
	else if($search_coockie_data['who_online']!='')
		$who_online=$search_coockie_data['who_online'];
		
		$conditions .= " AND (chat_users.status = '".$who_online."')";
		
		$right_join .= ' RIGHT JOIN chat_users on members.email_id=chat_users.email';*/
}
//echo $search_coockie_data['chk_with_photo'];
if($_POST['who_online'] == 'who_online' || $search_coockie_data['who_online']=='who_online'){
	
	
		
	$conditions .= " AND (chat_users.status = '1')";
		
	$right_join .= ' RIGHT JOIN chat_users on members.email_id=chat_users.email';
	
}
if($_POST['who_offline'] == 'who_offline' || $search_coockie_data['who_offline']=='who_offline'){
	
	
		
	//$conditions .= "AND (chat_users.status = '0') ";
		
	//$right_join .= ' RIGHT JOIN chat_users on members.email_id!=chat_users.email';
	
}
if(!empty($_POST['refine_submit_btn']) || $search_coockie_data['refine_submit_btn']!=''){
	
}
if($_POST['chk_with_photo'] == 'on' || $search_coockie_data['chk_with_photo'] == 1)
{	
	
	$conditions.= " AND member_photos.photo !=''";
	//echo $conditions;
}
if($_POST['chk_with_horoscope']=='on' || $search_coockie_data['chk_with_horoscope'] == 1)
{
	$conditions.= " AND members.horoscope_match != ''";
	//echo $conditions;
}
if($_POST['myself'] == 'myself' || $search_coockie_data['myself'] == 'myself')
{	
	$conditions.= " AND members.profile_for ='myself'";
	//echo $conditions;
}
if($_POST['son'] == 'son' || $search_coockie_data['son'] == 'son')
{	
	$conditions.= " AND members.profile_for ='son'";
	//echo $conditions;
	
}
if($_POST['daughter'] == 'daughter' || $search_coockie_data['daughter'] == 'daughter')
{	
	$conditions.= " AND members.profile_for ='daughter'";
	
}
if($_POST['brother'] == 'brother' || $search_coockie_data['brother'] == 'brother')
{	
	$conditions.= " AND members.profile_for ='brother'";
	
}
if($_POST['sister'] == 'sister' || $search_coockie_data['sister'] == 'sister')
{	
	$conditions.= " AND members.profile_for ='sister'";
	
}
if($_POST['relative'] == 'relative' || $search_coockie_data['relative'] == 'relative')
{	
	$conditions.= " AND members.profile_for ='relative'";
	
}
if($_POST['friend'] == 'friend' || $search_coockie_data['friend'] == 'friend')
{	
	$conditions.= " AND members.profile_for ='friend'";
	
}
if(!empty($_SESSION['logged_user'][0]['id']))
{					
	$conditions.= " AND members.id != '".$_SESSION['logged_user'][0]['id']."'";					
}
if(!empty($_POST) || count($search_coockie_data)>0)
{
$sql = "SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id ".$right_join." WHERE ".$conditions."";
//echo $sql;
//echo $sql;
}
if($_GET['clear']=='all' && !isset($_POST['refine_submit_btn']))
{
	$_SESSION['SearchCookie'] = $_SESSION['ClearCookie'];
}

if((!empty($_POST['regular_search_save']) && $_POST['regular_search_save']!='') || (!empty($_POST['keyword_search_save']) && $_POST['keyword_search_save']!='') || (!empty($_POST['advanced_search_save']) && $_POST['advanced_search_save']!=''))
{
	$insert_search='insert into tbl_search(Id, Member_id, Search_lable, Search)value(null, "'.$_SESSION['logged_user'][0]['id'].'", "'.$_POST['regular_search_save'].'", "'.$sql.'")';
	$db_search=$obj->insert($insert_search);
}

if(!empty($_POST['regular_search']) || !empty($_POST['advanced_search']) || !empty($_POST['keyword_search']))
{
	$select_last = "select session_id from clear_search where session_id='".session_id()."'";
	$db_select_user = $obj->select($select_last);
	if(count($db_select_user)==0)
	{
		$insert_search='insert into clear_search(Id, session_id, search)value(null, "'.session_id().'", "'.addslashes($sql).'")';
		$db_search=$obj->insert($insert_search);
	}
	else
	{
		$update_serch = "update clear_search set search='".addslashes ($sql)."' where session_id='".session_id()."'";
		$db_update = $obj->edit($update_serch);
	}
}

if($_GET['clear']=='all' && !isset($_POST['refine_submit_btn']))
{
	//$_SESSION['SearchCookie'] = $_SESSION['ClearCookie'];
	$select_last = "select * from clear_search where session_id='".session_id()."'";
	$db_select_last = $obj->select($select_last);
	$sql=$db_select_last[0]['search'];
	$PAGING=new PAGING($sql,8);
	$sql=$PAGING->sql;
	$members = $obj->select($sql);
}
elseif(!empty($_POST) || count($search_coockie_data)>0)
{      
$PAGING=new PAGING($sql,8);
$sql=$PAGING->sql;
//echo $sql;
$members = $obj->select($sql);
}
?>
       
<div class="mid">
<?php
$select_banner = "select * from advertise where adv_position = 'Search Result Top (954 X 100)' AND status = 'Active'";
$db_banner = $obj->select($select_banner);
if(count($db_banner) > 0) 
{
	if($db_banner[0]['banner_file'] != '') 
	{
		if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {
?>
<div style="margin: 0px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>
<?php } } }
$logged_member = "select view_mobile,num_send_msg from members where member_id='".$_SESSION['logged_user'][0]['member_id']."'";
$db_logged = $obj->select($logged_member);

$user_plan = "select new_membership_plans.*,member_plans.plan_id from new_membership_plans left join member_plans on new_membership_plans.id=member_plans.plan_id where member_plans.member_id='".$_SESSION['logged_user'][0]['id']."'";
$db_user_plan = $obj->select($user_plan);
 ?>
<?php if(!empty($members)){ ?>
<div class="sidebar">
        	<div class="sidebar-main">
            	<h2>Refine Search<a href="search_list.php?clear=all" style="float:right; font-size:12px; color:red;">Clear All</a></h2>
                <div class="sidebar-cont" id="acc-list">
                	
                    <div class="list-toggle">
                        <h3>Profile Type</h3>
                        <ul>
                        	<?php 
							if($search_coockie_data['chk_with_photo']==1){ ?>
                            <li><a href="#">With Photo (<?php echo count($members); ?>)</a></li>
                            <?php } else
							{
								?>
									<li><a href="#" onclick="test123('chk_with_photo','withphhr');">With Photo (<span id="withphoto_1"></span>)</a></li>	
                                    
								<?php
							}if($search_coockie_data['chk_with_horoscope']==1){ ?>
                            <li><a href="#">With Horoscope (<?php echo count($members); ?>)</a></li>
                            <?php }else{
							?>
                            <li><a href="#" onclick="test123('chk_with_horoscope','withphhr');">With Horoscope (<span id="horoscope1_1"></span>)</a></li>
                            <!--<li><a href="#">Self</a></li>
                            <li><a href="#">Friend</a></li>-->
                            <?php } ?>
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox">
                                        	<h4>Profile Type</h4>
                                            <form action="" method="post" name="profileform" id="profileform">
											<label><input type="checkbox" id="chk_with_photo"  name="chk_with_photo"<?php if($search_coockie_data['chk_with_photo']==1){ ?> checked="checked" <?php } ?> />With Photo</label>
                                            <label><input type="checkbox" id="chk_with_horoscope" name="chk_with_horoscope"<?php if($search_coockie_data['chk_with_horoscope']==1){ ?> checked="checked" <?php } ?> />With Horoscope</label>
                                            <input type="submit" value="Submit" id="withphhr" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Age</h3>
                        <ul>
                            <li><a href="#">
							<?php echo $search_coockie_data['Search_from_age']; ?>yrs to <?php echo $search_coockie_data['Search_to_age']; ?>yrs (<?php echo count($members); ?>)</a>    
                            </li>
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox">
                                        	<h4>Age</h4>                                      	
                                            <form action="" method="post">
                                            <label class="lblage">Age</label> 
                                            <input type="text" class="age1" name="Search_from_age" value="<?php echo $search_coockie_data['Search_from_age']; ?>">
                                            <span class="bet_text">to</span>
                                            <input type="text" class="age1" name="Search_to_age" value="<?php echo $search_coockie_data['Search_to_age']; ?>">
                                            <span class="bet_text">years</span>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Height</h3>
                        <ul>
                            <?php 
							if($search_coockie_data['Search_from_drpHeight']!='' && $search_coockie_data['Search_to_drpHeight']!='')
							{
							?>
                            <li><a href="javascript:;">
                            <?php
								$select_height="select * from height where Id='".$search_coockie_data['Search_from_drpHeight']."'";
								$db_height=$obj->select($select_height);
								echo $db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
							?>
                            to
                            <?php
								$select_height="select * from height where Id='".$search_coockie_data['Search_to_drpHeight']."'";
								$db_height=$obj->select($select_height);
								echo $db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
							?>
	                        (<?php echo count($members); ?>)
                            </a></li>
                            <?php }else{ ?>
                           <!-- <li><a href="javascript:;">Any</a></li>-->
                            <?php } ?>
                            
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-height">
                                        	<h4>Height</h4>
                                            <form action="" method="post">
                                            <select class="sel-height" name="Search_from_drpHeight">
                                               	   <option value="">- Feet/Inches-</option>
                                                   <?php 
													$select_height="select * from height";
													$db_height=$obj->select($select_height);
													for($i=0;$i<count($db_height);$i++){
													?>
												   <option value="<?php echo $db_height[$i]['Id']; ?>" <?php if($i==0) { ?> selected="selected"<?php } ?>><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>
												   <?php } ?>
                                            </select>
                                            <span class="bet_text">to</span>
                                            <select class="sel-height" name="Search_to_drpHeight">
                                               	   <option value="">- Feet/Inches -</option>
                                                   <?php 
													$select_height="select * from height";
													$db_height=$obj->select($select_height);
													for($i=0;$i<count($db_height);$i++){
													?>
												   <option value="<?php echo $db_height[$i]['Id']; ?>"  <?php if($i==(count($db_height)-1)) { ?> selected="selected"<?php } ?>><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>
												   <?php } ?>
                                            </select>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Marital Status</h3>
                        <ul>
                        	<?php /*<?php 
							$marital_status=$search_coockie_data['Search_chk_marital_status'];
							for($k=0;$k<count($marital_status);$k++){
							?>
                            <li><a href="#"><?php echo $marital_status[$k]; ?> (<?php echo count($members); ?>)</a></li>
                            <?php } ?>*/ ?>
                            
                            <?php //if(count($marital_status)==0){ ?>
                            <!--<li><a href="#">Any</a></li>-->
                            <li><a href="#" onclick="test123('unmarried_status','submit_maritial_status');">Unmarried(<span id="unmarried"></span>)</a></li>
                            <li><a href="#" onclick="test123('widow_status','submit_maritial_status');">Widow(<span id="widow"></span>)</a></li>
                            <li><a href="#" onclick="test123('divorced_status','submit_maritial_status');">Divorced(<span id="divorced"></span>)</a></li>
                            <li><a href="#" onclick="test123('awaiting-divorced_status','submit_maritial_status');">Awaiting Divorce(<span id="aw-divorced"></span>)</a></li>
                            <?php //} ?>
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-marit">
                                        	<h4>Marital Status</h4>                                      	
                                            <form action="" method="post">
                                          <!--  <label><input type="checkbox" name="Search_chk_marital_status[]" value="Any" <?php if(in_array('Any',$marital_status)){ ?> checked="checked" <?php } ?> />Any</label>-->
                                            <label><input type="checkbox" id="unmarried_status" name="Search_chk_marital_status[]" value="Unmarried" <?php if(in_array('Unmarried',$marital_status)){ ?> checked="checked" <?php } ?> />Unmarried</label>
                                            <label><input type="checkbox" id="widow_status" name="Search_chk_marital_status[]" value="Widow" <?php if(in_array('Widow',$marital_status)){ ?> checked="checked" <?php } ?> />Widow</label>
                                            <label><input type="checkbox" id="divorced_status" name="Search_chk_marital_status[]" value="Divorced" <?php if(in_array('Divorced',$marital_status)){ ?> checked="checked" <?php } ?> />Divorced</label>
                                            <label><input type="checkbox" id="awaiting-divorced_status" name="Search_chk_marital_status[]" value="Awaiting divorce" <?php if(in_array('Awaiting divorce',$marital_status)){ ?> checked="checked" <?php } ?> />Awaiting Divorce</label>
                                            <input type="submit" value="Submit" id="submit_maritial_status" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Religion</h3>
                        <ul>
							<?php if($search_coockie_data['Search_drpReligion']!=''){ ?>
                            <li><a href="#"><?php echo $search_coockie_data['Search_drpReligion']; ?> (<?php echo count($members); ?>)</a></li>
                            <?php }else{ ?>
                           <!-- <li><a href="#">Any</a></li>-->
                            <?php } ?>
                            
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">
                                        	<h4>Religion</h4>                                      	
                                            <form action="" method="post">
                                            <select id="regular_drpReligion" name="Search_drpReligion">
	                                            <option value="">-Any-</option>
                   								<?php
												$religion_list="select * from religions";
												$religion=$obj->select($religion_list);
												foreach($religion as $rel)
												{ ?>
													<option value="<?php echo $rel['religion']; ?>"><?php echo $rel['religion']; ?></option>
											<?php } ?>
                                            </select>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Mother Tongue</h3>
                        <ul>
                        
                        	<?php if(count($search_coockie_data['Search_drpMotherTongue'])>0 && $search_coockie_data['Search_drpMotherTongue'][0]!=''){ ?>
								<?php for($k=0;$k<count($search_coockie_data['Search_drpMotherTongue']);$k++){
                                ?>
                                <li><a href="#"><?php echo $search_coockie_data['Search_drpMotherTongue'][$k]; ?> (<?php echo count($members); ?>)</a></li>
                                <?php } ?>
                            <?php }else{ ?>
                           <!-- <li><a href="#">Any</a></li>-->
                            <?php } ?>
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">
                                        	<h4>Mother Tongue</h4>    
                                            <form action="" method="post">                                  	
                                            <select id="regular_drpMotherTongue" name="Search_drpMotherTongue[]" data-placeholder="Choose a Mother Tongue..." class="chosen-select" multiple="multiple">
                                            	<option value="">-Any-</option>
												<?php
                                                $lang_list="select * from mother_tongues";
                                                $languages=$obj->select($lang_list);
                                                foreach($languages as $lang)
                                                { ?>
                                                    <option value="<?php echo $lang['name']; ?>"><?php echo $lang['name']; ?></option>
                                            <?php } ?>
                                           	</select>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Education</h3>
                        <ul>
                        	<?php if(count($search_coockie_data['Search_drpEducation'])>0 && $search_coockie_data['Search_drpEducation'][0]!=''){ ?>
                            	<?php for($k=0;$k<count($search_coockie_data['Search_drpEducation']);$k++){
									$level_e="SELECT * FROM `education_details` where id='".$search_coockie_data['Search_drpEducation'][$k]."'";
									$sel_e=$obj->select($level_e);
                                ?>
                                <li><a href="#"><?php echo $sel_e[0]['degree']; ?></a> (<?php echo count($members); ?>)</li>
                                <?php } ?>
                            <?php }else{ ?>
                           <!-- <li><a href="#">Any</a></li>-->
                            <?php } ?>
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">
                                        	<h4>Education</h4>                                      	                                           
                                            <form action="" method="post">
                                            <select name="Search_drpEducation[]" id="regular_drpEducation" data-placeholder="Choose a Education..." class="chosen-select" multiple="multiple" >
                    								<option value="">-Any-</option>
													<?php /*?><?php
                                                    $education_list="select * from education_details";
                                                    $education=$obj->select($education_list);
                                                    foreach($education as $edu)
                                                    { ?>
                                                        <option value="<?php echo $edu['degree']; ?>"><?php echo $edu['degree']; ?></option>
                                                <?php } ?><?php */?>
													<?php
                                                    $level="SELECT * FROM `education_details`";
                                                    $sel=$obj->select($level);
                                                    for($i=0;$i<count($sel);$i++)
                                                    {
                                                     ?>
                                                        <option value="<?php echo $sel[$i]['id'];?>"><?php echo $sel[$i]['degree']; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    
                    <div class="list-toggle">
                        <h3>Profile Created For</h3>
                        <ul>
                        	
                            <li><a href="#" onclick="test123('myself_status','submit_profile_status');"><?php if($search_coockie_data['myself']=='myself'){ ?>Myself <?php //echo (count($members)); ?> <?php }else { ?>Myself<?php } ?>(<span id="myself"></span>)</a></li>
                            <li><a href="#" onclick="test123('sun_status','submit_profile_status');"><?php if($search_coockie_data['son']=='son'){ ?>Son <?php //echo (count($members)); ?> <?php }else { ?>Son <?php } ?>(<span id="son"></span>)</a></li>
                            <li><a href="#" onclick="test123('daughter_status','submit_profile_status');"><?php if($search_coockie_data['daughter']=='daughter'){ ?>Daughter <?php //echo (count($members)); ?> <?php }else { ?>Daughter <?php } ?>(<span id="daughter"></span>)</a></li>
                            <li><a href="#" onclick="test123('brother_status','submit_profile_status');"><?php if($search_coockie_data['brother']=='brother'){ ?>Brother <?php //(echo count($members)); ?> <?php }else { ?>Brother <?php } ?>(<span id="brother"></span>)</a></li>
                            <li><a href="#" onclick="test123('sister_status','submit_profile_status');"><?php if($search_coockie_data['sister']=='sister'){ ?>Sister <?php //echo (count($members)); ?> <?php }else { ?>Sister <?php } ?>(<span id="sister"></span>)</a></li>
                            <li><a href="#" onclick="test123('relative_status','submit_profile_status');"><?php if($search_coockie_data['relative']=='relative'){ ?>Relative <?php //echo (count($members)); ?>) <?php }else { ?>Relative <?php } ?>(<span id="relative"></span>)</a></li>
                            <li><a href="#" onclick="test123('friend_status','submit_profile_status');"><?php if($search_coockie_data['friend']=='friend'){ ?>Friend <?php //echo (count($members)); ?>) <?php }else { ?>Friend <?php } ?>(<span id="friend"></span>)</a></li>
                            
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox">
                                        	<h4>Profile Created For</h4>
                                            <form action="" method="post">
											<label><input type="checkbox" value="myself" id="myself_status" name="myself"<?php if($search_coockie_data['myself']==1){ ?> checked="checked" <?php } ?> />Myself</label>
                                            <label><input type="checkbox" value="son" id="sun_status" name="son" <?php if($search_coockie_data['son']=='son'){ ?> checked="checked" <?php } ?> />Son</label>
                                            <label><input type="checkbox" value="daughter" id="daughter_status" name="daughter" <?php if($search_coockie_data['daughter']=='daughter'){ ?> checked="checked" <?php } ?> />Daughter</label>
                                            <label><input type="checkbox" value="brother" id="brother_status" name="brother" <?php if($search_coockie_data['brother']=='brother'){ ?> checked="checked" <?php } ?> />Brother</label>
                                            <label><input type="checkbox" value="sister" id="sister_status" name="sister" <?php if($search_coockie_data['sister']=='sister'){ ?> checked="checked" <?php } ?> />Sister</label>
                                            <label><input type="checkbox" value="relative" id="relative_status" name="relative" <?php if($search_coockie_data['relative']=='relative'){ ?> checked="checked" <?php } ?> />Relative</label>
                                            <label><input type="checkbox" value="friend" id="friend_status" name="friend" <?php if($search_coockie_data['friend']=='friend'){ ?> checked="checked" <?php } ?> />Friend</label>
                                            <input type="submit" value="Submit" id="submit_profile_status" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    
                    <div class="list-toggle">
                        <h3>Online Status</h3>
                        <ul>
                        	
                            <li><a href="#">Online members</a></li>
                           
                            <li><a href="#">Offline members</a></li>
                           
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox">
                                        	<h4>Online Status</h4>
                                            <form action="" method="post">
											<label><input type="checkbox" id="who_online" name="who_online" value="who_online" <?php if($search_coockie_data['who_online']=='who_online'){ ?> checked="checked" <?php } ?> />Online members</label>
                                            <label><input type="checkbox" id="who_offline" name="who_offline" value="who_offline" <?php if($search_coockie_data['who_offline']=='who_offline'){ ?> checked="checked" <?php } ?>/>Offline members</label>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="content" id="content_data">      
        <?php if(!empty($members))
				{ ?>
                
             <div class="mid_top_checkbox" style="clear: both;margin: 19px;float: right;margin-top: 0;"><a href="javascript:;" class="list_view">List View</a><a href="javascript:;" class="grid_view">Grid View</a></div><br clear="all" />
                
        	<ul class="profl-list"> <!-- thumb_view -->
            <?php
					$t = 0; 
					foreach($members as $res) {
						
						
						//echo"<pre>";print_r($res);
						//count($res['unmarried']);
						
						//echo"<pre>";print_r($res);
						
						//echo"<pre>";print_r($_POST);
						if(isset($_POST['who_online']))
						{
							//echo"test";	
							$chat="select * from chat_users where email='".$res['email_id']."' and status='1'";
							//echo $chat."<br>";
							$db_chat=$obj->select($chat);
							//echo count($db_chat)."<br>";
							if(count($db_chat)==0)
							{
								continue;
							}
						}
						
						if(isset($_POST['who_offline']))
						{
							//echo"test";	
							$chat="select * from chat_users where email='".$res['email_id']."' and status='1'";
							//echo $chat."<br>";
							$db_chat=$obj->select($chat);
							
							//echo count($db_chat)."<br>";
							if(count($db_chat)!=0)
							{
								continue;
							}
						}
						$t++;
						$plan="select * from member_plans where member_id='".$res['id']."' and paypal_transec_id!=''"; 
						$dbplan=$obj->select($plan);
						if($res['horoscope_match'] != ''){
						 $horoscope1 = $horoscope1 +1; 
						}
						
						//echo $res['relationship_status'];
						if($res['relationship_status'] == 'UnMarried'){
							$unmarrid = $unmarrid +1; 
						}
						if($res['relationship_status'] == 'Widowed'){
							$widow = $widow +1; 
						}
						if($res['relationship_status'] == 'Divorced'){
							$divorced = $divorced +1; 
						}
						if($res['relationship_status'] == 'Awaiting Divorce'){
							$aw_divorced = $aw_divorced +1; 
						}
						
						
						
						if($res['profile_for'] == 'Myself'){
							$my_self = $my_self +1; 
						}
						if($res['profile_for'] == 'Daughter'){
							$daughter = $daughter +1; 
						}
						if($res['profile_for'] == 'Son'){
							$son = $son +1; 
						}
						if($res['profile_for'] == 'Brother'){
							$brother = $brother +1; 
						}
						if($res['profile_for'] == 'Sister'){
							$sister = $sister +1; 
						}
						if($res['profile_for'] == 'Relative'){
							$relative = $relative +1; 
						}
						if($res['profile_for'] == 'Friend'){
							$friend = $friend +1; 
						}
						
						
						
						//echo"<pre>";print_r($res['relationship_status']);
						
						
						 ?>
            	<li>
                    <div class="profile-img-box">
                    <a href="view_profile.php?id=<?php echo $res['id']; ?>" target="_blank" class="popper" data-popbox="pop<?php echo $res['id']; ?>">
                     <?php //$plan="select * from member_plans where member_id='".$res['id']."'"; 
							//$dbplan=$obj->select($plan);
							//if(count($dbplan)>0)
							//{
$membership="<label style='background:none; text-align:left; font-weight:bold; color:#000; font-size:14px; height:20px; color:#000; padding-bottom:5px;'>".$res['member_id']."</label>";
							//}
							//else
							//{
//$membership="<label style='background:none; font-weight:bold; color:#000; font-size:12px; height:20px;'>".$res['member_id']." - Free</label>";
	//						}
					echo $membership;
							?>
                        <?php
						if(!empty($res['photo']) && $res['Approve']==1)
						{
						 	//$path =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/".$members[0]['photo'];
							$path = "upload/".$res['photo'];
							list($width, $height, $type, $attr) = getimagesize(str_replace('crop_','',$path));
							if($width > 200)
							{
								$width = 200;
								$height = (($height*200)/$width);
							}
							else
							{
								$height = 200;
								$width = (($width*200)/$height);
							}
							if (file_exists($path)) {
									//echo '<a href="javascript:;" class="popper" data-popbox="pop'.$res['id'].'"><img src="'.$path.'" class="profile_pic" style="width:152px;height:161px;" /></a>'; 
							echo '<img title="" data-popbox="pop'.$res['id'].'" class="profile_pic popper" src="'.$path.'" />';
		echo '<div id="pop'.$res['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" width="'.$width.'"  height="'.$height.'" /></div>';
								$withphoto=$withphoto+1;
									//echo '<div id="pop'.$res['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" /></div>';
							}
							else{
								if($res['gender']=='M')
									echo '<img title="" class="profile_pic" src="images/male-user1.png" />';
								else
									echo '<img title="" class="profile_pic" src="images/female-user1.png" />';
							}
						}
						else{
								if($res['gender']=='M')
									echo '<img title="" class="profile_pic" src="images/male-user1.png" />';
								else
									echo '<img title="" class="profile_pic" src="images/female-user1.png" />';
							}?>
                            
                        
                        <div class="griddetail">
                        	<div style="overflow:hidden;"><b><?php echo ucfirst($res['name']); ?></b></div>
							<div><?php echo $res['age'] ?> 
							<?php if($res['height'] != '') {  
                            		$select_height="select * from height where Id='".$res['height']."'";
									$db_height=$obj->select($select_height);
									echo ' / '.$db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
									if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }
								} ?>
                            </div>
						</div>
						<div class="listdetail">
                        	<div><label>Name : </label><?php echo ucfirst($res['name']); ?></div>
                            <?php /*?><label>Membership: </label>
                            <?php $plan="select * from member_plans where member_id='".$res['id']."'"; 
							$dbplan=$obj->select($plan);
							if(count($dbplan)>0)
							{
								$membership="Paid";
							}
							else
							{
								$membership="Free";
							}
							echo $membership;
							?><?php */?>
							<div><label>Age / Height : </label><?php echo $res['age'] ?> 
                            	<?php if($res['height'] != '') {  
                            		$select_height="select * from height where Id='".$res['height']."'";
									$db_height=$obj->select($select_height);
									echo ' / '.$db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
									if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }
								} ?>
                            </div>
                            <div><label>Religion : </label><?php echo $res['religion'] ?></div>
                            <div><label>Caste / Subcaste : </label><?php echo $res['caste'] ?> / <?php echo $res['subcaste'] ?></div>
                            <div><label>Location : </label><?php if($res['city'] != '') { echo $res['city'].", "; } ?><?php if($res['state'] != '') { echo $res['state'].", "; } ?><?php if($res['country'] != '') { echo $res['country']; } ?></div>
                            <div><label>Education : </label>
								<?php //echo $res['education'] ?>
                                <?php
								$select_education="select * from education_course where Id='".$res['education']."'";
								$db_education=$obj->select($select_education);
								echo $db_education[0]['Title'];
								?>&nbsp;
                            </div>
                            <div><label>Occupation : </label><?php echo $res['occupation'] ?></div>
						</div>
</a>
						<div class="goto">
                        	<?php
							if($_SESSION['logged_user'][0]['member_id']!='')
							{
								$select_express_intrest="select * from express_interest where from_mem='".$_SESSION['logged_user'][0]['member_id']."' AND to_mem='".$res['member_id']."'";
								$db_express_intrest=$obj->select($select_express_intrest);
								
								$accepted_express_intrest="select * from express_interest where from_mem='".$res['member_id']."' AND to_mem='".$_SESSION['logged_user'][0]['member_id']."'";
								$ac_express_intrest=$obj->select($accepted_express_intrest);
								
								$user1 = "select * from members where member_id = '".$_SESSION['logged_user'][0]['member_id']."' AND Status = 'Active'";
								$db_user1 = $obj->select($user1);
								if(count($db_express_intrest)==0 && $_POST['Search_rdGender'] != $db_user1[0]['gender'] && count($ac_express_intrest)!=1){
								?>
                               <a id="chk_express<?php echo $res['member_id']; ?>" href="javascript:;" onclick="check_express_interest('<?php echo $res['member_id'] ?>','<?php echo $_SESSION['logged_user'][0]['member_id'] ?>', 2, '<?php echo $res['id'] ;?>')" class="icon-heart"></a>
                                <a id="success_msg<?php echo $res['id'] ;?>" href="include/view_success_msg.php?id=<?php echo $res['id']?>" class="ajax3 send_email_btn" style="display:none">
								<?php }elseif($_POST['Search_rdGender'] == $db_user1[0]['gender']){ ?>
                                <a href="javascript:;" class="same_gender icon-heart"></a>
								<?php  }else { ?>
								<a href="javascript:;" class="alredy_sent icon-red-heart"></a>      
                                                      
								<?php } ?>
                                
                                <?php
								$select_chat_users="select * from chat_users where status='1' AND email='".$res['email_id']."'";
								$db_chat_user=$obj->select($select_chat_users);
								?>
                                 <input type="hidden" id="count_view_mob" value="<?php echo $db_logged[0]['view_mobile'];?>"> 
                                 <input type="hidden" id="count_view_msg" value="<?php echo $db_logged[0]['num_send_msg'];?>"> 
                                <?php if($db_logged[0]['view_mobile']>$db_user_plan[0]['no_of_contacts']) { ?>
								 <a <?php if($_SESSION['Member_status']=='Paid'){ ?>href="javascript:;" class="exid_mobile icon-gift-online"<?php } else { ?> href="javascript:;" class="paid_error icon-gift-online"<?php } ?>></a>
                                 <?php } else { ?>
                                <?php if(count($db_chat_user)==0){ ?>
                                      
<a <?php if($_SESSION['Member_status']=='Paid'){ ?>href="include/view_mobile.php?id=<?php echo $res['id'] ;?>" class="icon-gift-offline ajax1 send_email_btn"<?php } else { ?> href="javascript:;" class="icon-gift-offline paid_error" <?php } ?> id="view_moblie_cnt<?php echo $res['id'] ;?>"></a>
                                <?php }else{ ?>
                                <a href="include/view_mobile.php?id=<?php echo $res['id'] ;?>" class="icon-gift-online ajax1 send_email_btn"></a>
                                <?php } ?>
                                <?php } ?>
                                
                                <script type="text/javascript">
								/*function view_mobile_count(user_id,num_contact)
								{
									var number = $('#count_view_mob').val();
									if(number>num_contact) {alert('Sorry You Exceed Maximum Number Of Mobile View');$.colorbox.remove();return false;}
									var r = confirm('you are view '+number+' of '+num_contact+'. Are you sure to view this number?');
									if(r)
									{
										$('#count_view_mob').val(parseInt(number)+1);
										$('#view_moblie_cnt'+user_id).attr("href", "include/view_mobile.php?id="+user_id+"&number="+number);
										$(".ajax1").colorbox({innerWidth:"450px;", maxWidth:"450px;", innerHeight:"200px;"});
									}
									else {
										$.colorbox.remove();return false;
									}
 								}*/
								</script>
                                <?php if($db_logged[0]['num_send_msg']>$db_user_plan[0]['allow_messages']) { ?>
<a <?php if( $_SESSION['Member_status']=='Paid'){ ?>href="javascript:;" class="exid_msg icon-mail"<?php } else { ?> href="javascript:;" class="paid_error icon-mail"<?php } ?>></a>
                                <?php } else { ?>
<a <?php if( $_SESSION['Member_status']=='Paid'){ ?>href="include/send_message.php?id=<?php echo $res['id']; ?>&email=<?php echo $res['email_id']; ?>&to_mem_id=<?php echo $res['member_id']; ?>" class="ajax send_email_btn icon-mail" <?php } else { ?> href="javascript:;" class="paid_error icon-mail" <?php } ?>></a>
                                
                                <?php } ?>
					
                                <?php
								$sonline="select * from chat_users where email='".$res['email_id']."' and status='1'";
								$sonline_data=$obj->select($sonline);
								?>
       <?php if( $_SESSION['Member_status']=='Paid'){ ?>
       <a <?php if(count($sonline_data)>0){ ?> href="javascript:;" <?php } else { ?>href="javascript:;" class="user_offline icon-chat-offline"<?php } ?> class="<?php if(count($sonline_data)>0){ ?>onlineUsers <?php } if(count($sonline_data)>0){ ?>icon-chat<?php }else{ ?>icon-chat-offline<?php } ?>" <?php if(count($sonline_data)>0){ ?>data-unk="<?php echo $sonline_data[0]['name'];?>" data-uid="<?php echo $sonline_data[0]['id'];?>" <?php } ?>></a>
       <?php } else { ?>
       <a href="javascript:;" class="paid_error <?php if(count($sonline_data)>0){ ?>icon-chat<?php } else {?>icon-chat-offline<?php } ?>"></a>
       <?php } ?>
		
                           <?php 
							}else{
							?>
								<a href="login.php" class="icon-heart"></a>                            
								<a href="login.php" class="icon-gift-offline"></a>
								<a href="login.php" class="icon-mail"></a>
								<a href="login.php" class="icon-chat-offline"></a>
                            <?php } ?>
						</div>
                        
                        <div class="goto" style="display:none">
<a href="javascript:;" class="icon-heart" ></a>
                             <a href="include/express_interest.php?to_mem_id=<?php echo $res['member_id']; ?>&from_mem_id=<?php echo $_SESSION['logged_user'][0]['member_id']; ?>&site=second">| EI</a>
                           <a class="ajax send_email_btn" href="include/send_message.php?id=<?php echo $res['id']; ?>&email=<?php echo $res['email_id']; ?>&to_mem_id=<?php echo $res['member_id']; ?>">MSG</a>
                        </div>
                    </div>
                </li>
                
                <?php } ?>
            </ul>
          
			   <div class="pagination" style="clear:both;"><?php echo $PAGING->show_paging("search_list.php",'Submit'); ?></div>
               <?php /*?> <?php } ?><?php */?>
           
            <?php }  
			else
			{
				echo "Sorry, No Matches found"; ?>
			<?php }
			 ?>
             <?php if($t == 0) { ?>
             	<?php echo "Sorry, No Matches found"; ?>
             <?php } ?>
	 </div> 
<?php
}else{ ?>
<div class="sidebar">
        	<div class="sidebar-main">
            	<h2>Refine Search</h2>
                <div class="sidebar-cont" id="acc-list">
                	
                    <div class="list-toggle">
                        <h3>Profile Type</h3>
                        <ul>
                        	<?php /*<?php if($search_coockie_data['chk_with_photo']==1){ ?>
                            <li><a href="#">With Photo (<?php echo count($members); ?>)</a></li>
                             <li><a href="#">With Horoscope (<?php echo count($members); ?>)</a></li>
                            <?php } else if($search_coockie_data['chk_with_horoscope']==1){ ?>
                            <li><a href="#">With Horoscope(<?php echo count($members); ?>)</a></li>
                            <?php }else{ ?> */?>
                            <li><a href="#">With Photo</a></li>
                            <li><a href="#">With Horoscope</a></li>
                            <!--<li><a href="#">Self</a></li>
                            <li><a href="#">Friend</a></li>-->
                            <?php  //} ?>
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox">
                                        	<h4>Profile Type</h4>
                                            <form action="" method="post">
                                        	<label><input type="checkbox" name="chk_with_photo" class="prflchk" <?php if($search_coockie_data['chk_with_photo']==1){ ?> checked="checked" <?php } ?>  />With Photo</label>
                                            <label><input type="checkbox" name="chk_with_horoscope" <?php if($search_coockie_data['chk_with_horoscope']==1){ ?> checked="checked" <?php } ?>  />With Horoscope</label>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Age</h3>
                        <ul>
                            <li><a href="#">
							<?php echo $search_coockie_data['Search_from_age']; ?>yrs to <?php echo $search_coockie_data['Search_to_age']; ?>yrs (<?php echo count($members); ?>)</a>    
                            </li>
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox">
                                        	<h4>Age</h4>                                      	
                                            <form action="" method="post">
                                            <label class="lblage">Age</label> 
                                            <input type="text" class="age1" name="Search_from_age" value="<?php echo $search_coockie_data['Search_from_age']; ?>">
                                            <span class="bet_text">to</span>
                                            <input type="text" class="age1" name="Search_to_age" value="<?php echo $search_coockie_data['Search_to_age']; ?>">
                                            <span class="bet_text">years</span>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Height</h3>
                        <ul>
                            <?php 
							if($search_coockie_data['Search_from_drpHeight']!='' && $search_coockie_data['Search_to_drpHeight']!='')
							{
							?>
                            <li><a href="javascript:;">
                            <?php
								$select_height="select * from height where Id='".$search_coockie_data['Search_from_drpHeight']."'";
								$db_height=$obj->select($select_height);
								echo $db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
							?>
                            to
                            <?php
								$select_height="select * from height where Id='".$search_coockie_data['Search_to_drpHeight']."'";
								$db_height=$obj->select($select_height);
								echo $db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
							?>
	                        (<?php echo count($members); ?>)
                            </a></li>
                            <?php }else{ ?>
                           <!-- <li><a href="javascript:;">Any</a></li>-->
                            <?php } ?>
                            
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-height">
                                        	<h4>Height</h4>
                                            <form action="" method="post">
                                            <select class="sel-height" name="Search_from_drpHeight" >
                                               	   <option value="">- Feet/Inches -</option>
                                                   <?php 
													$select_height="select * from height";
													$db_height=$obj->select($select_height);
													for($i=0;$i<count($db_height);$i++){
													?>
												   <option value="<?php echo $db_height[$i]['Id']; ?>"><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>
												   <?php } ?>
                                            </select>
                                            <span class="bet_text">to</span>
                                            <select class="sel-height" name="Search_to_drpHeight" >
                                               	   <option value="">- Feet/Inches -</option>
                                                   <?php 
													$select_height="select * from height";
													$db_height=$obj->select($select_height);
													for($i=0;$i<count($db_height);$i++){
													?>
												   <option value="<?php echo $db_height[$i]['Id']; ?>"><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>
												   <?php } ?>
                                            </select>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Marital Status</h3>
                        <ul>
                        	<?php 
							$marital_status=$search_coockie_data['Search_chk_marital_status'];
							for($k=0;$k<count($marital_status);$k++){
							?>
                            <li><a href="#"><?php echo $marital_status[$k]; ?> (<?php echo count($members); ?>)</a></li>
                            <?php } ?>
                            
                            <?php if(count($marital_status)==0){ ?>
                            <!--<li><a href="#">Any</a></li>-->
                            <li><a href="#">Unmarried</a></li>
                            <li><a href="#">Widow</a></li>
                            <li><a href="#">Divorced</a></li>
                            <li><a href="#">Awaiting Divorce</a></li>
                            <?php } ?>
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-marit">
                                        	<h4>Marital Status</h4>                                      	
                                            <form action="" method="post">
                                          <!--  <label><input type="checkbox" name="Search_chk_marital_status[]" value="Any" <?php if(in_array('Any',$marital_status)){ ?> checked="checked" <?php } ?> />Any</label>-->
                                            <label><input type="checkbox" name="Search_chk_marital_status[]" value="Unmarried" <?php if(in_array('Unmarried',$marital_status)){ ?> checked="checked" <?php } ?> />Unmarried</label>
                                            <label><input type="checkbox" name="Search_chk_marital_status[]" value="Widow" <?php if(in_array('Widow',$marital_status)){ ?> checked="checked" <?php } ?> />Widow</label>
                                            <label><input type="checkbox" name="Search_chk_marital_status[]" value="Divorced" <?php if(in_array('Divorced',$marital_status)){ ?> checked="checked" <?php } ?> />Divorced</label>
                                            <label><input type="checkbox" name="Search_chk_marital_status[]" value="Awaiting divorce" <?php if(in_array('Awaiting divorce',$marital_status)){ ?> checked="checked" <?php } ?> />Awaiting Divorce</label>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Religion</h3>
                        <ul>
							<?php if($search_coockie_data['Search_drpReligion']!=''){ ?>
                            <li><a href="#"><?php echo $search_coockie_data['Search_drpReligion']; ?> (<?php echo count($members); ?>)</a></li>
                            <?php }else{ ?>
                           <!-- <li><a href="#">Any</a></li>-->
                            <?php } ?>
                            
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">
                                        	<h4>Religion</h4>                                      	
                                            <form action="" method="post">
                                            <select id="regular_drpReligion" name="Search_drpReligion">
	                                            <option value="">-Any-</option>
                   								<?php
												$religion_list="select * from religions";
												$religion=$obj->select($religion_list);
												foreach($religion as $rel)
												{ ?>
													<option value="<?php echo $rel['religion']; ?>"><?php echo $rel['religion']; ?></option>
											<?php } ?>
                                            </select>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Mother Tongue</h3>
                        <ul>
                        
                        	<?php if(count($search_coockie_data['Search_drpMotherTongue'])>0 && $search_coockie_data['Search_drpMotherTongue'][0]!=''){ ?>
								<?php for($k=0;$k<count($search_coockie_data['Search_drpMotherTongue']);$k++){
                                ?>
                                <li><a href="#"><?php echo $search_coockie_data['Search_drpMotherTongue'][$k]; ?> (<?php echo count($members); ?>)</a></li>
                                <?php } ?>
                            <?php }else{ ?>
                           <!-- <li><a href="#">Any</a></li>-->
                            <?php } ?>
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">
                                        	<h4>Mother Tongue</h4>    
                                            <form action="" method="post">                                  	
                                            <select id="regular_drpMotherTongue" name="Search_drpMotherTongue[]" data-placeholder="Choose a Mother Tongue..." class="chosen-select" multiple="multiple">
                                            	<option value="">-Any-</option>
												<?php
                                                $lang_list="select * from mother_tongues";
                                                $languages=$obj->select($lang_list);
                                                foreach($languages as $lang)
                                                { ?>
                                                    <option value="<?php echo $lang['name']; ?>"><?php echo $lang['name']; ?></option>
                                            <?php } ?>
                                           	</select>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Education</h3>
                        <ul>
                        	<?php if(count($search_coockie_data['Search_drpEducation'])>0 && $search_coockie_data['Search_drpEducation'][0]!=''){ ?>
                            	<?php for($k=0;$k<count($search_coockie_data['Search_drpEducation']);$k++){
									$level_e="SELECT * FROM `education_details` where id='".$search_coockie_data['Search_drpEducation'][$k]."'";
									$sel_e=$obj->select($level_e);
                                ?>
                                <li><a href="#"><?php echo $sel_e[0]['degree']; ?></a> (<?php echo count($members); ?>)</li>
                                <?php } ?>
                            <?php }else{ ?>
                           <!-- <li><a href="#">Any</a></li>-->
                            <?php } ?>
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">
                                        	<h4>Education</h4>                                      	                                           
                                            <form action="" method="post">
                                            <select name="Search_drpEducation[]" id="regular_drpEducation" data-placeholder="Choose a Education..." class="chosen-select" multiple="multiple" >
                    								<option value="">-Any-</option>
													<?php /*?><?php
                                                    $education_list="select * from education_details";
                                                    $education=$obj->select($education_list);
                                                    foreach($education as $edu)
                                                    { ?>
                                                        <option value="<?php echo $edu['degree']; ?>"><?php echo $edu['degree']; ?></option>
                                                <?php } ?><?php */?>
													<?php
                                                    $level="SELECT * FROM `education_details`";
                                                    $sel=$obj->select($level);
                                                    for($i=0;$i<count($sel);$i++)
                                                    {
                                                     ?>
                                                        <option value="<?php echo $sel[$i]['id'];?>"><?php echo $sel[$i]['degree']; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                  <div class="list-toggle">
                        <h3>Profile Created For</h3>
                        <ul>
                        	
                            <li><a href="#"><?php if($search_coockie_data['myself']=='myself'){ ?>Myself (<?php echo count($members); ?>) <?php }else { ?>Myself<?php } ?></a></li>
                            <li><a href="#"><?php if($search_coockie_data['son']=='son'){ ?>Son (<?php echo count($members); ?>) <?php }else { ?>Son <?php } ?></a></li>
                            <li><a href="#"><?php if($search_coockie_data['daughter']=='daughter'){ ?>Daughter (<?php echo count($members); ?>) <?php }else { ?>Daughter <?php } ?></a></li>
                            <li><a href="#"><?php if($search_coockie_data['brother']=='brother'){ ?>Brother (<?php echo count($members); ?>) <?php }else { ?>Brother <?php } ?></a></li>
                            <li><a href="#"><?php if($search_coockie_data['sister']=='sister'){ ?>Sister (<?php echo count($members); ?>) <?php }else { ?>Sister <?php } ?></a></li>
                            <li><a href="#"><?php if($search_coockie_data['relative']=='relative'){ ?>Relative (<?php echo count($members); ?>) <?php }else { ?>Relative <?php } ?></a></li>
                            <li><a href="#"><?php if($search_coockie_data['friend']=='friend'){ ?>Friend (<?php echo count($members); ?>) <?php }else { ?>Friend <?php } ?></a></li>
                            
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox">
                                        	<h4>Profile Created For</h4>
                                            <form action="" method="post">
											<label><input type="checkbox" value="myself" name="myself"<?php if($search_coockie_data['myself']=='myself'){ ?> checked="checked" <?php } ?> />Myself</label>
                                            <label><input type="checkbox" value="son" name="son" <?php if($search_coockie_data['son']=='son'){ ?> checked="checked" <?php } ?> />Son</label>
                                            <label><input type="checkbox" value="daughter" name="daughter" <?php if($search_coockie_data['daughter']=='daughter'){ ?> checked="checked" <?php } ?> />Daughter</label>
                                            <label><input type="checkbox" value="brother" name="brother" <?php if($search_coockie_data['brother']=='brother'){ ?> checked="checked" <?php } ?> />Brother</label>
                                            <label><input type="checkbox" value="sister" name="sister" <?php if($search_coockie_data['sister']=='sister'){ ?> checked="checked" <?php } ?> />Sister</label>
                                            <label><input type="checkbox" value="relative" name="relative" <?php if($search_coockie_data['relative']=='relative'){ ?> checked="checked" <?php } ?> />Relative</label>
                                            <label><input type="checkbox" value="friend" name="friend" <?php if($search_coockie_data['friend']=='friend'){ ?> checked="checked" <?php } ?> />Friend</label>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                    
                    <div class="list-toggle">
                        <h3>Online Status</h3>
                        <ul>
                        	
                            <li><a href="#">Online members</a></li>
                           
                            <li><a href="#">Offline members</a></li>
                           
                            <li class="morelink"><a class="more-view" href="javascript:;">More</a>
                                <div class="more_div">
                                    <div class="searchby">
                                        <div class="searchbubblebox">
                                        	<h4>Online Status</h4>
                                           <form action="" method="post">
											<label><input type="checkbox" id="who_online" name="who_online" />Online members</label>
                                            <label><input type="checkbox" id="who_offline" name="who_offline"/>Offline members</label>
                                            <input type="submit" value="Submit" name="refine_submit_btn" class="submit_btn_new_small" />
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                        <a class="close-more-search" href="javascript:;">Close</a>
                                    </div>
                                </div>
                         	</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="content" id="content_data">
<?php /*echo '<script>alert("Sorry, we couldn\'t find any results to suit your search criteria. Please resubmit the form.");
window.location.href="search.php";
</script>';*/?>
<a href="javascript:;" id="none_result" class="none_result">
<script type="text/javascript">
$(window).load(function() {
	$('#none_result').trigger("click");
});	
</script>
<h2>Sorry, we couldn't find any results to suit your search criteria. Please resubmit the form.</h2>
</div>
<?php } ?>
<?php
$select_banner = "select * from advertise where adv_position = 'Search Result Bottom (954 X 100)' AND status = 'Active'";
$db_banner = $obj->select($select_banner);
if(count($db_banner) > 0) 
{
	if($db_banner[0]['banner_file'] != '') 
	{
		if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {
?>
<div style="margin: 10px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>
<?php } } } ?>
</div>   
    <script>
	/*$('#search_by_id').click( function() {
		$.ajax({
				   type: "GET",		
				   url: 'displaySearchById.php',
				   success: function(data) {
					   $('.partner_search').html( data );
				   }
				});	
	});
	*/
 
	
	$('#submit_btn').click( function() {
		
		
	$('#drpAgeFrm').css('border','1px solid #ccc');
	$('#drpAgeTo').css('border','1px solid #ccc');
	$('#drpReligion').css('border','1px solid #ccc');
	$('#drpCaste').css('border','1px solid #ccc');
	$('#drpMaritalStatus').css('border','1px solid #ccc');
	
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
	if(drpAgeFrm==0 && drpAgeTo==0 && drpReligion==0 && drpCaste==0 && drpMaritalStatus==0)
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
					   $('#content_data').html( data );
				   }
				});	
		}
		else
		{
			return false;
		}
	});	
				
		$('.refine_search').click( function() {
			var val=$(this).attr('id');
			$.ajax({
				   type: "POST",		
				   url: 'new_refine_search.php',
				   data:'val='+encodeURIComponent(val),
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		
		$('#within_month').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=curr_month',
				   success: function(data) {
					   $('#content_data').html( data );
					   $(".ajax").colorbox({innerWidth:"500px;", maxWidth:"500px;"});
				   }
				});
		});
		$('#within_day').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=within_day',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#one_month_active').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=one_month_active',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#one_week_active').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=one_week_active',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#age_search').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=age_search',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		}); 
		$('#unmarried').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=unmarried',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#star_rohini').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=star_rohini',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#star_ashwini').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=star_ashwini',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#enginner_occu').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=enginner_occu',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#admini_prof').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=admini_prof',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#one_to_three_lakh').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=one_to_three_lakh',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#three_to_five').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=three_to_five',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#five_to_ten').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=five_to_ten',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		
		$('#india').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=india',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#usa').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=usa',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#fair').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=fair',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#wheatish').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=wheatish',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#manglik').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=manglik',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#not_manglik').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=not_manglik',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		
		$('#hindu').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=hindu',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#muslim').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=muslim',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#christian').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=christian',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#agarwal').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=agarwal',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#arora').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=arora',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		$('#brahmin').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=brahmin',
				   success: function(data) {
					   $('#content_data').html( data );
				   }
				});
		});
		
function check_validate_form(){
		
		var search_form1 = $('#search_from1').val();
		var search_form2 = $('#search_from2').val();
		if(search_form1==""){
			
			return false;
		}
		if(search_form2==""){
			
			return false;
		}
		return true;
	}
</script>   
<style>
.size
{
	height:152px;
	width:152px;
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
ul.profl-list li .profile-img-box{ position:inherit !important }
.profile-img-box{ position:inherit !important; }
</style>
<script>
$(document).ready(function(){
	
	$('#withphoto_1').html('<?php echo $withphoto; ?>');
	
	$('#horoscope1_1').html('<?php echo $horoscope1; ?>');
	$('#unmarried').html('<?php echo $unmarrid; ?>');
	$('#widow').html('<?php echo $widow; ?>');
	$('#divorced').html('<?php echo $divorced; ?>');
	$('#aw-divorced').html('<?php echo $aw_divorced; ?>');
	$('#myself').html('<?php echo $my_self; ?>');
	$('#daughter').html('<?php echo $daughter; ?>');
	$('#son').html('<?php echo $son; ?>');	
	$('#brother').html('<?php echo $brother; ?>');	
	$('#sister').html('<?php echo $sister; ?>');	
	$('#relative').html('<?php echo $relative; ?>');
	$('#friend').html('<?php echo $friend; ?>');
	
	<?php if(empty($members)) { ?>
	$('#cboxClose').click(function(){
			window.location.href="search.php";
	});	
	<?php } ?>
});
</script>
<script>
function test123(chk_id,btn_id){
	//alert(chk_id);
	//alert(btn_id);
	document.getElementById(chk_id).checked = true;
	$('#'+chk_id).attr('checked','checked');
	$('#'+btn_id).trigger('click');
}

function check_express_interest(to_member,from_member,site,user_id)
{
	$.ajax({
			url:'include/express_interest.php',
			data:{to_mem:to_member,from_mem:from_member,site:site},
			type:'POST',
			success: function(data)
			{
				if(data=='1')
				{
					$('#chk_express'+to_member).removeClass("icon-heart");
					$('#chk_express'+to_member).addClass("icon-red-heart");
					$('#chk_express'+to_member).prop("onclick", null);
					$('#success_msg'+user_id).trigger("click");
				}
			}
		});
}
</script>
     
