<?php
session_start(); 
include('../lib/myclass.php');
$select_member="SELECT members.*,member_photos.photo,height.Ft_val,height.In_val FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id LEFT JOIN height ON members.height = height.id where members.id='".$_GET['id']."'";
//echo $select_member;
$db_member=$obj->select($select_member);

$logged_member = "select num_send_msg from members where member_id='".$_SESSION['logged_user'][0]['member_id']."'";
$db_logged = $obj->select($logged_member);

$user_plan = "select new_membership_plans.*,member_plans.plan_id from new_membership_plans left join member_plans on new_membership_plans.id=member_plans.plan_id where member_plans.member_id='".$_SESSION['logged_user'][0]['id']."'";
$db_user_plan = $obj->select($user_plan);
?>
    <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data" onsubmit="return check_form()" >   
        <div class="profile_details">
            <div class="profile_img" style="padding-left:0px; min-height:145px;">
                <div class="profile-img-box first col-md-12 col-xs-12 col-md-12" style="position:inherit">
                     <?php
					 if(($db_member[0]['photo']))
						{
							$path = "upload/thumb/".$db_member[0]['photo'];
							if ($db_member[0]['photo']!='') {
									echo '<div style="width:130px"><img class="profile_pic" src="'.$path.'" style="width:130px"/></div>';
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
                <h2><?php echo $db_member[0]['name'].' ('.$db_member[0]['member_id'].')'; ?></h2>
                <p><?php echo $db_member[0]['caste']; ?> ( <?php echo $db_member[0]['religion']; ?> )<br>
        <?php echo $db_member[0]['age'] ?> Yrs, <?php if($db_member[0]['height']!=''){ echo $db_member[0]['Ft_val'].' Ft '.$db_member[0]['In_val'].' In'; } ?><br>
       <?php
		$sele_education = "select * from education_course where Id='".$db_member[0]['education']."'";
		$db_select_edu = $obj->select($sele_education);
		 echo $db_select_edu[0]['Title'] ?></p>
        </div>
            </div>
            <div class="row-detail new_acc">
                <h3>Send Message to <?php echo $db_member[0]['name']; ?></h3>
                <input type="hidden" name="member_id" id="member_id" value="<?php echo $_GET['id']; ?>" />
                <input type="hidden" name="num_send_msg" id="num_send_msg" value="<?php echo $db_logged[0]['num_send_msg']; ?>" />
                <input type="hidden" name="to_member_id" id="member_id" value="<?php echo $_GET['to_mem_id']; ?>" />
                <input type="hidden" name="from_member_id" id="member_id" value="<?php echo $_SESSION['logged_user'][0]['member_id']; ?>" />
                <textarea name="message" id="message" class="span6 m-wrap required" style="width:98%;height:75px;"></textarea>
                 <span style="font-size:12px; float:left;">You are sending <?php echo $db_logged[0]['num_send_msg']; ?> of <?php echo $db_user_plan[0]['allow_messages']; ?> message from your plan</span>
                <input type="submit" name="send_msg" class="btn blue send_new1" value="SEND">
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