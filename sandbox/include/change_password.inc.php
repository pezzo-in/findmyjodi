<?php

$error='';

$success='';

if(isset($_POST['change_password']))

{

	$select_member="select * from members where id='".$_SESSION['logged_user'][0]['id']."' AND password='".md5($_POST['old_pass'])."' ";

	$db_member=$obj->select($select_member);

	

	if(count($db_member)==0)

	{

		$error='Old password is not matching. Please enter correct password.';

	}

	else

	{

		$update_password="update members set password='".md5($_POST['new_pass'])."' where id='".$_SESSION['logged_user'][0]['id']."'";

		$obj->edit($update_password);

		$success='Password Change Successfully.';		

	}

}	

?>



      <div class="content col-md-9 col-sm-12 col-xs-12">

		      <h3>Change Password <label style="margin-left:10px;color:green;"><?php echo $success; ?></label> </h3>

	       		 <form name="photo_upload_form" method="post" style="padding-top:10px" enctype="multipart/form-data">

       				<div class="new_acc chng-pwd-form">

                    	<label>Old Password</label>

						<input type="password" name="old_pass" id="old_pass" value="<?php if($success==''){ echo $_POST['old_pass']; } ?>" style="margin-bottom:inherit;" />
						<label style="color:#F00;font-size:13px;" class="old_pass_error"><?php echo $error; ?></label>
                        
                        <label>New Password</label>

						<input type="password" name="new_pass" id="new_pass" value="<?php if($success==''){ echo $_POST['new_pass']; } ?>" style="margin-bottom:inherit;" />
						<label style="color:#F00;font-size:13px;" class="new_pass_error"></label>
                        
                        <label>Confirm Password</label>

						<input type="password" name="confirm_pass" id="confirm_pass" value="<?php if($success==''){ echo $_POST['confirm_pass']; } ?>" style="margin-bottom:inherit;" />
						<label style="color:#F00;font-size:13px;" class="confirm_pass_error"></label>
          				

                        <input type="submit" name="change_password" class="update_btn_new1" onclick="return check_form()" value="Update">
                        

        			 </div>

      			</form>

      </div>    

     <script>

	 function check_form()

	 {

		$('.old_pass_error').html('');

		$('.new_pass_error').html('');

		$('.confirm_pass_error').html('');			

		

		if(document.getElementById('old_pass').value=='')

		{

			$('.old_pass_error').html('*This Field Required');

			return false;

		}

		if(document.getElementById('new_pass').value=='')

		{

			$('.new_pass_error').html('*This Field Required');

			return false;

		}

		if(document.getElementById('confirm_pass').value=='')

		{

			$('.confirm_pass_error').html('*This Field Required');

			return false;

		}

		

		if(document.getElementById('new_pass').value!=document.getElementById('confirm_pass').value)

		{

			$('.confirm_pass_error').html('Confirm Password not match');

			return false;

		}		

		

		return true;

}







$('#hobbies').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=hobbies',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

$('#family_detail').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=family_detail',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

$('#partner_pref').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=partner_pref',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

	$('#add_horoscope').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=add_horoscope',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

		$('#upload_pic').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=add_pic',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

		

		$('#edit_mobile').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'include/edit_profile_detail.php?hint=edit_mobile',

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

		

       $('#accepted').click( function() {

			$.ajax({

				   type: "GET",		

				   url: 'showIntMembers.php',

				   data:{flag: '1'},

				   success: function(data) {

					   $('.content').html( data );

				   }

				});

		});

	

	$('#submit_btn').click( function() {

		

		

	$('#drpAgeFrm').css('border','1px solid #ccc');

	$('#drpAgeTo').css('border','1px solid #ccc');

	$('#drpReligion').css('border','1px solid #ccc');

	$('#drpCaste').css('border','1px solid #ccc');

	$('#drpMaritalStatus').css('border','1px solid #ccc');

	$('#drpBodyType').css('border','1px solid #ccc');

	$('#about_me').css('border','1px solid #ccc');

	$('#drpLiving').css('border','1px solid #ccc');	

	$('#drpFamilyValue').css('border','1px solid #ccc');	

	$('#drpSmoking').css('border','1px solid #ccc');

	$('#drpDrinking').css('border','1px solid #ccc');	

	$('#drpEatingHabits').css('border','1px solid #ccc');

	$('#partner_preference').css('border','1px solid #ccc');

		

	

	if(document.getElementById('partner_preference').value=='')

	{

		$('#partner_preference').css('border','1px solid red');

		partner_preference=1

	}

	else

	{

		partner_preference=0

	}

	if(document.getElementById('drpEatingHabits').value=='')

	{

		$('#drpEatingHabits').css('border','1px solid red');

		drpEatingHabits=1

	}

	else

	{

		drpEatingHabits=0

	}

	if(document.getElementById('drpDrinking').value=='')

	{

		$('#drpDrinking').css('border','1px solid red');

		drpDrinking=1

	}

	else

	{

		drpDrinking=0

	}

	if(document.getElementById('drpSmoking').value=='')

	{

		$('#drpSmoking').css('border','1px solid red');

		drpSmoking=1

	}

	else

	{

		drpSmoking=0

	}

	if(document.getElementById('drpFamilyValue').value=='')

	{

		$('#drpFamilyValue').css('border','1px solid red');

		drpFamilyValue=1

	}

	else

	{

		drpFamilyValue=0

	}

	

	if(document.getElementById('drpLiving').value=='')

	{

		$('#drpLiving').css('border','1px solid red');

		drpLiving=1

	}

	else

	{

		drpLiving=0

	}

	

	if(document.getElementById('about_me').value=='')

	{

		$('#about_me').css('border','1px solid red');

		about_me=1

	}

	else

	{

		about_me=0

	}

	

	if(document.getElementById('drpBodyType').value=='')

	{

		$('#drpBodyType').css('border','1px solid red');

		drpBodyType=1

	}

	else

	{

		drpBodyType=0

	}

	

	if(document.getElementById('drpMaritalStatus').value=='')

	{

		$('#drpMaritalStatus').css('border','1px solid red');

		drpMaritalStatus=1

	}

	else

	{

		drpMaritalStatus=0

	}

	if(document.getElementById('drpCaste').value=='')

	{

		$('#drpCaste').css('border','1px solid red');

		drpCaste=1

	}

	else

	{

		drpCaste=0

	}

	if(document.getElementById('drpReligion').value=='')

	{

		$('#drpReligion').css('border','1px solid red');

		drpReligion=1

	}

	else

	{

		drpReligion=0

	}

	

	if(document.getElementById('drpAgeFrm').value=='')

	{

		$('#drpAgeFrm').css('border','1px solid red');

		drpAgeFrm=1

	}

	else

	{

		drpAgeFrm=0

	}

	if(document.getElementById('drpAgeTo').value=='')

	{

		$('#drpAgeTo').css('border','1px solid red');

		

		drpAgeTo=1

	}

	else

	{

		drpAgeTo=0

	}

	if(drpAgeFrm==0 && drpAgeTo==0 && drpReligion==0 && drpCaste==0 && drpMaritalStatus==0 && drpBodyType==0 && about_me == 0 && drpLiving == 0 && drpFamilyValue == 0 && drpEatingHabits == 0 && partner_preference == 0)

		{

			//var val = $('#drpProfFor').val();

			 //var formData = $(this).serialize(); 

			 var ageFrom = $('#drpAgeFrm').val();

 			 var ageTo = $('#drpAgeTo').val();

			 

			 var HgtFrom = $('#drpHeightFrm').val();

 			 var HgtTo = $('#drpHeightTo').val();

			 

			 var status = $('#drpMaritalStatus').val();

			 var language = $('#drpLanguage').val();

			 var religion = $('#drpReligion').val();

			 var caste = $('#drpCaste').val();

				

				$.ajax({

				   type: "GET",		

				   url: 'ajaxSearch.php',

				   data :{ageFrom :ageFrom,

				   		  ageTo : ageTo,

						  HgtFrom: HgtFrom,

						  HgtTo:HgtTo,

						  status : status,

						  language : language,

						  religion : religion,

						  caste :caste

						 } ,      

				   success: function(data) {

					   $('.content').html( data );

				   }

				});	

		}

		else

		{

			return false;

		}

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

	

	

</script> 

        

<style>

.size

{

	height:181px;

	width:171px;

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

.profile_pic{

	/*height:150px;*/

	width:75px;

}

.upload_pic

{

	float: left;

    margin-right: 20px;

    padding: 24px 13px;

}



</style>     

