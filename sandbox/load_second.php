<?php
if(isset($_POST['send_msg']))
{
	$dt=date('Y-m-d h:i:s');
 $insert="INSERT into messages(id, from_mem,to_mem,message, parent_id, is_replied, interested, is_read, send_date)values(NULL,'".$_POST['from_member_id']."','".$_POST['to_member_id']."','".$_POST['message']."', '1', 'N', 'Y', '0', '".$dt."')";
 $db_ins=$obj->insert($insert);
 
 $update_mob_counter = "update members set num_send_msg='".($_POST['num_send_msg']+1)."' where member_id='".$_SESSION['logged_user'][0]['member_id']."'"; 
$obj->edit($update_mob_counter);
	echo "<script> window.location.href = 'load_data.php?flag=msg_sent' </script>";
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
	
	$conditions.= " AND member_photos.photo !='' and member_photos.Approve=1";
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
$last_msg_id=$_GET['last_msg_id'];
$sql = "SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id ".$right_join." WHERE ".$conditions." and members.id < '$last_msg_id' order by members.id desc limit 4";
}
if($_GET['clear']=='all' && !isset($_POST['refine_submit_btn']))
{
	$_SESSION['SearchCookie'] = $_SESSION['ClearCookie'];
}

if(isset($_GET['save']) && ($_GET['save']!='') && !isset($_POST['refine_submit_btn']))
{
	$select_save = "select * from tbl_search where id='".$_GET['save']."'";
	$db_save = $obj->select($select_save);
	$_SESSION['SearchCookie'] = $db_save[0]['json_data'];
}

if($_GET['clear']=='all' && !isset($_POST['refine_submit_btn']))
{
	$select_last = "select * from clear_search where session_id='".session_id()."'";
	$db_select_last = $obj->select($select_last);
	$last_msg_id=$_GET['last_msg_id'];
	$sql=$db_select_last[0]['search'];
	$members = $obj->select($sql);
	$last_msg_id="";
}
elseif(isset($_GET['save']) && ($_GET['save']!='') && !isset($_POST['refine_submit_btn']))
{
	$last_msg_id=$_GET['last_msg_id'];
	$sql = $db_save[0]['Search'];
	$members = $obj->select($sql);
	$last_msg_id="";
}
elseif(!empty($_POST) || count($search_coockie_data)>0)
{      
//echo $sql;
$members = $obj->select($sql);
 $last_msg_id="";
}
if(count($members)>0) { 
?>
        <?php if(!empty($members))	{ ?>
           
            <?php
					$t = 0; 
					for($i=0;$i<count($members);$i++)
					{
						//echo"<pre>";print_r($res);
						//count($res['unmarried']);
						
						//echo"<pre>";print_r($res);
						
						//echo"<pre>";print_r($_POST);
						if(isset($_POST['who_online']))
						{
							//echo"test";	
							$chat="select * from chat_users where email='".$members[$i]['email_id']."' and status='1'";
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
							$chat="select * from chat_users where email='".$members[$i]['email_id']."' and status='1'";
							//echo $chat."<br>";
							$db_chat=$obj->select($chat);
							
							//echo count($db_chat)."<br>";
							if(count($db_chat)!=0)
							{
								continue;
							}
						}
						$t++;
						$plan="select * from member_plans where member_id='".$members[$i]['id']."' and paypal_transec_id!=''"; 
						$dbplan=$obj->select($plan);
						if($members[$i]['horoscope_match'] != ''){
						 $horoscope1 = $horoscope1 +1; 
						}
						
						//echo $members[$i]['relationship_status'];
						if($members[$i]['relationship_status'] == 'UnMarried'){
							$unmarrid = $unmarrid +1; 
						}
						if($members[$i]['relationship_status'] == 'Widowed'){
							$widow = $widow +1; 
						}
						if($members[$i]['relationship_status'] == 'Divorced'){
							$divorced = $divorced +1; 
						}
						if($members[$i]['relationship_status'] == 'Awaiting Divorce'){
							$aw_divorced = $aw_divorced +1; 
						}
						
						
						
						if($members[$i]['profile_for'] == 'Myself'){
							$my_self = $my_self +1; 
						}
						if($members[$i]['profile_for'] == 'Daughter'){
							$daughter = $daughter +1; 
						}
						if($members[$i]['profile_for'] == 'Son'){
							$son = $son +1; 
						}
						if($members[$i]['profile_for'] == 'Brother'){
							$brother = $brother +1; 
						}
						if($members[$i]['profile_for'] == 'Sister'){
							$sister = $sister +1; 
						}
						if($members[$i]['profile_for'] == 'Relative'){
							$relative = $relative +1; 
						}
						if($members[$i]['profile_for'] == 'Friend'){
							$friend = $friend +1; 
						}
						
						 ?>
            	<li class="message_box <?php if($i==0) { ?>first<?php } ?>" id="<?php echo $members[$i]['id']; ?>">
                    <div class="profile-img-box">
                    <a href="view_profile.php?id=<?php echo $members[$i]['id']; ?>" target="_blank" class="popper" data-popbox="pop<?php echo $members[$i]['id']; ?>">
                     <?php //$plan="select * from member_plans where member_id='".$members[$i]['id']."'"; 
							//$dbplan=$obj->select($plan);
							//if(count($dbplan)>0)
							//{
$membership="<label style='background:none; text-align:left; font-weight:bold; color:#000; font-size:14px; height:20px; color:#000; padding-bottom:5px;'>".$members[$i]['member_id']."</label>";
							//}
							//else
							//{
//$membership="<label style='background:none; font-weight:bold; color:#000; font-size:12px; height:20px;'>".$members[$i]['member_id']." - Free</label>";
	//						}
					echo $membership;
							?>
                        <?php
						if(!empty($members[$i]['photo']) && $members[$i]['Approve']==1)
						{
						 	//$path =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/".$members[0]['photo'];
							$path = "upload/".$members[$i]['photo'];
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
									//echo '<a href="javascript:;" class="popper" data-popbox="pop'.$members[$i]['id'].'"><img src="'.$path.'" class="profile_pic" style="width:152px;height:161px;" /></a>'; 
							echo '<img title="" data-popbox="pop'.$members[$i]['id'].'" class="profile_pic popper" src="'.$path.'" />';
		echo '<div id="pop'.$members[$i]['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" width="'.$width.'"  height="'.$height.'" /></div>';
								$withphoto=$withphoto+1;
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
                            <?php /*?><label>Membership: </label>
                            <?php $plan="select * from member_plans where member_id='".$members[$i]['id']."'"; 
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
								$select_express_intrest="select * from express_interest where (from_mem='".$_SESSION['logged_user'][0]['member_id']."' AND to_mem='".$members[$i]['member_id']."') or (from_mem='".$members[$i]['member_id']."' AND to_mem='".$_SESSION['logged_user'][0]['member_id']."')";
								$db_express_intrest=$obj->select($select_express_intrest);
								
								/*$accepted_express_intrest="select * from express_interest where from_mem='".$members[$i]['member_id']."' AND to_mem='".$_SESSION['logged_user'][0]['member_id']."'";
								$ac_express_intrest=$obj->select($accepted_express_intrest);*/
								
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
                        
                        <div class="goto" style="display:none">
<a href="javascript:;" class="icon-heart" ></a>
                             <a href="include/express_interest.php?to_mem_id=<?php echo $members[$i]['member_id']; ?>&from_mem_id=<?php echo $_SESSION['logged_user'][0]['member_id']; ?>&site=second">| EI</a>
                           <a class="ajax send_email_btn" href="include/send_message.php?id=<?php echo $members[$i]['id']; ?>&email=<?php echo $members[$i]['email_id']; ?>&to_mem_id=<?php echo $members[$i]['member_id']; ?>">MSG</a>
                        </div>
                    </div>
                </li>
                
                <?php } ?>
         
		    <?php } } else { ?>
				<input type="hidden" value="0" name="no_data_found" id="no_data_found">
			<?php } ?>
		
<?php
	$_SESSION['withphoto'] = $_SESSION['withphoto']+$withphoto;
	$_SESSION['unmarried'] = $_SESSION['unmarried']+$unmarrid;
	$_SESSION['horoscope1']=$_SESSION['horoscope1']+$horoscope1;
	$_SESSION['widow']=$_SESSION['widow']+$widow;
	$_SESSION['divorced']=$_SESSION['divorced']+$divorced;
	$_SESSION['aw_divorced']=$_SESSION['aw_divorced']+$aw_divorced;
	$_SESSION['my_self']=$_SESSION['my_self']+$my_self;
	$_SESSION['daughter']=$_SESSION['daughter']+$daughter;
	$_SESSION['son']=$_SESSION['son']+$son;
	$_SESSION['brother']=$_SESSION['brother']+$brother;
	$_SESSION['sister']=$_SESSION['sister']+$sister;
	$_SESSION['relative']=$_SESSION['relative']+$relative;
	$_SESSION['friend']=$_SESSION['friend']+$friend;
	
	$_SESSION['with_photo_all'] = $_SESSION['with_photo_all']+count($members);
	$_SESSION['with_horo_all'] = $_SESSION['with_horo_all']+count($members);
	$_SESSION['yrs_all'] = $_SESSION['yrs_all']+count($members);
	$_SESSION['height_all'] = $_SESSION['height_all']+count($members);
	$_SESSION['religion_all'] = $_SESSION['religion_all']+count($members);
	$_SESSION['mother_tounge_all'] = $_SESSION['mother_tounge_all']+count($members);
	$_SESSION['degree_all'] = $_SESSION['degree_all']+count($members);
?>

<script>

$(document).ready(function(){
	
	$('#withphoto_1').html('<?php echo $_SESSION['withphoto']; ?>');
	
	$('#horoscope1_1').html('<?php echo $_SESSION['horoscope1']; ?>');
	$('#unmarried').html('<?php echo $_SESSION['unmarried']; ?>');
	$('#widow').html('<?php echo $_SESSION['widow']; ?>');
	$('#divorced').html('<?php echo $_SESSION['divorced']; ?>');
	$('#aw-divorced').html('<?php echo $_SESSION['aw_divorced']; ?>');
	$('#myself').html('<?php echo $_SESSION['my_self']; ?>');
	$('#daughter').html('<?php echo $_SESSION['daughter']; ?>');
	$('#son').html('<?php echo $_SESSION['son']; ?>');	
	$('#brother').html('<?php echo $_SESSION['brother']; ?>');	
	$('#sister').html('<?php echo $_SESSION['sister']; ?>');	
	$('#relative').html('<?php echo $_SESSION['relative']; ?>');
	$('#friend').html('<?php echo $_SESSION['friend']; ?>');
	
	$('#with_photo_all').html('<?php echo $_SESSION['with_photo_all']; ?>');
	$('#with_horo_all').html('<?php echo $_SESSION['with_horo_all']; ?>');
	$('#yrs_all').html('<?php echo $_SESSION['yrs_all']; ?>');
	$('#height_all').html('<?php echo $_SESSION['height_all']; ?>');
	$('#religion_all').html('<?php echo $_SESSION['religion_all']; ?>');
	$('#mother_tounge_all').html('<?php echo $_SESSION['mother_tounge_all']; ?>');
	$('#degree_all').html('<?php echo $_SESSION['degree_all']; ?>');
});
</script>