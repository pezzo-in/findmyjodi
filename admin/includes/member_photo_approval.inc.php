<?php 

if($_GET['status']=='profile')
{
	$sql = "SELECT members.member_id as mem_id,members.id as mid,members.email_id,members.name,member_photos.id as pid, member_photos.member_id as pmid,member_photos.photo,member_photos.Approve FROM members JOIN member_photos ON members.id=member_photos.member_id order by Approve";
}
else
{
	$sql = "SELECT distinct(member_photo_gallery.member_id) from member_photo_gallery order by Approve";
}

$res=$obj->select($sql);

if($_GET['status']=='profile' && isset($_GET['pdid']))
{
	$sqld="delete from member_photos where id = '".$_GET['pdid']."'";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'member_photo_approval.php?status=".$_GET['status']."' </script>";
}
if(isset($_GET['pdid']))
{
	$sqld="delete from member_photo_gallery where id = '".$_GET['pdid']."'";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'member_photo_approval.php?status=".$_GET['status']."' </script>";	
}
if(isset($_GET['paid']))
{
	$ss="select Approve from member_photos where id = '".$_GET['paid']."'";
	$s=$obj->select($ss);
	if($s[0]['Approve']=='0')
	{
	$sqld="UPDATE member_photos SET Approve = '1' where id = '".$_GET['paid']."'";
	$obj->edit($sqld);
	}
	else
	{
		$sqld="UPDATE member_photos SET Approve = '0' where id = '".$_GET['paid']."'";
		$obj->edit($sqld);
	}
        $_SESSION['reload']=1;
	echo "<script>window.location.href = 'member_photo_approval.php?status=".$_GET['status']."' </script>";	
}
if(isset($_GET['aid']))
{
	 
	$ss="select Approve from member_photo_gallery where id = '".$_GET['aid']."'";
	$s=$obj->select($ss);
	if($s[0]['Approve']=='0')
	{
		
	$sqld="UPDATE member_photo_gallery SET Approve = '1' where id = '".$_GET['aid']."'";
	$obj->edit($sqld);
	}
	else
	{
		$sqld="UPDATE member_photo_gallery SET Approve = '0' where id = '".$_GET['aid']."'";
		$obj->edit($sqld);
	}
        $_SESSION['reload']=1;
	echo "<script> window.location.href = 'member_photo_approval.php?status=".$_GET['status']."' </script>";	
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
            <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
            <!--<div class="btn-group" style="margin-bottom:10px; float:left;">
             <input type="submit" name="submit" class="btn blue" value="InActive">
             </div>-->
            <div class="portlet box green">
                    <div class="portlet-title">
<div class="caption"><i class="icon-globe"></i><?php if($_GET['status']=='profile'){ ?>Members Profile Photo Approval<?php }else{ ?> Members Photo Gallery<?php }?></div>
                        
                    </div>
                    
                    <div class="portlet-body">
					
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
						<?php if(!empty($res))
							  { ?>
                            <thead>
                                <tr>
                                      <th width="25px">#</th>
                                      <!--<th>Action</th>-->
                                      <th>Photo</th>
                                      <th>Member Id</th>
                                      <th>Member Name</th>
                                      <th>Email</th>
                                      <th>Approve/Unapprove</th> 
                                      <th>Crop/rotate</th>
                                       <th>Delete</th> 
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php for($i=0;$i<count($res);$i++){?>
                                
                                 
                                 
                                <?php
								if($_GET['status']=='profile')
								{
									?>
                                    <tr class="odd gradeX">
                                    <td><?php echo ($i+1);?></td>
                                    <td><?php
                                                if(!empty($res[$i]['photo']))
                                                {
                                                    $path =  '../upload/'.$res[$i]['photo'];
													list($width, $height, $type, $attr) = getimagesize($path);
													if($width > 200)
													{
														
														$height = (($height*200)/$width);
														$width = 200;
													}
													else
													{
														
														$width = (($width*200)/$height);
														$height = 200;
													}
													
													//echo '<img class="size" src="'.$path.'"/>';
					echo '<a href="javascript:;" class="popper" data-popbox="pop'.$i.'"><img src="'.$path.'" width="50px" height="50px" /></a>';
					echo '<div id="pop'.$i.'" class="popbox"><img src="'.$path.'" width="'.$width.'"  height="'.$height.'" /></div>';
													
                                                }
                                                else
                                                {
													echo '<img class="size" src="../images/a1.jpg"/>';
                                                }
                                            ?>
                                        </td>
                                    
                                    
                                         <td><?php echo $res[$i]['mem_id'];?></td>	   
                                        <td><?php echo $res[$i]['name'];?></td>	
                                         <td><?php echo $res[$i]['email_id'];?></td>
                                         <td><?php 
										 if($res[$i]['Approve'] == "0")
										 {
										  ?>
          <a onClick="return doYouWantToChangeStatus('<?php echo $_GET['status']; ?>','<?php echo $res[$i]['pid']; ?>')" class="btn mini green">Unapprove</a>
										  <?php 
										 }
										 else
										 {?>
          <a onClick="return doYouWantToChangeStatus('<?php echo $_GET['status']; ?>','<?php echo $res[$i]['pid']; ?>')" class="btn mini yellow">Approve</a>
										<?php 
										 }?>
                                         </td>	 
                                    
<td width="80px"><a href="crop_image.php?eid=<?php echo $res[$i]['pid']; ?>&imgtyp=profile" class="btn mini blue"><i class="icon-edit"></i>Crop</a>
<a href="rotate_image.php?eid=<?php echo $res[$i]['pid']; ?>&imgtyp=profile" class="btn mini blue"><i class="icon-edit"></i>Rotate</a>
</td>
                                    
                                   <td width="80px">
<a onClick="return doYouWantTo('<?php echo $res[$i]['pid']; ?>','<?php echo $_GET['status']; ?>')" class="btn mini red"><i class="icon-edit"></i>Delete</a>
									</td>        
                                    </tr>
                                    <?php
								}
								else
								{
$select_photo_gallery="select member_photo_gallery.*,member_photo_gallery.id as gid ,members.* from member_photo_gallery  left join members on member_photo_gallery.member_id=members.id where member_photo_gallery.member_id='".$res[$i]['member_id']."' order by member_photo_gallery.id";

									$db_photo_gallery=$obj->select($select_photo_gallery);
									if($_GET['status']=='photo1')
									{
										$img=$db_photo_gallery[0]['photo'];
										$approve=$db_photo_gallery[0]['Approve'];
										$id=$db_photo_gallery[0]['gid'];										
									}
									if($_GET['status']=='photo2')
									{
										$img=$db_photo_gallery[1]['photo'];
										$approve=$db_photo_gallery[1]['Approve'];
										$id=$db_photo_gallery[1]['gid'];
									}										
									if($_GET['status']=='photo3')
									{
										$img=$db_photo_gallery[2]['photo'];
										$approve=$db_photo_gallery[2]['Approve'];
										$id=$db_photo_gallery[2]['gid'];
									}										
									if($_GET['status']=='photo4')
									{
										$img=$db_photo_gallery[3]['photo'];
										$approve=$db_photo_gallery[3]['Approve'];
										$id=$db_photo_gallery[3]['gid'];
									}										
									if($_GET['status']=='photo5')
									{
										$img=$db_photo_gallery[4]['photo'];										
										$approve=$db_photo_gallery[4]['Approve'];
										$id=$db_photo_gallery[4]['gid'];
									}
									
									if(file_exists('../upload/'.$img) && $img!='')
									{
									?>
									<tr class="odd gradeX">
									<td><?php echo ($i+1);?></td>
									<?php /*?><td><input type="checkbox" name="chkActive[]" id="chkActive" value="<?php echo $res[$i]['id'] ?>" /></td>	<?php */?>
									<td>
										<?php
												if(!empty($img))
												{
													$path =  '../upload/'.$img;
													list($width, $height, $type, $attr) = getimagesize($path);
													if($width > 200)
													{
														
														$height = (($height*200)/$width);
														$width = 200;
													}
													else
													{
														
														$width = (($width*200)/$height);
														$height = 200;
													}
													if (file_exists($path)) { 
				echo '<a href="javascript:;" class="popper" data-popbox="pop'.$i.'"><img src="'.$path.'" width="50px" height="50px" /></a>';
				echo '<div id="pop'.$i.'" class="popbox"><img src="'.$path.'" width="'.$width.'"  height="'.$height.'" /></div>';
													}else{
														echo '<img class="size" src="../images/a1.jpg"/>';
													}
												}
												else
												{
													echo '<img class="size" src="../images/a1.jpg"/>';
												}
											?>
										</td>
									<?php
									$sql_db = "SELECT * FROM members where id=".$res[$i]['id'];
									$sql_db = $obj->select($sql_db);
									?>
									
										 <td><?php echo $db_photo_gallery[0]['member_id'];?></td>	   
										<td><?php echo $db_photo_gallery[0]['name'];?></td>	
										 <td><?php  echo $db_photo_gallery[0]['email_id'];?></td>
										 <td><?php 
										 if($approve == 0)
										 {
										  ?>
                                          <a onClick="return doYouWantToChangeStatusPhoto1('<?php echo $_GET['status']; ?>','<?php echo $id; ?>')" class="btn mini green">Unapprove</a>
										  <?php 
										 }
										 else
										 {?>
                                         <a onClick="return doYouWantToChangeStatusPhoto1('<?php echo $_GET['status']; ?>',
                                         '<?php echo $id; ?>')" class="btn mini yellow">Approve</a>
										<?php 
										 }?>
                                         </td>
 <td width="80px"><a href="crop_image.php?eid=<?php echo $id; ?>&imgtyp=gallery&status=<?php echo $_GET['status']; ?>" class="btn mini blue"><i class="icon-edit"></i>Crop</a>
     <a href="rotate_image.php?eid=<?php echo $id; ?>&imgtyp=gallery&status=<?php echo $_GET['status']; ?>" class="btn mini blue"><i class="icon-edit"></i>Rotate</a>
 </td>
<td width="80px"><a onClick="return doYouWantTo('<?php echo $id; ?>','<?php echo $_GET['status']; ?>')" class="btn mini red"><i class="icon-edit"></i>Delete</a></td>        
									</tr>
									<?
										}
								}
								}
							?>                      
                            </tbody>
						<?php }
							else{
								echo "No Records Found";
								}?> 
                        </table>
                       	
                      
                    </div>
                </div>
                 </form>
            </div>
	    </div>
    </div> 
</div>
<script type="text/javascript">
function doYouWantToChangeStatusPhoto1(status,id){
	 doIt=confirm('Are you sure to change status?');
	  if(doIt){
                $.ajax({ 
				url: 'watermark.php',
				type:'post',
                                async:false,
				data: { 
                                    id:id,
                                     status:status
                                     },
				success: function(data) {
			
				}
			});  
              
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
                  $.ajax({ 
				url: 'watermark.php',
				type:'post',
                                async:false,
				data: { 
                                    id:id,
                                     status:status
                                     },
				success: function(data) {
			          
				}
			});  
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
</style>