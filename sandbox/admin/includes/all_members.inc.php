<?php
//$sql="select * from members order by id";
$sql = "SELECT members.*,member_photos.photo             
			FROM members   
			LEFT JOIN member_photos           
			ON members.id=member_photos.member_id
			where is_deleted = 'N' order by members.id DESC"; 
$res=$obj->select($sql);
if(isset($_REQUEST['submit_sms'])&& $_REQUEST['submit_sms']!='')
{
	
	for($i=0;$i<count($res);$i++)
	{
		$str.=$res[$i]['mobile_no'].',';
	}
	$str=rtrim($str,',');
	if($_REQUEST['msg']!='')
	{
		$url = 'http://login.smsgatewayhub.com/API/WebSMS/Http/v1.0a/index.php';
		$fields = array(
						'username' =>'reddymax',
						'password' =>'Reddy123',
						'sender' =>'CATHUB',
						'to' => $str,
						'message' =>urlencode($_REQUEST['msg']),
						'reqid' =>1
				    );
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		echo "<script>window.location.href='inactive_members.php';</script>";
	}
	else
	{
		echo "<script>alert('Blank message can not be send, Enter valid message');</script>";
	}
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

                    List Members

                </h3>

                <ul class="breadcrumb">

                    <li>

                        <i class="icon-home"></i>

                        <a href="dashboard.php">Home</a> 

                        <i class="icon-angle-right"></i>

                    </li>

                    <li>

                        <a href="active_members.php">List Members</a>                        

                    </li>

                </ul>

                <!-- END PAGE TITLE & BREADCRUMB-->

            </div>

        </div>

        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->

        <div class="row-fluid">

            <div class="span12">
<a href="#sms_poup" data-toggle="modal" class="btn blue" style="margin-left:10px;">Send SMS</a>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                
                <div style="float:right; margin-bottom:10px;" >
                        <a href="all_member_pdf.php" target="_blank" class="btn blue">PDF</a>
                        <a href="all_member_excel.php" target="_blank" class="btn yellow">Excel</a> 
						</div>


                <div class="portlet box green">

                    <div class="portlet-title">

                        <div class="caption"><i class="icon-globe"></i>List Members</div>                       

                    </div>

                    

                    <div class="portlet-body">
                    					
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
                                 <tr>
                                    <th style="width:25px;">#</th>
                                	<th>Photo</th>
                                    <th>ID</th> 
                                    <th>Full Name</th>
                                    <th>Membership</th>
                                    <th>Date</th>
                                    <th>Gender</th>
                                    <th>Status</th> 
                                    <th>Manage</th>      
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php for($i=0;$i<count($res);$i++){
								$sql = "SELECT members.*,member_plans.plan_id,member_plans.member_id,
								 		 member_plans.paypal_transec_id,member_plans.purchase_date FROM members,member_plans 
								 		 where 
								 		 members.id=member_plans.member_id and
										 members.id = '".$res[$i]['id']."' order by purchase_date DESC";
								$plans=$obj->select($sql);
								
								
								?>
                                <tr class="odd gradeX">
                                <td><?php echo ($i+1);?></td> 	
                                	<td><?php
											if($res[$i]['photo']!='')
											{
												$path =  "../upload/".$res[$i]['photo'];
												
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
													echo '<a href="javascript:;" class="popper" data-popbox="pop'.$i.'"><img src="'.$path.'" width="50px" height="50px" /></a>';
													echo '<div id="pop'.$i.'" class="popbox"><img src="'.$path.'" width="'.$width.'"  height="'.$height.'" /></div>';
													//echo '<img class="size" src="'.$path.'"/>';
													}else{
													if($res[$i]['gender']=='M')	
														echo '<img class="size" src="../images/male-user1.png"/>';
													else
														echo '<img class="size" src="../images/female-user1.png"/>';
												}
											}
											else
											{
												if($res[$i]['gender']=='M')	
													echo '<img class="size" src="../images/male-user1.png"/>';
												else
													echo '<img class="size" src="../images/female-user1.png"/>';
											}
										?>
                                    </td>
                                    <td><?php echo $res[$i]['member_id'];?></td>	 
	                                <td><?php echo $res[$i]['name'];?></td>	
                                    <td><?php
										if(empty($plans))
										{
											echo '<span class="btn mini yellow">'."Free".'</span>';
										}
										else
										{
											echo '<span class="btn mini green">'."Paid".'</span>';
										}
									 ?></td>
                                    <td><?php echo date('d M Y',strtotime($res[$i]['reg_date']));?></td>	
                                     <td><?php if($res[$i]['gender'] == "F") { echo '<span class="btn mini pink">'."Female".'</span>'; } else { echo '<span  class="btn mini blue">'."Male".'</span>'; }?></td>	
                                    <td><?php if($res[$i]['status']=="Active"){ echo '<span class="btn mini green">'.$res[$i]['status'].'</span>';}else { echo '<span class="btn mini orange">'."Inactive".'</span>';} ?></td>	
                                    <td width="80px"><a href="manage_member.php?id=<?php echo $res[$i]['id']; ?>" class="btn mini purple"><i class="icon-edit"></i>Manage</a></td>                                        
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