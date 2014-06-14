<?php
include('lib/myclass.php');

$rel_array = $_POST['religion'];
if($rel_array!='')
{

	$select_religions="select id from religions where religion='".$rel_array."'";
	$db_religions=$obj->select($select_religions);
	
	$select_cast = "select * from caste where religion_id='".$db_religions[0]['id']."' order by caste";
	$db_cast = $obj->select($select_cast);
	
	
	for($j=0;$j<count($db_cast);$j++)
	{
		$caste[] = $db_cast[$j]['caste'];
	}

?>
<li class="morelink">
                    <div class="searchby">
                        <div class="searchbubblebox sbox-rel">                	
                            <div class="searchbubbleboxin">
                          		<?php foreach($caste as $cast_data) { ?>
                         <label><input type="checkbox" class="caste_chk" value="<?php echo $cast_data ?>" name="drpCaste[]" onchange="refine_search()"/><?php echo $cast_data; ?></label>
                            <?php } ?>
                           </div>
                           <div class="clear"></div>
                        </div>
                    </div>
 </li>
 <?php
}
else
{
	$all_caste_list="select * from caste order by religion_id";
	$caste=$obj->select($all_caste_list);
 ?>
    <li class="morelink">
        <div class="searchby">
            <div class="searchbubblebox sbox-rel">                	
                <div class="searchbubbleboxin">
                    <?php foreach($caste as $cast_data) { ?>
             <label><input type="checkbox" class="caste_chk" value="<?php echo $cast_data['caste'] ?>" name="drpCaste[]" onchange="refine_search()"/><?php echo $cast_data['caste']; ?></label>
                <?php } ?>
               </div>
               <div class="clear"></div>
            </div>
        </div>
 </li>
    
<?php } ?>


