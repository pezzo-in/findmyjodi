<div class="footer-main">
    <div class="footer">
        <div class="foot_copy">All rights reserved @Findmyjodi.com</div>
        <ul class="foot_link">
        <?php if($_SESSION['UserEmail']=='' || $_SESSION['IsActive']=='No') { ?>
            <li><a href="index.php">Home</a></li>
            <?php }else{ ?>
            <li><a href="my_account.php">Home</a></li>
            <?php } ?>
           <li><a href="aboutus.php">About Us</a></li>
           <!-- <li><a href="search.php">Search</a></li>-->
            <li><a href="success_story.php">Success Story</a></li>
            <?php
            $sql = "select * from member_plans where member_id='".$_SESSION['logged_user'][0]['id']."'";
            $db_sql = $obj->select($sql);
            if($db_sql[0]['paypal_transec_id'] == ''){ 
            ?>
           <!-- <li><a href="upgrade.php">Upgrade</a></li>-->
            <?php } ?>
            <li><a href="quick_tour.php">Take A Quick Tour</a></li>
            <li><a href="help.php">Contact Us</a></li>
            <li><a href="terms_conditions.php">Terms &amp; Conditions</a></li>
        </ul>
    </div>
</div>
<script>
$(document).ready(function(e) {
    $('.showbasiccontent col-md-12 col-sm-12 col-xs-12').each(function(index, element) {
        if(index==0)
		{
			$(this).addClass('first_showbasiccontent col-md-12 col-sm-12 col-xs-12');
		}
    });
});
</script>