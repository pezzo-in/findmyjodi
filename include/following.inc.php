<?php

if(isset($_POST['postsubmit']))

{

	$cdate = date('Y-m-d H:i:s');

	$ctime = date('H:i');

	$select_member = "select * from members where email_id = '".$_SESSION['UserEmail']."'";

	$db_select_member = $obj->select($select_member);

	$insert_post = "insert into tbl_user_post(Id, UserId, PostText, Cdate, Ctime) values(null, '".$db_select_member[0]['id']."', '".$_POST['PostText']."', '".$cdate."', '".$ctime."')";

	$db_insert_post = $obj->insert($insert_post);

		

}

?>

<?php if($_GET['id'] == '') { ?>

<div class="content col-md-9 col-xs-12 col-sm-12">

	<div class="about_right"> 

    <h2 style="text-align:left">Following</h2>       

        <?php

		$select_member_id = "select * from members where email_id = '".$_SESSION['UserEmail']."'";

		$db_select_member_id = $obj->select($select_member_id);

		

		$select_post = "select * from tbl_user_followers where UserId = '".$db_select_member_id[0]['id']."' ORDER BY Id DESC";

		$db_select_post = $obj->select($select_post);

		if(count($db_select_post)>0){

		for($i=0;$i<count($db_select_post);$i++) 

		{

			$select_mem = "select * from members where id = '".$db_select_post[$i]['FollowerId']."'";

			$db_mem = $obj->select($select_mem);

			

			$select_photo = "select * from member_photos where member_id = '".$db_select_post[$i]['FollowerId']."' AND Approve = 1 ORDER BY id DESC";

			$db_select_photo = $obj->select($select_photo);

			

			if($db_mem[0]['member_id']!='')

			{

			

		?>

       

        <div class="mid_prof col-md-12 col-xs-12 col-sm-12 nopadding" style="border-bottom:none">

        

        	<div class="showbasiccontent col-md-12 col-sm-12 col-xs-12 col-md-12 col-xs-12 col-sm-12 nopadding" id="accept_div_<?php echo $db_select_post[$i]['UserId']."_".$db_select_post[$i]['FollowerId']; ?>">

                <div class="prfl-pic">

                    <div id="slideshow" class="pics">

                    <?php if($db_select_photo[0]['photo']!='') { ?>

                        <a href="<?php if($db_select_post[$i]['FollowerId'] != $_SESSION['logged_user'][0]['id']){ ?>view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; }else{?>my_account.php<?php } ?>"><img src="upload/<?php echo $db_select_photo[0]['photo']; ?>" width="70" height="70" alt="" /></a>

                        <?php } else { ?>

                        <a href="<?php if($db_select_post[$i]['FollowerId'] != $_SESSION['logged_user'][0]['id']){ ?>view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; }else{?>my_account.php<?php } ?>"><img src="images/male-user1.png" alt="" width="70" height="70" /></a>

                        <?php } ?>						

                    </div>

                </div>

                <div class="prfl-details">

                    <div class="row-top"><a href="<?php if($db_select_post[$i]['FollowerId'] != $_SESSION['logged_user'][0]['id']){ ?>view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; }else{?>my_account.php<?php } ?>" class="floatl"><?php echo ucfirst($db_mem[0]['name']); ?> (<?php echo $db_mem[0]['member_id']; ?>)</a>

                    </div>

                    <br>                        

                    <p><?php if($db_mem[0]['age']!='') { echo $db_mem[0]['age']." Yrs,"; }  if($db_mem[0]['height']!= '') { 

					$select_height="select * from height where Id='".$db_mem[0]['height']."'";

					$db_height=$obj->select($select_height);

					echo ' / '.$db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';

					if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }

					 }  ?> | <?php if($db_mem[0]['religion']!='') { echo $db_mem[0]['religion'].":"; } ?> <?php if($db_mem[0]['caste']!='') { echo $db_mem[0]['caste']; } ?> | Location : <?php echo $db_mem[0]['city']; ?>, <?php echo $db_mem[0]['country']; ?> | Education : 

					 <?php

					$select_education="select * from education_course where Id='".$db_mem[0]['education']."'";

					$db_education=$obj->select($select_education);

					echo $db_education[0]['Title'];

					?>

					 <?php if($db_mem[0]['occupation'] != "") { ?> | Occupation : <?php echo $db_mem[0]['occupation'];  } ?></p>

                    <a href="view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; ?>">View Full Profile</a><a href="javascript:void(0)" style="float:right;" onclick="return delete_intrest('accept_div_<?php echo $db_select_post[$i]['UserId']."_".$db_select_post[$i]['FollowerId']; ?>','<?php echo $db_select_post[$i]['Id']; ?>');"><img src="img/delete.png" style="border:none;" height="16" width="16" title="Delete"></a> 

                </div>

            </div>

       

        

        

        	<?php /*?><?php if($db_select_photo[0]['photo']!='') { ?>

            <a href="view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; ?>"><img src="upload/<?php echo $db_select_photo[0]['photo']; ?>" width="47" height="46" alt="" /></a>

            <?php } else { ?>

            <a href="view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; ?>"><img src="images/male-user1.png" width="47" height="46" alt="" /></a>

            <?php } ?>

            <div class="prof_name"><a href="view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; ?>"><?php echo $db_mem[0]['name']." ".$db_mem[0]['caste']; ?></a><br /><span><?php echo date('d F, Y',strtotime($db_select_post[$i]['Cdate'])); ?></span>

            </div><?php */?>

        </div>

        <?php }}}else{ ?><span style="font-size: 15px;font-weight: bold;padding: 10px;">No records found.</span><?php }?>

              

    </div>

</div>

<?php } else { ?>

<div class="content col-md-9 col-xs-12 col-sm-12">

	<div class="about_right">

    <h2 style="text-align:left">Following</h2>

        

        <?php

		$select_member_id = "select * from members where id = '".$_GET['id']."'";

		$db_select_member_id = $obj->select($select_member_id);

		

		$select_post = "select members.*, tbl_user_followers.* from members left join tbl_user_followers on members.id=tbl_user_followers.FollowerId where UserId = '".$db_select_member_id[0]['id']."' ORDER BY tbl_user_followers.Id DESC";

		$db_select_post = $obj->select($select_post);

		if(count($db_select_post)>0)

		{

		for($i=0;$i<count($db_select_post);$i++) 

		{

			$select_mem = "select * from members where id = '".$db_select_post[$i]['FollowerId']."'";

			$db_mem = $obj->select($select_mem);

			

			$select_photo = "select * from member_photos where member_id = '".$db_select_post[$i]['FollowerId']."' AND Approve = 1 ORDER BY id DESC";

			$db_select_photo = $obj->select($select_photo);

			

			if($db_mem[0]['member_id']!='')

			{

			

		?>

        <div class="mid_prof">

        	

			

            <div class="showbasiccontent col-md-12 col-sm-12 col-xs-12">

                <div class="prfl-pic">

                    <div id="slideshow" class="pics">

                    <?php if($db_select_photo[0]['photo']!='') { ?>

                        <a href="view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; ?>"><img src="upload/<?php echo $db_select_photo[0]['photo']; ?>" width="70" height="70" alt="" /></a>

                        <?php } else { ?>

                        <a href="view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; ?>"><img src="images/male-user1.png" alt="" width="70" height="70" /></a>

                        <?php } ?>						

                    </div>

                </div>

                <div class="prfl-details">

                    <div class="row-top"><a href="view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; ?>" class="floatl"><?php echo ucfirst($db_mem[0]['name']); ?> (<?php echo $db_mem[0]['member_id']; ?>)</a>

                    </div>

                    <br>                        

                    <p><?php if($db_mem[0]['age']!='') { echo $db_mem[0]['age']." Yrs,"; }  if($db_mem[0]['height']!= '') { 

					$select_height="select * from height where Id='".$db_mem[0]['height']."'";

					$db_height=$obj->select($select_height);

					echo ' / '.$db_height[0]['Ft_val'].'ft '.$db_height[0]['In_val'].'in';

					if($db_height[0]['Cm_val']!=''){ echo ' - '.$db_height[0]['Cm_val'].'cm'; }

					 }  ?> | <?php if($db_mem[0]['religion']!='') { echo $db_mem[0]['religion'].":"; } ?> <?php if($db_mem[0]['caste']!='') { echo $db_mem[0]['caste']; } ?> | Location : <?php echo $db_mem[0]['city']; ?>, <?php echo $db_mem[0]['country']; ?> | Education : 

					 <?php

					$select_education="select * from education_course where Id='".$db_mem[0]['education']."'";

					$db_education=$obj->select($select_education);

					echo $db_education[0]['Title'];

					?>

					 <?php if($db_mem[0]['occupation'] != "") { ?> | Occupation : <?php echo $db_mem[0]['occupation'];  } ?></p>

                    <a href="view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; ?>">View Full Profile</a> 

                </div>

            </div>

			

			

			<?php /*?><?php if($db_select_photo[0]['photo']!='') { ?>

            <a href="view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; ?>"><img src="upload/<?php echo $db_select_photo[0]['photo']; ?>" width="47" height="46" alt="" /></a>

            <?php } else { ?>

            <a href="view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; ?>"><img src="images/male-user1.png" width="47" height="46" alt="" /></a>

            <?php } ?>

            <div class="prof_name"><a href="view_profile.php?id=<?php echo $db_select_post[$i]['FollowerId']; ?>"><?php echo $db_mem[0]['name']." ".$db_mem[0]['caste']; ?></a><br /><span><?php echo date('d F, Y',strtotime($db_select_post[$i]['Cdate'])); ?></span>           

            </div><?php */?>

        </div>

        <?php } }}else { ?>

				<span style="font-size: 15px;font-weight: bold;padding: 10px;">No records found.</span>

		<?php }?>

       

    </div>

</div>

<?php } ?>         

       

<script>

function delete_intrest(str,id){



var x = confirm('Are sure you want to delete?');

if(x){

	

$.ajax({

			url:'follower_delete.php',

			type:'POST',

			data:{

				id:id

				},

			success:function(msg){

				if(msg == 1){

				$('#'+str).slideUp('slow');	
				//$('#'+str).remove();	

				}	

				}

				

			

			});

}else{

return false;	

}

	

}

</script>