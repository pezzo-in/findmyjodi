<?php
header('Content-type: application/pdf');
//==============================================================
include("mpdf.php");
$mpdf=new mPDF();
$mpdf->useAdobeCJK = true; // Default setting in config.php
// You can set this to false if you have defined other CJK fonts
$mpdf->SetAutoFont(AUTOFONT_ALL); // AUTOFONT_CJK | AUTOFONT_THAIVIET | AUTOFONT_RTL |
// () = default ALL, 0 turns OFF (default initially)
$html = "<table border=0>
 <tr>
 	<td>Hello</td>
	<td>Hi</td>
 </tr>
</table>
";
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
//==============================================================
?>