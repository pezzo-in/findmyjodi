<?php
@session_start();
require_once('config.php');
require_once('vars.php');
require_once('db.class.php');
if(!$useDefaultAuth){
	$usersTable=$usersTable4setup;
}
class TabsControl{

//when you want to remove a chat tab
static function removeTab($ref){
	$tabs='';
	 if(isset($_SESSION['openChatTabs'])){
		$chatTabs=$_SESSION['openChatTabs'];
		$tabsArr=explode(',',$chatTabs);
		foreach($tabsArr as $tab)
		{
			if(($tab!=$ref)&& (!empty($tab)))
				{
					if($tabs!=''){
						$tabs=$tabs.','.$tab;
					}else{$tabs=$tab;}
				}
		}
	}
	if(!empty($tabs))
		{
			$_SESSION['openChatTabs']=$tabs;
		}else{$_SESSION['openChatTabs']='';}
	echo 's';
}

// get all the open chat tabs
static function getOpenTabs(){
	global $db,$nameColomn,$srcDB,$usersTable,$userIdColomn;
	if(isset($_SESSION['openChatTabs']) && !empty($_SESSION['openChatTabs'])){ // if any tabs were registred in the session
		$chatTabs=$_SESSION['openChatTabs'];
		$tabsArr=explode(',',$chatTabs); // get all the tabs
		$nicknames=array();
		$i=0;
		
		$q="SELECT `".$nameColomn."` from `".$srcDB."`.`".$usersTable."` where ".$userIdColomn."=?";
		$stmt = $db->connect->stmt_init();
		$stmt->prepare($q);
		$stmt->bind_param('i', $tab);
		 foreach($tabsArr as $tab) // loop through the tabs
		{
			$stmt->execute();
			$stmt->bind_result($data);
		
			while($stmt->fetch()) {
				$nicknames[$i]=$data;
				$i++;
		   	}
		}
		$stmt->close();
		$nicks=implode(',',$nicknames);
		$openTabs=array($tabsArr,$nicknames);
		$openTabs=json_encode($openTabs);
		echo $openTabs;

	}else{echo'e';}//empty
}

// change chat statue 
static function changeStatue($statue){
	global $sessionVar,$dataType,$srcDB,$usersTable,$statueColomn,$nameColomn,$userIdColomn,$db;
	if(isset($_SESSION[$sessionVar])){
		$sessId=$_SESSION['chatUserId'];
		$query="UPDATE `".$srcDB."`.`".$usersTable."` set `".$statueColomn."`='{$statue}' where `".$userIdColomn."`='{$sessId}'";
		$res=$db->query($query);
		if($res){
				$_SESSION['chatStat']=$statue;
				echo 's';
			}else{echo 'f';}
	}else{echo 'f';}
	
}

static function getStatue(){
	global $db,$sessionVar,$statueColomn,$srcDB,$usersTable,$statueColomn,$userIdColomn,$db;
	if(isset($_SESSION[$sessionVar])){
		$sessId=$_SESSION['chatUserId'];
		$query="SELECT `".$statueColomn."` FROM `".$srcDB."`.`".$usersTable."` WHERE  `".$userIdColomn."`='".$sessId."' LIMIT 1";
		$res=$db->query($query);
		if($res){
			$data=$db->retrieve_data($res);
			$statue=$data[0][$statueColomn];
			//$_SESSION['chatStat']=$statue;
			return $statue;
		}else{return false;}
	}else{return false;}
}

}
?>