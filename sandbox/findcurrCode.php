<?php
include('lib/myclass.php');
 $country=($_GET['country']);
 $select_category = "select * from mobile_codes where country = '".$country."'";
 $db_category = $obj->select($select_category);
 
 
 ?>
<input type="text" name="txtcurr" id="txtcurr" class="form-control col-md-12 col-xs-12 col-sm-12" maxlength="10" style=" float:left; width:50px;" value="<?php echo $db_category[0]['curr_code']; ?>" tabindex="14" />