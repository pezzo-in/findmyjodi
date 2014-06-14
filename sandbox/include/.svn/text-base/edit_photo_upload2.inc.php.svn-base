<?php
session_start();
if(isset($_POST['del_pic']))
{
	for($i=0;$i<count($_POST['chkPic']);$i++)
	{
		$sqld="delete from member_photo_gallery where 
			   member_id = '".$_SESSION['logged_user'][0]['id']."' 
			   and 
			   id = '".$_POST['chkPic'][$i]."' ";
	   
		$obj->sql_query($sqld);
	}
echo "<script>window.location='edit_photo_upload.php'</script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w = $_POST['w'];
	$targ_h = $_POST['h'];
	
	$jpeg_quality = 90;

	$src = $_POST['img_name'];
	$img_r = imagecreatefromjpeg('upload/'.$src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);

	//header('Content-type: image/jpeg');
	//imagejpeg($dst_r,'crop_'.$src,$jpeg_quality);
	imagejpeg($dst_r,'upload/crop_'.$src,$jpeg_quality);
	echo '<script>window.location.href = "edit_photo_upload.php"</script>';
}

//upload photos in photo gallery
/*if(isset($_POST['upload_pic']))
{
	for ($i = 0; $i < count($_FILES['file']); $i++) {
			$fileLink =  $_SERVER['DOCUMENT_ROOT']."/Kannadalagna/upload/". $_FILES['file']['name'][$i];
			$fileType = $_FILES['file']['type'][$i];
			$fileSize = ($_FILES['file']['type'][$i]) / 1024;
			$source = "$fileLink";			
			if ((move_uploaded_file($_FILES["file"]["tmp_name"][$i], $source))) {
				$insert="INSERT into member_photo_gallery(id,member_id,photo)
						 values
						(NULL,'".$_SESSION['logged_user'][0]['id']."','".$_FILES["file"]["name"][$i]."')";
				$db_ins=$obj->insert($insert);				
			}  
		}
	echo "<script>window.location='edit_photo_upload.php'</script>";		
}*/
//LOGGED-IN USER'S DETAIL //
	$sql_login = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.id = '".$_SESSION['logged_user'][0]['id']."' and
				members.status = 'Active'";	


	$logged_in_member=$obj->select($sql_login);
	
?>
        <div class="content">
        	<div class="profile_details">
    			<div class="new_acc"> 
                <h3>Your Photo Galllery</h3>
                <form name="photo_gallery" method="post" enctype="multipart/form-data" class="gallery_div">
                <?php 
					$photos = "select * from member_photo_gallery 
							   where
							   member_id = '".$_SESSION['logged_user'][0]['id']."' AND Approve=1";
					$result = $obj->select($photos);
					if(!empty($result)) 
					{
						foreach($result as $db)
						{
							$path =  "upload/crop_".$db['photo'];
							if (file_exists($path)) {
								?>
						<div>
                        <input type="checkbox" name="chkPic[]" id="chk" value="<?php echo $db['id']; ?>" />
						<?php
								echo '<img class="size" src="'."upload/crop_".$db['photo'].'"/>';
						?></div><?php
							}						
						}				
					?><br clear="all" /><div class="new_acc">
	                <input type="submit" id="delete" name="del_pic" value="Delete">
                </div>
                <?php	
					}
					else
					{
						echo "There is no Photos in your Gallery"; 
					}							   
				?>
                 </form>
                  
         			<br clear="all"><br><br><hr />
                  	<div style="width:50%;float:left">
                         <h3><a href="#upload_photo" class="inline">Upload Main Photo</a></h3>
                    </div>
                     <?php 
					 session_start();
					// echo $_SESSION['logged_user'][0]['id'];
					
					$cnt = "select * from member_photo_gallery where member_id='".$_SESSION['logged_user'][0]['id']."'";
					$cnt = $obj->select($cnt);
					
					$count_cnt=0;
					
					for($i=0;$i<count($cnt);$i++)
					{
						if(file_exists('upload/crop_'.$cnt[$i]['photo']))
						{
							$count_cnt++;
						}
						
					}
					if($count_cnt<5)
					
					{
					?>
                    <form name="file_upload" method="post" action="upload_file.php" target="frame1" enctype="multipart/form-data" style="float:left;width:50%">
                    <h3>Upload Photos in your Gallery</h3>
                    <span id="img">
                        <div style="float:left ">
                        	<input type="file" id="file" name="file" onchange="this.form.submit(); display_block();" /><!-- this.form.submit(); -->
                        </div>
                        <div id="prepage" style="float:right;padding-top:0px;color:#A00;padding-left:12px"><img src="uploading.gif" width="150" height="50" /></div>
                	</span>
					</form>
     				<?php } ?>
                    <iframe src="upload_file.php" style="display:none" id="frame1" name="frame1" target="_blank" onload="clearPreloadPage()"></iframe>   
                    <br clear="all" />
                    <div class="new_acc"> 
                    <form action="edit_photo_upload.php" method="post" onsubmit="return checkCoords();" enctype="multipart/form-data">
                        <dv id="test_img"><img src='' id='cropbox' /></div>
                        <input type="hidden" id="img_name" name="img_name" />
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                        <input type="submit" value="Crop Image" name="crop_submit" id="crop_submit" style="display:none" />
                    </form>
                    </div>
                    <?php /*?><form name="photo_upload_form" method="post" style="padding-top:10px" enctype="multipart/form-data">
                    <div class="new_acc">
                        <input type="file" multiple="true" name="file[]" id="file"  style="color:black" /><br clear="all" />
                        <input type="submit" name="upload_pic">
                        </div>
                     </form><?php */?>  
  			  </div>
     		</div>
  

       
<script language="javascript" type="text/javascript">
 var check=0;
 var img_name='';
 function display_block()
 {
	 var temp=document.getElementById('file').value;
	 var n=temp.split("\\");
	 img_name=n[n.length-1];
	 document.getElementById('prepage').style.visibility='visible';
	 document.getElementById('file').disabled=true;
	 check=1;
 }
function clearPreloadPage() { //DOM

	if (document.getElementById){
		document.getElementById('prepage').style.visibility='hidden';
	}else{
		if (document.layers){ //NS4
			document.prepage.visibility = 'hidden';
		}
		else { //IE4
			document.all.prepage.style.visibility = 'hidden';
		}
	}
	document.getElementById('file').disabled=false;
	if(check==1)
	{
		document.getElementById('test_img').innerHTML="<img src='upload/"+img_name+"' id='cropbox' />";
		test();
		document.getElementById('img_name').value=img_name;
		$('#crop_submit').css('display','block');
	}
}
</script>  
       
<style>
.new_acc #delete
{
	background: url("../images/delete_account.png") no-repeat scroll left top rgba(0, 0, 0, 0);
    border: medium none;
    clear: both;
    color: #F46989;
    cursor: pointer;
    float: left;
    font-size: 0;
    height: 33px;
    margin-top: 10px;
    overflow: hidden;
    text-align: left;
    text-indent: -9999px;
    width: 90px;
}
.size
{
	height:151px;
	width:131px;
}
.back_btn
{
	text-align:right;
	padding-right:5px;	
}
.back_btn_size
{
	height:15px;
	padding-top:5px;
}
.profile_pic{
	/*height:150px;*/
	width:75px;
}
.upload_pic
{
	float: left;
    margin-right: 20px;
    padding: 24px 13px;
}
</style>     
