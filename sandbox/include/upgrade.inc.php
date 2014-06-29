<?php
	$sql = "SELECT * from new_membership_plans";			 			  
	$data=$obj->select($sql);
?>
<div  class="mid col-md-12 col-sm-12 col-xs-12">
			<div id="tab-container">
                <div class="plan-box-main">
            	<div class="plan-box-in">
                <?php for($i=0;$i<count($data);$i++) { ?>
                    <div <?php if($i==1) { ?>class="memb-plan-diamnd-box"<?php } else { ?>class="memb-plan-box"<?php } ?>>
                        <?php if($i==1) { ?><div class="inner"><?php } ?><label for="category_<?php echo $i+1;?>">
                        <div class="title">  
                            <input type="radio" name="plan_name" id="category_<?php echo $i+1;?>" <?php if($i==0) { ?>checked="checked"<?php } ?>>
							
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
<div class="pdet<?php echo $i+1;?>" <?php if($i==0){ ?>style="display:block;"<?php } else { ?>style="display:none;"<?php } ?>>
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
               <!--<div class="payment-mode-sel">
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
                        <?php for($i=0;$i<count($data);$i++) { ?>
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
                                <h3>Your Total: Rs. <?php echo $data[$i]['plan_amount']; ?></h3>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>-->   
            </div>
           </div>
            <!--<div id="tab-container">
                        <?php /*?><ul class="msgtab">
                            <li><a href="#packagetab-1">Regular Packages</a></li>
                            <li><a href="#packagetab-1">Combo Packages</a></li>
                        </ul><?php */?>
                        <form action="payment.php" method="post">
                        <div class="msgtab_content pack" id="packagetab-1">
                       	  <h2>Membership Packages</h2>
                          <table class="packtable" border="0" cellpadding="0" cellspacing="0" >
                              <tr>
                                <th style="width:25px;">&nbsp;</th>
                                <th><strong>Package Type</strong></th>
                                <th><strong>Months</strong></th>
                                <th><strong>Amount</strong></th>
                              </tr>
                              <?php $i=0; ?>
                              <?php foreach($data as $d) { ?>
                              <tr>
                              	<td style="width:25px;"><input type="radio" name="plane_id" <?php if($i==0){ ?> checked="checked" <?php } ?> value="<?php echo $d['id']; ?>" style="display:none;" /></td>
                                <td><h1><?php echo $d['plan_name']; ?></h1></td>
                                <td style="font-size: 20px;color: black;font-weight: bold;<?php if($d['plan_duration']==365){ ?>padding-left: 34px;<?php }else{ ?>padding-left: 40px;<?php } ?>"><?php if($d['plan_duration']==365){ echo '12'; }else{ echo $d['plan_duration']/30; } ?></td>
                                <td style="font-size: 20px;color: black;font-weight:bold;">Rs. <?php echo $d['plan_amount']; ?></td>
                              </tr>
                              <?php $i++; } ?>
                          </table><br />
                          	<input type="submit" class="pay_now_btn" value="pay_now_btn" style="border:none;display:none;" />
                        </div>
                        </form>
                    </div>-->
</div>