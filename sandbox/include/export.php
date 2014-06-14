<?php
@session_start();
require_once('vars.php');
require_once('config.php');
require_once('db.class.php');

$id=$_SESSION['chatUserId'];
$ref=$_GET['r'];

$data=getConversation();
if($data){
	$package=packageConversation($data);
	$file='Conversation-'.$id.'___'.date("Y-m-d_H-i",time());
	// tell the browser what kind of file is come in
	header("Content-type: text/plain");
	header('Content-Disposition: text; filename='.$file.'.txt');
	header('Content-Length: ' . strlen($package));
	header("Content-Transfer-Encoding: binary");
	echo $package;
	exit;
}else{
	header("Content-type: text/plain");
	header('Content-Disposition: text; filename=Empty.txt');
	header('Content-Length:1 ');
	header("Content-Transfer-Encoding: binary");
	echo 'No conversation was found !.';
	exit;
}

function getConversation()	// Generate the conversation !
{
	global $db,$chatTable,$id,$ref;
	$query="SELECT `sender_id`,`text`,`ts` from `".$chatTable."` where reciever_id='{$ref}' and sender_id='{$id}' OR reciever_id='{$id}' and sender_id='{$ref}'  order by ts asc";
	$res=$db->query($query);
	if($res){
		$data=$db->retrieve_data($res);
		return $data;
	}else{
		return false;
	}
}
	
function packageConversation($data){
	global $db,$nameColomn,$srcDB,$usersTable,$userIdColomn,$ref,$id;
	if(!empty($data)){
		$q="SELECT `id`,`".$nameColomn."` from `".$srcDB."`.`".$usersTable."` where ".$userIdColomn."='{$ref}' Limit 1";
		$result=$db->query($q);
		if($result){
				$nameData=$db->retrieve_data($result);
				$rec=$nameData[0][$nameColomn];
				$recID=$nameData[0]['id'];
			}
		$q="SELECT `id`,`".$nameColomn."` from `".$srcDB."`.`".$usersTable."` where ".$userIdColomn."='{$id}' Limit 1";
		$result=$db->query($q);
		if($result){
				$nameData=$db->retrieve_data($result);
				$me=$nameData[0][$nameColomn];
				$meID=$nameData[0]['id'];
			}
		$conv='';
		foreach ($data as $d) {
			$text=$d['text'];
			if( strstr($text,'(=lt)img class')){
				$text=html_entity_decode($d['text']);
				$pos=strpos($text,'alt=',40);
				$smiley=substr($text,$pos+5,2);
				$text=str_replace('(=lt)',$smiley.'<',$text);
				$text=strip_tags($text);
			}
			if($d['sender_id']==$meID){
				$sender=$me;
			}else if($d['sender_id']==$recID){
				$sender=$rec;
			}
			$conv.='('.$d['ts'].')   '.$sender.' : '.$text." \n ";
		}
		return $conv;
	}
}
?>