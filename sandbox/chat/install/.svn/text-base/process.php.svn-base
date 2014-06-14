<?php
define('DIR_APP', str_replace('\'', '/', realpath(dirname(__FILE__))) . '/');
define('DIR_SMOOTH_CHAT', str_replace('\'', '/', realpath(DIR_APP . '../')) . '/');
$error=array();
$mode=$_POST['mode'];

$host=$_POST['db_host'];
$db_name=$_POST['db_name'];
$db_pass=$_POST['db_password'];
$db_pref=$_POST['db_prefix'];
$db_user=$_POST['db_user'];
$vars=$mode.'*_@#/'.$host.'*_@#/'.$db_user.'*_@#/'.$db_pass.'*_@#/'.$db_name.'*_@#/'.$db_pref;
	if (!$host) {
		$error['db_host'] = 'Host required !';
	}
	if (!$db_user) {
		$error['db_user'] = 'User required !';
	}
	if (!$db_name) {
		$error['db_name'] = 'Database Name required !';
	}
	if (!$connection = @mysql_connect($host, $db_user, $db_pass)) {
		$error['warning'] = 'Error: Could not connect to the database please make sure the database host  <b>[ '.$host.' ]</b> , username <b>[ '.$db_user.' ] </b>  and password  <b>[ '.$db_pass.' ] </b>  are correct !';
	} else {
		/*if (!@mysql_select_db($db_name, $connection)) {
			$error['warning'] = 'Error: Database does not exist!';
		}*/
		mysql_close($connection);
	}
	if (!is_writable(DIR_SMOOTH_CHAT . 'include/vars.php')) {
		$error['warning'] = 'Error: Could not write to vars.php please check you have set the correct permissions on: ' .DIR_SMOOTH_CHAT . 'include/vars.php !';
		}
$def=1;

if($mode=='b'){
	$def=0;
	$db_users=$_POST['db_users'];
	$table_user=$_POST['table_user'];
	$user_status=$_POST['user_status'];
	$user_id=$_POST['user_id'];
	$user_nick=$_POST['user_nick'];
	$user_email=$_POST['user_email'];
	
	$vars.='*_@#/'.$db_users.'*_@#/'.$table_user.'*_@#/'.$user_status.'*_@#/'.$user_id.'*_@#/'.$user_nick.'*_@#/'.$user_email;

	if (!$db_users) {
		$error['db_users'] = 'The name of the database that contains the users is required !';
	}
	if (!$table_user) {
		$error['table_user'] = 'The name of the table that contains the users is required !';
	}
	if (!$user_status) {
		$error['user_status'] = 'The user\'s status column name is required !';
	}
	if (!$user_nick) {
		$error['user_nick'] = 'The user\'s nickname column name is required !';
	}
	if (!$user_email) {
		$error['user_email'] = 'The user\'s email column name is required !';
	}
}
	$errors=count($error);
	if($errors!=0){
		die(print_r($error).'@>#__!'.$vars);
	}
	setcookie("vars",$vars, time()+300);
	
if(empty($db_users) || !isset($db_users)){
	$db_users=$db_name;
	 $table_user='chat_users';
	 $user_status='status'; 
	 $user_id='id';
	 $user_nick='name'; 
	 $user_email='email';
}

$output  = '<?php' . "\n";
$output .= '// the variables needed for the chat //' . "\n";
$output .= 'defined(\'USER\') ?null:define(\'USER\',\''.$db_user.'\');' . "\n";
$output .= 'defined(\'PASS\') ?null:define(\'PASS\',\''.$db_pass.'\');' . "\n";			
$output .= 'defined(\'DB\') ?null:define(\'DB\',\''.$db_name.'\');' . "\n";
$output .= 'defined(\'HOST\') ?null:define(\'HOST\',\''.$host.'\');' . "\n";
$output .= 'defined(\'PREF\') ?null:define(\'PREF\',\''.$db_pref.'\');' . "\n\n";

$output .= '  //////////////////////////////////////////////////////////////////////////////////////////////' . "\n";
$output .= ' /// don\'t change the following unless you are not using the default authentication system ///' . "\n";
$output .= '/////////////////////////////////////////////////////////////////////////////////////////////' . "\n\n";

$output .= ' $useDefaultAuth='.$def.'; // use the default authentication system (1: yes / 0: no)' . "\n";
$output .= ' $srcDB=\''.$db_users.'\'; // the database that contains your web site users' . "\n";
$output .= ' $usersTable4setup=\''.$table_user.'\'; // the table that contain the users which is used to the DB setup' . "\n";
$output .= ' $usersTable=PREF.\''.$table_user.'\'; // the table that contain the users' . "\n";
$output .= '$statueColomn=\''.$user_status.'\'; // the name of the colomn that stores the user\'s chat statue ( if you dont have this in your existing user table install_B.php will create this for you , so just give it a name)'."\n";
$output .= ' $userIdColomn=\''.$user_id.'\'; // the colomn name of the user\'s id ' . "\n";
$output .= ' $nameColomn=\''.$user_nick.'\'; // the colomn name of the user\'s nickname' . "\n";
$output .= '  $emailColomn=\''.$user_email.'\';// the colomn name of the user\'s email' . "\n\n";

$output .= '  ///////////////////////////////////////////////////////////////////////////' . "\n";
$output .= ' /// Don\'t change this value unless this colomn was changed from the db ///' . "\n";
$output .= '///////////////////////////////////////////////////////////////////////////' . "\n\n";

$output .= '  $chatTable=PREF.\'chat_data\'; // the table where the chat messages are stored' . "\n";

$output .= '?>';				
		
$file = fopen(DIR_SMOOTH_CHAT . 'include/config.php', 'w');
if($file){
	fwrite($file, $output);
	fclose($file);
	$output  = '<?php' . "\n";
	$output .= '  ///////////////////////////////////////' . "\n";
	$output .= ' // Change those to suite your needs ///' . "\n";
	$output .= '///////////////////////////////////////' . "\n\n";
	
	$output .= '$gravatar=\'on\'; // gravatar support ( on | off )' . "\n";
	$output .= '$translateServ=\'0\'; // translation feature ( 1 | 0 )' . "\n";
	$output .= '$typingServ=\'1\'; // typing indicator feature ( 1 | 0 )' . "\n";
	$output .= ' $meImg=\'\'; // if the gravatar is off define the link of the default avatar to use to urself (avatar should be 20*20px)' . "\n";
	$output .= '$senderImg=\'\'; // if the gravatar is off define the link of the default avatar to use to the one who you talk with (avatar should be 20*20px)'."\n";
	$output .= '$tzOffset=0; //(hours) GMT the default timeZone in the chat messages (8 => GMT+8 /  -6 => GMT-6)' . "\n\n";
	
	$output .= '  ////////////////////////////////////////////' . "\n";
	$output .= ' /// the following are the default values ///' . "\n";
	$output .= '////////////////////////////////////////////' . "\n\n";
	
	$output .= '$retryAfter=3;// the periode (seconds) to check for new messages recieved from whom you are chatting with' . "\n";
	$output .= ' $globalRetry=5;// the periode to check for new messages from whom you aren\'t chatting with' . "\n";
	 
 
 	$output .= ' $delUsers=15 ;// the period to delete a user if he shows no response (mode A only)' . "\n";
	$output .= ' $delMsgs=72;// the period to delete chat history (hours) ' . "\n";
	$output .= '$sessionVar=\'chatUser\'; // the name of the session variable that stores the temporary id or name of the user when  (s)he tries to login'."\n";
	$output .= ' date_default_timezone_set(\'UTC\'); //set the default time zone to GMT, for more timezones check out http://www.php.net/timezones' . "\n\n";
	
	$output .= '?>';
	$file = fopen(DIR_SMOOTH_CHAT . 'include/vars.php', 'w');
	if($file){
		fwrite($file, $output);
		fclose($file);
			$jsOutput  = 'var Vars={'."\n";
			$jsOutput .= 'delay:3000,';
			$jsOutput .= 'gDelay:5000,';			
			$jsOutput .= 'userRefresh:8000,';
			$jsOutput .= 'updateTimeFreq:30000,';
			$jsOutput .= 'controleFreq:12000,';
			$jsOutput .= 'replay:4,';
			$jsOutput .= 'newMessage:\'New Message !\',';
			$jsOutput .= 'g:\'on\',';
			$jsOutput .= 'ty:\'1\',';
			$jsOutput .= 'tr:\'0\',';
			$jsOutput .= 'm:\'\',';
			$jsOutput .= 'r:\'\',';
			$jsOutput .= 'blinkTimes:4,';
			$jsOutput .= 'delUsers:15,';
			$jsOutput .= 'delMsgs:72'."\n";
			$jsOutput .= '};';		
		$file = fopen(DIR_SMOOTH_CHAT . 'js/vars.js', 'w');
			if($file){
			fwrite($file, $jsOutput);
			fclose($file);
			switch($mode){
				case'a':
					require_once('../install_A.php');
				break;
				case'b':
					require_once('../install_B.php');
				break;
			}
		}
	}
}
?>