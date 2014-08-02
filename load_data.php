<?php

session_start();

include('lib/myclass.php');

if (!empty($_POST) && !isset($_POST['send_msg']))

{
	$_SESSION['SearchCookie']=json_encode($_POST,true);
	$_SESSION['ClearCookie']=json_encode($_POST,true);	
}

$search_coockie_data = $_SESSION['SearchCookie'];
$search_coockie_data = json_decode(stripslashes($search_coockie_data),true);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="shortcut icon" href="images/favicon.ico" />

<title>Search List - FInd My Jodi</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="css/colorbox.css" />

<link rel="stylesheet" href="docsupport/prism.css">

<link rel="stylesheet" href="chosen.css">
<style type="text/css">

.loader{ position:absolute; width:100%; height:100%; left:0;top:0; background-color:#333; opacity:0.9;filter:alpha(opacity=40); z-index:999999999999999999999;}

.loader img{position:fixed; left:50%; top:50%;}

.refine{ width:100%; padding-bottom:20px; text-align:center;}

</style>
<!--<link rel="stylesheet" href="css/9lessons.css" type="text/css" />-->

<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1"/>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
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

<script type="text/javascript" src="assets/js/lightbox.js"></script> 

<script type="text/javascript" src="js/script.js"></script>

<script type="text/javascript" src="js/jquery.accordion.js"></script>

<script type="text/javascript">

	$(document).ready(function() {

		$('.list-toggle').find('h3').click(function(e) {

			if($(this).next('ul').css('display')!='block')

			{

				//$('.searchby').css('display','none');

				//$('.list-toggle').find('ul').slideUp('slow');

	            $(this).next('ul').slideToggle('slow');

				//$('.list-toggle').find('h3').removeClass('selected');

				$(this).addClass('selected');

			}

			else

			{

				$(this).next('ul').slideUp('slow');

				$(this).removeClass('selected');

				//$(this).addClass('selected');

			}

			

        });

		

		$('.morelink .more-view').click(function(e) {

			$( ".close-more-search" ).trigger( "click" );

            $(this).next('div').find('.searchby').fadeIn(150);

        });

		

		$('.close-more-search').click(function(e) {

            $(this).parent('.searchby').fadeOut(150);

        });

		

	});

</script>

<script>

		var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];

		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;

		g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";

		s.parentNode.insertBefore(g,s)}(document,"script"));

	</script>

<script type="text/javascript">

$(document).ready(function(){

	$("ul.profl-list li:nth-child(4n+1)").addClass("first");

	return false;

});

</script>

<script src="js/jquery.easytabs.js" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready( function() {

      $('#tab-container').easytabs();

    });

</script>

<script src="js/jquery.colorbox.js"></script>

<script>

	$(document).ready(function(){

		$(".inline").colorbox({inline:true, maxWidth:"900px;"});

		$(".ajax").colorbox({innerWidth:"500px;", maxWidth:"500px;"});

		$(".ajax1").colorbox({innerWidth:"450px;", maxWidth:"450px;", innerHeight:"200px;"});

		$(".ajax3").colorbox({innerWidth:"450px;", maxWidth:"450px;"});

		$(".user_offline").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "This user is offline."});

		$(".paid_error").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"130px;", height:"130px;", xhrError: "This feature is available for paid member."});

		$(".exid_mobile").colorbox({innerWidth:"500px;", maxWidth:"500px;", innerHeight:"130px;", height:"130px;", xhrError: "Sorry! You exceed maximum number of mobile from your plan."});

		$(".exid_msg").colorbox({innerWidth:"500px;", maxWidth:"500px;", innerHeight:"130px;", height:"130px;", xhrError: "Sorry! You exceed maximum number of message from your plan."});

		$(".same_gender").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"130px;", height:"130px;", xhrError: "Interest can not be send to same gender."});

		$(".alredy_sent").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Interest sent."});

		$(".alredy_received").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Your Interest is Accepted."});
		
		$(".is_more_time").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Need more time to respond."});

		$(".is_more_info").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Need more info to respond."});

		$(".none_result").colorbox({innerWidth:"500px;", maxWidth:"500px;", innerHeight:"130px;", height:"130px;", xhrError: "Sorry, we couldn't find any results to suit your search criteria. Please update your search criteria."});

	});	

</script>

<div class="container">
    <div class="row">
        <div class="topMain col-md-12 col-sm-12 col-xs-12 nopadding">
            <div class="wrapper col-md-12 col-sm-12 col-xs-12 nopadding">
    	<?php include('include/header.inc.php'); ?>
                <div class="header inn">
                    <div class="titlebox col-md-12">

            	Search

            </div>

        </div>


</div>

            <div class="col-md-12 mid">
                <div class="wrapper col-md-12 col-sm-12 col-xs-12 nopadding">
	 <?php include('load_first.php'); ?>

     <?php include('include/footer.inc.php'); ?>
</div>
    </div>
    </div>
    </div>
</div>
<script src="chosen.jquery.js" type="text/javascript"></script>

  <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>

  <script type="text/javascript">

    var config = {

      '.chosen-select'           : {}

    }

    for (var selector in config) {

      $(selector).chosen(config[selector]);

    }

  </script>

<script>

$(document).ready(function(e) {

        $('.list_view').click(function(e) {

			$('.profl-list').fadeOut('slow','',function(){

				$('.profl-list').addClass('thumb_view');	

				$('.profl-list').fadeIn('slow');
				$("#listgridview").val('list');

			});

		});

		$('.grid_view').click(function(e) {

			$('.profl-list').fadeOut('slow','',function(){

				$('.profl-list').removeClass('thumb_view');	

				$('.profl-list').fadeIn('slow');
				$("#listgridview").val('grid');

			});

		});

    });

	

$(window).scroll(function()

{

	if($(window).scrollTop() == $(document).height() - $(window).height())

	{

		var total=$('#ttl_profile').val();

		var limit=$('#limit').val();

		var offset=$('#offset').val();

		

		if(parseInt(limit)<parseInt(total) && (offset==1))

		{

			$('.refine').css('display','block');

			$('#offset').val(0);

			

			$.ajax({

				url:'ajax_more.php',

				data:{limit1:limit},

				type:'POST',

				cache:true,

				success: function(data)

				{

					$('#limit').val((parseInt(limit))+(parseInt(4)));

					$("div").remove(".refine");

					$('#refine_data').append(data);

					$('#offset').val(1);

					$(".ajax").colorbox({innerWidth:"500px;", maxWidth:"500px;"});

					$(".ajax1").colorbox({innerWidth:"450px;", maxWidth:"450px;", innerHeight:"200px;"});

					$(".ajax3").colorbox({innerWidth:"450px;", maxWidth:"450px;"});

					$(".user_offline").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "This user is offline."});

					$(".paid_error").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"130px;", height:"130px;", xhrError: "This feature is available for paid member."});

					$(".exid_mobile").colorbox({innerWidth:"500px;", maxWidth:"500px;", innerHeight:"130px;", height:"130px;", xhrError: "Sorry! You exceed maximum number of mobile from your plan."});

					$(".exid_msg").colorbox({innerWidth:"500px;", maxWidth:"500px;", innerHeight:"130px;", height:"130px;", xhrError: "Sorry! You exceed maximum number of message from your plan."});

					$(".same_gender").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"130px;", height:"130px;", xhrError: "Interest can not be send to same gender."});

					$(".alredy_sent").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Interest sent."});

					$(".alredy_received").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Your Interest is Accepted."});
					
					$(".is_more_time").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Need more time to respond."});
			
					$(".is_more_info").colorbox({innerWidth:"400px;", maxWidth:"400px;", innerHeight:"100px;", height:"100px;", xhrError: "Need more info to respond."});

				}

			});

		}

	}

});


function change_religion()
{
	$('.caste_chk').each(function () {
           if (this.checked) {
			  $(this).attr('checked',false);
		   }
});
	
	var religon_arr = new Array();
	$('.Search_drpReligion').each(function () {
           if (this.checked) {
			  religon_arr.push($(this).val());
		   }
});

	$.ajax({
		type:'POST',
		url:"ajax_refine_caste.php",
		data:'religion='+religon_arr,
		success: function(result)
		{
			$('#caste_box').html(result);
			/*if(type=="1"){
			$('#caste_drp_div').html(result);
			}
			else if(type="2")
			{$('#drp_adv_caste').html(result);}*/
		}
	});
}


</script>

</body>

</html>



