<?php
	$sql = "SELECT * from contents where id=5";			 			  
	$data=$obj->select($sql);
?>
<div class="mid">
	<div class="content_data">	
		 <?php echo $data[0]['detail']; ?>
    </div>     
</div>
<style>
.content_data
{
	width:954px;
	text-align:justify;
	font-family: avenir_45_bookregular;  
	font-size:14px;  
}

</style>