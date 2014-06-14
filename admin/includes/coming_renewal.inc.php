<?php
$sql_distinct= "SELECT * FROM `member_plans` group by member_id desc";
$select = $obj->select($sql_distinct);


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

                  Coming Renewal Membership

                </h3>

                <ul class="breadcrumb">

                    <li>

                        <i class="icon-home"></i>

                        <a href="dashboard.php">Home</a> 

                        <i class="icon-angle-right"></i>

                    </li>

                    <li>

                        <a href="coming_renewal.php">Coming Renewal Membership</a>                        

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
                
                <div style="float:right; margin-bottom:10px;display:none" >
                        <a href="all_member_pdf.php" target="_blank" class="btn blue">PDF</a>
                        <a href="all_member_excel.php" target="_blank" class="btn yellow">Excel</a> 
						</div>


                <div class="portlet box green">

                    <div class="portlet-title">

                        <div class="caption"><i class="icon-globe"></i>Coming Renewal</div>                       

                    </div>

                    

                    <div class="portlet-body">
                    					
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
                                 <tr>
                                    <th style="width:25px;">#</th>
                                	<th> MatriId </th>
                                    <th> Plan Name</th>
                                    <th> Membership Activate Date </th> 
                                    <th> Expired Date On </th>
                                    <th>Days</th>
                                    <th>Status</th>
                                    <th> Send SMS </th>
                                    <th>Action</th> 
                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
								
								for($j=0;$j<count($select);$j++)
								{
									$sql3 = "select * from member_plans
											 where plan_id = '".$select[$j]['plan_id']."' and
											 member_id = '".$select[$j]['member_id']."'
											 order by purchase_date desc limit 1";											
									$data = $obj->select($sql3);
									
											 
									
							foreach($data as $d) {
								$sql = "SELECT members.*,members.member_id as mem_id,member_plans.plan_id,member_plans.member_id,
											new_membership_plans.plan_duration,new_membership_plans.plan_display,
											member_plans.paypal_transec_id,member_plans.purchase_date 
											FROM 
												members, member_plans ,new_membership_plans
											where
												members.id=member_plans.member_id  and
												member_plans.plan_id = new_membership_plans.id and
												member_plans.plan_id = '".$d['plan_id']."' and
												members.id = '".$d['member_id']."' and
												member_plans.purchase_date = '".$d['purchase_date']."' and
												member_plans.id = '".$d['id']."'
												order by purchase_date DESC"; 
											
										$res = $obj->select($sql);
								?>
                                <tr class="odd gradeX">
                                <td><?php echo ($i+1);?></td> 	
                                	<td><?php echo $res[0]['mem_id'];	?></td>
                                    <td><?php 
										if($res[0]['plan_display'] == "GOLD")
										{
											?><a href="#" class="btn mini gold"><?php echo $res[0]['plan_display']; ?></a> <?php
										} 
										if($res[0]['plan_display'] == "PLATENIUM")
										{
											?><a href="#" class="btn mini platinum"><?php echo $res[0]['plan_display']; ?></a> <?php	
										}
										if($res[0]['plan_display'] == "Free")
										{
											?><a href="#" class="btn mini red"><?php echo $res[0]['plan_display']; ?></a> <?php	
										}?></td>
                                    <td><?php echo date('d-m-Y',strtotime($res[0]['purchase_date']));?></td>	 
	                                <td><?php 
									$data = " + ".$res[0]['plan_duration']."days";
									echo date('d-m-Y', strtotime($res[0]['purchase_date'].$data ));
									$exp_date = date('d-m-Y', strtotime($res[0]['purchase_date'].$data )); ?></td>	
                                    <td><?php  echo abs((strtotime(date('d-m-Y')) - strtotime($exp_date)) / (60 * 60 * 24)); ?></td>
                                    <td>Paid</td>	
                                    
                                    <td><a class="btn mini yellow" href="#">Send Messages</a></td>	 
                                    <td>
                                    <a class="btn mini red" onclick="newWindow('renewal_form.php?mem_id=<?php echo $res[0]['mem_id']; ?>','','520','830')" href="#">Renew Now</a></td>
                                                       
                                </tr>
                                <? 
								} }?>                            

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
function newWindow(mypage,myname,w,h,features) {
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  var settings = 'height=' + h + ',';
  settings += 'width=' + w + ',';
  settings += 'top=' + wint + ',';
  settings += 'left=' + winl + ',';
  settings += features;
  win = window.open(mypage,myname,settings);
  win.window.focus();
}


	function doYouWantTo(id){

	  doIt=confirm('Do you want to delete it?');

	  if(doIt){

		window.location.href = 'list_members.php?id='+id;

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