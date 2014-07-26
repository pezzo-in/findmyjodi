<?php
	$sql = "SELECT distinct plan_name from membership_plans";			 			  
	$data=$obj->select($sql);
	
	$lastid = "select max(id) as last_id from members";
	$ans = $obj->select($lastid);
	
?>
<div  class="mid col-md-12 col-sm-12 col-xs-12 nopadding" style="height:300px;">
<div class="backtolink"><a href="photo_upload.php">Skip this page »&nbsp;&nbsp;&nbsp;</a>||<a href="index.php?logged=y&mem_id=<?php echo $ans[0]['last_id']; ?>">&nbsp;&nbsp;&nbsp;Continue To Home Page »</a></div>
			
            <h3>Upload multiple photos to increase your response.</h3>
Adding photo makes your profile complete, authentic and delivers more response. Add as many photos as possible, with a maximum of 10 photos. It's best to have your photograph taken by a professional.
		<form name="photo_upload_form" method="post" action="#" style="padding-top:30px">
            <input type="file" name="file[]" multiple="true" id="file" style="color:black" />
            <input type="submit" name="submit">
        </div>