<div  class="mid col-md-12 col-sm-12 col-xs-12">

<?php

$select_banner = "select * from advertise where adv_position = 'Home Top (954 X 100)' AND status = 'Active'";

$db_banner = $obj->select($select_banner);

if(count($db_banner) > 0) 

{

	if($db_banner[0]['banner_file'] != '') 

	{

		if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {

?>

<div style="margin: 0px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>

<?php } } } ?>

 <?php if($_SESSION['logged_user'][0]['id'] == ""){ ?>

    <div class="findmatch">

    <?php

	$metter="select * from find_match";

	$dbmetter=$obj->select($metter);

	

	?>

        <h2>Steps to Find your Match</h2>

       

        <div class="findmatch-box first">

            <h3><a href="register.php"><img src="images/icon1.png" />Create Profile</a></h3>

            <?php echo $dbmetter[0]['cprofile']; ?>

        </div>

        <div class="findmatch-box">

            <h3><a href="search.php"><img src="images/icon2.png" />Find Matches</a></h3>

<?php echo $dbmetter[0]['matches']; ?>

        </div>

        <div class="findmatch-box">

            <h3><a href="javascript:;"><img src="images/icon3.png" />Start Communicating</a></h3>

<?php echo $dbmetter[0]['communication']; ?>

        </div>

    </div>

    <?php } ?>

    <div class="span1 first">

        <h2>Steps to Find your Match</h2>

        <div class="step first">

           <a href="javascript:;"><img src="images/icon-step1.png" />

            <?php 

				$count_members = "SELECT * FROM members";

				$total_members=$obj->select($count_members);

			?>

            <?php echo count($total_members); ?> Memebers In Total

       </a> </div> 

        <div class="step">

             <a href="javascript:;"><img src="images/icon-step2.png" />

				<?php

            $online="select * from chat_users where status ='1'";

			$dbonline=$obj->select($online);

			echo count($dbonline)."  Members Online";

			?>

            

        </a></div> 

        <div class="step">

           <a href="search.php"> <img src="images/icon-step3.png" />

            Large Database to Search

        </a></div>    

    </div>

    <?php 

		if(isset($_SESSION['logged_user'][0]['id']))

		{

			$sql = "SELECT members.*,member_photos.photo FROM members 

				    LEFT JOIN member_photos ON members.id = member_photos.member_id

					where members.is_featured = 'Y' and members.id != '".$_SESSION['logged_user'][0]['id']."' 

				    order by members.id desc limit 3";	

		}

		else

		{

			$sql = "SELECT members.*,member_photos.photo FROM members 

				    LEFT JOIN member_photos ON members.id = member_photos.member_id

					where members.is_featured = 'Y' 

				    order by members.id desc limit 3";	

	 	}

		//echo $sql;

		$members=$obj->select($sql);

	?>

    <div class="span1 featured-profile">

        <h2>Featured Profile</h2>

        <?php

		if(!empty($members))

		{

			$i = 0; 

			foreach($members as $res) { 

			?>

        <div class="profile <?php if($i == 0) { ?> select<?php } ?>">

            <div class="profile-img-box first col-md-12 col-xs-12 col-md-12">

                <a href="view_profile.php?id=<?php echo $res['id']; ?>" target="_blank"><?php

						if(!empty($res['photo']))

						{

						 	//$path =  $_SERVER['DOCUMENT_ROOT']."matrimonial/upload/".$members[0]['photo'];

							$path = "upload/".$res['photo'];

							if (file_exists($path)) { 

                       			echo '<img class="size" src="'.$path.'" style="width:98px;height:92px;"/><br>';

							}

							else{

								if($res['gender']=='M')

									echo '<img class="profile_pic" src="images/male-user1.png" style="width:98px;height:92px;" />';

								else

									echo '<img  class="profile_pic" src="images/female-user1.png" style="width:98px;height:92px;" />';

							}

						}

						else{

							if($res['gender']=='M')

								echo '<img  class="profile_pic" src="images/male-user1.png" style="width:98px;height:92px;" />';

							else

								echo '<img  class="profile_pic" src="images/female-user1.png" style="width:98px;height:92px;" />';

							}?></a>

                

            </div>

            <h3><a href="view_profile.php?id=<?php echo $res['id']; ?>" target="_blank" style="background:none; padding-left:0px;"><?php echo $res['name'].' ('.$res['member_id'].')'; ?></a></h3>

            <p style="padding-left:0px"><?php echo substr($res['about_me'],0,160).'...'; ?></p>

        </div>

        <?php  $i++; } 

		}

		else

		{

			echo "No Featured Profile available";

		}?>        

        

    </div>

<?php

$select_banner = "select * from advertise where adv_position = 'Home Bottom (954 X 100)' AND status = 'Active'";

$db_banner = $obj->select($select_banner);

if(count($db_banner) > 0) 

{

	if($db_banner[0]['banner_file'] != '') 

	{

		if(file_exists('upload/banners/'.$db_banner[0]['banner_file'])) {

?>

<div style="margin: 10px 0px 20px 0px;"><a href="<?php echo $db_banner[0]['banner_link']; ?>" target="_blank"><img src="upload/banners/<?php echo $db_banner[0]['banner_file']; ?>" /></a></div>

<?php }  } } ?>

</div>

<style>

.size

{

	height:92px;

	width:92px;

}

</style>        