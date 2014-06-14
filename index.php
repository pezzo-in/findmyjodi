<?PHP 
session_start();
	include('lib/myclass.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="FindMyJodi is the no. 1 matrimonial website to find best life partner as per your choice. Trusted by lakhs of Brides & Grooms. Search by caste and community." />
<title>Find My Jodi</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
</head>
<body>
<?PHP
	$sessionVar = 'chatUser';
	if($_GET['visit']=='1' && $_GET['mem_id']!='')
	{
		$select_member="select * from members where one_time_pass='".$_GET['mem_id']."' AND status='Deactive'";
		$db_member=$obj->select($select_member);
		
		if(count($db_member)>0)
		{
			$update_member="update members set one_time_pass='' where id='".$db_member[0]['id']."'"; //status='Active', 
			$obj->edit($update_member);
			
			$update_last_login="UPDATE members SET last_login = NOW() where id = '".$ans[0]['id']."'";
					$db_update=$obj->edit($update_last_login);
			
			$select_member="select * from members where id='".$db_member[0]['id']."'";
			$db_member=$obj->select($select_member);
					
		//	$_SESSION['id']=$db_member[0]['id'];
			
			$_SESSION['UserEmail']=$db_member[0]['email_id'];	
			$_SESSION['IsActive']='No';
			$_SESSION['logged_user'] = $db_member;
			$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$db_member[0]['id']."' AND members.id=member_plans.member_id";
			$db_member_plan=$obj->select($select_member_plan);
			
			$exp_date=date('Y-m-d');
			
			if(count($db_member_plan)>0)
			{
				$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
				$db_plan=$obj->select($select_plan);
				
				$exp_date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_date[0]['reg_date']));
			}
		
			if(count($db_member_plan)>0 && date('Y-m-d',strtotime($exp_date))>=date('Y-m-d'))
			{
						
				$_SESSION[$sessionVar]=$db_member[0]['name'];
				$_SESSION['chatStat']=1;
								
				$select_chat_user="select * from chat_users where email='".$_SESSION['UserEmail']."'";
				$db_chat_user=$obj->select($select_chat_user);
				
				if(count($db_chat_user)>0)
				{
					$update_chat_user="update chat_users set status='1', name='".$db_member[0]['name']."', chat_last_activity='".date('Y-m-d H:i:s')."' where email='".$_SESSION['UserEmail']."'";
					$obj->edit($update_chat_user);
				}
				else
				{			
					$insert_online = "insert into chat_users(id, name, email, status) values(null, '".$db_member[0]['name']."', '".$_SESSION['UserEmail']."', '1')";
					$db_insert_online = $obj->insert($insert_online);
				}
			}
			
			echo "<script> window.location='registration-step-2.php'</script>";
		}
		else
		{
			echo "<script> window.location='error.php?msg=Invalid'</script>";	
		}
	}
	if(isset($_POST['submit']))
	{
			if(isset($_GET['visit'])) 
			{
				 $sql="select * from members where (email_id = '".$_POST['email']."' or member_id = '".$_POST['email']."') and password = '".md5($_POST['password'])."'";	
				$ans=$obj->select($sql);
				if(!empty($ans))
				{		
					$update_status="UPDATE members SET status = 'Active' where member_id = '".$_GET['mem_id']."'";
					$db_updatepage=$obj->edit($update_status);
					$update_last_login="UPDATE members SET last_login = NOW() where id = '".$ans[0]['id']."'";
					$db_update=$obj->edit($update_last_login);
					
					
				//	$_SESSION['id']=$ans[0]['id'];
					$_SESSION['UserEmail']=$ans[0]['email_id'];	
					$_SESSION['IsActive']='Yes';	
					$_SESSION['logged_user'] = $ans;
					
					$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$_GET['mem_id']."' AND members.id=member_plans.member_id";
					$db_member_plan=$obj->select($select_member_plan);
					
					$exp_date=date('Y-m-d');
					
					if(count($db_member_plan)>0)
					{
						$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
						$db_plan=$obj->select($select_plan);
						
						$exp_date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_date[0]['reg_date']));
					}
				
					if(count($db_member_plan)>0 && date('Y-m-d',strtotime($exp_date))>=date('Y-m-d'))
					{
					
						$_SESSION[$sessionVar]=$ans[0]['name'];
						$_SESSION['chatStat']=1;
						
						$select_chat_user="select * from chat_users where email='".$_SESSION['UserEmail']."'";
						$db_chat_user=$obj->select($select_chat_user);
						
						if(count($db_chat_user)>0)
						{
							$update_chat_user="update chat_users set status='1', name='".$ans[0]['name']."', chat_last_activity='".date('Y-m-d H:i:s')."' where email='".$_SESSION['UserEmail']."'";
							$obj->edit($update_chat_user);
						}
						else
						{					
							$insert_online = "insert into chat_users(id, name, email, status) values(null, '".$ans[0]['name']."', '".$_SESSION['UserEmail']."', '1')";
							$db_insert_online = $obj->insert($insert_online);
						}
					}
					echo "<script> window.location='my_account.php'</script>";
				}
				else
				{
					echo "<script>alert('Invalid Email or Password');</script>";
					$error = "Invalid Email id or Password";	
				}
			}
			else
			{
				$sql="select * from members where (email_id = '".$_POST['email']."' or member_id = '".$_POST['email']."') and password = '".md5($_POST['password'])."' and status = 'Active'";		
				$ans=$obj->select($sql);
				if(!empty($ans))
				{		
					$update_last_login="UPDATE members SET last_login = NOW() where id = '".$ans[0]['id']."'";
					$db_update=$obj->edit($update_last_login);
					
					//$_SESSION['logged_user'][0]['id']=$ans[0]['id'];
					$_SESSION['UserEmail']=$ans[0]['email_id'];			
					$_SESSION['logged_user'] = $ans;
					$_SESSION['IsActive']='Yes';
					
$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$ans[0]['id']."' AND members.id=member_plans.member_id";
					$db_member_plan=$obj->select($select_member_plan);
					
					$exp_date=date('Y-m-d');
					
					if(count($db_member_plan)>0)
					{
						$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
						$db_plan=$obj->select($select_plan);
						
						$exp_date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_date[0]['reg_date']));
					}
				
					if(count($db_member_plan)>0 && date('Y-m-d',strtotime($exp_date))>=date('Y-m-d'))
					{
					
						$_SESSION[$sessionVar]=$ans[0]['name'];
						$_SESSION['chatStat']=1;
						$_SESSION['Member_status']='Paid';
											
						$select_chat_user="select * from chat_users where email='".$_SESSION['UserEmail']."'";
						$db_chat_user=$obj->select($select_chat_user);
						
						if(count($db_chat_user)>0)
						{
							$update_chat_user="update chat_users set status='1', name='".$ans[0]['name']."', chat_last_activity='".date('Y-m-d H:i:s')."' where email='".$_SESSION['UserEmail']."'";
							$obj->edit($update_chat_user);
						}
						else
						{
							$insert_online = "insert into chat_users(id, name, email, status) values(null, '".$ans[0]['name']."', '".$_SESSION['UserEmail']."', '1')";
							$db_insert_online = $obj->insert($insert_online);
						}
					}
					echo "<script> window.location='my_account.php'</script>";
				}
				else
				{
					echo "<script>alert('Invalid Email or Password');</script>";
					$error = "Invalid Email id or Password";	
				}
			}
				
	}
?>
<div class="min_part"> <img src="images/shutterstock_122935597.jpg" alt="" />
<!--top Bg start-->
  <div class="top_bg">
  <!--logo start-->
    <div class="logo"><a href="index.php"><img src="images/landing-logo.png" /></a></div>
      <!--input box start-->
    <div class="box_left">
    <form name="login" method="post">
     <div class="box1">
    <div class="box1_text">Email or Member ID</div>
        <input name="email" placeholder="Email or Member ID" type="text" id="Emailid"/>
      </div>
      <div class="box1">
    <div class="box1_text">Pasword</div>
        <input name="password"  placeholder="Password" type="password" id="password"/>
        <div class="box1_text"><a href="forgot_password.php">Forgot Pasword?</a></div>
      </div>
      <div class="box2"> <input type="submit" name="submit" value="Log In" onclick="return check_form();" /></div>
      </form>
    </div>
  </div>
     <!--header text start-->
  <div class="header_text">
  <img src="images/header_text.png" alt="" />
  <a href="register.php"><img src="images/register_bt.png" alt="" /></a>
  </div>
<div class="landing-copy">All rights reserved @Findmyjodi.com</div>
</div>
<script language="javascript" type="text/javascript">
function check_form()
{
	var pass = $('#password').val();
	var email = $('#Emailid').val();
	
	if(email == '')
	{
		
		alert('Enter Email or MemberId')
		return false;
	}
	if(pass=='')
	{
		alert('Enter Password');
		//$('#password').css('border','1px solid red');
		return false;
	}
		return true;
}
</script> 
</body>
</html>
