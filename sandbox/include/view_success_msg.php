<?php
session_start(); 
include('../lib/myclass.php');
$select_member="SELECT members.*,member_photos.photo FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id where members.id='".$_REQUEST['id']."'";
$db_member=$obj->select($select_member);
?>
    <div class="profile_details">
            <div class="profile_img" style="padding-left:0px; min-height:145px;">
                <div class="profile-img-box first col-md-12 col-xs-12 col-md-12" style="position:inherit">
                     <?php
					 if(($db_member[0]['photo']))
						{
							$path = "upload/thumb/".$db_member[0]['photo'];
							if ($db_member[0]['photo']!='') {
									echo '<div style="width:130px;"><img class="profile_pic" src="'.$path.'"/></div>';
							}
							else{
								if($db_member[0]['gender']=='M')
									echo '<img class="profile_pic" src="images/male-user1.png" style="width:130px;height:130px;" />';
								else
									echo '<img class="profile_pic" src="images/female-user1.png" style="width:130px;height:130px;" />';
							}
						}
						else{
								if($db_member[0]['gender']=='M')
									echo '<img class="profile_pic" src="images/male-user1.png" style="width:130px;height:130px;" />';
								else
									echo '<img class="profile_pic" src="images/female-user1.png" style="width:130px;height:130px;" />';
							}
					 ?>
                </div>
           <div style="margin-left:150px;">
                <h2><?php echo $db_member[0]['name']; ?></h2>
                <p><?php echo $db_member[0]['caste']; ?> ( <?php echo $db_member[0]['religion']; ?> )<br>
        <?php echo $db_member[0]['age'] ?> Yrs, <?php if($db_member[0]['height']!=''){ echo $db_member[0]['height'].' In'; } ?><br>
       <?php
		$sele_education = "select * from education_course where Id='".$db_member[0]['education']."'";
		$db_select_edu = $obj->select($sele_education);
		 echo $db_select_edu[0]['Title'] ?></p>
        </div>
            </div>
            <div class="row-detail new_acc">
               <span>Your express interest successfully sent to <?php echo $db_member[0]['name']; ?></span>
            </div>                
        </div>
<script>
function check_form()  
{ 
	$('#message').css('border','1px solid #ccc');
	error = 0;
	
	if($('textarea[name=message]').val().trim()=='')
	{
		$('#message').css('border','1px solid red');
		error=1
	}
	else
	{
		error=0
	}
	if(error==0)
		return true;
	else
		return false;
}
</script>