<?php
include('lib/myclass.php');
$prf_for=($_GET['pro_for']);
if($prf_for == 'Myself' || $prf_for == 'Relative' || $prf_for == 'Friend' || $prf_for =='') {
?>
<label class="radiobtn">
         <input type="radio" tabindex="4" name="Rdgender" id="Rdgender" value="M" checked="checked" />Male
  </label>
   <label class="radiobtn">
       	<input type="radio" tabindex="5" value="F" name="Rdgender"  />Female
   </label>
<?php	
	
 }
 else
 {?>
 
 <label class="radiobtn">
         <input type="radio" tabindex="4" name="Rdgender" id="Rdgender" value="M" <?php if($prf_for == "Son" || $prf_for == "Brother" ){?> checked="checked"<?php } ?> readonly="readonly"  />Male
  </label>
  <label class="radiobtn">
       	<input type="radio" tabindex="5" value="F" name="Rdgender" <?php if($prf_for == "Daughter" || $prf_for == "Sister"){?> checked="checked"<?php } ?> readonly="readonly" />Female
   </label>
 
 <?php } ?>
 
 
 