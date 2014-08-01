<?php
include('lib/myclass.php');
$age_between = $_GET['ageFrom']." and ".$_GET['ageTo'];
$sql = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 		relationship_status='".$_GET['status']."' and  
					mother_tongue='".$_GET['language']."' and  
			 		age between ".$age_between." and
					religion = '".$_GET['religion']."' and
                    status = 'Active'  
					";

					
$members=$obj->select($sql);
?>
<?php if(!empty($members)) { ?>
<ul class="profl-list">
            <?php
					foreach($members as $res) { ?>
            	<li>
                    <div class="profile-img-box first col-md-12 col-xs-12 col-md-12">
                    <a href="view_profile.php?id=<?php echo $res['id']; ?>">
                        <?php
						if(!empty($res['photo']))
						{
						 	$path = "../upload/".$res['photo'];
							if (file_exists($path)) { 
                       			echo '<img class="size" src="'.$path.'"/><br>';
							}
							else{

								if($res['gender']=='M')
									echo '<img title="click here to upload photo" class="profile_pic" src="images/male-user1.png" style="width:181px;height:192px;" />';
								else
									echo '<img title="click here to upload photo" class="profile_pic" src="images/female-user1.png" style="width:181px;height:192px;" />';
							}
						}
						else{
								if($res['gender']=='M')
									echo '<img title="click here to upload photo" class="profile_pic" src="images/male-user1.png" style="width:181px;height:192px;" />';
								else
									echo '<img title="click here to upload photo" class="profile_pic" src="images/female-user1.png" style="width:181px;height:192px;" />';
							}?>
                            
                        <span><?php echo $res['name']; ?> ( <?php echo $res['religion'] ?> )<br />
<?php echo $res['age']; ?> Yrs, <?php echo $res['height']; ?> Ft<br />
<?php echo $res['education']; ?>
</span></a>
                        <div class="goto"><a href="#" class="icon-heart"></a><a href="#" class="icon-gift"></a><a href="#" class="icon-mail"></a><a href="#" class="icon-chat"></a></div>
                    </div>
                </li>
                <?php } 
				?>
            </ul>
<?php } 
else
			{
				?><div class="content" id="content_data"><?php
				echo "Sorry, No Matches found";
				?></div><?php
			}?>            
