<?php
session_start();
include('../lib/myclass.php');
//include('simpleimage.php');
//echo $_SESSION['id']; exit;
if($_SESSION['adminid'] == '')
{
echo "<script> window.location.href = 'login.php' </script>";	
}
else
{
	echo "<script> window.location.href = 'dashboard.php' </script>";	
}
?>
