<?php 
$sql = "SELECT members.*,member_photos.photo             
			FROM members   
			LEFT JOIN member_photos           
			ON members.id=member_photos.member_id
			where is_deleted = 'N' and status = 'Deactive' order by members.id DESC";		
$res=$obj->select($sql);
if($_POST['flag'] == "y")
{
	$sql = "SELECT * from new_membership_plans where id=2";			 			  
	$data=$obj->select($sql);
	  $date = date("Y-m-d");
		$mon = '+ ' . $data[0]['plan_duration'] ."days" ;
		
		$newdate = strtotime ( $mon, strtotime ($date)) ;
		$expiry_date = date ( 'Y-m-d' , $newdate );
	for($i=0;$i<count($_POST['chkActive']);$i++)
	{
		$date = date('Y-m-d');
		
		$mem_plan = "select member_id from member_plans where member_id='".$_POST['chkActive'][$i]."'";
		$db_mem_plan = $obj->select($mem_plan);
		
			if(count($db_mem_plan)==1)
			{
				$insert1 = "update member_plans set expiry_date='".$expiry_date."' where member_id='".$_POST['chkActive'][$i]."'";
				$result1 = $obj->edit($insert1);
			}
			else
			{
				$insert1 = "insert into member_plans
							(id, plan_id, member_id, paypal_transec_id, purchase_date,expiry_date)
						VALUES
							(NULL,'2','".$_POST['chkActive'][$i]."','40B55327R5934710C','".$date."','".$expiry_date."')";
	
			$result1 = $obj->insert($insert1);
			}
		
		
		
		$sqld="update members set status = 'Active', Activation_code='99999999' where id = '".$_POST['chkActive'][$i]."' ";
		$obj->edit($sqld);		
		
		$select_mem="select * from members where id='".$_POST['chkActive'][$i]."'";
		$db_mem=$obj->select($select_mem);
		
		$to=$db_mem[0]['email_id'];
		$subject = "Account Activate Successfully - Find MY Jodi";
		
		$loginurl = $obj->SITEURL."login.php";
		$message = '<div style="width:98%;border:1px solid #ccc;padding:10px;border-radius:5px">
			<a href="'.$obj->SITEURL.'"><img src="'.$obj->SITEURL.'images/logo2.png" height="100" width="160" /></a><br /><br />';
		$message .= '<strong>Dear '.$db_mem[0]['name'].',</strong><br /><br />';
		
		$message .= "Congrats!..You have successfully activated Your Account.<br /><br />
							 Your registration detail is as follow:<br>
							 Email ID : ". $db_mem[0]['email_id']."<br />"; //Password : ".$_POST['password']."<br /><br />
		$message.= "for Visit site <a href='".$loginurl."'><strong>Click here</strong></a>\n\n";
		
		$message.= "<br /><br /><strong>Thank You,</strong><br />";
		$message.= "<strong>Find My Jodi</strong><br />";
		$message .= '</div>';
					 
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";	
		$headers .= 'From: Find My Jodi <info@findmyjodi.com>';
		mail($to,$subject,$message,$headers);
		
	}
	echo "<script> window.location.href = 'inactive_members.php'; </script>";
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
	
		/*$url = 'http://login.smsgatewayhub.com/API/WebSMS/Http/v1.0a/index.php';
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
		curl_close($ch);*/
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
                    List Inactive Members
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="inactive_members.php">List Inactive Members</a>                        
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
                      <input type="submit" name="submit" class="btn blue" onClick=" return doYouWantToActive()" value="Active">   
                       <a href="#sms_poup" data-toggle="modal" class="btn blue" style="margin-left:10px;">Send SMS</a>
<!--                      <input type="submit" name="submit_sms" class="btn blue" value="Send SMS" style="margin-left:10px;">   -->
                      <input type="hidden" name="flag" id="flag" value="" />              	  	
                </div>
                
 				<div style="float:right">
                        <a href="inactive_member_pdf.php" target="_blank" class="btn blue">PDF</a>
                        <a href="inactive_member_excel.php" target="_blank" class="btn yellow">Excel</a> 
						</div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-globe"></i>List Inactive Members</div>
                        
                    </div>
                    
                    <div class="portlet-body" style="overflow:hidden">
					
                 
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
						<?php if(!empty($res))
							  { 
								 
							  ?>
                            <thead>
                                <tr>
                                   <th width="25px">#</th>
                                   <th>Action</th>
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
                            <?php
								for($i=0;$i<count($res);$i++){
									$sql = "SELECT members.*,member_plans.plan_id,member_plans.member_id,
								 		 member_plans.paypal_transec_id,member_plans.purchase_date FROM members,member_plans 
								 		 where 
								 		 members.id=member_plans.member_id and
										 members.id = '".$res[$i]['id']."' order by purchase_date DESC";
								$plans=$obj->select($sql); 
								
								$mob_code = "select mob_code from mobile_codes where id='".$res[$i]['mob_code']."'";
								$db_mob_code = $obj->select($mob_code);
								?>
                                <tr class="odd gradeX">
                                <td><?php echo ($i+1);?></td>
                                <td><input type="checkbox" name="chkActive[]" id="chkActive" onchange="user_mob_chk('<?php echo $res[$i]['mobile_no'] ?>',this,'<?php echo $res[$i]['mob_code']; ?>')" value="<?php echo $res[$i]['id'] ?>" /></td>	
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
                                    <td>
										<?php if(empty($plans))
											 {
												echo '<span class="btn mini yellow">'."Free".'</span>';
											 } else
											 {
												 echo '<span class="btn mini green">'."Paid".'</span>';
											 }?>
                                    </td>
                                    <td><?php echo date('d M Y',strtotime($res[$i]['reg_date']));?></td>	
     <td><?php if($res[$i]['gender'] == "F") { echo '<span class="btn mini pink">'."Female".'</span>'; } else { echo '<span class="btn mini blue">'."Male".'</span>'; }?></td>	
                                    <td><?php echo '<span class="btn mini orange">'."Inactive".'</span>';?></td>	   
                                    <td width="80px"><a href="manage_member.php?id=<?php echo $res[$i]['id']; ?>" class="btn mini purple"><i class="icon-edit"></i>Manage</a></td>                                          
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
			  return false;//document.form_sample_3.flag.value = "n";
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