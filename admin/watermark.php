<?php 
         include('../lib/myclass.php');
         $imgtyp= $_POST['status'];
         $id=$_POST['id'];
	if($imgtyp=='profile')
	{
		$select="select * from member_photos where id='".$id."'";
		$image=$obj->select($select);
	}
	else
	{
			$select="select * from member_photo_gallery where id='".$id."'";
			$image=$obj->select($select);
	}
        $proimagename=$image[0]['photo'];
        $file=$proimagename;
        
$path   = '../upload';
$filename = $path ."/".$file;
$image_path = "../images/wlogo.png";
$font_path = "Jambetica.ttf";
$font_size = 20;       // in pixcels
//$water_mark_text_1 = "9";
$water_mark_text_2 = "Find My Jodi";
if(strlen($file))
{
   
    $data= watermark_image($filename, $filename);
    
}

?>
<?php
function watermark_image($oldimage_name, $new_image_name){
    global $image_path;
    list($owidth,$oheight) = getimagesize($oldimage_name);
    $width =$owidth;
    $height = $oheight;	
    $im = imagecreatetruecolor($width, $height);
    $img_src = imagecreatefromjpeg($oldimage_name);
    imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
    $watermark = imagecreatefrompng($image_path);
    list($w_width, $w_height) = getimagesize($image_path);        
    $pos_x = $width - $w_width-10; 
    $pos_y = $height - $w_height-5;
    imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
    imagejpeg($im, $new_image_name, 100);
   
    return true;

}


function watermark_text($oldimage_name, $new_image_name){
    global $font_path, $font_size, $water_mark_text_1, $water_mark_text_2;
    list($owidth,$oheight) = getimagesize($oldimage_name);
    $width =$owidth;
    $height = $oheight;
    $image = imagecreatetruecolor($width, $height);
    $image_src = imagecreatefromjpeg($oldimage_name);
    imagecopyresampled($image, $image_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
   // $black = imagecolorallocate($image, 0, 0, 0);
    $blue = imagecolorallocate($image, 79, 166, 185);
   // imagettftext($image, $font_size, 0, 30, 190, $black, $font_path, $water_mark_text_1);
    imagettftext($image, $font_size, 0, 68, 190, $blue, $font_path, $water_mark_text_2);
    imagejpeg($image, $new_image_name, 100);
  
    return true;
}


    

	

?>

