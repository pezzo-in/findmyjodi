<?php
session_start();

	include('lib/myclass.php');
	
	if($_POST["txn_id"]!='')
	{
		$str=explode('-',$_POST['custom']);
		
		$date = date("Y-m-d");
		
		$sql = "SELECT * from new_membership_plans where id=".$str[1];			 			  
		$data=$obj->select($sql);
	   //// Expire date ///////////
		$date = date("Y-m-d");
		$mon = '+ ' . $data[0]['plan_duration'] ."days" ;
		
		$newdate = strtotime ( $mon, strtotime ($date)) ;
		$expiry_date = date ( 'Y-m-d' , $newdate );
		
		/////////////////////////////
 		$sql_mem = "SELECT * from member_plans where member_id='".$str[0]."'";
		$db_mem = $obj->select($sql_mem);
		if(count($db_mem) == 0)
		{
			$inesrt_member = "insert into member_plans(id, plan_id, member_id, paypal_transec_id, purchase_date,expiry_date) values(null, '".$str[1]."', '".$str[0]."', '".$_POST['txn_id']."', '".date('Y-m-d')."','$expiry_date')";
			$db_insert=$obj->insert($inesrt_member);
		}
		elseif(count($db_mem) > 0)
		{
			echo $update_member="update member_plans set plan_id='".$str[1]."', paypal_transec_id='".$_POST['txn_id']."', purchase_date='".date('Y-m-d')."', expiry_date='$expiry_date' where member_id='".$str[0]."'";
			$update = $obj->edit($update_member);
		}
		
	}
?>