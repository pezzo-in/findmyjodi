<?php
$select_site = "select * from tbl_sitename where Id = '1'";
$db_site = $obj->select($select_site);
echo date('Y') ." &copy; " .$db_site[0]['Name'];
?>