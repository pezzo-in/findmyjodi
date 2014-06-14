<?php
include('../lib/myclass.php');
$prf_for=($_GET['pro_for']);
 ?>
<div class="controls">
Female
 <input type="radio" id="gendermale" name="Rdgender" value="M"  <?php if($prf_for == "Daughter" || $prf_for == "Sister" ){?> checked="checked"<?php } ?>/>
 Male
 <input type="radio" id="genderfemale" name="Rdgender" value="F" <?php if($prf_for == "Son" || $prf_for == "Brother"){?> checked="checked"<?php } ?>/>
</div>
