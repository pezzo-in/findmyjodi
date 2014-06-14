<?php  
require_once('include/vars.php');
require_once('include/config.php');
require_once('include/db.class.php');
$q = "CREATE DATABASE IF NOT EXISTS `".DB."`";
$res=$db->query($q);
if($res){
	$q="USE `".DB."`";
	$res=$db->query($q);
	if($res){
		$q="CREATE TABLE IF NOT EXISTS `".$chatTable."` (
		`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`sender_id` int(11) unsigned NOT NULL,
		`reciever_id` int(11) unsigned NOT NULL,
		`text` text NOT NULL,
		`ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		 PRIMARY KEY (`id`),
		 KEY `ts` (`ts`)
		 ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
		 $res=$db->query($q);
		if($res){
			$q="CREATE TABLE IF NOT EXISTS `".$usersTable."` (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`name` varchar(30) NOT NULL,
			`email` varchar(60) NOT NULL,
			`status` enum('0','1') NOT NULL,
			`chat_last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			 PRIMARY KEY (`id`),
			 UNIQUE KEY `name` (`name`),
			 KEY `chat_last_activity` (`chat_last_activity`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";	
			$res=$db->query($q);
			if($res){
				$q = "CREATE TABLE IF NOT EXISTS `".DB."`.`capu` (`id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT, `username` VARCHAR(40) NOT NULL,
				 `passwd` VARCHAR(40) NOT NULL, PRIMARY KEY (`id`)) ENGINE = MyISAM;";
				 $res=$db->query($q);
				 if($res){
				 	$q = "INSERT INTO `".DB."`.`capu` (`id`, `username`, `passwd`) VALUES (NULL, 'admin', SHA1('admin'));";
				 	$res=$db->query($q);
				 	if($res){
					 	setcookie('vars','',time()-604800);
					 	die('Congratulation !,The Chat has completed the data base installation.');
			 		}else{die('=>Error,Unable to complete the database setup : '.mysqli_error($db->connect).'@>#__!');}
				 }else{die('=>Error,Unable to complete the database setup : '.mysqli_error($db->connect).'@>#__!');}
			}else{die('=>Error,Unable to complete the database setup : '.mysqli_error($db->connect).'@>#__!');}
		}else{die('=>Error,Unable to complete the database setup : '.mysqli_error($db->connect).'@>#__!');}
	}else{die('=>Error,Unable to complete the database setup : '.mysqli_error($db->connect).'@>#__!');}
	
}




?>
