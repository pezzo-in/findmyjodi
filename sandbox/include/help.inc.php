<?php

	$sql = "SELECT * from contents where id=26";			 			  

	$data=$obj->select($sql);

?>

<div  class="mid col-md-12 col-sm-12 col-xs-12">

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