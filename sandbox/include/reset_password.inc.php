<?php 
$select_mem="select * from reset_password where unique_key = '".$_GET['enc']."'";
$db_mem=$obj->select($select_mem);	

if(empty($db_mem))
{
echo "<script> window.location.href = 'index.php' </script>";	
}
	if(isset($_POST['submit']))
	{
		
		if($_POST['new_password'] == $_POST['confirm_password'])
		{
				if(!empty($db_mem))
				{
						$update_page="UPDATE members SET password = '".md5($_POST['new_password'])."' where email_id = '".$db_mem[0]['user_email']."'";
						$db_updatepage=$obj->edit($update_page);	
						$delete_key = "delete from reset_password where unique_key = '".$_GET['enc']."'";
						$sel_delete	= $obj->sql_query($delete_key);
						echo "<script> window.location='success.php'</script>";
				}
			}
			else
			{
				$error= "Error : New password & Confirm new Password must be same";	
			}
		

	}
?>
<div  class="mid col-md-12 col-sm-12 col-xs-12 nopadding" style="width:95.3%;min-height: 380px;">
        	
            <div class="span1">
            	
                <?php if (isset($error)) { echo "<p class='message'>" .$error. "</p>" ;} ?>
               	<form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal">
        	<div class="new_acc">           
            	
            	<div class="left">                    
                    <label>New Password</label>
                    <input type="password" name="new_password" id="new_password">           
                    <label>Confirm New Password</label>
                    <input type="password" name="confirm_password" id="confirm_password">          
                </div>
                
                <br class="clear" />
                <div class="terms_line">
                <input type="submit" name="submit" onclick="return check_form()"/>
                </div>
                </form>
                </div>
            </div>
        </div>
        <script>
function check_form()
{
	$('#new_password').css('border','1px solid #ccc');
	$('#confirm_password').css('border','1px solid #ccc');
	
	if(document.getElementById('new_password').value=='')
	{
		$('#new_password').css('border','1px solid red');return false;
	}
	if(document.getElementById('confirm_password').value=='')
	{
		$('#confirm_password').css('border','1px solid red');return false;
	}
	if(document.getElementById('new_password').value!=document.getElementById('confirm_password').value)
	{
		$('#new_password').css('border','1px solid red');
		$('#confirm_password').css('border','1px solid red');
		return false;
	}
		return true;
}
 
</script>  
<style>
.message
{
	border:1px solid red;
	color:red;
	width:185px;
}
</style>
        
<style type="text/css" >
	.message{
	color: red; 
	font-weight:normal; 
	margin-right:385px;
	/*border:1px solid red;*/
	text-align:center;
	width:350px;
	}
	</style>        