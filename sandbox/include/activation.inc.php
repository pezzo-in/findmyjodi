<?php

if($_GET['resend']==1)
{
	$get_uid="select * from members where id='".base64_decode($_REQUEST['uid'])."'";
	
	$get_uid_data=$obj->select($get_uid);
	
	
	$rand=mt_rand(100000,999999); 
	$rand=mt_rand(100000,999999); 
	
	$url = 'http://203.124.105.204/smsapi/pushsms.aspx';
	$fields = array(
						'user' =>'reddymax', //reddymax	14378
						'pwd' =>'reddymax@123', //Reddy123	xu6170DI
						'sid' =>'CATHUB',
						'to' =>$get_uid_data[0]['mobile_no'],
						'msg' =>'Thank you for registering with our site. Use Following code for activating your account '.$rand,
						'fl' =>0,
						'gwid' =>2
				    );
					
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	$updt="update members set Activation_code='".$rand."' where id='".base64_decode($_REQUEST['uid'])."'";
	$obj->edit($updt);
	//echo '<script>alert("Verification code sent to your mobile.")
	echo "<script> window.location.href = 'activation.php?msg=msg1&uid=".$_REQUEST['uid']."' </script>";
}
if(isset($_REQUEST['submit']))
{
		$get_uid="select email_id,Activation_code,password,one_time_pass from members where id='".base64_decode($_REQUEST['uid'])."'";
		$get_uid_data=$obj->select($get_uid);
		if($get_uid_data[0]['Activation_code']==99999999)
		{
			echo "<script>alert('Your account has been already activated');</script>";
			echo "<script> window.location.href = 'login.php' </script>";
		}
		else if($get_uid_data[0]['Activation_code']==$_REQUEST['ac_code'])
		{
	$updt="update members set password='".md5($get_uid_data[0]['password'])."', Activation_code=99999999 where id='".base64_decode($_REQUEST['uid'])."'";
			$obj->edit($updt);
			echo "<script> window.location.href = 'login.php?visit=1&mem_id=".$get_uid_data[0]['one_time_pass']."' </script>";
		}
		else
		{
			//echo "<script>alert('Please enter valid activation code');
			echo "<script> window.location.href = 'activation.php?msg=msg2&uid=".$_REQUEST['uid']."' </script>";
		}
	
}
?>
    <div  class="mid col-md-12 col-sm-12 col-xs-12" style="width:954px;">
 
     		<h2>Activate Your Account</h2>
    <form id="formID" class="form-horizontal" method="post" onsubmit="return check_form()">
    <input type="hidden" name="uid" id="uid" value="<?php echo $_REQUEST['uid']; ?>" />
       <div class="new_acc">           
         <div class="left" style="width:100%">
         <?php if($_GET['msg']!='') { ?>
         <?php if($_GET['msg']=='msg1') { ?>
     		 <p style="color:#090">Verification code sent to your mobile.</p>
         <?php } ?>    
         <?php if($_GET['msg']=='msg2') { ?>
     		 <p style="color:#F00">Please enter valid activation code.</p>
         <?php } ?>    
         <?php } ?>    
             <p>You will receive your verification code on your mobile, please enter here to continue. if you do not get code please resend it.</p>
             
             <table width="100%" align="center" border="0" cellpadding="5" cellspacing="0">
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Activation Code</label></td>
                    <td><input type="text" name="ac_code" id="ac_code" tabindex="2" style="clear:none;" placeholder="Your 6 digit activation code"></td>
                    <td>&nbsp;</td>
                </tr>
             </table>
         </div>
         <br class="clear" />
                <div class="terms_line">
                <input type="submit" name="submit" />
                <a href="activation.php?uid=<?php echo $_GET['uid'] ?>&resend=1" class="" style="padding: 5px;"><img src="../images/resendit_btn.png" style="margin-top:10px;"></a>
                </div>
                </div>
                </form>
    </div>  
    </div>    
    <script>
var error = 0;	
var error_email=0;
var error_mobile=0;

function drpProfFor_fun(id)
{
	if(document.getElementById(id).value!='')
	{
		$('#'+id).css('border','1px solid #ccc');
	}
	else
	{
		$('#'+id).css('border','1px solid red');
	}
}


function check_form1()
{	
	$('#email').css('border','1px solid #ccc');
	$('#txtMobNo').css('border','1px solid #ccc');
	
	if(document.getElementById('email').value!=null)
	{
		var x=document.getElementById('email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			  $('#email').css('border','1px solid red');
			  error_email=1;
		}
		else
		{
			var val = document.getElementById('email').value;
			$.ajax({
				url: 'chkExistEmail.php',
				dataType: 'html',
				data: { email : val },
				success: function(data) {
					if(data != "")
					{
						$('#email').css('border','1px solid red');
						error_email=1;
					}
					else
					{
						error_email=0;
					}
				}
			});	
		}
	}

	
	if(document.getElementById('txtMobNo').value!=null)
	{
		var val = document.getElementById('txtMobNo').value;
		$.ajax({
			url: 'chkExistPhone.php',
			dataType: 'html',
			data: { phone : val },
			success: function(data) {
				if(data != "")
				{
					$('#txtMobNo').css('border','1px solid red');
					error_mobile=1;
				}
				else
				{
					error_mobile=0;
				}
			}
		});	
	}
}
	
function check_form()
{
	error = 0
	
	$('#drpProfFor').css('border','1px solid #ccc');
	$('#dob').css('border','1px solid #ccc');
	$('#txtMobNo').css('border','1px solid #ccc');
	$('#drpCountry').css('border','1px solid #ccc');
	$('#drpReligion').css('border','1px solid #ccc');
	$('#email').css('border','1px solid #ccc');
	$('#username').css('border','1px solid #ccc');
	$('#password').css('border','1px solid #ccc');
	$('#drpMotherlanguage').css('border','1px solid #ccc');
	$('#Message').css('border','1px solid #ccc');
	$('#Rdgender').css('border','1px solid #ccc');
	$('#drpCaste').css('border','1px solid #ccc');
	
	//$('#genderRadio').css('border','1px solid #ccc');
	

	if(document.getElementById('drpProfFor').value=='')
	{
		$('#drpProfFor').css('border','1px solid red');
		
		error=1
	}
	
	if(document.getElementById('genderRadio').value=='undefined')
	{
		
		$('#genderRadio').css('border','1px solid red');
		
		error=1
	}

	if(document.getElementById('dob').value=='')
	{
		$('#dob').css('border','1px solid red');
		
		error=1
	}
	
	if(document.getElementById('txtMobNo').value=='')
	{
		$('#txtMobNo').css('border','1px solid red');		
		error=1
	}
	
	if(document.getElementById('drpCountry').value=='')
	{
		$('#drpCountry').css('border','1px solid red');
		error=1
	}
	
	if(document.getElementById('drpReligion').value=='')
	{
		$('#drpReligion').css('border','1px solid red');
		
		error=1
	}
	
	if(document.getElementById('drpCaste').value=='')
	{
		$('#drpCaste').css('border','1px solid red');
		
		error=1
	}
	
	if(document.getElementById('email').value=='')
	{
		$('#email').css('border','1px solid red');
		
		error=1
	}
	

	if(document.getElementById('username').value=='')
	{
		$('#username').css('border','1px solid red');
		
		error=1
	}
	
	if(document.getElementById('password').value=='')
	{
		$('#password').css('border','1px solid red');
		
		error=1
	}
	
	if(document.getElementById('drpMotherlanguage').value=='')
	{
		$('#drpMotherlanguage').css('border','1px solid red');
		
		error=1
	}
	
	if(error_email==1)
	{
		$('#email').css('border','1px solid red');
	}
	
	if(error_mobile==1)
	{
		$('#txtMobNo').css('border','1px solid red');
	}
	
	if(error==0 && error_email==0 && error_mobile==0)
		return true;
	else
		return false;
}

$(function() {
	
		$('#drpCountry').change( function() {
			var val = $(this).val();
				$.ajax({
				   url: 'findPhoneCode.php',
				   dataType: 'html',
				   data: { country : val },
				   success: function(data) {
					   $('#drpMobcodedata').html( data );
				   }
				});			
		});	
		$('#drpMobcodedata').change( function() {
			var val = $('#drpMobcode').val();
				$.ajax({
				   url: 'findCountry.php',
				   dataType: 'html',
				   data: { phoneCode : val },
				   success: function(data) {
					   $('#drpCountry').html( data );
				   }
				});			
		});		
		$('#drpProfFor').click( function() {
			var val = $('#drpProfFor').val();
				$.ajax({
				   url: 'makeSelect.php',
				   dataType: 'html',
				   data: { pro_for : val },
				   success: function(data) {
					   $('#genderRadio').html( data );
				   }
				});			
		});	
	});  

</script>  
<style>
.test
{
	border:1px solid red;
	padding-top:20px;
	height:5px;
}
</style>
	