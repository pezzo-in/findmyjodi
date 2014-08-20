<?php
@session_start();
require_once('vars.php');
require_once('config.php');
	if (!defined('USER')) {
		header('Location: install/install.php');
		exit;
	}
require_once('db.class.php');

function incScripts($path){
	/*<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>*/
	echo'<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="'.$path.'js/_ago.js"></script>
	<script type="text/javascript" src="'.$path.'js/vars.js"></script>
	<script type="text/javascript" src="'.$path.'js/jqt.js"></script>
	<script type="text/javascript" src="'.$path.'js/jq.json.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="'.$path.'js/slimScroll.min.js"></script>
	<script src="'.$path.'js/smoothChat.js"></script>
        <script src="'.$path.'js/bootstrap.js"></script>';

}

function chat($path){
	global $useDefaultAuth;
	if($useDefaultAuth){
		$logged=auth($path);
		if($logged){
			chatLayout($path);
		}	
	}else{
		chatLayout($path);
	}
}

function chatLayout($path){
	global $translateServ;
	?>
	<div id="chatCtr" class="hidden-sm hidden-xs">
		<ul>
			<li id="prevT" style="display:none;">
				<span id="tabsLeftP"> 0 </span><span class="icon next"></span>
			</li>
			<li id="scrollRight" style="display:none;">
				<span class="icon snext"></span>
			</li>
			<li id="stg">
				<div id="chatStg">
				<div id="stgHeader"><b>Settings</b></div>
					<ul>
					<?php
					if ($translateServ) { // if the translation service is enabled
						$languages=array("ar"=> "Arabic","bg"=> "Bulgarian","ca"=> "Catalan","zh-CHS"=> "Chinese (Simplified)","zh-CHT"=> "Chinese (Traditional)","cs"=> "Czech","da"=> "Danish","nl"=> "Dutch","en"=> "English","et"=> "Estonian","fi"=> "Finnish","fr"=> "French","de"=> "German","el"=> "Greek","ht"=> "Haitian Creole","he"=> "Hebrew","hi"=> "Hindi","hu"=> "Hungarian","id"=> "Indonesian","it"=> "Italian","ja"=> "Japanese","ko"=> "Korean","lv"=> "Latvian","lt"=> "Lithuanian","mww"=>"Hmong Daw","no"=> "Norwegian","fa"=> "Persian","pl"=> "Polish","pt"=> "Portuguese","ro"=> "Romanian","ru"=> "Russian","sk"=> "Slovak","sl"=> "Slovenian","es"=> "Spanish","sv"=> "Swedish","th"=> "Thai","tr"=> "Turkish","uk"=> "Ukrainian","vi"=> "Vietnamese");
						$lanCodes=array("ar" ,"bg" ,"ca" ,"zh-CHS" ,"zh-CHT" ,"cs" ,"da" ,"nl" ,"en" ,"et" ,"fi" ,"fr" ,"de" ,"el" ,"ht" ,"he" ,"hi" ,"hu" ,"id" ,"it" ,"ja" ,"ko" ,"lv" ,"lt","mww","no" ,"fa" ,"pl" ,"pt" ,"ro" ,"ru" ,"sk" ,"sl" ,"es" ,"sv" ,"th" ,"tr" ,"uk" ,"vi");
						echo'<li id="translate">Translation
							<div id="languages">
								<ul>';
								if (isset($_COOKIE['l'])) {
										$lang=$_COOKIE['l'];
									}else{
										$lang='';
									}
									if(empty($lang)){
										$userLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
										if (in_array($userLang, $lanCodes)) {
											$lang=$userLang;
										}else{
											$lang='en';
										}
									}
									foreach ($languages as $key => $value) {
										if($lang==$key){
											echo "<li id='$key' class='nativeLanguage'>$value</li>";
										}else{
											echo "<li id='$key'>$value</li>";
										}
									}					
								echo"</ul>
							</div>
						</li>
						<hr />";
					}
					?>
						<li class="chatStatue" id="s1"><span class="icon online"></span>Online</li>
						<li class="chatStatue" id="s0"><span class="icon offline"></span> Offline</li>
						<hr />
						<?php 
							$c=@$_COOKIE['s'];
							if($c=='sound'){
								echo'<li id="sound" class="chatSoundCtrl"><span class="icon"></span>Enable sound</li>';
							}else{
								echo'<li id="soundMute" class="chatSoundCtrl"><span class="icon"></span>Disable sound</li>';
							}
						 ?>
					</ul>
				</div>
				<span class="icon stg"></span>
			</li>
            <li id="friends">
				<div id="frdDiv">
					<div id="frdHeader"><b>Who's online ?</b></div>
					<div id="onlineUsers">
						Do you want to see online members?
					</div>
					<ul>
						<hr />
						<li class="friendsType" id="f1">Show online members</li>
						<!--<li class="friendsType " id="f2">Friends</li>-->
					</ul>
				</div>
				<span class="icon friends"></span>
			</li>
		</ul>
		<span id="nextT"><span class="icon prev"></span><span id="tabsLeftN"> 0 </span> </span>
		<span id="scrollLeft"><span class="icon sprev"></span></span>
	</div>
	<div id="chatTab">
		<ul></ul>
	</div>
	<button id="lgt">Logout</button>
	<?php
	echo '<audio id="chatSoundElem" src="'.$path.'message.wav"></audio>';
}

function auth($path) {
global $sessionVar;
if(isset($_SESSION[$sessionVar])){
	$sess=$_SESSION[$sessionVar];
}else{
	$sess='';
}

if(isset($_SESSION['chatUserId'])){
	$sessId=$_SESSION['chatUserId'];
}else{	
		$sessId='1';
}

if (empty($sess) && empty($sessId)) {
 	?>
	<div id="container" style="display:none">
		<a id="title" href="index.php">Smooth Chat</a>
		<div class="outer">
			<div class="inner">
			 	<div id="subCtr">
				<form id="loginForm">
			 		<input type="text" id="userNm" />
					<input type="text" id="userEm" />
					<input id="login" class="button" type="submit" value="Login" />
				</form>
				</div>
				<div id="loader"> Signing in <img class="loadPic" src="<?php echo $path; ?>img/loading.gif" /> </div>
				<div id="cMsg"></div>
			</div>
		</div>
	</div>
	<?php
 }else{return 1;}
}
?>