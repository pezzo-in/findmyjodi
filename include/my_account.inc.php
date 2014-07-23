<?php
$url=explode('/',$_SERVER['REQUEST_URI']);
if($_GET['did'] != ''){
 $sqld="delete from members where id = '".$_GET['did']."' ";
	 $obj->sql_query($sqld);
	 
	session_destroy();
	
	echo "<script>window.location='login.php'</script>";	
}
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
	$sql_login = "SELECT members.*,member_photos.photo,member_photos.Approve FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.id = '".$_SESSION['logged_user'][0]['id']."'";	
				
	$logged_in_member=$obj->select($sql_login);
?>
<?php if(isset($_SESSION['profile_update'])) { ?>
<a href="javascript:;" class="success_msg" style="display:none"> </a>
<script type="text/javascript">
$(document).ready(function(e) {
   $('.success_msg').trigger('click'); 
});
</script>
<?php unset($_SESSION['profile_update']); } ?>
        <?php if(!empty($logged_in_member)) { ?>	
        <div class="content col-md-9 col-xs-12 col-sm-12">
        <div class="profile_details">
            	<?php if($_GET['msg'] == 'D'){
						echo "Your profile is successfully Deactivated.";
					}elseif($_GET['msg'] == 'A'){
						echo "Your profile is successfully Activated.";
					}
					?>
                
                <?php if($logged_in_member[0]['about_me']!=''){ ?>
                <div class="row-detail">
                	<span class="about_me1"></span><h3>About Me<?php //echo $logged_in_member[0]['name']; ?></h3>
                	<p><?php echo substr($logged_in_member[0]['about_me'],0,800); ?></p>
                </div>
                <?php } ?>
                
                <?php if($logged_in_member[0]['relationship_status']!='' || $logged_in_member[0]['noof_children_living_status'] || $logged_in_member[0]['profile_for'] || $logged_in_member[0]['annual_income'] || $logged_in_member[0]['star'] || $logged_in_member[0]['occupation'] || $logged_in_member[0]['state'] || $logged_in_member[0]['city']){ ?>
                <div class="row-detail">
                	<span class="about_me1"></span><h3>More About Me<?php //echo $logged_in_member[0]['name']; ?></h3>
                	<?php if(!empty($logged_in_member[0]['relationship_status'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Marital Status</li><li>:</li><li><?php echo $logged_in_member[0]['relationship_status']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['noof_children_living_status'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Have Children</li><li>:</li><li><?php if(!empty($logged_in_member[0]['noof_children_living_status'])){ echo $logged_in_member[0]['noof_children_living_status']; } else { echo "No"; }  ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['profile_for'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Created By</li><li>:</li><li><?php if($logged_in_member[0]['profile_for']=="Son" || $logged_in_member[0]['profile_for']=="Daughter") {echo "Parent";} else { echo $logged_in_member[0]['profile_for']; } ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['star'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Star</li><li>:</li><li><?php echo $logged_in_member[0]['star']; ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['country'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Country Living In</li><li>:</li><li><?php echo $logged_in_member[0]['country']; ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['state'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Residing State</li><li>:</li><li><?php echo $logged_in_member[0]['state']; ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['city'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Residing City</li><li>:</li><li><?php echo ucfirst($logged_in_member[0]['city']); ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['mobile_no'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Mobile No.</li><li>:</li><li><?php echo $logged_in_member[0]['mob_code'].' '.$logged_in_member[0]['mobile_no']; ?></li></ul><?php } ?>
                    
                    
                    <ul class="col-md-6 col-sm-6 col-xs-12"><li>Last Login</li><li>:</li><li>
					<?php if($logged_in_member[0]['last_login'] == '0000-00-00') { ?>
                    <?php echo date('d M Y'); ?>
                    <?php } else { ?>
                    <?php echo date('d M Y',strtotime($logged_in_member[0]['last_login'])); ?>
                    <?php } ?>
					</li></ul>
                </div>
                <?php } ?>
                
                <?php if($logged_in_member[0]['education']!='' || $logged_in_member[0]['employed_in']!=''){ ?>
                <div class="row-detail">
                	<span class="Qualification1"></span><h3><?php //echo $logged_in_member[0]['name']; ?> Education & Occupation</h3>
                	<?php if(!empty($logged_in_member[0]['education'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Education</li><li>:</li><li>
                    <?php
					$select_education="select * from education_course where Id='".$logged_in_member[0]['education']."'";
					$db_education=$obj->select($select_education);
					echo $db_education[0]['Title'];
					?>
                    </li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['employed_in'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Employed in</li><li>:</li><li><?php echo $logged_in_member[0]['employed_in']; ?></li></ul><?php } ?>
                    
                    <?php if(!empty($logged_in_member[0]['annual_income'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Income</li><li>:</li><li><?php echo $logged_in_member[0]['annual_income']; ?></li></ul><?php } ?>
					 <?php if(!empty($logged_in_member[0]['occupation'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Occupation</li><li>:</li><li><?php echo $logged_in_member[0]['occupation']; ?></li></ul><?php } ?>
                                        
                </div>
                <?php } ?>
                
                <?php if($logged_in_member[0]['height']!='' || $logged_in_member[0]['weight']!='' || $logged_in_member[0]['complexion']!='' || $logged_in_member[0]['body_type']!='' || $logged_in_member[0]['physical_status']!='' ){ ?>
                <div class="row-detail">
                	<span class="looks1"></span><h3><?php //echo $logged_in_member[0]['name']; ?> Physical Appearance & Looks</h3>
                	<?php if(!empty($logged_in_member[0]['height'])) { ?>
                    	<ul class="col-md-6 col-sm-6 col-xs-12"><li>Height</li><li>:</li>
                        	<li>
								<?php 
								$select_height="select * from height where Id='".$logged_in_member[0]['height']."'";
								$db_height=$obj->select($select_height);
								echo $db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';
								if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }
								?>								
                            </li>
                        </ul>
						<?php } ?>
<?php if(!empty($logged_in_member[0]['weight'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Weight</li><li>:</li><li><?php echo $logged_in_member[0]['weight']; ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['complexion'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Complexion</li><li>:</li><li><?php echo ucfirst($logged_in_member[0]['complexion']); ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['body_type'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Body Type</li><li>:</li><li><?php echo $logged_in_member[0]['body_type']; ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['physical_status'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Physical Status</li><li>:</li><li><?php echo ucfirst($logged_in_member[0]['physical_status']); ?></li></ul><?php } ?>
                </div>
                <?php } ?>
               
                <?php if($logged_in_member[0]['religion']!='' || $logged_in_member[0]['mother_tongue']!='' || $logged_in_member[0]['caste']!='' || $logged_in_member[0]['subcaste']!='' || $logged_in_member[0]['manglik_dosham']!='' || $logged_in_member[0]['gothram']!=''){ ?>
                <div class="row-detail">
                	<span class="religion1"></span><h3><?php //echo $logged_in_member[0]['name']; ?> Religion and Social info</h3>
                	<?php if(!empty($logged_in_member[0]['religion'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Religion</li><li>:</li><li><?php echo $logged_in_member[0]['religion']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['mother_tongue'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Mother Tongue</li><li>:</li><li><?php echo $logged_in_member[0]['mother_tongue']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['caste'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Caste</li><li>:</li><li><?php echo $logged_in_member[0]['caste']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['subcaste'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Sub Caste</li><li>:</li><li><?php echo $logged_in_member[0]['subcaste']; ?></li></ul><?php } ?>
                   <?php if(!empty($logged_in_member[0]['manglik_dosham'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Manglik</li><li>:</li><li>
				   <?php if($logged_in_member[0]['manglik_dosham'] == 'N') { echo "No"; }elseif($logged_in_member[0]['manglik_dosham'] == 'Y') { echo "Yes"; }elseif($logged_in_member[0]['manglik_dosham'] == 'Dont Know') { echo "Dont Know"; } ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['gothram'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Gotra /Gothram </li><li>:</li><li><?php echo $logged_in_member[0]['gothram']; ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['horoscope_match'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Horoscope </li><li>:</li><li><?php echo $logged_in_member[0]['horoscope_match']; ?></li></ul><?php } ?>
                </div>
                <?php } ?>
                
                <?php if($logged_in_member[0]['date_of_birth']!='' || $logged_in_member[0]['place_of_birth']!='' ){ ?>
                <div class="row-detail">
                	<span class="astro1"></span><h3>Astro info</h3>
                	<?php if(!empty($logged_in_member[0]['date_of_birth'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Date Of Birth</li><li>:</li><li><?php echo date('d M Y',strtotime(($logged_in_member[0]['date_of_birth']))); ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['place_of_birth'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Place of birth</li><li>:</li><li><?php echo $logged_in_member[0]['place_of_birth']; ?></li></ul><?php } ?>
                </div>
                <?php } ?>
                
                <?php if($logged_in_member[0]['no_of_brothers']!='' || $logged_in_member[0]['no_of_sisters']!='' || $logged_in_member[0]['living_with_parents']!='' || $logged_in_member[0]['family_value']!='' || $logged_in_member[0]['family_type']!='' || $logged_in_member[0]['family_status']!=''){ ?>
                <div class="row-detail">
                	<span class="family1"></span><h3>Family</h3>
<?php if(!empty($logged_in_member[0]['father_occupation'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Father's Occupation</li><li>:</li><li><?php echo $logged_in_member[0]['father_occupation']; ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['mother_occupation'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Mother's Occupation</li><li>:</li><li><?php echo $logged_in_member[0]['mother_occupation']; ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['no_of_brothers'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Brothers</li><li>:</li><li><?php echo $logged_in_member[0]['no_of_brothers']; ?> brother  (<?php echo $logged_in_member[0]['bro_married']; ?> Married)</li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['no_of_sisters'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Sisters</li><li>:</li><li><?php echo $logged_in_member[0]['no_of_sisters']; ?> sisters (<?php echo $logged_in_member[0]['sis_married']; ?> Married)</li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['living_with_parents'])) { ?> <ul class="col-md-6 col-sm-6 col-xs-12"><li>Living with parents?</li><li>:</li><li>
<?php if( $logged_in_member[0]['living_with_parents'] == "Y") { echo "Yes"; } else { echo "No"; }?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['family_value'])) { ?> <ul class="col-md-6 col-sm-6 col-xs-12"><li>Family values</li><li>:</li><li><?php echo ucfirst($logged_in_member[0]['family_value']); ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['family_type'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Family Type</li><li>:</li><li><?php echo ucfirst($logged_in_member[0]['family_type']); ?></li></ul><?php } ?>
<?php if(!empty($logged_in_member[0]['family_status'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Family Status</li><li>:</li><li><?php echo ucfirst($logged_in_member[0]['family_status']); ?></li></ul><?php } ?>
                </div>
                <?php } ?>
                
                <?php if(!empty($logged_in_member[0]['is_smoker']) ||  (!empty($logged_in_member[0]['is_smoker'])) ||
						(!empty($logged_in_member[0]['is_drinker'])) || (!empty($logged_in_member[0]['eating_habits']))) { ?>
                <div class="row-detail">
                	<span class="life_style1"></span><h3><?php //echo $logged_in_member[0]['name']; ?> Lifestyle</h3>
                     <?php if(!empty($logged_in_member[0]['is_smoker'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Smoking</li><li>:</li><li><?php if($logged_in_member[0]['is_smoker'] == 'N') { echo "No"; } elseif($logged_in_member[0]['is_smoker'] == "O"){ echo "Occasionally"; }else { echo "Yes"; } ?></li></ul><?php } ?>
                    <?php if(!empty($logged_in_member[0]['is_drinker'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Drinking</li><li>:</li><li><?php if($logged_in_member[0]['is_drinker'] == "Y") { echo "Yes"; }elseif($logged_in_member[0]['is_drinker'] == "O"){ echo "Occasionally"; }else { echo "No"; } ?></li></ul><?php } ?>
                     <?php if(!empty($logged_in_member[0]['food'])) { ?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Food</li><li>:</li><li><?php echo $logged_in_member[0]['food']; ?></li></ul><?php } ?>
                </div>
                <?php } ?>
                
                <?php
				$select_memebr_hobbies_interest="select * from memebr_hobbies_interest where member_id='".$_SESSION['logged_user'][0]['id']."'";
				$db_memebr_hobbies_interest=$obj->select($select_memebr_hobbies_interest);
				?>
                
                <?php if($db_memebr_hobbies_interest[0]['hobbies']!='' || $db_memebr_hobbies_interest[0]['interests']!='' || $db_memebr_hobbies_interest[0]['music']!='' || $db_memebr_hobbies_interest[0]['read_book']!='' || $db_memebr_hobbies_interest[0]['movies']!='' || $db_memebr_hobbies_interest[0]['sports']!='' || $db_memebr_hobbies_interest[0]['cuisine']!='' || $db_memebr_hobbies_interest[0]['dress_style']!='' || $db_memebr_hobbies_interest[0]['spoken_lang']!=''){ ?>
                 <div class="row-detail row-detail-hobbies">
                	<span class="hobbies1"></span><h3>Hobbies & Interests</h3>
                     
					 <?php if($db_memebr_hobbies_interest[0]['hobbies']!=''){?><ul class="col-md-6 col-sm-6 col-xs-12"><li>Hobbies</li><li class="nthchild2">:</li><li>
					 <?php
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
                     
                     <?php if($db_memebr_hobbies_interest[0]['interests']!=''){?><ul><li>Interests</li><li class="nthchild2">:</li><li>
					 <?php
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
                     
                     <?php if($db_memebr_hobbies_interest[0]['music']!=''){?><ul><li>Favourite Music</li><li class="nthchild2">:</li><li>		<?php
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
                     
                     <?php if($db_memebr_hobbies_interest[0]['read_book']!=''){?><ul><li>Favourite Read</li><li class="nthchild2">:</li><li><?php
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
                     
                     <?php if($db_memebr_hobbies_interest[0]['movies']!=''){?><ul><li>Favourite movie</li><li class="nthchild2">:</li><li><?php
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
                     
                     <?php if($db_memebr_hobbies_interest[0]['sports']!=''){?><ul><li>Sports/fitness Activities</li><li class="nthchild2">:</li><li><?php
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
                     
                     <?php if($db_memebr_hobbies_interest[0]['cuisine']!=''){?><ul><li>Favourite Couisine</li><li class="nthchild2">:</li><li><?php
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
                     
                      <?php if($db_memebr_hobbies_interest[0]['dress_style']!=''){?><ul><li>Dress Style</li><li class="nthchild2">:</li><li><?php
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
                     
                     <?php if($db_memebr_hobbies_interest[0]['spoken_lang']!=''){?><ul><li>Spoken Languages</li><li class="nthchild2">:</li><li><?php
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
				 $select_preferred_partner="select * from preferred_partner_details where from_mem=".$_SESSION['logged_user'][0]['id'];
				 $db_preferred_partner=$obj->select($select_preferred_partner);
				 if(count($db_preferred_partner)>0)
				 {
				?>
                    <div class="row-detail">
                        <span class="patner1"></span><h3>Partner Prefrence</h3>   
                        <?php if($db_preferred_partner[0]['preferred_age']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Age</li>
                            <li>:</li>
                            <li><?php 
							$newage = str_replace('to',' to ',$db_preferred_partner[0]['preferred_age']);
							echo $newage;//$db_preferred_partner[0]['preferred_age']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['marital_status']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Marital Status</li>
                            <li>:</li>
                            <li><?php echo $db_preferred_partner[0]['marital_status']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['height']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
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
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Physical Status</li>
                            <li>:</li>
                            <li><?php echo ucfirst($db_preferred_partner[0]['physical_status']); ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['religion']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Religion</li>
                            <li>:</li>
                            <li><?php echo $db_preferred_partner[0]['religion']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['mother_tongue']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Mother Tongue</li>
                            <li>:</li>
                            <li><?php echo $db_preferred_partner[0]['mother_tongue']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['caste']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Caste</li>
                            <li>:</li>
                            <li><?php echo $db_preferred_partner[0]['caste']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['manglik']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Manglik</li>
                            <li>:</li>
                            <li><?php if($db_preferred_partner[0]['manglik']=='Y'){ echo 'Yes'; }else{ echo 'No'; } ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['star']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Star</li>
                            <li>:</li>
                            <li><?php echo $db_preferred_partner[0]['star']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['food']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Food</li>
                            <li>:</li>
                            <li><?php echo $db_preferred_partner[0]['food']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['is_drinker']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Drinking</li>
                            <li>:</li>
                            <li><?php if($db_preferred_partner[0]['is_drinker']=='N'){ echo 'No'; }else{ echo 'Yes'; } ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['is_smoker']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Smoking</li>
                            <li>:</li>
                            <li><?php if($db_preferred_partner[0]['is_smoker']=='N'){ echo 'No'; }else{ echo 'Yes'; } ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['country']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Country</li>
                            <li>:</li>
                            <li><?php echo $db_preferred_partner[0]['country']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['city']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>City</li>
                            <li>:</li>
                            <li><?php echo $db_preferred_partner[0]['city']; ?></li>
                        </ul>
                        <?php } ?>
                        
                        <?php if($db_preferred_partner[0]['education']!=''){ ?>
                        <?php 
								$select_education_details="select * from education_course where id='".$db_preferred_partner[0]['education']."'";
								 //$level="SELECT education_details.* FROM `education_details` join education_course on Eid=education_details.id group by education_details.id"; 
								$db_education_details=$obj->select($select_education_details);
								
							?>
                           
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Education</li>
                            <li>:</li>                            
                            <li><?php echo $db_education_details[0]['Title']; ?></li>
                        </ul>
                        
                        <?php }  ?>
                         <?php if($db_preferred_partner[0]['manglik']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Manglik</li>
                            <li>:</li>
                           	<?php if($db_preferred_partner[0]['manglik']=='N') {?>
                            <li><?php echo "No"; ?></li> <?php }
                            else {
								?>
                                   <li><?php echo "Yes"; ?></li>
                                <?php
							} ?>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['occupation']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Occupation</li>
                            <li>:</li>
                            <li><?php echo $db_preferred_partner[0]['occupation']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['annual_income']!=''){ ?>
                        <ul class="col-md-6 col-sm-6 col-xs-12">
                        	<li>Annual Income</li>
                            <li>:</li>
                            <li><?php echo $db_preferred_partner[0]['annual_income']; ?></li>
                        </ul>
                        <?php } ?>
                        <?php if($db_preferred_partner[0]['partner_description']!=''){ ?>
                        <ul class="col-md-12 col-sm-12 col-xs-12">
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
