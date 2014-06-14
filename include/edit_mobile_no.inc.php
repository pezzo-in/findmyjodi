<?php
session_start();
//to edit mobile no
if(isset($_POST['save_mobile_no']))
{
	$update_mob = "update members 
				   set
				   mobile_no = '".$_POST['mobile_no']."'
				   where id = '".$_SESSION['logged_user'][0]['id']."'";
			   
	$update = $obj->edit($update_mob);	
	echo "<script>window.location='edit_profile.php'</script>";			   
}
//LOGGED-IN USER'S DETAIL //
	$sql_login = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.id = '".$_SESSION['logged_user'][0]['id']."' and
				members.status = 'Active'";	


	$logged_in_member=$obj->select($sql_login);
		
?>

      <div class="content">
		      <h3>Edit Mobile No</h3>
	       		 <form name="photo_upload_form" method="post" style="padding-top:10px" enctype="multipart/form-data">
       				<div class="new_acc">
          				 <input type="text" name="mobile_no" id="mobile_no" value="<?php if(isset($logged_in_member[0]['mobile_no'])){ echo $logged_in_member[0]['mobile_no']; } ?>" />
          				 <input type="submit" name="save_mobile_no" class="submit_btn_new" value="Update">
        			 </div>
      			</form>
      </div>    
     <script>
	 function check_form()
	 {

		$('#drpProfFor').css('border','1px solid #ccc');
		$('#username').css('border','1px solid #ccc');
		$('#drpReligion').css('border','1px solid #ccc');
		$('#drpCaste').css('border','1px solid #ccc');
		$('#drpCountry').css('border','1px solid #ccc');
		$('#email').css('border','1px solid #ccc');
		$('#dob').css('border','1px solid #ccc');
		$('#drpMotherlanguage').css('border','1px solid #ccc');
		$('#txtMobNo').css('border','1px solid #ccc');
		$('#about_me').css('border','1px solid #ccc');
		$('#drpBodyType').css('border','1px solid #ccc');
		$('#drpLiving').css('border','1px solid #ccc');
		$('#drpFamilyValue').css('border','1px solid #ccc');
		$('#drpSmoking').css('border','1px solid #ccc');
		$('#drpDrinking').css('border','1px solid #ccc');
		$('#drpEatingHabits').css('border','1px solid #ccc');
		$('#partner_preference').css('border','1px solid #ccc');
		
		
		
				
		
		error = 0;
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

		if(document.getElementById('drpBodyType').value=='')
		{
			$('#drpBodyType').css('border','1px solid red');
			
			drpBodyType=1
		}
		else
		{
			drpBodyType=0
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
		if(document.getElementById('drpProfFor').value=='')
		{
			$('#drpProfFor').css('border','1px solid red');
			
			drpProfFor=1
		}
		else
		{
			drpProfFor=0
		}
		if(document.getElementById('username').value=='')
		{
			
			$('#username').css('border','1px solid red');			
			username=1
		}
		else
		{
			username=0
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
		if(document.getElementById('drpCaste').value=='')
		{
			$('#drpCaste').css('border','1px solid red');
			
			drpCaste=1
		}
		else
		{
			drpCaste=0
		}
		if(document.getElementById('drpCountry').value=='')
		{
			$('#drpCountry').css('border','1px solid red');
			
			drpCountry=1
		}
		else
		{
			drpCountry=0
		}
		if(document.getElementById('email').value!=null)
		{
			var x=document.getElementById('email').value;
			var atpos=x.indexOf("@");
			var dotpos=x.lastIndexOf(".");
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
			{
				  $('#email').css('border','1px solid red');
				  email=1
			}
			else
			{
				var val = document.getElementById('email').value;
				$.ajax({
					url: 'chkExistEmail_whileEdit.php',
					dataType: 'html',
					data: { email : val },
					success: function(data) {
					if(data != "")
					{
						$('#email').css('border','1px solid red');
						email=1
					}
					else
					{
						email=0
					}
					}
				});	
			}
		}
		else
		{
			error=0
		} 
		if(document.getElementById('dob').value=='')
		{
			$('#dob').css('border','1px solid red');
			
			dob=1
		}
		else
		{
			dob=0
		}
		if(document.getElementById('drpMotherlanguage').value=='')
		{
			$('#drpMotherlanguage').css('border','1px solid red');
			
			drpMotherlanguage=1
		}
		else
		{
			drpMotherlanguage=0
		}
		if(document.getElementById('txtMobNo').value=='')
		{
			$('#txtMobNo').css('border','1px solid red');
			
			txtMobNo=1
		}
		else
		{
			txtMobNo=0
		}

	
	if(drpProfFor == 0 && username== 0 && drpReligion == 0 && drpCaste==0 && drpCountry==0 && email==0 && dob==0 && drpMotherlanguage==0 && txtMobNo==0 && about_me == 0 && drpBodyType == 0 && drpLiving == 0 && drpFamilyValue == 0 && drpSmoking == 0 && drpDrinking == 0 && drpEatingHabits == 0 && partner_preference == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
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
