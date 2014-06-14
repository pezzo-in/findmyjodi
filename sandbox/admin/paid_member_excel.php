<?php
session_start();
include('../lib/myclass.php');

$sql = "SELECT members.*,member_plans.plan_id,member_plans.member_id,member_plans.paypal_transec_id,member_plans.purchase_date FROM members, member_plans where members.id=member_plans.member_id order by purchase_date DESC";

$ans=$obj->select($sql);	

$item=array();
$item[0][]='#';
$item[0][]='ID';
$item[0][]='Full Name';
$item[0][]='Date';
$item[0][]='Gender';
$item[0][]='Status';

for($i=0;$i<count($ans);$i++)
{
	$item[($i+1)][]=($i+1);
	$item[($i+1)][]=$ans[$i]['id'];
	$item[($i+1)][]=$ans[$i]['name'];
	$item[($i+1)][]=date('d-m-Y',strtotime($ans[$i]['reg_date']));
	$item[($i+1)][]=$ans[$i]['gender'];
	$item[($i+1)][]=$ans[$i]['status'];
	//$item=array(($i+1), $db_lead[$i]['lead_dtitle'], $user[0]['ppc_user_name'], $db_lead[$i]['status_name']);
}

$fp = fopen('excel/paid_members_'.date('Y-m-d').'.xls', 'w');

foreach ($item as $fields) {
    fputcsv($fp, $fields, "\t", '"');
}

fclose($fp);

$file = 'excel/paid_members_'.date('Y-m-d').'.xls';
?>
Please Wait...
<a href="<?php echo 'excel/paid_members_'.date('Y-m-d').'.xls'; ?>" id="link_save"></a>
<script>
document.getElementById('link_save').click();
setTimeout(function()
    {
        // submit form
       window.close();
    },1000);
//
</script>