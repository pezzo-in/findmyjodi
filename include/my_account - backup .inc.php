<?php
$url=explode('/',$_SERVER['REQUEST_URI']);

if(isset($_POST['reply']))
{
	$insert = "insert into replies(id,from_mem,to_mem,message,to_msg_id)
			   values
			   (NULL,'".$_SESSION['logged_user'][0]['member_id']."',
			   	 	 '".$_POST['to_mem']."',
					 '".$_POST['txtMsg']."',
					 '".$_POST['msg_id']."')";
	$save_rpl = $obj->insert($insert);				 
	
	$update_msg_status = "update messages 
							  set 
							  	is_replied = 'Y' 
							  where 
							  	from_mem = '".$_SESSION['logged_user'][0]['member_id']."'and
								to_mem = '".$_POST['to_mem']."'";
							//and id='".$_POST['msg_id']."'	
	
		$update = $obj->edit($update_msg_status);
}

if(isset($_GET['delete_msg_id']))
{
	$sqld="delete from messages where id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld);
	
	$sqld2="delete from not_interested_members where msg_id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld2);
	
	$sqld3="delete from need_more_info_detail where msg_id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld3);
	
	$sqld4="delete from need_more_time_detail where msg_id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld4);
	
	echo "<script> window.location.href = 'my_account.php' </script>";	
}
if(isset($_GET['id']))
{
	if($_GET['flag'] == 'y')
	{
		$sqld="delete from messages where id = '".$_GET['id']."' ";
		$obj->sql_query($sqld);
		
		$del_from_notint_mem = "delete from not_interested_members where msg_id = '".$_GET['id']."'";
		$obj->sql_query($del_from_notint_mem);
	}
	else
	{
		$sqld="delete from messages where id = '".$_GET['id']."'";
		$obj->sql_query($sqld);
	}
	echo "<script> window.location.href = 'my_account.php' </script>";	
}

if(isset($_GET['reply_msg_id']))
{
	$sqld="delete from replies where id = '".$_GET['reply_msg_id']."' ";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'my_account.php' </script>";	
}

if(isset($_POST['send_reply']))
	{
		$update_msg_status = "update messages 
							  set 
							  	is_replied = 'Y' 
							  where 
							  	from_mem = '".$_POST['to_mem_id']."'and
								to_mem = '".$_POST['from_mem_id']."'";
							//and id='".$_POST['msg_id']."'	
	
		$update = $obj->edit($update_msg_status);

		$insert_reply = "insert into replies (id,to_mem,from_mem,message,to_msg_id)
						 values
						 (NULL,'".$_POST['to_mem_id']."','".$_POST['from_mem_id']."','".$_POST['message']."','".$_POST['msg_id']."')";
		$insert = $obj->insert($insert_reply);		
		echo "<script>window.location='my_account.php'</script>";
		 
						 
	}	

//LOGGED-IN USER'S DETAIL //
	$sql_login = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.id = '".$_SESSION['logged_user'][0]['id']."'";	

	$logged_in_member=$obj->select($sql_login);
	
		
?>
        

        <?php if(!empty($logged_in_member)) { ?>	
        <div class="content">
        
        	<div class="profile_details">
            	<?php if($_GET['msg'] == 'D'){
						echo "Your profile is successfully Deactivated.";
					}elseif($_GET['msg'] == 'A'){
						echo "Your profile is successfully Activated.";
					}
					?>
            
            	<div class="profile_img">
                    <div class="profile-img-box first col-md-12 col-xs-12 col-md-12">
                    <?php
						if(!empty($logged_in_member[0]['photo']))
						{
						 	//$path =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/".$logged_in_member[0]['photo'];
							$path = "upload/".$logged_in_member[0]['photo'];
							if (file_exists($path)) { 
                       			echo '<img class="size" src="'.$path.'"/>';
							}
							else{
								if($_SESSION['logged_user'][0]['gender']=='M')
									echo '<img title="click here to upload photo" class="" src="'."images/male-user1.png".'"/>';
								else
									echo '<img title="click here to upload photo" class="" src="'."images/female-user1.png".'"/>';
							}
						}
						else{
								if($_SESSION['logged_user'][0]['gender']=='M')
									echo '<img title="click here to upload photo" class="" src="'."images/male-user1.png".'"/>';
								else
									echo '<img title="click here to upload photo" class="" src="'."images/female-user1.png".'"/>';
							}?>
                         
                         
                    </div>
                     <div align="right"><a href="edit_profile.php">Edit Profile</a></div>  
                    <h2><?php echo $logged_in_member[0]['name']; ?></h2>  
                    <p><?php echo $logged_in_member[0]['name']; ?> ( <?php echo $logged_in_member[0]['member_id']; ?> )<br>
    <?php echo $logged_in_member[0]['age']; ?> Yrs<br>
    <?php echo $logged_in_member[0]['education']; ?></p>
    
    			</div>
                
                
                <div class="row-detail">
                	<h3>About Me<?php //echo $logged_in_member[0]['name']; ?></h3>
                	<p><?php echo $logged_in_member[0]['about_me']; ?></p>
                </div>
                <div class="row-detail">
                	<h3>More About Me<?php //echo $logged_in_member[0]['name']; ?></h3>
                	<?php if(!empty($logged_in_member[0]['relationship_status'])) { ?><ul><li>Marital Status</li><li>:</li><li><?php echo $logged_in_member[0]['relationship_status']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['noof_children_living_status'])) { ?><ul><li>Have Children</li><li>:</li><li><?php if(!empty($logged_in_member[0]['noof_children_living_status'])){ echo $logged_in_member[0]['noof_children_living_status']; } else { echo "No"; }  ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['profile_for'])) { ?><ul><li>Created For</li><li>:</li><li><?php echo $logged_in_member[0]['profile_for']; ?></li></ul><?php } ?>
                    <ul><li>Last Login</li><li>:</li><li><?php echo date('d M Y',strtotime($logged_in_member[0]['last_login'])); ?></li></ul>
                </div>
                <div class="row-detail">
                	<h3><?php //echo $logged_in_member[0]['name']; ?> Physical Appearance & Looks</h3>
                	<?php if(!empty($logged_in_member[0]['height'])) { ?><ul><li>Height</li><li>:</li><li><?php echo $logged_in_member[0]['height']; ?>ft</li></ul>
                    <?php } ?>
                    <?php if(!empty($logged_in_member[0]['Complexion'])) { ?><ul><li>Complexion</li><li>:</li><li><?php echo $logged_in_member[0]['Complexion']; ?></li></ul><?php } ?>
                   <?php if(!empty($logged_in_member[0]['body_type'])) { ?><ul><li>Body Type</li><li>:</li><li><?php echo $logged_in_member[0]['body_type']; ?></li></ul><?php } ?>                   
                </div>
                <?php /*?><div class="row-detail">
                	<h3>About <?php echo $logged_in_member[0]['name']; ?>'s past and current Education & Career info</h3>
                	<?php if(!empty($logged_in_member[0]['education'])) { ?><ul><li>Highest Qualification</li><li>:</li><li><?php echo $logged_in_member[0]['education']; ?></li></ul><?php } ?>
                    <ul><li>Fields of Study</li><li>:</li><li>Economics</li></ul>
                    <ul><li>Employed In</li><li>:</li><li>Not Working</li></ul>
                </div><?php */?>
                <div class="row-detail">
                	<h3><?php //echo $logged_in_member[0]['name']; ?> Religion and Social info</h3>
                	<?php if(!empty($logged_in_member[0]['religion'])) { ?><ul><li>Religion</li><li>:</li><li><?php echo $logged_in_member[0]['religion']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['mother_tongue'])) { ?><ul><li>Mother Tongue</li><li>:</li><li><?php echo $logged_in_member[0]['mother_tongue']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['caste'])) { ?><ul><li>Caste</li><li>:</li><li><?php echo $logged_in_member[0]['caste']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['subcaste'])) { ?><ul><li>Sub Caste</li><li>:</li><li><?php echo $logged_in_member[0]['subcaste']; ?></li></ul><?php } ?>
                   <?php if(!empty($logged_in_member[0]['manglik_dosham'])) { ?><ul><li>Manglik</li><li>:</li><li>
				   <?php if($logged_in_member[0]['manglik_dosham'] == 'N') { echo "No"; }else { echo "Yes"; } ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['gothram'])) { ?><ul><li>Gotra /Gothram </li><li>:</li><li><?php echo $logged_in_member[0]['gothram']; ?></li></ul><?php } ?>
                </div>
                <div class="row-detail">
                	<h3><?php //echo $logged_in_member[0]['name']; ?> Astro info</h3>
                	<?php if(!empty($logged_in_member[0]['date_of_birth'])) { ?><ul><li>Date Of Birth</li><li>:</li><li><?php echo date('d M Y',strtotime(($logged_in_member[0]['date_of_birth']))); ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['country'])) { ?><ul><li>Country of birth</li><li>:</li><li><?php echo $logged_in_member[0]['country']; ?></li></ul><?php } ?>
                </div>
                <div class="row-detail">
                	<h3><?php //echo $logged_in_member[0]['name']; ?> Family</h3>
                	<?php if(!empty($logged_in_member[0]['father_occupation'])) { ?><ul><li>Father's Occupation</li><li>:</li><li><?php echo $logged_in_member[0]['father_occupation']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['mother_occupation'])) { ?><ul><li>Mother's Occupation</li><li>:</li><li><?php echo $logged_in_member[0]['mother_occupation']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['no_of_brothers'])) { ?><ul><li>Brothers</li><li>:</li><li><?php echo $logged_in_member[0]['no_of_brothers']; ?> brother </li><li>(not married)</li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['no_of_sisters'])) { ?><ul><li>Sisters</li><li>:</li><li><?php echo $logged_in_member[0]['no_of_sisters']; ?> sisters </li></ul><?php } ?>
                   <?php if(!empty($logged_in_member[0]['living_with_parents'])) { ?> <ul><li>Living with parents?</li><li>:</li><li>
				   <?php if( $logged_in_member[0]['living_with_parents'] == "Y") { echo "Yes"; } else { echo "No"; }?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['family_value'])) { ?> <ul><li>Family values</li><li>:</li><li><?php echo $logged_in_member[0]['family_value']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['family_type'])) { ?><ul><li>Family Type</li><li>:</li><li><?php echo $logged_in_member[0]['family_type']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['family_status'])) { ?><ul><li>Family Status</li><li>:</li><li><?php echo $logged_in_member[0]['family_status']; ?></li></ul><?php } ?>
                   
                </div>
                <?php if(!empty($logged_in_member[0]['is_smoker']) ||  (!empty($logged_in_member[0]['is_smoker'])) ||
						(!empty($logged_in_member[0]['is_drinker'])) || (!empty($logged_in_member[0]['eating_habits']))) { ?>
                <div class="row-detail">
                	<h3><?php //echo $logged_in_member[0]['name']; ?> Lifestyle</h3>
                     <?php if(!empty($logged_in_member[0]['is_smoker'])) { ?><ul><li>Smoking</li><li>:</li><li><?php if($logged_in_member[0]['is_smoker'] == 'N') { echo "No"; } elseif($logged_in_member[0]['is_smoker'] == "O"){ echo "Occasionally"; }else { echo "Yes"; } ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['is_drinker'])) { ?><ul><li>Drinking</li><li>:</li><li><?php if($logged_in_member[0]['is_drinker'] == "Y") { echo "Yes"; }elseif($logged_in_member[0]['is_drinker'] == "O"){ echo "Occasionally"; }else { echo "No"; } ?></li></ul><?php } ?>
                     <?php if(!empty($logged_in_member[0]['eating_habits'])) { ?><ul><li>Eating Habits</li><li>:</li><li><?php echo $logged_in_member[0]['eating_habits']; ?></li></ul><?php } ?>
                </div>
                <?php } ?>
                  
                <?php
				 $select_preferred_partner="select * from preferred_partner_details where from_mem=".$_SESSION['logged_user'][0]['id'];
				 $db_preferred_partner=$obj->select($select_preferred_partner);
				 if(count($db_preferred_partner)>0)
				 {
				?>
                    <div class="row-detail">
                        <h3>Partner Prefrence</h3>   
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
                            <li><?php echo $db_preferred_partner[0]['height']; ?></li>
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
                            <li><?php echo $db_preferred_partner[0]['education']; ?></li>
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
                        <ul>
                        	<li>Partner Description</li>
                            <li>:</li>
                            <li><?php echo $db_preferred_partner[0]['partner_description']; ?></li>
                        </ul>
                        <?php } ?>
                    </div>
                <?php
				 }
				 ?>
                
                
                
            </div>
        
		</div>
         
        <?php } else {
			?><div class="content_data"> <?php 
			echo "Sorry...some error occured.";?></div> <?php } ?>
<script>
	 
	 
	 //to get not replied/awaiting for reply
	 
	  $('#not_replied').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=not_replied',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
	 //to get new received msgs
	 $('#new_msg').click( function() {
		
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=new_msg',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
	 
	 //to get not intrested msgs
		$('#not_interested_msgs').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=not_interested_msgs',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});	
	 
	 
	 
	 
	 
	 
	 //to get replied msgs from looged in user
	 $('#replied').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/refine_search.php?hint=replied&page=<?php echo $url[3]; ?>',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
		
		
		
		
		//to get need more time by logged in user
		$('#need_more_time_byme').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=need_more_time_byme',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
		//to get need more time for logged in user
		$('#need_more_time').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=need_more_time',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
		
		//to get need more info by logged in user
		$('#need_more_info_byme').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=need_more_info_byme',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
		
		//to get need more infor for logged in user
		$('#need_more_info').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=need_more_info',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
		//to get interests accpeted of logged in user
		$('#my_accepted_intrest').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=my_accepted_intrest',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
		
		//to get sent interestes		
		$('#sent_interest').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=sent_interest',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
		//to get sent msgs
		$('#sent_msgs').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=sent_msgs',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
	
		//to get new interest
		$('#new_int').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=new_int',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
		
		//to get accepted interests
		$('#accepted_intrest').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=accepted_intrest&page=<?php echo $url[3]; ?>',
				   success: function(data) {
					   $('.content').html( data );
				   }
				});
		});
		
		//to get not interested interest
		$('#not_interested_int').click( function() {
			$.ajax({
				   type: "GET",		
				   url: 'include/home_refine_search.php?hint=not_interested_int',
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
	
	
</script> 
        
<style>
.upload_pic
{
	float: left;
    margin-right: 20px;
    padding: 24px 13px;
}
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

</style>     
