<?php
$sql_search = "SELECT * from tbl_search WHERE Member_id = '".$_SESSION['logged_user'][0]['id']."'";	
$db_search=$obj->select($sql_search);
?>
    <div class="col-md-9 col-xs-12 col-sm-12">
		<h3>Saved Search</h3>
        <ul class="save_search_ul">
        	<?php for($i=0;$i<count($db_search);$i++){ ?>
        	<li><a href="load_data.php?save=<?php echo base64_encode($db_search[$i]['Id']); ?>"><?php echo $db_search[$i]['Search_lable']; ?></a></li>
            <?php } ?>
        </ul>     
        
        <?php if(count($db_search)==0){ echo '<span class="no-search">You have not saved any search !</span>'; } ?>
    </div>    
        
<style>
.size
{
	height:181px;
	width:171px;
}
.back_btn
{
	text-align:right;
	padding-right:5px;	
}
.back_btn_size
{
	height:15px;
	padding-top:5px;
}
.profile_pic{
	/*height:150px;*/
	width:75px;
}
.upload_pic
{
	float: left;
    margin-right: 20px;
    padding: 24px 13px;
}
</style>     
