<?php
if(isset($_POST['submit']))
{
	$is_exist = "select * from admin where email = '".$_POST['email']."'";
	$db_exist_email = $obj->select($is_exist);
	if(!empty($db_exist_email))
	{
		$length = 7;
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$new_pass =  substr(str_shuffle($chars),0,$length);
		
		$update_page="UPDATE admin
					  SET 
					  	password = '".md5($new_pass)."'
					  where 
					  	email = '".$_POST['email']."'";						
		
   	   $db_updatepage=$obj->edit($update_page);	
		
		
		$to = $_POST['email'];
		$subject = "About forget Password";
		$message = "Your Login Detail is as follw: <br>"."EmailID = ".$_POST['email']."<br>Password = ".$new_pass;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";	
		$headers .= 'From: Catholic HUB Matrimonial <info@catholichub.com>';
		mail($to,$subject,$message,$headers);
		echo "<script> alert('Email Sent to your Email address.'); </script>";
		/*echo "<script> alert('Check your registered E-mail ID to reset your password'); </script>";*/
		echo "<script>window.location='login.php'</script>";
	}
}
?>
<div class="content col-md-9 col-sm-12 col-xs-12">
    <!-- BEGIN LOGIN FORM -->
    <form class="form-vertical login-form" name="login"  method="post">
      <h3 class="form-title">Forgot Password</h3>
      <div style="color:#930"> <?php echo $_GET['msg'];?></div>
      <div class="alert alert-error hide">
        <button class="close" data-dismiss="alert"></button>
        <span>Enter your Email address</span>
      </div>
      <div class="control-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Email Id</label>
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap placeholder-no-fix required" type="text" placeholder="Email address" name="email"/>
          </div>
        </div>
      </div>      
      <div class="form-actions">
        <button type="submit" style="margin-right:110px;" name="submit" class="btn green btn-block">
        Submit <i class="m-icon-swapright m-icon-white"></i>
        </button>                   
      </div>
      
    </form>
    <!-- END LOGIN FORM -->        
    <!-- BEGIN FORGOT PASSWORD FORM -->
    
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    
    <!-- END REGISTRATION FORM -->
  </div>