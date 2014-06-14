<?php
include('lib/myclass.php');

$select_religions="select * from religions where religion='".$_POST['religion']."'";
$db_religions=$obj->select($select_religions);

$select_cast="select * from caste where religion_id='".$db_religions[0]['id']."'";
$db_cast=$obj->select($select_cast);
?>
<select name="drpCaste" id="drpCaste" tabindex="7" style="clear:none;">
<option value=""> -Select- </option>
<?php for($i=0;$i<count($db_cast);$i++) { ?>
    <option value="<?php echo $db_cast[$i]['caste']; ?>"><?php echo $db_cast[$i]['caste']; ?></option>
<?php } ?>
</select>