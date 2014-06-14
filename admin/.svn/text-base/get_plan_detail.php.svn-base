<?php
include('../lib/myclass.php');

session_start();
$select_plan = "select * from new_membership_plans where id = '".$_POST['plan_id']."'";

$ans = $obj->select($select_plan);
?>
<tr>
<td>Duration :</td>
<td> <input type="text" width="15px" name="txtDuration" id="txtDuration" value="<?php echo $ans[0]['plan_duration']; ?>" /></td>
</tr>
<tr>
<td>Amount :</td>
<td> <input type="text" name="txtAmount" id="txtAmount" value="<?php echo $ans[0]['plan_amount']; ?>" /></td>
</tr>