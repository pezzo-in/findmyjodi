<?php
$url=explode('/',$_SERVER['REQUEST_URI']);
include('../lib/myclass.php');

$sql = "select * from membership_plans where id = '".$_POST['rdPlanId']."'"; 
$ans=$obj->select($sql);
?>

<html>
<head>
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
</head>
<body onLoad="redirectTopaypal();" style='width: 70%;margin: 0 auto;'>
<span style='text-align: center;'><p style='margin-top: 20px;border: 1px solid;border-radius: 6px;padding: 8px 25px;'>Please<strong> do not</strong> close the PayPal window until you have been redirected to the thank you confirmation page on our website otherwise your order will not be processed.<br/><br/><br/>Please wait while we redirect you to Paypal...</p></span>
<!-----------pay pal form------------->
<!--<form id="frmpaypal" action="https://www.sandbox.paypal.com/au/cgi-bin/webscr" method="post" name="pixcapp_form">-->
<form id="frmpaypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="pixcapp_form">
    <input type="hidden" name="cmd" value="_xclick"/>
    <input type="hidden" name="amount" value="<?php echo $ans[0]['plan_amount']; ?>"/>
    <input type="hidden" name="business" value="patel.ajay053-facilitator@gmail.com"/> <!-- vipul.eng.55-facilitator@gmail.com -->
    <input type="hidden" name="notify_url" value="http://173.193.205.157/Kannadalagna/administrator/notify.php"/>
    <input type="hidden" name="item_name" value="<?php echo $ans[0]['plan_name']; ?>"/>
    <input type="hidden" name="currency_code" value="USD"/>	   
    <input type="hidden" name="return" value=<?php if($_POST['flag'] == "1") { ?>"http://173.193.205.157/Kannadalagna/thank-you.php"
    						<?php }  else {  ?>"http://173.193.205.157/Kannadalagna/administrator/thankyou.php" <?php  } ?>/>
    <input type="hidden" name="rm" value="2" />
    <input type="hidden" name="cancel_return" value="http://173.193.205.157/Kannadalagna/administrator/error.php"/>
    <input type="hidden" name="custom" value="<?php echo $ans[0]['id'];  ?>"/>
    <input type="hidden" name="custom" value="<?php echo $ans[0]['id']."|".$_POST['member_id']."|"; ?>" />
     <input type="hidden" name="custom" value="<?php echo $ans[0]['id']."|".$_POST['member_id']."|"; ?>" />
    <input type="hidden" name="member_id" value="<?php echo $_POST['member_id'];  ?>"/>
    
</form>
</body>
</html>