<?php 

$sold_plans = "SELECT m.*,ms.*,mem.*,mp.photo,m.id as plan_number FROM member_plans m JOIN new_membership_plans ms ON ms.id = m.plan_id	JOIN members mem ON mem.id = m.member_id LEFT JOIN member_photos mp ON mp.member_id = mem.id";			   
$ans=$obj->select($sold_plans);
/*$sql="select member_plans.plan_id, membership_plans.plan_display_name,
			 members.email_id,members.name,members.id,
			 member_photos.photo,members.member_id,members.status
 	  from member_plans,membership_plans,members,member_photos
	  where member_plans.plan_id = membership_plans.id
	  		AND 
			member_plans.member_id = members.id
			AND
			 member_photos.member_id = members.id";
$ans=$obj->select($sql);*/
?>
<style>
.details { display:none; }
</style>
<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
            <h3>portlet Settings</h3>
        </div>
        <div class="modal-body">
            <p>Here will be a configuration form</p>
        </div>
    </div>
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- BEGIN PAGE CONTAINER-->        
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN STYLE CUSTOMIZER -->
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
                            <li class="color-grey" data-style="grey"></li>
                            <li class="color-white color-light" data-style="light"></li>
                        </ul>
                        <label>
                            <span>Layout</span>
                            <select class="layout-option m-wrap small">
                                <option value="fluid" selected>Fluid</option>
                                <option value="boxed">Boxed</option>
                            </select>
                        </label>
                        <label>
                            <span>Header</span>
                            <select class="header-option m-wrap small">
                                <option value="fixed" selected>Fixed</option>
                                <option value="default">Default</option>
                            </select>
                        </label>
                        <label>
                            <span>Sidebar</span>
                            <select class="sidebar-option m-wrap small">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected>Default</option>
                            </select>
                        </label>
                        <label>
                            <span>Footer</span>
                            <select class="footer-option m-wrap small">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected>Default</option>
                            </select>
                        </label>
                    </div>
                </div>
                <!-- END BEGIN STYLE CUSTOMIZER -->  
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Memebers Plan
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="members_plan.php">Members Plan</a>                        
                    </li>
                    
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-globe"></i>Members Plan</div>
                        
                    </div>
                    
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                        <?php if(!empty($ans)) { ?>
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>ID</th> 
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Date</th>   
                                    <th class="hidden-480">Action</th>                                    
                                </tr>
                            </thead>
                             
                            <tbody>
                            <?php $i=1; ?>
                            <?php foreach($ans as $res){?> 
                            
                            	<tr class="odd gradeX">
                                <?php if(isset($_GET['status'])) {  ?>
                                <td><input type="checkbox" name="chkActive[]" id="chkActive" value="<?php echo $res['id'] ?>" /></td>	
                                <?php } ?>
                                	<td><?php
											if($res['photo']!='')
											{
												$path =  "../upload/".$res['photo'];
												
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
													//echo '<img class="size" src="'.$path.'"/>';
													echo '<a href="javascript:;" class="popper" data-popbox="pop'.$i.'"><img src="'.$path.'" width="50px" height="50px" /></a>';
													echo '<div id="pop'.$i.'" class="popbox"><img src="'.$path.'" width="'.$width.'"  height="'.$height.'" /></div>';
													}else{
													if($res['gender']=='M')	
														echo '<img class="size" src="../images/male-user1.png"/>';
													else
														echo '<img class="size" src="../images/female-user1.png"/>';
												}
											}
											else
											{
												if($res['gender']=='M')	
													echo '<img class="size" src="../images/male-user1.png"/>';
												else
													echo '<img class="size" src="../images/female-user1.png"/>';
											}
										?>
                                    </td>
                                    <td><?php echo $res['member_id'];?></td>	
	                                <td><?php echo $res['name'];?></td>	
                                    <td><?php if($res['gender'] == "F") { echo "Female"; } else { echo "Male";  } ?></td>	
                                    <td><?php echo $res['status'];?></td>	
                                    <td><?php echo $res['purchase_date']; ?></td>	
                                    <td class="hidden-480"><span class="label label-success"><a style="color:#FFF" href="edit_members_plan.php?id=<?php echo $res['plan_number'] ?>&user_id=<?php echo $res['id']; ?>&plan_id=<?php echo $res['plan_id']; ?>" >Edit</a></span></td>                                    
                                </tr>
                            	<?php $i++; ?>
                                <? }?>                               
                            </tbody>
                            <?php }
							else{
								echo "No Records Found";
								} ?>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<script type="text/javascript">
	function doYouWantTo(id){
	  doIt=confirm('Do you want to delete it?');
	  if(doIt){
		window.location.href = 'list_caste.php?id='+id;
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