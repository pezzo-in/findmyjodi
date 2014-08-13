<?php

date_default_timezone_set('Asia/Calcutta');

session_start();

include('lib/myclass.php');



//echo $_SESSION['UserEmail']; exit;

$select_member_id = "select * from members where email_id = '".$_SESSION['UserEmail']."'";

$db_select_member_id = $obj->select($select_member_id);





//echo"<pre>";print_r($_POST); exit;

//echo $_GET['id'];

$cdate = date('Y-m-d H:i:s');

$id = $_POST['toid'];

$comment = $_POST['comment'];

$comment_img = $_POST['image'];

//echo $comment_img; exit;

$post_id = explode('_',$id);

//echo"<pre>";print_r($post_id);



$profile_id = $post_id['3']; 



$post_id1 = $post_id['2'];



/*echo $post_id1;

echo"hello";

echo $profile_id;*/

$new_id = "post_comment_".$post_id1."_".$profile_id;





$comments = $comment;





	if((trim($comments)!='') or ($comment_img!='undefined'))

	{

	$insert = "insert into tbl_user_post_comment(Id, UserId, PostId, Comment, Cdate, Image) values(null, '".$db_select_member_id[0]['id']."', '".$post_id1."', '".$comments."', '".$cdate."', '".$comment_img."')";

		$obj->insert($insert);
		unset($_POST);
	
	}

			$select_comment = "select * from tbl_user_post_comment where PostId = '".$post_id1."' ORDER By id DESC";

			$db_comment = $obj->select($select_comment);

			//echo"<pre>";print_r($db_comment); exit;

			if(count($db_comment)>0)

			{

				for($j=0;$j<count($db_comment);$j++)

				{

				$select_photo = "select * from member_photos where member_id = '".$db_comment[$j]['UserId']."' AND Approve = 1 ORDER BY id DESC";

				$db_select_photo = $obj->select($select_photo);

				

				$select_mem = "select * from members where id = '".$db_comment[$j]['UserId']."'";

				$db_mem = $obj->select($select_mem);

				//echo"<pre>";print_r($db_mem); 

			?>

            

                <div class="cmmnts">

                <a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>" class="pimg">

				<?php if($db_select_photo[0]['photo']!='') { ?>

                <img src="upload/<?php echo $db_select_photo[0]['photo']; ?>" width="32" height="32" alt="" />

                <?php } else { ?>

                

                <?php if($db_mem[0]['gender'] == 'M') { ?>

                <img src="images/male-user1.png" width="32" height="32" alt="" />

                <?php } else { ?>

                 <img src="images/female-user1.png" width="32" height="32" alt="" />

                <?php } ?>

				

				<?php } ?>

                </a>

                <div class="ptext"><a href="view_profile.php?id=<?php echo $db_mem[0]['id']; ?>" class="ptitle"><?php echo ucfirst($db_mem[0]['name']).' ('.$db_mem[0]['member_id'].')'; ?></a><?php echo $db_comment[$j]['Comment']; ?><br />

                <?php if($db_comment[$j]['Image']!='' && $db_comment[$j]['Image']!='undefined' ){ ?><div class="comment_img"><a href="javascript:;" ><img src="<?php echo $db_comment[$j]['Image']; ?>" height="100" width="100" /></a></div><?php } ?>

                <?php 

				$currentdatetime = date('Y-m-d');

				$postdatetime = date('Y-m-d',strtotime($db_comment[$j]['Cdate']));

				if($postdatetime == $currentdatetime)

				{ 

					//echo date('H');

					//echo date('i');

					//echo "Test". date('H'); exit;

					$currenttime = (date('H')*60)+date('i');

					//echo $currenttime."</br>";

					$posttime = (date('H',strtotime($db_comment[$j]['Cdate']))*60)+date('i',strtotime($db_comment[$j]['Cdate']));

					//echo $posttime."</br>";

					$difftime = ($currenttime - $posttime);

					if($difftime < 59)

					{

						$finaltime = $difftime." mins ";

						//echo $finaltime;

					}

					else

					{

						$hours = explode(".",($difftime / 60));

						$minute = ($difftime - ($hours[0]*60));

						

						$finaltime = $hours[0]." hrs ".$minute." mins ";

					}

			?>

            	<?php $finaltime=$finaltime.' ago'; ?>

            <?php } else { 

					$dStart = new DateTime($postdatetime);

				   	$dEnd  = new DateTime($currentdatetime);

		   			$dDiff = $dStart->diff($dEnd);		  

			?>

            	<?php $finaltime=$dDiff->days.' days ago'; ?> 

				<?php } ?>

                

                <div class="comment_wholikes">

	                <span class="time"><?php echo $finaltime; ?></span>

	                <?php

					$select_like_comment="select * from tbl_user_comment_like where Postid='".$db_comment[$j]['PostId']."' AND Commentid='".$db_comment[$j]['Id']."' AND Userid='".$_SESSION['logged_user'][0]['id']."'";

					$db_select_like_comment=$obj->select($select_like_comment);

					?>

                    <a href="javascript:;" class="like_btn" id="<?php echo $db_comment[$j]['Id'].'_'.$_SESSION['logged_user'][0]['id'].'_'.$db_comment[$j]['PostId']; ?>" ><?php if(count($db_select_like_comment)>0){ echo 'Unlike'; }else{ echo 'Like'; } ?></a> 

                    <?php

					$select_count_like_comment="select * from tbl_user_comment_like where Postid='".$db_comment[$j]['PostId']."' AND Commentid='".$db_comment[$j]['Id']."'";

					$db_select_count_like_comment=$obj->select($select_count_like_comment);

					?>

                    <a href="javascript:;" class="like"><?php if(count($db_select_count_like_comment)>0){ echo count($db_select_count_like_comment); } ?></a> 

				</div>

                

                </div></div>

            <?php } } ?>    

                

                <div class="cmmnts">

                    <a href="#" class="pimg"><img src="images/male-user1.png" width="32" height="32"></a>

                    <div class="ptext">

                    	<div class="inputtxt col-md-12 col-xs-12 col-sm-12">

                        	
                            <input type="text" class="comment_text" name="Comment" id="<?php echo $new_id; ?>" value="">

                            <a class="rightsend_btn" id="<?php echo $new_id; ?>" onclick="add_comment(this.id)">click</a>

                           
                            <form name="file_upload<?php echo $post_id1; ?>" action="upload_file_comment.php" method="post" target="frame<?php echo $post_id1; ?>" enctype="multipart/form-data">

                                <input type="file" id="file<?php echo $post_id1; ?>" name="file" onchange="this.form.submit(); display_block(<?php echo $post_id1; ?>);" />

                            </form>

                            <div id="prepage<?php echo $post_id1; ?>" class="prepage" style="margin-top: 10px;"></div>

						</div>

                    </div>

                    <iframe src="upload_file_comment.php" style="display:none;" id="frame<?php echo $post_id1; ?>" name="frame<?php echo $post_id1; ?>" target="_blank" onload="clearPreloadPage(<?php echo $post_id1; ?>)"></iframe>  

				</div>

            </div>
	<?php unset($id);
	unset($comment);
	unset($comment_img);
	unset($post_id);
	unset($post_id1);
	?>
<script>

$('.like_btn').click(function(e) {

	//alert('hi');

    var id=$(this).attr('id');

	var this_a=$(this);

	$.ajax({

		type:'POST',

		url:"comment_like.php",

		data:'val='+id,

		async:false,

		success: function(result){

			if(result==1)

				this_a.text('Unlike');

			else

				this_a.text('Like');

		}

	});

	

	$.ajax({

		type:'POST',

		url:"count_comment_like.php",

		data:'val='+id,

		success: function(result){

				//alert(result);

				this_a.next('.like').text(result);

		}

	});

});



$( ".comment_text" ).keyup(function(e) {

	if(e.keyCode==13)

	{

		$('.rightsend_btn').trigger('click');

	}

	});

</script>





