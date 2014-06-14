<?php 
//$sql="select * from members where status = 'Paid' order by id";
/*$sql = "SELECT members.*,member_plans.plan_id,member_plans.member_id,member_plans.paypal_transec_id,member_plans.purchase_date 
FROM members, member_plans where members.id=member_plans.member_id order by purchase_date DESC";*/
/*$sql = "SELECT members.*,member_plans.plan_id,member_plans.member_id,member_plans.paypal_transec_id,member_plans.purchase_date 
		FROM members, member_plans 
		where member_plans.member_id = members.id
		group by member_plans.member_id desc";	*/
$sql= "SELECT member_plans.*,members.id as mem_id, members.mobile_no,members.mob_code,members.is_deleted FROM `member_plans`, members where members.id=member_plans.member_id  and members.is_deleted = 'N' group by member_id desc";



$res=$obj->select($sql);

//to make is_featured as Y
if(isset($_GET['id']))
{
	$update_featured = "update members
						set 
						is_featured = 'Y'
						where id = '".$_GET['id']."'";
	$update = $obj->edit($update_featured);		
	echo "<script> window.location.href = 'paid_members.php'; </script>";			
}

if(isset($_REQUEST['submit_sms'])&& $_REQUEST['submit_sms']!='')
{
	
	$str .= $_REQUEST['user_mobile'];
	$str=rtrim($str,',');
	if($_REQUEST['msg']!='')
	{
	$mobileno = $str;
	$message = urlencode($_REQUEST['msg']);
	
	$ch = curl_init('http://www.txtguru.in/imobile/api.php?');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "username=findmyjoditrans&password=Ganesha@1985&source=senderid&dmobile=$mobileno&message=$message");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$data = curl_exec($ch);
		echo "<script>window.location.href='paid_members.php';</script>";
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

                    List Paid Members

                </h3>

                <ul class="breadcrumb">

                    <li>

                        <i class="icon-home"></i>

                        <a href="dashboard.php">Home</a> 

                        <i class="icon-angle-right"></i>

                    </li>

                    <li>

                        <a href="paid_members.php">List Paid Members</a>                        

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
                
                <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data" style="margin-bottom:0px;float:left">
	                <div class="btn-group" style="margin-bottom:10px; float:left;">
                 		<a href="#sms_poup" data-toggle="modal" class="btn blue">Send SMS</a>
                 	</div>
                 </form>

 						<div style="float:right; margin-bottom:10px;">
                        <a href="paid_member_pdf.php" target="_blank" class="btn blue">PDF</a>
                        <a href="paid_member_excel.php" target="_blank" class="btn yellow">Excel</a> 
						</div>

                <div class="portlet box green">

                    <div class="portlet-title">

                        <div class="caption"><i class="icon-globe"></i>List Paid Members</div>

                        

                    </div>

                    

                    <div class="portlet-body" style="overflow:hidden">

                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
						<?php if(!empty($res))  { ?>
                            <thead>

                                <tr>
                                    <th width="25px">#</th>
                                    <th width="25px">Action</th>
                                    <th>Photo</th>
                                    <th>ID</th> 
                                    <th>Full Name</th>
                                    <th>Membership</th>
                                    <th>Join Date</th>  
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Plan</th> 
                                    <th>Approve to Featured</th>  
                                    <th>Manage</th> 
                                </tr>

                            </thead>

                             

                            <tbody>
						<?php for($i=0;$i<count($res);$i++){?>
                        		<?php
								$select_photo="select * from member_photos where member_id='".$res[$i]['mem_id']."'";
								$db_photo=$obj->select($select_photo);
								
								//$select_plan="select * from new_membership_plans where id='".$res[$i]['plan_id']."'";
								$select_plan = "select member_plans.*,members.*,members.id as mem_id,new_membership_plans.*
												from  member_plans,members,new_membership_plans
												where 
												member_plans.member_id = members.id and
												member_plans.plan_id = new_membership_plans.id and
												member_plans.plan_id = '".$res[$i]['plan_id']."' and
												member_plans.member_id = '".$res[$i]['member_id']."'
												order by member_plans.purchase_date desc limit 1";	
									 
								$db_plan=$obj->select($select_plan);
								
								?>
                                <tr class="odd gradeX">
                                
                                 <td><?php echo ($i+1);?></td> 
                                 <td><input type="checkbox" name="chkActive[]" id="chkActive" onchange="user_mob_chk('<?php echo $res[$i]['mobile_no'] ?>',this,'<?php echo $res[$i]['mob_code']; ?>')" value="<?php echo $res[$i]['id'] ?>" /></td>	
                                	<td><?php
											if($db_photo[0]['photo']!='')
											{
												$path =  "../upload/".$db_photo[0]['photo'];
												
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
													//echo '<img class="size" src="'.$path.'"/>';
													echo '<a href="javascript:;" class="popper" data-popbox="pop'.$i.'"><img src="'.$path.'" width="50px" height="50px" /></a>';
													echo '<div id="pop'.$i.'" class="popbox"><img src="'.$path.'" width="'.$width.'"  height="'.$height.'" /></div>';
													}else{
													if($db_plan[0]['gender']=='M')	
														echo '<img class="size" src="../images/male-user1.png"/>';
													elseif($db_plan[0]['gender']=='F')
														echo '<img class="size" src="../images/female-user1.png"/>';
												}
											}
											else
											{
												if($db_plan[0]['gender']=='M')	
													echo '<img class="size" src="../images/male-user1.png"/>';
												elseif($db_plan[0]['gender']=='F')
													echo '<img class="size" src="../images/female-user1.png"/>';
											}
										?>
                                    </td>
                                    <td><?php echo $db_plan[0]['member_id'];?></td>	
	                                <td><?php echo $db_plan[0]['name'];?></td>	
                                    <td><?php echo '<span class="btn mini green">'."Paid".'</span>'; ?></td>
                                    <td><?php echo date('d M Y',strtotime($db_plan[0]['purchase_date']));?></td>	
                                    <td><?php if($db_plan[0]['gender'] == "F") { echo '<span class="btn mini pink">'."Female".'</span>'; } else { echo '<span  class="btn mini blue">'."Male".'</span>'; }?></td>		
                                   <td><?php if($db_plan[0]['status']=="Active"){ echo '<span class="btn mini green">'.$db_plan[0]['status'].'</span>';}else { echo '<span class="btn mini orange">'."Inactive".'</span>';} ?></td>	
                                   	
                                   <td><?php if($db_plan[0]['plan_id'] == "2") { echo '<span class="btn mini gold">'."Gold".'</span>'; } 
								   elseif($db_plan[0]['plan_id'] == "3") { echo '<span class="btn mini red">'."Platenium".'</span>'; }
								    elseif($db_plan[0]['plan_id'] == "1") { echo '<span class="btn mini platinum">'."Silver".'</span>'; }
									
									?></td>
                                   <td>
                                   <?php if($db_plan[0]['is_featured'] == "Y") {
									   	echo "Featured";
									  } else{ ?>
                                   <a href="paid_members.php?id=<?php echo $db_plan[0]['mem_id']; ?>" class="btn mini black">Approve Paid to Featured</a><?php } ?></td>
                                    <td width="80px"><a href="manage_member.php?id=<?php echo $res[$i]['member_id']; ?>" class="btn mini purple"><i class="icon-edit"></i>Manage</a></td>                                        
                                </tr>
                                <?php }?> 
                                
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