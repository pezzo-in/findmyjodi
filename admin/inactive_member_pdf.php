<?php
session_start();
include('../lib/myclass.php');

$sql = "SELECT members.*,member_photos.photo FROM members LEFT JOIN member_photos ON members.id=member_photos.member_id where is_deleted = 'N' and status = 'Deactive' order by members.id";
$ans=$obj->select($sql);	

$message='';
$message='<h3>Inactive Member List</h3><table cellpadding="5" cellspacing="0" style="width:100%;border:1px solid" >';

	$message .= '<tr>';
	$message .= '<th align="left" style="border-bottom:1px solid">#</th>';
	$message .= '<th align="left" style="border-bottom:1px solid">ID</th>';
	$message .= '<th align="left" style="border-bottom:1px solid">Full Name</th>';
	$message .= '<th align="left" style="border-bottom:1px solid">Email</th>';
	$message .= '<th align="left" style="border-bottom:1px solid">Mobile</th>';
	$message .= '<th align="left" style="border-bottom:1px solid">Date</th>';
	$message .= '<th align="left" style="border-bottom:1px solid">Gender</th>';
	$message .= '<th align="left" style="border-bottom:1px solid">Status</th>';
	$message .= '</tr>';

for($i=0;$i<count($ans);$i++)
{
	$message .= '<tr>';
	$message .= '<td style="border-bottom:1px solid">'.($i+1).'</td>';
	$message .= '<td style="border-bottom:1px solid">'.$ans[$i]['id'].'</td>';
	$message .= '<td style="border-bottom:1px solid">'.$ans[$i]['name'].'</td>';
	$message .= '<td style="border-bottom:1px solid">'.$ans[$i]['email_id'].'</td>';
	$message .= '<td style="border-bottom:1px solid">'.$ans[$i]['mobile_no'].'</td>';
	$message .= '<td style="border-bottom:1px solid">'.date('d-m-Y',strtotime($ans[$i]['reg_date'])).'</td>';
	$message .= '<td style="border-bottom:1px solid">'.$ans[$i]['gender'].'</td>';
	$message .= '<td style="border-bottom:1px solid">'.$ans[$i]['status'].'</td>';
	$message .= '</tr>';
}

$message .= "</table>";
		
		
include("MPDF53/mpdf.php");

$mpdf=new mPDF('c'); 

$mpdf->WriteHTML($message);

$mpdf->Output();
exit;
?>