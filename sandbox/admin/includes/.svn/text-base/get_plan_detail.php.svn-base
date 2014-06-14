<?php
include('lib/myclass.php');

session_start();
$select_plan = "select * from new_membership_plans where id = '".$_GET['plan_id']."'";
$ans = $obj->select($select_plan);
?>
<td>Duration</td>
<td><?php echo $ans[0]['plan_duration']; ?></td>
<td>Amount</td>
<td><?php echo $ans[0]['plan_amount']; ?></td>