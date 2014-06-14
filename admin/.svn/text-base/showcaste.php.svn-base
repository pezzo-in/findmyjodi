<?php
session_start();
include('../lib/myclass.php');
//echo $_GET['q'];
$select_caste = "select * from caste where religion_id = '".$_GET['q']."'";
$db_caste = $obj->select($select_caste);

?>

  <select name="caste" class="span6 m-wrap required" onchange="showsubcaste(this.value);">
  <!-- <option value="Select Mobile Code">Select Mobile Code</option>-->
  	 <?php for($i=0;$i<count($db_caste);$i++) { ?>
            	<option value="<?php echo $db_caste[$i]['id']; ?>" > <?php echo $db_caste[$i]['caste']; ?></option>
          <?php } ?>
            </select>