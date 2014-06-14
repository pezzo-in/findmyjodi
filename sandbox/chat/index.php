<?php
$path='';
require_once($path.'include/layout.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smooth Ajax Chat</title>
<?php
echo'<link rel="stylesheet" type="text/css" href="'.$path.'css/smoothChat.css" />';
?>
</head>
<body>
<?php
chat($path);
incScripts($path);
?>
</body>
</html>
