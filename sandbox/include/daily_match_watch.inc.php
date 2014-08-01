<?php
$select_partner_details="select * from preferred_partner_details where from_mem='".$_SESSION['logged_user'][0]['id']."'";
$db_partner_details=$obj->select($select_partner_details);

$condition='';

if($db_partner_details[0]['preferred_age']!='')
{
	$age=explode('to',$db_partner_details[0]['preferred_age']);
	if(count($age)==2)
	{
		$condition .= ' AND members.age between '.$age[0].' and '.$age[1].'';
	}
}

if($db_partner_details[0]['marital_status']!='')
{
	$condition .= ' AND members.relationship_status = "'.$db_partner_details[0]['marital_status'].'"';
}
if($db_partner_details[0]['height']!='')
{
	$condition .= ' AND members.height = "'.$db_partner_details[0]['height'].'"';
}
if($db_partner_details[0]['physical_status']!='')
{
	$condition .= ' AND members.physical_status = "'.$db_partner_details[0]['physical_status'].'"';
}
if($db_partner_details[0]['religion']!='')
{
	$condition .= ' AND members.religion = "'.$db_partner_details[0]['religion'].'"';
}
if($db_partner_details[0]['mother_tongue']!='')
{
	$condition .= ' AND members.mother_tongue = "'.$db_partner_details[0]['mother_tongue'].'"';
}
if($db_partner_details[0]['caste']!='')
{
	$condition .= ' AND members.caste = "'.$db_partner_details[0]['caste'].'"';
}
if($db_partner_details[0]['manglik']!='')
{
	$condition .= ' AND members.manglik_dosham = "'.$db_partner_details[0]['manglik'].'"';
}
/*if($db_partner_details[0]['star']!='')
{
	$condition .= ' AND members.star = "'.$db_partner_details[0]['star'].'"';
}*/
if($db_partner_details[0]['food']!='')
{
	$condition .= ' AND members.food = "'.$db_partner_details[0]['food'].'"';
}
if($db_partner_details[0]['is_drinker']!='')
{
	$condition .= ' AND members.is_drinker = "'.$db_partner_details[0]['is_drinker'].'"';
}
if($db_partner_details[0]['is_smoker']!='')
{
	$condition .= ' AND members.is_smoker = "'.$db_partner_details[0]['is_smoker'].'"';
}
if($db_partner_details[0]['country']!='')
{
	$condition .= ' AND members.country = "'.$db_partner_details[0]['country'].'"';
}
if($db_partner_details[0]['city']!='')
{
	$condition .= ' AND members.city = "'.$db_partner_details[0]['city'].'"';
}
/*if($db_partner_details[0]['education']!='')
{
	$condition .= ' AND members.education = "'.$db_partner_details[0]['education'].'"';
}*/
if($db_partner_details[0]['occupation']!='')
{
	$condition .= ' AND members.occupation = "'.$db_partner_details[0]['occupation'].'"';
}
if($db_partner_details[0]['annual_income']!='')
{
	$condition .= ' AND members.annual_income = "'.$db_partner_details[0]['annual_income'].'"';
}

$condition .= " and members.status = 'Active' and members.id!='".$_SESSION['logged_user'][0]['id']."'";

$select_members  = "SELECT members.*,member_photos.photo FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE 1=1 ".$condition." order by rand() Limit 6";
$members=$obj->select($select_members);

?>
        <div class="content" id="content_data">
        <?php if(!empty($members))
				{ ?>
        	<ul class="profl-list">
            <?php
					foreach($members as $res) { ?>
            	<li>
                    <div class="profile-img-box first col-md-12 col-xs-12 col-md-12">
                    <a href="view_profile.php?id=<?php echo $res['id']; ?>" class="popper" data-popbox="pop<?php echo $res['id']; ?>">
                        <?php
						if(!empty($res['photo']))
						{
						 	//$path =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/".$members[0]['photo'];
							$path = "upload/".$res['photo'];
							if (file_exists($path)) {
									//echo '<a href="javascript:;" class="popper" data-popbox="pop'.$res['id'].'"><img src="'.$path.'" class="profile_pic" style="width:152px;height:161px;" /></a>'; 
									echo '<img title="click here to upload photo" class="profile_pic" src="'.$path.'" style="width:212px;height:212px;" />';
									echo '<div id="pop'.$res['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" /></div>';
									//echo '<div id="pop'.$res['id'].'" class="popbox"><img src="'.str_replace('crop_','',$path).'" /></div>';
							}
							else{
								if($res['gender']=='M')
									echo '<img title="click here to upload photo" class="profile_pic" src="images/male-user1.png" style="width:212px;height:212px;" />';
								else
									echo '<img title="click here to upload photo" class="profile_pic" src="images/female-user1.png" style="width:212px;height:212px;" />';
							}
						}
						else{
								if($res['gender']=='M')
									echo '<img title="click here to upload photo" class="profile_pic" src="images/male-user1.png" style="width:212px;height:212px;" />';
								else
									echo '<img title="click here to upload photo" class="profile_pic" src="images/female-user1.png" style="width:212px;height:212px;" />';
							}?>
                            
                        <span><?php echo $res['name']; ?> ( <?php echo $res['religion'] ?> )<br />
<?php echo $res['age']; ?> Yrs, <?php echo $res['height']; ?> Ft<br />
<?php echo $res['education']; ?>
</span></a>
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

ul.profl-list li{ position:inherit !important; }
ul.profl-list li .profile-img-box{ position:inherit !important }
.profile-img-box{ position:inherit !important; }
</style>        