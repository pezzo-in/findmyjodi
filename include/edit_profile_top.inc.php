<?php
if(isset($_POST['upload']))
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
$sql_login = "SELECT members.*,member_photos.photo FROM members 
			LEFT JOIN member_photos ON members.id = member_photos.member_id
			WHERE
			members.id = '".$_SESSION['logged_user'][0]['id']."' and
			members.status = 'Active'";	
$logged_in_member=$obj->select($sql_login);
?>
<?php
$select_date = "select * from members where email_id = '".$_SESSION['UserEmail']."'";
$db_date = $obj->select($select_date);
?>
<?php 

	$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$_SESSION['logged_user'][0]['id']."' AND members.id=member_plans.member_id and member_plans.expiry_date>'".date('Y-m-d')."'";
	$db_member_plan=$obj->select($select_member_plan);
	
	//$exp_date='';
	
	if(count($db_member_plan)>0)
	{
		$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
		$db_plan=$obj->select($select_plan);
	}
	/*else
	{
		$exp_date=date('d M Y',strtotime('+1 month '.$db_date[0]['reg_date']));
	}*/
?>
<div class="mid_top1">
    <div class="prf_comp_percnt">
    	<?php
		$profile_complate=0;
		$select_member="select * from members where id='".$_SESSION['logged_user'][0]['id']."'";
		$db_member=$obj->select($select_member);
		if($db_member[0]['profile_for']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['education']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['name']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['place_of_birth']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['email_id']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['religion']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['date_of_birth']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['caste']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['country']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['occupation']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['employed_in']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['about_me']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['annual_income']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['body_type']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['family_value']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['living_with_parents']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['is_smoker']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['is_drinker']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['partner_prefrence']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['eating_habits']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['horoscope_match']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['family_status']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['family_type']!='')
			$profile_complate=$profile_complate+2;
		if($db_member[0]['family_value']!='')
			$profile_complate=$profile_complate+2;
		$select_member_photos="select * from member_photos where member_id='".$_SESSION['logged_user'][0]['id']."'";
		$db_member_photos=$obj->select($select_member_photos);
		if(count($db_member_photos)>0)
			$profile_complate=$profile_complate+2;
		
		$select_member_photos_gallery="select * from member_photo_gallery where member_id='".$_SESSION['logged_user'][0]['id']."'";
		$db_member_photos_gallery=$obj->select($select_member_photos_gallery);
		if(count($db_member_photos_gallery)>0)
			$profile_complate=$profile_complate+2;
			
		$select_preferred_partner_details="select * from preferred_partner_details where from_mem='".$_SESSION['logged_user'][0]['id']."'";
		$db_preferred_partner_details=$obj->select($select_preferred_partner_details);
		
		if(count($db_preferred_partner_details)>0)
		{
			if($db_preferred_partner_details[0]['preferred_age']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['marital_status']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['height']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['physical_status']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['religion']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['caste']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['mother_tongue']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['manglik']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['is_drinker']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['is_smoker']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['country']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['city']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['occupation']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['annual_income']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['partner_description']!='')
				$profile_complate=$profile_complate+2;
			if($db_preferred_partner_details[0]['food']!='')
				$profile_complate=$profile_complate+2;
		}
	
		$select_memebr_hobbies_interest="select * from memebr_hobbies_interest where member_id='".$_SESSION['logged_user'][0]['id']."'";
		$db_memebr_hobbies_interest=$obj->select($select_memebr_hobbies_interest);
		
		if(count($db_memebr_hobbies_interest)>0)
		{
			if($db_memebr_hobbies_interest[0]['hobbies']!='')
				$profile_complate=$profile_complate+2;
			if($db_memebr_hobbies_interest[0]['interests']!='')
				$profile_complate=$profile_complate+2;
			if($db_memebr_hobbies_interest[0]['music']!='')
				$profile_complate=$profile_complate+2;
			if($db_memebr_hobbies_interest[0]['read_book']!='')
				$profile_complate=$profile_complate+2;
			if($db_memebr_hobbies_interest[0]['movies']!='')
				$profile_complate=$profile_complate+2;
			if($db_memebr_hobbies_interest[0]['sports']!='')
				$profile_complate=$profile_complate+2;
			if($db_memebr_hobbies_interest[0]['cuisine']!='')
				$profile_complate=$profile_complate+2;
			if($db_memebr_hobbies_interest[0]['dress_style']!='')
				$profile_complate=$profile_complate+2;
		}
		
		?>
    	Your Profile Completed <?php echo $profile_complate; ?>%<br />
        <span class="cbar1">
        	<span class="cbar1_in" style="width:<?php echo $profile_complate; ?>%;<?php if($profile_complate>70){ echo "background:green"; }else if($profile_complate>50 && $profile_complate<=70){ echo 'background:#ff7f00'; } ?>"></span>
		</span>
	</div>
    
    <div class="membership_status">
    <div class="welcum-user">Welcome Back, <?php echo ucfirst($logged_in_member[0]['name']);?> (<?php echo $logged_in_member[0]['member_id']; ?>)</div>
    <h2>Membership Status: <span><?php if(count($db_member_plan)==0){ ?>Free Membership<?php }else{ echo $db_plan[0]['plan_name']; } ?></span></h2>
    
    <?php if(count($db_member_plan)==0){ ?> <div class="welcumback" style="text-align: right; margin-top: -30px; float: right; padding-bottom:4px;"><span>upgrade now to</span>
    <a href="packages.php" class="btn_paidmship" style="padding-bottom:4px; padding-top:4px;">Paid Membership</a></div><?php } ?>    
    <div class="created_on">Created Date : <span><?php echo date('d M Y',strtotime($db_date[0]['reg_date'])); ?></span>  <?php if(count($db_member_plan)>0){ ?>|   
    Expiry Date :  <span><?php echo date('d M Y',strtotime($db_member_plan[0]['expiry_date'])); ?></span>  <?php } ?> 
    |   Last Login Date : <span>
	<?php if($db_date[0]['last_login'] == '0000-00-00') { ?>
    <?php echo date('d M Y'); ?>
    <?php } else { ?>
    <?php echo date('d M Y',strtotime($db_date[0]['last_login'])); ?>
    <?php } ?>
	</span></div>
    </div>            
</div>
<?php /*?><div class="mid_top" style="display:none;">
        	<a class="ajax send_email_btn upload_pic inline" href="#upload_photo" >
            <?php
					if(!empty($logged_in_member[0]['photo']))
					{
					 	$path = "upload/".$logged_in_member[0]['photo'];
						if (file_exists($path)) { 
                     			echo '<img title="click here to upload photo" class="profile_pic" src="'.$path.'"/>';
						}
						
					}
					else{
							
							//fetch from gallery
							$photos = "select * from member_photo_gallery 
							   		   where
							   		   member_id = '".$_SESSION['logged_user'][0]['id']."'";
							$result_pic = $obj->select($photos);
							if(!empty($result_pic))
							{
								$path2 = "../upload/".$result_pic[0]['photo'];
								echo '<img title="click here to upload photo" class="profile_pic" src="'.$path2.'"/>';
							} 
							else
							{
								
								if($_SESSION['logged_user'][0]['gender']=='M')
									echo '<img title="click here to upload photo" class="profile_pic" src="'."images/male-user2.png".'"/>';
								else
									echo '<img title="click here to upload photo" class="profile_pic" src="'."images/female-user2.png".'"/>';
							}
						}
			 	?>
            
            </a>
            
            
            <div class="left-display-social">
                <div class="profile_complete">Your profile is <span class="cbar"><span class="cbar_in"><?php if(isset($ratio)) { echo $ratio."%"; } else{ ?>30%<?php } ?></span></span> complete. For better responses, complete your profile.</div>
                <div class="social-display">
                	<div class="sd-left">
                   
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
                    	<?php if($logged_in_member[0]['Facebook']=='' || $logged_in_member[0]['LinkedIn']=='' || $logged_in_member[0]['Twitter']==''){ ?>
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
            
           <?php
		   $select_plan="select member_plans.*,new_membership_plans.plan_duration, new_membership_plans.plan_name from member_plans, new_membership_plans where new_membership_plans.id=member_plans.plan_id AND member_id='".$_SESSION['logged_user'][0]['id']."' order by purchase_date DESC";
		   $db_plan=$obj->select($select_plan);
		   
		   if(count($db_plan)>0)
		   {
			   $date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_plan[0]['purchase_date']));   
			   
			   if(date('Y-m-d')>$date)
			   {
		   ?> 
            <div class="become_paid_member">
            	<h3>Become a paid member and avail these benefits</h3>
                <a href="packages.php?redirect=account" class="pay_now_btn">Pay Now</a>
                <ul>
                	<li>Send personalised messages.</li>
                    <li>Chat online with members.</li>
                    <li>Call/SMS members directly. <a href="#" class="more">More</a></li>
                </ul>
            </div>
           <?php }else{ ?>
           <div class="become_paid_member">
            	<h3>Plan: <?php echo $db_plan[0]['plan_name']; ?></h3>
                <ul>
                	<li>Expiry Date. <?php echo date('d-m-Y',strtotime($date)); ?></li>
                </ul>
            </div>
           <?php } ?>
         <?php }else{ ?>
         	<div class="become_paid_member">
            	<h3>Become a paid member and avail these benefits</h3>
                <a href="packages.php?redirect=account" class="pay_now_btn">Pay Now</a>
                <ul>
                	<li>Send personalised messages.</li>
                    <li>Chat online with members.</li>
                    <li>Call/SMS members directly. <a href="#" class="more">More</a></li>
                </ul>
            </div>
         <?php } ?>
                                 
        </div><?php */?>
        
        
        
<?php /*?><div style='display:none'>
    <div id='upload_photo' style='padding:10px; background:#fff;'>
    	<form enctype="multipart/form-data" method="post" >
            <div class="new_acc">
            <p><strong><h3>Upload Your Photo</h3></strong></p>
            <?php
			if (file_exists($path)) { 
			echo '<img title="click here to upload photo" class="profile_pic" src="'.$path.'" style="width:75px;" />';
			}			
			else if($_SESSION['logged_user'][0]['gender']=='M')
				echo '<img title="click here to upload photo" class="profile_pic" src="'."images/male-user2.png".'"/>';
			else
				echo '<img title="click here to upload photo" class="profile_pic" src="'."images/female-user2.png".'"/>';
			?><br /><br />
            <input type="file" name="file[]" multiple="true" class="span6 m-wrap required" style="color:black" /><br />
            <input type="submit" name="upload" value="Upload" style="padding:5px">	
            </div>
        </form>
    </div>
</div><?php */?>
<!--<div style='display:none'>
    <div id='parent_number' style='padding:10px; background:#fff;'>
    	<form method="post" >
            <p><strong><h3>Parents' Contact Number</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>Contact Number</label>
                    <input type="text" value="" id="parent_number" name="parent_number">
                 </div>
                 <input type="submit" name="parent_form" value="parent_form">
			</div>            
        </form>
    </div>
</div>-->
<!--<div style='display:none'>
    <div id='refenece' style='padding:10px; background:#fff;'>
    	<form method="post" >
            <p><strong><h3>Reference</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>Reference</label>
                    <input type="text" value="" id="Reference" name="Reference">
                 </div>
                 <input type="submit" name="Reference_form" value="Reference_form">
			</div>            
        </form>
    </div>
</div>-->
<?php /*?><div style='display:none'>
    <div id='family_details' style='padding:10px; background:#fff;'>
    	<form method="post" >
            <p><strong><h3>Family Details</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>Father's Occupation</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['father_occupation']; ?>" id="father_occupation" name="father_occupation">
                    
                    <label>Brothers</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['no_of_brothers']; ?>" id="no_of_brothers" name="no_of_brothers">
                    
                    <label>Living with parents?</label>
                    <select name="living_with_parents">
                    	<option value="">Select</option>
                        <option value="Y" <?php if($logged_in_member[0]['living_with_parents']=='Y'){ ?> selected="selected" <?php } ?> >Yes</option>
                        <option value="N" <?php if($logged_in_member[0]['living_with_parents']=='N'){ ?> selected="selected" <?php } ?>>No</option>
                    </select>                    
                    
                    <label>Family Type</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['family_type']; ?>" id="family_type" name="family_type">
                 </div>
                 
                 <div class="right">
                 	<label>Mother's Occupation</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['mother_occupation']; ?>" id="mother_occupation" name="mother_occupation">
                    
                    <label>Sisters</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['no_of_sisters']; ?>" id="no_of_sisters" name="no_of_sisters">
                    
                    <label>Family values</label>
                    <select name="family_value" id="family_value" />
                    	<option value="">Select</option>
                        <option value="Orthodox" <?php if($logged_in_member[0]['family_value'] == "Orthodox"){?> selected="selected" <?php } ?>> Orthodox</option>
                        <option value="Traditional" <?php if($logged_in_member[0]['family_value'] == "Traditional"){?> selected="selected" <?php } ?>>Traditional</option>
                        <option value="Moderate" <?php if($logged_in_member[0]['family_value'] == "Moderate"){?> selected="selected" <?php } ?>>Moderate</option>
                        <option value="Liberal" <?php if($logged_in_member[0]['family_value'] == "Liberal"){?> selected="selected" <?php } ?>>Liberal</option>
                    </select>
                    
                    <label>Family Status</label>
                    <input type="text" value="<?php echo $logged_in_member[0]['family_status']; ?>" id="family_status" name="family_status">
                    
                 </div>
                 <input type="submit" name="family_details_form" value="family_details_form">
			</div>            
        </form>
    </div>
</div><?php */?>
<!--<div style='display:none'>
    <div id='facebook_member' style='padding:10px; background:#fff;'>
    	<form method="post" >
            <p><strong><h3>Facebook Url</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>Facebook Url</label>
                    <input type="text" value="" id="Facebook" name="Facebook">
                 </div>
                 <input type="submit" name="Facebook_form" value="Facebook_form">
			</div>            
        </form>
    </div>
</div>-->
<!--<div style='display:none'>
    <div id='linkedin_member' style='padding:10px; background:#fff;'>
    	<form method="post" >
            <p><strong><h3>LinkedIn Url</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>LinkedIn Url</label>
                    <input type="text" value="" id="LinkedIn" name="LinkedIn">
                 </div>
                 <input type="submit" name="LinkedIn_form" value="LinkedIn_form">
			</div>            
        </form>
    </div>
</div>-->
<!--<div style='display:none'>
    <div id='twitter_member' style='padding:10px; background:#fff;'>
    	<form method="post" >
            <p><strong><h3>Twitter Url</h3></strong></p>
            <div class="new_acc">           
            	 <div class="left">
                 	<label>Twitter Url</label>
                    <input type="text" value="" id="Twitter" name="Twitter">
                 </div>
                 <input type="submit" name="Twitter_form" value="Twitter_form">
			</div>            
        </form>
    </div>
</div>-->