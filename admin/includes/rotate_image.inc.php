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
                <h3 class="page-title"> <?php if($_GET['status']=='profile'){ ?> Members Profile Photo Approval<?php }else{ ?> Members Photo Gallery <?php } ?></h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <i class="icon-angle-right"></i> 
                    </li>
                    <li><?php if($_GET['status']=='profile'){ ?>Members Profile Photo Approval<?php }else{ ?> Members Photo Gallery<?php } ?></li>							
                </ul>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">			
            
            <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-globe"></i><?php if($_GET['status']=='profile'){ ?>Members Profile Photo Approval<?php }else{ ?> Members Photo Gallery<?php }?></div>
                        
                    </div>
                    
                    <div class="portlet-body">
					<div class="new_acc" style="margin-top:10px;"> 
                                <form action="" method="post"  enctype="multipart/form-data">
                                  <div id="test_img"><img src=''  /></div>
                                  
                                    
                                    <input type="hidden" id="eid" name="eid" value="<?php echo $_REQUEST['eid']; ?>"/>
                                  
                                   
                                </form>
                                </div>
                        <div> <button type="button" onclick="rotateimage('<?php echo $proimagename; ?>','<?php echo $_REQUEST['eid']; ?>');" class="submit_btn_new">Rotate</button>
                           <?php if($_REQUEST['imgtyp']==profile){ ?>   <button type="button" onclick="location.href='member_photo_approval.php?status=profile'" class="submit_btn_new">Done</button> <?php } else {?>
                             <button type="button" onclick="location.href='member_photo_approval.php?status=<?php echo $_REQUEST['status'] ?>'" class="submit_btn_new">Done</button> <?php } ?>
                        </div>
                    </div>

            </div>
	    </div>
    </div> 
</div>
<script type="text/javascript">
   function rotateimage(proimgname,eid)
   {
      
    $.ajax({ 
				url: 'rotateprofileimage.php',
				type:'post',
                                async:false,
				data: { proimgname:proimgname  },
				success: function(data) {
					var result=data;
                                      
                                        if(result==1){
                                         window.location.reload();
                                       //window.location.href='rotate_image.php?eid='+eid+'&imgtyp=profile';
                                        }
				}
			});
 
   }
   
  
</script>
<style>

</style>