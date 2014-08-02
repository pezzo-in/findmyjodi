<?php

session_start();

include('lib/myclass.php');

//echo $_GET['q'];

$select_code = "select * from mobile_codes where country = '".$_GET['q']."'";

$db_code = $obj->select($select_code);



?>



  <select name="drpMobcode" id="drpMobcode" class="col-md-2 col-sm-2 col-xs-12 form-control">

  <!-- <option value="Select Mobile Code">Select Mobile Code</option>-->

  	 <?php for($i=0;$i<count($db_code);$i++) { ?>

            	<option value="<?php echo $db_code[$i]['id']; ?>" > <?php echo $db_code[$i]['mob_code']; ?></option>

          <?php } ?>

            </select>