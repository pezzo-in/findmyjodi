<?php
include('lib/myclass.php');

$rel_array = split(',',$_POST['religion']);
//print_r($rel_array);
for($i=0;$i<count($rel_array);$i++)
{
	$select_religions="select id from religions where religion='".$rel_array[$i]."'";
	$db_religions=$obj->select($select_religions);
	
	$select_cast = "select * from caste where religion_id='".$db_religions[0]['id']."'";
	$db_cast = $obj->select($select_cast);
	
	
	for($j=0;$j<count($db_cast);$j++)
	{
		$caste[] = $db_cast[$j]['caste'];
	}
}
?>

<li class="morelink">
                    <div class="searchby">
                        <div class="searchbubblebox sbox-rel">                	
                            <div class="searchbubbleboxin">
                          		<?php foreach($caste as $cast_data) { ?>
                         <label><input type="checkbox" value="<?php echo $cast_data ?>" name="drpCaste[]" <?php if($search_coockie_data['drpCaste']==$cast_data) { ?> checked="checked"<?php } ?> onchange="refine_search()"/><?php echo $cast_data; ?></label>
                            <?php } ?>
                           </div>
                           <div class="clear"></div>
                        </div>
                    </div>
 </li>
