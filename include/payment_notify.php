<?php
	include('lib/myclass.php');
	
	if($_POST["txn_id"]!='')
	{
		$str=explode('-',$_POST['custom']);
		
		$date = date("Y-m-d");
		
		$sql = "SELECT * from new_membership_plans where id=".$str[1];			 			  
		$data=$obj->select($sql);
	
		$plan_duration = 
		$mon = '+ ' . $data[0]['plan_duration'] ."days" ;
		
		$newdate = strtotime ( $mon, strtotime ($date )) ;
		$expiry_date = date ( 'Y-m-j' , $newdate );
		
		$sql_mem = "SELECT * from member_plans where member_id='".$_SESSION['logged_user'][0]['id']."' and expiry_date>'".date('Y-m-d')."'";
	    $data_mem=$obj->select($sql_mem);
		
	 	if(count($data_mem==1))
		{ 
			$update_member="update member_plans set plan_id='".$str[1]."', paypal_transec_id='".$_POST['txn_id']."',expiry_date='$expiry_date' where member_id='".$_SESSION['logged_user'][0]['id']."'";
			$obj->edit($update_member);
		}
		else
		if(count($data_mem==0))
		{
			$inesrt_member = "insert into member_plans(id, plan_id, member_id, paypal_transec_id, purchase_date,expiry_date)
			values(null, '".$str[1]."', '".$str[0]."', '".$_POST['txn_id']."', '".date('Y-m-d')."','$expiry_date')";
			$db_insert=$obj->insert($inesrt_member);
		}
		
		
		
	}	
?>