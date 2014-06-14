<?php 

	$sql = "SELECT * FROM education_course where EId='".$_GET['eid']."' ";
	$ans=$obj->select($sql);


/*if(isset($_GET['id']))
{
	$sqld="delete from education_course where Id = '".$_GET['id']."' ";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'list_education_course.php' </script>";	
}*/
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
                    List Education Courses
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="list_education_levels.php">List Education Levels</a>                        
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
                    <a href="add_new_education_course.php?eid=<?php echo $_GET['eid'];?>"><button id="sample_editable_1_new" class="btn green">
                    Add New <i class="icon-plus"></i>
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-globe"></i>List Education Courses</div>
                        
                    </div>
                    
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                            <thead>
                                <tr>
                                	<th style="display:none"></th>
                                    <th width="25px">#</th>
                                    <!--<th>Degree In</th>-->
                                    <th>Education Level</th>      
                                    <th>Course</th>                             
                                    <th class="hidden-480" width="100px">Manage</th>
                                </tr>
                            </thead>
                             
                            <tbody>
                            <?php for($i=0;$i<count($ans);$i++){?>
                                <tr>
                                	<td style="display:none"></td>
                                    <td><?php echo ($i+1);?></td>
                                    <?php /*?><td><?php echo $ans[$i]['name'];?></td><?php */?>
                                    <?php 	$sql1 = "SELECT * FROM education_details where id='".$_GET['eid']."' ";
											$ans1=$obj->select($sql1); ?>
                                    <td><?php echo $ans1[0]['degree'];?></td>
                                     <td><?php echo $ans[$i]['Title'];?></td>	  	                                    
                                    <td class="hidden-480">
                                    <a href="add_new_education_course.php?id=<?php echo $ans[$i]['Id'];?>&eid=<?php echo $_GET['eid']; ?>" class="btn mini green"><i class="icon-edit"></i> Manage</a>
                                    </td>
                                   <?php /*?> <td class="hidden-480">
                                    <a href="add_new_education_level.php?id=<?php echo $ans[$i]['id'];?>" class="btn mini purple"><i class="icon-edit"></i> Manage</a>
                                    </td><?php */?>
                                </tr> 
                                <? }?>                               
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
<!--<script type="text/javascript">
	function doYouWantTo(id){
	  doIt=confirm('Do you want to delete it?');
	  if(doIt){
		window.location.href = 'list_education_course.php?id='+id;
	  }
	  else{
		  return false;
	  }
	  return true;
	}
</script>-->