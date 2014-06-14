<?php
session_start();
include('../lib/myclass.php');
$select_code = "select * from mobile_codes where country = '".$_GET['q']."'";
$db_code = $obj->select($select_code);
?>
  <select name="drpMobcode" id="drpMobcode" style="width:140px; ">
  	 <?php for($i=0;$i<count($db_code);$i++) { ?>
            	<option value="<?php echo $db_code[$i]['id']; ?>" > <?php echo $db_code[$i]['mob_code']; ?></option>
          <?php } ?>
            </select>
            <?php 
			echo "~";
			if($_GET['q']=='India')
			{
				?>
				  <select name="state" id="state" class="span6 m-wrap required">
					<option value="Rajasthan">Rajasthan</option>
					<option value="Madhya Pradesh">Madhya Pradesh</option>
					<option value="Maharashtra">Maharashtra</option>
					<option value="Andhra Pradesh">Andhra Pradesh</option>
					<option value="Uttar Pradesh">Uttar Pradesh</option>
					<option value="Jammu and Kashmir">Jammu and Kashmir</option>
					<option value="Gujarat">Gujarat</option>
					<option value="Karnataka">Karnataka</option>
					<option value="Odisha">Odisha</option>
					<option value="Chhattisgarh">Chhattisgarh</option>
					<option value="Tamil Nadu">Tamil Nadu</option>
					<option value="Bihar">Bihar</option>
					<option value="West Bengal">West Bengal</option>
					<option value="Arunachal Pradesh">Arunachal Pradesh</option>
					<option value="Jharkhand">Jharkhand</option>
					<option value="Assam">Assam</option>
					<option value="Himachal Pradesh">Himachal Pradesh</option>
					<option value="Uttarakhand">Uttarakhand</option>
					<option value="Punjab">Punjab</option>
					<option value="Haryana">Haryana</option>
					<option value="Kerala">Kerala</option>
					<option value="Meghalaya">Meghalaya</option>
					<option value="Manipur">Manipur</option>
					<option value="Mizoram">Mizoram</option>
					<option value="Nagaland">Nagaland</option>
					<option value="Tripura">Tripura</option>
					<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
					<option value="Sikkim">Sikkim</option>
					<option value="Goa">Goa</option>
					<option value="Delhi">Delhi</option>
					<option value="Puducherry">Puducherry</option>
					<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
					<option value="Chandigarh">Chandigarh</option>
					<option value="Daman and Diu">Daman and Diu</option>
					<option value="Lakshadweep">Lakshadweep</option>
            </select>
            <?php 
			}
			else
			{
				?>
                <input type="text" name="state" data-required="1" class="span6 m-wrap required"/>
                <?php	
			}
			?>
            