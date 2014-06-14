<?php
include('lib/myclass.php');

$select="select * from tbl_user_post where Id='".$_GET['id']."'";
$db_select=$obj->select($select);
?>
<img src="upload/<?php echo $db_select[0]['Image']; ?>" />