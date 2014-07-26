<?php
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
			$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$db_member[0]['id']."' AND members.id=member_plans.member_id and member_plans.expiry_date>'".date('Y-m-d')."'";
			$db_member_plan=$obj->select($select_member_plan);
			
			/*$exp_date=date('Y-m-d');
			
			if(count($db_member_plan)>0)
			{
				$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
				$db_plan=$obj->select($select_plan);
				
				$exp_date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_date[0]['reg_date']));
			}
			count($db_member_plan)>0 && date('Y-m-d',strtotime($exp_date))>=date('Y-m-d')
			*/
		
			if(($db_member_plan)>0)
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
					
					$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$_GET['mem_id']."' AND members.id=member_plans.member_id and member_plans.expiry_date>'".date('Y-m-d')."'";
					$db_member_plan=$obj->select($select_member_plan);
					
					/*$exp_date=date('Y-m-d');
					
					if(count($db_member_plan)>0)
					{
						$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
						$db_plan=$obj->select($select_plan);
						
						$exp_date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_date[0]['reg_date']));
					}
				count($db_member_plan)>0 && date('Y-m-d',strtotime($exp_date))>=date('Y-m-d')*/
					if(count($db_member_plan)>0)
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
					if(isset($_SESSION['redirect_profile'])){echo "<script> window.location='view_profile.php?id=".$_SESSION['redirect_profile']."'</script>";}
					else{echo "<script> window.location='my_account.php'</script>";}
				}
				else
				{
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
					
					$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$ans[0]['id']."' AND members.id=member_plans.member_id and member_plans.expiry_date>'".date('Y-m-d')."'";
					$db_member_plan=$obj->select($select_member_plan);
					
					/*$exp_date=date('Y-m-d');
					
					if(count($db_member_plan)>0)
					{
						$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
						$db_plan=$obj->select($select_plan);
						
						$exp_date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_date[0]['reg_date']));
					}
					count($db_member_plan)>0 && date('Y-m-d',strtotime($exp_date))>=date('Y-m-d')*/
					if(count($db_member_plan)>0)
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
					if(isset($_SESSION['redirect_profile'])){echo "<script> window.location='view_profile.php?id=".$_SESSION['redirect_profile']."'</script>";}
					else{echo "<script> window.location='my_account.php'</script>";}
				}
				else
				{
					$error = "Invalid Email id or Password";	
				}
			}
				
	}
?>
<div  class="mid col-md-12 col-sm-12 col-xs-12 nopadding">
        	<div class="span1 first">
               	<h2>New User</h2>
                <p></p>
                <a href="register.php" class="creat_acc_btn"></a>
                
           	</div>
            <div class="span1">
            	<h2>Registered User</h2>
                <p>If you have an account with us, please log in.</p>
                <span class="req_field_text">* Required Fields</span>
                <?php if (isset($error)) { echo "<p class='message' style='border:none'>" .$error. "</p>" ;} ?>
               	<form method="post" name="login" onsubmit="return check_form()">
                	<div class="login-user">
                    	<label>Email or Member Id<span class="req_field">*</span></label>
                    	<input type="text" placeholder="Email ID OR Member ID" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" name="email" id="email" onchange="return check_form()">
                        <label>Password <span class="req_field">*</span></label>
                        <input type="password" placeholder="Password" name="password" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>" id="password" onchange="return check_form()">
                        <input type="submit" name="submit" />
                        <div class="clear"></div><br />
                        <h3>Forgot your password?</h3>
                        <span>no worries, click <a href="forgot_password.php">here</a> to reset your password.</span>
                    </div>
                </form>
            </div>
        </div>
        
<script>
function check_form()
{
	$('#email').css('border','1px solid #ccc');
	$('#password').css('border','1px solid #ccc');
	
	
	if(document.getElementById('password').value=='')
	{
		$('#password').css('border','1px solid red');
		pass=1
	}
	else
	{
		pass=0
	}
	if(document.getElementById('email').value=='')
	{
		$('#email').css('border','1px solid red');
		
		email=1
	}
	else
	{
		email=0
	}
	
	
	/*if(document.getElementById('email').value!=null)
	{
		var x=document.getElementById('email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			  $('#email').css('border','1px solid red');
			  email=1
		}
	}
	else
	{
		email=0
	} */ 
		
	
	if(email==0 && pass==0)
		return true;
	else
		return false;
}
 
</script>  
<style>
.message
{
	border:1px solid red;
	color:red;
	width:185px;
}
</style>
	