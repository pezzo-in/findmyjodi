<?php
	$sql = "SELECT distinct plan_name from membership_plans";			 			  
	$data=$obj->select($sql);
	
	$lastid = "select max(id) as last_id from members";
	$ans = $obj->select($lastid);
	
	if(isset($_POST['submit']))
	{
			/*$select_category = "SELECT max(id) as id FROM members";
			$db_member = $obj->select($select_category);*/
		
				$fileLink =  "upload/". $_FILES['file']['name'][0];
				$fileType = $_FILES['file']['type'][0];
				$fileSize = ($_FILES['file']['type'][0]) / 1024;
				$source = "$fileLink";
                                
				if ((move_uploaded_file($_FILES["file"]["tmp_name"][0], $source))) {
					$insert="INSERT into member_photos(id,member_id,photo)values(NULL,'".$_SESSION['logged_user'][0]['id']."','".$_FILES["file"]["name"][0]."')";				
					$db_ins=$obj->insert($insert);
				}			
		
		echo "<script>window.location='my_account.php'</script>";
	}
	
?>
<div class="mid">
<?php if($_GET['flag'] != 'from_menu') { ?>
<div class="backtolink"><a href="my_account.php">&nbsp;&nbsp;&nbsp;Continue To Home Page »</a></div>
<?php } ?>
			
            <h3>Upload multiple photos to increase your response.</h3>
Adding photo makes your profile complete, authentic and delivers more response. Add as many photos as possible, with a maximum of 10 photos. It's best to have your photograph taken by a professional.
		<form name="photo_upload_form" method="post" style="padding-top:30px" enctype="multipart/form-data">
        	<div class="new_acc">
            <input type="file" name="file[]" multiple="multiple"id="file" style="color:black" /><br clear="all" />
            <input type="submit" name="submit">
            </div>
         </form>   
        </div>