<?php

session_start();

include('lib/myclass.php');

//echo "<pre>";print_r($_POST);die;

/*$withphoto=0;

$horoscope1 = 0;

$unmarrid = 0;

$widow = 0;

$divorced = 0;

$aw_divorced = 0;

$my_self = 0;

$daughter = 0;

$son = 0;

$brother = 0;

$sister = 0;

$relative = 0;

$friend = 0;

$count_online = 0;

$count_offline = 0;*/

$search_coockie_data = $_SESSION['SearchCookie'];

$search_coockie_data = json_decode(stripslashes($search_coockie_data),true);



/*if(isset($_GET['clear']) && ($_GET['clear']=='all'))

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



if(isset($_GET['clear']) && ($_GET['clear']=='all'))

{

	$select_last = "select * from clear_search where session_id='".session_id()."'";

	$db_select_last = $obj->select($select_last);

	$sql=$db_select_last[0]['search'];

	$sql2=$db_select_last[0]['total_search'];

	$members = $obj->select($sql);

	$members2 = $obj->select($sql2);

}

elseif(isset($_GET['save']) && ($_GET['save']!=''))

{

	$sql = $db_save[0]['Search'];

	$sql2 = $db_save[0]['total_search'];

	$members = $obj->select($sql);

	$members2 = $obj->select($sql2);

}

else*/if(!empty($_POST))

{     

$sql = $_SESSION['Search_query'];

$sql .= " limit ".$_POST['limit1'].", 4";

$members = $obj->select($sql);

$members2 = $obj->select($sql2);

} ?>   

        <?php if(!empty($members)) { ?>

          

            <?php

					for($i=0;$i<count($members);$i++)

					{

						

						/*if($members[$i]['horoscope_match'] != ''){

						 $horoscope1 = $horoscope1 +1; 

						}

						

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

						if($members[$i]['chat_status'] == '1')

						{

							$count_online = $count_online+1;

						}

						else

						{

							$count_offline = $count_offline+1;

						}*/

						?>

            	<li class="message_box<?php if($i==0) { ?> first<?php } ?>" id="<?php echo $members[$i]['id']; ?>">

                    <div class="profile-img-box first col-md-12 col-xs-12 col-md-12">

                    <a href="view_profile.php?id=<?php echo $members[$i]['id']; ?>" target="_blank" class="popper" data-popbox="pop<?php echo $members[$i]['id']; ?>">

                     <?php 

$membership="<label style='background:none; text-align:left; font-weight:bold; color:#000; font-size:14px; height:20px; color:#000; padding-bottom:5px; display:block;'>".$members[$i]['member_id']."</label>";

							

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

		echo '<div id="pop'.$members[$i]['id'].'" class="popbox"><img src="'.$path.'" width="'.$width.'"  height="'.$height.'" /></div>';

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

          

            <div class="refine" style="display:none">

            	<img src="images/bigloader.gif" alt="" />

            </div>

            <?php } ?>

<script type="text/javascript">

$(document).ready(function(e){
	
	 $('.list_view').click(function(e) {

			$('.profl-list').fadeOut('slow','',function(){

				$('.profl-list').addClass('thumb_view');	

				$('.profl-list').fadeIn('slow');

			});

		});

		$('.grid_view').click(function(e) {

			$('.profl-list').fadeOut('slow','',function(){

				$('.profl-list').removeClass('thumb_view');	

				$('.profl-list').fadeIn('slow');

			});

		});
});

</script>