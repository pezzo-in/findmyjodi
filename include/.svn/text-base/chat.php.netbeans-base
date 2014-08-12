<?php
$path='';
require_once($path.'include/layout.php');
echo'<link rel="stylesheet" type="text/css" href="'.$path.'css/smoothChat.css" />';
?>
<!--<script type="text/javascript" src="js/jquery.tinyscrollbar.min.js"></script>
<script>
$(document).ready(function(e) {
	$('.chat_box_in').tinyscrollbar({ sizethumb: 2 }); 
});
</script>-->

<?php
chat($path);
incScripts($path);
?>

<?php /*?><div class="chat1">
 <div class="chat_box_in">
 	<div class="scrollbar">
        <div class="track">
            <div class="thumb">
                <div class="end"></div>
            </div>
        </div>
    </div> 
    <h3>Online Member</h3>
     <div class="viewport">
         <div class="overview"> 
	<?php
	$select_online_member="select * from chat_users where email!='".$_SESSION['UserEmail']."' group by email";
	$db_online_member=$obj->select($select_online_member);
	for($i=0;$i<count($db_online_member);$i++)
	{
		$select_member_detail="SELECT members.*,member_photos.photo, member_photos.Approve FROM members LEFT JOIN member_photos ON members.id = member_photos.member_id WHERE members.email_id='".$db_online_member[$i]['email']."'";
		$db_member_detail=$obj->select($select_member_detail);
	?>
   
    	<div class="chat_box">
		<a data-unk="<?php echo $db_member_detail[0]['name']; ?>" data-uid="<?php echo $db_member_detail[0]['id']; ?>" class="onlineUsers" href="#">
            <div class="chat_img">
    
                <?php
    
                    if($db_member_detail[0]['photo']!='')
    
                    {
    
                        $path = "upload/".$db_member_detail[0]['photo'];
    
                        if (file_exists($path)) {
    
                                echo '<img src="'.$path.'" />';
    
                        }
    
                        else{
    
                            if($db_member_detail[0]['gender']=='M')
    
                                echo '<img src="images/male-user1.png" />';
    
                            else
    
                                echo '<img src="images/female-user1.png" />';
    
                        }
    
                    }
    
                    else
    
                    {
    
                        if($db_member_detail[0]['gender']=='M')
    
                            echo '<img src="images/male-user1.png" />';
    
                        else
    
                            echo '<img src="images/female-user1.png" />';
    
                    }
    
                ?>
    
            </div>
    
            <div class="chat_txt"><?php echo $db_member_detail[0]['name']; ?></div>
        </a>
			
        </div>
    
    <?php
	}
	?>
         </div>
     </div>
<div class="paddbtm-5"></div>
    </div>
</div><?php */?>