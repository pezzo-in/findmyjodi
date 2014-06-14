<?php 
$sql="select * from members where status = 'Active' and is_featured = 'Y' order by id";
		

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
		echo "<script>window.location.href='featured_members.php';</script>";
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
                <h3 class="page-title">List Featured Members</h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <i class="icon-angle-right"></i> 
                    </li>
                    <li>List Featured Members</li>							
                </ul>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">			
            	 <form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data" style="margin-bottom:0px;float:left">
	                <div class="btn-group" style="margin-bottom:10px; float:left;">
                 		<a href="#sms_poup" data-toggle="modal" class="btn blue">Send SMS</a>
                 	</div>
                 </form>
             <div style="float:right;display:none">
                        <a href="active_member_pdf.php" target="_blank" class="btn blue">PDF</a>
                        <a href="active_member_excel.php" target="_blank" class="btn yellow">Excel</a> 
			</div>
            <div class="portlet box green">

                    <div class="portlet-title">

                        <div class="caption"><i class="icon-globe"></i>List Featured Members</div>

                        

                    </div>

                    

                    <div class="portlet-body" style="overflow:hidden">
					
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
						<?php if(!empty($res))
							  { 
							 
							  ?>
                            <thead>
                                <tr>
                                   <th width="25px">#</th>
                                   <th>Photo</th>
                                   <th>ID</th> 
                                   <th>Full Name</th>
                                   <th>Membership</th>
                                   <th>Registration Date</th>
                                   <th>Gender</th>
                                   <th>Status</th>
                                   <th>Manage</th>      
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php
								for($i=0;$i<count($res);$i++){
									 ?>
                                <tr class="odd gradeX">
                                <td><?php echo ($i+1);?></td>

                                	<td><?php
											if(!empty($res[$i]['photo']))
											{
												//$path = "../second/upload/".$res[$i]['photo'];
												$path = "../upload/".$res[$i]['photo'];
												if (file_exists($path)) { 
													echo '<img class="size" src="'.$path.'"/>';
												}else{
													echo '<img class="size" src="../images/a1.jpg"/>';
												}
											}
											else
											{
												echo '<img class="size" src="../images/a1.jpg"/>';
											}
										?>
                                    </td>
                                    <td><?php echo $res[$i]['member_id'];?></td>	
	                                <td><?php echo $res[$i]['name'];?></td>	
                                    <td>
                                    <?php
									 if(empty($plans))
									 {
										echo '<a href="#" class="btn mini yellow">'."Free".'</a>';
									 }
									 else
									 {
										 echo '<a href="#" class="btn mini green">'."Paid".'</a>';
									 }
									 ?></td>
                                    <td><?php echo date('d M Y',strtotime($res[$i]['reg_date']));?></td>
                                    <td><?php if($res[$i]['gender'] == "F") { echo '<a href="#" class="btn mini pink">'."Female".'</a>'; } else { echo '<a href="#"  class="btn mini blue">'."Male".'</a>'; }?></td>	
                                    <td><?php echo '<a href="#" class="btn mini green">'.$res[$i]['status'].'</a>';?></td>	   	
                                   
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
				document.form_sample_3.flag.value = "n";
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