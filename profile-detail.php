<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<title>Matrimonial</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery.accordion.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#acc-list").accordion({
			alwaysOpen: false,
			header: '.sidebar h3'
		});
	});
</script>

<script type="text/javascript">
$(document).ready(function(){
	$("ul.profl-list li:nth-child(3n+1)").addClass("first");
	return false;
});

</script>
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
	 <div  class="mid col-md-12 col-sm-12 col-xs-12">
     	<div class="sidebar col-md-3 col-xs-12 col-sm-4">
        	<div class="sidebar-main">
            	<h2>Refine Search</h2>
                <div class="sidebar-cont" id="acc-list">
                	<div class="list-toggle">
                        <h3>Show members added</h3>
                        <ul>
                            <li><a href="#">Within a month(1)</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Active</h3>
                        <ul>
                            <li><a href="#">One month (1)</a></li>
                            <li><a href="#">One month and above (2)</a></li>
                            <li><a href="#">More</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Profile type</h3>
                        <ul>
                            <li><a href="#">With Photo (1)</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Religion</h3>
                        <ul>
                            <li><a href="#">Hindu (34)</a></li>
                            <li><a href="#">Muslim (12)</a></li>
                            <li><a href="#">Christian (3)</a></li>
                            <li><a href="#">More</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Cast</h3>
                        <ul>
                            <li><a href="#">Agarwal (3)</a></li>
                            <li><a href="#">Arora (2)</a></li>
                            <li><a href="#">Brahmin (1)</a></li>
                            <li><a href="#">More</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Profession</h3>
                        <ul>
                            <li><a href="#">Service (3)</a></li>
                            <li><a href="#">Business (2)</a></li>
                            <li><a href="#">Job (1)</a></li>
                            <li><a href="#">More</a></li>
                        </ul>
                    </div>
                    <div class="list-toggle">
                        <h3>Online Members</h3>
                        <ul>
                            <li><a href="#">Online (10)</a></li>
                            <li><a href="#">Offline (2)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>	
        <div class="content col-sm-8 col-xs-12 col-md-9">
        	<div class="profile_details col-md-8">
            	<div class="profile_img">
                    <div class="profile-img-box">
                         <a href="#"><img src="images/prfl-list-img.jpg" /></a>
                    </div>
                    <h2>Gurav Jani</h2>
                    <p>Gurav Jani ( Hindu )<br>
    26 Yrs, 4 Ft 6 In / 137 Cms<br>
    Aeronautical Engineering</p>
    			</div>
                <div class="row-detail">
                	<h3>About Gurav Jani</h3>
                	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</p>
                </div>
                <div class="row-detail">
                	<h3>More About Gurav Jani</h3>
                	<ul><li>Marital Status</li><li>:</li><li>Never Married</li></ul>
                    <ul><li>Have Children</li><li>:</li><li>No</li></ul>
                    <ul><li>Created For</li><li>:</li><li>Relative</li></ul>
                    <ul><li>Last Login</li><li>:</li><li>02 Oct 2013</li></ul>
                </div>
                <div class="row-detail">
                	<h3>About Gurav's Physical Appearance & Looks</h3>
                	<ul><li>Height</li><li>:</li><li>5ft 2in</li></ul>
                    <ul><li>Complexion</li><li>:</li><li>Fair </li></ul>
                    <ul><li>Body Type</li><li>:</li><li>Average</li></ul>
                    <ul><li>Special Case</li><li>:</li><li>None</li></ul>
                </div>
                <div class="row-detail">
                	<h3>About Gurav's past and current Education & Career info</h3>
                	<ul><li>Highest Qualification</li><li>:</li><li>MA (Arts)</li></ul>
                    <ul><li>Fields of Study</li><li>:</li><li>Economics</li></ul>
                    <ul><li>Employed In</li><li>:</li><li>Not Working</li></ul>
                </div>
                <div class="row-detail">
                	<h3>About Gurav's Religion and Social info</h3>
                	<ul><li>Religion</li><li>:</li><li>Hindu</li></ul>
                    <ul><li>Mother Tongue</li><li>:</li><li>Hindi</li></ul>
                    <ul><li>Caste</li><li>:</li><li>Yadav</li></ul>
                    <ul><li>Sub Caste</li><li>:</li><li>Aheer/Ahir</li></ul>
                    <ul><li>Manglik</li><li>:</li><li>No</li></ul>
                    <ul><li>Gotra /Gothram </li><li>:</li><li>kashyap</li></ul>
                </div>
                <div class="row-detail">
                	<h3>About Gurav's Astro info</h3>
                	<ul><li>Date Of Birth</li><li>:</li><li>19 Sep 1990</li></ul>
                    <ul><li>Country of birth</li><li>:</li><li>India</li></ul>
                </div>
                <div class="row-detail">
                	<h3>About Gurav's Family</h3>
                	<ul><li>Father's Occupation</li><li>:</li><li>Business/Entrepreneur</li></ul>
                    <ul><li>Mother's Occupation</li><li>:</li><li>Passed</li></ul>
                    <ul><li>Brothers</li><li>:</li><li>1 brother </li><li>(not married)</li></ul>
                    <ul><li>Sisters</li><li>:</li><li>0 sisters </li></ul>
                    <ul><li>Living with parents?</li><li>:</li><li>Yes</li></ul>
                    <ul><li>Family values</li><li>:</li><li>Traditional</li></ul>
                    <ul><li>Family Type</li><li>:</li><li>Joint family single parent brothers and or sisters</li></ul>
                    <ul><li>Family Status</li><li>:</li><li>Middle Class</li></ul>
                    <ul><li>About my family</li><li>:</li><li></li></ul>
                </div>
                <div class="row-detail">
                	<h3>About Gurav's Lifestyle</h3>
                    <ul><li>Smoking</li><li>:</li><li>No</li></ul>
                    <ul><li>Drinking</li><li>:</li><li>No</li></ul>
                    <ul><li>Eating Habits</li><li>:</li><li>Vegetarian</li></ul>
                </div>
                
            </div>
		</div>
     </div>
     <div class="footer">
        	<div class="foot_copy">All rights reserved @Kanadalagna.com</div>
            <ul class="foot_link">
            	<li><a href="#">Home</a></li>
                <li><a href="#">Search</a></li>
                <li><a href="#">Upgrade</a></li>
                <li><a href="#">Take A Quick Tour</a></li>
                <li><a href="#">Help</a></li>
            </ul>
     </div>
     <div class="clear"></div>
</div>
</body>
</html>
