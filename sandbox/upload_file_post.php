<?php
	session_start();
	include('lib/myclass.php');
	include('simpleimage.php');
	$fileType =	$_FILES['file']['type'];
	$fileName = $_FILES['file']['name'];
	echo $_FILES['file']['name'];
	if($fileName != '')
	{
			$fileName1 = $_FILES['file']['name'];
			if(!move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$fileName1))			
			{
	
			}
			else
			{
				
				list($width, $height, $type, $attr) = getimagesize('upload/'.$fileName1);
							
				if($width>483)
				{
					$image_re = new SimpleImage();
					$image_re->load('upload/'.$fileName1);
					$imgw = 483;
					$imgh = ($height * $imgw)/$width;
					$image_re->resize($imgw, $imgh);
					$image_re->save('upload/'.$fileName1);
				}

				
				//$insert_data="insert into member_photo_gallery(id,member_id,photo)values(NULL,'".$_SESSION['id']."','".$_FILES["file"]["name"]."')";
				//$db_insert=$obj->insert($insert_data);
	
				/*$update_data="update tbl_slider set image='".$fileName1."' where id='".$db_insert."'";
				$oj->edit($update_data);*/
			}
	}
	else
	{

	}

?>
