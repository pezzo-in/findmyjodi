<?php 
/*$sold_plans = "SELECT m.*,ms.*,mem.* 
			   FROM member_plans m JOIN membership_plans ms ON ms.id = m.member_id
			   JOIN members mem ON mem.id = m.member_id";			  */
$sold_plans = "SELECT m.*,ms.*,mem.*,mp.photo 
			   FROM member_plans m JOIN new_membership_plans ms ON ms.id = m.plan_id
			   		JOIN members mem ON mem.id = m.member_id
			   		JOIN member_photos mp ON mp.member_id = mem.id";			   
$ans=$obj->select($sold_plans);
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
                    Sales Reports
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="sales_report.php">Sales Report</a>                        
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
                        <div class="caption"><i class="icon-globe"></i>Sales Report</div>
                        
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
                                    <th>Manage</th> 
                                </tr>
                            </thead>
                             
                            <tbody>
                           <?php foreach($ans as $res){?>
                                <tr class="odd gradeX">
                                <?php if(isset($_GET['status'])) {  ?>
                                <td><input type="checkbox" name="chkActive[]" id="chkActive" value="<?php echo $res['id'] ?>" /></td>	
                                <?php } ?>
                                	<td><?php
											$path =  $_SERVER['DOCUMENT_ROOT']."/upload/".$res['photo'];
											if (file_exists($path)) { 
												echo '<img class="size" src="'."../upload/".$res['photo'].'"/>';
											}else{
												echo '<img class="size" src="../images/a1.jpg"/>';
												}
										?>
                                    </td>
                                    <td><?php echo $res['member_id'];?></td>	
	                                <td><?php echo $res['name'];?></td>	
                                    <td><?php if($res['gender'] == "F") { echo "Female"; } else { echo "Male";  } ?></td>	
                                    <td><?php echo $res['status'];?></td>	
                                    <td><?php echo date('d M Y',strtotime($res['reg_date']));?></td>	
                                    <td width="80px"><a href="manage_member.php?id=<?php echo $res['id']; ?>" class="btn mini purple"><i class="icon-edit"></i>View</a></td>                                        
                                </tr>
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