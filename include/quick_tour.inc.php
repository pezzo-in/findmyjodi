<?php
$select_quick = "select * from tbl_quick_tour";
$db_quick = $obj->select($select_quick);
?>
<div class="col-md-12">
<div id="slider">
  <ul>
  	<?php for($i=0;$i<count($db_quick);$i++) { ?>
     <li><img src="upload/quicktour/<?php echo $db_quick[$i]['Photo']; ?>" alt="<?php echo $db_quick[$i]['Title']; ?>" /></li>
     <?php } ?>
  </ul>
</div>
</div>
