<?php
session_start();
require_once('../include/vars.php');
require_once('../include/config.php');
require_once('../include/db.class.php');
if (isset($_POST['login'])) {
		$name=$db->cleanInput('p','un',1);
		$pass=$db->cleanInput('p','up',1);
		$query="SELECT * FROM `".$srcDB."`.`capu` where username='".$name."' and passwd='".sha1($pass)."'";
		$res=$db->query($query);
		if($res->num_rows){
				$_SESSION['cap_admin']=$name;
				header('Location:index.php');
			}else{?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
			<html  xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>Admin login</title>
				<link rel="stylesheet" type="text/css" href="../css/cap.css" />
			</head>
			<body>
			<div id="container">
			<a id="title" href="index.php">Admin Login</a>
			<div class="outer">
				<div class="inner">
				 	<div id="subCtr">
					<form method="post" action="login.php">
				 		<input type="text" name="un" id="userNm" />
						<input type="password" id="userPW" name="up" />
						<div class="error">Username or password is incorrect ! </div>
						<input type="submit" name="login" class="button" id="login" value="Login" class="input_field submit"/>
					</form>
					</div>
				</div>
			</div>
		</div>
		</body>
		<?php }
}
?>
