<?php
if(isset($_POST['send_msg']))
{
	$insert="INSERT into messages(id, from_mem,to_mem,message)
			 values
			 		(NULL,'".$_POST['from_member_id']."','".$_POST['to_member_id']."','".$_POST['message']."')";
	$db_ins=$obj->insert($insert);
	echo "<script> alert('Message Sent!!!'); </script>";
	
	echo "<script> window.location.href = 'search_list.php?flag=msg_sent' </script>";
}

if(isset($_POST['regular_search_save']) && $_POST['regular_search_save']!='')
{
	$insert_search="insert into tbl_search(Id, Member_id, Search_lable, Search)value(null, '".$_SESSION['logged_user'][0]['id']."', '".$_POST['regular_search_save']."', '".json_encode($_POST)."')";
	$db_search=$obj->insert($insert_search);
	
	$conditions = "gender = '".$_POST['regular_rdGender']."'";
	$conditions .= 'and age between ' .$_POST['regular_from_age']." and ".$_POST['regular_to_age'];
	if(isset($_POST['regular_chk_marital_status']))
	{
		$total_checked = implode("','",$_POST['regular_chk_marital_status']);
		$marital_status = ($total_checked);
		$conditions .= " and relationship_status ='".$marital_status."'"; 
	}
	if($_POST['regular_drpReligion'] != "")
	{
		$conditions .= " and religion = '".$_POST['regular_drpReligion']."'"; 
	}
	
	if($_POST['regular_drpHeight'] != "")
	{
		$conditions .= " and height = '".$_POST['regular_drpHeight']."'"; 
	}
	
	if($_POST['regular_drpMotherTongue'] != '')
	{
		$conditions .= " and mother_tongue = '".$_POST['regular_drpMotherTongue']."'";
	}
	if($_POST['regular_drpCaste'] != '')
	{
		$conditions .= " and caste = '".$_POST['regular_drpCaste']."'";
	}
	if($_POST['regular_drpCountry'] != '')
	{
		$conditions .= " and country = '".$_POST['regular_drpCountry']."'";
	}
	if($_POST['regular_drpEducation'] != '')
	{
		$conditions .= " and education = '".$_POST['regular_drpEducation']."'";
	}
	
	
	if(isset($_SESSION['logged_user'][0]['id']))
	{					
		$conditions.= " and members.id != '".$_SESSION['logged_user'][0]['id']."'";					
	}
	
	if($_POST['chk_with_photo'] == 1)
	{
		$conditions.= " and member_photos.photo != ''";
	}
	
	if($_POST['chk_with_horoscope']==1)
	{
		$conditions.= " and members.horoscope_match != ''";
	}
	
	$conditions.= " and members.status = 'Active'";
		
				
	$sql = "SELECT members.*,member_photos.photo FROM members 
					LEFT JOIN member_photos ON members.id = member_photos.member_id
					WHERE
					    ".$conditions."";
      
	$PAGING=new PAGING($sql,6);
	$sql=$PAGING->sql;
	$members = $obj->select($sql);
	
}
else if(isset($_POST['regular_search']))
{
	
	$conditions = "gender = '".$_POST['regular_rdGender']."'";
	$conditions .= 'and age between ' .$_POST['regular_from_age']." and ".$_POST['regular_to_age'];
	if(isset($_POST['regular_chk_marital_status']))
	{
		$total_checked = implode("','",$_POST['regular_chk_marital_status']);
		$marital_status = ($total_checked);
		$conditions .= " and relationship_status ='".$marital_status."'"; 
	}
	if($_POST['regular_drpReligion'] != "")
	{
		$conditions .= " and religion = '".$_POST['regular_drpReligion']."'"; 
	}
	
	if($_POST['regular_drpHeight'] != "")
	{
		$conditions .= " and height = '".$_POST['regular_drpHeight']."'"; 
	}
	
	if($_POST['regular_drpMotherTongue'] != '')
	{
		$conditions .= " and mother_tongue = '".$_POST['regular_drpMotherTongue']."'";
	}
	if($_POST['regular_drpCaste'] != '')
	{
		$conditions .= " and caste = '".$_POST['regular_drpCaste']."'";
	}
	if($_POST['regular_drpCountry'] != '')
	{
		$conditions .= " and country = '".$_POST['regular_drpCountry']."'";
	}
	if($_POST['regular_drpEducation'] != '')
	{
		$conditions .= " and education = '".$_POST['regular_drpEducation']."'";
	}
	
	
	if(isset($_SESSION['logged_user'][0]['id']))
	{					
		$conditions.= " and members.id != '".$_SESSION['logged_user'][0]['id']."'";					
	}
	
	if($_POST['chk_with_photo'] == 1)
	{
		$conditions.= " and member_photos.photo != ''";
	}
	
	if($_POST['chk_with_horoscope']==1)
	{
		$conditions.= " and members.horoscope_match != ''";
	}
	
	$conditions.= " and members.status = 'Active'";
		
				
	$sql = "SELECT members.*,member_photos.photo FROM members 
					LEFT JOIN member_photos ON members.id = member_photos.member_id
					WHERE
					    ".$conditions."";
      
	$PAGING=new PAGING($sql,6);
	$sql=$PAGING->sql;
	$members = $obj->select($sql);				
		
}
elseif(isset($_POST['keyword_search_save']) && $_POST['keyword_search_save']!='')
{
	$insert_search="insert into tbl_search(Id, Member_id, Search_lable, Search)value(null, '".$_SESSION['logged_user'][0]['id']."', '".$_POST['keyword_search_save']."', '".json_encode($_POST)."')";
	$db_search=$obj->insert($insert_search);
	
		$conditions2 = "name like '%".$_POST['txtKeyword']."%' or  
						partner_prefrence like '%".$_POST['txtKeyword']."%' or  
						occupation like '%".$_POST['txtKeyword']."%' or 
						employed_in like '%".$_POST['txtKeyword']."%' or 
						subcaste like '%".$_POST['txtKeyword']."%' or  
						gothram like '%".$_POST['txtKeyword']."%' or  
						star like '%".$_POST['txtKeyword']."%' or
						moonsign like '%".$_POST['txtKeyword']."%' or
						horoscope_match like '%".$_POST['txtKeyword']."%' or
						height like '%".$_POST['txtKeyword']."%' or
						weight like '%".$_POST['txtKeyword']."%' or
						blood_group like '%".$_POST['txtKeyword']."%' or
						family_status like '%".$_POST['txtKeyword']."%' or
						family_type like '%".$_POST['txtKeyword']."%' or
						father_occupation like '%".$_POST['txtKeyword']."%' or
						mother_occupation like '%".$_POST['txtKeyword']."%' or
						family_origin like '%".$_POST['txtKeyword']."%' or
						complexion like '%".$_POST['txtKeyword']."%' or
						father_occupation like '%".$_POST['txtKeyword']."%' or
						hobbies like '%".$_POST['txtKeyword']."%' or
						place_of_birth like '%".$_POST['txtKeyword']."%' or
						city like '%".$_POST['txtKeyword']."%' or
						email_id like '%".$_POST['txtKeyword']."%' or
						relationship_status like '%".$_POST['txtKeyword']."%' or  
						religion like '%".$_POST['txtKeyword']."%' or  
						mother_tongue like '%".$_POST['txtKeyword']."%' or    
						caste like '%".$_POST['txtKeyword']."%' or  
						country like '%".$_POST['txtKeyword']."%' or  
						education like '%".$_POST['txtKeyword']."%' or  
						Interest like '%".$_POST['txtKeyword']."%'";
						
		if($_POST['chk_with_photo'] == 1)
		{
			$conditions2.= " and member_photos.photo != ''";
		}
		
		if($_POST['chk_with_horoscope']==1)
		{
			$conditions2.= " and members.horoscope_match != ''";
		}
		
		if(isset($_SESSION['logged_user'][0]['id']))
		{					
			$conditions2.= " and members.id != '".$_SESSION['logged_user'][0]['id']."'";					
		}	
	    $conditions2.= " and members.status = 'Active'";
		
		
		$sql = "SELECT members.*,member_photos.photo FROM members 
					JOIN member_photos ON members.id = member_photos.member_id
					WHERE ".$conditions2."";
		//echo $sql;
		$PAGING=new PAGING($sql);
		$sql=$PAGING->sql;
		$members = $obj->select($sql);						
}
elseif(isset($_POST['keyword_search']))
{
		$conditions2 = "name like '%".$_POST['txtKeyword']."%' or  
						partner_prefrence like '%".$_POST['txtKeyword']."%' or  
						occupation like '%".$_POST['txtKeyword']."%' or 
						employed_in like '%".$_POST['txtKeyword']."%' or 
						subcaste like '%".$_POST['txtKeyword']."%' or  
						gothram like '%".$_POST['txtKeyword']."%' or  
						star like '%".$_POST['txtKeyword']."%' or
						moonsign like '%".$_POST['txtKeyword']."%' or
						horoscope_match like '%".$_POST['txtKeyword']."%' or
						height like '%".$_POST['txtKeyword']."%' or
						weight like '%".$_POST['txtKeyword']."%' or
						blood_group like '%".$_POST['txtKeyword']."%' or
						family_status like '%".$_POST['txtKeyword']."%' or
						family_type like '%".$_POST['txtKeyword']."%' or
						father_occupation like '%".$_POST['txtKeyword']."%' or
						mother_occupation like '%".$_POST['txtKeyword']."%' or
						family_origin like '%".$_POST['txtKeyword']."%' or
						complexion like '%".$_POST['txtKeyword']."%' or
						father_occupation like '%".$_POST['txtKeyword']."%' or
						hobbies like '%".$_POST['txtKeyword']."%' or
						place_of_birth like '%".$_POST['txtKeyword']."%' or
						city like '%".$_POST['txtKeyword']."%' or
						email_id like '%".$_POST['txtKeyword']."%' or
						relationship_status like '%".$_POST['txtKeyword']."%' or  
						religion like '%".$_POST['txtKeyword']."%' or  
						mother_tongue like '%".$_POST['txtKeyword']."%' or    
						caste like '%".$_POST['txtKeyword']."%' or  
						country like '%".$_POST['txtKeyword']."%' or  
						education like '%".$_POST['txtKeyword']."%' or  
						Interest like '%".$_POST['txtKeyword']."%'";
						
		if($_POST['chk_with_photo'] == 1)
		{
			$conditions2.= " and member_photos.photo != ''";
		}
		
		if($_POST['chk_with_horoscope']==1)
		{
			$conditions2.= " and members.horoscope_match != ''";
		}
		
		if(isset($_SESSION['logged_user'][0]['id']))
		{					
			$conditions2.= " and members.id != '".$_SESSION['logged_user'][0]['id']."'";					
		}	
	    $conditions2.= " and members.status = 'Active'";
		
		
		$sql = "SELECT members.*,member_photos.photo FROM members 
					JOIN member_photos ON members.id = member_photos.member_id
					WHERE ".$conditions2."";
		//echo $sql;
		$PAGING=new PAGING($sql);
		$sql=$PAGING->sql;
		$members = $obj->select($sql);						
}
elseif(isset($_POST['soulmate_search']))
{
	
	$soul_conditions = "gender = '".$_POST['soulmate_rdGender']."'";
	$soul_conditions .= ' and age between ' .$_POST['soulmate_from_age']." and ".$_POST['soulmate_to_age'];
	
	if(isset($_POST['soulmate_chk_marital_status']))
	{
		$soul_conditions .= " and relationship_status = '".$marital_status."'";
		
	}
	if($_POST['soul_drpHeight'] != '0')
	{
		$soul_conditions .= " and height = '".$_POST['soul_drpHeight']."'";
	}
	if($_POST['soulmate_drpReligion'] != '0')
	{
		$soul_conditions .= " and religion = '".$_POST['soulmate_drpReligion']."'";
	}
	if($_POST['soulmate_drpMotherTongue'] != '0')
	{
		
		$soul_conditions .= " and mother_tongue = '".$_POST['soulmate_drpMotherTongue']."'";
	}
	
	if($_POST['soulmate_drpCaste'] != '0')
	{
		
		$soul_conditions .= " and caste = '".$_POST['soulmate_drpCaste']."'";
	}
	if($_POST['soulmate_drpCountry'] != '0')
	{
		$soul_conditions .= " and country = '".$_POST['soulmate_drpCountry']."'";
	}
	if($_POST['soulmate_drpEducation'] != "Any")
	{
		$soul_conditions .= " and education = '".$_POST['soulmate_drpEducation']."'";
	}
	if(isset($_POST['soulmate_chkInterest']))
	{
		$total_checked = explode("','",$_POST['soulmate_chkInterest']);
		for($i = 0; $i<count($_POST['soulmate_chkInterest']);$i++)
		{
			if($i == 0)
			{
				$soul_conditions .= " and Interest LIKE '%".$_POST['soulmate_chkInterest'][$i]."%'";		 			
			}
			else
			{
				$soul_conditions .= " or Interest LIKE '%".$_POST['soulmate_chkInterest'][$i]."%'";		 			
			}
		}
		
		
	}
	
	if(isset($_SESSION['logged_user'][0]['id'])) 
	{					
		$soul_conditions.= " and members.id != '".$_SESSION['logged_user'][0]['id']."'";					
	}	
	
	if($_POST['chk_with_photo'] == 1)
	{
		$soul_conditions.= " and member_photos.photo != ''";
	}
	
	if($_POST['chk_with_horoscope']==1)
	{
		$soul_conditions.= " and members.horoscope_match != ''";
	}
	
	$soul_conditions.= " and members.status = 'Active'";
	$sql = "SELECT members.*,member_photos.photo FROM members 
					LEFT JOIN member_photos ON members.id = member_photos.member_id
					WHERE ".$soul_conditions."";
					
	/*$PAGING=new PAGING($sql);
	$sql=$PAGING->sql;*/
	$members = $obj->select($sql);	
}
elseif(isset($_POST['advanced_search_save']) && $_POST['advanced_search_save']!='')
{
	$insert_search="insert into tbl_search(Id, Member_id, Search_lable, Search)value(null, '".$_SESSION['logged_user'][0]['id']."', '".$_POST['advanced_search_save']."', '".json_encode($_POST)."')";
	$db_search=$obj->insert($insert_search);
	
	$adv_conditions = "gender = '".$_POST['advanced_rdGender']."'";
	$adv_conditions .= ' and age between ' .$_POST['advanced_from_age']." and ".$_POST['advanced_to_age'];
	
	if($_POST['advanced_drpCountry'] != '')
	{
		$adv_conditions .= " and country = '".$_POST['advanced_drpCountry']."'";
		
	}
	if($_POST['advanced_drpCaste'] != '')
	{
		$adv_conditions .= " and caste = '".$_POST['advanced_drpCaste']."'";
		
	}
	if(isset($_POST['advanced_chk_marital_status']))
	{
		$total_checked = implode("','",$_POST['advanced_chk_marital_status']);
		$adv_conditions .= " and relationship_status = '".$total_checked."'";			
	}
	
	if($_POST['advanced_drpEducation'] != "")
	{
		$adv_conditions .= " and education = '".$_POST['advanced_drpEducation']."'";			
	}
	
	if($_POST['advanced_drpOccupation'] != "")
	{
		$adv_conditions .= " and occupation = '".$_POST['advanced_drpOccupation']."'";		
		
	}
	if($_POST['advanced_drpIncome'] != "")
	{
		$adv_conditions .= " and annual_income = '".$_POST['advanced_drpIncome']."'";	
		
	}
	if($_POST['advanced_drpStar'] != "")
	{
		$adv_conditions .= " and star = '".$_POST['advanced_drpStar']."'";	
		
	}
	if(($_POST['advanced_rdManglik'] != "Any"))
	{
		$adv_conditions .= " and manglik_dosham = '".$_POST['advanced_rdManglik']."'";	
	}
	if($_POST['advanced_drpMotherTongue'] != '')
	{
		$adv_conditions .= " and mother_tongue = '".$_POST['advanced_drpMotherTongue']."'";
	}
	
	if($_POST['advanced_drpReligion'] != '')
	{
		$adv_conditions .= " and religion = '".$_POST['advanced_drpReligion']."'";
	}
	if($_POST['adv_drpHeight'] != '')
	{
		$adv_conditions .= " and height = '".$_POST['adv_drpHeight']."'";
	}
	
	
	if(isset($_SESSION['logged_user'][0]['id']))
	{					
		$adv_conditions.= " and members.id != '".$_SESSION['logged_user'][0]['id']."'";					
	}
	
	if($_POST['chk_with_photo'] == 1)
	{
		$adv_conditions.= " and member_photos.photo != ''";
	}
	
	if($_POST['chk_with_horoscope']==1)
	{
		$adv_conditions.= " and members.horoscope_match != ''";
	}
	
	if(isset($_POST['soulmate_chkInterest']))
	{
		$total_checked = explode("','",$_POST['soulmate_chkInterest']);
		for($i = 0; $i<count($_POST['soulmate_chkInterest']);$i++)
		{
			if($i == 0)
			{
				$adv_conditions .= " and (Interest LIKE '%".$_POST['soulmate_chkInterest'][$i]."%'";		 			
			}
			else
			{
				$adv_conditions .= " or Interest LIKE '%".$_POST['soulmate_chkInterest'][$i]."%'";		 			
			}
		}	
		$adv_conditions .= ")";
	}
	
	$adv_conditions.= " and members.status = 'Active'";
	
	$sql = "SELECT members.*,member_photos.photo FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE ".$adv_conditions."";		
	
	
	/*$PAGING=new PAGING($sql);
	$sql=$PAGING->sql;*/
	$members = $obj->select($sql);	
}
elseif(isset($_POST['advanced_search']))
{
	
	$adv_conditions = "gender = '".$_POST['advanced_rdGender']."'";
	$adv_conditions .= ' and age between ' .$_POST['advanced_from_age']." and ".$_POST['advanced_to_age'];
	
	if($_POST['advanced_drpCountry'] != '')
	{
		$adv_conditions .= " and country = '".$_POST['advanced_drpCountry']."'";
		
	}
	if($_POST['advanced_drpCaste'] != '')
	{
		$adv_conditions .= " and caste = '".$_POST['advanced_drpCaste']."'";
		
	}
	if(isset($_POST['advanced_chk_marital_status']))
	{
		$total_checked = implode("','",$_POST['advanced_chk_marital_status']);
		$adv_conditions .= " and relationship_status = '".$total_checked."'";			
	}
	
	if($_POST['advanced_drpEducation'] != "")
	{
		$adv_conditions .= " and education = '".$_POST['advanced_drpEducation']."'";			
	}
	
	if($_POST['advanced_drpOccupation'] != "")
	{
		$adv_conditions .= " and occupation = '".$_POST['advanced_drpOccupation']."'";		
		
	}
	if($_POST['advanced_drpIncome'] != "")
	{
		$adv_conditions .= " and annual_income = '".$_POST['advanced_drpIncome']."'";	
		
	}
	if($_POST['advanced_drpStar'] != "")
	{
		$adv_conditions .= " and star = '".$_POST['advanced_drpStar']."'";	
		
	}
	if(($_POST['advanced_rdManglik'] != "Any"))
	{
		$adv_conditions .= " and manglik_dosham = '".$_POST['advanced_rdManglik']."'";	
	}
	if($_POST['advanced_drpMotherTongue'] != '')
	{
		$adv_conditions .= " and mother_tongue = '".$_POST['advanced_drpMotherTongue']."'";
	}
	
	if($_POST['advanced_drpReligion'] != '')
	{
		$adv_conditions .= " and religion = '".$_POST['advanced_drpReligion']."'";
	}
	if($_POST['adv_drpHeight'] != '')
	{
		$adv_conditions .= " and height = '".$_POST['adv_drpHeight']."'";
	}
	
	
	if(isset($_SESSION['logged_user'][0]['id']))
	{					
		$adv_conditions.= " and members.id != '".$_SESSION['logged_user'][0]['id']."'";					
	}
	
	if($_POST['chk_with_photo'] == 1)
	{
		$adv_conditions.= " and member_photos.photo != ''";
	}
	
	if($_POST['chk_with_horoscope']==1)
	{
		$adv_conditions.= " and members.horoscope_match != ''";
	}
	
	if(isset($_POST['soulmate_chkInterest']))
	{
		$total_checked = explode("','",$_POST['soulmate_chkInterest']);
		for($i = 0; $i<count($_POST['soulmate_chkInterest']);$i++)
		{
			if($i == 0)
			{
				$adv_conditions .= " and (Interest LIKE '%".$_POST['soulmate_chkInterest'][$i]."%'";		 			
			}
			else
			{
				$adv_conditions .= " or Interest LIKE '%".$_POST['soulmate_chkInterest'][$i]."%'";		 			
			}
		}	
		$adv_conditions .= ")";
	}
	
	$adv_conditions.= " and members.status = 'Active'";
	
	$sql = "SELECT members.*,member_photos.photo FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE ".$adv_conditions."";		
	
	
	/*$PAGING=new PAGING($sql);
	$sql=$PAGING->sql;*/
	$members = $obj->select($sql);	
}
/*else
{
	$age_between = $_POST['drpAgeFrom']." and ".$_POST['drpAgeTo'];
	$sql = "SELECT members.*,member_photos.photo FROM members 
				JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 		age between ".$age_between." and 
					gender='".$_POST['drpLookingFor']."' and   
					religion in('".$religion_list."') and  
					country  in('".$country_list."')
					";	
					
	$members=$obj->select($sql);
}
if(isset($_GET['flag']))
{
	$age_between = $_POST['drpAgeFrom']." and ".$_POST['drpAgeTo'];
	
	$conditions5 = "relationship_status='".$_POST['drpMaritalStatus']."' and  
						mother_tongue='".$_POST['drpLanguage']."' and  
						age between ".$age_between." and
						religion = '".$_POST['drpReligion']."' and
						caste = '".$_POST['drpCaste']."'";
	if(isset($_SESSION['logged_user'][0]['id']))
	{					
		$conditions5.= "and id != '".$_SESSION['logged_user'][0]['id']."'";					
	}
	
	$sql = "SELECT members.*,member_photos.photo FROM members 
					JOIN member_photos ON members.id = member_photos.member_id
					WHERE ".$conditions5." ";	
	$members=$obj->select($sql);
}*/
else
{
	if($_GET['flag'] == "msg_sent")
	{
		$find_last_search = "SELECT * from search_criteria where from_mem = '".$_SESSION['logged_user'][0]['id']."'";
		$last_search = 	$obj->select($find_last_search);
		
		$saved_country =  str_replace(",","','",$last_search[0]['country']);
		$saved_religion =  str_replace(",","','",$last_search[0]['religion']); 			
		$conditions7 = "age between ".$last_search[0]['age_between']." and 
						gender = '".$last_search[0]['gender']."' and
						religion in('".$saved_religion."') and 
						country in('".$saved_country."') and
						status = 'Active'";
			
		if(isset($_SESSION['logged_user'][0]['id']))
		{
			$conditions7 .= "and members.id != '".$_SESSION['logged_user'][0]['id']."'";
		}	
		$sql = "SELECT members.*,member_photos.photo FROM members 
						JOIN member_photos ON members.id = member_photos.member_id
						WHERE ".$conditions7."";	
		
		/*$PAGING=new PAGING($sql);
		$sql=$PAGING->sql;*/
		$members = $obj->select($sql);
	}
	elseif($_GET['flag'] == "interest_sent")
	{
		
		$find_last_search = "SELECT * from search_criteria where from_mem = '".$_SESSION['logged_user'][0]['id']."'";
		$last_search = 	$obj->select($find_last_search);
		
		$saved_country =  str_replace(",","','",$last_search[0]['country']);
		$saved_religion =  str_replace(",","','",$last_search[0]['religion']); 			
		$conditions7 = "age between ".$last_search[0]['age_between']." and 
						gender = '".$last_search[0]['gender']."' and
						religion in('".$saved_religion."') and 
						country in('".$saved_country."')";
			
		if(isset($_SESSION['logged_user'][0]['id']))
		{
			$conditions7 .= "and members.id != '".$_SESSION['logged_user'][0]['id']."'";
		}	
		$sql = "SELECT members.*,member_photos.photo FROM members 
						JOIN member_photos ON members.id = member_photos.member_id
						WHERE ".$conditions7."";	
		
		/*$PAGING=new PAGING($sql);
		$sql=$PAGING->sql;*/
		$members = $obj->select($sql);
	}
	//home page search	
	else
	{
		
		
		$conditions_home = "gender = '".$_POST['drpLookingFor']."'";
		$conditions_home .= 'and age between ' .$_POST['drpAgeFrom']." and ".$_POST['drpAgeTo'];
		if($_POST['drpLang'] != '')
		{
			$conditions_home .= " and mother_tongue = '".$_POST['drpLang']."'";
		}
		if($_POST['drpCaste'] != '')
		{
			$conditions_home .= " and caste = '".$_POST['drpCaste']."'";
		}
		$conditions_home.= " and members.status = 'Active'";
		
  		if(isset($_SESSION['logged_user'][0]['id']))
		{
			$conditions_home .= "and members.id != '".$_SESSION['logged_user'][0]['id']."'";
		}				
		$sql = "SELECT members.*,member_photos.photo FROM members 
						LEFT JOIN member_photos ON members.id = member_photos.member_id
						WHERE ".$conditions_home."";	
		
		/*$PAGING=new PAGING($sql);
		$sql=$PAGING->sql;*/
		$members = $obj->select($sql);
		
		
		$save_rel =  str_replace("','",",",$religion_list); 
		$save_country =  str_replace("','",",",$country_list); 
		$save_criteria = "insert into search_criteria 
							(id,from_mem,age_between,gender,religion,country)
						  VALUES
							(NULL,'".$_SESSION['logged_user'][0]['id']."','".$age_between."','".$_POST['drpLookingFor']."',
								  '".$save_rel."','".$save_country."')";
								  
								  //echo $save_criteria;  
		$insert_search= $obj->insert($save_criteria);	
	}
 
} ?>
   
    
<div  class="mid col-md-12 col-sm-12 col-xs-12">
<?php
$select_banner = "select * from advertise where adv_position = 'Search Result Top (954 X 100)'";
$db_banner = $obj->select($select_banner);
if(count($db_banner) > 0) 
{
?>
<div style="margin: 0px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>
<?php } ?>
<div class="sidebar">
        	<div class="sidebar-main">
            	<h2>Refine Search</h2>
                <div class="sidebar-cont" id="acc-list">
                	<div class="list-toggle">
                        <h3>Show members added</h3>
                        <ul>
                        	 <?php
							$sql="SELECT members.*,member_photos.photo FROM members 
										  LEFT JOIN member_photos ON members.id = member_photos.member_id
										  where 
										  is_deleted = 'N' and month = '".(date('m'))."' 
										  and day = '".date('d')."'
										  and status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
							$within_day_members=$obj->select($sql);
							?>
                        	<li><a href="javascript:;" id="within_day" >Within a day(<?php echo count($within_day_members); ?>)</a></li>
                             <?php
							$sql="SELECT members.*,member_photos.photo FROM members 
										  LEFT JOIN member_photos ON members.id = member_photos.member_id
										  where is_deleted = 'N' and month = '".(date('m'))."'
										  and status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
							$curr_members=$obj->select($sql);							
							?>
                            <li><a href="javascript:;" id="within_month" >Within a month(<?php echo count($curr_members); ?>)</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Active</h3>
                        <ul>
                        	<?php
								$sql="SELECT members.*,member_photos.photo FROM members 
									  LEFT JOIN member_photos ON members.id = member_photos.member_id
									  where is_deleted = 'N' and month = '".(date('m'))."' and status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$curr_act=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="one_month_active">One month (<?php echo count($curr_act); ?>)</a></li>
                            
							<?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										LEFT JOIN member_photos ON members.id = member_photos.member_id
										WHERE reg_date > DATE_SUB(DATE(NOW()), INTERVAL 1 WEEK) and status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";		
								$one_week_act=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="one_week_active">One Week (<?php echo count($one_week_act); ?>)</a></li>
                          
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Age</h3>
                        <ul>
                        	<?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.age between 23 and 28 and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$age_between=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="age_search">23 yrs to 28 yrs (<?php echo count($age_between); ?>)</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Marital Status</h3>
                        <ul>
                        	<?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.relationship_status = 'Unmarried'
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$marital_status=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="unmarried">Unmarried(<?php echo count($marital_status); ?>)</a></li>
                        </ul>
                    </div>
                    
                    <div class="list-toggle">
                        <h3>Star</h3>
                        <ul>
                        	<?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.star = 'Rohini'
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$rohini_star=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="star_rohini">Rohini(<?php echo count($rohini_star); ?>)</a></li>
                            
                            <?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.star = 'Ashwini'
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$ashwini_star=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="star_ashwini">Ashwini(<?php echo count($ashwini_star); ?>)</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Occupation</h3>
                        <ul>
                        	<?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.occupation = 'Engineer - Non IT'
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$enginner_occu=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="enginner_occu">Engineer - Non IT(<?php echo count($enginner_occu); ?>)</a></li>
                            
                            <?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.occupation = 'Administrative Professional'
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$admini_prof=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="admini_prof">Administrative Professional(<?php echo count($admini_prof); ?>)</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Annual income</h3>
                        <ul>
                        	<?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.annual_income between 1 and 3
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$one_to_three_lakh=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="one_to_three_lakh">Rs.1 lakh to Rs. 3 lakh(<?php echo count($one_to_three_lakh); ?>)</a></li>
                            
                            <?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.annual_income between 3 and 5
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$three_to_five=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="three_to_five">Rs.3 lakh to Rs. 5 lakh(<?php echo count($three_to_five); ?>)</a></li>
                            
                             <?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.annual_income between 5 and 10
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$five_to_ten=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="five_to_ten">Rs.5 lakh to Rs. 10 lakh(<?php echo count($five_to_ten); ?>)</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Country living in</h3>
                        <ul>
                        	<?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.country = 'India'
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$country_india=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="india">India(<?php echo count($country_india); ?>)</a></li>
                            
                            <?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.country = 'United States of America'
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$country_usa=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="usa">United State of America(<?php echo count($country_usa); ?>)</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Complexion</h3>
                        <ul>
                        	<?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.complexion = 'Fair'
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$complexion_fair=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="fair">Fair(<?php echo count($complexion_fair); ?>)</a></li>
                            
                            <?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.complexion = 'wheatish'
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$complexion_wheatish=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="wheatish">Wheatish(<?php echo count($complexion_wheatish); ?>)</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Manglik</h3>
                        <ul>
                        	<?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.manglik_dosham = 'Y'
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$manglik=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="manglik">Yes(<?php echo count($manglik); ?>)</a></li>
                            
                            <?php
								$sql = "SELECT members.*,member_photos.photo FROM members 
										JOIN member_photos ON members.id = member_photos.member_id
										WHERE
					    				members.manglik_dosham = 'N'
										and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
								$not_manglik=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="not_manglik">No(<?php echo count($not_manglik); ?>)</a></li>
                        </ul>
                    </div>                    
                    <div class="list-toggle">
                        <h3>Religion</h3>
                        <ul>
                        	<?php
							$sql="SELECT members.*,member_photos.photo FROM members 
								  LEFT JOIN member_photos ON members.id = member_photos.member_id
								  where is_deleted = 'N' and religion = 'Hindu' 
								  and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
							$hindu=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="hindu">Hindu (<?php echo count($hindu); ?>)</a></li>
                            <?php
							$sql="SELECT members.*,member_photos.photo FROM members 
								  LEFT JOIN member_photos ON members.id = member_photos.member_id
								  where is_deleted = 'N' and religion = 'Muslim' 
								  and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
							$muslim=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="muslim">Muslim (<?php echo count($muslim) ?>)</a></li>
                              <?php
							$sql="SELECT members.*,member_photos.photo FROM members 
								  LEFT JOIN member_photos ON members.id = member_photos.member_id
								  where is_deleted = 'N' and religion = 'Christian'
								  and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
							$christian=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="christian">Christian (<?php echo count($christian); ?>)</a></li>
                            
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Cast</h3>
                        <ul>
                        	 <?php
							$sql="SELECT members.*,member_photos.photo FROM members 
								  LEFT JOIN member_photos ON members.id = member_photos.member_id
								  where is_deleted = 'N' and caste = 'agarwal'
								  and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
							$agarwal=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="agarwal">Agarwal (<?php echo count($agarwal); ?>)</a></li>
                            <?php
							$sql="SELECT members.*,member_photos.photo FROM members 
								  LEFT JOIN member_photos ON members.id = member_photos.member_id
								  where is_deleted = 'N' and caste = 'arora' 
								  and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
							$arora=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="arora">Arora (<?php echo count($arora); ?>)</a></li>
                            <?php
							$sql="SELECT members.*,member_photos.photo FROM members 
								  LEFT JOIN member_photos ON members.id = member_photos.member_id
								  where is_deleted = 'N' and caste = 'brahmin'
								  and members.status = 'Active' AND members.id!='".$_SESSION['logged_user'][0]['id']."'";
							$brahmin=$obj->select($sql);
							?>
                            <li><a href="javascript:;" id="brahmin">Brahmin (<?php echo count($brahmin); ?>)</a></li>
                           
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Profession</h3>
                        <ul>
                            <li><a href="javascript:;">Service (3)</a></li>
                            <li><a href="javascript:;">Business (2)</a></li>
                            <li><a href="javascript:;">Job (1)</a></li>
                           
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Online Members</h3>
                        <ul>
                            <li><a href="javascript:;">Online (10)</a></li>
                            <li><a href="javascript:;">Offline (2)</a></li>
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
					foreach($members as $res) { ?>
            	<li>
                    <div class="profile-img-box">
                    <a href="view_profile.php?id=<?php echo $res['id']; ?>" class="popper" data-popbox="pop<?php echo $res['id']; ?>">
                        <?php
						if(!empty($res['photo']))
						{
						 	//$path =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/".$members[0]['photo'];
							$path = "upload/".$res['photo'];
							if (file_exists($path)) {
									//echo '<a href="javascript:;" class="popper" data-popbox="pop'.$res['id'].'"><img src="'.$path.'" class="profile_pic" style="width:152px;height:161px;" /></a>'; 
									echo '<img title="click here to upload photo" data-popbox="pop'.$res['id'].'" class="profile_pic popper" src="'.$path.'" />';
									echo '<div id="pop'.$res['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" /></div>';
									//echo '<div id="pop'.$res['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" /></div>';
							}
							else{
								if($res['gender']=='M')
									echo '<img title="click here to upload photo" class="profile_pic" src="images/male-user1.png" />';
								else
									echo '<img title="click here to upload photo" class="profile_pic" src="images/female-user1.png" />';
							}
						}
						else{
								if($res['gender']=='M')
									echo '<img title="click here to upload photo" class="profile_pic" src="images/male-user1.png" />';
								else
									echo '<img title="click here to upload photo" class="profile_pic" src="images/female-user1.png" />';
							}?>
                            
                        
                        <div class="griddetail">
                        	<div><b><?php echo $res['name']; ?></b></div>
							<div><?php echo $res['age'] ?> <?php if($res['height'] != '') { ?> / <?php echo $res['height']; } ?></div>
						</div>
						<div class="listdetail">
                        	<div><label>Name : </label><?php echo $res['name']; ?></div>
							<div><label>Age / Height : </label><?php echo $res['age'] ?> / <?php echo $res['height']; ?></div>
                            <div><label>Religion : </label><?php echo $res['religion'] ?></div>
                            <div><label>Caste / Subcaste : </label><?php echo $res['caste'] ?> / <?php echo $res['subcaste'] ?></div>
                            <div><label>Location : </label><?php if($res['city'] != '') { echo $res['city'].", "; } ?><?php if($res['state'] != '') { echo $res['state'].", "; } ?><?php if($res['country'] != '') { echo $res['country']; } ?></div>
                            <div><label>Education : </label><?php echo $res['education'] ?></div>
                            <div><label>Occupation : </label><?php echo $res['occupation'] ?></div>
						</div>
</a>
						<div class="goto">
                        	<?php
							if($_SESSION['logged_user'][0]['member_id']!='')
							{
								$select_express_intrest="select * from express_interest where from_mem='".$_SESSION['logged_user'][0]['member_id']."' AND to_mem='".$res['member_id']."'";
								$db_express_intrest=$obj->select($select_express_intrest);
								if(count($db_express_intrest)==0){
								?>
								<a href="include/express_interest.php?to_mem_id=<?php echo $res['member_id']; ?>&from_mem_id=<?php echo $_SESSION['logged_user'][0]['member_id']; ?>&site=second" class="icon-heart"></a>
								<?php }else{ ?>
								<a href="javascript:;" onclick="alert('Already sent Intrest.')" class="icon-heart"></a>                            
								<?php } ?>
								<a href="javascript:;" class="icon-gift"></a>
								<a href="include/send_message.php?id=<?php echo $res['id']; ?>&email=<?php echo $res['email_id']; ?>&to_mem_id=<?php echo $res['member_id']; ?>" class="icon-mail ajax send_email_btn"></a>
								<a href="javascript:;" class="icon-chat"></a>
                           <?php 
							}else{
							?>
								<a href="login.php" class="icon-heart"></a>                            
								<a href="login.php" class="icon-gift"></a>
								<a href="login.php" class="icon-mail"></a>
								<a href="login.php" class="icon-chat"></a>
                            <?php } ?>
						</div>
                        
                        <div class="goto" style="display:none">
                            <a href="javascript:;" class="icon-heart"></a>
                            <?php /*?><a href="#" class="icon-mail"></a><?php */?>
                             <a href="include/express_interest.php?to_mem_id=<?php echo $res['member_id']; ?>&from_mem_id=<?php echo $_SESSION['logged_user'][0]['member_id']; ?>&site=second">| EI</a>
                           <a class="ajax send_email_btn" href="include/send_message.php?id=<?php echo $res['id']; ?>&email=<?php echo $res['email_id']; ?>&to_mem_id=<?php echo $res['member_id']; ?>">MSG</a>
                           <?php /*?> <a href="#" class="icon-chat"></a><?php */?>
                        </div>
                    </div>
                </li>
                <?php } 
				?>
            </ul>
            <?php }  
			else
			{
				echo "Sorry, No Matches found"; ?>
			<?php } ?>
     </div>
<?php
$select_banner = "select * from advertise where adv_position = 'Search Result Bottom (954 X 100)'";
$db_banner = $obj->select($select_banner);
if(count($db_banner) > 0) 
{
?>
<div style="margin: 10px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>
<?php } ?>
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
		
		$('#within_month').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'refine_search.php?hint=curr_month',
				   success: function(data) {
					   $('#content_data').html( data );
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