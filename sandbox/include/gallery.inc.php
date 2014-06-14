<?php
session_start();
?>
<?php
if(isset($_FILES['file1']) && $_FILES['file1']['name']!='')
{
	//echo'hello';
	
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
			
			$insert_data="insert into member_photo_gallery(id,member_id,photo,Approve,Cover_photo,Status)values(NULL,'".$_SESSION['logged_user'][0]['id']."','".$fileName1."','0','0','0')";
			
			$db_insert=$obj->insert($insert_data);
			mysql_insert_id();
			
			$_SESSION['gallery_pic']=$fileName1;
			
	}
	echo '<script>window.location.href="gallery.php"</script>';
}
?>
<div class="content">
<div class="about_right">
<h2 style="text-align:left">Approved Album Photos</h2>
<?php
if($_GET['id']!='')
{
	$select_photo="select * from member_photo_gallery where member_id='".$_GET['id']."' AND Approve=1";
}
else
{
	$select_photo="select * from member_photo_gallery where member_id='".$_SESSION['logged_user'][0]['id']."' AND Approve=1";
}
$img=$obj->select($select_photo);
?>
	<?php if($_GET['id'] == '')
{
    ?>
    <ul class="profl-list">
    <?php 

	if(count($img)>0)
	{
	for($i=0;$i<count($img);$i++){ ?>
      <li>
          <div class="profile-img-box"> <a href="javascript:;" class="popper" data-popbox="pop<?php echo $img[$i]['id']; ?>"> <img title="" data-popbox="pop				<?php echo $img[$i]['id']; ?>" class="profile_pic popper" src="upload/<?php echo $img[$i]['photo']; ?>">
            <div id="pop<?php echo $img[$i]['id']; ?>" class="popbox"><img src="upload/<?php echo $img[$i]['photo']; ?>"></div>
            </a>
          </div>
        </li>
<?php } ?>
<?php }else{ 
		 	    $select_photo11="select * from member_photo_gallery where member_id='".$_SESSION['logged_user'][0]['id']."' AND Approve=0";
			   $db_photo11=$obj->select($select_photo11);
			    if(count($db_photo11) == 0){ ?>
					<li><span style="font-size: 15px; padding:10px 0;">No Gallery Picture Uploaded.</span></li>
						<?php }else{ ?><li><span style="font-size: 15px;padding: 10px 0;">Gallery Picture Uploaded Successfully, Waiting for admin approval.</span></li><?php }
		
		 } ?>
    </ul>
</div>
<div>

<h2 style="text-align:left">Unapproved Album Photos</h2> 
                    <div style="float:left; margin-top:10px;">
                    <?php
$glry="select * from member_photo_gallery where member_id='".$_SESSION['logged_user'][0]['id']."' AND Approve=0";
$dbglry=$obj->select($glry);
for($i=0;$i<count($dbglry);$i++)
{
	
								 ?>
<img src="upload/<?php echo $dbglry[$i]['photo']; ?>" height="75" width="75" style="margin-right:5px; border-right:solid 1px #CCC;" /> 
<?php }  ?>
</div>
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
                   
                <form name="file_upload1" method="post" action="" enctype="multipart/form-data" style="padding-top:25px;clear:both;">
                    <h2 style="text-align:left;">Upload Photos in your Gallery</h2>
                    <span id="img">
                        <div style="float:left ">
                        	<input type="file" id="file2" name="file1" class="inputfile" onchange="this.form.submit();" /><br />
                        </div>
                	</span>
					</form>
     				<?php } ?>
                    </div>
                    </div>
 <?php } else { ?>
 	<ul class="profl-list">
    <?php 

	if(count($img)>0)
	{
	for($i=0;$i<count($img);$i++){ ?>
      <li>
          <div class="profile-img-box"> <a href="javascript:;" class="popper" data-popbox="pop<?php echo $img[$i]['id']; ?>"> <img title="" data-popbox="pop				<?php echo $img[$i]['id']; ?>" class="profile_pic popper" src="upload/<?php echo $img[$i]['photo']; ?>">
            <div id="pop<?php echo $img[$i]['id']; ?>" class="popbox"><img src="upload/<?php echo $img[$i]['photo']; ?>"></div>
            </a>
          </div>
        </li>
<?php } ?>
<?php }else{ 
		 	   $select_photo_request="select * from photo_request where from_mem_id='".$_SESSION['logged_user'][0]['id']."' AND to_mem_id='".$_GET['id']."'";
			  $db_photo_request=$obj->select($select_photo_request);
			  if(count($db_photo_request) == 0 && $_GET['id'] != ''){
			  ?> 
	<span style="font-size: 15px;font-weight: bold;padding: 10px; float:left;">This member have not uploaded any pictures yet.</span>
    <?php if($_GET['id']!=$_SESSION['logged_user'][0]['id']) { ?><span id="success_msg" style="font-size: 15px;font-weight: bold;padding: 10px; float:left;"> Send a Photo request.</span>&nbsp;&nbsp;<a id="photo_button" onclick="send_photo('<?php echo $_SESSION['logged_user'][0]['id']; ?>','<?php echo $_GET['id']; ?>')" href="javascript:;"><img src="images/send_btn.png" alt="" /></a>
<?php } ?>
	<?php }else{ ?><span style="font-size: 15px;font-weight: bold;padding: 10px;">This member have not uploaded any pictures yet. Photo request send</span><?php }
		
		 } ?>
    </ul>
 </div>
 <?php } ?>       
<style>
ul.profl-list{ margin-top:13px;}
ul.profl-list li{ height:auto; }
ul.profl-list li .profile-img-box a.popper{ min-height:inherit; }
ul.profl-list li .profile-img-box{ position:inherit; }
.profile-img-box{ position:inherit; }
</style>
<script>
	function send_photo(from_mem,to_mem)
{
	$.ajax({
			url:'include/send_photo_req.php',
			data:{to_mem:to_mem,from_mem:from_mem},
			type:'POST',
			success: function(data)
			{
				if(data=='1')
				{
					$('#success_msg').text('Photo Request Sent');
					$('#photo_button').remove();
				}
			}
			});
}
</script>