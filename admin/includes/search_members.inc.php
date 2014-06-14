<?php 
if(isset($_POST['submit']))
{
	if(isset($_POST['chkRel']))
	{
		$rel =  "'" . implode("','", $_POST['chkRel']) ."'";
	}
	else
	{
		$sql = "select * from members where is_deleted = 'N'";
		$ans=$obj->select($sql);
		foreach($ans as $a)
		{
			$all_status[] = $a['relationship_status'];
		}
		$rel =  "'" .  implode("','", $all_status)."'";		
	}
	
	if(isset($_POST['Rdgender']))
	{
		$selected_gender =  array($_POST['Rdgender']);		
		$gender =   implode("','", $selected_gender);
	}
	else
	{
		$all_gender = array('F', 'M');
		$gender =   implode("','", $all_gender);		
	}
	
	
	if($_POST['religion'] != "")
	{
		$selected_religion =  array($_POST['religion']);		
		$religion =   implode("','", $selected_religion);		
	}
	else
	{
		
		$sql="select religion from members where is_deleted = 'N' order by id";
		$ans=$obj->select($sql);
		foreach($ans as $a)
		{
			$all_religion[] = $a['religion'];
		}
		$religion =   implode("','", $all_religion);		
		
	}
	if($_POST['from_age'] != "" and $_POST['to_age'] != "")
	{
		$age_from = $_POST['from_age'];
		$age_to = $_POST['to_age'];
	}
	else
	{
		/*$sql="select religion from members where is_deleted = 'N' order by id";
		$ans=$obj->select($sql);
		foreach($ans as $a)
		{
			$all_religion[] = $a['religion'];
		}
		$religion =   implode("','", $all_religion);		*/
		$age_from = '15';
		$age_to = '80';
		
	}
	
	if($_POST['country'] != "")
	{
		$selected_country =  array($_POST['country']);		
		$country =   implode("','", $selected_country);		
	}
	else
	{
		
		$sql="select * from members where is_deleted = 'N' order by id";
		$ans=$obj->select($sql);
		foreach($ans as $a)
		{
			$all_country[] = $a['country'];
		}
		$country =   implode("','", $all_country);		
		
	}
	if($_POST['caste'] != "")
	{
		$selected_caste =  array($_POST['caste']);		
		$caste =   implode("','", $selected_caste);		
	}
	else
	{
		
		$sql="select caste from members where is_deleted = 'N' order by id";
		$ans=$obj->select($sql);
		foreach($ans as $a)
		{
			$all_caste[] = $a['caste'];
		}
		$caste =   implode("','", $all_caste);
		
		
	}
	if($_POST['mother_tongue'] != "")
	{
		$selected_mother_tongue =  array($_POST['mother_tongue']);		
		$mother_tongue =   implode("','", $selected_mother_tongue);		
	}
	else
	{
		
		$sql="select * from members where is_deleted = 'N' order by id";
		$ans=$obj->select($sql);
		foreach($ans as $a)
		{
			$all_mother_tongue[] = $a['mother_tongue'];
		}
		$mother_tongue =   implode("','", $all_mother_tongue);		
		
	}
	$sql="select * from members 
		  where 
		  gender in ('$gender') and religion in('$religion') and caste in('$caste') 
		  and relationship_status in($rel)  and mother_tongue in('$mother_tongue')
		  and country in('$country') and age between $age_from and $age_to";
	
		 
	$ans=$obj->select($sql);
}
else
{
	$sql="select * from members order by id";
	$ans=$obj->select($sql);
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
                    Search Members
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="list_advertisements.php">Search Members</a>                        
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
                        <div class="caption"><i class="icon-globe"></i>Search Members</div>
                        
                    </div>
                    
                    <div class="portlet-body">
                    <form class="form-horizontal" id="form_sample_2" method="post">
              <div class="control-group">
                <label class="control-label">Gender</label>
                <div class="controls"> 
                  Male<input type="radio" name="Rdgender" value="M"  />
                  Female<input type="radio" name="Rdgender" value="F" />
                </div>
                </div>
             <div class="control-group">
                <label class="control-label">Age<span class="required"></span></label>
              		<div class="controls">
                 	 	<input type="text" id="from_age" name="from_age" class="m-wrap medium required" placeholder = 'from'/>               
                        <input type="text" id="to_age" name="to_age" class="m-wrap medium required" placeholder = 'to' />               
               		</div>
              </div>
               <div class="control-group">
              <label class="control-label">Religion<span class="required"></span></label>
                <div class="controls">
                   <select name="religion"  id=="religion" class="span6 m-wrap" onchange="showcaste(this.value);">
                 	<option value="">Select</option>
                     <?php $sel="select * from religions";
					 		$intr=$obj->select($sel);
						
							foreach($intr as $inc)
							{	?> <option value="<?php echo $inc['religion'];?>" ><?php echo $inc['religion'];?></option>
                        <?php  }?>   
                  </select>
                </div>
                </div>
               <div class="control-group">
                <label class="control-label">Caste/Division<span class="required"></span></label>
              		<div class="controls">
                    <div id="txtHint456">
                  		<select name="caste" id="caste" class="span6 m-wrap">
                        	<option value="">Select</option>
                        </select>
               		</div>
               </div>
              </div>
              <div class="control-group">
                <label class="control-label">Mother Tongue<span class="required"></span></label>
              		<div class="controls">
                 <select class="span6 m-wrap" name="mother_tongue" id="mother_tongue" name="mother_tongue">
                   <option value="">Select</option>
                   <?php $sel="select * from mother_tongues";
					 		$intr=$obj->select($sel);
							foreach($intr as $inc)
							{			 
					    ?>
                    <option value="<?php echo $inc['name'];?>"><?php echo $inc['name'];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Country<span class="required"></span></label>
              		<div class="controls">
                   <?php $country_list = "select * from mobile_codes";
					$data = $obj->select($country_list);
				?>
                  <select class="span6 m-wrap" id="country" name="country">
                     <option value="">Select</option>
					<?php foreach($data as $res) { ?>
                    <option value="<?php echo $res['country']; ?>" style="color:#004F00"><?php echo $res['country']; ?></option>
                    <?php } ?>
                  </select>
               </div>
              </div>
              <div class="control-group">
                <label class="control-label">Marital Status<span class="required"></span></label>
                <?php $sql = "select * from relationship_status";
					  $db_rel=$obj->select($sql); ?>					  
              		<div class="controls">
                      <?php foreach($db_rel as $rel) {?>
                  		<?php echo $rel['status']; ?><input type="checkbox" id="chkRel" name="chkRel[]" value="<?php echo $rel['status']; ?>" />
                      <?php  }?>  
               		</div>
              </div>
              
              <div class="form-actions">
                <input type="submit" name="submit" class="btn blue" value="Search">
              </div>
            </form>
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                            <thead>
                                <tr>
                                   <th>Name</th>
                                   <th>Gender</th>
                                   <th>Age</th>
                                   <th>Religion</th>
                                   <th>Caste</th>
                                   <th>Country</th>
                                   <th>Marital Status</th>
                                   <th>Mother Tongue</th>
                                   <th>Contact Number</th>
                                   <th>Action</th>                                   
                                </tr>
                            </thead>
                             
                            <tbody>
                           <?php for($i=0;$i<count($ans);$i++){?>
                                <tr class="odd gradeX">
                                 <td><?php echo $ans[$i]['name'];?></td>
                                 <td><?php if($ans[$i]['gender'] == "M"){ echo "Male"; } else { echo " Female";}?></td>
                                 <td><?php echo $ans[$i]['age']; ?></td>
                                 <td><?php echo $ans[$i]['religion'];?></td>               
                                 <td><?php echo $ans[$i]['caste'];?></td>
                                 <td><?php echo $ans[$i]['country'];?></td>
                                 <td><?php echo $ans[$i]['relationship_status'];?></td>
                                 <td><?php echo $ans[$i]['mother_tongue'];?></td>
	                             <td><?php echo $ans[$i]['mobile_no'];?></td>                                  
                				 <td width="80px"><a href="manage_member.php?id=<?php echo $ans[$i]['id']; ?>" class="btn mini purple"><i class="icon-edit"></i> View</a></td>
                				  
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
<script type="text/javascript">
	function showcaste(val)
		{
		$.ajax({
				type:'POST',
				url:"ajax_caste.php",
				data:'religion='+val,
				success: function(result)
				{
					$('#txtHint456').html(result);
				}
			});
		}
</script>