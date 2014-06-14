<?php 
$sql = "SELECT * from messages where Status = 0 order by id DESC";		
$res=$obj->select($sql);
if($_POST['flag'] == "y")
{
	
}
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
                    List Unapprove Message
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="inactive_members.php">List Unapprove Message</a>                        
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
                <form  method="post"  id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
                <div class="btn-group" style="margin-bottom:10px; float:left;">
                      <input type="submit" name="submit" class="btn blue" onClick="doYouWantToActive()" value="Active">   
                      <input type="hidden" name="flag" id="flag" value="" />              	  	
                </div>
                
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-globe"></i>List Unapprove Message</div>
                        
                    </div>
                    
                    <div class="portlet-body" style="overflow:hidden">
					
                 
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
						<?php if(!empty($res))
							  { 
								 
							  ?>
                            <thead>
                                <tr>
                                   <th width="25px">#</th>
                                   <th>&nbsp;</th>
                                   <th>From</th>
                                   <th>To</th>
                                   <th>Message</th> 
                                   <th>Status</th>
                                   <th>Manage</th>      
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php
								for($i=0;$i<count($res);$i++){ ?>
                                <tr class="odd gradeX">
                                <td><?php echo ($i+1);?></td>
                                <td>
                                <input type="checkbox" name="chkActive[]" id="chkActive" value="<?php echo $res[$i]['id'] ?>" /></td>	
                                	<td>
                                    <?php echo $res[$i]['from_mem'];?>
                                    </td>
                                    <td><?php echo $res[$i]['to_mem'];?></td>	 
	                                <td><?php echo $res[$i]['message'];?></td>	
                                    <td><?php echo '<a href="#" class="btn mini orange">'."Unapprove".'</a>';?></td>	   
       <td width="80px"><a href="manage_msg.php?id=<?php echo $res[$i]['id']; ?>" class="btn mini purple"><i class="icon-edit"></i>Manage</a></td>                                          
                                </tr>
                                <? }
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
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<script type="text/javascript">
	function doYouWantToActive(){
      var check = $("input:checkbox:checked").length;	
	  if(check>0)
	  {
		  doIt=confirm('Are you sure to Active this Member?');
	
		  if(doIt){
			 document.form_sample_3.flag.value = "y";
		  }
	
		  else{
	
			  document.form_sample_3.flag.value = "n";
		  }
	  }
	  else
	  {
		  alert('Select atleast one employee to Active');
		  return false;
	  }
	}
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