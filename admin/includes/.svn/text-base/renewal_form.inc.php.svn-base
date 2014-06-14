<?php
$sql="select * from members where member_id = '".$_GET['mem_id']."'";
$data = $obj->select($sql);
if(isset($_POST['submit']))
{
	$insert_plan = "insert into member_plans(id,plan_id,member_id,purchase_date)
					values(null,'".$_POST['drpPlan']."','".$_POST['member_id']."','".date('Y-m-d',strtotime($_POST['activationDate']))."')";

	$ans = $obj->insert($insert_plan);
	?>
    <script>window.opener.location.href="coming_renewal.php";
    		self.close();	</script>
    <?php
}

$sql = "SELECT members.*,members.member_id as mem_id,member_plans.plan_id,member_plans.member_id,
		new_membership_plans.plan_duration,new_membership_plans.plan_display,
		member_plans.paypal_transec_id,member_plans.purchase_date 
		FROM 
			members, member_plans ,new_membership_plans
		where
			members.id=member_plans.member_id  and
			member_plans.plan_id = new_membership_plans.id and
			members.member_id = '".$_GET['mem_id']."'
			order by purchase_date DESC";
			
$db_member = $obj->select($sql);
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
            <div class="span12" style="display:none">
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
                
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        
        
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="btn-group" style="margin-bottom:10px; float:right;display:none">
                    <a href="list_caste.php"><button id="sample_editable_1_new" class="btn green">
                    Renewal Form
                    </button></a>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Renewal Form</div>
                        
                    </div>

                    <div class="portlet-body" style="overflow:hidden">
					
                        
						<?php if(!empty($data))
							  { 
							  $select_plan = "select * from new_membership_plans";
							  $plans =  $obj->select($select_plan);
							  ?>
                              <table border="0"  id="sample_1">
                              <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data" onsubmit="return check_form()">
                              <input type="hidden" name="member_id" id="member_id" value="<?php echo $data[0]['id']; ?>">
                              <tr>
                              	<td>MatrimonyId :</td>
                                <td><?php echo $data[0]['member_id']; ?></td>
                              </tr>
                              <tr>
                              	<td>Name :</td>
                                <td><?php echo $data[0]['name']; ?></td>
                              </tr>
                              <tr>
                              	<td>Email :</td>
                                <td><?php echo $data[0]['email_id']; ?></td>
                              </tr>
                              <?php if(!empty($data[0]['city'])) { ?>
                              <tr>
                              	<td>Address :</td>
                                <td><?php echo $data[0]['city']; ?></td>
                              </tr>
                              <?php } ?>
                              <tr>
                              	<td>Payment Mode :</td>
                                <td>
                                	<select id="drpPaymentMode" name="drpPaymentMode">
                                    	<option value="Cash">Cash</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="DD">DD</option>
                                        <option value="Money Order">Money Order</option>
                                        <option value="Funds Transfer">Funds Transfer</option>
                                        <option value="Other">Other</option>
                                    </select>
								</td>
                              </tr>
                              <tr>
                              	<td>Activation Date  :</td>
                                <td>
                                	<input type="text" name="activationDate" value="<?php echo date('d-m-Y'); ?>" id="activationDate">
                                    
								</td>
                              </tr>
                              <tr>
                              	<td>Plan  :</td>
                                <td>
                                	<select id="drpPlan" name="drpPlan">
                                    <option value="">select</option>
                                    	<?php
											
										foreach($plans as $p) {?>
                                        		<option value="<?php echo $p['id']; ?>"><?php echo $p['plan_display']; ?></option>
                                
                                        <?php } ?>      
                                    </select>
								</td>
                              </tr>
                              <?php	foreach($plans as $p) {
								  	$ids[] = $p['id'];
								  ?>
                              			<tr id="plan_duration_<?php echo $p['id']; ?>" style="display:none">
                              				<td>Duration</td>
                                        	<td><input type="text" name="txtPlanDuration" id="txtPlanDuration" value="<?php echo $p['plan_duration'] ?>"></td>
                                        </tr>
                                        <tr id="plan_amt_<?php echo $p['id']; ?>" style="display:none">
                              				<td>Amount</td>
                                        	<td><input type="text"  name="txtPlanAmt" id="txtPlanAmt" value="<?php echo $p['plan_amount'] ?>"></td>
                                        </tr>
                                         <tr id="plan_contacts_<?php echo $p['id']; ?>" style="display:none">
                              				<td>No Of Contacts</td>
                                        	<td><input type="text"  name="txtNoOfContacts" id="txtNoOfContacts" value="<?php echo $p['no_of_contacts'] ?>"></td>
                                        </tr>
                                        <tr id="free_msg_<?php echo $p['id']; ?>" style="display:none">
                              				<td>Free Msg</td>
                                        	<td><input type="text"  name="txtFreeMsgs" id="txtFreeMsgs" value="<?php echo $p['allow_messages'] ?>"></td>
                                        </tr>
                                         <tr id="view_profile_<?php echo $p['id']; ?>" style="display:none">
                              				<td>View Profile</td>
                                        	<td><input type="text"  name="txtViewProfile" id="txtViewProfile" value="<?php echo $p['view_profile'] ?>"></td>
                                        </tr>
                                            
                                        <?php } 
										
									?>
                                          
                              	
                              </tr>
                              	<td>Allow Video :</td>
                                <td>
                                	<input type="radio" name="rdVideo" id="rdVideo" checked="checked" style="margin-left:0px">Yes
                                    <input type="radio" name="rdVideo" id="rdVideo" style="margin-left:0px">No
								</td>
                              </tr>
                              <tr>
                              	<td>Allow Chat :</td>
                                <td>
                                	<input type="radio" name="rdChat" id="rdChat" checked="checked" style="margin-left:0px">Yes
                                    <input type="radio" name="rdChat" id="rdChat" style="margin-left:0px">No
								</td>
                              </tr>
                              <tr>
                              	<td>Bank Details :</td>
                                <td>
                                	<textarea id="bankDetails" name="bankDetails"></textarea>
								</td>
                              </tr>
                              <tr>
                              	<td></td>
                              	<td>
                                	<input type="submit" value="Submit" name="submit">
                            		<input type="button" onclick="win();" value="Close window" id="closeWindow">
                            	</td>
                              </tr>
                           
                            </form> 
                             </table> 
						<?php }
							else{
								echo "No Records Found";
								}?>
                                 
                        
                       	
                      

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
function check_form()
{
	$('#drpPlan').css('border','1px solid #ccc');
	
	error = 0;
		if(document.getElementById('drpPlan').value=='')
		{
			$('#drpPlan').css('border','1px solid red');
			
			drpPlan=1
		}
		else
		{
			drpPlan=0
		}
		if(drpPlan == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
$('#drpPlan').change(function() {
	
	var jQueryArray = <?php echo json_encode($ids); ?>;
	for ( var i = 0; i < jQueryArray.length; i = i + 1 ) {
	 
		if($('#plan_duration_'+jQueryArray[i]).css('display') != 'none'){ 
			$('#plan_duration_'+jQueryArray[i]).hide(); 
			$('#plan_amt_'+jQueryArray[i]).hide(); 
			$('#plan_contacts_'+jQueryArray[i]).hide(); 
			$('#free_msg_'+jQueryArray[i]).hide();
			$('#view_profile_'+jQueryArray[i]).hide();
			 
			
		}
	 
	}

	var plan_id = $('#drpPlan').val();
		$('#plan_duration_'+plan_id).show(); 
		$('#plan_amt_'+plan_id).show(); 
		$('#plan_contacts_'+plan_id).show(); 
		$('#free_msg_'+plan_id).show(); 
		$('#view_profile_'+plan_id).show(); 
		
});
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
function win(){
window.opener.location.href="coming_renewal.php";
self.close();
}
</script>