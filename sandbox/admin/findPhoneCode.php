<?php
include('../lib/myclass.php');
 $country=($_GET['country']);
 $select_category = "select * from mobile_codes where country = '".$country."'";
 $db_category = $obj->select($select_category);
 
 $select_category2 = "select * from mobile_codes";
 $db_category2 = $obj->select($select_category2);
 ?>
<div class="controls">
<select  id="drpMobcode">
<?php foreach($db_category2 as $db) {  ?>
		<option value="<?php echo $db['mob_code']; ?>" <?php if($db['mob_code'] == $db_category[0]['mob_code']){ $curr = $db['mob_code']; ?> selected="selected" <?php } ?>}) ?><?php echo $db['mob_code']; ?></option>
<?php } ?>
</select>
<div class="controls">
 <input type="hidden" name="mob_code" class="m-wrap medium required"  value="<?php echo $curr; ?>" />                     
</div>

</div>