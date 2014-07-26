<?php
session_start();

//TO ACTIVATE PROFILE
if($_GET['flag'] == 'activate_profile')
{
	$update="UPDATE members 
				  SET 
				  		is_profile_active = 'Y'				  		
				 where 
				 		id = '".$_SESSION['logged_user'][0]['id']."'";
		


						$db_updatepage=$obj->edit($update);	
						echo "<script>window.location='edit_profile.php'</script>";
	
}
//to edit hobbies
if(isset($_POST['save_hobbies']))
	{
		$mem_hobbies = implode(",",$_POST['chkHobbies']);
		$final_mem_hobbies["mem_hobbies"] = ($mem_hobbies);
		
		$mem_int = implode(",",$_POST['chkInterests']);
		$final_mem_int["mem_int"] = ($mem_int);
		
		$mem_music = implode(",",$_POST['chkMusic']);
		$final_mem_music["mem_music"] = ($mem_music);
		
		$mem_read = implode(",",$_POST['chkRead']);
		$final_mem_read["mem_read"] = ($mem_read);
		
		$mem_movies = implode(",",$_POST['chkMovies']);
		$final_mem_movies["mem_movies"] = ($mem_movies);
		
		$mem_sports = implode(",",$_POST['chkSports']);
		$final_mem_sports["mem_sports"] = ($mem_sports);
		
		$mem_couisine = implode(",",$_POST['chkCouisine']);
		$final_mem_couisine["mem_couisine"] = ($mem_couisine);
		
		$sql = "select * from memebr_hobbies_interest 
				where member_id = '".$_SESSION['logged_user'][0]['id']."'";
		$ans = $obj->select($sql);
		if(empty($ans)){
			$insert = "insert into memebr_hobbies_interest
							(id,member_id,hobbies,interests,music,read_book,movies,sports,cuisine)
						VALUES
							(NULL,'".$_SESSION['logged_user'][0]['id']."','".$final_mem_hobbies["mem_hobbies"]."',
							 '".$final_mem_int["mem_int"]."','".$final_mem_music["mem_music"]."',
							 '".$final_mem_read["mem_read"]."','".$final_mem_movies["mem_movies"]."',
							 '".$final_mem_sports["mem_sports"]."','".$final_mem_couisine["mem_couisine"]."')";
			
			$result = $obj->insert($insert);	
		}
		echo "<script>window.location='packages.php'</script>";	
		}
//to deactivte account

if($_GET['flag'] == 'deactivate_prof')
{
	$update="UPDATE members 
				  SET 
				  	is_profile_active = 'N'				  		
				 where 
				 	id = '".$_SESSION['logged_user'][0]['id']."'";
	$db_updatepage=$obj->edit($update);	
   echo "<script>window.location='edit_profile.php'</script>";
}
//to delete account
if($_GET['flag'] == 'del_prof')
{
	$delete_acc="delete from members 
				 where 
				 id = '".$_SESSION['logged_user'][0]['id']."'";
	$obj->sql_query($delete_acc);
	echo "<script>window.location='logout.php'</script>";
}
if(isset($_POST['parent_form']))
{
	$update_member="update members set parents_contact_number='".$_POST['parent_number']."' where id='".$_SESSION['logged_user'][0]['id']."'";
	$obj->edit($update_member);
	echo "<script>window.location='my_account.php'</script>";
}

if(isset($_POST['Twitter_form']))
{
	$update_member="update members set Twitter='".$_POST['Twitter']."' where id='".$_SESSION['logged_user'][0]['id']."'";
	$obj->edit($update_member);
	echo "<script>window.location='my_account.php'</script>";
}

if(isset($_POST['LinkedIn_form']))
{
	$update_member="update members set LinkedIn='".$_POST['LinkedIn']."' where id='".$_SESSION['logged_user'][0]['id']."'";
	$obj->edit($update_member);
	echo "<script>window.location='my_account.php'</script>";
}

if(isset($_POST['Facebook_form']))
{
	$update_member="update members set Facebook='".$_POST['Facebook']."' where id='".$_SESSION['logged_user'][0]['id']."'";
	$obj->edit($update_member);
	echo "<script>window.location='my_account.php'</script>";
}

if(isset($_POST['Reference_form']))
{
	$update_member="update members set Reference='".$_POST['Reference']."' where id='".$_SESSION['logged_user'][0]['id']."'";
	$obj->edit($update_member);
	echo "<script>window.location='my_account.php'</script>";
}

if(isset($_POST['family_details_form']))
{
	$update_member="update members set father_occupation='".$_POST['father_occupation']."', no_of_brothers='".$_POST['no_of_brothers']."', living_with_parents='".$_POST['living_with_parents']."', family_type='".$_POST['family_type']."', mother_occupation='".$_POST['mother_occupation']."', no_of_sisters='".$_POST['no_of_sisters']."', family_value='".$_POST['family_value']."', family_status='".$_POST['family_status']."' where id='".$_SESSION['logged_user'][0]['id']."'";
	$obj->edit($update_member);
	echo "<script>window.location='my_account.php'</script>";
}


//to edit family details

if(isset($_POST['save_family_details']))
{
		$update_horoscope = "update members 
				   set
				   family_status = '".$_POST['drpFamilyStatus']."',
				   family_value = '".$_POST['drpFamilyValues']."',
				   family_type = '".$_POST['drpFamilyType']."'
				   where id = '".$_SESSION['logged_user'][0]['id']."'";
		$update = $obj->edit($update_horoscope);	
		echo "<script>window.location='edit_profile.php'</script>";	
}
//to edit horoscope match
if(isset($_POST['save_horoscope_match']))
{
		$update_horoscope = "update members 
				   set
				   horoscope_match = '".$_POST['horoscope']."'
				   where id = '".$_SESSION['logged_user'][0]['id']."'";
		$update = $obj->edit($update_horoscope);	
		echo "<script>window.location='edit_profile.php'</script>";	
}
//to edit partner pref
if(isset($_POST['save_pref_partner']))
{
		$sql = "select * from preferred_partner_details
				   where from_mem = '".$_SESSION['logged_user'][0]['id']."'";
		$select_sql = $obj->select($sql);	
		if(empty($select_sql))
		{
			$pref_age = $_POST['drpAgeFrom']."to".$_POST['drpAgeTo'];
                $select_last_id = "SELECT max(id) as last_id from members";
                $last_ins_id =  $obj->select($select_last_id);
		$insert = "insert into preferred_partner_details
				  	(from_mem,id,preferred_age,marital_status,height,physical_status,religion,mother_tongue,caste,				   	 manglik,star,food,is_drinker,is_smoker,country,city,education,occupation,annual_income,partner_description)
				  values
				    ('".$_SESSION['logged_user'][0]['id']."',NULL,'".$pref_age."','".$_POST['drpMaritalStatus']."',
					 '".$_POST['drpHeight']."','".$_POST['drpPhysicalStatus']."','".$_POST['drpReligion']."',
					 '".$_POST['drpMotherlanguage']."','".$_POST['drpCaste']."','".$_POST['drpManglik']."',
					 '".$_POST['drpStar']."','".$_POST['drpFood']."','".$_POST['drpDrinking']."','".$_POST['drpSmoking']."'
					 ,'".$_POST['drpCountry']."','".$_POST['city']."','".$_POST['drpEducation']."','".$_POST['drpOccupation']."'
					 ,'".$_POST['drpAnnualIncome']."','".$_POST['partner_description']."')";
		$db_ins=$obj->insert($insert);
		}
		else
		{
			$update_page = "update preferred_partner_details
			 				set
							preferred_age = '".$pref_age."',marital_status = '".$_POST['drpMaritalStatus']."',
							height = '".$_POST['drpHeight']."',physical_status = '".$_POST['drpPhysicalStatus']."' ,
							religion = '".$_POST['drpReligion']."',mother_tongue = '".$_POST['drpMotherlanguage']."' ,
							caste = '".$_POST['drpCaste']."'     ,manglik = '".$_POST['drpManglik']."',
							star ='".$_POST['drpStar']."' ,food ='".$_POST['drpFood']."' ,is_drinker = '".$_POST['drpDrinking']."',
							country = '".$_POST['drpCountry']."',city = '".$_POST['city']."',
							education = '".$_POST['drpEducation']."',occupation = '".$_POST['drpOccupation']."',
							annual_income = '".$_POST['drpAnnualIncome']."' ,partner_description = '".$_POST['partner_description']."'
							where from_mem = '".$_SESSION['logged_user'][0]['id']."'";
						
			$update_sql = $obj->edit($update_page);
							
		}
		
		echo "<script>window.location='edit_profile.php'</script>";	
}


//to edit mobile no

if(isset($_POST['save_mobile_no']))
{
	$update_mob = "update members 
				   set
				   mobile_no = '".$_POST['mobile_no']."'
				   where id = '".$_SESSION['logged_user'][0]['id']."'";
			   
	$update = $obj->edit($update_mob);	
	echo "<script>window.location='edit_profile.php'</script>";			   
}
if(isset($_POST['upload']) || isset($_POST['upload_pic']))
{
	
	if(!empty($_FILES['file']['name'][0]))
		{
			$fileLink = "upload/". $_FILES['file']['name'][0];
			$fileType = $_FILES['file']['type'][0];
			$fileSize = ($_FILES['file']['type'][0]) / 1024;
			$source = "$fileLink";
			
			if ((move_uploaded_file($_FILES["file"]["tmp_name"][0], $source))) { 
			
			$sql = "select * from member_photos
					where member_id = '".$_SESSION['logged_user'][0]['id']."'";
			$chk_exist_photo = $obj->select($sql);
			if(!empty($chk_exist_photo))
			{		
					$update_pic = "update member_photos
							   set
							   	photo = '".$_FILES["file"]["name"][0]."'
							   where 
								member_id = '".$_SESSION['logged_user'][0]['id']."'";
					$ans = $obj->edit($update_pic);
			}
			else
			{
				$insert = "insert into member_photos (id,member_id,photo)
							value
							(NULL,'".$_SESSION['logged_user'][0]['id']."','".$_FILES["file"]["name"][0]."')";
				$res = $obj->insert($insert);			
			}
		}						
	}
	
		if(isset($_POST['upload_pic']))
		{
			echo "<script>window.location='edit_profile.php'</script>";
		}
		else
		{
			echo "<script>window.location='my_account.php'</script>";
		}
			//end photo  upload

}
//LOGGED-IN USER'S DETAIL //
	$sql_login = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.id = '".$_SESSION['logged_user'][0]['id']."' and
				members.status = 'Active'";	


	$logged_in_member=$obj->select($sql_login);
	
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
	
	$update_page="UPDATE members 
				  SET 
				  		profile_for = '".$_POST['drpProfFor']."',name = '".$_POST['username']."',gender = '".$_POST['Rdgender']."',
						religion = '".$_POST['drpReligion']."',caste = '".$_POST['drpCaste']."',country = '".$_POST['drpCountry']."',
						place_of_birth = '".$_POST['place_of_birth']."',email_id = '".$_POST['email']."',
						date_of_birth = '".date('Y-m-d',strtotime($_POST['dob']))."',mother_tongue =  '".$_POST['drpMotherlanguage']."',
						mobile_no = '".$_POST['txtMobNo']."',education = '".$_POST['education']."',occupation =  '".$_POST['occupation']."',
						employed_in = '".$_POST['employed_in']."',annual_income = '".$_POST['annual_income']."',
						mob_code = '".$_POST['drpMobcodedata']."',about_me = '".$_POST['about_me']."',
						body_type = '".$_POST['drpBodyType']."',living_with_parents = '".$_POST['drpLiving']."',
						family_value = '".$_POST['drpFamilyValue']."',is_smoker = '".$_POST['drpSmoking']."',
						is_drinker = '".$_POST['drpDrinking']."',eating_habits = '".$_POST['drpEatingHabits']."',
						partner_prefrence = '".$_POST['partner_preference']."'
						
				  		
				 where 
				 		id = '".$_SESSION['logged_user'][0]['id']."'";
				
						$db_updatepage=$obj->edit($update_page);	
						echo "<script>window.location='my_account.php?ratio=".$ratio."'</script>";
}	

		
?>
<div  class="mid col-md-12 col-sm-12 col-xs-12 nopadding">

<div class="mid_top">
        	<a class="ajax send_email_btn upload_pic inline" href="#upload_photo" >
            <?php
					if(!empty($logged_in_member[0]['photo']))
					{
					 	$path = "upload/".$logged_in_member[0]['photo'];
						if (file_exists($path)) { 
                     			echo '<img title="click here to upload photo" class="profile_pic" src="'.$path.'"/>';
						}
						else{
							if($_SESSION['logged_user'][0]['gender']=='M')
								echo '<img title="click here to upload photo" class="profile_pic" src="'."images/male-user2.png".'"/>';
							else
								echo '<img title="click here to upload photo" class="profile_pic" src="'."images/female-user2.png".'"/>';
						}
					}
					else{
							if($_SESSION['logged_user'][0]['gender']=='M')
								echo '<img title="click here to upload photo" class="profile_pic" src="'."images/male-user2.png".'"/>';
							else
								echo '<img title="click here to upload photo" class="profile_pic" src="'."images/female-user2.png".'"/>';
						}
			 	?>
            <?php /*?><img src="images/add_male_user.png" /><?php */?>
            </a>
            
            
            <div class="left-display-social">
                <div class="profile_complete">Your profile is <span class="cbar"><span class="cbar_in"><?php if(isset($ratio)) { echo $ratio."%"; } else{ ?>30%<?php } ?></span></span> complete. For better responses, complete your profile.</div>
                <div class="social-display">
                	<div class="sd-left">
                   <?php /*?> <a class="ajax send_email_btn" href="include/add_horoscope.php?mem_id=<?php echo $_SESSION['logged_user']['member_id'];?>"><span class="icon horonotaddedicon"></span>Add Horoscope</a> <?php */?>
                       <!-- <a href="#"><span class="icon horonotaddedicon"></span>Add Horoscope</a>--><br />
                        <?php if($logged_in_member[0]['parents_contact_number']==''){ ?>
                        <a class="inline" href="#parent_number"><span class="icon1 pphone"></span>Add Parents' Contact Number</a><br />
                        <?php } ?>
                        
                        <?php if($logged_in_member[0]['Reference']==''){ ?>
                        <a class="inline" href="#refenece"><span class="icon referenceiconoff"></span>Add Reference</a><br />
                        <?php } ?>
                        
                        <?php if($logged_in_member[0]['father_occupation']=='' || $logged_in_member[0]['mother_occupation']=='' || $logged_in_member[0]['no_of_brothers']=='' || $logged_in_member[0]['no_of_sisters']=='' || $logged_in_member[0]['living_with_parents']=='' || $logged_in_member[0]['family_value']=='' || $logged_in_member[0]['family_type']=='' || $logged_in_member[0]['family_status']==''){ ?>
                        <a class="inline" href="#family_details"><span class="icon2 gfamily-icon"></span>Add Family details</a>
                        <?php } ?>
                    </div>
                    <div class="sd-left">
                    	<?php if($logged_in_member[0]['Facebook']=='' && $logged_in_member[0]['LinkedIn']=='' && $logged_in_member[0]['Twitter']==''){ ?>
                        <h4>To display your social side</h4>
                        <?php } ?>
                        
						<?php if($logged_in_member[0]['Facebook']==''){ ?>
                        <a class="inline" href="#facebook_member"><span class="icon3 fbicon"></span>Add Facebook</a><br />
                        <?php } ?>
                        <?php if($logged_in_member[0]['LinkedIn']==''){ ?>
                        <a class="inline" href="#linkedin_member"><span class="icon3 linicon"></span>Add LinkedIn</a><br />
                        <?php }?>
                        <?php if($logged_in_member[0]['Twitter']==''){ ?>
                        <a class="inline" href="#twitter_member"><span class="icon3 twicon"></span>Add Twitter</a>
                        <?php } ?>
                    </div>
                </div>
			</div>
            <div class="become_paid_member">
            	<h3>Become a paid member and avail these benefits</h3>
                <a href="#" class="pay_now_btn">Pay Now</a>
                <ul>
                	<li>Send personalised messages.</li>
                    <li>Chat online with members.</li>
                    <li>Call/SMS members directly. <a href="#" class="more">More</a></li>
                </ul>
            </div>
                                 
        </div>
        
        <div class="sidebar">
           <div class="sidebar-main">
            	<h2>My profile</h2>
                <div class="sidebar-cont">
                    <div id="tab-container1">
                        <ul class="msgtab" style="display:none">
                            <li><a href="#msgtab-1">Inbox</a></li>
                            <li><a href="#msgtab-12">Sent</a></li>
                        </ul>
                        <div class="msgtab_content1" id="msgtab-1">
                        	<div class="list-msgs">
                                <ul class="list1">
                                 <li><a href="#" id="upload_pic"><span class="icon msgnew"></span></span>Upload Photo</a></li>
                                   
                                    <div class="colorbox">
                                        <div id="inline_content">
                                            <div class="colorbox-content">
                                                Lorem ipsum dolor sit amet, 
                                            </div>
                                        </div>
                                    </div>
                                    <?php $sql_select = "select * from members where id = '".$_SESSION['logged_user'][0]['id']."'";
										  $result = $obj->select($sql_select);  	 ?>
                                    <li><a href="#" id="edit_mobile"><span class="icon msgnoreply"></span>Edit Mobile Number</a></li>
                                    <li><a href="#" id="add_horoscope"><span class="icon msgreply"></span>Add Horoscope</a></li>
                                    <li><a href="#" id="partner_pref"><span class="icon msgreply"></span>Add/Edit Partner Preference</a></li>
                                    <li><a href="#" id="family_detail"><span class="icon msgreply"></span>Add/Edit Family Details</a></li>
                                    <li><a href="#" id="hobbies"><span class="icon msgreply"></span>Add/Edit Hobbies & Interests</a></li>
                                    <?php if($result[0]['is_profile_active'] == "Y") { ?>
                                    <li><a href="edit_profile.php?flag=deactivate_prof"><span class="icon msgreply"></span>Deactivate Profile</a></li><?php } 
									else {?>
                                    <li><a href="edit_profile.php?flag=activate_profile"><span class="icon msgreply"></span>Activate Profile</a></li><?php } ?>
                                    <li><a href="edit_profile.php?flag=del_prof"><span class="icon msgreply"></span>Delete Profile</a></li>
                                </ul>                                
							</div>   
                               
                                                            
                        </div>
                        
                    </div>
                </div>
            </div>
           <div class="sidebar-main">
            	<h2>Messages</h2>
                <div class="sidebar-cont">
                    <div id="tab-container">
                        <ul class="msgtab">
                            <li><a href="#msgtab-1">Inbox</a></li>
                            <li><a href="#msgtab-2">Sent</a></li>
                        </ul>
                        <div class="msgtab_content" id="msgtab-1">
                        	<div class="list-msgs">
                                <h3>Personalised Messages <span>(0)</span></h3>
                                <?php
									$sql="select * from messages 
				  						  where
									      to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";	 			  
									$ans=$obj->select($sql);
								?>
                                <ul class="list1">
                                 <li><a href="#"><span class="icon msgnew"></span></span>Message received(<?php echo count($ans); ?>)</a></li>
                                   
                                    <div class="colorbox">
                                        <div id="inline_content">
                                            <div class="colorbox-content">
                                                Lorem ipsum dolor sit amet, 
                                            </div>
                                        </div>
                                    </div>
                                    <li><a href="#"><span class="icon msgnoreply"></span>Read by members (0)</a></li>
                                     <?php
									$sql="select * from messages 
				  						  where
									      to_mem = '".$_SESSION['logged_user'][0]['email_id']."'";				  
									$ans=$obj->select($sql);
								?>
                                    <li><a href="#"><span class="icon msgreply"></span>Unread (<?php echo count($ans); ?>)</a></li>
                                </ul>
                                <a href="#" class="more">More</a>
							</div>   
                            <div class="list-msgs">
                            	<h3>Express Interest <span>(1)</span></h3>
                                <?php
									$sql="select * from express_interest 
				  						  where
									      to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and is_accepted='N'";		
										 
									$new_int=$obj->select($sql);
								?>
                                <ul class="list1">
                                    <li><a href="#" id="new_interest"><span class="icon expnew"></span>New (<?php echo count($new_int); ?>)</a></li>
                                    <?php
									$sql="select * from express_interest 
				  						  where
									      to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and is_accepted='Y'";				  
										  
									$accpted=$obj->select($sql);
									 ?>	
                                    <li><a href="#" id="accepted"><span class="icon expacpt"></span>Accepted (<?php echo count($accpted); ?>)</a></li>
                                    <li><a href="#"><span class="icon expinfo"></span>Need More Info/Time (0)</a></li>
                                </ul>
                                <a href="#" class="more">More</a>
							</div>   
                            <div class="list-msgs">
                                <h3>Requests <span>(1)</span></h3>
                                <ul class="list1">
                                    <li><a href="#"><span class="icon reqphoto"></span>Photo (1)</a></li>
                                    <li><a href="#"><span class="icon referenceicon "></span>Reference (0)</a></li>
                                </ul>
                                <a href="#" class="more">More</a>
							</div>                                
                        </div>
                        <div class="msgtab_content" id="msgtab-2">
                            <div class="list-msgs">
                                <h3>Personalised Messages <span>(0)</span></h3>
                                <ul class="list1">
                                    <li><a href="#"><span class="icon msgrecpaid"></span>Messages received (0)</a></li>
                                    <li><a href="#"><span class="icon msgreadpaid"></span>Read by members (0)</a></li>
                                    <li><a href="#"><span class="icon msgnotreadpaidmem"></span>Unread (0)</a></li>
                                </ul>
                                <a href="#" class="more">More</a>
							</div>   
                            <div class="list-msgs">
                             <?php
									$sql="select * from express_interest 
				  						  where
									      to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and is_accepted='Y'";				  
									$total_acc=$obj->select($sql);
								?>
                                <h3>Express Interest <span>(1)</span></h3>
                                <ul class="list1">
                                    <li><a href="#"><span class="icon expacpt"></span>Accepted (<?php echo count($total_acc); ?>)</a></li>
                                    <li><a href="#"><span class="icon expinfo"></span>Reply Pending (0)</a></li>
                                    <li><a href="#"><span class="icon expdec"></span>Need More Info/Time (0)</a></li>
                                </ul>
                                <a href="#" class="more">More</a>
							</div>   
                            <div class="list-msgs">
                                <h3>Requests <span>(1)</span></h3>
                                <ul class="list1">
                                    <li><a href="#"><span class="icon reqphoto"></span>Photo (1)</a></li>
                                    <li><a href="#"><span class="icon referenceicon "></span>Reference (0)</a></li>
                                </ul>
                                <a href="#" class="more">More</a>
							</div>   
                            <div class="list-msgs">
                                <h3>Voice Messages <span>(0)</span></h3>
							</div>          
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(!empty($logged_in_member)) { ?>	  
        <div class="content">
        
        	<div class="profile_details">
            
            	<form id="formID" class="form-horizontal" method="post" onsubmit="return check_form()">
    <div class="new_acc">           
         <div class="left">
         	 <label>Matrimony Profile For</label>
                    <select id="drpProfFor" name="drpProfFor"  onchange="return check_form()">
                        <option value="">-Select-</option>
                        <option value="Myself" <?php if($logged_in_member[0]['profile_for'] == "self") { ?>  selected="selected" <?php } ?> >Myself</option>
                        <option value="Son" <?php if($logged_in_member[0]['profile_for'] == "Son") { ?>  selected="selected" <?php } ?>>Son</option>
                        <option value="Daughter" <?php if($logged_in_member[0]['profile_for'] == "Daughter") { ?>  selected="selected" <?php } ?>>Daughter</option>
                        <option value="Brother" <?php if($logged_in_member[0]['profile_for'] == "Brother") { ?>  selected="selected" <?php } ?>>Brother</option>
                        <option value="Sister" <?php if($logged_in_member[0]['profile_for'] == "Sister") { ?>  selected="selected" <?php } ?>>Sister</option>
                        <option value="Relative" <?php if($logged_in_member[0]['profile_for'] == "Relative") { ?>  selected="selected" <?php } ?>>Relative</option>
                        <option value="Friend" <?php if($logged_in_member[0]['profile_for'] == "Friend") { ?>  selected="selected" <?php } ?>>Friend</option>
                    </select>
                    
                    <label>Name</label>
                    <input type="text" name="username" id="username" value="<?php echo $logged_in_member[0]['name']; ?>"  onchange="return check_form()" />
                    
                    <?php if (isset($error)) { echo "<p class='message'>" .$error. "</p>" ;} ?>
                    <label>Gender</label><br class="clear" />
                    <div id="genderRadio">
                    <label class="radiobtn">
                    	<input type="radio" name="Rdgender" id="Rdgender" value="M" <?php if($logged_in_member[0]['gender'] == 'M') { ?> checked="checked"  <?php } ?> />Male
                    </label>
                    <label class="radiobtn">
                    	<input type="radio" value="F" name="Rdgender" <?php if($logged_in_member[0]['gender'] == 'F') { ?> checked="checked" <?php } ?> />Female
                    </label>
                    </div>
                     <label>Religion</label>
                    <?php
						$religion_list = "select * from religions";
						$data = $obj->select($religion_list);
					?>
                    <select name="drpReligion" id="drpReligion" onchange="return check_form()" />
                         <option value="">- Select -</option>
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['religion']; ?>" 
								<?php if($logged_in_member[0]['religion'] == $res['religion']) {  ?> selected="selected" <?php } ?> >
								<?php echo $res['religion']; ?></option>
                        <?php } ?>
                    </select>
                    <label>Caste</label>
                    <?php
						$caste_list = "select * from caste";
						$data = $obj->select($caste_list);
					?>
                    <select name="drpCaste" id="drpCaste" onchange="return check_form()">
                        <option value=""> -Select- </option>
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['caste']; ?>"
                            <?php if($logged_in_member[0]['caste'] == $res['caste']) {  ?> selected="selected" <?php } ?> >
							<?php echo $res['caste']; ?></option>
                        <?php } ?>
                    </select>
                     <label>Country Living In</label>
                    <?php
						$country_list = "select * from mobile_codes";
						$data = $obj->select($country_list);
					?>
                    <select name="drpCountry" id="drpCountry" onchange="return check_form()" />
                        <option value="">- Select -</option>
                        <?php foreach($data as $res) { ?>
                        <option value="<?php echo $res['country']; ?>"
                        <?php if($logged_in_member[0]['country'] == $res['country']) {  ?> selected="selected" <?php } ?> >
						<?php echo $res['country']; ?></option>
                        <?php } ?>
                    </select>
                     
                     <label>Mobile Number</label><br clear="all" />
                    <div id="drpMobcodedata" style="float:left">
                    	<?php
						$select_category2 = "select * from mobile_codes";
						$db_category2 = $obj->select($select_category2);
						?>
                        <select  id="drpMobcode" name="mob_code" style="width:75px;">
                        <?php foreach($db_category2 as $db) {  ?>
							<option value="<?php echo $db['mob_code']; ?>" <?php if($db['mob_code'] == $logged_in_member[0]['mob_code']){ ?> selected="selected" <?php } ?>}) ?><?php echo $db['mob_code']; ?></option>
                            
<?php } ?>
						</select>
                    </div>
                    
                    <input type="text" name="txtMobNo" value="<?php echo $logged_in_member[0]['mobile_no']; ?>"  id="txtMobNo" style="width: 170px;margin-left: 5px;clear: none;" onchange="return check_form()" />
					<label>About You</label><br />
		         	<textarea id="about_me" style="width:265px;height:60px" name="about_me"><?php echo $logged_in_member[0]['about_me']; ?></textarea><br />
                    <label>Body type</label>
                     <select name="drpBodyType" id="drpBodyType" onchange="return check_form()" >
	                    <option value="">Select</option>
                     	<option value="Slim" <?php if($logged_in_member[0]['body_type'] == "Slim") { ?> selected="selected" <?php } ?>>Slim</option>
                     	<option value="Athletic" <?php if($logged_in_member[0]['body_type'] == "Athletic") { ?> selected="selected" <?php } ?>>Athletic</option>
                     	<option value="Average" <?php if($logged_in_member[0]['body_type'] == "Average") { ?> selected="selected" <?php } ?>>Average</option>
                        <option value="Heavy" <?php if($logged_in_member[0]['body_type'] == "Heavy") { ?> selected="selected" <?php } ?>>Heavy</option>   
                    </select> 
                     <label>Living with Parents?</label>
                     <select name="drpLiving" id="drpLiving" onchange="return check_form()" >
                     	<option value="">Select</option>
                        <option value="Y" <?php if($logged_in_member[0]['living_with_parents'] == "Y"){?> selected="selected" <?php } ?>>Yes</option>	
                        <option value="N" <?php if($logged_in_member[0]['living_with_parents'] == "N"){?> selected="selected" <?php } ?>>No</option>
                     </select> 
                     <label>Partner Preference</label><br />
		         	<textarea id="partner_preference" style="width:265px;height:60px" name="partner_preference"><?php echo $logged_in_member[0]['partner_prefrence']; ?></textarea><br />
						                                                  	           											
         </div>
         <div class="right">
                	
                    
                    <label>Education</label>
                    <input type="text" name="education" id="education" onchange="return check_form()" />
                    <label>Place of Birth</label>
                    <input type="text" name="place_of_birth" id="place_of_birth" value="<?php echo $logged_in_member[0]['country']; ?>"  onchange="return check_form()" />
                    
                    
                    <label>Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $logged_in_member[0]['email_id']; ?>" onchange="return check_form()">
                    <label>Date of Birth</label>
                     
                                    <div class="controls">
                   	<input type="text" class="date-picker" value="<?php echo $logged_in_member[0]['date_of_birth']; ?>" id="dob" name="dob" />
</div>
                    
                    <?php
						$list = "select * from mother_tongues";
						$data = $obj->select($list);
					?>	
											
                    <label>Mother Tongue</label>    
                    <select name="drpMotherlanguage" id="drpMotherlanguage" onchange="return check_form()" />
                        <option value=""> -Select- </option>
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['name']; ?>"
                             <?php if($logged_in_member[0]['mother_tongue'] == $res['name']) {  ?> selected="selected" <?php } ?> >
							<?php echo $res['name']; ?></option>
                        <?php } ?>
                    </select> 
                     
                   
                    
                    <label>Occupation</label>
                    <input type="text" name="occupation" id="occupation" onchange="return check_form()" />
                    
                    <label>Employed In</label>
                    <input type="text" name="employed_in" id="employed_in" onchange="return check_form()" />
                    
                    <label>Annual Income</label>
                    <input type="text" name="annual_income" id="annual_income" onchange="return check_form()" />
                    
                    <label>Family value</label>
 					<select name="drpFamilyValue" id="drpFamilyValue" onchange="return check_form()" />>
                    	<option value="">Select</option>
                        <option value="Orthodox" <?php if($logged_in_member[0]['family_value'] == "Orthodox"){?> selected="selected" <?php } ?>> Orthodox</option>
                        <option value="Traditional" <?php if($logged_in_member[0]['family_value'] == "Traditional"){?> selected="selected" <?php } ?>>Traditional</option>
                        <option value="Moderate" <?php if($logged_in_member[0]['family_value'] == "Moderate"){?> selected="selected" <?php } ?>>Moderate</option>
                        <option value="Liberal" <?php if($logged_in_member[0]['family_value'] == "Liberal"){?> selected="selected" <?php } ?>>Liberal</option>
                    </select>
                    <label>Smoking Habits</label>
 					<select name="drpSmoking" id="drpSmoking" onchange="return check_form()" />>
                    	<option value="">Select</option>
                        <option value="Y" <?php if($logged_in_member[0]['is_smoker'] == "Y"){?> selected="selected"<?PHP } ?>>Yes</option>
                        <option value="N" <?php if($logged_in_member[0]['is_smoker'] == "N"){?> selected="selected"<?PHP } ?>>No</option>
                        <option value="O" <?php if($logged_in_member[0]['is_smoker'] == "O"){?> selected="selected"<?PHP } ?>>Occasionally</option>
                    </select>
                     <label>Drinking Habits</label>
 					<select name="drpDrinking" id="drpDrinking" onchange="return check_form()" />>
                    	<option value="">Select</option>
                        <option value="Y" <?php if($logged_in_member[0]['is_drinker'] == "Y"){?> selected="selected"<?PHP } ?>>Yes</option>
                        <option value="N" <?php if($logged_in_member[0]['is_drinker'] == "N"){?> selected="selected"<?PHP } ?>>No</option>
                        <option value="O" <?php if($logged_in_member[0]['is_drinker'] == "O"){?> selected="selected"<?PHP } ?>>Occasionally</option>
                    </select>
                     <label>Eating Habits</label>
 					<select name="drpEatingHabits" id="drpEatingHabits" onchange="return check_form()" />>
                    	<option value="">Select</option>
                        <option value="Vegetarian" <?php if($logged_in_member[0]['eating_habits'] == "Vegetarian"){?> selected="selected"<?PHP } ?>>Vegetarian   </option>
                        <option value="Non-Vegetarian" <?php if($logged_in_member[0]['eating_habits'] == "Non-Vegetarian"){?> selected="selected"<?PHP } ?>> Non Vegetarian</option>
                        <option value="Eggetarian" <?php if($logged_in_member[0]['eating_habits'] == "Eggetarian"){?> selected="selected"<?PHP } ?>>Eggetarian</option>
                    </select>
                    
                   
         </div>
         <div class="terms_line">
                <!--<label class="checkbox"><input checked="checked" type="checkbox" /> I agree to the Find My Jodi <a href="privacy_policy.php">Privacy Policy</a> and <a href="terms_conditions.php">Terms and Conditions.</a></label>-->
                <input type="submit" name="submit" />
                </div>
    </div>            
          </form>
          </div>
        
		</div>
         
        <?php } else {
			?><div class="content_data"> <?php 
			echo "Your Profile is Deactivated.";?></div> <?php } ?>
            
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
