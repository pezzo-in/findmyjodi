<?php 
$sql="select * from success_member_details order by id";
$res=$obj->select($sql);
if(isset($_GET['id']))
{
	$sqld="delete from role admin id = '".$_GET['id']."' ";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'list_user.php' </script>";	
}
//query to check access permission
$sql="select * from  admin where id='".$_SESSION['id']."'";
$ans=$obj->select($sql);	
$sql2="select * from  role where id='".$ans[0]['role_id']."'";
$ans2=$obj->select($sql2);	
$mem_permission = explode(",",$ans2[0]['member_access']); 
$story_permission = explode(",",$ans2[0]['member_story_access']); 
$plan_permission = explode(",",$ans2[0]['member_plan_access']); 
//end
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
                    List Story
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="list_members_story.php">List Story</a>                        
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
                <div class="btn-group" style="margin-bottom:10px; float:right">
                    <a href="add_new_story.php"><button id="sample_editable_1_new" class="btn green">
                    Add New <i class="icon-plus"></i>
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-globe"></i>List Story</div>
                        
                    </div>
                    
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                            <thead>
                                <tr>
                                	<th style="display:none"></th>
                                     <th width="25px">#</th>
                                     <th>Bride</th>
                                     <th>Groom</th>
                                     <th>Status</th>
                                     <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody> 
                            <tbody>
                           <?php for($i=0;$i<count($res);$i++){?>
                                <tr class="odd gradeX">
                                	<td style="display:none"></td>
									<td><?php echo ($i+1);?></td>
                                    <?php $member_bride = "select id from members where member_id='".$res[$i]['bride_matr_id']."'";
											$db_bride = $obj->select($member_bride);
											
										$member_groom = "select id from members where member_id='".$res[$i]['groom_matr_id']."'";
											$db_groom = $obj->select($member_groom);
									
									?>
									<td><a href="view_member_profile.php?id=<?php echo $db_bride[0]['id']; ?>"><?php echo $res[$i]['bride_name'];?></a></td>	
                                    <td><a href="view_member_profile.php?id=<?php echo $db_groom[0]['id']; ?>"><?php echo $res[$i]['groom_name'];?></a>
                                    <td><?php echo $res[$i]['status'];?>
                                    </td>	
                                     <td width="80px"><a href="manage_story.php?id=<?php echo $res[$i]['id']; ?>" class="btn mini purple"><i class="icon-edit"></i> Manage</a></td> 
                                </tr>
                                <? }?>
                                
                            </tbody>                             
                            </tbody>
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
		window.location.href = 'list_religions.php?id='+id;
	  }
	  else{
		  return false;
	  }
	  return true;
	}
</script>