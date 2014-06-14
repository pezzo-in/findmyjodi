<?php
session_start();
include('lib/myclass.php');
//echo "<pre>";print_r($_POST);die;
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
$search_coockie_data = $_SESSION['SearchCookie'];
$search_coockie_data = json_decode(stripslashes($search_coockie_data),true);
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
	$_SESSION['SearchCookie'] = $db_save[0]['json_data'];
	$search_coockie_data = $_SESSION['SearchCookie'];
	$search_coockie_data = json_decode(stripslashes($search_coockie_data),true);
}
$conditions = "1=1 AND members.status = 'Active'";
$right_join = '';
if(isset($search_coockie_data['Search_rdGender']))
{
	$gender=$search_coockie_data['Search_rdGender'];
	$conditions .= " AND gender = '".$gender."'";
}
if(isset($_POST['Search_from_age']) && isset($_POST['Search_to_age']))
{
	$from_age=$_POST['Search_from_age'];
	$to_age=$_POST['Search_to_age'];
	
	$conditions .= ' AND (age between ' .$from_age." and ".$to_age.")";
}
if(isset($_POST['Search_from_drpHeight']) && isset($_POST['Search_to_drpHeight']))
{
	
	$from_height=$_POST['Search_from_drpHeight'];
	$to_height=$_POST['Search_to_drpHeight'];
	$height_from="select * from height where Id='".$from_height."'";
	$db_height_from=$obj->select($height_from);
	
	$height_to="select * from height where Id='".$to_height."'";
	$db_height_to=$obj->select($height_to);
	
	$conditions .= ' AND (height between '.$from_height.' AND '.$to_height.')';
	
	$right_join .= ' RIGHT JOIN height on members.height=height.Id';
	
}
if(count($_POST['Search_chk_marital_status'])>0)
{
	$marital_status=$_POST['Search_chk_marital_status'];
	
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
if($_POST['Search_drpReligion']!='')
{
	$religion=$_POST['Search_drpReligion'];
	
	$j=0;
	for($k=0;$k<count($religion);$k++)
	{
		
		if($k==0)
				$conditions .= " AND (religion ='".$religion[$k]."'";
		else 
			{
				if($j==0)
				{
					$conditions .= " AND (religion ='".$religion[$k]."'";
				}
				else
				{
					$conditions .=" OR religion ='".$religion[$k]."'";
				}
			}
			$j++;
			
			if(count($religion)==($k+1))
				$conditions .= ")";
		
	}
}
if((count($_POST['Search_drpMotherTongue'])>0 && $_POST['Search_drpMotherTongue'][0]!=''))
{
	$mother_tongue=$_POST['Search_drpMotherTongue'];
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

if((count($_POST['drpCaste'])>0 && $_POST['drpCaste'][0]!=''))
{
	$cast=$_POST['drpCaste'];
	for($k=0;$k<count($cast);$k++)
	{
		if($k==0)
			$conditions .= " AND (caste = '".$cast[$k]."'";
			else	
			$conditions .=" OR caste = '".$cast[$k]."'";
		
		if(count($cast)==($k+1))
			$conditions .= ")";
	}
}

/*if($search_coockie_data['drpCaste']!='')
{
	$cast=$search_coockie_data['drpCaste'];
	$conditions .= " AND caste = '".$cast."'";
}*/
if(count($_POST['Search_drpCountry'])>0)
{
	$country=$_POST['Search_drpCountry'];
	
	$j=0;
	for($k=0;$k<count($country);$k++)
	{
		if($k==0)
				$conditions .= " AND (country ='".$country[$k]."'";
			else 
			{
				if($j==0)
				{
					$conditions .= " AND (country ='".$country[$k]."'";
				}
				else
				{
					$conditions .=" OR country ='".$country[$k]."'";
				}
			}
			$j++;
			
			if(count($country)==($k+1))
				$conditions .= ")";
	}	
}
/*if($_POST['Search_drpCountry']!='')
{
	$country=$_POST['Search_drpCountry'];
	$conditions .= " and country = '".$country."'";
}*/
if((count($_POST['Search_drpEducation'])>0 && $_POST['Search_drpEducation'][0]!=''))
{
	$education=$_POST['Search_drpEducation'];
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
if(isset($search_coockie_data['txtKeyword']))
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
/*if($search_coockie_data['advanced_drpOccupation'] != "" )
{
	
	$occupation=$search_coockie_data['advanced_drpOccupation'];
	
	$conditions .= " AND occupation = '".$occupation."'";		
}*/
if($search_coockie_data['advanced_drpIncome'] != "" )
{
	if($search_coockie_data['advanced_drpIncome'] != "" )
		$income=$search_coockie_data['advanced_drpIncome'];
		
	$conditions .= " AND annual_income = '".$income."'";	
}
if($search_coockie_data['advanced_drpStar'] != "" )
{
	$star=$search_coockie_data['advanced_drpStar'];
	$conditions .= " AND star = '".$star."'";	
}
if(($search_coockie_data['advanced_rdManglik'] != "Any" && $search_coockie_data['advanced_rdManglik'] != ''))
{
	$manglik=$search_coockie_data['advanced_rdManglik'];
	$conditions .= " AND manglik_dosham = '".$manglik."'";
}
if(isset($search_coockie_data['soulmate_chkInterest']))
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
if(isset($search_coockie_data['txt_by_id']))
{
	$search_by_id=$search_coockie_data['txt_by_id'];
		
	$conditions .= " AND (members.member_id = '".$search_by_id."' or  members.id = '".$search_by_id."')";
}
if(count($_POST['online_data'])>0)
{
	//$right_join .= ' LEFT JOIN chat_users on members.email_id=chat_users.email';
	$online_data=$_POST['online_data'];
	
	for($k=0;$k<count($online_data);$k++)
	{
		if($k==0 && $online_data[$k]==0)
			$conditions .= " AND (chat_users.status = '".$online_data[$k]."' OR chat_users.status is null";
		elseif($k==0)
			$conditions .= " AND (chat_users.status = '".$online_data[$k]."'";
		else	
			$conditions .=" OR chat_users.status = '".$online_data[$k]."' OR chat_users.status is null";
		
		if(count($online_data)==($k+1))
			$conditions .= ")";
	}
}
/*if($_POST['online_data'] == '1')
{
	
	$conditions .= " AND (chat_users.status = '1')";
		
	//$right_join .= ' LEFT JOIN chat_users on members.email_id=chat_users.email';
	
}
if($_POST['online_data'] == '0')
{
	
	$conditions .= "AND (chat_users.status = '0' || chat_users.status is null) ";
		
	//$right_join .= ' LEFT JOIN chat_users on members.email_id = chat_users.email';
	
}*/
if($_POST['chk_with_photo'] == 'on')
{	
	$conditions.= " AND member_photos.photo !='' and member_photos.Approve=1";
	//echo $conditions;
}
if($_POST['chk_with_horoscope']=='on')
{
	$conditions.= " AND members.horoscope_match != ''";
	//echo $conditions;
}
if((count($_POST['created_for'])>0 && $_POST['created_for'][0]!=''))
{
	$created_for=$_POST['created_for'];
	for($k=0;$k<count($created_for);$k++)
	{
		if($k==0)
			$conditions .= " AND (members.profile_for = '".$created_for[$k]."'";
		else	
			$conditions .=" OR members.profile_for = '".$created_for[$k]."'";
		
		if(count($created_for)==($k+1))
			$conditions .= ")";
	}
}

if((count($_POST['advanced_drpOccupation'])>0 && $_POST['advanced_drpOccupation'][0]!=''))
{
	$occupassion=$_POST['advanced_drpOccupation'];
	for($k=0;$k<count($occupassion);$k++)
	{
		if($k==0)
			$conditions .= " AND (members.occupation = '".$occupassion[$k]."'";
		else	
			$conditions .=" OR members.occupation = '".$occupassion[$k]."'";
		
		if(count($occupassion)==($k+1))
			$conditions .= ")";
	}
}

if(!empty($_SESSION['logged_user'][0]['id']))
{					
	$conditions.= " AND members.id != '".$_SESSION['logged_user'][0]['id']."'";					
}
if(!empty($_POST))
{
$sql = "SELECT members.*,member_photos.photo, member_photos.Approve, chat_users.status as chat_status FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id ".$right_join." LEFT JOIN chat_users on chat_users.email = members.email_id WHERE ".$conditions." order by members.last_login desc, members.id desc";
//echo $sql;
$_SESSION['Search_query']=$sql;
$sql2 = "SELECT members.*,member_photos.photo, member_photos.Approve, chat_users.status as chat_status FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id ".$right_join." LEFT JOIN chat_users on chat_users.email = members.email_id WHERE ".$conditions." order by members.last_login desc, members.id desc";
}
if(isset($_GET['clear']) && ($_GET['clear']=='all'))
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
elseif(isset($_GET['save']) && ($_GET['save']!=''))
{
	$sql = $db_save[0]['Search'];
	$sql2 = $db_save[0]['total_search'];
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
} ?>
<input type="hidden" value="<?php echo count($members2); ?>" name="ttl_profile" id="ttl_profile">
<input type="hidden" value="8" name="limit" id="limit">
<input type="hidden" value="1" name="offset" id="offset">
 <div class="mid_top_checkbox" style="clear: both;margin: 19px;float: right;margin-top: 0;"><span style="float:left; margin-right:15px; font-weight:bold">Total Profiles : <?php echo count($members2); ?></span><a href="javascript:;" class="list_view">List View</a><a href="javascript:;" class="grid_view">Grid View</a></div><br clear="all" />     
        <?php if(!empty($members)) { ?>
                
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
					for($i=0;$i<count($members);$i++)
					{
						
						
						?>
            	<li class="message_box" id="<?php echo $members[$i]['id']; ?>">
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
            <?php } else {  ?>
            	<span>No profiles found matching your search criteria. Please broaden your search criteria.</span>
            <?php } ?>
<?php
/*$_SESSION['withphoto']=$withphoto;
$_SESSION['unmarried']=$unmarrid;
$_SESSION['horoscope1']=$horoscope1;
$_SESSION['widow']=$widow;
$_SESSION['divorced']=$divorced;
$_SESSION['aw_divorced']=$aw_divorced;
$_SESSION['my_self']=$my_self;
$_SESSION['daughter']=$daughter;
$_SESSION['son']=$son;
$_SESSION['brother']=$brother;
$_SESSION['sister']=$sister;
$_SESSION['relative']=$relative;
$_SESSION['friend']=$friend;
$_SESSION['online']=$count_online;
$_SESSION['offline']=$count_offline;*/
?>
<script type="text/javascript">
$(document).ready(function(e){
	 $('.list_view').click(function(e) {
		$('.profl-list').fadeOut('slow','',function(){
				$('.profl-list').addClass('thumb_view');	
				$('.profl-list').fadeIn('slow');
				$("#listgridview").val('list');
			});
		});
		$('.grid_view').click(function(e) {
			$('.profl-list').fadeOut('slow','',function(){
				$('.profl-list').removeClass('thumb_view');	
				$('.profl-list').fadeIn('slow');
				$("#listgridview").val('grid');
			});
		});
		$("#refine_data").hide();
		$("ul.profl-list li:nth-child(4n+1)").addClass("first");
});
</script>
<script src="js/jquery.colorbox.js"></script>
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