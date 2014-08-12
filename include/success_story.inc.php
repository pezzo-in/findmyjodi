<?php
if(isset($_POST['save']) && $_GET['id'] != '')
{
	if(!empty($_FILES['file']['name'])) 
	{
		move_uploaded_file($_FILES["file"]["tmp_name"],"upload/success_story/" . $_FILES["file"]["name"]);
	}
	$dd=$_POST['Edate'];
	$mm=$_POST['Emonth'];
	$yy=$_POST['Eyear'];
	$e_date=$yy."-".$mm."-".$dd;
	$characters = $_POST['bride_name']."123456789";
   $length = 10;
   $matri_id = "";
   for ($p = 0; $p < $length; $p++) {
        $matri_id .= $characters[mt_rand(0, strlen($characters))];
    }
	$insert = "INSERT into success_member_details(id, bride_name, groom_name,address, bride_matr_id, groom_matr_id, email_id, engag_or_marriage_date, photo, country, country_code, contact_no, story, status) values(NULL, '".$_POST['bride_name']."', '".$_POST['groom_name']."','".$_POST['address']."', '".$_POST['bride_id']."', '".$_POST['groom_id']."', '".$_POST['email']."', '".$e_date."', '".$_FILES["file"]["name"]."', '".$_POST['drpCountry']."', '".$_POST['drpMobcode']."',  '".$_POST['contact_no']."', '".$_POST['story']."', 'UnApprove ')";
	$db_ins=$obj->insert($insert);
	 
	$sqld="delete from members where id = '".$_GET['id']."' ";
	$obj->sql_query($sqld);
	session_destroy();
	$_SESSION['success']=='true';
	echo '<script> window.location.href = "index.php" </script>';		
}
if(isset($_POST['submit1'])){
	if(!empty($_FILES['file']['name'])) 
	{
		move_uploaded_file($_FILES["file"]["tmp_name"],"upload/success_story/" . $_FILES["file"]["name"]);
	}
	$dd=$_POST['Edate'];
	$mm=$_POST['Emonth'];
	$yy=$_POST['Eyear'];
	$e_date=$yy."-".$mm."-".$dd;
	$characters = $_POST['bride_name']."123456789";
   $length = 10;
   $matri_id = "";
   for ($p = 0; $p < $length; $p++) {
        $matri_id .= $characters[mt_rand(0, strlen($characters))];
    }
	$insert = "INSERT into success_member_details(id, bride_name, groom_name,address, bride_matr_id, groom_matr_id, email_id, engag_or_marriage_date, photo, country, country_code, contact_no, story, status) values(NULL, '".$_POST['bride_name']."', '".$_POST['groom_name']."','".$_POST['address']."', '".$_POST['bride_id']."', '".$_POST['groom_id']."', '".$_POST['email']."', '".$e_date."', '".$_FILES["file"]["name"]."', '".$_POST['drpCountry']."', '".$_POST['drpMobcode']."',  '".$_POST['contact_no']."', '".$_POST['story']."', 'UnApprove ')";
	
	 $db_ins=$obj->insert($insert);
	$_SESSION['success']=='true';
	echo '<script>alert('.$_SESSION['success'].')</script>';
	 echo '<script> window.location.href = "success_story.php" </script>';
}

if(isset($_GET['id']))
{
	$select_member = "select name,member_id,gender from members where id='".$_GET['id']."'";
	$db_member = $obj->select($select_member);
}

?>
	 	<div  class="mid col-md-12 col-sm-12 col-xs-12">
			<div id="tab-container">
                        <ul class="msgtab">
                            <li <?php if($_GET['flag'] == 'rag'){ echo "class='active'"; } ?>><a href="#success_story-1">Success Story</a></li>
                            <li <?php if($_GET['flag'] == 'adv'){ echo "class='active'"; } ?>><a href="#success_story-2">Post Your Success Story</a></li>
                        </ul> 
                        <a href="javascript:;" class="success_story" style="display:none"></a>
                        <div class="msgtab_content <?php if($_GET['flag'] == 'rag'){ echo "active"; } ?>" id="success_story-1">                        	
                        	<div class="partner_search1">
                            	<?php
									$select_story = "select * from success_member_details where status = 'Approve' ORDER BY id DESC";
									$db_select_story = $obj->select($select_story);
								?>
                             	<table width="100%" align="center" border="0" cellpadding="5" cellspacing="0">
                                	<?php for($i=0;$i<count($db_select_story);$i++) { ?>
                                    <tr>
                                    	<td width="12%"><img src="upload/success_story/<?php echo $db_select_story[$i]['photo']; ?>" width="100" height="100"  /></td>
                                        <td width="80%">
                                        <div style="width:100%; margin-top:-52px;" class="fleft content paddt15">
                                            <span class="boldtxt">
                                                <?php echo ucfirst($db_select_story[$i]['bride_name']).' ('.$db_select_story[$i]['bride_matr_id'].')'; ?> | <?php echo ucfirst($db_select_story[$i]['groom_name']).' ('.$db_select_story[$i]['groom_matr_id'].')'; ?>,									</span> 
                                            <span class="clr7">Marriage Date : <?php echo date('d-m-Y',strtotime($db_select_story[$i]['engag_or_marriage_date'])); ?></span>
                                            <div class="paddt10 paddb15"><?php echo $db_select_story[$i]['story']; ?></div>
                                        </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table> 
		                   	</div>          
                        </div>
                        <div class="msgtab_content  <?php if($_GET['flag'] == 'adv'){ echo "class='active'"; } ?>" id="success_story-2">
                        
                            <p><strong style="font-size: 21px;
											  color: #636363;
											  font-weight: normal;font-family: 'Open Sans, sans-serif';">
							Share your success story & Get an Attractive Gift!</strong><br/>
                            Share your Success Story and get an attractive gift. We will also plant a tree to 
                            celebrate and symbolize the beginning of your newly married life.
                             </p>
               
                        	<div class="partner_searchnew col-md-12 col-sm-12 col-xs-12">
                            <h2>Post Your Success Story</h2>
                    	<form name="success_story_form" id="success_story_form" method="post" enctype="multipart/form-data" >
                        	
                        	<div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">Bride Name(Female)<span style="color:#F00">*</span></label>
                           	 <input class="col-md-6 col-sm-9 col-xs-12 form-control" type="text" name="bride_name" id="bride_name" />
                            </div>
                            
                            <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">Groom Name(Male)<span style="color:#F00">*</span></label>
                           	 <input class="col-md-6 col-sm-9 col-xs-12 form-control" type="text" name="groom_name" id="groom_name" />
                            </div>
                            <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">Bride Membership Id<span style="color:#F00">*</span></label>
                            <?php if(isset($_GET['id']) && $db_member[0]['gender']=='F') { ?>
                           	 <input class="col-md-6 col-sm-9 col-xs-12 form-control" type="text" name="bride_id" id="bride_id" value="<?php echo $db_member[0]['member_id']?>" readonly="readonly"/>
                             <?php } else { ?>
                             <input class="col-md-6 col-sm-9 col-xs-12 form-control" type="text" name="bride_id" id="bride_id" onblur="check_user(this.value,1)"/>
                             <?php } ?>
                            </div>
                            <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">Groom Membership Id<span style="color:#F00">*</span></label>
                             <?php if(isset($_GET['id']) && $db_member[0]['gender']=='M') { ?>
                           	 <input class="col-md-6 col-sm-9 col-xs-12 form-control" type="text" name="groom_id" id="groom_id" value="<?php echo $db_member[0]['member_id']?>" readonly="readonly"/>
                             <?php } else { ?>
                            <input class="col-md-6 col-sm-9 col-xs-12 form-control" type="text" name="groom_id" id="groom_id" onblur="check_user(this.value,2)" />
                            <?php } ?>
                            </div>
                            <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">E-Mail<span style="color:#F00">*</span></label>
                           	 <input class="col-md-6 col-sm-9 col-xs-12 form-control" type="text" name="email" id="email" />
                            </div>
                           	
                            <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">Engagement/Marriage Date<span style="color:#F00">*</span></label>
                            <select class="col-md-6 col-sm-9 col-xs-12 nopadding form-control" name="Edate" id="Edate" style="width:80px; margin-right:10px;">
                                <option value="">DD</option>
                                <?php for($i=1;$i<32;$i++){ ?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                                </select>
                           
                                <select class="col-md-6 col-sm-9 col-xs-12 nopadding form-control" name="Emonth" id="Emonth" style="width:80px;  margin-right:10px;">
                                <option value="">MM</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                                </select>
                              
                                 <select class="col-md-6 col-sm-9 col-xs-12 nopadding form-control" name="Eyear"  id="Eyear" style="width:80px; ">
                                 <option value="">YYYY</option>
                                 
                               <?php for($j=2000;$j<=date('Y')+1;$j++){ ?>
                               <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                <?php }?>
                                  
                                 </select>
                            </div>
                            <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">Attach Photo<span style="color:#F00">*</span></label>
                           	 <input class="col-md-6 col-sm-9 col-xs-12 form-control" type="file" name="file" id="file" />
                            </div>
                            <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">Address<span style="color:#F00">*</span></label>
                           	<textarea class="col-md-6 col-sm-9 col-xs-12 nopadding form-control" name="address" id="address" rows="5" cols="30"></textarea>
                            </div>
                            
                            
                             <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">Country living in<span style="color:#F00">*</span></label>
                            <select class="col-md-6 col-sm-9 col-xs-12 nopadding form-control" name="drpCountry" id="drpCountry" onchange="showmobcode(this.value)">  
                              <option value="">---Select---</option>
                             <?php
									$country_list="select * from mobile_codes";
									$country=$obj->select($country_list);
									foreach($country as $cnt)
									{ ?>
                                    	<option value="<?php echo $cnt['country']; ?>"><?php echo $cnt['country']; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            
                            <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">Country Code<span style="color:#F00">*</span></label>
                            <div id="txtHint234">
                           	<select class="col-md-6 col-sm-9 col-xs-12 nopadding form-control" name="drpMobcode" id="drpMobcode">
                             <option value="">---Select---</option>	
                           <?php  $select_code = "select * from mobile_codes";
								  $db_code = $obj->select($select_code);
								  for($i=0;$i<count($db_code);$i++) { ?>
                                  <option value="<?php echo $db_code[$i]['id']; ?>" > <?php echo $db_code[$i]['mob_code']; ?></option>
          						<?php } ?>
            				</select>
                             </div>
                            </div>
                            
                            <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">Telephone<span style="color:#F00">*</span></label>
                           	 <input class="col-md-6 col-sm-9 col-xs-12 form-control" type="text" name="contact_no" id="contact_no" />
                            </div>
                            
                            <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">Success Story<span style="color:#F00">*</span></label>
                           	<textarea class="col-md-6 col-sm-9 col-xs-12 nopadding form-control" name="story" id="story"  rows="5" cols="30"></textarea>
                            </div>
           
                            <div class="fields">
                            <label class="col-md-3 col-sm-3 col-xs-12 nopadding">&nbsp;</label>
                           <?php if($_GET['id'] != ''){ ?>
                            <input class="col-md-6 col-sm-9 col-xs-12 form-control" type="submit" name="save" id="success_story" class="submit_btn_new1" style="margin-left:215px;" />
                            <?php }else{ ?>
                            <input class="col-md-6 col-sm-9 col-xs-12 form-control" type="submit" name="submit1" id="success_story" class="submit_btn_new1" style="margin-left:215px;" />
                            <?php } ?>
                            </div>
                        </form>    
                   	</div>          
                        </div>
                   	</div>
        </div>
<style type="text/css">
#success_story
{
width:90px; height:33px; float:left; clear:both; background:url(images/submit_btn.png) no-repeat left top;
 border:none; text-indent:-9999px; overflow:hidden; font-size:0; text-align: left; cursor:pointer; color:#f46989; 
 *margin-right:30px; margin-top:10px;margin-left:153px;
}
</style>
<script>
function check_user(val,user)
{
	$.ajax({
			url:'check_valid_user.php',
			type:'POST',
			data:{val:val,user:user},
			success: function(data)
			{
				if(data=='1')
				{
					if(user=='1'){$('#bride_id').val(null); $('#bride_id').css('border','1px solid red');}
					else if(user=='2'){$('#groom_id').val(null); $('#groom_id').css('border','1px solid red');}
				}
			}
		});
}

$("#success_story").click(function()
{ 
	$('#bride_name').css('border','1px solid #ccc');
	$('#groom_name').css('border','1px solid #ccc');
	$('#bride_id').css('border','1px solid #ccc');
	$('#groom_id').css('border','1px solid #ccc');
	$('#contact_no').css('border','1px solid #ccc');
	$('#file').css('border','1px solid #ccc');
	$('#email').css('border','1px solid #ccc');
	$('#Edate').css('border','1px solid #ccc');
	$('#Emonth').css('border','1px solid #ccc');
	$('#Eyear').css('border','1px solid #ccc');
	$('#address').css('border','1px solid #ccc');
	$('#drpCountry').css('border','1px solid #ccc');
	$('#dprMobCode').css('border','1px solid #ccc');
	$('#story').css('border','1px solid #ccc');
	
	var error = 0;
	
	if($('#bride_name').val()=='')
	{
		$('#bride_name').css('border','1px solid red');
		error=1;
	}
	if($('#groom_name').val()=='')
	{
		$('#groom_name').css('border','1px solid red');	
		error=1;
	}
	if($('#bride_id').val()=='')
	{
		$('#bride_id').css('border','1px solid red');
		error=1;
	}
	if($('#groom_id').val()=='')
	{
		$('#groom_id').css('border','1px solid red');
		error=1;
	}
	if($('#contact_no').val()=='')
	{
		$('#contact_no').css('border','1px solid red');
		error=1;
	}
	if($('#file').val()=='')
	{
		$('#file').css('border','1px solid red');		
		error=1;
	}
	if($('#address').val()=='')
	{
		$('#address').css('border','1px solid red');		
		error=1;
	}	
	if($('#drpCountry').val()=='')
	{
		$('#drpCountry').css('border','1px solid red');	
		error=1;
	}
	if($('#drpMobcode').val()=='')
	{
		$('#drpMobcode').css('border','1px solid red');		
		error=1;
	}	
	if($('#story').val()=='')
	{
		$('#story').css('border','1px solid red');		
		error=1;
	}	
	if($('#email').val()=='')
	{
		$('#email').css('border','1px solid red');		
		error=1;
	}
		
	var x=document.getElementById('email').value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	{
		  $('#email').css('border','1px solid red');
		  error=1;
	}
	if($('#Edate').val()=='')
	{
		$('#Edate').css('border','1px solid red');
		  error=1;
	}
	if($('#Emonth').val()=='')
	{
		$('#Emonth').css('border','1px solid red');
		  error=1;
	}
	if($('#Eyear').val()=='')
	{
		$('#Eyear').css('border','1px solid red');
		error=1;
	}
	if(error==0)
		return true;
	else
		return false;
});
</script>
<?php if($_SESSION['success']=='true') {
	echo '<script>alert('.$_SESSION['success'].')</script>';
	 ?>
<script>
	$(".success_story").trigger("click");  
</script>
<?php } //unset($_SESSION['success']); } ?>
      
        