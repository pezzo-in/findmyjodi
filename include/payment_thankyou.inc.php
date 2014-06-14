<?php
	session_start();
	$userid = $_SESSION['logged_user'][0]['id'];
 	$plan_id =$_SESSION['plan_id'];
	$order_id = $_SESSION['order_id'];
	$rdate = date('Y-m-d');
	
	    $sql = "SELECT * from new_membership_plans where id=".$plan_id;			 			  
		$data=$obj->select($sql);
	   //// Expire date ///////////
		$date = date("Y-m-d");
		$mon = '+ ' . $data[0]['plan_duration'] ."days" ;
		
		$newdate = strtotime ( $mon, strtotime ($date)) ;
		$expiry_date = date ( 'Y-m-d' , $newdate );
	
	
	
	
 	   $sql_mem = "SELECT * from member_plans where member_id='$userid'";
		$db_mem = $obj->select($sql_mem);
		
		if(count($db_mem) == 0)
		{
			$sql_insert = "INSERT INTO member_plans (plan_id,member_id,paypal_transec_id,order_id,purchase_date,expiry_date) VALUES('$plan_id','$userid','$order_id','$order_id','$rdate','$expiry_date')";
	$result = $obj->insert($sql_insert);
		}
		elseif(count($db_mem) > 0)
		{
			 $update_member="update member_plans set plan_id='$plan_id',paypal_transec_id='$order_id', order_id='$order_id', purchase_date='".date('Y-m-d')."', expiry_date='$expiry_date' where member_id='$userid'";
			$update = $obj->edit($update_member);
		}
	
	
?>


<div class="mid" style="height:300px">

<div class="mid_top">

<div class="thankyou_msg">Thanks for  you for your payment.
</div>

   </div>

   </div> 