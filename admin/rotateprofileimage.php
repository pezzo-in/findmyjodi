<?php

$path   = '../upload';
$file   = $_POST['proimgname'];
$ext = pathinfo($file, PATHINFO_EXTENSION);
$degrees = 270;





$filename = $path . "/" .$file;

$filename1 = $path . "/" .$file;
if($ext=="jpg" || $ext=="JPG" || $ext==="jpeg"){
// Content type
header('Content-type: image/jpeg');

// Load
$source = imagecreatefromjpeg($filename);

// Rotate
$rotate = imagerotate($source, $degrees, 0);

// Output
$jpeg=imagejpeg($rotate,$filename);
}
echo 1;
//file_put_contents($filename1,$filename );
//echo $filename;
?>

