<?php
	$sql = "SELECT * from new_membership_plans";			 			  
	$data=$obj->select($sql);
	
	$sql_mem = "SELECT * from member_plans where member_id='".$_SESSION['logged_user'][0]['id']."' and expiry_date>'".date('Y-m-d')."'";
	$data_mem=$obj->select($sql_mem);
?>
<script>
function displayplan(plan)
{
	
document.getElementById('plan_id').value=plan;	
}
</script>
<div class="mid">
<?php if($_GET['redirect']=='account'){ ?>
<div class="backtolink"><a href="thank-you.php">&nbsp;&nbsp;&nbsp;Continue To Home Page »</a></div>
<?php } ?>
 <form name="form1" action="payment.php" method="post">

			<div id="tab-container">
                <div class="plan-box-main">
            	<div class="plan-box-in">
                <?php for($i=0;$i<count($data);$i++) { ?>
                    <div <?php if($i==1) { ?>class="memb-plan-diamnd-box"<?php } else { ?>class="memb-plan-box"<?php } ?>>
                        <?php if($i==1) { ?><div class="inner"><?php } ?><label for="category_<?php echo $i+1;?>">
                        <div class="title">  
                        <?php 
						?>
         <input type="radio" name="plan_name" id="category_<?php echo $i+1;?>" <?php if(count($data_mem)==1) { if($data[$i]['id']==$data_mem[0]['plan_id']) {
							?>
							checked="checked" disabled="disabled"
							
							<?php } 
								elseif($data[$i]['id']<$data_mem[0]['plan_id'] && count($data_mem)==1) { ?> disabled="disabled"<?php }
							
							
							} elseif($i==0) { ?>checked="checked"<?php } ?> onclick="displayplan('<?php echo $data[$i]['id'];?>')";>
							
							<?php echo $data[$i]['plan_name']; ?>            
                        </div>
                        <?php $month = floor($data[$i]['plan_duration']/30); ?>
                        <div class="line"><span><?php echo $month; ?> Months</span></div>
                        <div class="price"><span>Rs.</span><?php echo $data[$i]['plan_amount']; ?></div>
                        <div class="per-day">( Rs. <?php echo ceil($data[$i]['plan_amount']/$month); ?> / Month )</div>
                        </label><?php if($i==1) { ?></div><?php } ?>
                    </div>
                 <?php } ?>
                </div> 
                
               <div class="package-details">
                	<?php for($i=0;$i<count($data);$i++) { ?>
<div class="pdet<?php echo $i+1;?>" <?php if($data[$i]['id']==$data_mem[0]['plan_id']) { ?>style="display:block;"<?php } elseif($data_mem[0]['plan_id']=='' && $i==0){ ?>style="display:block;"<?php } else { ?>style="display:none;"<?php } ?>>
                    	<div class="arr"></div>
                    	<h2>Benefits of <?php echo $data[$i]['plan_name']; ?> Package</h2>
                    	<div class="pdet-txt">
                    		<ul>
                            	<li>Send <?php echo $data[$i]['allow_messages']; ?> messages to your matches</li>
                                <li>View <?php echo $data[$i]['no_of_contacts']; ?> verified mobile numbers</li>
                                <li>Chat with Prospects Directly</li>
                            </ul>
                        </div>                        
                    </div>
                   <?php } ?>
               </div>
               <div class="payment-mode-sel">
                	<div class="pmode-left">
                    	<h2>Select Payment Mode</h2>
                    	<div class="pmode-left-in">
                    		<div class="pmode-type">
                            	<label for="pmode1">
                                	<input type="radio" checked="checked" name="pmtmode" id="pmode1" />
                                    <div class="mode-img"><img src="images/paypal-img1.png" /></div>
                                    <div class="mode-title">Pay using Paypal</div>
                                    <input type="submit" class="paypal-btn" />
                                </label>
                            </div>
                            <div class="pmode-type">
                            	<label for="pmode2">
                                	<input type="radio" name="pmtmode" id="pmode2" />
                                    <div class="mode-img"><img src="images/paybyvisa.gif" /></div>
                                    <div class="mode-title">Pay using Credit Card / Debit Card / Net Banking / Cash Card / Mobile Payments :</div>
                                    <input type="submit" class="other-btn" />
                                </label>
                            </div>
                        </div>
                    </div>
                   
                    <div class="pmode-right">
                    	<h2>Summary</h2>
                      
                        <?php for($i=0;$i<count($data);$i++) {
							if($data[$i]['id']==$data_mem[0]['plan_id'])
							{
									$month2 = floor($data[$i]['plan_duration']/30);
									$amount = ceil($data[$i]['plan_amount']/$month2);
							}
							
							 if(count($data_mem)==1) 
							   { 
									$datetime1 = strtotime(date('Y-m-d h:i:s'));
									$datetime2 = strtotime($data_mem[0]['purchase_date']);
									
									$secs = $datetime1-$datetime2 ;// == <seconds between the two times>
									$days = $secs / 86400;
									$remain = ceil($days/30);
									
									$final_amount = $data[$i]['plan_amount']-(($month2-$remain)*$amount);
									
								  }
							
							
							 ?>
                    	<div class="pmode-right-in" id="summary<?php echo $i+1;?>" <?php if($data[$i]['id']==$data_mem[0]['plan_id']) { ?>style="display:block;"<?php } elseif($data_mem[0]['plan_id']=='' && $i==0){ ?>style="display:block;"<?php } else { ?>style="display:none;"<?php } ?>>
                        	<div class="summarybox">
                                <h3>Membership</h3>
                                 <?php echo $data[$i]['plan_name']; ?> for <?php echo floor($data[$i]['plan_duration']/30); ?> months - Rs. <?php echo $data[$i]['plan_amount']; ?> 
                            </div>
                            <div class="summarybox">
                                <h3>Value Added</h3>
                                 <?php echo $data[$i]['no_of_contacts']; ?> verified mobile numbers + Send <?php echo $data[$i]['allow_messages']; ?> SMS +
Chat with Prospects Directly 
                            </div>
                            <div class="summarybox total">
                                <h3>Your Total: Rs.  <?php if(count($data_mem)==1){echo $final_amount; } else {echo $data[$i]['plan_amount'];} ?>
                                                        
                                                        
 <input type="hidden" name="final_amount_<?php echo $i+1;?>" id="final_amount_<?php echo $i;?>"  value="<?php if(count($data_mem)==1){echo $final_amount; } else {echo $data[$i]['plan_amount'];} ?>"/>
                                </h3>
                            </div>
                        </div>
                        <?php } ?>
                        
                      <input type="hidden" name="plan_id" id="plan_id" value="1"/>
                        
                    </div>
                  
                </div>   
            </div>
           </div>
           
           </form>
</div>
<!--<script>
$(document).ready(function(){
<?php //if(count($data_mem)!=1) { ?>
		if($("#category_1").attr('checked','checked'))
		{$('.payment-mode-sel').css('display','block');}
		else{$('.payment-mode-sel').css('display','none');}
	
<?php //} ?>
for(var i=1;i<=3;i++)
	{
		$("#category_"+i).click(function(){
		$('.payment-mode-sel').css('display','block');
		});	
	}
	});
</script>-->