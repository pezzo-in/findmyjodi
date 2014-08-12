<?php

if($_GET['resend']==1)
{
	
	
	
	$act_code=$_SESSION['verification_code'];
	$mobileno =$_SESSION['edited_phonenum'];
	
	
	$ch = curl_init('http://www.txtguru.in/imobile/api.php?');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "username=findmyjoditrans&password=Ganesha@1985&source=senderid&dmobile=$mobileno&message=Use Following code for Editing your Phone Number.  $act_code ");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$data = curl_exec($ch);
        curl_close($ch);
	
	echo "<script> window.location.href = 'edit_phonenum.php?msg=msg1&uid=".$_REQUEST['uid']."' </script>";
}
if(isset($_REQUEST['submit']))
{
		
		
		if($_SESSION['verification_code']==$_REQUEST['ac_code'])
		{
                  
	        $updt="update members set mobile_no='".$_SESSION['edited_txtMobNo']."',mob_code='".$_SESSION['edited_mob_code']."' where id='".base64_decode($_REQUEST['uid'])."'";
			$obj->edit($updt);
                        unset($_SESSION['verification_code']);
                        unset($_SESSION['edited_phonenum']);
                        unset($_SESSION['edited_mob_code']);
                        unset($_SESSION['edited_txtMobNo']);
             
                        echo "<script>window.location='my_account.php?ratio=".$_SESSION['ratio_number']."'</script>";
		}
		else
		{
			//echo "<script>alert('Please enter valid activation code');
			echo "<script> window.location.href = 'edit_phonenum.php?msg=msg2&uid=".$_REQUEST['uid']."' </script>";
		}
	
}
?>
    <div class="mid col-md-12 col-sm-12 col-xs-12">
    <h2>Edit Your Phone Number</h2>
    <form id="formID" class="form-horizontal" method="post" onsubmit="return check_form()">
    <input type="hidden" name="uid" id="uid" value="<?php echo $_REQUEST['uid']; ?>" />
       <div class="new_acc col-md-8 col-md-offset-2">
         <div class="left" style="width:100%">
         <?php if($_GET['msg']!='') { ?>
         <?php if($_GET['msg']=='msg1') { ?>
     		 <p style="color:#090">Verification code sent to your mobile.</p>
         <?php } ?>    
         <?php if($_GET['msg']=='msg2') { ?>
     		 <p style="color:#F00">Please enter valid verification code.</p>
         <?php } ?>    
         <?php } ?>    
             <p>You will receive your verification code on your mobile, please enter here to continue. if you do not get code please resend it.</p>
             
             <table width="100%" align="center" border="0" cellpadding="5" cellspacing="0">
                <tr>
                	<td width="20%"><label style="margin-top:-18px">Verification Code</label></td>
                    <td><input type="text" name="ac_code" id="ac_code" tabindex="2" style="clear:none;" class="form-control" placeholder="Your 6 digit activation code"></td>
                    <td>&nbsp;</td>
                </tr>
             </table>
         </div>
         <br class="clear" />
                <div class="terms_line">
	                <input type="submit" class="btn btn-success" name="submit">
	                <a style="float: left;margin: 10px 10px 30px;" class="btn btn-danger" href="edit_phonenum.php?uid=<?php echo $_GET['uid'] ?>&resend=1">Resend it</a>
                </div>
                <br><br>
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
	