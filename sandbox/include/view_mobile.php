<?php
session_start(); 
include('../lib/myclass.php');
$select_member="SELECT members.*,member_photos.photo FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id where members.id='".$_GET['id']."'";
$db_member=$obj->select($select_member);

$logged_member = "select view_mobile from members where member_id='".$_SESSION['logged_user'][0]['member_id']."'";
$db_logged = $obj->select($logged_member);

$user_plan = "select new_membership_plans.*,member_plans.plan_id from new_membership_plans left join member_plans on new_membership_plans.id=member_plans.plan_id where member_plans.member_id='".$_SESSION['logged_user'][0]['id']."'";
$db_user_plan = $obj->select($user_plan);

$update_mob_counter = "update members set view_mobile='".($db_logged[0]['view_mobile']+1)."' where member_id='".$_SESSION['logged_user'][0]['member_id']."'"; 
$obj->edit($update_mob_counter);
?>
    <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data" onsubmit="return check_form()" >   
        <div class="profile_details">
            <div class="profile_img" style="padding-left:0px;">
                <div class="profile-img-box" style="position:inherit">
                     <?php
					 if(($db_member[0]['photo']))
						{
							$path = "upload/thumb/".$db_member[0]['photo'];
							if ($db_member[0]['photo']!='') {
									echo '<img  class="profile_pic" src="'.$path.'" style="width:130px; height:130px;" />';
							}
							else{
								if($db_member[0]['gender']=='M')
echo '<img  class="profile_pic" src="images/male-user1.png" style="width:100px;height:100px;" />';
								else
echo '<img  class="profile_pic" src="images/female-user1.png" style="width:100px;height:100px;" />';
							}
						}
						else{
								if($db_member[0]['gender']=='M')
echo '<img  class="profile_pic" src="images/male-user1.png" style="width:100px;height:100px;" />';
								else
echo '<img  class="profile_pic" src="images/female-user1.png" style="width:100px;height:100px;" />';
							}
					 ?>
                </div>
                <h2 style="float: left;width: 54%;"><?php echo "Contact Number of ". ucfirst($db_member[0]['name']).' ('.$db_member[0]['member_id'].')'; ?></h2>
                 <h3><?php echo $db_member[0]['mobile_no']; ?></h4>
            	 <span class="mobile_counter">You are viewing <?php echo $db_logged[0]['view_mobile']; ?> of <?php echo $db_user_plan[0]['no_of_contacts']; ?> number from your plan</span>       
            </div>
            <div class="row-detail new_acc">
                   
            </div>                
        </div>
    </form>
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