 <?php
 include('../lib/myclass.php');
 $id1 = $_POST['id']; 
 
 $cat_select = "select * from caste where religion_id='".$id1."'";
 $db_cat = $obj->select($cat_select);
 
 ?>
 					<div class="controls">
                                	<select id="drpRel" name="cast" class="span6 m-wrap required" >
                                    <option value="">---Select---</option>         
                                    <?php foreach($db_cat as $d)  { ?>
                                    	<option value="<?php echo $d['id'] ?>" <?php if($db_category[0]['caste_id'] == $d['id']) { ?> selected="selected"; <?php } ?>><?php echo $d['caste'] ?></option>         
                                        <?php }?>                               
                                    </select>
                                </div>