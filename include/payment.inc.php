<script>
function redirectTopaypal()
{
    // redirect to paypal
    setTimeout(function()
    {
        // submit form
       document.getElementById("frmpaypal").submit();
    },3000);
}
</script>
<div class="mid" style="min-height:360px;">
	<span style='text-align: center;'><p style='margin-top: 20px;border: 1px solid;border-radius: 6px;padding: 8px 25px;margin-top:110px;'>Please<strong> do not</strong> close the PayPal window until you have been redirected to the thank you confirmation page on our website otherwise your order will not be processed.<br/><br/><br/>Please wait while we redirect you to Paypal...</p></span>
 
 	<?php
	$sql = "SELECT * from new_membership_plans where id='".$_POST['plan_id']."'";			 			  
	$data=$obj->select($sql);
	
	$finalamount = 'final_amount_'.$_POST['plan_id'];
	$final_amount = $_POST[$finalamount];
	
     $amount=currency_converter('INR','USD',$final_amount);
	
	?>
 	   
   <!-- <form id="frmpaypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="pixcapp_form">-->
  <form id="frmpaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" name="pixcapp_form">
        <input type="hidden" name="cmd" value="_xclick"/>
        <input type="hidden" name="amount" value="<?php echo $amount;/*$count;*/ ?>"/>
        <input type="hidden" name="business" value="drajesh.chowdary@gmail.com" /> <!-- drajesh.chowdary@gmail.com vipul.eng.55-facilitator@gmail.com -->
        <input type="hidden" name="notify_url" value="<?php echo $obj->SITEURL; ?>payment_notify.php"/>
        <input type="hidden" name="item_name" value="<?php echo $data[0]['plan_name']; ?>"/>
        <input type="hidden" name="currency_code" value="USD"/>
        <input type="hidden" name="return" value="<?php echo $obj->SITEURL; ?>thankyou.php"/>
        <input type="hidden" name="rm" value="2" />
        <input type="hidden" name="cancel_return" value="<?php echo $obj->SITEURL; ?>payment_error.php"/>   
        <input type="hidden" name="custom" value="<?php echo $_SESSION['logged_user'][0]['id'].'-'.$_POST['plan_id']; ?>" />
        <input type="hidden" name="cbt" value="Click here to return to site<?php //echo $homepageUrl; ?>"/>
	</form>
</div>

<?php
function currency_converter($from_Currency,$to_Currency,$amount) {
  //$url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";      
  //$url="https://www.google.com/finance/converter?hl=en&a=$amount&from=$from_Currency&to=$to_Currency";

  $amount = urlencode($amount);
  $from_Currency = urlencode($from_Currency);
  $to_Currency = urlencode($to_Currency);
  $get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
  $get = explode("<span class=bld>",$get);
  $get = explode("</span>",$get[1]);  
  //$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);

  return round($get[0],2);
}
?>