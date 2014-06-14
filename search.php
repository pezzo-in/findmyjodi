<?php
session_start();
include('lib/myclass.php');
$select_content = "select * from tbl_seo_content where Id = '3'";
$db_content = $obj->select($select_content);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<title><?php echo $db_content[0]['SeoTitle']; ?></title>
<meta name="description" content="<?php echo $db_content[0]['SeoMeta']; ?>" />
<meta name="keywords" content="<?php echo $db_content[0]['SeoKeywords']; ?>" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/colorbox.css" />  

</head>
		
<body>

<?php
include("common_user_fetch.php");
/*if($_SESSION['UserEmail']!='')
{
	$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$_SESSION['logged_user'][0]['id']."' AND members.id=member_plans.member_id";
	$db_member_plan=$obj->select($select_member_plan);
	
	$exp_date=date('Y-m-d');
	
	if(count($db_member_plan)>0)
	{
		$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
		$db_plan=$obj->select($select_plan);
		
		$exp_date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_date[0]['reg_date']));
	}

	if(count($db_member_plan)>0 && date('Y-m-d',strtotime($exp_date))>=date('Y-m-d'))
	{
		include('include/chat.php'); 
	}
}*/
?>
<?php if($_SESSION['UserEmail']=='' || (count($db_member_plan)==0)){ ?>
<script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
<?php } ?>
<script type="text/javascript" src="js/script.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("ul.profl-list li:nth-child(3n+1)").addClass("first");
	return false;
});

</script>
<script src="js/jquery.easytabs.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready( function() {

			$('#tab-container').easytabs();
		<?php if($_GET['flag'] != ''){ ?>
			$('#<?php echo $_GET['flag'] ?>').click();
		<?php } ?>	  
    });
</script>

<script src="js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, maxWidth:"900px"});
	});
</script> 

<script>
function regular_search_submit()
{
	document.getElementById('regular_search_save').value=document.getElementById('Search_lable').value;
	
	
	document.regular_search_form.submit();	
}

function advanced_search_save_submit()
{
	document.getElementById('advanced_search_save').value=document.getElementById('Adv_Search_lable').value;
	document.advanced_search_form.submit();	
}

function keyword_search_save_submit()
{
	document.keyword_search.submit();	
}   
</script>

<div class="topMain">
	<div class="wrapper">
    	<?php include('include/header.inc.php'); ?>
		<div class="header inn">
        	<div class="titlebox">
            	<h2>Search</h2>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
	 <?php include('include/search.inc.php'); ?>
     <?php include('include/footer.inc.php'); ?>
</div>

</body>
</html>
<script>
function change_religion(val,type)
{
	$.ajax({
		type:'POST',
		url:"ajax_caste.php",
		data:'religion='+val,
		success: function(result)
		{
			if(type=="1"){
			$('#caste_drp_div').html(result);
			}
			else if(type="2")
			{$('#drp_adv_caste').html(result);}
		}
	});
}
</script>