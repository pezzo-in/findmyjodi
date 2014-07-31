<?php 
if(isset($_REQUEST['eid']) && $_REQUEST['eid']!='')
{
	if($_REQUEST['imgtyp']=='profile')
	{
		$select="select * from member_photos where id='".$_REQUEST['eid']."'";
		$image=$obj->select($select);
	}
	else
	{
			$select="select * from member_photo_gallery where id='".$_REQUEST['eid']."'";
			$image=$obj->select($select);
	}
        $proimagename=$image[0]['photo'];
}
if($_REQUEST['crop_submit'])
{
	$targ_w = $_POST['w'];
	$targ_h = $_POST['h'];
	$jpeg_quality = 90;
	$src = $_POST['img_name'];
	$img_r = imagecreatefromjpeg('../upload/'.$src);
	$dst_r = ImageCreateTrueColor($targ_w, $targ_h);
	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
	
	imagejpeg($dst_r,'../upload/'.$src,$jpeg_quality);
	$user="select * from member_photos where Id='".$_REQUEST['eid']."'";
	$dbuser=$obj->select($user);
	
	if($_POST['photo_type']=='gallery')
	{
		$update_data = "update member_photo_gallery set photo='".$src."' where id=eid" ;
		$db_insert=$obj->edit($update_data);
		
		/*$insert_data="insert into member_photo_gallery(id,member_id,photo)values(NULL,'".$dbuser[0]['member_id']."','".$src."')";
		$db_insert=$obj->insert($insert_data);*/
		echo '<script>window.location.href ="member_photo_approval.php?status='.$_REQUEST['status'].'"</script>';
	}
	else if($_POST['photo_type']=='profile')
	{
		$sql = "select * from member_photos where member_id = '".$dbuser[0]['member_id']."'";
		$chk_exist_photo = $obj->select($sql);
		if(!empty($chk_exist_photo))
		{		
			$update_pic = "update member_photos set photo = '".$src."', Approve=0 where member_id = '".$dbuser[0]['member_id']."'";
			$ans = $obj->edit($update_pic);
		}
		else
		{
			$insert = "insert into member_photos (id,member_id,photo) value (NULL,'".$dbuser[0]['member_id']."','".$src."')";
			$res = $obj->insert($insert);			
		}
		echo '<script>window.location.href = "member_photo_approval.php?status=profile"</script>';
	}
}
?> 
<div class="page-content">
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
            <h3>portlet Settings</h3>
        </div>
        <div class="modal-body">
            <p>Here will be a configuration form</p>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="color-panel hidden-phone">
                    <div class="color-mode-icons icon-color"></div>
                    <div class="color-mode-icons icon-color-close"></div>
                    <div class="color-mode">
                        <p>THEME COLOR</p>
                        <ul class="inline">
                            <li class="color-black current color-default" data-style="default"></li>
                            <li class="color-blue" data-style="blue"></li>
                            <li class="color-brown" data-style="brown"></li>
                            <li class="color-purple" data-style="purple"></li>
                            <li class="color-white color-light" data-style="light"></li>
                        </ul>
                        <label class="hidden-phone">
                        <input type="checkbox" class="header" checked value="" />
                        <span class="color-mode-label">Fixed Header</span>
                        </label>							
                    </div>
                </div>
                <h3 class="page-title"> <?php if($_GET['status']=='profile'){ ?> Members Profile Photo Approval<?php }else{ ?> Members Photo Gallary <?php } ?></h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <i class="icon-angle-right"></i> 
                    </li>
                    <li><?php if($_GET['status']=='profile'){ ?>Members Profile Photo Approval<?php }else{ ?> Members Photo Gallary<?php } ?></li>							
                </ul>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">			
            
            <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-globe"></i><?php if($_GET['status']=='profile'){ ?>Members Profile Photo Approval<?php }else{ ?> Members Photo Gallary<?php }?></div>
                        
                    </div>
                    
                    <div class="portlet-body">
					<div class="new_acc" style="margin-top:10px;"> 
                                <form action="" method="post" onsubmit="return checkCoords();" enctype="multipart/form-data">
                                  <div id="test_img"><img src='' id='cropbox' /></div>
                                    <input type="hidden" id="img_height" value="" />
                                    <input type="hidden" id="img_width" value="" />
                                    <input type="hidden" id="img_name" name="img_name" />
                                    <input type="hidden" id="photo_type" name="photo_type"  value="<?php echo $_REQUEST['imgtyp']; ?>"/>
                                    <input type="hidden" id="x" name="x" />
                                    <input type="hidden" id="y" name="y" />
                                    <input type="hidden" id="w" name="w" />
                                    <input type="hidden" id="h" name="h" />
                                    <input type="hidden" id="status" name="status" value="<?php echo $_REQUEST['status']; ?>" />
                                    
                                    <input type="hidden" id="eid" name="eid" value="<?php echo $_REQUEST['eid']; ?>"/>
                                   <input type="submit" value="Crop Image" name="crop_submit" id="crop_submit" style="display:none" class="submit_btn_new" />
                                  
                                </form>
                                </div>
                    </div>

            </div>
	    </div>
    </div> 
</div>
<script type="text/javascript">

   
  function doYouWantToChangeStatusPhoto1(status,id){
	 doIt=confirm('Are you sure to change status?');
	  if(doIt){
		window.location.href = 'member_photo_approval.php?status='+status+'&aid='+id;
	  }
	  else{
		  return false;
	  }
	  return true;
	}
 function doYouWantToChangeStatus(status,id){
	 doIt=confirm('Are you sure to change status?');
	  if(doIt){
		window.location.href = 'member_photo_approval.php?status='+status+'&paid='+id;
	  }
	  else{
		  return false;
	  }
	  return true;
	}
	function doYouWantTo(id,status){
	  doIt=confirm('Are you sure you want to delete?');
	  if(doIt){
		window.location.href = 'member_photo_approval.php?pdid='+id+'&status='+status;
	  }
	  else{
		  return false;
	  }
	  return true;
	}
</script>
<style>
.size
{
	width:50px;
	height:50px;
}
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
.sel_picture ul li{ position:inherit !important; }
.sel_picture ul li input[type="radio"]{ height:auto !important;position:inherit !important; }
.sel_picture ul li .popbox img{ width:auto !important; height:auto !important; }
</style>