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
if(isset($_FILES['file']) && $_FILES['file']['name']!='')
{
	$fileType =	$_FILES['file']['type'];
	$fileName = $_FILES['file']['name'];
	
	if($fileName!='')
	{
			$fileName1 = $_FILES['file']['name'];
			$fileName1=time().'_'.$fileName1;
			
			if(!move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$fileName1))			
			{
	
			}
			else
			{
				
				list($width, $height, $type, $attr) = getimagesize('upload/'.$fileName1);
							
				if($width>712)
				{
					$image_re = new SimpleImage();
					$image_re->load('upload/'.$fileName1);
					$imgw = 712;
					$imgh = ($height * $imgw)/$width;
					$image_re->resize($imgw, $imgh);
					$image_re->save('upload/'.$fileName1);
				}
				
				if($width>150)
				{
					$image_re = new SimpleImage();
					$image_re->load('upload/'.$fileName1);
					//$imgw = 150;
					//$imgh = ($height * $imgw)/$width;
					$image_re->resize(150, 150);
					$image_re->save('upload/thumb/'.$fileName1);
				}
				else 
				{
					$image_re = new SimpleImage();
					$image_re->load('upload/'.$fileName1);
					$image_re->resize($width, 150);
					$image_re->save('upload/thumb/'.$fileName1);
				}
			}
			
			$sql = "select * from member_photos where member_id = '".$_SESSION['logged_user'][0]['id']."'";
			$chk_exist_photo = $obj->select($sql);
			if(!empty($chk_exist_photo))
			{		
				$update_pic = "update member_photos set photo = '".$fileName1."', Approve=0 where member_id = '".$_SESSION['logged_user'][0]['id']."'";
				$ans = $obj->edit($update_pic);
			}
			else
			{
				$insert = "insert into member_photos (id,member_id,photo) value (NULL,'".$_SESSION['logged_user'][0]['id']."','".$fileName1."')";
				$res = $obj->insert($insert);			
			}
			$_SESSION['Profile_pic']=$fileName1;
	}
	echo '<script>window.location.href = "edit_photo_upload.php?Profile=Success"</script>';
}
if(isset($_FILES['file1']) && $_FILES['file1']['name']!='')
{
	$fileType =	$_FILES['file1']['type'];
	$fileName = $_FILES['file1']['name'];
	
	if($fileName!='')
	{
			$fileName1 = $_FILES['file1']['name'];
			$fileName1=time().'_'.$fileName1;
			if(!move_uploaded_file($_FILES['file1']['tmp_name'],'upload/'.$fileName1))			
			{
	
			}
			else
			{
				
				list($width, $height, $type, $attr) = getimagesize('upload/'.$fileName1);
							
				if($width>712)
				{
					$image_re = new SimpleImage();
					$image_re->load('upload/'.$fileName1);
					$imgw = 712;
					$imgh = ($height * $imgw)/$width;
					$image_re->resize($imgw, $imgh);
					$image_re->save('upload/'.$fileName1);
					
				}
			}
			$insert_data="insert into member_photo_gallery(id,member_id,photo)values(NULL,'".$_SESSION['logged_user'][0]['id']."','".$fileName1."')";
			
			$db_insert=$obj->insert($insert_data);
			mysql_insert_id();
			
			$_SESSION['gallery_pic']=$fileName1;
			
	}
	echo '<script>window.location.href="edit_photo_upload.php?Gallery=Success"</script>';
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w = $_POST['w'];
	$targ_h = $_POST['h'];
	$jpeg_quality = 90;
	$src = time().'_'.$_POST['img_name'];
	$img_r = imagecreatefromjpeg('upload/'.$src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
	
	imagejpeg($dst_r,'upload/'.$src,$jpeg_quality);
	
	if($_POST['photo_type']=='Gallery')
	{
		$insert_data="insert into member_photo_gallery(id,member_id,photo)values(NULL,'".$_SESSION['logged_user'][0]['id']."','".$src."')";
		$db_insert=$obj->insert($insert_data);
		echo '<script>window.location.href = "edit_photo_upload.php?Gallery=Success"</script>';
	}
	else if($_POST['photo_type']=='Profile')
	{
		$sql = "select * from member_photos where member_id = '".$_SESSION['logged_user'][0]['id']."'";
		$chk_exist_photo = $obj->select($sql);
		if(!empty($chk_exist_photo))
		{		
			$update_pic = "update member_photos set photo = '".$src."', Approve=0 where member_id = '".$_SESSION['logged_user'][0]['id']."'";
			$ans = $obj->edit($update_pic);
		}
		else
		{
			$insert = "insert into member_photos (id,member_id,photo) value (NULL,'".$_SESSION['logged_user'][0]['id']."','".$src."')";
			$res = $obj->insert($insert);			
		}
		echo '<script>window.location.href = "edit_photo_upload.php?Profile=Success"</script>';
	}
}
//LOGGED-IN USER'S DETAIL //
	$sql_login = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.id = '".$_SESSION['logged_user'][0]['id']."' and
				members.status = 'Active'";	
	$logged_in_member=$obj->select($sql_login);
	
?>
        <div class="content col-md-8">
        	<div class="profile_details">
    			<div class="new_acc"> 
                <h3>Your Photo Gallery <span style="float:right;color:#093; font-size:14px;"><?php if($_GET['Profile']=='Success'){ ?>Profile Picture Uploaded Successfully, Waiting for admin approval.<?php }else if($_GET['Gallery']=='Success'){ ?><?php } ?></span> </h3>
                 </div>
                  <div class="sel_picture">
                        	<?php
							$photos = "select * from member_photo_gallery where member_id = '".$_SESSION['logged_user'][0]['id']."' AND Approve=1";
							$result = $obj->select($photos);
							if(!empty($result)) 
							{
							?>
                            <ul>
                            <?php
								foreach($result as $db)
								{
									$path =  "upload/".$db['photo'];
									if (file_exists($path)) {
							?>
                            <li>
                                <a href="javascript:;" class="popper" data-popbox="pop<?php echo $db['id']; ?>" style="height:112px">
                                    <img src="upload/<?php echo $db['photo']; ?>" width="100px" height="100px">
                          <div id="pop<?php echo $db['id']; ?>" class="popbox"><img src="upload/<?php echo $db['photo'];//str_replace('crop_','',$db['photo']); ?>" /></div>
                                </a>
                       <input type="radio" name="chkPic" <?php if($db['Cover_photo']==1){ ?> checked="checked" <?php } ?> value="<?php echo $db['id']; ?>" />
                            </li>
                            <?php
									}
								}
							?>
                            </ul>
                            <div class="sel_pic_button">
                                Select picture and make it<br />
                                <a href="javascript:;" class="cover_pic_btn1">Cover Picture</a>
                                <a href="javascript:;" class="delete_btn1">Delete</a>
                                <a href="javascript:;" class="cover_error"></a>
                                <a href="javascript:;" class="cover_delete"></a>
                            </div>
                            <?php
							}else{
								$sql11 = "select * from member_photo_gallery where member_id='".$_SESSION['logged_user'][0]['id']."' AND Approve=0";
								$db_sql11 = $obj->select($sql11);
								
								if(count($db_sql11)>0){ ?>
								<span style="color:#093; font-size:14px;">Gallery Picture Uploaded Successfully, Waiting for admin approval.</span>
								<?php }else{ ?>
									<span style="color:#093; font-size:14px;">There are no Photos in the Gallary.</span>
								<?php }
							} ?>
                    </div>
         			<br clear="all">
                  	<div style="width:50%;float:left">
                         <h3>Upload your Profile Picture</h3>
<form name="file_upload" method="post" action="" class="inputfile" enctype="multipart/form-data" style="float:left;width:50%">
                            <span id="img" class="makprfl-pic">
                                <div style="float:left ">
                                    <input type="file" id="file1" name="file" class="inputfile" onchange="this.form.submit();" /><br />
                                    <?php  if($_SESSION['Profile_pic']!=''){ ?>
<img src="upload/<?php echo $_SESSION['Profile_pic']; ?>" height="75" width="75" /> <?php } ?>
                                </div>
                            </span>
						</form>
                    </div>
                   <h3>Upload Photos in your Gallery</h3>
                     <?php 
					// echo $_SESSION['logged_user'][0]['id'];
					
					$cnt = "select * from member_photo_gallery where member_id='".$_SESSION['logged_user'][0]['id']."'";
					$cnt = $obj->select($cnt);
					
					$count_cnt=0;
					
					for($i=0;$i<count($cnt);$i++)
					{
						if(file_exists('upload/'.$cnt[$i]['photo']))
						{
							$count_cnt++;
						}
					}
					if($count_cnt<5)
					{
					?>
                <form name="file_upload1" method="post" action="" enctype="multipart/form-data" style="float:left;width:50%">
                    <span id="img">
                        <div style="float:left ">
                        	<input type="file" id="file2" name="file1" class="inputfile" onchange="this.form.submit();" /><br />
                        </div>
                	</span>
					</form>
     				<?php } ?>
                    <div class="uploaded-photos">
                    <?php
					$glry="select * from member_photo_gallery where member_id='".$_SESSION['logged_user'][0]['id']."' AND Approve=0";
					$dbglry=$obj->select($glry);
					for($i=0;$i<count($dbglry);$i++) { ?>
<img src="upload/<?php echo $dbglry[$i]['photo']; ?>" height="75" width="75" style="margin-right:5px; border-right:solid 1px #CCC;" /> <?php }  ?>
</div>
					<div id="prepage" style="float:right;padding-top:0px;color:#A00;padding-left:12px;visibility:hidden"><img src="uploading.gif" /></div>
                    <iframe src="upload_file.php" style="display:none" id="frame1" name="frame1" target="_blank" onload="clearPreloadPage()"></iframe>   
                    <br clear="all" />
                    <a href="#inline_content" id="crop_img_link" class="inline" style="display:none;">View Img</a>
                    <div class="colorbox">
                        <div id="inline_content">
                             <div class="new_acc" style="margin-top:10px;"> 
                                <form action="edit_photo_upload.php" method="post" onsubmit="return checkCoords();" enctype="multipart/form-data">
                                  <div id="test_img"><img src='' id='cropbox' /></div>
                                    <input type="hidden" id="img_height" value="" />
                                    <input type="hidden" id="img_width" value="" />
                                    <input type="hidden" id="img_name" name="img_name" />
                                    <input type="hidden" id="photo_type" name="photo_type" />
                                    <input type="hidden" id="x" name="x" />
                                    <input type="hidden" id="y" name="y" />
                                    <input type="hidden" id="w" name="w" />
                                    <input type="hidden" id="h" name="h" />
                                   <input type="submit" value="Crop Image" name="crop_submit" id="crop_submit" style="display:none" class="submit_btn_new" />
                                </form>
                                </div>
                        </div>
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
 function display_block(id)
 {
	 var _URL = window.URL || window.webkitURL;
	 var temp=document.getElementById('file').value;
	 var n=temp.split("\\");
	  var file, img;
    if ((file = id.files[0])) {
        img = new Image();
        img.onload = function () {
		   $('#img_width').val(this.width)
		   $('#img_height').val(this.height)
        };
        img.src = _URL.createObjectURL(file);
    }	
	 img_name=n[n.length-1];
	document.getElementById('prepage').style.visibility='visible';
	 document.getElementById('file').disabled=true;
	 document.getElementById('file1').disabled=true;
	 check=1;
	 document.getElementById('photo_type').value='Gallery';
 }
 
 function display_block1(id)
 {
	var _URL = window.URL || window.webkitURL;
	 var temp=document.getElementById('file1').value;
	 var n=temp.split("\\");
	  var file, img;
    if ((file = id.files[0])) {
        img = new Image();
        img.onload = function () {
		   $('#img_width').val(this.width)
		   $('#img_height').val(this.height)
        };
        img.src = _URL.createObjectURL(file);
    }	
	 img_name=n[n.length-1];
	 document.getElementById('prepage').style.visibility='visible';
	 document.getElementById('file1').disabled=true;
	<?php if($count_cnt<5){ ?>
	 document.getElementById('file').disabled=true;
	 <?php } ?>
	 check=1;
	 document.getElementById('photo_type').value='Profile';
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
	<?php if($count_cnt<5){ ?>
	document.getElementById('file').disabled=false;
	<?php } ?>
	document.getElementById('file1').disabled=false;
	if(check==1)
	{
		
		document.getElementById('test_img').innerHTML="<img src='upload/"+img_name+"' id='cropbox'/><div id='preview-pane'><div class='preview-container' id='preview_container'><img src='upload/"+img_name+"' class='jcrop-preview' id='Preview' /></div></div>";
	//document.getElementById('preview_container').innerHTML="<img src='upload/"+img_name+"' class='jcrop-preview' id='Preview' />";
		test();
		document.getElementById('img_name').value=img_name;
		$('#crop_submit').css('display','block');
		var w=parseInt($('#img_width').val());
		var h=parseInt($('#img_height').val())+parseInt(25);
		
		if(w>800)
		{
			w=780;
		}
		if(h>700)
		{
			h=680;
		}
		$('#inline_content').css('width',w+'px').css('height',h+'px');
		$('#crop_img_link').trigger("click");
		
	}
}
$('.cover_pic_btn1').live('click',function(){
	if( $('input[name=chkPic]:radio:checked').length > 0 ) {
		var pid=$('input[name=chkPic]:radio:checked').val();
		$.ajax({
			type:'POST',
			url:"ajax_cover_picture.php",
			data:'pid='+pid+'&uid=<?php echo $_SESSION['logged_user'][0]['id']; ?>',
			success: function(result)
			{
				window.location.reload();
			}
		});
	}
	else
	{
		$('.cover_error').trigger('click');
		//alert('Please First Select picture and make it Cover Picture.');
	}
	//alert('k');
});
$('.delete_btn1').live('click',function(){
	if( $('input[name=chkPic]:radio:checked').length > 0 ) {
		if(confirm('Are you sure to delete?'))
		{
			var pid=$('input[name=chkPic]:radio:checked').val();
			$.ajax({
				type:'POST',
				url:"ajax_cover_picture_del.php",
				data:'pid='+pid,
				success: function(result)
				{
					window.location.reload();
				}
			});
		}
	}
	else
	{
		$('.cover_delete').trigger('click');
		//alert('Please First Select picture.');
	}
	//alert('k');
});
</script> 
<style>
.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 2000;
  top: 10px;
  right: 10px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;
  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}
/* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
#preview-pane .preview-container {
  width: 130px;
  height: 130px;
  overflow: hidden;
}
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
.sel_picture ul{ width:435px; float:left;}
.sel_picture .sel_pic_button{ width:250px; float:right; margin-right:0;}
.sel_picture ul li{ position:inherit !important; }
.sel_picture ul li input[type="radio"]{ height:auto !important;position:inherit !important; }
.sel_picture ul li .popbox img{ width:auto !important; height:auto !important; }
.sel_picture ul li a.popper{ height:100px; display:block;}
</style>     
