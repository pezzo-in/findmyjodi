<?php 
if(isset($_GET['age_from']))
{
	$age_From = ($_GET['age_from'] + 1); 
}

if(isset($_GET['change_style']))
{
	if($_GET['change_style'] == 'y')
	{ ?>
	 <select name="drpAgeTo" id="drpAgeTo" style="width:70px;margin-left:140px;">
	 <?php for($i=$age_From;$i<=50;$i++) { ?>
			   <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	   <?php } ?>       
	 </select>
	
	<?php }
}
else if(isset($_GET['drpFor']))
{?>
	 <select name="drpAgeFrom" id="drpAgeFrom">
 		<?php for($i=$_GET['age_from']+1;$i<=50;$i++) { ?>
           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
   <?php } ?>       
 </select>
<?php
}
else {
?>
 <select name="drpAgeTo" id="drpAgeTo">
 <?php for($i=$age_From;$i<=50;$i++) { ?>
           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
   <?php } ?>       
 </select>
 <?php } ?>
<script>
$('#drpAgeFrom').change( function() {
	
	var age_from = $('#drpAgeFrom').val();
			$.ajax({

				url: 'makeAgeDrp.php',

				dataType: 'html',

				data: { age_from : age_from },

				success: function(data) {

					$('#age_to').html( data );

				}

			});	

});

</script>