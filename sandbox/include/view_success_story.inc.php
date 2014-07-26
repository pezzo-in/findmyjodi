	
	 	<div  class="mid col-md-12 col-sm-12 col-xs-12 nopadding" style="width:954px;">
			<div id="tab-container">
                      <h2 style="width:950px;">Success Story</h2>
                                              	
                        	<div class="partner_search1">
                            	<?php
									$select_story = "select * from success_member_details where id='".$_GET['id']."'ORDER BY id DESC";
									$db_select_story = $obj->select($select_story);
								?>
                             	<table width="100%" align="center" border="0" cellpadding="5" cellspacing="0">
                                	
                                    <tr>
                                    	<td width="12%"><img src="upload/<?php echo $db_select_story[0]['photo']; ?>" width="100" height="100"  /></td>
                                        <td width="80%">
                                        <div style="width:100%; margin-top:0px;" class="fleft content paddt15">
                                            <span class="boldtxt" style="font-size:16px; font-weight:bold">
                                                <?php echo strtoupper($db_select_story[0]['matrimony_id']); ?> | <?php echo ucfirst($db_select_story[0]['bride_name']); ?> & <?php echo ucfirst($db_select_story[0]['groom_name']); ?>,</span><br /> 
                                            <span class="clr7">Marriage Date : <?php echo date('d-m-Y',strtotime($db_select_story[0]['engag_or_marriage_date'])); ?></span><br /><br />
                                            <div class="paddt10 paddb15"><?php echo $db_select_story[0]['story']; ?></div>
                                        </div>
                                        </td>
                                    </tr>
                                 
                                </table> 
		                   	</div>          
                        
                        
                   	
                  
                        
                    </div>
        </div>
<style type="text/css">

#success_story
{
width:90px; height:33px; float:left; clear:both; background:url(images/submit_btn.png) no-repeat left top;
 border:none; text-indent:-9999px; overflow:hidden; font-size:0; text-align: left; cursor:pointer; color:#f46989; 
 *margin-right:30px; margin-top:10px;margin-left:153px;
}
</style>
        
        