<?php
session_start();
if(isset($_SESSION['cap_admin'])){
	
define('DIR_APP', str_replace('\'', '/', realpath(dirname(__FILE__))) . '/');
define('DIR_SMOOTH_CHAT', str_replace('\'', '/', realpath(DIR_APP . '../')) . '/');
if(isset($_GET['w'])){
	$where=$_GET['w'];
}else{
	$where='';
}
	switch($where){
		case'account-settings':
			if(isset($_POST['saveCap'])){
				require_once('../include/vars.php');
				require_once('../include/config.php');
				require_once('../include/db.class.php');
				$un=$db->cleanInput('p','un',1);
				$up=$db->cleanInput('p','up',1);
				if(empty($up) && !empty($un)){
					$query="UPDATE `$srcDB`.`capu` set `username`='$un'";
				}else if(!empty($up) && !empty($un)){
					$query="UPDATE `$srcDB`.`capu` set `username`='$un',`passwd`='".sha1($up)."'";
				}
				$res=$db->query($query);
				if($res){
					$_SESSION['cap_admin']=$un;
					$msg='<span class="sac_done"><b>Your info has been updated</b></span>';
				}else{$msg='<span class="sac_error"><b>Your info could not be updated</b></span>';}
			}
			$content='
			<div id="container">
				<script type="text/javascript" charset="utf-8">
					$(function(){
						$("input[type=text]").addClass("txt");
						$("input[type=password]").addClass("txt");
					})
				</script>
				<a id="title" href="#">Account settings</a>
				<div class="outer">
					<div class="inner">
					 	<div id="subCtr">
							<div class="content" id="chatConf">
							'.@$msg.'
							<form method="post" action="index.php?w=account-settings">
								<label for="un">Username</label><br />
								<input type="text" name="un" size="40"><br />
							<label for="up">Password</label><br />
								<input type="password" name="up" size="40">
								<span class="info"><p>Keep it empty if you want to keep your oldpassword</span>
								<input type="submit" name="saveCap" class="button" value="save"/>
							</form><a href="index.php">Go back</a>
							</div>
						</div>
					</div>
				</div>
			</div>';
		break;
		
		case'chat-config':
		if(isset($_POST['save'])){
			$delay=(int)trim($_POST['delay']);
			$gDelay=(int)trim($_POST['gDelay']);
			$userRefresh=(int)trim($_POST['userRefresh']);
			$updateTimeFreq=(int)trim($_POST['updateTimeFreq']);
			$controleFreq=(int)trim($_POST['controleFreq']);
			$replay=(int)trim($_POST['replay']);
			$newMessage=(string)trim($_POST['newMessage']);
			$blinkTimes=(int)trim($_POST['blinkTimes']);
			$delUsers=(int)trim($_POST['delUsers']);
			$delMsgs=(int)trim($_POST['delMsgs']);
			$avatar=trim($_POST['avatar']);
			$trans=trim($_POST['trans']);
			$typing=trim($_POST['typing']);
			$mLink=(string)trim($_POST['mLink']);
			$rLink=(string)trim($_POST['rLink']);
			switch($avatar){
				case'on':
				$avatar='on';
				break;
				case'off':
				default:
				$avatar='off';
				break;
			}
			// var.js
			$jsOutput  = 'var Vars={'."\n";
			$jsOutput .= 'delay:'.$delay.',';
			$jsOutput .= 'gDelay:'.$gDelay.',';			
			$jsOutput .= 'userRefresh:'.$userRefresh.',';
			$jsOutput .= 'updateTimeFreq:'.$updateTimeFreq.',';
			$jsOutput .= 'controleFreq:'.$controleFreq.',';
			$jsOutput .= 'replay:'.$replay.',';
			$jsOutput .= 'newMessage:\''.$newMessage.'\',';
			$jsOutput .= 'g:\''.$avatar.'\',';
			$jsOutput .= 'ty:\''.$typing.'\',';
			$jsOutput .= 'tr:\''.$trans.'\',';
			$jsOutput .= 'm:\''.$mLink.'\',';
			$jsOutput .= 'r:\''.$rLink.'\',';
			$jsOutput .= 'blinkTimes:'.$blinkTimes.',';
			$jsOutput .= 'delUsers:'.$delUsers.",";
			$jsOutput .= 'delMsgs:'.$delMsgs."\n";
			$jsOutput .= '};';		
			
			//vars.php
			$delay=$delay/1000;
			$gDelay=$gDelay/1000;

			$output  = '<?php' . "\n";
			$output .= '  ///////////////////////////////////////' . "\n";
			$output .= ' // Change those to suite your needs ///' . "\n";
			$output .= '///////////////////////////////////////' . "\n\n";

			$output .= '$gravatar=\''.$avatar.'\'; // gravatar support ( on | off )' . "\n";
			$output .= '$translateServ=\''.$trans.'\'; // translation feature ( 1 | 0 )' . "\n";
			$output .= '$typingServ=\''.$typing.'\'; // typing indicator feature ( 1 | 0 )' . "\n";
			$output .= ' $meImg=\''.$mLink.'\'; // if the gravatar is off define the link of the default avatar to use to urself (avatar should be 20*20px)' . "\n";
			$output .= '$senderImg=\''.$rLink.'\'; // if the gravatar is off define the link of the default avatar to use to the one who you talk with (avatar should be 20*20px)'."\n";
			$output .= '$tzOffset=0; //(hours) GMT the default timeZone in the chat messages (8 => GMT+8 /  -6 => GMT-6)' . "\n\n";
			
			$output .= '  ////////////////////////////////////////////' . "\n";
			$output .= ' /// the following are the default values ///' . "\n";
			$output .= '////////////////////////////////////////////' . "\n\n";
			
			$output .= '$retryAfter='.$delay.';// the periode (seconds) to check for new messages recieved from whom you are chatting with' . "\n";
			$output .= ' $globalRetry='.$gDelay.';// the period to check for new messages from whom you aren\'t chatting with' . "\n";
			$output .= ' $delUsers='.$delUsers.';// the period to delete a user if he shows no response' . "\n";
			$output .= ' $delMsgs='.$delMsgs.';// the period to delete chat history ' . "\n";
			$output .= '$sessionVar=\'chatUser\'; // the name of the session variable that stores the temporary id or name of the user when  (s)he tries to login'."\n";
			$output .= ' date_default_timezone_set(\'UTC\'); //set the default time zone to GMT, for more timezones check out http://www.php.net/timezones' . "\n\n";
			$output .= '?>';
			
			$file = fopen(DIR_SMOOTH_CHAT . 'js/vars.js', 'w');
			if($file){
				fwrite($file, $jsOutput);
				fclose($file);
				$file = fopen(DIR_SMOOTH_CHAT . 'include/vars.php', 'w');
				if($file){
				fwrite($file, $output);
				fclose($file);
				}
				$message='<span class="sac_done"><b>Your changes have been saved</b></span>';
			}else{$message='<span class="sac_error"><b>An error has occured while trying to save the changes</b></span>';}
		}
		
		$file = fopen(DIR_SMOOTH_CHAT . 'js/vars.js', 'r');
		$d='';
		if($file){
			while (!feof($file)){
			$d.= fgets($file);
			}
		}
		$replaced=array('delay:',',gDelay:',',userRefresh:',',updateTimeFreq:',',controleFreq:',',replay:',',newMessage:\'','\',g:\'','\',tr:\'','\',ty:\'','\',m:\'','\',r:\'','\',blinkTimes:',',delUsers:',',delMsgs:');
		$replaced2=array('var Vars={','};');
		$d=str_replace($replaced2,'',$d);
		$d=str_replace($replaced,'_@!',$d);
		$d=explode('_@!',$d);
		 switch($d[8]){
        	case'on':
        	$avatarCheck='
        	<label><input type="radio" name="avatar" id="gOn" checked="checked" value="on"> On </label> 
        	<label><input type="radio" name="avatar" id="gOff" value="off"> Off </label>';
        	break;
        	case'off':
        	default:
        	$avatarCheck='<input type="radio" name="avatar" id="gOn" value="on">On 
        		 <input type="radio" name="avatar" id="gOff" checked="checked" value="off">Off';
        	break;
        }
        switch($d[10]){
        	case'1':
        	$trans='
        	<label><input type="radio" name="trans" id="trOn" checked="checked" value="1"> On </label> 
        	<label><input type="radio" name="trans" id="trOff" value="0"> Off </label>';
        	break;
        	case'0':
        	default:
        	$trans='<input type="radio" name="trans" id="trOn" value="1">On 
        		 <input type="radio" name="trans" id="trOff" checked="checked" value="0">Off';
        	break;
        }
        
        switch($d[9]){
        	case'1':
        	$typing='
        	<label><input type="radio" name="typing" id="tyOn" checked="checked" value="1"> On </label> 
        	<label><input type="radio" name="typing" id="tyOff" value="0"> Off </label>';
        	break;
        	case'0':
        	default:
        	$typing='<input type="radio" name="typing" id="tyOn" value="1">On 
        		 <input type="radio" name="typing" id="tyOff" checked="checked" value="0">Off';
        	break;
        }

			$content='
			<div id="container">
			<script type="text/javascript" charset="utf-8">
				$(function(){
					$("tr:odd").addClass("odd");
					$("tr:even").addClass("even");
					$("input[type=text]").addClass("txt");
				})
			</script>
				<a id="title" href="#">Chat configuration</a>
				<div class="outer">
					<div class="inner">
					 	<div id="subCtr">
							<div class="content" id="chatConf">
								'.@$message.'
									<br />1 seconde = 1000 Ms.
								<form action="index.php?w=chat-config" method="post" accept-charset="utf-8">
									<table>
										
										<tr>
											<td width="500"><label for="delay">Chat messages Refresh frequency within a given tab</label>:</td>
											<td><input type="text" name="delay" value="'.$d[1].'" /><abbr title="Milliseconds">Ms</abbr></td>
										</tr>
										<tr>
											<td><label for="gDelay">The frequency to Check for new messages that are sent from a new guy </label>:</td>
											<td><input type="text" name="gDelay" value="'.$d[2].'" /><abbr title="Milliseconds">Ms</abbr></td>
										</tr>
										<tr>
											<td><label for="userRefresh">The refresh rate of getting users</label>:</td>
											<td><input type="text" name="userRefresh" value="'.$d[3].'" /><abbr title="Milliseconds">Ms</abbr></td>
										</tr>
										<tr>
											<td><label for="updateTimeFreq">The periode to update the chat messages time</label>:</td>
											<td><input type="text" name="updateTimeFreq" value="'.$d[4].'" /><abbr title="Milliseconds">Ms</abbr></td>
										</tr>
										<tr>
											<td><label for="controleFreq">The frequency to controle the online statue if it has been changed</label>:</td>
											<td><input type="text" name="controleFreq" value="'.$d[5].'" /><abbr title="Milliseconds">Ms</abbr></td>
										</tr>
										<tr>
											<td><label for="replay">The times that the title will blink when you recieve a new message</label>:</td>
											<td><input type="text" name="replay" value="'.$d[6].'" /></td>
										</tr>
										<tr>
											<td><label for="newMessage">The title that will blink when you recieve a new message</label>:</td>
											<td><input type="text" name="newMessage" value="'.$d[7].'" /></td>
										</tr>
										<tr>
											<td><label for="blinkTimes">The times that a chat tab will blink if it recieves a new message</label>:</td>
											<td><input type="text" name="blinkTimes" value="'.$d[13].'" /></td>
										<tr>
										<tr>
											<td><label for="delUsers">The periode that a user will be considered away if his browser don\'t respond for</label>: </td>
											<td><input type="text" name="delUsers" value="'.@$d[14].'" /><abbr title="Seconds">Sec</abbr></td>
										<tr>
										<tr>
											<td><label for="delMsgs"></label>Delete user\'s chat history after </td>
											<td><input type="text" name="delMsgs" value="'.@$d[15].'" /><abbr title="Hours">Hr</abbr></td>
										<tr>
											<td><label for="avatar">Gravatar support :</label></td>
										<td> '. $avatarCheck.'</td>
										</tr>
										<tr class="imgLinks">
											<td><label for="mLink">Your avatar link</label>:<br />(Keep empty if gravatar is on)</td>
											<td><input type="text" name="mLink" value="'.$d[11].'" /></td><br />
										</tr>
										<tr class="imgLinks">
											<td><label for="rLink">The reciever avatar link</label>:<br />(Keep empty if gravatar is on)</td>
											<td><input type="text" name="rLink" value="'.$d[12].'" /></td>
										</tr>
										<tr>
											<td><label for="trans">Translation feature:</label></td>
										<td> '. $trans.'</td>
										</tr>
										<tr>
											<td><label for="typing">Typing indicator :</label></td>
										<td> '. $typing.'</td>
										</tr>

									</table>
									<p><input type="submit" class="button" name="save" value="Save"></p>
								</form> <a href="index.php">Go back</a>
							</div>
						</div>
					</div>
				</div>
			</div>';
		break;
		default:
		$content='
		<div id="container">
			<a id="title" href="index.php">Admin Panel</a>
			<div class="outer">
				<div class="inner">
				 	<div id="subCtr">
				 		<form action="logout.php" method="post" id="adminLogout" accept-charset="utf-8">
							Welcome, <b>'.$_SESSION["cap_admin"].'</b>! <input type="submit" id="logout" name="logout" value="Logout">
						</form>
					 	<div class="content">
							<a class="adBtn" href="index.php?w=chat-config"><img src="../img/settings.png" />Configuration</a>
							<a class="adBtn" href="index.php?w=account-settings"><img src="../img/lock.png" />My Account</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		';
		break;
	}

}else{
		$content='
		<div id="container">
			<a id="title" href="index.php">Admin Login</a>
			<div class="outer">
				<div class="inner">
				 	<div id="subCtr">
					<form method="post" action="login.php">
				 		<input type="text" name="un" id="userNm" />
						<input type="password" id="userPW" name="up" />
						<input type="submit" name="login" class="button" id="login" value="Login" class="input_field submit"/>
					</form>
					</div>
				</div>
			</div>
		</div>
		';
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smooth Ajax Chat Admin Area</title>
<link rel="stylesheet" type="text/css" href="../css/cap.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
</head>
<body>
<div id="capContent">
		<?php echo $content; ?>
</div>
</body>
</html>