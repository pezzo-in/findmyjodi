<?php 
$unique_id = substr(md5(uniqid(rand(), true)), 15, 15);
	if(isset($_POST['submit']))
	{
		
		$select_member = "select * from members where email_id = '".$_POST['txtEmail']."' AND is_profile_active = 'Y' AND is_deleted = 'N'";
		$db_member = $obj->select($select_member);
		
		if(count($db_member) > 0)
		{
		$to  = $_POST['txtEmail'];
		$subject = 'Reset Your Password with Find My Jodi';
		$message = '<table width=100% cellpadding=5 cellspacing=0>				
					<tr>
					  <td colspan="2"><a href="'.$obj->SITEURL.'"><img src="'.$obj->SITEURL.'images/logo2.png" height="100" width="160" /></a></td>
					</tr>
					<tr>
					  <td colspan="2"><a href="'.$obj->SITEURL.'reset_password.php?enc='.$unique_id.'">Click here </a> to reset your password</td>
					</tr>					
					<tr>
						<td colspan=2>Thank you,</td>
					</tr>
					<tr>
						<td colspan=2>Find My Jodi Team</td>
					</tr>
				  </table>';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Find My Jodi<info@findmyjodi.com>' . "\r\n";
		echo "<script> window.location.href = 'forgot_password.php?msg=sent' </script>";	
		
		mail($to, $subject, $message, $headers);
		
		$insert_pwd = "insert into reset_password(id,unique_key,user_email) values(null,'".$unique_id."','".$_POST['txtEmail']."')";
		$sb_insert = $obj->insert($insert_pwd);
		}
		else
		{
			$select_member1 = "select * from members where email_id = '".$_POST['txtEmail']."' AND is_profile_active = 'N' AND is_deleted = 'N'";
			$db_member1 = $obj->select($select_member1);
			
			if(count($db_member1) > 0)
			{
				echo "<script> window.location.href = 'forgot_password.php?msg=inactive' </script>";	
			}
			else
			{
				echo "<script> window.location.href = 'forgot_password.php?msg=msg' </script>";		
			}
		}
		

	}
?>
<div  class="mid col-md-12 col-sm-12 col-xs-12 nopadding">
<?php
$select_banner = "select * from advertise where adv_position = 'Forgot Password Top (954 X 100)' AND status = 'Active'";
$db_banner = $obj->select($select_banner);
if(count($db_banner) > 0) 
{
	if($db_banner[0]['banner_file'] != '') 
	{
		if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {
?>
<div style="margin: 0px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>
<?php } } } ?>        	
            <div>
            	<?php if($_GET['msg'] == 'msg') { ?>
                <p class='message'>Wrong email address, Please check and try again.</p>
                <?php } ?>
                <?php if($_GET['msg'] == 'sent') { ?>
                <p class='message'>Please check your inbox to reset your password.</p>
                <?php } ?>
                <?php if($_GET['msg'] == 'inactive') { ?>
                <p class='message'>Your profile is not active.</p>
                <?php } ?>
                <p style="font-size:15px;">Please enter your E-mail ID. We will send you a link to reset your password.
                
               	<form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data" onsubmit="return check_form()">
        	<div class="new_acc" style="min-height:375px;">           
            	
            	<div class="left" style="margin-left:0px;">
                    <input type="text" name="txtEmail" id="txtEmail" class="col-md-4 col-xs-12 col-sm-8 form-control" placeholder="Your Email Id" value="<?php if(isset($_POST['txtEmail'])) { echo $_POST['txtEmail']; } ?>" onchange="return check_form()" style="margin-bottom:0px;" >
                </div>
                
                <br class="clear" />
                <div class="terms_line" style="padding-left:0px;">
                    <input type="submit" name="submit" class="btn btn-success btn-sm" value="Submit">
                </div>
                </form>
                </div>
            </div>
<?php
$select_banner = "select * from advertise where adv_position = 'Forgot Password Bottom (954 X 100)' AND status = 'Active'";
$db_banner = $obj->select($select_banner);
if(count($db_banner) > 0) 
{
	if($db_banner[0]['banner_file'] != '') 
	{
		if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {
?>
<div style="margin: 10px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>
<?php } } } ?>
        </div>
        <script>
function check_form()
{
	$('#txtEmail').css('border','1px solid #ccc');
	$('#new_password').css('border','1px solid #ccc');
	$('#confirm_password').css('border','1px solid #ccc');
	
	
	
	if(document.getElementById('new_password').value=='')
	{
		$('#new_password').css('border','1px solid red');
		new_pass=1;
	}
	else
	{
		new_pass=0;
	}
	if(document.getElementById('confirm_password').value=='')
	{
		$('#confirm_password').css('border','1px solid red');
		con_pass=1
	}
	else
	{
		con_pass=0
	}
	if(document.getElementById('txtEmail').value=='')
	{
		$('#txtEmail').css('border','1px solid red');
		
		email=1
	}
	else
	{
		email=0
	}
	
	
	if(document.getElementById('txtEmail').value!=null)
	{
		var x=document.getElementById('txtEmail').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			  $('#txtEmail').css('border','1px solid red');
			  email=1
		}
		
	}
	else
	{
		email=0
	} 
	
	if(new_pass=="0" && con_pass == "0" && email=="0")
	{
		return true;
	}
	else
	{
		return false;
	}
	
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
        
<style type="text/css" >
	.message{
	color: red; 
	font-weight:normal; 
	margin-right:385px;
	/*border:1px solid red;*/
	text-align:center;
	width:350px;
	}
	</style>        