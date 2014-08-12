<?php
@session_start();
require_once('vars.php');
require_once('config.php');
require_once('db.class.php');
require_once('lib/myclass.php');

if(!$useDefaultAuth){
	$usersTable=$usersTable4setup;
}

//------------------ the chat class -------------------------//
class Chat {

public $gravatar;  		// the user gravatar
public $meImg;     		// my avatar ( in case the gravatar is off )
public $msg;       		// the chat message
public $ref;       		// the referrence of the chat tab
public $tzOffset;  		// the time zone offset
public $lastChatter; 	// the last one who sent a message in a conversation
public $is_oldCheck;  	// is it first time we check for messages in this chat tab
public $typing;			// boolean var , if i'm typing
private $me;       		// my chat user name
private $email;    		// my email (hashed)
private $id;       		// my user ID
private $imgSrc;   		// the image source
private $msg4DbClean; 	// cleaned chat message to be stored in the DB
private $msgDate;     	// the DB date & time of a message
private $sDate;       	// the date to be printed beside each chat message ( i.e : 3mins ago ... )
private $ts;          	// time stamp


function __construct(){
	if (isset($_SESSION['chatUserName'])) {
		$this->me=$_SESSION['chatUserName'];
	}else{
		$this->me='';
	}
	if (isset($_SESSION['chatUserEmail'])) {
		$this->email=$_SESSION['chatUserEmail']; //the hashed email
	}else{
		$this->email;
	}
	if (isset($_SESSION['chatUserId'])) {
		$this->id=$_SESSION['chatUserId'];
	}else{
		$this->id;
	}
}

function prepareToSay(){
	global $db;
	if($this->gravatar=='on'){
		$this->imgSrc=$this->get_gravatar($this->email);
	}else{$this->imgSrc=$this->meImg;}
	if(get_magic_quotes_gpc()){
		$this->msg=stripcslashes($this->msg);
	}

	$this->msg4DbClean=str_replace('<','!:l3ftT4g',$this->msg);  //in the msg we change "<" so we dont loose it in the next filter
	$toBeCleaned=$this->msg4DbClean;
	$this->msg4DbClean=$db->cleanInput('s',$toBeCleaned,1); // we clean any undesired harmful characters
	/*if(isset($_SESSION['chatOldMsg'])){
		if($_SESSION['chatOldMsg']==$this->msg4DbClean) { //if the user has said this already
			die("repeat");
		}
	}*/
	if(empty($this->msg4DbClean) && $this->msg4DbClean!='0'){ //if the message is empty
		echo'f';$db->close();exit; //failure
	}
	if(!empty($_POST['lc'])){
		$this->lastChatter=trim($_POST['lc']);
	}else{
		$this->lastChatter='';
	}
	//$this->msgDate = gmdate('Y-m-d H:i:s',strtotime($this->tzOffset.' hours')); //date and time with GMT
	//$this->sDate = gmdate('H:i:s m-d-Y',strtotime($this->tzOffset.' hours')); //time with GMT
	date_default_timezone_set('Asia/Kolkata');
	$this->msgDate = date('Y-m-d H:i:s'); //date and time with GMT
	$this->sDate = date('H:i:s m-d-Y'); //time with GMT
	
	$sDate=explode(' ',$this->sDate);
	$time=explode(':',$sDate[0]);
	$theDate=explode('-',$sDate[1]);
	$mktmp=$time[0].','.$time[1].','.$time[2].','.$theDate[0].','.$theDate[1].','.$theDate[2];				
	$this->ts=@mktime($mktmp);
	$this->sDate=$this->timeInWords($this->ts);
}
//when you try to send a message
function say() {
	global $db,$chatTable,$typingServ;
	//$msgCleaned=htmlspecialchars_decode($msgCleaned);
	
	$query="INSERT INTO `$chatTable` (`sender_id`,`reciever_id`,`text`,`ts`)  values('{$this->id}','{$this->ref}','{$this->msg4DbClean}','{$this->msgDate}')"; //insert the msg in the DB
	$res=$db->query($query);
	if($res){  // if the chat message was inserted then
		$this->msg=$this->smiley($this->msg);
		$_SESSION['chatOldMsg']=$this->msg4DbClean;
		if($this->lastChatter==$this->me || $this->lastChatter=='me'){
				//i was the last who sent a msg (dont creat a new msg header)
				$msgLayout=array('m',$this->msg.'<br />'); // m => me

			}else{
				$meTitle=$this->shorten($this->me);
				//i wasn't me the last chatter (creat a new msg header)
				// "n" below means "NOT ME"
					$msgLayout=array('n','<div class="me chatMsg"><div class="msgHeader">(a###)a href="#" class="chatAvatar" >(img###)img src="'.$this->imgSrc.'" title="Me" />(a##)a><span class="chatName">(a###)a href="#" title="'.$this->me.'">'.$meTitle.'(a##)a></span><span class="msgTime">'.$this->sDate.'</span></div><div class="msgBody">'.$this->msg.'<br /></div></div>');
			}
		//treating the user chat msg (to not do a non allowed action <script>,<h1>...)
		$msgLayout[1]=$this->decode($msgLayout[1]);
		$msgLayout=json_encode($msgLayout);
		// if the typing service is enabled
		if ($typingServ) {
			//remove any indicator shown to the reciever that i'm typing !
			if (isset($_SESSION['typingID'])) {
				$id=$_SESSION['typingID'];
			}else{
				$id='';
			}
			if (!empty($id)) {
				$query="DELETE FROM `$chatTable` WHERE `id`='$id'";
				$res=$db->query($query);
				$_SESSION['typingID']="";
			}
		}
		echo $msgLayout;
	}else{echo'f';}
}

// checks for a new messages in current open chat tab
function check() {
	global $db,$nameColomn,$statueColomn,$emailColomn,$srcDB,$usersTable,$userIdColomn,$chatTable;
	/*$netStat=connection_status();
	if($netStat==0)//checking if the user is not connected to the net
	{
		$db->close();
		die('net');
	}*/

	$q="SELECT `".$nameColomn."`,`".$statueColomn."`,`".$emailColomn."` from `".$srcDB."`.`".$usersTable."` where ".$userIdColomn."='{$this->ref}' Limit 1";
	$result=$db->query($q);
	if($result){
		$nameData=$db->retrieve_data($result);
		$rec=$nameData[0][$nameColomn];
		$statue=$nameData[0][$statueColomn];
		$senderEmail=$nameData[0][$emailColomn];
	}
	switch($statue){
		case'0':
			die('offline');
		break;
		case'2':
			echo 'away';
		break;
		case'3':
			echo 'busy';
		break;
	}
	$oStat=$_SESSION['chatStat'];
	switch($oStat){
		case'0': //i'am offline
			$db->close();die('meoff');
		break;
		case'1': // You are online / continue to prepare the query
		//case'2': // You will be right back /continue to prepare the query
		//case'3': // You are busy /continue to prepare the query
			$this->preGet_msgs($rec,$senderEmail);
		break;
		default: // no such user in our DB , this should not happen
			$db->close();die('mess');
		break;
	}
}

//check for new messages from whom you aren't chatting with currently
function gCheck(){
	global $db,$globalRetry,$chatTable;
	if(empty($this->id)){ // if you have no user ID then we can't check if you have new messages !
		exit;
	}
	//$lastChk= gmdate('Y-m-d H:i:s',strtotime($this->tzOffset.' hours -'.$globalRetry.' seconds')); //since we last checked for new messages
	date_default_timezone_set('Asia/Kolkata');
	$lastChk= date('Y-m-d H:i:s',strtotime($this->tzOffset.' hours -'.$globalRetry.' seconds')); //since we last checked for new messages
	$query="SELECT * from `$chatTable` where reciever_id='{$this->id}' and ts > '{$lastChk}' order by id asc";
	$res=$db->query($query);
	if($res){
//Get the data
		$data=$db->retrieve_data($res);
		$dataCount=count($data);
		$sendersArr=array(); // the msgs recieved from the senders
		if(!empty($data) && $data[0]['text']!="ykb") { // if a msg was recieved AND not a typing indicator
			for($i=0;$i<$dataCount;$i++){
				$s_id=$data[$i]['sender_id']; // the current sender ID
//Ignore open chat tabs
				$openTabs=$_POST['t'];
				if(!empty($openTabs)){
					$foundOpen=in_array($s_id,$openTabs); //if the chat tab was open ignore this sender because check() is taking care of it
				}else{$foundOpen=0;}
				if(!$foundOpen) { // if this tab wasn't open then
					$exists=in_array($s_id,$sendersArr); // check if we registered this sender before
					if(!$exists){
							$sendersArr[$i]=$s_id; //register the sender ID
						}
				}
			}
			$tabNbr=count($sendersArr); // how many senders we got
			if($tabNbr==0) { //if no sender was found
					$db->close();
					exit;
				}else{
						//register the senders in a session to keep track of those open tabs (in case of refresh we don't loose them)
						$sendersStr=implode(',',$sendersArr);
						if(isset($_SESSION['openChatTabs'])){
							$chatTabs=$_SESSION['openChatTabs'];
							if($chatTabs!=''){
								$chatTabs=$chatTabs.','.$sendersStr;	
							}else{$chatTabs=$sendersStr;}
						}else{$chatTabs=$sendersStr;}
						$_SESSION['openChatTabs']=$chatTabs;
					 }
//insert it into the page
			$this->show_tabs($sendersArr);
		}
	}else{echo 'f';}
}

//replace the characters with smileys if possible
function smiley($msg) {
	$shortcut=array(':s','3:(',':D',':@',':|',':p',':(',':)',':o',';)',';(','xD','8)','o_o','^//^','D_D','3x)');
	$src=array(
		'(=lt)img class="smiley" src="img/confused.gif" alt=":s" title="confused" />',
		'(=lt)img class="smiley" src="img/evil.gif" alt="3:"  title="evil" />',
		'(=lt)img class="smiley" src="img/lol.gif" alt=":D" title="lol" />',
		'(=lt)img class="smiley" src="img/mad.gif" alt=":@" title="mad" />',
		'(=lt)img class="smiley" src="img/neutral.gif" alt=":|" title="neutral" />',
		'(=lt)img class="smiley" src="img/razz.gif" alt=":p" title="razz" />',
		'(=lt)img class="smiley" src="img/sad.gif" alt=":(" title="sad" />',
		'(=lt)img class="smiley" src="img/smile.gif" alt=":)" title="smile" />',
		'(=lt)img class="smiley" src="img/surprised.gif" alt=":o" title="surprised" />',
		'(=lt)img class="smiley" src="img/wink.gif" alt=";)" title="wink" />',
		'(=lt)img class="smiley" src="img/cry.gif" alt=";(" title="cry" />',
		'(=lt)img class="smiley" src="img/laugh.gif" alt="xD" title="laugh" />',
		'(=lt)img class="smiley" src="img/cool.gif" alt="8)" title="cool" />',
		'(=lt)img class="smiley" src="img/shocked.gif" alt="o_o" title="shocked" />',
		'(=lt)img class="smiley" src="img/redface.gif" alt="^//^" title="redface" />',
		'(=lt)img class="smiley" src="img/rolleyes.gif" alt="D_D" title="rolleyes" />',
		'(=lt)img class="smiley" src="img/twisted.gif" alt="3x)" title="twisted" />');	
	$msg=str_replace($shortcut,$src,$msg);
	return $msg;
}

//this function detects any link in the message and turn it into an <a> tag
function rewrite_link($content) {
	if(strstr($content,'www.')){
	  $link_patt = '\b([http://,https://]*)([w{3}]*)\.([A-Za-z0-9-]+\.[A-Za-z\.0-9]{2,5}/?[A-Za-z\.\?&=0-9]{0,})\b';
	  $rewrite_result = '(a###)a target="_blank" href="\\1\\2.\\3" title="\\3">\\1\\2.\\3(a##)a>';
	  $content = preg_replace('#'.$link_patt.'#', $rewrite_result, $content);
	  $content = str_replace('(a###)a target="_blank" href="www','(a###)a target="_blank" href="http://www',$content);
  	}
	return $content;
}

// decode the chat messages
function decode($msgLayout) {
	$tag=htmlentities('<');
	$br=html_entity_decode('&lt;br');
	$div=html_entity_decode('&lt;div');
	$divEnd=html_entity_decode('&lt;/div');
	$span=html_entity_decode('&lt;span');
	$spanEnd=html_entity_decode('&lt;/span');
	$abbr=html_entity_decode('&lt;abbr');
	$abbrEnd=html_entity_decode('&lt;/abbr');
	$toBeRep=array('<','(=lt)','&lt;br');
	$replacemnt=array($tag,'<',$br);
	$msgLayout =str_replace($toBeRep,$replacemnt,$msgLayout);
	$msgLayout =$this->rewrite_link($msgLayout);
	$toBeRep2=array('(a###)','(a##)','&lt;div','&lt;/div','&lt;span','&lt;/span','&lt;abbr','&lt;/abbr','(img###)','gravatar.com/avatar/');
	$replacemnt2=array('<','</',$div,$divEnd,$span,$spanEnd,$abbr,$abbrEnd,'<','http://www.gravatar.com/avatar/');
	$msgLayout =str_replace($toBeRep2,$replacemnt2,$msgLayout);
	return $msgLayout;
}

/**
 * @param string $email The email hash
 * @param string $s Size in pixels, defaults to 80px [ 1 - 512 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * for more info : http://gravatar.com/site/implement/images/php/ 
 */
	function get_gravatar( $email, $s = 20, $d = 'identicon', $r = 'g') {
		
		$obj = new myclass();
		$sql = "SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE md5(members.email_id)='".$email."'";
		$sql_res=$obj->select($sql);
				
		$path = "upload/".$sql_res[0]['photo'];
		
		if(!empty($sql_res[0]['photo']) && $sql_res[0]['Approve']==1)
		{
			if (file_exists($path)) 
			{
				$avatarSrc=$path;
			}
			else
			{
				if($sql_res[0]['gender']=='M')
				{
					$avatarSrc='images/male-user1.png';
				}
				else
				{
					$avatarSrc='images/female-user1.png';
				}
			}
		}
		else
		{
			if($sql_res[0]['gender']=='M')
			{
				$avatarSrc='images/male-user1.png';
			}
			else
			{
				$avatarSrc='images/female-user1.png';
			}
		}
		
		//$url = 'gravatar.com/avatar/';
	    //$url .= "$email?s=$s&d=$d&r=$r";
	    //return $url;
		return $avatarSrc;
	}

// show a new chat tabs when receiving messages from someone whith whom you are not chatting
// Note : This is for Live chating , not refresh case ! ( for refresh case see smoothChat.js "createChatHtml()" )
	function show_tabs($sendersArr) {
		global $db,$emailColomn,$nameColomn,$srcDB,$usersTable,$userIdColomn,$typingServ;
		$q="SELECT `".$nameColomn."`,`".$emailColomn."` from `".$srcDB."`.`".$usersTable."` where ".$userIdColomn."=? Limit 1";
		$subTabs=array();
		$chatLayouts=array();
		$stmt = $db->connect->stmt_init();
		$stmt->prepare($q);
		$stmt->bind_param('i', $senderId);
		foreach($sendersArr as $tab){
			$senderId=$tab; //get the sender id
			$stmt->execute();
			$stmt->bind_result($name,$email);
			while($stmt->fetch()) {
				$rec=$this->shorten($name);
				$em=$email;
		   	}
		   	if(!isset($rec)){
		   		$rec='UNKNOWN';
		   	};
			if(!isset($em)){
		   		$em='UNKNOWN';
		   	};
			//formatting the display of the messages 
			$subTab='$("<li id=\'subTab-'.$senderId.'\' class=\'active\'> '.$rec.' <span id=\'close-'.$senderId.'\' class=\'icon close\' ></span></li>")';
			array_push($subTabs, $subTab);
			$chatLayout='<div id="chat-'.$senderId.'" class="chat"><div class="chatHeader"><b>'.$name.'</b></div><div style="clear:both;"></div><div id="chatBox-'.$senderId.'" class="chatBox"><div id="displayBox-'.$senderId.'" class="displayBox"><div id="temporary-'.$senderId.'"></div>';
			//<img src="img/save.png" class="dld" alt="download" title="Download the conversation to your desktop" />
				if ($typingServ) { // if the typing service is enabled
					$chatLayout.='<div id="spy-'.$senderId.'" class="chatSpy"></div>';
				}
			$chatLayout.='</div><div id="errorBox-'.$senderId.'" class="errorBox"></div><div id="sayBox-'.$senderId.'" class="sayBox"><textarea id="say-'.$senderId.'" class="say" type="text" /></textarea><div id="openSmilies-'.$senderId.'" class="smileyFolder"><div id="smilies-'.$senderId.'" class="smilies"><ul><li class="Sconfused" alt=":s"></li><li class="Scry" alt=";("></li><li class="Sevil" alt="3:("></li><li class="Slaugh" alt="xD"></li><li class="Slol" alt=":D"></li><li class="Smad" alt=":@"></li><li class="Sneutral" alt=":|"></li><li class="Srazz" alt=":p"></li><li class="Sredface" alt="^//^"></li><li class="Srolleyes" alt="D_D"></li><li class="Ssad" alt=":("></li><li class="Sshocked" alt="o_o"></li><li class="Ssmile" alt=":)"></li><li class="Ssurprised" alt=":o"></li><li class="Stwisted" alt="3x)"></li><li class="Swink" alt=";)"></li><li class="Scool" alt="8)"></li></ul></div></div></div></div></div>';
			array_push($chatLayouts, $chatLayout);
		}
		$stmt->close();
		$package=array($sendersArr,$subTabs,$chatLayouts);
	// send the tab with the messages inside to be printed to the user
		$package=json_encode($package);
		echo $package;
	}

//prepare the query to get the messages
	function preGet_msgs($rec,$senderEmail){
		global $db,$retryAfter,$chatTable;
		if($this->is_oldCheck=='n'){ // first time we are checking for chat messages
			$query="SELECT * from `".$chatTable."` where reciever_id='{$this->ref}' and sender_id='{$this->id}' or reciever_id='{$this->id}' and sender_id='{$this->ref}'  order by id asc";
			$this->is_openChatTab(); //keeping track of open chat window 
			$lastChk='';
		}else{
			//$lastChk= gmdate('Y-m-d H:i:s',strtotime($this->tzOffset.' hours -'.$retryAfter.' seconds')); //since we last checked for new messages
			date_default_timezone_set('Asia/Kolkata');
			$lastChk= date('Y-m-d H:i:s',strtotime($this->tzOffset.' hours -'.$retryAfter.' seconds')); //since we last checked for new messages
			$query="SELECT `id`,`reciever_id`,`text`,`ts` from `$chatTable` where reciever_id='{$this->id}' and sender_id='{$this->ref}' and ts >= '{$lastChk}' order by id asc";
		 }
		$res=$db->query($query);
		if($res){
			$this->get_msgs($res,$rec,$senderEmail,$lastChk);
		}else{echo 'f';}
	}

//shorten long nicknames
	function shorten($name){
		$len=strlen($name);
		if($len<7){
			$nameTitle=$name;
		}else{
			$short=substr($name,0,6);
			$nameTitle=$short.'...';
		}
		return $nameTitle;
	}

//get the new chat msgz in the current chat conversations
	function get_msgs($res,$rec,$senderEmail,$lastChk) {
		global $db,$meImg,$retryAfter,$chatTable,$translateServ,$typingServ;
		$recTitle=$this->shorten($rec);
		$data=$db->retrieve_data($res);
		if(empty($data)){exit;}

		#############################	Typing related 		###########################
		if ($typingServ) {
			$length=count($data);
			$lastMsg=$data[$length-1]['text'];
			switch ($lastMsg) {
				case 'ykb':
					//$msgDate2TS = gmdate('H,i,s,m,d,Y',strtotime('+12 hours'));
					date_default_timezone_set('Asia/Kolkata');
					$msgDate2TS = date('H,i,s,m,d,Y');
					$tsArr=explode(',', $msgDate2TS);
					$nowTS=mktime($tsArr[0],$tsArr[1],$tsArr[2],$tsArr[3],$tsArr[4],$tsArr[5]);
					$lastMsgTime=$data[$length-1]['ts'];
					$lastMsgID=$data[$length-1]['id'];
					$tsArr=explode(' ', $lastMsgTime);
					$His=explode(":",$tsArr[1]);
					$Ymd=explode("-", $tsArr[0]);
					$msgTS=mktime($His[0],$His[1],$His[2],$Ymd[1],$Ymd[2],$Ymd[0]);
					$query="";
					$difference=$nowTS-$msgTS;
					if ($difference>=3) { 
						$query="DELETE FROM `$chatTable` WHERE `id`='$lastMsgID'";
						$res=$db->query($query);
						if ($res) {
							$_SESSION['typingID']="";
						}
					}
				break;
			}	
		}
		##################################################################################

		$avatars=$this->getAvatars($senderEmail);
		$avatars=explode(',', $avatars);
		$meImg=$avatars[1];
		$sImgUrl=$avatars[0];
	   	
		$dataCount=count($data);
		$oldMsg='';
		if(!empty($data)){
			if($this->lastChatter==$rec){  // The last message in the conversation don't belong to me
				 if (!isset($_SESSION['prevWave'])) {
				 	$_SESSION['prevWave']='';
				 }
				 $msgLayout='-#!#-p-#!#-';
				 $onlySpyMsg=true; // in case there is only typing message dont show anything (indicator)
				 foreach($data as $val){
					if($oldMsg!=$val['text']){
						if($val['ts']!=$lastChk){ // if the time in the database is different from the one in the script
							$difference=strtotime($val['ts'])-strtotime($lastChk);
							if($difference<=$retryAfter && $difference>=0){ // there were cases when DB time was advanced than script time therefor reciever was getting duplicated messages , and this is a solution to prevent that
								if (!$translateServ) {
									$msgLayout.=$val['text'].'<br />';
								}else{
									$msgLayout.='<div class="toTrans">(img###)img src="img/translate.png" class="translateThis" title="Translate this"/>'.$val['text'].' <span class="clear"></span></div>';
								}
								$onlySpyMsg=false;
							}else{ //check if the user is typing (typing indicators are stored in future date so it won't be shown)
								if ($val['text']=="ykb" && $onlySpyMsg){
									die('t');
								}
							}
						}else{
							if($val['text']==$_SESSION['prevWave']){ // this message was recieved in the last wave (last check !)
								$msgLayout.='';//do nothing
							}else{ //show the message
								if (!$translateServ) {
									$msgLayout.=$val['text'].'<br />';
								}else{
								$msgLayout.='<div class="toTrans">(img###)img src="img/translate.png" class="translateThis" title="Translate this"/>'.$val['text'].' <span class="clear"></span></div>';
								}
							}
						}
					}
					$oldMsg=$val['text'];
				}
				$_SESSION['prevWave']=$oldMsg; //this session is to keep track of the previous recieved message in the last check
			}else if($this->lastChatter==$this->me){ // The last message in the conversation belongs to me
				$ts = strtotime($data[0]['ts']);
				$sDate=$this->timeInWords($ts);
				// the other user is sending a message
				$msgLayout='-#!#-pn-#!#-<div class="rec chatMsg"><div class="msgHeader">(a###)a href="#" class="chatAvatar" >(img###)img src="'.$sImgUrl.'" title="'.$rec.'" />(a##)a><span class="chatName" >(a###)a href="#" title="'.$rec.'" >'.$recTitle.'(a##)a></span><span class="msgTime">'.$sDate.'</span></div><div class="msgBody">';
				$oldMsg='';
				$onlySpyMsg=true; // in case there is only typing message dont show anything (indicator)
				foreach($data as $val){
					if($oldMsg!=$val['text']){
						if($val['text']!="ykb"){
							if (!$translateServ) {
									$msgLayout.=$val['text'].'<br />';
								}else{
									$msgLayout.='<div class="toTrans">(img###)img src="img/translate.png" class="translateThis" title="Translate this" />'.$val['text'].'<span class="clear"></span> </div>';
								}
								$onlySpyMsg=false;
						}
					}
					$oldMsg=$val['text'];
				}
				if ($onlySpyMsg) {
					die('t');
				}else{
					$msgLayout.='</div></div>';
				}
			}else if($this->lastChatter=='' || $this->lastChatter==null || $this->lastChatter==undefined ){ //there were no recent messages (refresh case) // or i recieved a new msg (new chat tab)
				$msgLayout='';
				$meTitle=$this->shorten($this->me);
				$prev_reciever=''; //the previous reciever
				$onlySpyMsg=true; // in case there is only typing message dont show anything (indicator)
				foreach($data as $val){
					$reciever=$val['reciever_id'];
					$message=$val['text'];
					if($message!="ykb"){ // if the message isn't a typing spy message
						$time=$val['ts'];
						$onlySpyMsg=false;
						####################### define the messageLine to be used in section below ########################
						if($reciever==$this->id || $reciever==''){ // i recieved this message
							$divClass='rec';
							$nickname=$rec;
							$title=$recTitle;
							$imgSrc=$sImgUrl;
							if (!$translateServ) {
									$messageLine=$message.'<br />';
								}else{
									$messageLine='<div class="toTrans">(img###)img src="img/translate.png" class="translateThis" title="Translate this"/>'.$message.' <span class="clear"></span> </div>';
								}
						}else{// i sent this msg
							$divClass='me';
							$nickname=$this->me;
							$title=$meTitle;
							$messageLine=$message; //we don't need to translate what we said !
							// the Gravatar was checked if on/off at the beginning of the function
							$imgSrc=$meImg;
						}
						############################### End of messageLine ################################################

						############################### define msgLayout ################################################
						if($prev_reciever=='' || $prev_reciever!=$reciever){ // new person is talking 
							$ts = strtotime($time);
							$sDate=$this->timeInWords($ts);
							$msgLayout.='-#!#-pn-#!#-<div class="'.$divClass.' chatMsg"><div class="msgHeader">(a###)a href="#" class="chatAvatar" >(img###)img src="'.$imgSrc.'" title="'.$nickname.'" />(a##)a><span class="chatName">(a###)a href="#" title="'.$nickname.'">'.$title.'(a##)a></span><span class="msgTime">'.$sDate.'</span></div><div class="msgBody">'.$messageLine;
							if ($divClass=='me') { // if its me we add a <br> coz we dont have translation (different msg styling)
								$msgLayout.='<br />';
							}
							$msgLayout.='</div>
							</div>';
						}else{ // the same person is talking
							if ($reciever==$this->id) { //if the reciever is me then try translation is enabled
								if (!$translateServ) {
									$msgLayout.='-#!#-p-#!#-'.$message.'<br />';
								}else{
									$msgLayout.='-#!#-p-#!#-<div class="toTrans">(img###)img src="img/translate.png" class="translateThis" title="Translate this" />'.$message.' <span class="clear"></span></div>';
								}
							}else{
								$msgLayout.='-#!#-p-#!#-'.$message.'<br />';
							}
						}
						############################### End of msgLayout ################################################

						$prev_reciever=$reciever;
					}
				}
				if ($onlySpyMsg) {
					die('t');
				}
			}
			if(strstr($msgLayout,'!:l3ftT4g'))
				{
					$msgLayout=str_replace('!:l3ftT4g','<',$msgLayout);
				}
			$msgLayout=$this->smiley($msgLayout);
			$msgLayout=html_entity_decode($msgLayout);	
			$msgLayout=$this->decode($msgLayout);
			$msgLayout=explode('-#!#-', $msgLayout);
			$msgLayout=json_encode($msgLayout);
			echo $msgLayout;
		}
	}

	// saving in DB that the user is typing
	function isTyping($uid){
		global $chatTable,$db;
		$uid=$db->cleanInput('s',$uid,1);
		//$msgDate = gmdate('Y-m-d H:i:s',strtotime('+12 hours'));
		date_default_timezone_set('Asia/Kolkata');
		$msgDate = date('Y-m-d H:i:s');

		$query="SELECT `text`,`id` FROM `$chatTable` WHERE sender_id='{$this->id}' AND reciever_id='{$uid}' order by `ts` desc LIMIT 1";
		$res=$db->query($query);
		$dt=$db->retrieve_data($res);
		$id=$dt[0]['id'];
		switch($dt[0]['text']){
			case'ykb':
				$query="UPDATE `$chatTable` set `ts`='$msgDate' WHERE `id`='$id'";
				$res=$db->query($query);
			break;
			default:
				//$query="INSERT INTO `$chatTable` (`sender_id`,`reciever_id`,`text`,`ts`)  values('{$this->id}','$uid','ykb','{$msgDate}')"; //insert the msg in the DB
				//$res=$db->query($query);
				//$_SESSION['typingID']=mysqli_insert_id($db->connect);
			break;
		}
	}

	//turns the time into words
	function timeInWords( $timestamp ){
		//$now = strtotime(gmdate('Y-m-d H:i:s',strtotime($this->tzOffset.' hour')));
		date_default_timezone_set('Asia/Kolkata');
		$now = strtotime(date('Y-m-d H:i:s'));
	    $distance = ( round( abs( $now  - $timestamp ) / 60 ) );
	    if( $distance <= 1 ){
	        $return = ($distance == 0) ? 'few seconds ago' : '1 minute ago';
	    } elseif( $distance < 60 ){
	        $return = $distance . ' minutes ago';
	    } elseif( $distance < 119 ){
	        $return = 'an hour ago';
	    } elseif( $distance < 1440 ){
	        $return = round(floatval($distance) / 60.0) . ' hours ago';
	    } elseif( $distance < 2880 ){
	        $return = 'Yesterday at ' . date('H:i', $timestamp );
	    } elseif( $distance < 14568 ){
	        $return = date('l', $timestamp ) . ' at ' . date('H:i', $timestamp );
	    } else {
	        $return = date('d F', $timestamp ) . ( ( date('Y') != date('Y', $timestamp ) ? ' ' . date('Y', $timestamp ) : '' ) ) . ' at ' . date('H:i', $timestamp );
	    }
	    return '<abbr class="chatTime" title="' . date( 'l, jS F Y \a\t H:i', $timestamp ) . '" data-ts="' . $timestamp . '">' . $return . '</abbr>';
	}

	 //keeping track of open chat window 
	function is_openChatTab(){
		if(isset($_SESSION['openChatTabs']) && !empty($_SESSION['openChatTabs'])){
			$chatTabs=$_SESSION['openChatTabs'];
			$sess_arr=explode(',',$chatTabs);
			$found=in_array($this->ref,$sess_arr); 
			if(!$found) //if this tab was not already registred
				{
					$chatTabs=$chatTabs.','.$this->ref;
				}
		}else{$chatTabs=$this->ref;}
		$_SESSION['openChatTabs']=$chatTabs;
	}

	function getAvatars($senderEmail){
		global $db,$senderImg,$meImg;
		if($this->gravatar=='on'){
			$senderEmail=md5( strtolower( trim( $senderEmail ) ) );
	   		$sImgUrl=$this->get_gravatar($senderEmail);
	   		$meImg=$this->get_gravatar($this->email);
	   	}else{
	   		if(empty($senderImg)){ // no default sender avatar
	   			//$sImgUrl="your_avatars_folder/".$this->ref.".jpeg";  // in case you store avatars by user ID use this to get sender avatar

	   			// else run a query here ! to get the avatar
	   			
	   			##################### Example #####################
	   			// $query="SELECT ...";
				// $result=$db->query($query);
				// if($res){
				// 	$data=$db->retrieve_data($res); //Get the data
				// 	$sImgUrl=$data[$avatar];
				// }
	   			####################################################
	   		}else{
	   			$sImgUrl=$senderImg;
	   		}

	   		if(empty($meImg)){ // no default avatar for you
	   			//$meImg="your_avatars_folder/".$this->id.".jpeg";  // in case you store avatars by user ID use this to get your avatar

	   			// else run a query here ! to get the avatar

	   		}//else do nothing
	   	}
	   	return $sImgUrl.",".$meImg;
	}

function log($elem,$time){
	define('DIR_APP', str_replace('\'', '/', realpath(dirname(__FILE__))) . '/');
	define('DIR_SMOOTH_CHAT', str_replace('\'', '/', realpath(DIR_APP . '../')) . '/');
	$output = " $elem //// $time". "\n";				
	$file = fopen(DIR_SMOOTH_CHAT . 'log.txt', 'a');
	if($file){
		fwrite($file, $output);
		fclose($file);
	}
}

} // End of class chat

$chat=new Chat();
?>