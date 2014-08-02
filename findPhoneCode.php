<?php
include('lib/myclass.php');
 $country=($_GET['country']);
 $select_category = "select * from mobile_codes where country = '".$country."'";
 $db_category = $obj->select($select_category);
 
 $select_category2 = "select * from mobile_codes";
 $db_category2 = $obj->select($select_category2);
 
 $select_category3 = "select distinct(curr_code) from mobile_codes where curr_code!=''";
 $db_category3 = $obj->select($select_category3);
 ?>
<select  id="drpMobcode" name="mob_code" class="col-md-12 col-sm-12 col-xs-12 form-control">
<?php foreach($db_category2 as $db) {  ?>
		<option value="<?php echo $db['mob_code']; ?>" <?php if($db['mob_code'] == $db_category[0]['mob_code']){ ?> selected="selected" <?php } ?>><?php echo $db['mob_code']; ?></option>
<?php } ?>
</select>~<select id="txtcurr" name="txtcurr" class="form-control col-md-12 col-xs-12 col-sm-12">
                        <?php foreach($db_category3 as $db1) {  ?>
                        <option value="<?php echo $db1['curr_code']; ?>" <?php if($db1['curr_code'] == $db_category[0]['curr_code']) { ?> selected="selected" <?php } ?>><?php echo $db1['curr_code']; ?></option>
                            
<?php } ?>
 	</select>