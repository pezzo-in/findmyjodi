<form id="search" method="post" name="search" class="myform" enctype="multipart/form-data"	>
      <label>Member ID</label>
      	<input type="text" id="member_id" onchange="return check_form()">       
         <input type="button" name="submit" id="submit_btn"  onclick="return check_form()">                    
</form>
<script>
$('#submit_btn').click( function() {
		
		
	$('#member_id').css('border','1px solid #ccc');
	if(document.getElementById('member_id').value=='')
	{
		$('#member_id').css('border','1px solid red');
		member_id=1
	}
	else
	{
		member_id=0
	}
	
	if(member_id==0)
	{
		return true;
	}
	else
	{
		return false;
	}
});	
</script>

