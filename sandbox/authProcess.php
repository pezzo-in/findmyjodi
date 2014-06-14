<?php  
session_start();
require_once('include/vars.php');
require_once('include/config.php');
require_once('include/db.class.php');

if (isset($_POST['act'])) {
	if ($_POST['act']=='lgn') {
		$name=$db->cleanInput('p','un',1);
		$email=$db->cleanInput('p','ue',1);
		$now = gmdate('Y-m-d H:i:s',strtotime('+1 hour'));
		$query="INSERT INTO `".$srcDB."`.`".$usersTable."` (`".$nameColomn."`,`".$statueColomn."`,`".$emailColomn."`,`chat_last_activity`)  values('{$name}','1','{$email}',NOW())"; //insert the user in the DB
		if($db->query($query)){
				$_SESSION[$sessionVar]=$name;
				echo 's';
			}else{echo 'f';}
	}
}

if (isset($_POST['act'])) {
	if ($_POST['act']=='lgt') {
		if (isset($_SESSION['chatUserId'])) {
			$sessId=$_SESSION['chatUserId'];
		}else{
			$sessId='';
		}
		$query="UPDATE `".$srcDB."`.`".$usersTable."` set `{$statueColomn}`='0' WHERE  `".$userIdColomn."`='{$sessId}'  ";
		//$query="DELETE from `".$srcDB."`.`".$usersTable."` where `".$userIdColomn."`='{$sessId}'"; //insert the user in the DB
		if($db->query($query)){
			$_SESSION['chatUserId']='';
			$_SESSION['chatUserName']='';
			$_SESSION['chatUserEmail']='';
			$_SESSION['chatStat']='';
			session_destroy();
			echo 's';
		}else{echo 'f';}
	}
}
?>