<?php

if(isset($_POST['submit']))

{

	$is_exist = "select * from membership_plans where plan_name = '".$_POST['p_name']."'";

	$db_exist = $obj->select($is_exist);



	/*if(empty($db_exist))

	{*/

		$insert="INSERT into membership_plans(id, plan_name, plan_display_name ,plan_duration,plan_amount)

				 values

				(NULL, '".$_POST['p_name']."','".$_POST['p_display_name']."','".$_POST['drpDuration']."','".$_POST['p_amount']."')";

		$db_ins=$obj->insert($insert);	

		echo "<script>window.location='list_plans.php'</script>";

	/*}&/

	/*else

	{

		$error= "Error : Plan already exist";

	}*/

}

if(isset($_POST['update']))

{	

	$is_exist = "select * from membership_plans where plan_name = '".$_POST['p_name']."' and id != '".$_GET['id']."'";

	$db_exist = $obj->select($is_exist);

	/*if(empty($db_exist))

	{*/

		$update_page="UPDATE membership_plans 

					  SET 

						  plan_name = '".$_POST['p_name']."',plan_display_name = '".$_POST['p_display_name']."', 

						  plan_duration = '".$_POST['drpDuration']."',plan_amount = '".$_POST['p_amount']."'

					  where 

					  	  id = '".$_GET['id']."'";

					  

		$db_updatepage=$obj->edit($update_page);	

		echo "<script>window.location='list_plans.php'</script>";

	/*}

	else

	{

		$error= "Error : Plan already exist";

	}*/

}

$select_category = "select * from membership_plans where id = '".$_GET['id']."'";

$db_category = $obj->select($select_category);



?>

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

                <h3 class="page-title">

                    Plans                    

                </h3>

                <ul class="breadcrumb">

                    <li>

                        <i class="icon-home"></i>

                        <a href="dashboard.php">Home</a> 

                        <span class="icon-angle-right"></span>

                    </li>

                    <li>

                        <a href="list_plans.php">List Plans</a>

                        <span class="icon-angle-right"></span>

                    </li>

                    <li><a href="#">Plans</a></li>

                </ul>

            </div>

        </div>

        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->

        

        

        <div class="row-fluid">

            <div class="span12">

                <!-- BEGIN VALIDATION STATES-->

                <div class="btn-group" style="margin-bottom:10px; float:right">

                    <a href="list_plans.php"><button id="sample_editable_1_new" class="btn green">

                    List Plans

                    </button></a>

                </div>

                <div class="portlet box green">

                    <div class="portlet-title">

                        <div class="caption"><i class="icon-reorder"></i>Plans</div>

                        

                    </div>

                    <div class="portlet-body form">

                        <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">

              <div class="alert alert-error hide">

                <button class="close" data-dismiss="alert"></button>

                You have some form errors. Please check below. </div>

              <div class="control-group">
					 <?php if (isset($error)) { echo "<p class='message'>" .$error. "</p>" ;} ?>
                <label class="control-label">Plan Name<span class="required">*</span></label>

                <div class="controls">

                  <input type="text" name="p_name" value="<?php if(isset($_POST['p_name'])){ echo $_POST['p_name']; } echo $db_category[0]['plan_name']; ?>" class="span6 m-wrap required"/>

                </div>

              </div>

              <div class="control-group">

                <label class="control-label">Plan Display Name<span class="required">*</span></label>

                <div class="controls">

                  <input type="text" name="p_display_name" value="<?php if(isset($_POST['p_display_name'])) { echo $_POST['p_display_name']; } echo $db_category[0]['plan_display_name']; ?>" class="span6 m-wrap required"/>

                </div>

              </div>

              <div class="control-group">

                <label class="control-label">Plan Duration<span class="required">*</span></label>

                <div class="controls">

                <select class="span6 m-wrap required" name="drpDuration">

                	<option value="">---Select---</option>

                	<option value="365" <?php  if($_POST['drpDuration'] == "365") { ?> selected="selected" <?php  } elseif($db_category[0]['plan_duration'] == "365"){?> selected="selected" <?php } ?>>365‌ days‌ - (12-Months)</option>

                    <option value="180" <?php if($_POST['drpDuration'] == "180") { ?> selected="selected" <?php  } elseif($db_category[0]['plan_duration'] == "180"){?> selected="selected" <?php } ?>>180 days - (6-Months)</option>
                    
                    <option value="270" <?php if($_POST['drpDuration'] == "270") { ?> selected="selected" <?php  } elseif($db_category[0]['plan_duration'] == "270"){?> selected="selected" <?php } ?>>270 days - (9-Months)</option>

                    <option value="90" <?php if($_POST['drpDuration'] == "90") { ?> selected="selected" <?php  } elseif($db_category[0]['plan_duration'] == "90"){?> selected="selected" <?php } ?>>90 days - (3-Months)</option>

                </select>

                 

                </div>

              </div>

              <div class="control-group">

                <label class="control-label">Plan Amount<span class="required">*</span></label>

                <div class="controls">

                  <input type="text" name="p_amount" value="<?php if(isset($_POST['p_amount'])){ echo $_POST['p_amount']; } echo $db_category[0]['plan_amount']; ?>" class="span6 m-wrap required"/>

                </div>

              </div>

              <div class="form-actions">

                <?php if($_GET['id'] == '') { ?>

                <input type="submit" name="submit" class="btn blue" value="Add">

                <?php } else { ?>

                <input type="submit" name="update" class="btn blue" value="Edit Plan">
				 <a href="add_new_plan.php?did=<?php echo $_GET['id']; ?>" onclick="return delete_order('<?php echo $_GET['id']; ?>');"  class="btn red" >Delete Plan</a>
                <?php } ?>

              </div>

            </form>

                        <!-- END FORM-->

                    </div>

                </div>

                <!-- END VALIDATION STATES-->

            </div>

        </div>

        <!-- END PAGE CONTENT-->         

    </div>

    <!-- END PAGE CONTAINER-->

</div>
<script>
function delete_order(id)
	{
		 var x=confirm('Do you want to delete this record?');
		 if(x)
		 {
			 return true;
			 //window.location.href = 'manage_order.php?ordid='+;
		 }
		 else
		 {
			 return false;
		 }
	}
</script>
<style type="text/css" >
	.message{
	color: red; 
	font-weight:normal; 
	margin-right:850px;
	border:1px solid red;
	text-align:center;
	}
</style>