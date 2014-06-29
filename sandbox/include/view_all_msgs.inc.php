<?php
session_start();
//TO DEACTIVATE PROFILE
if(isset($_POST['deactivate_profile']))
{
	$update="UPDATE members 
				  SET 
				  		is_profile_active = 'N'				  		
				 where 
				 		id = '".$_SESSION['logged_user'][0]['id']."'";

						$db_updatepage=$obj->edit($update);	
						echo "<script>window.location='my_account.php?msg=D'</script>";
	
}
//TO ACTIVATE PROFILE
if(isset($_POST['activate_profile']))
{
	$update="UPDATE members 
				  SET 
				  		is_profile_active = 'Y'				  		
				 where 
				 		id = '".$_SESSION['logged_user'][0]['id']."'";

						$db_updatepage=$obj->edit($update);	
						echo "<script>window.location='my_account.php?msg=A'</script>";
	
}
//TO DELETE ACCOUNT
if(isset($_POST['delete_account']))
{
	$delete_acc="delete from members 
				  where 
				 		id = '".$_SESSION['logged_user'][0]['id']."'";
	$obj->sql_query($delete_acc);
	echo "<script>window.location='logout.php'</script>";
	
}

//LOGGED-IN USER'S DETAIL //
	$sql = "SELECT id,message,from_mem from messages where to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";
	$messages=$obj->select($sql);
	//try
	

	//try end
	
		
?>
<div  class="mid col-md-12 col-sm-12 col-xs-12">

<div class="mid_top">
        	<a href="#" class="upload_pic">
            <?php
					if(!empty($logged_in_member[0]['photo']))
					{
					 	$path = "../upload/".$logged_in_member[0]['photo'];
						if (file_exists($path)) { 
                     			echo '<img class="profile_pic" src="'.$path.'"/>';
						}
						else{
							echo '<img class="profile_pic" src="'."../../Kannadalagna/images/a1.jpg".'"/>';
						}
					}
					else{
							echo '<img class="profile_pic" src="'."../../Kannadalagna/images/a1.jpg".'"/>';
						}
			 	?>
            <?php /*?><img src="images/add_male_user.png" /><?php */?>
            </a>
            <div class="left-display-social">
                <div class="profile_complete">Your profile is <span class="cbar"><span class="cbar_in">35%</span></span> complete. For better responses, complete your profile.</div>
                <div class="social-display">
                	<div class="sd-left">
                   <?php /*?> <a class="ajax send_email_btn" href="include/add_horoscope.php?mem_id=<?php echo $_SESSION['logged_user']['member_id'];?>"><span class="icon horonotaddedicon"></span>Add Horoscope</a> <?php */?>
                       <!-- <a href="#"><span class="icon horonotaddedicon"></span>Add Horoscope</a>--><br />
                        <a href="#"><span class="icon1 pphone"></span>Add Parents' Contact Number</a><br />
                        <a href="#"><span class="icon referenceiconoff"></span>Add Reference</a><br />
                        <a href="#"><span class="icon2 gfamily-icon"></span>Add Family details</a>
                    </div>
                    <div class="sd-left">
                    	<h4>To display your social side</h4>
                        <a href="#"><span class="icon3 fbicon"></span>Add Facebook</a><br />
                        <a href="#"><span class="icon3 linicon"></span>Add LinkedIn</a><br />
                        <a href="#"><span class="icon3 twicon"></span>Add Twitter</a>
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
            <div class="sidebar-main">
            
            	<h2>Partner Search <a href="#">Search By Id</a></h2>
                <div class="sidebar-cont">
                    <div class="partner_search">
                    	<form id="search" method="post" action="search_list.php?flag=1" name="search" class="myform" enctype="multipart/form-data">
                        	<label>Age</label>
                           	 <input type="text" class="age1" id="drpAgeFrm" name="drpAgeFrm">
                            <span class="bet_text">to</span>
                            <input type="text" class="age1 no-clear" id="drpAgeTo" name="drpAgeTo">
                            <label>Height</label>
                            <select class="small1" id="drpHeightFrm" name="drpHeightFrm">
                                <option value="1">4ft - 121 cm</option>
                                <option value="2">4ft 1in - 124cm</option>
                                <option value="3">4ft 2in - 127cm</option>
                                <option value="4">4ft 3in - 129cm</option>
                                <option value="5">4ft 4in - 132cm</option>
                                <option value="6">4ft 5in - 134cm</option>
                                <option value="7">4ft 6in - 137cm</option>
                                <option value="8">4ft 7in - 139cm</option>
                                <option value="9">4ft 8in - 142cm</option>
                                <option value="10">4ft 9in - 144cm</option>
                                <option value="11">4ft 10in - 147cm</option>
                                <option value="12">4ft 11in - 149cm</option>
                                <option value="13">5ft - 152cm</option>
                                <option value="14">5ft 1in - 154cm</option>
                                <option value="15">5ft 2in - 157cm</option>
                                <option value="16">5ft 3in - 160cm</option>
                                <option value="17">5ft 4in - 162cm</option>
                                <option value="18">5ft 5in - 165cm</option>
                                <option value="19">5ft 6in - 167cm</option>
                                <option value="20">5ft 7in - 170cm</option>
                                <option value="21">5ft 8in - 172cm</option>
                                <option value="22">5ft 9in - 175cm</option>
                                <option value="23">5ft 10in - 177cm</option>
                                <option value="24">5ft 11in - 180cm</option>
                                <option value="25">6ft - 182cm</option>
                                <option value="26">6ft 1in - 185cm</option>
                                <option value="27">6ft 2in - 187cm</option>
                                <option value="28">6ft 3in - 190cm</option>
                                <option value="29">6ft 4in - 193cm</option>
                                <option value="30">6ft 5in - 195cm</option>
                                <option value="31">6ft 6in - 198cm</option>
                                <option value="32">6ft 7in - 200cm</option>
                                <option value="33">6ft 8in - 203cm</option>
                                <option value="34">6ft 9in - 205cm</option>
                                <option value="35">6ft 10in - 208cm</option>
                                <option value="36">6ft 11in - 210cm</option>
                                <option value="37">7ft - 213cm</option>
                            </select>
                            <span class="bet_text">to</span>
                            <select class="small1 no-clear" id="drpHeightTo" name="drpHeightTo">
                            	<option value="1">4ft - 121 cm</option>
                                <option value="2">4ft 1in - 124cm</option>
                                <option value="3">4ft 2in - 127cm</option>
                                <option value="4">4ft 3in - 129cm</option>
                                <option value="5">4ft 4in - 132cm</option>
                                <option value="6">4ft 5in - 134cm</option>
                                <option value="7">4ft 6in - 137cm</option>
                                <option value="8">4ft 7in - 139cm</option>
                                <option value="9">4ft 8in - 142cm</option>
                                <option value="10">4ft 9in - 144cm</option>
                                <option value="11">4ft 10in - 147cm</option>
                                <option value="12">4ft 11in - 149cm</option>
                                <option value="13">5ft - 152cm</option>
                                <option value="14">5ft 1in - 154cm</option>
                                <option value="15">5ft 2in - 157cm</option>
                                <option value="16">5ft 3in - 160cm</option>
                                <option value="17">5ft 4in - 162cm</option>
                                <option value="18">5ft 5in - 165cm</option>
                                <option value="19">5ft 6in - 167cm</option>
                                <option value="20">5ft 7in - 170cm</option>
                                <option value="21">5ft 8in - 172cm</option>
                                <option value="22">5ft 9in - 175cm</option>
                                <option value="23">5ft 10in - 177cm</option>
                                <option value="24">5ft 11in - 180cm</option>
                                <option value="25">6ft - 182cm</option>
                                <option value="26">6ft 1in - 185cm</option>
                                <option value="27">6ft 2in - 187cm</option>
                                <option value="28">6ft 3in - 190cm</option>
                                <option value="29">6ft 4in - 193cm</option>
                                <option value="30">6ft 5in - 195cm</option>
                                <option value="31">6ft 6in - 198cm</option>
                                <option value="32">6ft 7in - 200cm</option>
                                <option value="33">6ft 8in - 203cm</option>
                                <option value="34">6ft 9in - 205cm</option>
                                <option value="35">6ft 10in - 208cm</option>
                                <option value="36">6ft 11in - 210cm</option>
                                <option selected="" value="37">7ft - 213cm</option>
                        	</select>  
                            <div class="control-group">
                            	<div class="left">
                                	<label>Marital Status</label>
                                	<select id="drpMaritalStatus" name="drpMaritalStatus">
                                    	<option value="">status</option>
                                        <option>Unmarried</option>
                                        <option>Widower</option>
                                        <option>Divorced</option>
                                        <option>Awaiting Divorced</option>
                                    </select>
                               	</div>
                                <div class="right">
                                <?php
									$list = "select * from mother_tongues";
									$data = $obj->select($list);
								?>
                                	<label>Mother Tongue</label>
                                	<select id="drpLanguage" name="drpLanguage">
                                    	<?php foreach($data as $d) { ?>
                                      <option value="<?php echo $d['name']; ?>"><?php echo $d['name']; ?></option>
                                      <?php } ?>
                                    </select>
                               	</div>
                            </div>
                            <?php
								$religion_list = "select * from religions";
								$data = $obj->select($religion_list);
							?>
                            <label>Religion</label>
                            <select id="drpReligion" name="drpReligion">
                            	<?php foreach($data as $d) { ?>
                                <option value="<?php echo $d['religion'] ?>" ><?php echo $d['religion'] ?></option>
                                <?php } ?>
                            </select>
                            
                            <?php
								$caste_list = "select * from caste";
								$data = $obj->select($caste_list);
							?>
                            <label>Caste</label>
                            <select id="drpCaste" name="drpCaste">
                            	<?php foreach($data as $d) { ?>
                                	<option value="<?php echo $d['caste']; ?>"><?php echo $d['caste']; ?></option>
                                <?php } ?>
                            </select>
                            <label class="checkbox1"><input type="checkbox" />With Photo</label>
                            <label class="checkbox1"><input type="checkbox" />With Horoscope</label>
                            <input type="button" name="submit" id="submit_btn"  />
                        </form>    
                   	</div>
                </div>
                
            </div>
            <div class="partner_search">
            <form method="post"> 
            	<?php if($logged_in_member[0]['is_profile_active'] == 'Y') { ?>
            	 <input type="submit" name="deactivate_profile" id="deactivate_profile"  />
                 <?php } else { ?>
                 <input type="submit" name="activate_profile" id="activate_profile"  />
                 <?php } ?>
           </form>
           <form method="post"> 
            	 <input type="submit" name="delete_account" id="delete_account"  />
           </form>  
           </div>
        </div>
        

        
        <div class="content">
        <?php if(!empty($messages)){ 

				for($i=0;$i<count($messages);$i++)
				{
					$sql2 = "select members.*,member_photos.photo,messages.message 
							 from members,member_photos,messages
							 where members.id = member_photos.member_id
							 and members.member_id = '".$messages[$i]['from_mem']."'";
					$each_msg = $obj->select($sql2);
					?>
                    <div class="profile_details">
            	 	<div class="profile_img">
                    <div class="profile-img-box">
                    <?php
						if(!empty($each_msg[$i]['photo']))
						{
						 	//$path =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/".$logged_in_member[0]['photo'];
							$path = "../upload/".$each_msg[$i]['photo'];
							if (file_exists($path)) { 
                       			?><a href="view_profile.php?id=<?php echo $each_msg[$i]['id']; ?>">
                                	 <?php echo '<img class="size" src="'.$path.'"/>';?></a><?php 
							}
							else{

								echo '<img class="size" src="'."../../Kannadalagna/images/a1.jpg".'"/>';
							}
						}
						else{
								//echo '<img class="size" src="'."../../matrimonial/images/a1.jpg".'"/>';
							}?>
                    </div>
                    <p><?php echo $each_msg[$i]['name']; ?> ( <?php echo $each_msg[$i]['member_id']; ?> )<br>
    <?php echo $each_msg[$i]['message']; ?></p>    
    			</div>
            </div>
					
			<?php }
		 } 
			else { echo "No any Messages.";  } ?>
        </div>
            
     </div>
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
	
	
</script> 
        
<style>
.size
{
	height:55px;
	width:45px;
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
.profile_img {
    min-height: 210px;
    padding-left: 60px;
    position: relative;
}

</style>     
