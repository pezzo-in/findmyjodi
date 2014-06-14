<?php
session_start();
include('../lib/myclass.php');
//echo $_GET['q'];
$select_subcaste = "select * from subcaste where caste_id = '".$_GET['q']."'";
$db_subcaste = $obj->select($select_subcaste);

?>

  <select name="subcaste" class="span6 m-wrap required">
  <!-- <option value="Select Mobile Code">Select Mobile Code</option>-->
  	 <?php for($i=0;$i<count($db_subcaste);$i++) { ?>
            	<option value="<?php echo $db_subcaste[$i]['id']; ?>" > <?php echo $db_subcaste[$i]['subcaste']; ?></option>
          <?php } ?>
            </select>