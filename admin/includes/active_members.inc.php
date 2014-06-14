<?php 
//$sql="select * from members where status = 'Active' order by id";
$sql = "SELECT members.*,member_photos.photo             
			FROM members   
			LEFT JOIN member_photos           
			ON members.id=member_photos.member_id
			where is_deleted = 'N' and status = 'Active' order by members.id DESC";		

$res=$obj->select($sql);
if($_POST['flag'] == "y")
{
	for($i=0;$i<count($_POST['chkActive']);$i++)
	{
		$sqld="update members set status = 'Deactive' where id = '".$_POST['chkActive'][$i]."' ";
		$obj->edit($sqld);		
	}
	echo "<script> window.location.href = 'active_members.php'; </script>";
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
	
	echo "<script>window.location.href='active_members.php';</script>";
	}
	else
	{
		echo "<script>alert('Blank message can not be send, Enter valid message');</script>";
	}

}

?> 
<div class="page-content">
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
            <h3>portlet Settings</h3>
        </div>
        <div class="modal-body">
            <p>Here will be a configuration form</p>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
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
                            <li class="color-white color-light" data-style="light"></li>
                        </ul>
                        <label class="hidden-phone">
                        <input type="checkbox" class="header" checked value="" />
                        <span class="color-mode-label">Fixed Header</span>
                        </label>							
                    </div>
                </div>
                <h3 class="page-title">List Active Members</h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <i class="icon-angle-right"></i> 
                    </li>
                    <li>List Active Members</li>							
                </ul>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">			
            <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
            <div class="btn-group" style="margin-bottom:10px; float:left;">
             <input type="submit" name="submit" class="btn blue" onClick="return doYouWantToActive()" value="InActive">
             <a href="#sms_poup" data-toggle="modal" class="btn blue" style="margin-left:10px;">Send SMS</a>
             <input type="hidden" name="flag" id="flag" value="" /> 
             </div>
             <div style="float:right">
                        <a href="active_member_pdf.php" target="_blank" class="btn blue">PDF</a>
                        <a href="active_member_excel.php" target="_blank" class="btn yellow">Excel</a> 
			</div>
            <div class="portlet box green">

                    <div class="portlet-title">

                        <div class="caption"><i class="icon-globe"></i>List Active Members</div>

                        

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
                                  <!-- <th width="120px">Approve as Paid</th>-->
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
                                    <?php
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
                                    <td><?php echo '<span class="btn mini green">'.$res[$i]['status'].'</span>';?></td>	   	
                                    <!--<td><a class="btn mini red" onclick="newWindow('approve_to_paid_form.php?id=<?php //echo $res[$i]['member_id']; ?>','','520','450','scrollbars=yes')" href="javascript:;">Approve as Paid</a></td>-->	   	
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
    </div> 
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
function doYouWantToActive(){ 

	   var check = $("input:checkbox:checked").length;
	   if(check>1)
	   {
			doIt=confirm('Are you sure to InActive this Member?');
			if(doIt){
				document.form_sample_3.flag.value = "y";
			}
			else{
				return false;//document.form_sample_3.flag.value = "n";
			}
	  }
	  else
	  {
		  alert('Select atleast one employee to Inactive');
		   return false;
	  }
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