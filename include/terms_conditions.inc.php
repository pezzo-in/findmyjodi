<?php
	$sql = "SELECT * from contents where id=28";
	$data=$obj->select($sql);
?>
<div  class="mid col-md-12 col-sm-12 col-xs-12">
	<div class="col-md-12">
		 <?php echo $data[0]['detail']; ?>
    </div>
</div>