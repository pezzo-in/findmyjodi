
<?php
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
		$dob = explode("-",$_POST['dob']);
		
		$today = date('Y-m-d');//new DateTime();
		$birthdate = $dob[2]."-".$dob[1]."-".$dob[0];//date('Y-m-d',strtotime($_POST['dob']));
		$interval = date('Y') - date('Y',strtotime($birthdate));
		
		//$interval = $today->diff($birthdate);
		$age = $interval;//$interval->format('%y');
		$one_time_pass=redemption_code();

$insert="INSERT into members(id, profile_for, name, gender, date_of_birth,age, religion,mother_tongue , caste, country, mob_code, mobile_no, email_id, password, status, reg_date,day, month,year, one_time_pass, annual_income, star, occupation, manglik_dosham)values (NULL, '".$_POST['drpProfFor']."', '".$_POST['username']."', '".$_POST['Rdgender']."', '".$birthdate."', '".$age."', '".$_POST['drpReligion']."', '".$_POST['drpMotherlanguage']."', '".$_POST['drpCaste']."', '".$_POST['drpCountry']."', '".$_POST['mob_code']."', '".$_POST['txtMobNo']."', '".$_POST['email']."', '".md5($_POST['password'])."', 'Deactive', '".date('Y-m-d')."', '".date('d')."', '".date('m')."', '".date('Y')."', '".$one_time_pass."', '".$_POST['drpIncome']."', '".$_POST['drpStar']."', '".$_POST['drpOccupation']."', '".$_POST['drpManglik']."')";

		$db_ins=$obj->insert($insert);

		$inserted_id =  mysql_insert_id();
	if(strlen($inserted_id) == "1")
	{
		$mem_id = "FMJ0000".$inserted_id;
	}
	elseif(strlen($inserted_id) == "2")
	{
		$mem_id = "FMJ000".$inserted_id;
	}
	elseif(strlen($inserted_id) == "3")
	{
		$mem_id = "FMJ00".$inserted_id;
	}
	elseif(strlen($inserted_id) == "4")
	{
		$mem_id = "FMJ0".$inserted_id;
	}
	elseif(strlen($inserted_id) == "5")
	{
		$mem_id = "FMJ".$inserted_id;
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
	///// Sms gateway integration - Krupa ///

	$mobileno = $_REQUEST['mob_code'].$_REQUEST['txtMobNo'];
	$mobileno = substr($mobileno,1);

	$ch = curl_init('http://www.txtguru.in/imobile/api.php?');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "username=findmyjoditrans&password=Ganesha@1985&source=senderid&dmobile=$mobileno&message=Thank you for registering with our site. Use Following code for activating your account.  $rand ");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$data = curl_exec($ch);
	////////////////////////////////////////////////////
	/*$url = 'http://203.124.105.204/smsapi/pushsms.aspx';
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
	curl_close($ch);*/

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
    <div class="mid col-md-12">
 		<div class="cont_left col-md-8">
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
     		<h2>Create an account</h2>
    <form id="formID" class="form-horizontal" method="post" onsubmit="return check_form()">
        <div class="new_acc">
            <div class="col-md-4"><label">Profile created for<font color="#FF0000">*</font></label></div>
            <div class="col-md-8"><select id="drpProfFor" name="drpProfFor" onchange="drpProfFor_fun(this.id)" tabindex="1" style="clear:none;" >
                <option value="">-Select-</option>
                <option value="Myself">Myself</option>
                <option value="Son">Son</option>
                <option value="Daughter">Daughter</option>
                <option value="Brother">Brother</option>
                <option value="Sister">Sister</option>
                <option value="Relative">Relative</option>
                <option value="Friend">Friend</option>
            </select><span id="profile_for" class="err_msg">Select for whom this profile is for</span></div>
            <div class="col-md-4"><label">Name<font color="#FF0000">*</font></label></div>
            <div class="col-md-8"><input type="text" name="username" id="username" onkeypress="return onlyAlphabets(event,this);" tabindex="2" style="clear:none;">
                <span id="nm" class="err_msg">Enter valid name</span></div>
            <div class="col-md-4"><label">Date of Birth<font color="#FF0000">*</font></label></div>
            <div class="col-md-8"><input type="text" id="dob" tabindex="3" name="dob" onchange="drpProfFor_fun(this.id)"  style="clear:none;" />
                <span id="edob" class="err_msg">Enter date of birth</span></div>
            <?php if (isset($error)) { echo "<p class='message'>" .$error. "</p>" ;} ?>
            <div class="col-md-4"><label">Gender<font color="#FF0000">*</font></label></div>
            <div class="col-md-8"><div id="genderRadio">
                <label class="radiobtn">
                    <input type="radio" tabindex="4" name="Rdgender" id="Rdgenderm" value="M" checked="checked" />Male
                </label>
                <label class="radiobtn">
                    <input type="radio" tabindex="4" value="F" name="Rdgender" id="Rdgenderf"/>Female
                </label>
            </div>
                <span id="gen" class="err_msg">Select gender</span></div>
            <div class="col-md-4"><label">Email<font color="#FF0000">*</font></label></div>
            <div class="col-md-8"><input type="text" name="email" id="email" onblur="return check_form1()" tabindex="5" style="clear:none;">
                <span id="mail" class="err_msg">Enter valid mail address</span></div>
            <div class="col-md-4"><label">Password<font color="#FF0000">*</font></label></div>
            <div class="col-md-8"><input type="password" name="password" onchange="drpProfFor_fun(this.id)" id="password" tabindex="6" style="clear:none;">
                <span id="pass" class="err_msg">Enter password</span></div>
            <div class="col-md-4"><label">Religion<font color="#FF0000">*</font></label></div>
            <div class="col-md-8"><?php
                            $religion_list = "select * from religions";
                            $data = $obj->select($religion_list);
                ?>
                <select name="drpReligion" id="drpReligion" onchange="drpProfFor_fun(this.id); change_religion(this.value);" tabindex="7" style="clear:none;">
                    <option value=""> -Select- </option>
                    <?php foreach($data as $res) { ?>
                    <option value="<?php echo $res['religion']; ?>"><?php echo $res['religion']; ?></option>
                    <?php } ?>
                </select>
                <span id="religion" class="err_msg">Select religion</span></div>
            <div class="col-md-4"><label">Caste<font color="#FF0000">*</font></label></div>
            <div class="col-md-8"><?php
                            $caste_list = "select * from caste";
                            $data = $obj->select($caste_list);
                ?>
                <div id="caste_drp_div">
                    <select name="drpCaste" id="drpCaste" onchange="drpProfFor_fun(this.id)" tabindex="8" style="clear:none;">
                        <option value=""> -Select- </option>
                    </select>
                </div>
                <span id="cast" class="err_msg">Select caste</span></div>
            <?php
                            $list = "select * from mother_tongues";
                            $data = $obj->select($list);
            ?>
            <div class="col-md-4"><label">Mother Tongue<font color="#FF0000">*</font></label></div>
            <div class="col-md-8"><select name="drpMotherlanguage" id="drpMotherlanguage" onchange="drpProfFor_fun(this.id)" tabindex="9" style="clear:none;" />
                <option value=""> -Select- </option>
                <?php foreach($data as $res) { ?>
                <option value="<?php echo $res['name']; ?>"><?php echo $res['name']; ?></option>
                <?php } ?>
                </select>
                <span id="mtoungue" class="err_msg">Select mother tongue</span></div>
            <div class="col-md-4"><label">Country Living In<font color="#FF0000">*</font></label></div>
            <div class="col-md-8"><?php
                            $country_list = "select * from mobile_codes";
                            $data = $obj->select($country_list);
                ?>
                <select name="drpCountry" id="drpCountry" onchange="drpProfFor_fun(this.id)" tabindex="10" style="clear:none;"/>
                <option value="">- Select -</option>
                <?php foreach($data as $res) { ?>
                <option value="<?php echo $res['country']; ?>"><?php echo $res['country']; ?></option>
                <?php } ?>
                </select>
                <span id="country" class="err_msg">Select country</span></div>
            <div class="col-md-4"><label">Annual Income</label></div>
            <div class="col-md-8"><div id="drpcurrcodedata" style="float:left;">
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

                <span id="aincome" class="err_msg">Enter annual income</span></div>
            <div class="col-md-4"><label">Star</label></div>
            <div class="col-md-8"><?php
                            $list = "select * from horoscope_star_master";
                            $data = $obj->select($list);
                ?>
                <select name="drpStar" id="drpStar" tabindex="12" style="clear:none;" />
                <option value="0">Any</option>
                <?php foreach($data as $res) { ?>
                <option value="<?php echo $res['star']; ?>"><?php echo $res['star']; ?></option>
                <?php } ?>
                </select>
                <span id="star" class="err_msg">Select your star</span></div>
            <?php //echo "test".$logged_in_member[0]['mob_code']; ?>
            <div class="col-md-4"><label">Mobile Number<font color="#FF0000">*</font></label></div>
            <div class="col-md-8"><div id="drpMobcodedata" style="float:left;">
                <?php
                            $select_category2 = "select * from mobile_codes";
                            $db_category2 = $obj->select($select_category2);
                ?>
                <select  id="drpMobcode" name="mob_code" style="width:75px;">
                    <?php foreach($db_category2 as $db) {  ?>
                    <option value="<?php echo $db['mob_code']; ?>" <?php if($db['mob_code'] == $logged_in_member[0]['mob_code']){ ?> selected="selected" <?php } ?>><?php echo $db['mob_code']; ?></option>

                    <?php } ?>
                </select>
            </div>
                <input type="text" name="txtMobNo" id="txtMobNo" maxlength="10" style="width: 170px;margin-left: 5px;clear: none;" onchange="return check_form1()" onkeypress="return isNumber(event)" tabindex="14" />
                <span id="mnumber" class="err_msg">Enter mobile number</span></div>
            <div class="col-md-4"><label">Occupation</label></div>
            <div class="col-md-8"><?php
                            $list = "select * from occupation_master";
                            $data = $obj->select($list);
                ?>
                <select name="drpOccupation" id="drpOccupation" tabindex="15" style="clear:none;" />
                <option value=""> Any</option>
                <?php foreach($data as $res) { ?>
                <option value="<?php echo $res['occupation']; ?>"><?php echo $res['occupation']; ?></option>
                <?php } ?>
                </select>
                <span id="occupation" class="err_msg">Select occupation</span></div>
            <div class="col-md-4"><label">Manglik</label></div>
            <div class="col-md-8"><select name="drpManglik" id="drpManglik" tabindex="16" style="clear:none;" />
                <option value="Dont Know">Don't know</option>
                <option value="Y">Yes</option>
                <option value="N">No</option>
                </select>
                <span id="manglik" class="err_msg">Select one value</span></div>
                <br class="clear" />
                    <div class="terms_line">
                    <label class="checkbox"><input checked="checked" tabindex="17" type="checkbox" id="chk" value="1" /> I agree to the Find My Jodi <a href="privacy_policy.php">Privacy Policy</a> and <a href="terms_conditions.php">Terms and Conditions.</a></label>
                    <span id="chkmsg" class="err_msg">Check Terms and condition box</span>
                    <input type="submit" name="submit" onclick="return validate()" value="Register" class="btn btn-info" tabindex="18"/>
                    </div>
		</div>
    </form>

        </div>
    <div class="sidebarr col-md-4">
        	<div class="box contact">
                <h2>LIVE Support</h2>
                <p>Customer Service Help line:</p>
                <p>+91 9886355564</p>
                <p>Office Hours 8:00 AM to 6:00 PM (IST)<span>[Sunday Holiday]</span></p>
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
            	<div class="fb-like-box" data-href="https://www.facebook.com/findmyjodi?ref=hl" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
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
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function onlyAlphabets(e, t) {
            if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
				}
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode==32) || (charCode==8) || (charCode==16) || (charCode==16) || (charCode==0) || (charCode==39))
                    return true;
                else
                    return false;
            }

function validate() {

	var age_date = $('#dob').val();
	var date = age_date.split('-');
	var this_year = new Date().getFullYear()
	if($('#Rdgenderm').is(":checked"))
	{
		if((parseInt(this_year-date[2]))<21)
		{
			alert("Age should be 21 years");return false;
		}
	}
	else if($('#Rdgenderf').is(":checked"))
	 {
		if((parseInt(this_year-date[2]))<18)
		{
			alert("Age should be 18 years");return false;
		}
	}
}
</script>
<style>
.test
{
	border:1px solid red;
	padding-top:20px;
	height:5px;
}
</style>
	