<?php
session_start();
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
	$db_ins=$obj->insert($insert);
	
	$update_msg_counter = "update members set num_send_msg='".($_POST['num_send_msg']+1)."' where member_id='".$_SESSION['logged_user'][0]['member_id']."'"; 
$obj->edit($update_msg_counter);
	/*echo "<script> alert('Message Sent!!!'); </script>";*/
	echo "<script> window.location.href = 'view_profile.php?id=".$_POST['member_id']."' </script>";
}
	$age_between = $_POST['drpAgeFrom']." and ".$_POST['drpAgeTo'];
	
	$sql = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 		members.id = '".$_GET['id']."'";	
	$members=$obj->select($sql);
	
	//LOGGED-IN USER'S DETAIL //
	$sql_login = "SELECT members.*,member_photos.photo FROM members 
				JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 		members.member_id = '".$_SESSION['logged_user'][0]['member_id']."'";	
	$logged_in_member=$obj->select($sql_login);
		
?>
        <?php if(!empty($members)) { ?>	
        <div class="content" style="padding:20px; padding-top:0px;">
        
        	<div class="profile_details">
            
            	<div class="prfldetailtitle">
                    <h2 style="padding-top:0px;"><?php echo ucfirst($members[0]['name']); ?><span style="font-size:14px; margin-left:5px;">( <?php echo $members[0]['member_id']; ?> )</span><small style="font-size: 12px;margin-left: 5px;"><?php echo $members[0]['age']; ?> Yrs</small></h2>  
                    <p>
    				</p>
                    <?php 
					$plan="select id from member_plans where member_id='".$_REQUEST['id']."'";
					$dbplan=$obj->select($plan);
					?>
                    <div class="goto_profile expinterest">
    
   		<?php
		$sql_user1 = "select * from members where id = '".$_SESSION['logged_user'][0]['id']."'";
		$db_user1 = $obj->select($sql_user1); 
		
		$user_plan = "select new_membership_plans.*,member_plans.plan_id from new_membership_plans left join member_plans on new_membership_plans.id=member_plans.plan_id where member_plans.member_id='".$_SESSION['logged_user'][0]['id']."'";
$db_user_plan = $obj->select($user_plan);
		?>
   <?php
    
	$sql = "SELECT * from express_interest WHERE from_mem = '".$_SESSION['logged_user'][0]['member_id']."' and to_mem = '".$members[0]['member_id']."'";	
	$members_data=$obj->select($sql);
	
	if(empty($members_data) && $db_user1[0]['gender'] != $members[0]['gender'])
	{
   ?>
   <a id="chk_express<?php echo $members[0]['member_id']; ?>" onclick="check_express_interest('<?php echo $members[0]['member_id'] ?>','<?php echo $_SESSION['logged_user'][0]['member_id'] ?>')" href="javascript:;" class="icon-heart"><span></span></a><span id="text_express<?php echo $members[0]['member_id']; ?>">Express interest</span>
   <?php }elseif($db_user1[0]['gender'] == $members[0]['gender']){ ?>
<a href='javascript:;' class='icon-heart same_gender'><span></span></a><span>Express interest</span>
       <?php
    }
   elseif($members_data[0]['is_accepted']=='Y')
   {
	   echo "<a href='javascript:;' class='icon-red-heart'><span></span></a><span>Your Interest is Accepted</span>"; 
   }
   elseif($members_data[0]['is_more_time']=='1')
   {
	   echo "<a href='javascript:;' class='icon-red-heart'><span></span></a><span>Need more time to respond</span>"; 
   }
   elseif($members_data[0]['is_more_info']=='1')
   {
	   echo "<a href='javascript:;' class='icon-red-heart'><span></span></a><span>Need more info to respond</span>"; 
   } else { echo "<a href='javascript:;' class='icon-red-heart'><span></span></a><span>Interest Sent</span>"; } ?>
    <?php if($db_user1[0]['num_send_msg']>$db_user_plan[0]['allow_messages']) { ?>
    <a <?php if($_SESSION['Member_status']=='Paid'){ ?>href="javascript:;" class="exid_msg icon-mail" <?php }else { ?> href="javascript:;" class="paid_error icon-mail" <?php } ?>><span></span></a>
   <?php } else { ?>
   <a <?php if($_SESSION['Member_status']=='Paid'){ ?>href="include/send_message.php?id=<?php echo $members[0]['id']; ?>&email=<?php echo $members[0]['email_id']; ?>&to_mem_id=<?php echo $members[0]['member_id']; ?>"  class="ajax send_email_btn icon-mail"<?php }else { ?> href="javascript:;" class="icon-mail paid_error" <?php } ?>><span></span></a>
   <?php } ?>
   <span>&nbsp;Send Message </span> 
  <?php
	$sonline="select * from chat_users where email='".$members[0]['email_id']."' and status='1'";
	$sonline_data=$obj->select($sonline);
								?>
   
  
  <input type="hidden" id="count_view_mob" value="<?php echo $db_user1[0]['view_mobile'];?>">
  <?php if($_SESSION['logged_user'][0]['id']!=$_GET['id']) { if($_SESSION['Member_status']=='Paid'){ ?>
  <a <?php if(count($sonline_data)>0){ ?> href="javascript:;" <?php } else { ?>href="javascript:;" class="user_offline icon-chat-offline"<?php } ?> class="<?php if(count($sonline_data)>0){ ?>onlineUsers icon-chat<?php }else{ ?>icon-chat-offline<?php } ?>" <?php if(count($sonline_data)>0){ ?>data-unk="<?php echo $sonline_data[0]['name'];?>" data-uid="<?php echo $sonline_data[0]['id'];?>" <?php } ?>><span class="icon-chat-offline"></span></a><span>Chat </span>
  <?php } else { ?>
   <a href="javascript:;" class="paid_error <?php if(count($sonline_data)>0){ ?>icon-chat<?php } else { ?>icon-chat-offline<?php } ?>"><span class="icon-chat-offline"></span></a><span>Chat </span>
  <?php } } ?>
   
    
     <?php if($db_user1[0]['view_mobile']>$db_user_plan[0]['no_of_contacts']) { ?>
    <a <?php if($_SESSION['Member_status']=='Paid'){ ?>href="javascript:;" class="exid_mobile send_email_btn icon-mbl" <?php } else { ?> href="javascript:;" class="paid_error send_email_btn icon-mbl"<?php } ?>><span></span></a>
     <?php } else { ?>
    <a <?php if($_SESSION['Member_status']=='Paid'){ ?>href="include/view_mobile.php?id=<?php echo $_GET['id'] ;?>" class="icon-mbl ajax1 send_email_btn"<?php } else { ?> href="javascript:;" class="icon-mbl paid_error" <?php } ?>><span></span></a>
   <?php } ?> 
    <span>View Phone Number </span>
   <?php
   if($members[0]['photo']=='')
   {
		$select_photo_request="select * from photo_request where from_mem_id='".$_SESSION['logged_user'][0]['id']."' AND to_mem_id='".$_GET['id']."'";
		$db_photo_request=$obj->select($select_photo_request);
		if(count($db_photo_request)>0)
		{
			if($members[0]['gender']=='M')
				echo "<a href='javascript:;' class='icon-photo-activem'><span></span></a><span>Photo request sent</span>";
			else
				echo "<a href='javascript:;' class='icon-photo-activef'><span></span></a><span>Photo request sent</span>";
		}
		else
		{
			if($members[0]['gender']=='M' && ($_SESSION['logged_user'][0]['id']!=$_GET['id'])) {
		echo '<a onclick="send_photo('.$_SESSION['logged_user'][0]['id'].','.$_GET['id'].',1)" href="javascript:;" class="icon-photom" id='.$_GET['id'].' ><span></span></a><span id=success_msg'.$_GET['id'].'>Send photo request</span>';
			} else if($members[0]['gender']=='F' && ($_SESSION['logged_user'][0]['id']!=$_GET['id'])) {
				echo '<a onclick="send_photo('.$_SESSION['logged_user'][0]['id'].','.$_GET['id'].',2)" href="javascript:;" id='.$_GET['id'].' class="icon-photof"><span></span></a><span id=success_msg'.$_GET['id'].'>Send photo request</span>'; }
		}	
	?>
    <?php
   }
   ?>
   </div>
   
    			</div>
                
                <?php if($members[0]['about_me']!=''){ ?>
                <div class="row-detail">
                	<span class="about_me1"></span><h3>About Me<?php //echo $members[0]['name']; ?></h3>
                	<p><?php echo substr($members[0]['about_me'],0,800); ?></p>
                </div>
                <?php } ?>
                
                <?php if(!empty($members[0]['relationship_status']) || !empty($members[0]['noof_children_living_status']) || !empty($members[0]['profile_for']) || !empty($members[0]['annual_income']) || !empty($members[0]['star']) || !empty($members[0]['occupation']) || !empty($members[0]['state']) || !empty($members[0]['city'])){ ?>
                <div class="row-detail">
                	<span class="about_me1"></span><h3>More About Me<?php //echo $members[0]['name']; ?></h3>
                	<?php if(!empty($members[0]['relationship_status'])) { ?><ul>
                  <li>Marital Status</li>
                  <li>:</li>
                  <li><?php echo $members[0]['relationship_status']; ?></li></ul><?php } ?>
                    <?php if(!empty($members[0]['noof_children_living_status'])) { ?><ul>
                    <li>Have Children</li>
                    <li>:</li>
                    <li><?php if(!empty($members[0]['noof_children_living_status'])){ echo $members[0]['noof_children_living_status']; } else { echo "No"; }  ?></li></ul><?php } ?>
                    <?php if(!empty($members[0]['profile_for'])) { ?><ul>
                    <li>Created By</li>
                    <li>:</li>
                    <li><?php
					if($members[0]['profile_for']=="Son" or $members[0]['profile_for']=="Daughter") { echo "Parent"; } 
					else { echo $members[0]['profile_for']; } ?></li></ul><?php } ?>
                    <?php if(!empty($members[0]['star'])) { ?><ul>
                    <li>Star</li>
                    <li>:</li>
                    <li><?php echo $members[0]['star']; ?></li></ul><?php } ?>
        <?php if(!empty($members[0]['country'])) { ?><ul>
        <li>Country Living In</li>
        <li>:</li>
        <li><?php echo ucfirst($members[0]['country']); ?></li></ul><?php } ?>
        <?php if(!empty($members[0]['state'])) { ?><ul>
        <li>Residing State</li>
        <li>:</li>
        <li><?php echo ucfirst($members[0]['state']); ?></li></ul><?php } ?>
           <?php if(!empty($members[0]['city'])) { ?><ul>
           <li>Residing City</li>
           <li>:</li>
           <li><?php echo ucfirst($members[0]['city']); ?></li></ul><?php } ?>
            <?php if(!empty($members[0]['wishtosettle'])) { ?><ul><li>Where do you wish to settle?</li><li>:</li><li><?php echo $members[0]['wishtosettle']; ?></li></ul><?php } ?>              
                   <ul>
                   <li>Last Login</li>
                   <li>:</li>
                   <li><?php if($logged_in_member[0]['last_login'] == '0000-00-00') { ?>
                    <?php echo date('d M Y'); ?>
                    <?php } else { ?>
                    <?php echo date('d M Y',strtotime($members[0]['last_login'])); ?>
                    <?php } ?></li></ul>
                </div>
                <?php } ?>
                
<?php if(!empty($members[0]['height']) || !empty($members[0]['weight']) || !empty($members[0]['complexion']) || !empty($members[0]['body_type']) || !empty($members[0]['physical_status'])){ ?>
                <div class="row-detail">
                	<span class="looks1"></span><h3><?php //echo $members[0]['name']; ?> Physical Appearance & Looks</h3>
                	<?php if(!empty($members[0]['height'])) { ?><ul>
                  <li>Height</li>
                  <li>:</li>
                    	
                      <li>
                            <?php 
							$select_height="select * from height where Id='".$members[0]['height']."'";
							$db_height=$obj->select($select_height);
							echo $db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
							if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }
							?>
                        </li>
                    </ul>
                    <?php } ?>
              <?php if(!empty($members[0]['weight'])) { ?><ul>
              <li>Weight</li>
              <li>:</li>
              <li><?php echo $members[0]['weight']; ?></li></ul><?php } ?>
 <?php if(!empty($members[0]['complexion'])) { ?><ul>
 <li>Complexion</li>
 <li>:</li>
 <li><?php echo ucfirst($members[0]['complexion']); ?></li></ul><?php } ?>
 <?php if(!empty($members[0]['body_type'])) { ?><ul>
 <li>Body Type</li>
 <li>:</li>
 <li><?php echo ucfirst($members[0]['body_type']); ?></li></ul><?php } ?>
<?php if(!empty($members[0]['physical_status'])) { ?><ul>
<li>Physical Status</li>
<li>:</li>
<li><?php echo ucfirst($members[0]['physical_status']); ?></li></ul><?php } ?>
                </div>
                <?php } ?>
                
                <?php if(!empty($members[0]['education']) || !empty($members[0]['employed_in'])){ ?>
                <div class="row-detail">
                	<span class="Qualification1"></span><h3><?php //echo $members[0]['name']; ?> Education & Occupation</h3>
                	<?php if(!empty($members[0]['education'])) { ?><ul>
                  <li>Highest Qualification</li>
                  <li>:</li>
                  <li>
                    <?php
					$select_education="select * from education_course where Id='".$members[0]['education']."'";
					$db_education=$obj->select($select_education);
					echo ucfirst($db_education[0]['Title']);
					?>
                    </li></ul><?php } ?>
<?php if(!empty($members[0]['employed_in'])) { ?><ul>
<li>Employed in</li>
<li>:</li>
<li><?php echo ucfirst($members[0]['employed_in']); ?></li></ul><?php } ?>
<?php if(!empty($members[0]['annual_income'])) { ?><ul>
<li>Income</li>
<li>:</li>
<li><?php echo $members[0]['annual_income']; ?></li></ul><?php } ?>
<?php if(!empty($members[0]['occupation'])) { ?><ul>
<li>Occupation</li>
<li>:</li>
<li><?php echo ucfirst($members[0]['occupation']); ?></li></ul><?php } ?>
<?php if(!empty($members[0]['school'])) { ?><ul><li>School</li><li>:</li><li><?php echo $members[0]['school']; ?></li></ul><?php } ?> 
                          <?php if(!empty($members[0]['college'])) { ?><ul><li>College</li><li>:</li><li><?php echo $members[0]['college']; ?></li></ul><?php } ?>
                          
                          <?php if(!empty($members[0]['inttowork'])) { ?> <ul><li>Interested to work after marriage?</li><li>:</li><li>
<?php if( $members[0]['inttowork'] == "Y") { echo "Yes"; } else { echo "No"; }?></li></ul><?php } ?>
                </div>
                <?php } ?>
				   <?php if(!empty($members[0]['linkedin_data'])){ $linkedindata=  json_decode($members[0]['linkedin_data']); $linkedinposition=$linkedindata->positions; ?>
            <span style="float: left;height: 33px;width: 33px;margin-right: 4px;"><img src="./images/linkedin.png" /></span><h3><?php //echo $logged_in_member[0]['name']; ?> Career Graph</h3>
            <div class="row-detail">
                <span>
                    <?php
                 
                          $totalcount=$linkedinposition->{'@attributes'}->total;
                           for($i=0;$i<$totalcount;$i++)
                            {
                              if($linkedinposition->position->{'is-current'}=='true'){
                            echo $linkedinposition->position->title."<br/>";
                            echo $linkedinposition->position->company->name."<br/>";
                            echo $linkedinposition->position->{'start-date'}->year." to ";
                            if($linkedinposition->position->{'is-current'}=='true')
                            {
                                echo "Present";
                            }else{    
                                echo $linkedinposition->position->{'end-date'}->year;
                                }
                              }
                            }
                    ?>
                </span>
            </div>
                <?php } ?>
                
                <?php if(!empty($members[0]['religion']) || !empty($members[0]['mother_tongue']) || !empty($members[0]['caste']) || !empty($members[0]['subcaste']) || !empty($members[0]['manglik_dosham']) || !empty($members[0]['gothram'])){ ?>
                <div class="row-detail">
                	<span class="religion1"></span><h3><?php //echo $members[0]['name']; ?> Religion and Social info</h3>
<?php if(!empty($members[0]['religion'])) { ?><ul>
<li>Religion</li>
<li>:</li>
<li><?php echo ucfirst($members[0]['religion']); ?></li></ul><?php } ?>
<?php if(!empty($members[0]['mother_tongue'])) { ?><ul>
<li>Mother Tongue</li>
<li>:</li>
<li><?php echo ucfirst($members[0]['mother_tongue']); ?></li></ul><?php } ?>
<?php if(!empty($members[0]['caste'])) { ?><ul>
<li>Caste</li>
<li>:</li>
<li><?php echo ucfirst($members[0]['caste']); ?></li></ul><?php } ?>
<?php if(!empty($members[0]['subcaste'])) { ?><ul>
<li>Sub Caste</li>
<li>:</li>
<li><?php echo ucfirst($members[0]['subcaste']); ?></li></ul><?php } ?>
<?php if(!empty($members[0]['manglik_dosham'])) { ?><ul>
<li>Manglik</li>
<li>:</li>
<li>
<?php if($members[0]['manglik_dosham'] == 'N') { echo "No"; }elseif($members[0]['manglik_dosham'] == 'Y') { echo "Yes"; }elseif($members[0]['manglik_dosham'] == 'Dont Know') { echo "Dont Know"; } ?></li></ul><?php } ?>
<?php if(!empty($members[0]['gothram'])) { ?><ul>
<li>Gotra /Gothram </li>
<li>:</li>
<li><?php echo $members[0]['gothram']; ?></li></ul><?php } ?>
<?php if(!empty($members[0]['horoscope_match'])) { ?><ul>
<li>Horoscope </li>
<li>:</li>
<li><?php echo $members[0]['horoscope_match']; ?></li></ul><?php } ?>
                </div>
                <?php } ?>
                
                <?php if(!empty($members[0]['date_of_birth']) || !empty($members[0]['country'])){ ?>
                <div class="row-detail">
                	<span class="astro1"></span><h3><?php //echo $members[0]['name']; ?> Astro info</h3>
                	<?php if(!empty($members[0]['date_of_birth'])) { ?><ul>
                  <li>Date Of Birth</li>
                  <li>:</li>
                  <li><?php echo date('d M Y',strtotime(($members[0]['date_of_birth']))); ?></li></ul><?php } ?>
<?php if(!empty($members[0]['country'])) { ?><ul>
<li>Country of birth</li>
<li>:</li>
<li><?php echo ucfirst($members[0]['place_of_birth']); ?></li></ul><?php } ?>
                </div>
                <?php } ?>
                
                <?php if(!empty($members[0]['father_occupation']) || !empty($members[0]['mother_occupation']) || !empty($members[0]['no_of_brothers']) || !empty($members[0]['no_of_sisters']) || !empty($members[0]['living_with_parents']) || !empty($members[0]['family_value']) || !empty($members[0]['family_type']) || !empty($members[0]['family_status'])){ ?>
                <div class="row-detail">
                	<span class="family1"></span><h3><?php //echo $members[0]['name']; ?> Family</h3>
                	<?php if(!empty($members[0]['father_occupation'])) { ?><ul>
                  <li>Father's Occupation</li>
                  <li>:</li>
                  <li><?php echo $members[0]['father_occupation']; ?></li></ul><?php } ?>
                    <?php if(!empty($members[0]['mother_occupation'])) { ?><ul>
                    <li>Mother's Occupation</li>
                    <li>:</li>
                    <li><?php echo $members[0]['mother_occupation']; ?></li></ul><?php } ?>
                    <?php if(!empty($members[0]['no_of_brothers'])) { ?><ul>
                    <li>Brothers</li>
                    <li>:</li>
                    <li><?php echo $members[0]['no_of_brothers']; ?> Brother (<?php echo $members[0]['bro_married']; ?> Married)</li></ul><?php } ?>
                    <?php if(!empty($members[0]['no_of_sisters'])) { ?><ul>
                    <li>Sisters</li>
                    <li>:</li>
                    <li><?php echo $members[0]['no_of_sisters']; ?> Sisters (<?php echo $members[0]['sis_married']; ?> Married)</li></ul><?php } ?>
                    <?php if(!empty($members[0]['living_with_parents'])) { ?> <ul>
                    <li>Living with parents?</li>
                    <li>:</li>
                    <li>
				   <?php if( $members[0]['living_with_parents'] == "Y") { echo "Yes"; } else { echo "No"; }?></li></ul><?php } ?>
				   <?php if(!empty($members[0]['live_inlaws'])) { ?> <ul><li>Live with in-laws?</li><li>:</li><li>
<?php if( $members[0]['live_inlaws'] == "Y") { echo "Yes"; } else { echo "No"; }?></li></ul><?php } ?>
<?php if(!empty($members[0]['family_value'])) { ?> <ul>
<li>Family values</li>
<li>:</li>
<li><?php echo ucfirst($members[0]['family_value']); ?></li></ul><?php } ?>
<?php if(!empty($members[0]['family_type'])) { ?><ul>
<li>Family Type</li>
<li>:</li>
<li><?php echo ucfirst($members[0]['family_type']); ?></li></ul><?php } ?>
<?php if(!empty($members[0]['family_status'])) { ?><ul>
<li>Family Status</li>
<li>:</li>
<li><?php echo ucfirst($members[0]['family_status']); ?></li></ul><?php } ?>
<?php if(!empty($members[0]['aboutfamily'])) { ?><ul style="clear:both;width:100% !important;"><li>About Family</li><li>:</li><li style="width:65% !important;"><?php echo $members[0]['aboutfamily']; ?></li></ul><?php } ?>
                </div>
                <?php } ?>
                
                <div class="row-detail">
                	<span class="life_style1"></span><h3><?php //echo $members[0]['name']; ?> Lifestyle</h3>
                    <ul>
                    <li>Smoking</li>
                    <li>:</li>
                    <li><?php if($members[0]['is_smoker']=='N'){ echo 'No'; }else{ echo 'Yes'; } ?></li></ul>
                    <ul>
                    <li>Drinking</li>
                    <li>:</li>
                    <li><?php if($members[0]['is_drinker ']=='N'){ echo 'No'; }else{ echo 'Yes'; } ?></li></ul>
                    <?php if(!empty($members[0]['food'])) { ?><ul>
                    <li>Food</li>
                    <li>:</li>
                    <li><?php echo $members[0]['food']; ?></li></ul><?php } ?>
                </div>
                
                <?php
				$select_memebr_hobbies_interest="select * from memebr_hobbies_interest where member_id='".$members[0]['id']."'";
				$db_memebr_hobbies_interest=$obj->select($select_memebr_hobbies_interest);
				if(count($db_memebr_hobbies_interest)!=0)
				{
				?>
                
                 <div class="row-detail row-detail-hobbies">
                	<span class="hobbies1"></span><h3>Hobbies & Interests</h3>
                     
					 <?php if($db_memebr_hobbies_interest[0]['hobbies']!=''){?><ul style="width:100%">
            <li>Hobbies</li><li class="nthchild2">:</li>
           <li><?php
						$select_hobbies="select * from hobbies where id IN(".$db_memebr_hobbies_interest[0]['hobbies'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?></li></ul><?php } ?>
                     
                     <?php if($db_memebr_hobbies_interest[0]['interests']!=''){?><ul style="width:100%">
                      <li>Interests</li><li class="nthchild2">:</li>
                     <li><?php
						$select_hobbies="select * from interest where id IN(".$db_memebr_hobbies_interest[0]['interests'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?></li></ul><?php } ?>
                     
                     <?php if($db_memebr_hobbies_interest[0]['music']!=''){?><ul style="width:100%">
                      <li>Favourite Music</li><li class="nthchild2">:</li>
                     <li><?php
						$select_hobbies="select * from music where id IN(".$db_memebr_hobbies_interest[0]['music'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?></li></ul><?php } ?>
                     
                     <?php if($db_memebr_hobbies_interest[0]['read_book']!=''){?><ul style="width:100%">
                      <li>Favourite Read</li><li class="nthchild2">:</li>
                     <li><?php
						$select_hobbies="select * from tbl_read where id IN(".$db_memebr_hobbies_interest[0]['read_book'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?></li></ul><?php } ?>
                     
                     <?php if($db_memebr_hobbies_interest[0]['movies']!=''){?><ul style="width:100%">
                      <li>Favourite movie</li><li class="nthchild2">:</li>
                     <li><?php
						$select_hobbies="select * from movies where id IN(".$db_memebr_hobbies_interest[0]['movies'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?></li></ul><?php } ?>
                     
                     <?php if($db_memebr_hobbies_interest[0]['sports']!=''){?><ul style="width:100%">
                      <li>Sports/fitness Activities</li><li class="nthchild2">:</li>
                     <li><?php
						$select_hobbies="select * from activities where id IN(".$db_memebr_hobbies_interest[0]['sports'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?></li></ul><?php } ?>
                     
                     <?php if($db_memebr_hobbies_interest[0]['cuisine']!=''){?><ul style="width:100%">
                      <li>Favourite cuisine</li><li class="nthchild2">:</li>
                     <li><?php
						$select_hobbies="select * from couisine where id IN(".$db_memebr_hobbies_interest[0]['cuisine'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?></li></ul><?php } ?>
                     
                      <?php if($db_memebr_hobbies_interest[0]['dress_style']!=''){?><ul style="width:100%">
                        <li>Dressing style</li><li class="nthchild2">:</li>
                      <li><?php
						$select_hobbies="select * from dress_style where id IN(".$db_memebr_hobbies_interest[0]['dress_style'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?></li></ul><?php } ?>
                     
                     <?php if($db_memebr_hobbies_interest[0]['spoken_lang']!=''){?><ul style="width:100%">
                      <li>Spoken Languages</li><li class="nthchild2">:</li>
                     <li><?php
						$select_hobbies="select * from languages where id IN(".$db_memebr_hobbies_interest[0]['spoken_lang'].")";
						$db_hobbies=$obj->select($select_hobbies);
						for($i=0;$i<count($db_hobbies);$i++)
						{
							if(($i+1)!=count($db_hobbies))
								echo $db_hobbies[$i]['name'].', ';
							else
								echo $db_hobbies[$i]['name'];
						}
					 ?></li></ul><?php } ?>
					 
                </div>
                <?php } ?>
               
                <?php
				 $select_preferred_partner="select * from preferred_partner_details where from_mem=".$_GET['id'];
				 $db_preferred_partner=$obj->select($select_preferred_partner);
				 if(count($db_preferred_partner)>0)
				 {
				?>
                    <div class="row-detail">
                        <span class="patner1"></span><h3>Partner Prefrence</h3>   
                        <?php if($db_preferred_partner[0]['preferred_age']!=''){ ?>
                        <ul>
                        	
                          <li>Age</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['preferred_age']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['marital_status']!=''){ ?>
                        <ul>
                        	
                          <li>Marital Status</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['marital_status']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['height']!=''){ ?>
                        <ul>
                        	
                          <li>Height</li>
                            
                            <li>:</li>
                            
                            <li>
                                <?php
								$ht=explode("to",$db_preferred_partner[0]['height']);
								$select_height="select * from height where Id='".$ht[0]."'";
								$db_from_height=$obj->select($select_height);
								
								$select_to_height="select * from height where Id='".$ht[1]."'";
								$db_to_height=$obj->select($select_to_height);
								echo $db_from_height[0]['Ft_val'].'ft '.$db_from_height[0]['In_val'].'in to '.$db_to_height[0]['Ft_val'].'ft '.$db_to_height[0]['In_val'].'in';
								
								?>
                            </li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['physical_status']!=''){ ?>
                        <ul>
                        	
                          <li>Physical Status</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['physical_status']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['religion']!=''){ ?>
                        <ul>
                        	
                          <li>Religion</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['religion']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['mother_tongue']!=''){ ?>
                        <ul>
                        	
                          <li>Mother Tongue</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['mother_tongue']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['caste']!=''){ ?>
                        <ul>
                        	
                          <li>Caste</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['caste']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['manglik']!=''){ ?>
                        <ul>
                        	
                          <li>Manglik</li>
                            
                            <li>:</li>
                            
                            <li><?php if($db_preferred_partner[0]['manglik']=='Y'){ echo 'Yes'; }else{ echo 'No'; } ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['star']!=''){ ?>
                        <ul>
                        	
                          <li>Star</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['star']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['food']!=''){ ?>
                        <ul>
                        	
                          <li>Food</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['food']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['is_drinker']!=''){ ?>
                        <ul>
                        	
                          <li>Drinking</li>
                            
                            <li>:</li>
                            
                            <li><?php if($db_preferred_partner[0]['is_drinker']=='N'){ echo 'No'; }else{ echo 'Yes'; } ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['is_smoker']!=''){ ?>
                        <ul>
                        	
                          <li>Smoking</li>
                            
                            <li>:</li>
                            
                            <li><?php if($db_preferred_partner[0]['is_smoker']=='N'){ echo 'No'; }else{ echo 'Yes'; } ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['country']!=''){ ?>
                        <ul>
                        	
                          <li>Country</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['country']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['city']!=''){ ?>
                        <ul>
                        	
                          <li>City</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['city']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['education']!=''){ ?>
                        <ul>
                        	
                          <li>Education</li>
                            
                            <li>:</li>
                            <?php 
								$select_education_details="select * from education_details where id='".$db_preferred_partner[0]['education']."'"; 
								$db_education_details=$obj->select($select_education_details);
							?>
                            
                            <li><?php echo $db_education_details[0]['degree']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['occupation']!=''){ ?>
                        <ul>
                        	
                          <li>Occupation</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['occupation']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['annual_income']!=''){ ?>
                        <ul>
                        	
                          <li>Annual Income</li>
                            
                            <li>:</li>
                            
                            <li><?php echo $db_preferred_partner[0]['annual_income']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['partner_description']!=''){ ?>
                        <ul style="width:100%">
                        	
                          <li>Partner Description</li>
                            
                            <li>:</li>
                            <li style="width:450px;"><?php echo $db_preferred_partner[0]['partner_description']; ?></li>
                        </ul>
                        <?php } ?>
                    </div>
                <?php
				 }
				 ?>
            </div>
        </div>
         
        <?php } else {
			?><div class="content" style="width: 694px; padding:20px;"> <?php 
			echo "Sorry, No Matches Found..";?></div> <?php } ?>
            
     <script>
	 	$('#new_interest').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'showIntMembers.php',
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
					   $('.content').html( data );
				   }
				});	
		}
		else
		{
			return false;
		}
		});	
	
	
function check_express_interest(to_member,from_member)
	{
		$.ajax({
				url:'include/express_interest.php',
				data:{to_mem:to_member,from_mem:from_member},
				type:'POST',
				success: function(data)
				{
					if(data=='1')
					{
						$('#chk_express'+to_member).removeClass("icon-heart");
						$('#chk_express'+to_member).addClass("icon-red-heart");
						$('#text_express'+to_member).text("Express Interest Sent");
						$('#chk_express'+to_member).prop("onclick", null);
					}
				}
			});
	}

function send_photo(from_mem,to_mem,gender)
{
	$.ajax({
			url:'include/send_photo_req.php',
			data:{to_mem:to_mem,from_mem:from_mem},
			type:'POST',
			success: function(data)
			{
				if(data=='1')
				{
					if(gender=='1')
					{
						$('#'+to_mem).removeClass("icon-photom");
						$('#'+to_mem).addClass("icon-photo-activem");
						$('#success_msg'+to_mem).text('Photo request sent');
						$('#'+to_mem).prop("onclick", null);
					}
					else if(gender=='2')
					{
						$('#'+to_mem).removeClass("icon-photof");
						$('#'+to_mem).addClass("icon-photo-activef");
						$('#success_msg'+to_mem).text('Photo request sent');
						$('#'+to_mem).prop("onclick", null);
					}
				}
			}
			});
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
	height:150px;
	width:75px;
}
</style>    