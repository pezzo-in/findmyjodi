<?php
//setcookie("TestCookie","THis is Test",time()+60*60*24*365,'/');
//echo 'Ajay '.$_COOKIE['TestCookie'];
if(isset($_POST['send_msg']))
{
	$date = date('Y-m-d H:i:s');
	$insert="INSERT into messages(id, from_mem,to_mem,message,parent_id,send_date)
			 values
			 		(NULL,'".$_POST['from_member_id']."','".$_POST['to_member_id']."','".$_POST['message']."','0','".$date."')";
	$db_ins=$obj->insert($insert);
	
	$update_msg_counter = "update members set num_send_msg='".($_POST['num_send_msg']+1)."' where member_id='".$_SESSION['logged_user'][0]['member_id']."'"; 
$obj->edit($update_msg_counter);
	/*echo "<script> alert('Message Sent!!!'); </script>";*/
}

$sql_search = "SELECT * from tbl_search WHERE Id = '".$_GET['id']."'";
$db_search=$obj->select($sql_search);

$sql = $db_search[0]['Search'];		
	
	
	/*$PAGING=new PAGING($sql);
	$sql=$PAGING->sql;*/
	$members = $obj->select($sql);
?>
   
    
        <div class="content" id="content_data">
                
                <?php
				//echo '<pre>';
				//print_r($search);
				?>
                
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
                               <a id="chk_express<?php echo $res['member_id']; ?>" href="javascript:;" onclick="check_express_interest('<?php echo $res['member_id'] ?>','<?php echo $_SESSION['logged_user'][0]['member_id'] ?>', 2)" class="icon-heart"></a>
                               <a href="include/view_success_msg.php?id=<?php echo $res['id'] ;?>" class="ajax3 send_email_btn" style="display:none">
								<?php }elseif($_POST['Search_rdGender'] == $db_user1[0]['gender']){ ?>
                                <a href="javascript:;" onclick="alert('Interest can not be send to same gender.')" class="icon-heart"></a>
								<?php  }else { ?>
								<a href="javascript:;" onclick="alert('Interest is already sent')" class="icon-red-heart"></a>      
                                                      
								<?php } ?>
                                
                                <?php
								$select_chat_users="select * from chat_users where status='1' AND email='".$res['email_id']."'";
								$db_chat_user=$obj->select($select_chat_users);
								?>
                                 <input type="hidden" id="count_view_mob" value="<?php echo $db_logged[0]['view_mobile'];?>"> 
                                 <input type="hidden" id="count_view_msg" value="<?php echo $db_logged[0]['num_send_msg'];?>"> 
                                <?php if($db_logged[0]['view_mobile']>$db_user_plan[0]['no_of_contacts']) { ?>
								 <a <?php if($_SESSION['Member_status']=='Paid'){ ?>href="javascript:alert('Sorry! You exceed maximum number of mobile from your plan')"<?php } else { ?> href="javascript:alert('This feature is available for paid member');" <?php } ?> class="icon-gift-online"></a>
                                 <?php } else { ?>
                                <?php if(count($db_chat_user)==0){ ?>
                                      
<a <?php if($_SESSION['Member_status']=='Paid'){ ?>href="include/view_mobile.php?id=<?php echo $res['id'] ;?>" <?php } else { ?> href="javascript:alert('This feature is available for paid member');" <?php } ?> class="icon-gift-offline <?php if($_SESSION['Member_status']=='Paid'){ ?> ajax1 send_email_btn <?php } ?>" id="view_moblie_cnt<?php echo $res['id'] ;?>"></a>
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
<a href="<?php if( $_SESSION['Member_status']=='Paid'){ ?>javascript:alert('Sorry! You exceed maximum number of mobile from your plan');<?php } else { ?> javascript:alert('This feature is available for paid member'); <?php } ?>" class="icon-mail"></a>
                                <?php } else { ?>
<a href="<?php if( $_SESSION['Member_status']=='Paid'){ ?>include/send_message.php?id=<?php echo $res['id']; ?>&email=<?php echo $res['email_id']; ?>&to_mem_id=<?php echo $res['member_id']; } else {?> javascript:alert('This feature is available for paid member'); <?php } ?>" class=" <?php if($_SESSION['Member_status']=='Paid') { ?> ajax send_email_btn <?php } ?>icon-mail"></a>
                                
                                <?php } ?>
					
                                <?php
								$sonline="select * from chat_users where email='".$res['email_id']."' and status='1'";
								$sonline_data=$obj->select($sonline);
								?>
       <?php if( $_SESSION['Member_status']=='Paid'){ ?>
       <a <?php if(count($sonline_data)>0){ ?> href="javascript:;" <?php } else { ?>href="javascript:alert('User is offline')"<?php } ?> class="<?php if(count($sonline_data)>0){ ?>onlineUsers <?php } if(count($sonline_data)>0){ ?>icon-chat<?php }else{ ?>icon-chat-offline<?php } ?>" <?php if(count($sonline_data)>0){ ?>data-unk="<?php echo $sonline_data[0]['name'];?>" data-uid="<?php echo $sonline_data[0]['id'];?>" <?php } ?>></a>
       <?php } else { ?>
       <a href="javascript:alert('This feature is available for paid member')" class="<?php if(count($sonline_data)>0){ ?>icon-chat<?php } else {?>icon-chat-offline<?php } ?>"></a>
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
        	<!--<ul class="profl-list">
            <?php
					foreach($members as $res) { ?>
            	<li>
                    <div class="profile-img-box">
                    <a href="view_profile.php?id=<?php echo $res['id']; ?>" target="_blank" class="popper" data-popbox="pop<?php echo $res['id']; ?>">
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
									echo '<img  data-popbox="pop'.$res['id'].'" class="profile_pic popper" src="'.$path.'" />';
									echo '<div id="pop'.$res['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" width="'.$width.'"  height="'.$height.'" /></div>';
									//echo '<div id="pop'.$res['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" /></div>';
							}
							else{
								if($res['gender']=='M')
									echo '<img  class="profile_pic" src="images/male-user1.png" />';
								else
									echo '<img  class="profile_pic" src="images/female-user1.png" />';
							}
						}
						else{
								if($res['gender']=='M')
									echo '<img  class="profile_pic" src="images/male-user1.png" />';
								else
									echo '<img  class="profile_pic" src="images/female-user1.png" />';
							}?>
                            
                        
                        <div class="griddetail">
                        	<div style="overflow:hidden;"><b><?php echo $res['name']; ?></b></div>
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
                        	<div><label>Name : </label><?php echo $res['name']; ?></div>
							<div><label>Age / Height : </label><?php echo $res['age'] ?> 
                            	<?php 
								if($res['height']!='')
								{
									$select_height="select * from height where Id='".$res['height']."'";
									$db_height=$obj->select($select_height);
									echo ' / '.$db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
									if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }
								}
								?>
                            </div>
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
								<a href="javascript:;" onclick="alert('Already sent Intrest.')" class="icon-red-heart"></a>                            
								<?php } ?>
                                
                                <?php
								$select_chat_users="select * from chat_users where status='1' AND email='".$res['email_id']."'";
								$db_chat_user=$obj->select($select_chat_users);
								?>
                                <?php if(count($db_chat_user)==0){ ?>
								<a href="javascript:;" class="icon-gift-offline"></a>
                                <?php }else{ ?>
                                <a href="javascript:;" class="icon-gift-online"></a>
                                <?php } ?>
                                
								<a href="include/send_message.php?id=<?php echo $res['id']; ?>&email=<?php echo $res['email_id']; ?>&to_mem_id=<?php echo $res['member_id']; ?>" class="icon-mail ajax send_email_btn"></a>
								<a href="javascript:;" class="icon-chat"></a>
                           <?php 
							}else{
							?>
								<a href="login.php" class="icon-heart"></a>                            
								<a href="login.php" class="icon-gift-offline"></a>
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
            </ul>-->
            <?php }  
			else
			{
				echo "Sorry, No Matches found"; ?>
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
	
	function check_express_interest(to_member,from_member,site)
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
							$('.ajax3').trigger("click");
						}
					}
				});
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