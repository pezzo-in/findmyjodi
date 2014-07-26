<?php
	$sql = "SELECT * from contents where id=27";			 			  
	$data=$obj->select($sql);
?>
<div  class="mid col-md-12 col-sm-12 col-xs-12 nopadding">
	<div class="col-md-12 nopadding">
		 <?php echo $data[0]['detail']; ?>
    </div>     
</div>