<?php 
if($_GET['hint'] == 'curr_month')
{
	$sql="select * from members where is_deleted = 'N' order by id";
	$ans=$obj->select($sql);

	if(isset($_GET['duration']))
	
	{
	
		if($_GET['duration'] == 'weekly')
	
		{	
	
			$sql="select * from members where is_deleted = 'N' and reg_date between date_sub(now(),INTERVAL 1 WEEK) and now()";
			echo $sql;
	
			$ans=$obj->select($sql);
	
		}
	
		else
	
		{
	
			$sql="select * from members where is_deleted = 'N' and month = '".(date('m') - 1)."'";
	
			$ans=$obj->select($sql);
	
		}
	}
}

	$sql="select * from members where is_deleted = 'N' order by id";
	$ans=$obj->select($sql);

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

                    Reports

                </h3>

                <ul class="breadcrumb">

                    <li>

                        <i class="icon-home"></i>

                        <a href="dashboard.php">Home</a> 

                        <i class="icon-angle-right"></i>

                    </li>

                    <li>

                        <a href="list_user.php">Reports</a>                        

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

                        <div class="caption"><i class="icon-globe"></i>Reports</div>

                        

                    </div>

                    

                    <div class="portlet-body">

                    <div class="clearfix">

                            <div class="">

                                <a href="member_reports.php?duration=weekly">
                                <button id="sample_editable_1_new" class="btn green" style="margin-bottom:5px">

                                Last Week Report </button></a>

                                <a href="member_reports.php?duration=monthly"><button id="sample_editable_1_new" class="btn green" style="margin-bottom:5px">

                                Last Month Report

                                </button></a>

                            </div>

                            <div class="btn-group pull-right" style="display:none;">

                                <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>

                                </button>

                                <ul class="dropdown-menu">

                                    <li><a href="#">Print</a></li>

                                    <li><a href="#">Save as PDF</a></li>

                                    <li><a href="#">Export to Excel</a></li>

                                </ul>

                            </div>

                        </div>

                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                            <thead>

                                <tr>

                                    <th>Name</th>

                                    <th>Gender</th>

                                    <th>Religion</th>

                                    <th>Country</th>

                                    <th>Register On</th>

                                    <th>Action</th>      

                                </tr>

                            </thead>

                             

                             <?php for($i=0;$i<count($ans);$i++){?>

                                <tr class="odd gradeX">

                                    <td><?php echo $ans[$i]['name'];?></td>	

                                    <td><?php if($ans[$i]['gender'] == "M"){ echo "Male"; } else{ echo "Female"; }?></td>	

                                    <td><?php echo $ans[$i]['religion'];?></td>	

                                    <td><?php echo $ans[$i]['country'];?></td>	

                                    <td><?php echo $ans[$i]['reg_date'];?></td>	

                                    <td><span class="label label-success"><a style="color:#FFF" href="manage_member.php?id=<?php echo $ans[$i]['id'];?>">View</a></span></td>

                                                                            

                                </tr>

                                <? }?>

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

		window.location.href = 'list_user.php?id='+id;

	  }

	  else{

		  return false;

	  }

	  return true;

	}

</script>