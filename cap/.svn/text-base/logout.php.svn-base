<?php
session_start();
if (isset($_POST['logout'])) {
		$_SESSION['cap_admin']='';
		session_destroy();
		header('Location:index.php');
	}else{echo 'failed to logout !';}
?>


