<div class="header">

    <div class="banner-text">

		<?php
		$sql="select * from home_page_content order by id";
		$ans=$obj->select($sql);		
		$arr = explode(' ',$ans[0]['title']);
		?>
        <h1><span><?php echo $arr[0]; ?></span><br />
<?php echo substr(strstr($ans[0]['title']," "), 1);?>
</h1>

        <p><?php echo $ans[0]['content']; ?></p>
		<?php if($_SESSION['logged_user'][0]['id'] == "") { ?>
        <a href="register.php" class="btn-blue" title="Register Now"><span>Register Now</span></a>
        <?php } ?>

    </div>

    <div class="rightimg"><img src="images/banner_couple_img.png" /></div>

    <div class="searchbox">

        <form method="post" name="search_form" action="search_list.php">

            <div class="rdGender" style="font-size:15px;float:left;">
            <?php
                    $user2 = "select * from members where member_id = '".$_SESSION['logged_user'][0]['member_id']."' AND Status = 'Active'";
					$db_user2 = $obj->select($user2); ?>
                    <?php if($_SESSION['logged_user'][0]['member_id'] != '' ){ ?>
                     <input type="radio" name="Search_rdGender" id="regular_rdGender" value="M" <?php if($db_user2['0']['gender'] == 'F'){ ?> checked="checked"<?php } ?> style="padding-left:15px" /><label>&nbsp;Groom&nbsp;&nbsp;</label>
                	 <input type="radio" name="Search_rdGender" id="regular_rdGender" value="F" <?php if($db_user2['0']['gender'] == 'M'){ ?> checked="checked"<?php } ?> /><label>&nbsp;Bride&nbsp;&nbsp;</label>
                    <?php }else { ?>
                    
                	<input type="radio" name="Search_rdGender" id="regular_rdGender" value="M" style="padding-left:15px" /><label>&nbsp;Groom&nbsp;&nbsp;</label>
                	<input type="radio" name="Search_rdGender" id="regular_rdGender" value="F" checked="checked" /><label>&nbsp;Bride&nbsp;&nbsp;</label>
              <?php } ?>
            </div>

            <span style="float:left; margin:0;font-size:15px;">Age</span>

            <div class="select-age" id="age_from" style="margin:-5px 0 0 10px">

                <select name="Search_from_age" id="regular_from_age">
					<?php for($i=18;$i<=40;$i++) { ?>

                    <option value="<?php echo $i; ?>" <?php if($i == '0'){ ?> selected="selected"<?php } ?>><?php echo $i; ?></option>

                    <?php } ?>                    

                </select>

            </div>

            <span style="margin:0 10px;font-size:15px;">to</span>

            <div class="select-age" id="age_to" style="margin:-5px 0 0 0px">
			 <select name="Search_to_age" id="regular_to_age">
             	<?php for($j=18;$j<=40;$j++) { ?>
            	   <option value="<?php echo $j; ?>" <?php if($j == '40'){ ?> selected="selected"<?php } ?>><?php echo $j; ?></option>
                <?php } ?>   
             </select>     

            </div>

           

               <?php

				$caste_list = "select * from caste";

				$data = $obj->select($caste_list);

		    ?>

            <div class="select-gender select-country" style="margin:-5px 10px">

                <select name="Search_drpCaste" id="regular_drpCaste">

                	<option value="">Caste - Any</option>

                	<?php foreach($data as $res) { ?>

                    <option value="<?php echo $res['caste']; ?>"><?php echo $res['caste']; ?></option>

                    <?php } ?>

                </select>

            </div>

          
            <?php

				$lang_list = "select * from mother_tongues";

				$data = $obj->select($lang_list);

			?>

            <div class="select-gender select-country" style="margin:-5px 0px">

                <select name="Search_drpMotherTongue[]" id="regular_drpMotherTongue">

                <option value=""> Mother Tongue - Any</option>

                    <?php foreach($data as $res) { ?>

                    		<option value="<?php echo $res['name']; ?>"><?php echo $res['name']; ?></option>

                    <?php } ?>

                    

                </select>

            </div>

            

            <input type="submit" class="searchnow-btn" name="submit" style="margin:-8px -4px 0 0" />

        </form>

    </div>

</div>

<script>

$('#drpGender').change( function() {

			var val = $('#drpGender').val();

			if(val == 'M')

			{

				$("#drpLookingFor").val("F");

			}else

			{

				$("#drpLookingFor").val("M");

			}

		});	

$('#drpLookingFor').change( function() {

			var val = $('#drpLookingFor').val();

			if(val == 'M')

			{

				$("#drpGender").val("F");

			}else

			{

				$("#drpGender").val("M");

			}

		});	

/*$('.rdGender').change( function() {
	
	var gender = $('input[name=drpLookingFor]:checked').val();	
	if(gender == 'M')
	{
		var age_from = "20"; 
	}
	else
	{
		var age_from = "17";
	}
	$.ajax({

				url: 'makeAgeDrp.php',

				dataType: 'html',

				data: { drpFor :"age_from",age_from : age_from },

				success: function(data) {
					$('#age_from').html( data );
					var from = $('#drpAgeFrom').val();
						$.ajax({
	
						url: 'makeAgeDrp.php',
		
						dataType: 'html',
		
						data: {age_from : from},
		
						success: function(data) {
							$('#age_to').html( data );
		
						}
	
				});	

				}

			});	
});*/
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
<style>
.rdGender label {
    padding-right: 9px;
}
</style>