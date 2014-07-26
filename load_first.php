<?php
$withphoto=0;
$horoscope1 = 0;
$unmarrid = 0;
$widow = 0;
$divorced = 0;
//$aw_divorced = 0;
$my_self = 0;
$daughter = 0;
$son = 0;
$brother = 0;
$sister = 0;
$relative = 0;
$friend = 0;
$count_online = 0;
$count_offline = 0;
//print_r($_POST);
if(isset($_POST['send_msg']))
{
	$date = date('Y-m-d H:i:s');
	$to = $_POST['to_member_id'];
	$from = $_POST['from_member_id'];
	$conversation = "select conversation from messages where (to_mem = '".$to."' and from_mem='".$from."') or (to_mem = '".$from."' and from_mem='".$to."')";
	$db_conver = $obj->select($conversation);
	
	if(count($db_conver)>=1)
	{
	$insert="INSERT into messages(id, from_mem,to_mem,message, parent_id, is_replied, interested, is_read, send_date)values(NULL,'".$_POST['from_member_id']."','".$_POST['to_member_id']."','".$_POST['message']."', '1', 'N', 'Y', '0', '".$date."')";
	}
	else 
	{
		$insert="INSERT into messages(id, from_mem,to_mem,message, parent_id, is_replied, interested, is_read, send_date, conversation)values(NULL,'".$_POST['from_member_id']."','".$_POST['to_member_id']."','".$_POST['message']."', '1', 'N', 'Y', '0', '".$date."','1')";
	}
 	$db_insert = $obj->insert($insert);
 $update_mob_counter = "update members set num_send_msg='".($_POST['num_send_msg']+1)."' where member_id='".$_SESSION['logged_user'][0]['member_id']."'"; 
	$db_update = $obj->edit($update_mob_counter);
}
if(isset($_GET['clear']) && ($_GET['clear']=='all'))
{
	$_SESSION['SearchCookie'] = $_SESSION['ClearCookie'];
	$search_coockie_data = $_SESSION['SearchCookie'];
	$search_coockie_data = json_decode(stripslashes($search_coockie_data),true);
}
if(isset($_GET['save']) && ($_GET['save']!=''))
{
	$select_save = "select * from tbl_search where id='".base64_decode($_GET['save'])."'";
	$db_save = $obj->select($select_save);
	$sql = $db_save[0]['Search'];
	$sql2 = $db_save[0]['total_search'];
	$_SESSION['Search_query']=$sql;
	$_SESSION['SearchCookie'] = $db_save[0]['json_data'];
	$_SESSION['ClearCookie'] = $db_save[0]['json_data'];
	$search_coockie_data = $_SESSION['SearchCookie'];
	$search_coockie_data = json_decode(stripslashes($search_coockie_data),true);
}
$conditions = "1=1 AND members.status = 'Active'";
$right_join = '';
if(!empty($_POST['Search_rdGender']) || $search_coockie_data['Search_rdGender']!='')
{
	$gender=$search_coockie_data['Search_rdGender'];
	$conditions .= " AND gender = '".$gender."'";
}
if((!empty($_POST['Search_from_age']) && !empty($_POST['Search_to_age'])) || ($search_coockie_data['Search_from_age']!='' && $search_coockie_data['Search_to_age']!=''))
{
	$from_age=$search_coockie_data['Search_from_age'];
	$to_age=$search_coockie_data['Search_to_age'];
	
	$conditions .= ' AND (age between ' .$from_age." and ".$to_age.")";
}
if((!empty($_POST['Search_from_drpHeight']) && !empty($_POST['Search_to_drpHeight'])) || ($search_coockie_data['Search_from_drpHeight']!='' && $search_coockie_data['Search_to_drpHeight']!=''))
{
	
	$from_height=$search_coockie_data['Search_from_drpHeight'];
	$to_height=$search_coockie_data['Search_to_drpHeight'];
	$height_from="select * from height where Id='".$from_height."'";
	$db_height_from=$obj->select($height_from);
	
	$height_to="select * from height where Id='".$to_height."'";
	$db_height_to=$obj->select($height_to);
	
	$conditions .= ' AND (height between '.$from_height.' AND '.$to_height.')';
	
	
	$right_join .= ' RIGHT JOIN height on members.height=height.Id';
	
}
if(count($_POST['Search_chk_marital_status'])>0 || count($search_coockie_data['Search_chk_marital_status'])>0)
{
	$marital_status=$search_coockie_data['Search_chk_marital_status'];
	
	$j=0;
	for($k=0;$k<count($marital_status);$k++)
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
if($_POST['Search_drpReligion']!='' || $search_coockie_data['Search_drpReligion']!='')
{
	$religion=$search_coockie_data['Search_drpReligion'];
	$conditions .= " AND religion = '".$religion."'";
}
if((count($_POST['Search_drpMotherTongue'])>0 && $_POST['Search_drpMotherTongue'][0]!='') || (count($search_coockie_data['Search_drpMotherTongue'])>0 && $search_coockie_data['Search_drpMotherTongue'][0]!=''))
{
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
if($_POST['drpCaste']!='' || $search_coockie_data['drpCaste']!='')
{
	$cast=$search_coockie_data['drpCaste'];
	$conditions .= " AND caste = '".$cast."'";
}
if($_POST['Search_drpCountry']!='' || $search_coockie_data['Search_drpCountry']!='')
{
	$country=$search_coockie_data['Search_drpCountry'];
	$conditions .= " and country = '".$country."'";
}
if((count($_POST['Search_drpEducation'])>0 && $_POST['Search_drpEducation'][0]!='') || (count($search_coockie_data['Search_drpEducation'])>0 && $search_coockie_data['Search_drpEducation'][0]!=''))
{
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
	
	$keyword=$search_coockie_data['txtKeyword'];
	
		$sele_education = "select * from education_course where Title like '%".$keyword."%'";
		$db_select_edu = $obj->select($sele_education);
		if(count($db_select_edu)!=0)
		{ $conditions .= " AND (members.name like '%".$keyword."%' or  
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
		
	$conditions .= " AND (members.name like '%".$keyword."%' or  
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
if($_POST['advanced_drpOccupation'] != "" || $search_coockie_data['advanced_drpOccupation'] != "")
{
	
	$occupation=$search_coockie_data['advanced_drpOccupation'];
	
	$conditions .= " AND occupation = '".$occupation."'";		
}
if($_POST['advanced_drpIncome'] != "" || $search_coockie_data['advanced_drpIncome'] != "")
{
	if($_POST['advanced_drpIncome'] != "" )
		$income=$search_coockie_data['advanced_drpIncome'];
		
	$conditions .= " AND annual_income = '".$income."'";	
}
if($_POST['advanced_drpStar'] != "" || $search_coockie_data['advanced_drpStar'] != "")
{
	$star=$search_coockie_data['advanced_drpStar'];
	$conditions .= " AND star = '".$star."'";	
}
if(($_POST['advanced_rdManglik'] != "Any" && $_POST['advanced_rdManglik'] != '') || ($search_coockie_data['advanced_rdManglik'] != "Any" && $search_coockie_data['advanced_rdManglik'] != ''))
{
	$manglik=$search_coockie_data['advanced_rdManglik'];
	$conditions .= " AND manglik_dosham = '".$manglik."'";
}
if((!empty($_POST['soulmate_chkInterest'])) || count($search_coockie_data['soulmate_chkInterest'])>0)
{
	
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
	$search_by_id=$search_coockie_data['txt_by_id'];
		
	$conditions .= " AND (members.member_id = '".$search_by_id."' or  members.id = '".$search_by_id."')";
}
if($_POST['chk_with_photo'] == 1 || $search_coockie_data['chk_with_photo'] == 1)
{	
	$conditions.= " AND member_photos.photo !='' and member_photos.Approve=1";
}
if($_POST['chk_with_horoscope']== 1 || $search_coockie_data['chk_with_horoscope'] == 1)
{
	$conditions.= " AND members.horoscope_match != ''";
}
if(!empty($_SESSION['logged_user'][0]['id']))
{					
	$conditions.= " AND members.id != '".$_SESSION['logged_user'][0]['id']."'";					
}
if(isset($_POST['txt_by_id']))
{
	$sql = "SELECT * from members where member_id='".$_POST['txt_by_id']."'";
	$db_member = $obj->select($sql);
	
	if(count($db_member)>0)
	{
		echo '<script>window.location.href="view_profile.php?id='.$db_member[0]['id'].'"</script>';
	}
}
if(!empty($_POST))
{
$sql = "SELECT members.*,member_photos.photo, member_photos.Approve, chat_users.status as chat_status FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id ".$right_join." LEFT JOIN chat_users on chat_users.email = members.email_id WHERE ".$conditions." order by members.last_login desc, members.id desc";
//echo $sql;
$_SESSION['Search_query']=$sql;
$sql2 = "SELECT members.*,member_photos.photo, member_photos.Approve, chat_users.status as chat_status FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id ".$right_join." LEFT JOIN chat_users on chat_users.email = members.email_id WHERE ".$conditions." order by members.last_login desc, members.id desc";
}
if((!empty($_POST['regular_search_save']) && $_POST['regular_search_save']!='') || (!empty($_POST['keyword_search_save']) && $_POST['keyword_search_save']!='') || (!empty($_POST['advanced_search_save']) && $_POST['advanced_search_save']!=''))
{
	$insert_search = "insert into tbl_search(Id,Member_id,Search_lable, Search, json_data, total_search) values(null,'".$_SESSION['logged_user'][0]['id']."', '".$_POST['regular_search_save']."', '".addslashes($sql)."', '".addslashes($_SESSION['SearchCookie'])."', '".addslashes($sql2)."')";
	$db_search=$obj->insert($insert_search);
}
if(!empty($_POST['regular_search']) || !empty($_POST['advanced_search']) || !empty($_POST['keyword_search']) || !empty($_POST['txt_by_id']) || (!empty($_POST['regular_search_save']) && $_POST['regular_search_save']!='') || (!empty($_POST['keyword_search_save']) && $_POST['keyword_search_save']!='') || (!empty($_POST['advanced_search_save']) && $_POST['advanced_search_save']!='') || (isset($_GET['save']) && ($_GET['save']!='')))
{
	$select_last = "select session_id from clear_search where session_id='".session_id()."'";
	$db_select_user = $obj->select($select_last);
	if(count($db_select_user)==0)
	{
		$insert_search='insert into clear_search(Id, session_id, search, total_search)value(null, "'.session_id().'", "'.addslashes($sql).'", "'.addslashes($sql2).'")';
		$db_search=$obj->insert($insert_search);
		//echo $insert_search;
	}
	else
	{
		$update_serch = "update clear_search set search='".addslashes ($sql)."', total_search= '".addslashes($sql2)."' where session_id='".session_id()."'";
		$db_update = $obj->edit($update_serch);
		//echo $update_serch;
	}
}
if(isset($_GET['save']) && ($_GET['save']!=''))
{
	$sql .= " limit 0,8";
	$members = $obj->select($sql);
	$members2 = $obj->select($sql2);
}
elseif(isset($_GET['clear']) && ($_GET['clear']=='all'))
{
	$select_last = "select * from clear_search where session_id='".session_id()."'";
	$db_select_last = $obj->select($select_last);
	$sql=$db_select_last[0]['search'];
	$sql2=$db_select_last[0]['total_search'];
	$_SESSION['Search_query']=$sql;
	$sql .= " limit 0,8";
	$members = $obj->select($sql);
	$members2 = $obj->select($sql2);
}
elseif(!empty($_POST))
{  
//echo $sql;    
$sql .= " limit 0,8";
$members = $obj->select($sql);
$members2 = $obj->select($sql2);
}
?>
<div  class="mid col-md-12 col-sm-12 col-xs-12 nopadding" style="position:relative;">
<div class="loader" style="display:none;">
<img src="images/bigloader.gif" alt="" />
</div>
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
<div class="sidebar col-md-3 col-xs-12 col-sm-4">
        	<div class="sidebar-main">
            	<h2>Refine Search<a href="load_data.php?clear=all" style="float:right; font-size:12px; color:red;">Clear All</a></h2>
                <form action="" method="post" name="profileform" id="profileform">
                <div class="sidebar-cont" id="acc-list">
                	<div class="list-toggle">
                        <h3>Profile Type</h3>
                        <ul>
                        	<li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox">
                                           <div class="searchbubbleboxin">
											<label><input type="checkbox" id="chk_with_photo"  name="chk_with_photo"<?php if($search_coockie_data['chk_with_photo']==1){ ?> checked="checked" <?php } ?> onchange="refine_search()" />With Photo (<span id="withphoto_1"></span>)</label>
                                            <label><input type="checkbox" id="chk_with_horoscope" name="chk_with_horoscope"<?php if($search_coockie_data['chk_with_horoscope']==1){ ?> checked="checked" <?php } ?> onchange="refine_search()"/>With Horoscope (<span id="horoscope1_1"></span>)</label>
                                            </div>
                                           
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Age</h3>
                        <ul>
                            <li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox">                      	
                                           
                                            <div class="searchbubbleboxin">
                                            <input type="text" class="age1" name="Search_from_age" id="Search_from_age" value="<?php if(isset($search_coockie_data['Search_from_age'])) { echo $search_coockie_data['Search_from_age']; } else {echo 18; } ?>">
                                            <span class="bet_text">to</span>
                                            <input type="text" class="age1" name="Search_to_age" id="Search_to_age" value="<?php if(isset($search_coockie_data['Search_to_age'])) { echo $search_coockie_data['Search_to_age']; } else { echo 40; } ?>">
                                            <span class="bet_text">years</span>
                                            </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Height</h3>
                        <ul>
                           <li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-height">
                                          
                                            <div class="searchbubbleboxin">
                                            <select class="sel-height" name="Search_from_drpHeight" id="Search_from_drpHeight">
                                               	    <?php 
													$select_height="select * from height";
													$db_height=$obj->select($select_height);
													for($i=0;$i<count($db_height);$i++){
													?>
												   <option value="<?php echo $db_height[$i]['Id']; ?>" <?php if($db_height[$i]['Id']==$from_height) { ?> selected="selected"<?php } ?>><?php echo $db_height[$i]['Ft_val'].'ft '.$db_height[$i]['In_val'].'in'; if($db_height[$i]['Cm_val']!=''){ echo ' - '.$db_height[$i]['Cm_val'].'cm'; } ?></option>
												   <?php } ?>
                                            </select>
                                            <span class="bet_text">to</span>
                                            <select class="sel-height" name="Search_to_drpHeight" id="Search_to_drpHeight">
                                               	   <?php for($j=0;$j<count($db_height);$j++) {	?>
												   <option value="<?php echo $db_height[$j]['Id']; ?>"  <?php if(isset($to_height)) { if($db_height[$j]['Id']==$to_height) { ?> selected="selected"<?php } } elseif($db_height[$j]['Id']==(count($db_height)+1)) { ?> selected="selected"<?php } ?>><?php echo $db_height[$j]['Ft_val'].'ft '.$db_height[$j]['In_val'].'in'; if($db_height[$j]['Cm_val']!=''){ echo ' - '.$db_height[$j]['Cm_val'].'cm'; } ?></option>
												   <?php } ?>
                                            </select>
                                            </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Marital Status</h3>
                        <ul>
                            <li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-marit">                      	
                                        
                                            <div class="searchbubbleboxin">
                                            <label><input type="checkbox" id="unmarried_status" name="Search_chk_marital_status[]" value="Unmarried" <?php if(in_array('Unmarried',$marital_status)){ ?> checked="checked" <?php } ?> onchange="refine_search()"/>Unmarried (<span id="unmarried"></span>)</label>
                                            <label><input type="checkbox" id="widow_status" name="Search_chk_marital_status[]" value="Widowed" <?php if(in_array('Widow',$marital_status)){ ?> checked="checked" <?php } ?> onchange="refine_search()"/>Widow (<span id="widow"></span>)</label>
                                            <label><input type="checkbox" id="divorced_status" name="Search_chk_marital_status[]" value="Divorced" <?php if(in_array('Divorced',$marital_status)){ ?> checked="checked" <?php } ?> onchange="refine_search()"/>Divorced (<span id="divorced"></span>)</label>
                                            <!--<label><input type="checkbox" id="awaiting-divorced_status" name="Search_chk_marital_status[]" value="Awaiting divorce" <?php //if(in_array('Awaiting divorce',$marital_status)){ ?> checked="checked" <?php //} ?> onchange="refine_search()"/>Awaiting Divorce (<span id="aw-divorced"></span>)</label>-->
                                            </div>
                                           <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Religion</h3>
                        <ul>
							<li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">                	
                                           <!--<div class="input-refsbox"><input type="text" /></div>-->
                                            <div class="searchbubbleboxin">
                                            <label><input type="radio" id="any" value="" name="Search_drpReligion" class="Search_drpReligion" <?php if($search_coockie_data['Search_drpReligion']=='') { ?> checked="checked"<?php } ?> onchange="change_religion(); refine_search();"/>Any</label>
                                           <?php
												$religion_list="select * from religions";
												$db_religion=$obj->select($religion_list);
												foreach($db_religion as $rel) { ?>
                                         <label><input type="radio" id="<?php echo $rel['religion']; ?>" value="<?php echo $rel['religion']; ?>" name="Search_drpReligion" class="Search_drpReligion" <?php if($search_coockie_data['Search_drpReligion']==$rel['religion']) { ?> checked="checked"<?php } ?> onchange="change_religion(); refine_search();"/><?php echo $rel['religion']; ?></label>
											<?php } ?>
                                           </div>
                                           <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                    
                    <div class="list-toggle" >
                        <h3>Cast</h3>
                        <ul id="caste_box">
							<li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">                	
                                            <!--<div class="input-refsbox"><input type="text" /></div>-->
                                            <div class="searchbubbleboxin">
                                           <?php
										   if($search_coockie_data['Search_drpReligion']!='') {
											$select_religion_id = "select id from religions where religion='".$search_coockie_data['Search_drpReligion']."'";													 											$db_religion = $obj->select($select_religion_id);
												
											$caste_list="select * from caste where religion_id='".$db_religion[0]['id']."' order by caste";
											$db_caste=$obj->select($caste_list);
												for($i=0;$i<count($db_caste);$i++) { ?>
                                         <label><input type="checkbox" class="caste_chk" value="<?php echo $db_caste[$i]['caste']; ?>" name="drpCaste[]" <?php if($search_coockie_data['drpCaste']==$db_caste[$i]['caste']) { ?> checked="checked"<?php } ?> onchange="refine_search()"/><?php echo $db_caste[$i]['caste']; ?></label>
											<?php } } else { 
											
											 $all_caste_list="select * from caste order by religion_id";
											$all_caste=$obj->select($all_caste_list);
											for($i=0;$i<count($all_caste);$i++)  { ?>
<label><input type="checkbox" class="caste_chk" <?php if($search_coockie_data['drpCaste'] == $all_caste[$i]['caste']) { ?> checked="checked"<?php } ?> value="<?php echo $all_caste[$i]['caste']; ?>" name="drpCaste[]" onchange="refine_search()"/><?php echo $all_caste[$i]['caste']; ?></label>
                               				<?php } } ?>
                                           </div>
                                           <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                    
                    
                    <div class="list-toggle">
                        <h3>Mother Tongue</h3>
                        <ul>
                            <li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">
                                            
                                            <!--<div class="input-refsbox"><input type="text" /></div>-->
                                            <div class="searchbubbleboxin">
                                           <?php
                                                $lang_list="select * from mother_tongues";
                                                $languages=$obj->select($lang_list);
												
                                                foreach($languages as $lang)
                                                { ?>
                                                 <label><input type="checkbox" name="Search_drpMotherTongue[]" value="<?php echo $lang['name']; ?>" <?php if($search_coockie_data['Search_drpMotherTongue'][0]==$lang['name']) { ?> checked="checked"<?php } ?> onchange="refine_search()"/><?php echo $lang['name']; ?></label>
                                                 
                                            <?php } ?>
                                            </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Education</h3>
                        <ul>
                            <li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">
                                            
                                            <!--<div class="input-refsbox"><input type="text" /></div>-->
                                            <div class="searchbubbleboxin">
                                            <?php
												$level="SELECT * FROM `education_details`";
												$sel=$obj->select($level);
												
												for($i=0;$i<count($sel);$i++)
												{
												 ?>
                                         <label><input type="checkbox" name="Search_drpEducation[]" value="<?php echo $sel[$i]['id'];?>" <?php if($search_coockie_data['Search_drpEducation'][0]==$sel[$i]['id']) { ?> checked="checked"<?php } ?> onchange="refine_search()"/><?php echo $sel[$i]['degree']; ?></label>
                                                <?php } ?>
                                             </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Country</h3>
                        <ul>
                            <li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">
                                            
                                            <!--<div class="input-refsbox"><input type="text" /></div>-->
                                            <div class="searchbubbleboxin">
                                            <?php
												$country_list="select * from mobile_codes";
												$country=$obj->select($country_list);
												
												for($i=0;$i<count($country);$i++)
												{
												 ?>
                                         <label><input type="checkbox" name="Search_drpCountry[]" value="<?php echo $country[$i]['country'];?>" <?php if($search_coockie_data['Search_drpCountry']==$country[$i]['country']) { ?> checked="checked"<?php } ?> onchange="refine_search()"/><?php echo $country[$i]['country']; ?></label>
                                                <?php } ?>
                                             </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Occupassion</h3>
                        <ul>
                            <li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox sbox-rel">
                                            
                                            <!--<div class="input-refsbox"><input type="text" /></div>-->
                                            <div class="searchbubbleboxin">
                                            <?php
												$occu_list="select * from occupation_master";
												$occupation=$obj->select($occu_list);
												
												for($i=0;$i<count($occupation);$i++)
												{
												 ?>
                                         <label><input type="checkbox" name="advanced_drpOccupation[]" value="<?php echo $occupation[$i]['occupation'];?>" <?php if($search_coockie_data['advanced_drpOccupation']==$occupation[$i]['occupation']) { ?> checked="checked"<?php } ?> onchange="refine_search()"/><?php echo $occupation[$i]['occupation']; ?></label>
                                                <?php } ?>
                                             </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Profile Created For</h3>
                        <ul>
                            <li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox">
                                            
                                            <!--<div class="input-refsbox"><input type="text" /></div>-->
                                            <div class="searchbubbleboxin">
											<label><input type="checkbox" value="Myself" id="myself_status" name="created_for[]" onchange="refine_search()"/>Myself (<span id="myself"></span>)</label>
                                            <label><input type="checkbox" value="Son" id="sun_status" name="created_for[]"  onchange="refine_search()"/>Son (<span id="son"></span>)</label>
                                            <label><input type="checkbox" value="Daughter" id="daughter_status" name="created_for[]" onchange="refine_search()"/>Daughter (<span id="daughter"></span>)</label>
                                            <label><input type="checkbox" value="Brother" id="brother_status" name="created_for[]" onchange="refine_search()"/>Brother (<span id="brother"></span>)</label>
                                            <label><input type="checkbox" value="Sister" id="sister_status" name="created_for[]" onchange="refine_search()"/>Sister (<span id="sister"></span>)</label>
                                            <label><input type="checkbox" value="Relative" id="relative_status" name="created_for[]" onchange="refine_search()"/>Relative (<span id="relative"></span>)</label>
                                            <label><input type="checkbox" value="Friend" id="friend_status" name="created_for[]" onchange="refine_search()"/>Friend (<span id="friend"></span>)</label>
                                            </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                    
                    <div class="list-toggle">
                        <h3>Online Status</h3>
                        <ul>
                        	<li class="morelink">
                                    <div class="searchby">
                                        <div class="searchbubblebox">
                                           
                                            <div class="searchbubbleboxin">
											<label><input type="checkbox" id="rdbOnline" name="online_data[]" value="1" onchange="refine_search()"/>Online members (<span id="count_online"></span>)</label>
                                            <label><input type="checkbox" id="rdbOffline" name="online_data[]" value="0" onchange="refine_search()"/>Offline members (<span id="count_offline"></span>)</label>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                         	</li>
                        </ul>
                    </div>
                </div>
                <input type="hidden" value="grid" name="view" id="listgridview">
                <input type="hidden" value="1" name="offset2" id="offset2">
                <input type="button" value="Search" name="refine_submit_btn" onclick="refine_search()" class="submit_btn_new_small" />
                </form>
            </div>
        </div>
        
 <div class="content col-sm-8 col-xs-12 col-md-9" id="content_data">
 <div class="mid_top_checkbox" style="clear: both;margin: 19px;float: right;margin-top: 0;"><span style="float:left; margin-right:15px; font-weight:bold"">Total Profiles : <?php echo count($members2); ?></span><a href="javascript:;" class="list_view">List View</a><a href="javascript:;" class="grid_view">Grid View</a></div><br clear="all" />     
        <input type="hidden" value="<?php echo count($members2); ?>" name="ttl_profile" id="ttl_profile">
                <input type="hidden" value="8" name="limit" id="limit">
                <input type="hidden" value="1" name="offset" id="offset">
                
         <ul class="profl-list" id="refine_data">
            <?php
					for($j=0;$j<count($members2);$j++)
					{
						if($members2[$j]['horoscope_match'] != ''){
						 $horoscope1 = $horoscope1 +1; 
						}
						
						if($members2[$j]['relationship_status'] == 'UnMarried'){
							$unmarrid = $unmarrid +1; 
						}
						if($members2[$j]['relationship_status'] == 'Widowed'){
							$widow = $widow +1; 
						}
						if($members2[$j]['relationship_status'] == 'Divorced'){
							$divorced = $divorced +1; 
						}
						/*if($members2[$j]['relationship_status'] == 'Awaiting Divorce'){
							$aw_divorced = $aw_divorced +1; 
						}*/
						
						if($members2[$j]['profile_for'] == 'Myself'){
							$my_self = $my_self +1; 
						}
						if($members2[$j]['profile_for'] == 'Daughter'){
							$daughter = $daughter +1; 
						}
						if($members2[$j]['profile_for'] == 'Son'){
							$son = $son +1; 
						}
						if($members2[$j]['profile_for'] == 'Brother'){
							$brother = $brother +1; 
						}
						if($members2[$j]['profile_for'] == 'Sister'){
							$sister = $sister +1; 
						}
						if($members2[$j]['profile_for'] == 'Relative'){
							$relative = $relative +1; 
						}
						if($members2[$j]['profile_for'] == 'Friend'){
							$friend = $friend +1; 
						}
						
						if($members2[$j]['chat_status'] == '1')
						{
							$count_online = $count_online+1;
						}
						else
						{
							$count_offline = $count_offline+1;
						}
						if((!empty($members2[$j]['photo'])) && ($members2[$j]['Approve'] == 1))
						{
						 	$path = "upload/".$members2[$j]['photo'];
							
							if (file_exists($path)) {
									
							$withphoto=$withphoto+1;
									
							}
							
						}
					}
					for($i=0;$i<count($members);$i++) { 	?>
            	<li id="<?php echo $members[$i]['id']; ?>">
                    <div class="profile-img-box">
                    <a href="view_profile.php?id=<?php echo $members[$i]['id']; ?>" target="_blank" class="popper" data-popbox="pop<?php echo $members[$i]['id']; ?>">
                     <?php 
$membership="<label style='background:none; text-align:left; font-weight:bold; color:#000; font-size:14px; height:20px; color:#000; padding-bottom:5px;'>".$members[$i]['member_id']."</label>";
							
					echo $membership;
							?>
                        <?php
						if((!empty($members[$i]['photo'])) && ($members[$i]['Approve'] == 1))
						{
						 	$path = "upload/".$members[$i]['photo'];
							list($width, $height, $type, $attr) = getimagesize($path);
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
									
							echo '<img title="" data-popbox="pop'.$members[$i]['id'].'" class="profile_pic popper" src="'.$path.'" />';
		echo '<div id="pop'.$members[$i]['id'].'" class="popbox"><img src="'.$path.'" width="100%" height="'.$height.'" /></div>';
								//$withphoto=$withphoto+1;
									//echo '<div id="pop'.$members[$i]['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" /></div>';
							}
							else{
								if($members[$i]['gender']=='M')
									echo '<img title="" class="profile_pic" src="images/male-user1.png" />';
								else
									echo '<img title="" class="profile_pic" src="images/female-user1.png" />';
							}
						}
						else{
								if($members[$i]['gender']=='M')
									echo '<img title="" class="profile_pic" src="images/male-user1.png" />';
								else
									echo '<img title="" class="profile_pic" src="images/female-user1.png" />';
							}?>
                            
                        
                        <div class="griddetail">
                        	<div style="overflow:hidden;"><b><?php echo ucfirst($members[$i]['name']); ?></b></div>
							<div><?php echo $members[$i]['age'] ?> 
							<?php if($members[$i]['height'] != '') {  
                            		$select_height="select * from height where Id='".$members[$i]['height']."'";
									$db_height=$obj->select($select_height);
									echo ' / '.$db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
									if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }
								} ?>
                            </div>
						</div>
						<div class="listdetail">
                        	<div><label>Name : </label><?php echo ucfirst($members[$i]['name']); ?></div>
                           <div><label>Age / Height : </label><?php echo $members[$i]['age'] ?> 
                            	<?php if($members[$i]['height'] != '') {  
                            		$select_height="select * from height where Id='".$members[$i]['height']."'";
									$db_height=$obj->select($select_height);
									echo ' / '.$db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
									if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }
								} ?>
                            </div>
                            <div><label>Religion : </label><?php echo $members[$i]['religion'] ?></div>
                            <div><label>Caste / Subcaste : </label><?php echo $members[$i]['caste'] ?> / <?php echo $members[$i]['subcaste'] ?></div>
                            <div><label>Location : </label><?php if($members[$i]['city'] != '') { echo $members[$i]['city'].", "; } ?><?php if($members[$i]['state'] != '') { echo $members[$i]['state'].", "; } ?><?php if($members[$i]['country'] != '') { echo $members[$i]['country']; } ?></div>
                            <div><label>Education : </label>
								<?php //echo $members[$i]['education'] ?>
                                <?php
								$select_education="select * from education_course where Id='".$members[$i]['education']."'";
								$db_education=$obj->select($select_education);
								echo $db_education[0]['Title'];
								?>&nbsp;
                            </div>
                            <div><label>Occupation : </label><?php echo $members[$i]['occupation'] ?></div>
						</div>
</a>
						<div class="goto">
                        	<?php
							if($_SESSION['logged_user'][0]['member_id']!='')
							{
								$select_express_intrest="select * from express_interest where from_mem='".$_SESSION['logged_user'][0]['member_id']."' AND to_mem='".$members[$i]['member_id']."'";
								$db_express_intrest=$obj->select($select_express_intrest);
								
								$user1 = "select * from members where member_id = '".$_SESSION['logged_user'][0]['member_id']."' AND Status = 'Active'";
								$db_user1 = $obj->select($user1);
								if(count($db_express_intrest)==0 && $_POST['Search_rdGender'] != $db_user1[0]['gender']){
								?>
                               <a id="chk_express<?php echo $members[$i]['member_id']; ?>" href="javascript:;" onclick="check_express_interest('<?php echo $members[$i]['member_id'] ?>','<?php echo $_SESSION['logged_user'][0]['member_id'] ?>', 2, '<?php echo $members[$i]['id'] ;?>')" class="icon-heart"></a>
                                <a id="success_msg<?php echo $members[$i]['id'] ;?>" href="include/view_success_msg.php?id=<?php echo $members[$i]['id']?>" class="ajax3 send_email_btn" style="display:none">
								<?php }elseif($_POST['Search_rdGender'] == $db_user1[0]['gender']){ ?>
                                <a href="javascript:;" class="same_gender icon-heart"></a>
								<?php  }elseif($db_express_intrest[0]['is_accepted']=='Y') { ?>
								<a href="javascript:;" class="alredy_received icon-red-heart"></a> 
                                <?php  }elseif($db_express_intrest[0]['is_more_time']=='1') { ?>
                                <a href="javascript:;" class="is_more_time icon-red-heart"></a>
                                <?php  }elseif($db_express_intrest[0]['is_more_info']=='1') { ?>  
                                <a href="javascript:;" class="is_more_info icon-red-heart"></a>
                                <?php } else { ?>
                                <a href="javascript:;" class="alredy_sent icon-red-heart"></a>      
                              	<?php } ?>
                                
                                <?php
								$select_chat_users="select * from chat_users where status='1' AND email='".$members[$i]['email_id']."'";
								$db_chat_user=$obj->select($select_chat_users);
								?>
                                 <input type="hidden" id="count_view_mob" value="<?php echo $db_logged[0]['view_mobile'];?>"> 
                                 <input type="hidden" id="count_view_msg" value="<?php echo $db_logged[0]['num_send_msg'];?>"> 
                                <?php if($db_logged[0]['view_mobile']>$db_user_plan[0]['no_of_contacts']) { ?>
								 <a <?php if($_SESSION['Member_status']=='Paid'){ ?>href="javascript:;" class="exid_mobile icon-gift-online"<?php } else { ?> href="javascript:;" class="paid_error icon-gift-online"<?php } ?>></a>
                                 <?php } else { ?>
                                <?php if(count($db_chat_user)==0){ ?>
                                      
<a <?php if($_SESSION['Member_status']=='Paid'){ ?>href="include/view_mobile.php?id=<?php echo $members[$i]['id'] ;?>" class="icon-gift-offline ajax1 send_email_btn"<?php } else { ?> href="javascript:;" class="icon-gift-offline paid_error" <?php } ?> id="view_moblie_cnt<?php echo $members[$i]['id'] ;?>"></a>
                                <?php }else{ ?>
                                <a href="include/view_mobile.php?id=<?php echo $members[$i]['id'] ;?>" class="icon-gift-online ajax1 send_email_btn"></a>
                                <?php } ?>
                                <?php } ?>
                               
                                <?php if($db_logged[0]['num_send_msg']>$db_user_plan[0]['allow_messages']) { ?>
<a <?php if( $_SESSION['Member_status']=='Paid'){ ?>href="javascript:;" class="exid_msg icon-mail"<?php } else { ?> href="javascript:;" class="paid_error icon-mail"<?php } ?>></a>
                                <?php } else { ?>
<a <?php if( $_SESSION['Member_status']=='Paid'){ ?>href="include/send_message.php?id=<?php echo $members[$i]['id']; ?>&email=<?php echo $members[$i]['email_id']; ?>&to_mem_id=<?php echo $members[$i]['member_id']; ?>" class="ajax send_email_btn icon-mail" <?php } else { ?> href="javascript:;" class="paid_error icon-mail" <?php } ?>></a>
                                
                                <?php } ?>
					
                                <?php
								$sonline="select * from chat_users where email='".$members[$i]['email_id']."' and status='1'";
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
                    </div>
                </li>
                <?php } ?>
            </ul>
            <div class="refine" style="display:none">
            	<img src="images/bigloader.gif" alt="" />
            </div>
            </div> 
    <?php } else { ?>
<a href="javascript:;" id="none_result" class="none_result">
<script type="text/javascript">
$(document).ready(function(){
	$('#cboxClose').addClass('none_result');
	$('#none_result').trigger("click");
	
	if($('#cboxClose').hasClass('none_result'))
	{
		$('#cboxClose').click(function() {
				window.location.href='search.php';	
			});
	}
});	
</script>
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
<div style="margin: 10px 0px 20px 0px;">
<a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a>
</div>
<?php } } } ?>
</div>  
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
	/*$('#aw-divorced').html('<?php //echo $aw_divorced; ?>');*/
	$('#myself').html('<?php echo $my_self; ?>');
	$('#daughter').html('<?php echo $daughter; ?>');
	$('#son').html('<?php echo $son; ?>');	
	$('#brother').html('<?php echo $brother; ?>');	
	$('#sister').html('<?php echo $sister; ?>');	
	$('#relative').html('<?php echo $relative; ?>');
	$('#friend').html('<?php echo $friend; ?>');
	$('#count_online').html('<?php echo $count_online; ?>');
	$('#count_offline').html('<?php echo $count_offline; ?>');
});
</script>
<script>
function refine_search()
	{
		var offset2=$('#offset2').val();
		if(offset2==1)
		{
			$('.loader').css('display','block');
			$('#offset2').val(0);
		var form = $('#profileform');
		$.ajax({
				url:'ajax_refine_search.php',
				data:form.serialize(),
				type:'POST',
				cache:true,
				success: function(data)
				{
					var strView = $("#listgridview").val();
					$('#offset2').val(1);
					$('.loader').css('display','none');
					
					$('#content_data').html(data);
					
					$(".ajax").colorbox({innerWidth:"500px;", maxWidth:"500px;"});
					$(".ajax1").colorbox({innerWidth:"450px;", maxWidth:"450px;", innerHeight:"200px;"});
					$(".ajax3").colorbox({innerWidth:"450px;", maxWidth:"450px;"});
					$(".user_offline").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "This user is offline."});
					$(".paid_error").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"130px;", height:"130px;", xhrError: "This feature is available for paid member."});
					$(".exid_mobile").colorbox({innerWidth:"500px;", maxWidth:"500px;", innerHeight:"130px;", height:"130px;", xhrError: "Sorry! You exceed maximum number of mobile from your plan."});
					$(".exid_msg").colorbox({innerWidth:"500px;", maxWidth:"500px;", innerHeight:"130px;", height:"130px;", xhrError: "Sorry! You exceed maximum number of message from your plan."});
					$(".same_gender").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"130px;", height:"130px;", xhrError: "Interest can not be send to same gender."});
					$(".alredy_sent").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Interest sent."});

					$(".alredy_received").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Your Interest is Accepted."});
					
					$(".is_more_time").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Need more time to respond."});
			
					$(".is_more_info").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Need more info to respond."});
					$(".none_result").colorbox({innerWidth:"500px;", maxWidth:"500px;", innerHeight:"130px;", height:"130px;", xhrError: "Sorry, we couldn't find any results to suit your search criteria. Please update your search criteria."});
					if(strView == 'list')
					{
						$('.profl-list').fadeOut('slow','',function(){

							$('.profl-list').addClass('thumb_view');	
			
							$('.profl-list').fadeIn('slow');
							$("#listgridview").val('list');
			
						});
					}
					else
					{
						$('.profl-list').fadeOut('slow','',function(){
							$('.profl-list').removeClass('thumb_view');	
							$('.profl-list').fadeIn('slow');
						});
					}
					$("#refine_data").show();
				}
			});	
		}
		
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



	$( "#Search_to_age" ).keyup(function(e) {
		var from_age = $('#Search_from_age').val();
		var to_age = $('#Search_to_age').val();
		if(e.keyCode==13 && (parseInt(to_age)>parseInt(from_age)))
		{
			$('.submit_btn_new_small').trigger('click');
		}
	});

	$( "#Search_from_age" ).keyup(function(e) {
		var from_age = $('#Search_from_age').val();
		var to_age = $('#Search_to_age').val();
		if(e.keyCode==13 && (parseInt(to_age)>parseInt(from_age)))
		{
			$('.submit_btn_new_small').trigger('click');
		}
	});

	$('#Search_from_drpHeight').change(function(e) {
		//alert('x');
     	var height_from = $('#Search_from_drpHeight').val();
		var height_to = $('#Search_to_drpHeight').val(); 
		if(parseInt(height_from) < parseInt(height_to)) 
		{
			$('.submit_btn_new_small').trigger('click');
		} 
    });
	
	$('#Search_to_drpHeight').change(function(e) {
     	var height_from = $('#Search_from_drpHeight').val();
		var height_to = $('#Search_to_drpHeight').val(); 
		if(parseInt(height_from) < parseInt(height_to)) 
		{
			$('.submit_btn_new_small').trigger('click');
		} 
    });
</script>
     