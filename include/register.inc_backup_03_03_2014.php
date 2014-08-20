<?php
	/*$user = "reddymax";
	$password = "Reddy123";
	$baseurl ="https://login.smsgatewayhub.com";
	$text = urlencode("Thank you for registering with our site. Use Following code for activating your account ".$rand);
	$to = "8401796354";
	$sender='CATHUB';
	
	// auth call
	$url = "http://login.smsgatewayhub.com/API/WebSMS/Http/v1.0a/index.php?username=$user&password=$password&sender=$sender&to=$to&message=$text";
	
	// do auth call
	$ret = file($url);
	
	// explode our response. return string is on first line of the data returned
	$sess = explode(":",$ret[0]);
	if ($sess[0] == "OK") {
	
	$sess_id = trim($sess[1]); // remove any whitespace
	$url = "http://login.smsgatewayhub.com/API/WebSMS/Http/v1.0a/index.php?to=$to&message=$text";
	
	// do sendmsg call
	$ret = file($url);
	$send = explode(":",$ret[0]);
		
	if ($send[0] == "ID") {
	echo "successnmessage ID: ". $send[1];
	} else {
	echo "send message failed";
	}
	} else {
	echo "Authentication failure: ". $ret[0];
	}
	
	exit;
*/
	function redemption_code()
	{
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		$redemption_code = "";
		for ($i = 0; $i < 11; $i++) {
			$redemption_code .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		return $redemption_code;
	}
	
	if(isset($_POST['submit']))
	{
		$dob = explode("/",$_POST['dob']);
		$today = date('Y-m-d');//new DateTime();
		$birthdate = $dob[2]."-".$dob[1]."-".$dob[0];//date('Y-m-d',strtotime($_POST['dob']));
		$interval = date('Y') - date('Y',strtotime($birthdate));
		//$interval = $today->diff($birthdate);
		$age = $interval;//$interval->format('%y');
		$one_time_pass=redemption_code();
		
$insert="INSERT into members(id, profile_for, name, gender, date_of_birth,age, religion,mother_tongue , caste, country, mob_code, mobile_no, email_id, password, status, reg_date,day, month,year, one_time_pass, annual_income, star, occupation, manglik_dosham)values (NULL, '".$_POST['drpProfFor']."', '".$_POST['username']."', '".$_POST['Rdgender']."', '".$birthdate."', '".$age."', '".$_POST['drpReligion']."', '".$_POST['drpMotherlanguage']."', '".$_POST['drpCaste']."', '".$_POST['drpCountry']."', '".$_POST['drpMobcodedata']."', '".$_POST['txtMobNo']."', '".$_POST['email']."', '".$_POST['password']."', 'Deactive', '".date('Y-m-d')."', '".date('d')."', '".date('m')."', '".date('Y')."', '".$one_time_pass."', '".$_POST['drpIncome']."', '".$_POST['drpStar']."', '".$_POST['drpOccupation']."', '".$_POST['drpManglik']."')";
		$db_ins=$obj->insert($insert);
		
		$inserted_id =  mysql_insert_id();	
	if(strlen($inserted_id) == "1")
	{
		$mem_id = "CH000".$inserted_id;
	}
	elseif(strlen($inserted_id) == "2")
	{
		$mem_id = "CH00".$inserted_id;
	}
	elseif(strlen($inserted_id) == "3")
	{
		$mem_id = "CH0".$inserted_id;
	}
	$update_page="UPDATE members SET member_id = '".$mem_id."' where id = '".$inserted_id."'";
	$db_updatepage=$obj->edit($update_page);
	if(!empty($_FILES['file']['name'][0]))
	{
		$select_category = "SELECT max(id) as id FROM members";
		$db_member = $obj->select($select_category);
		for ($i = 0; $i < count($_FILES['file']); $i++) {
			$fileLink =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/". $_FILES['file']['name'][$i];
			$fileType = $_FILES['file']['type'][$i];
			$fileSize = ($_FILES['file']['type'][$i]) / 1024;
			$source = "$fileLink";
			if ((move_uploaded_file($_FILES["file"]["tmp_name"][$i], $source))) {
				$insert="INSERT into member_photos(id,member_id,photo)
						 values
					 		(NULL,'".$db_member[0]['id']."','".$_FILES["file"]["name"][$i]."')";						
				$db_ins=$obj->insert($insert);
			}			
		}
		//end photo  upload
	}
	$rand=mt_rand(100000,999999); 
	$rand=mt_rand(100000,999999); 
	
	$url = 'http://203.124.105.204/smsapi/pushsms.aspx';
	$fields = array(
						'user' =>'reddymax', //reddymax	14378
						'pwd' =>'reddymax@123', //Reddy123	xu6170DI
						'sid' =>'CATHUB',
						'to' =>$_REQUEST['txtMobNo'],
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
	
	$updt="update members set Activation_code='".$rand."' where id='".$db_ins."'";
	$obj->edit($updt);
	
		
		$to=$_POST['email'];
		$subject = "Registration with Find My Jodi";
		
		$loginurl = $obj->SITEURL."activation.php?uid=".base64_encode($db_ins);
		$message = '<div style="width:98%;border:1px solid #ccc;padding:10px;border-radius:5px">
			<a href="'.$obj->SITEURL.'"><img src="'.$obj->SITEURL.'images/logo2.png" height="100" width="160" /></a><br /><br />';
		$message .= '<strong>Dear Sir/Madam,</strong><br /><br />';
		
		$message .= "Congrats!..You have successfully registered with our site<br /><br />
					To activate your account <a href='".$obj->SITEURL."activation.php?uid=".base64_encode($db_ins)."' style='font-size:13px; font-weight:bold;'>Click Here</a><br><br>
							 Your registration detail is as follow:<br>
							 Email ID : ". $_POST['email']."<br />
							 Password : ".$_POST['password']."<br /><br />";					
		//$message.= "To activate your account. <a href='".$loginurl."'><strong>Click here</strong></a>\n\n";
		
		$message.= "<br /><br /><strong>Thank You,</strong><br />";
		$message.= "<strong>Find My Jodi</strong><br />";
		$message .= '</div>';
					 
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";	
		$headers .= 'From: Find My Jodi <info@findmyjodi.com>';
		if(mail($to,$subject,$message,$headers))
		{
			
			echo "<script> window.location.href='activation.php?uid=".base64_encode($db_ins)."';</script>";
		}
		
	}
?>
    <div  class="mid col-md-12 col-sm-12 col-xs-12">
 		<div class="cont_left">
        	<?php
			$select_banner = "select * from advertise where adv_position = 'Register Top (622 X 197)' AND status = 'Active'";
			$db_banner = $obj->select($select_banner);
			if(count($db_banner) > 0) 
			{
				if($db_banner[0]['banner_file'] != '') 
				{
					if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {
			?>
            <div class="banner_inner"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>
            <?php } } } ?>
     		<h2 style="width:622px;">Create an account</h2>
    <form id="formID" class="form-horizontal" method="post" onsubmit="return check_form()">
    
    <div class="new_acc">           
         <div class="left" style="width:100%">
     		 <table width="100%" align="center" border="0" cellpadding="5" cellspacing="0" class="tbl_control">
             	<tr>
                	<td width="30%"><label style="margin-top:-18px">Matrimony profile created for<font color="#FF0000">*</font></label></td>
                    <td><select id="drpProfFor" name="drpProfFor" onchange="drpProfFor_fun(this.id)" tabindex="1" style="clear:none;" >
                        <option value="">-Select-</option>
                        <option value="Myself">Myself</option>
                        <option value="Son">Son</option>
                        <option value="Daughter">Daughter</option>
                        <option value="Brother">Brother</option>
                        <option value="Sister">Sister</option>
                        <option value="Relative">Relative</option>
                        <option value="Friend">Friend</option>
                    </select><br /><span id="profile_for" class="err_msg">Select for whom this profile is for</span></td>
                </tr>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Name<font color="#FF0000">*</font></label></td>
                    <td><input type="text" name="username" id="username" tabindex="2" style="clear:none;">
                    <br /><span id="nm" class="err_msg">Enter valid name</span>
                    </td>
                </tr>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Date of Birth<font color="#FF0000">*</font></label></td>
                    <td><link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
                  <script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
                  <script src="js/jquery-ui.js"></script>
                 <input type="text" class="" id="dob" name="dob" tabindex="3" onchange="drpProfFor_fun(this.id)" readonly="readonly"  style="clear:none;" />
                  <br /><span id="edob" class="err_msg">Enter date of birth</span>
                     <script>
							 var d = new Date();
							var year = d.getFullYear() - 18;
						$(function() {
							var dates = $( "#dob" ).datepicker({
								changeYear: true,
								changeMonth: true,
								numberOfMonths: 1,
								dateFormat  : 'dd/mm/yy',
								yearRange: '-50:-18',
								reverseYearRange: true,
								defaultDate: '-18y'
												});
						});
					</script></td>
                </tr>
                
				
                <?php if (isset($error)) { echo "<p class='message'>" .$error. "</p>" ;} ?>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Gender<font color="#FF0000">*</font></label></td>
                    <td> <div id="genderRadio">
                    <label class="radiobtn">
                    	<input type="radio" tabindex="4" name="Rdgender" id="Rdgender" value="M" checked="checked" />Male
                    </label>
                    <label class="radiobtn">
                    	<input type="radio" tabindex="5" value="F" name="Rdgender" />Female
                    </label>
                    </div>
                     <br /><span id="gen" class="err_msg">Select gender</span>
                    </td>
                </tr>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Email<font color="#FF0000">*</font></label></td>
                    <td><input type="text" name="email" id="email" onblur="return check_form1()" tabindex="5" style="clear:none;">
                     <br /><span id="mail" class="err_msg">Enter valid mail address</span>
                    
                    </td>
                </tr>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Password<font color="#FF0000">*</font></label></td>
                    <td><input type="password" name="password" onchange="drpProfFor_fun(this.id)" id="password" tabindex="6" style="clear:none;">
                     <br /><span id="pass" class="err_msg">Enter password</span>
                    </td>
                </tr>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Religion<font color="#FF0000">*</font></label></td>
                    <td><?php
						$religion_list = "select * from religions";
						$data = $obj->select($religion_list);
					?>
              <select name="drpReligion" id="drpReligion" onchange="drpProfFor_fun(this.id); change_religion(this.value);" tabindex="7" style="clear:none;">
                        <option value=""> -Select- </option>
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['religion']; ?>"><?php echo $res['religion']; ?></option>
                        <?php } ?>
                    </select>
                     <br /><span id="religion" class="err_msg">Select religion</span>
                    </td>
                </tr>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Caste<font color="#FF0000">*</font></label></td>
                    <td><?php
						$caste_list = "select * from caste"; 
						$data = $obj->select($caste_list);
					?>
                    <div id="caste_drp_div col-md-12">
                    <select name="drpCaste" id="drpCaste" onchange="drpProfFor_fun(this.id)" tabindex="8" style="clear:none;">
                        <option value=""> -Select- </option>
                        <?php /*?><?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['caste']; ?>"><?php echo $res['caste']; ?></option>
                        <?php } ?><?php */?>
                    </select>
                    </div>
                   <br /><span id="cast" class="err_msg">Select caste</span>
                    </td>
                </tr>
                 <?php
						$list = "select * from mother_tongues";
						$data = $obj->select($list);
					?>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Mother Tongue<font color="#FF0000">*</font></label></td>
                    <td><select name="drpMotherlanguage" id="drpMotherlanguage" onchange="drpProfFor_fun(this.id)" tabindex="9" style="clear:none;" />
                        <option value=""> -Select- </option>
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['name']; ?>"><?php echo $res['name']; ?></option>
                        <?php } ?>
                    </select>
                       <br /><span id="mtoungue" class="err_msg">Select mother tongue</span> 
                    </td>
                </tr>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Country Living In<font color="#FF0000">*</font></label></td>
                    <td><?php
						$country_list = "select * from mobile_codes";
						$data = $obj->select($country_list);
					?>
                    <select name="drpCountry" id="drpCountry" onchange="drpProfFor_fun(this.id)" tabindex="10" style="clear:none;"/>
                        <option value="">- Select -</option>
                        <?php foreach($data as $res) { ?>
                        <option value="<?php echo $res['country']; ?>"><?php echo $res['country']; ?></option>
                        <?php } ?>
                    </select>
                    <br /><span id="country" class="err_msg">Select country</span> 
                    
                    </td>
                </tr>
                
                
             <?php /*?>   <tr>
                	<td width="30%"><label style="margin-top:-18px">Annual Income</label></td>
                    <td><div id="drpcurrcodedata" style="float:left;">
                    	<?php
						$select_category2 = "select distinct(curr_code) from mobile_codes where curr_code!=''";
						$db_category2 = $obj->select($select_category2);
						//print_r($db_category2);
						?>
                        <select  id="txtcurr" name="txtcurr" style="width:75px;">
                      
                        <?php foreach($db_category2 as $db) {  ?>
                        	
							<option value="<?php echo $db['id']; ?>"><?php echo $db['curr_code']; ?></option>
                            
<?php } ?>
						</select> 
					</div>
                   
					<!--<input type="text" name="txtcurr" id="txtcurr" maxlength="10" style=" float:left; width:50px; text-align:right;" value="" readonly="readonly" tabindex="14" />-->
					<?php
						$list = "select * from annual_income_master";
						$data = $obj->select($list);
					?>
                    <select name="drpIncome" id="drpIncome" tabindex="11" style="width:207px; margin-left:5px; clear:none;" />
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['annual_income']; ?>"><?php echo $res['annual_income']; ?></option>
                        <?php } ?>
                    </select>
                    
                    <br /><span id="aincome" class="err_msg">Select annual income</span> 
                    </td>
                </tr><?php */?>
                
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Annual Income</label></td>
                    <td><div id="drpcurrcodedata" style="float:left;">
                    	<?php
						$select_category2 = "select distinct(curr_code) from mobile_codes where curr_code!=''";
						$db_category2 = $obj->select($select_category2);
						//print_r($db_category2);
						?>
                        <select  id="txtcurr" name="txtcurr" style="width:75px;">
                      
                        <?php foreach($db_category2 as $db) {  ?>
                        	
							<option value="<?php echo $db['curr_code']; ?>"><?php echo $db['curr_code']; ?></option>
                            
<?php } ?>
						</select> 
					</div>
                   
					<!--<input type="text" name="txtcurr" id="txtcurr" maxlength="10" style=" float:left; width:50px; text-align:right;" value="" readonly="readonly" tabindex="14" />-->
				<input type="text" name="drpIncome" id="drpIncome" style="width:188px; margin-left:5px; clear:none;"  />
                    
                    <br /><span id="aincome" class="err_msg">Enter annual income</span> 
                    </td>
                </tr>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Star</label></td>
                    <td><?php 
						$list = "select * from horoscope_star_master";
						$data = $obj->select($list);
					?>
                    <select name="drpStar" id="drpStar" tabindex="12" style="clear:none;" />
                    <option value="0">Any</option>
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['star']; ?>"><?php echo $res['star']; ?></option>
                        <?php } ?>
                    </select>
                    <br /><span id="star" class="err_msg">Select your star</span> 
                    </td>
                </tr>
                <tr>
                <?php //echo "test".$logged_in_member[0]['mob_code']; ?>
                	<td width="30%"><label style="margin-top:-18px">Mobile Number<font color="#FF0000">*</font></label></td>
                    <td><div id="drpMobcodedata" style="float:left;">
                    	<?php
						$select_category2 = "select * from mobile_codes";
						$db_category2 = $obj->select($select_category2);
						?>
                        <select  id="drpMobcode" name="mob_code" style="width:75px;">
                        <?php foreach($db_category2 as $db) {  ?>
							<option value="<?php echo $db['id']; ?>" <?php if($db['id'] == $logged_in_member[0]['mob_code']){ ?> selected="selected" <?php } ?>}) ?><?php echo $db['mob_code']; ?></option>
                            
<?php } ?>
						</select> 
					</div>
                    <input type="text" name="txtMobNo" id="txtMobNo" maxlength="10" style="width: 170px;margin-left: 5px;clear: none;" onchange="return check_form1()" tabindex="14" />
                    <br /><span id="mnumber" class="err_msg">Enter mobile number</span> 
                    </td>
                </tr>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Occupation</label></td>
                    <td><?php
						$list = "select * from occupation_master";
						$data = $obj->select($list);
					?>
                    <select name="drpOccupation" id="drpOccupation" tabindex="15" style="clear:none;" />
                    <option value=""> Select</option>
                        <?php foreach($data as $res) { ?>
                        	<option value="<?php echo $res['occupation']; ?>"><?php echo $res['occupation']; ?></option>
                        <?php } ?>
                    </select>
                    <br /><span id="occupation" class="err_msg">Select occupation</span> 
                    </td>
                </tr>
                <tr>
                	<td width="30%"><label style="margin-top:-18px">Manglik</label></td>
                    <td><select name="drpManglik" id="drpManglik" tabindex="16" style="clear:none;" />
                    	<option value="Dont Know">Don't know</option>
                    	<option value="Y">Yes</option>
                    	<option value="N">No</option>                        
                    </select>
                    <br /><span id="manglik" class="err_msg">Select one value</span> 
                    </td>
                </tr>
             </table>
         </div>
         <br class="clear" />
                <div class="terms_line">
                <label class="checkbox"><input checked="checked" type="checkbox" id="chk" value="1" /> I agree to the Find My Jodi <a href="privacy_policy.php">Privacy Policy</a> and <a href="terms_conditions.php">Terms and Conditions.</a></label>
                <span id="chkmsg" class="err_msg">Check Terms and condition box</span> 
                <input type="submit" name="submit" />
                </div>
                </form>
		</div>
    </div>
    <div class="sidebarr">
        	<div class="box contact">
                <h2>LIVE Support</h2>
                <p>Customer Service Help line:</p>
                <p>+91 9886355564</p>
                <p>Office Hours 8:00 AM to 6:00 PM (IST)<br /><span>[Sunday Holiday]</span></p>
           	</div>
            <?php
			$select_banner_right = "select * from advertise where adv_position = 'Register Right (280 X 245)' AND status = 'Active'";
			$db_banner_right = $obj->select($select_banner_right);
			if(count($db_banner_right) > 0) 
			{
				if($db_banner_right[0]['banner_file'] != '') 
				{
					if(file_exists('upload/banners/'.$db_banner_right[0]['banner_file'])) {
			?>    
            <div class="box">
            	<a href="<?php echo $db_banner_right[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner_right[0]['banner_file']; ?>" /></a>
            </div>
            <?php } } } ?>
            <div class="box" class="success_story" >
            	<h2>Success Story</h2>
            	<?php 
					$select_success_story="select * from success_member_details where status='Approve' order by id DESC Limit 3"; 
					$db_success_story=$obj->select($select_success_story);
					for($i=0;$i<count($db_success_story);$i++)
					{
				?>
            	<div class="story_box">
                	<div class="story_img"><a href="view_success_story.php?id=<?php echo $db_success_story[$i]['id']; ?>"><img src="upload/<?php echo $db_success_story[$i]['photo']; ?>" /></a></div>
                    <div class="story_text">
                    	<a href="view_success_story.php?id=<?php echo $db_success_story[$i]['id']; ?>"><?php echo ucfirst($db_success_story[$i]['bride_name']); ?></a> | <a href="view_success_story.php?id=<?php echo $db_success_story[$i]['id']; ?>"><?php echo ucfirst($db_success_story[$i]['groom_name']); ?></a>
                        <br />
                        Marriage Date : <?php echo date('d-m-Y',strtotime($db_success_story[$i]['engag_or_marriage_date'])); ?>
                        <br />
                        <?php echo substr($db_success_story[$i]['story'],0,100); ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            
            <div class="box">
            	<img src="images/FB.jpg" />
            </div>
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
		$('#cast').css('visibility','hidden');
	}
	else
	{
		$('#'+id).css('border','1px solid red');
		$('#cast').css('visibility','visible');
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
			  $('#mail').css('visibility','visible');
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
						$('#mail').css('visibility','visible');
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
		var phoneno = /^\d{10}$/;
		if(!val.match(phoneno)){
			
			$('#txtMobNo').css('border','1px solid red');
			error_mobile=1;
		}
		
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
	$('#username').css('border','1px solid #ccc');
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
	$('#drpIncome').css('border','1px solid #ccc');
	var digit11 = /^[0-9]+$/;
	if(document.getElementById('drpIncome').value=='')
	{
		$('#drpIncome').css('border','1px solid red');
		$('#aincome').css('visibility','visible');
		error=1;
	}else if(!drpIncome.value.match(digit11))
	{
		$('#drpIncome').css('border','1px solid red');
		$('#aincome').css('visibility','visible');
		error=1;
	}else
	{
		$('#aincome').css('visibility','hidden');
	}
	if(document.getElementById('drpProfFor').value=='')
	{
		$('#drpProfFor').css('border','1px solid red');
		$('#profile_for').css('visibility','visible');
		error=1;
	}
	else
	{
		$('#profile_for').css('visibility','hidden');
	}
	var letters = /^[a-zA-Z\séåü]+$/;
	var space = " ";
	if(username.value == "")
	{
		$('#username').css('border','1px solid red');
		$('#nm').css('visibility','visible');
		error=1;
	}else if(!username.value.match(letters))
	{
		$('#username').css('border','1px solid red');
		$('#nm').css('visibility','visible');
		error=1;
	}else
	{
		$('#nm').css('visibility','hidden');
	}
	//return true;
	
	if(document.getElementById('genderRadio').value=='undefined')
	{
		$('#genderRadio').css('border','1px solid red');
		$('#gen').css('visibility','visible');
		error=1;
	}
		else
	{
		$('#gen').css('visibility','hidden');
	}
	if(document.getElementById('dob').value=='')
	{
		$('#dob').css('border','1px solid red');
		$('#edob').css('visibility','visible');
		error=1
	}
	else
	{
			$('#edob').css('visibility','hidden');
	}
	
	if(document.getElementById('txtMobNo').value=='')
	{
		$('#txtMobNo').css('border','1px solid red');
		$('#mnumber').css('visibility','visible');	
		error=1
	}
	else
	{
		$('#mnumber').css('visibility','hidden');
	}
	
	if(document.getElementById('drpCountry').value=='')
	{
		$('#drpCountry').css('border','1px solid red');
		$('#country').css('visibility','visible');
		error=1
	}
	else
	{
		$('#country').css('visibility','hidden');
	}
	
	if(document.getElementById('drpReligion').value=='')
	{
		$('#drpReligion').css('border','1px solid red');
		$('#religion').css('visibility','visible');
		error=1
	}
	else
	{
		$('#religion').css('visibility','hidden');
	}
	
	if(document.getElementById('drpCaste').value=='')
	{
		$('#drpCaste').css('border','1px solid red');
		$('#cast').css('visibility','visible');
		error=1
	}
	else
	{
		$('#cast').css('visibility','hidden');
	}
	if(document.getElementById('email').value=='')
	{
		$('#email').css('border','1px solid red');
		$('#mail').css('visibility','visible');
		error=1
	}
	else
	{
		$('#mail').css('visibility','hidden');
	}
	var lnm=document.getElementById('username').value;
	if(document.getElementById('username').value=='' || lnm.length>256)
	{
		$('#username').css('border','1px solid red');
		$('#nm').css('visibility','visible');
		
		error=1
	}
	else
	{
		$('#mail').css('visibility','hidden');
	}
	
	if(document.getElementById('password').value=='')
	{
		$('#password').css('border','1px solid red');
		$('#pass').css('visibility','visible');
		
		error=1
	}
	else
	{
		$('#pass').css('visibility','hidden');
	}
	
	if(document.getElementById('drpMotherlanguage').value=='')
	{
		$('#drpMotherlanguage').css('border','1px solid red');
		$('#mtoungue').css('visibility','visible');
		error=1
	}
	else
	{
		$('#mtoungue').css('visibility','hidden');
	}
	
	if(error_email==1)
	{
		$('#email').css('border','1px solid red');
		$('#mail').css('visibility','visible');
	}
	else
	{
		$('#mail').css('visibility','hidden');
	}
	
	if(error_mobile==1)
	{
		$('#txtMobNo').css('border','1px solid red');
		$('#mnumber').css('visibility','visible');
	}
	else
	{
		$('#mnumber').css('visibility','hidden');
	}
	if(!$("#chk").is(':checked'))
	{	
		$('#chk').css('border','1px solid red');
		$('#chkmsg').css('visibility','visible');
		return false;
	}
	else
	{
		
		$('#chkmsg').css('visibility','hidden');
	}
	$(document).scrollTop(0);
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
					   var aa = data.split('~')
					   $('#drpMobcodedata').html( aa[0] );
					   $('#drpcurrcodedata').html( aa[1] );
					   
					 
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
		$('#drpcurrcodedata').change( function() {
			var val = $('#txtcurr').val();
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
<script>
	$('#drpProfFor').change(function(){
		if($('#drpProfFor').val()!='')
		{
			$('#profile_for').css('visibility','hidden');
		}
	});
	$('#dob').blur(function(){
		if($('#dob').val()!='')
		{
			$('#edob').css('visibility','hidden');
		}
	});
	$('#txtMobNo').blur(function(){
		if($('#txtMobNo').val()!='')
		{
			$('#mnumber').css('visibility','hidden');
		}
	});
	$('#drpCountry').change(function(){
		if($('#drpCountry').val()!='')
		{
			$('#country').css('visibility','hidden');
		}
	});
	
	$('#drpReligion').change(function(){
		if($('#drpReligion').val()!='')
		{
			$('#religion').css('visibility','hidden');
		}
	});
	
	$('#email').blur(function(){
		if($('#email').val()!='')
		{
			$('#mail').css('visibility','hidden');
		}
	});
	
	$('#username').blur(function(){
		if($('#username').val()!='')
		{
			$('#nm').css('visibility','hidden');
		}
	});
	
	$('#password').blur(function(){
		if($('#password').val()!='')
		{
			$('#pass').css('visibility','hidden');
		}
	});
	
	$('#drpMotherlanguage').change(function(){
		if($('#drpMotherlanguage').val()!='')
		{
			$('#mtoungue').css('visibility','hidden');
		}
	});
	$('#drpCaste').change(function(){
		if($('#drpCaste').val()!='')
		{
			$('#cast').css('visibility','hidden');
		}
	});
function validate_num(id)
{
	var e = window.event || event ; // for trans-browser compatibility
	var charCode = e.which || e.keyCode;
	if((charCode > 47 && charCode < 58))
	{
			return true;
	}
		return false; 
 }
/* function validate()
{
		var e = window.event || event ; // for trans-browser compatibility
		var charCode = e.which || e.keyCode;
		
		
if((charCode > 65 && charCode < 122 && charCode!=91 && charCode!=92 && charCode!=93 && charCode!=94 && charCode!=95 && charCode!=96) || (charCode==32))
		{
			return true;
		}
		return false;
 }*/
</script>
<style>
.test
{
	border:1px solid red;
	padding-top:20px;
	height:5px;
}
</style>
	