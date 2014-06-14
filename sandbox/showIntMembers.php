<?php
include('lib/myclass.php');
session_start();

if($_GET['flag'] == "1")
{
	$sql = "SELECT * from express_interest where to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and is_accepted = 'Y'";	
}
else
{
	$sql = "SELECT * from express_interest where to_mem = '".$_SESSION['logged_user'][0]['member_id']."' and is_accepted = 'N'";	
}
$members=$obj->select($sql);

if(!empty($members))
{
	if($_GET['flag'] == "") { 
		echo "Listed here are the members who express interest for your profile."; 
	}
	else
	{ 
		echo "Listed here are the members whose interest you have accepted."; 
	} ?><br />
<form name="accept_form" id="accept_form" method="post" action="">
<?php
foreach($members as $mem)
{
	$sql2 = "SELECT members.*,member_photos.photo FROM members 
			 LEFT JOIN member_photos ON members.id = member_photos.member_id
			 WHERE
		 	 members.member_id = '".$mem['from_mem']."'";	
	
	$members_data=$obj->select($sql2);
?>
<div id="<?php echo $mem['id']; ?>">
	<input type="checkbox" id="chkMem[]" name="chkMem[]" value="<?php echo $mem['id']; ?>" />
    <input type="hidden" value="<?php echo $mem['id']; ?>" name="member_id" id="member_id" />
     <input type="hidden" value="<?php echo $members_data[0]['member_id']; ?>" name="accepted_member_id[]" id="<?php echo "CH".$mem['id'];  ?>" />
     
     
    <a href="view_profile.php?id=<?php echo $members_data[0]['id'];  ?>">
	<?php
	if(!empty($members_data[0]['photo']))
	{
		$path = "../upload/".$members_data[0]['photo'];
		
		if (file_exists($path))
		{ 
        	echo '<img title="view full profile" class="int_size" src="'.$path.'"/>';
		}
		else
		{
			echo '<img title="view full profile" class="int_size" src="'."../../Kannadalagna/images/a1.jpg".'"/>';
		}
	}
	else
	{
		echo '<img title="view full profile" class="int_size" src="'."../../Kannadalagna/images/a1.jpg".'"/>';
	}
	?>
    </a>
    <p style="vertical-align:text-top"> <?php echo $members_data[0]['name']."<br>".$members_data[0]['age']." Yrs, <br>".$members_data[0]['religion'];?>
</p></div><hr /><?php
}
if($_GET['flag'] == "") { ?>
<input type="button" name="submit" id="submit" value="Accept" />
<?php } ?>
</div>
</form>

<?php
}
else
{
	echo "Currently you have not received any interests.";
}
?>
<script>
	$('#submit').click(function() {
		var check = $("input:checkbox:checked").length;
		if(check == "0")
		{
			alert('Select atleast one profile');
			return false;
		}
		else
		{
			//$("#accept_form input[type=checkbox]").each(function(idx, elem) {
				
				/*$('#accept_form input:checkbox:checked').each(function(){
					var id = $(this).val();
				  		var mem_id = $('#CH'+id).val();
				   		alert(mem_id);
				   // Do something with is_checked
				});
				return false;
			$('#accept_form input:checkbox:checked').each(function(){
					var id = $(this).val();
					var mem_id = $('#member_id').val();
					alert(mem_id);
			});
			return false;*/
				
				$('#accept_form input:checkbox:checked').each(function(){
					var id = $(this).val();
					var mem_id = $('#member_id').val();
					//var hid = $('#CH'+id).val();
					var accepted_member_id = $('#CH'+id).val();
					jQuery.post("include/process.php", {
						member_id:id				
				},
				function(data, member_id)
				{
					if(data != "")
					{
						$('#'+id).html("Congratulations! You have successfully accepted interest of "+accepted_member_id);
						$('#'+id).css('color','green');
					}
					else
					{
						$('#'+id).html("Some Error Occurred");
						$('#'+id).css('color','red');
					}
			});
		});	
		}
	});

/*		var check = $("input:checkbox:checked").length;
		if(check == "0")
		{
			alert('Select atleast one profile');
			return false;
		}
		else
		{
			$('#accept_form input:checkbox:checked').each(function(){
  			var id = $(this).val();
			var for_mem_id = $('#member_id').val();
			var data =  "Congratulations! You have successfully accepted interest of "+for_mem_id;
			$('#'+id).html( data );
			
			return false;
  		});
	
		}
			
    });*/

</script>
<style>
.int_size
{
	height:75px;
	width:75px;
}
</style>
                        
