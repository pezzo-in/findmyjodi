<?php
$online1="select * from chat_users where email='".$_SESSION['UserEmail']."' and status='1'";
$dbonline1=$obj->select($online1);
if(count($dbonline1)>0)
{
	
?>
<script src="../js/chat.js"></script>
<div class="openChat">Chat >></div>
<div class="online_member">
<div class="ol-users">
<h3><span>Online Members</span></h3>
<?php 
$online="select * from chat_users where status='1'";
$online_data=$obj->select($online);
for($i=0;$i<count($online_data);$i++)
{
	$ouser= "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.email_id = '".$online_data[$i]['email']."'";
	$dbouser=$obj->select($ouser);
	
	$user_height = "select * from height where Id='".$dbouser[0]['height']."'";
	$db_height = $obj->select($user_height);
	
		if($online_data[$i]['email']!=$_SESSION['UserEmail'])
		{
	if($dbouser[0]['gender']=='M' && $dbouser[0]['photo']!='')
	{
		$pic="<img src='upload/".$dbouser[0]['photo']."' height='25' width='25' class='ol-prfl-img' />";
	}
	else
	{
		$pic="<img src='images/male-user1.png' height='25' width='25' class='ol-prfl-img' />";
	}
	if($dbouser[0]['gender']=='F' && $dbouser[0]['photo']!='')
	{
		$pic1="<img src='upload/".$dbouser[0]['photo']."' height='25' width='25' class='ol-prfl-img' />";
	}
	else
	{
		$pic1="<img src='images/female-user1.png' height='25' width='25' class='ol-prfl-img' />";
	}
	?>
    <div class="online">
<?php if($dbouser[0]['gender']=='F' && $_SESSION['logged_user'][0]['gender']=='M')
	{ ?>
    
	
    <a href="#" class="onlineUsers" data-unk="<?php echo $online_data[$i]['name'];?>" data-uid="<?php echo $online_data[$i]['id'];?>">
    
<?php
		echo $pic1;
		?>
        <span class="small_uname"><?php echo ucfirst($dbouser[0]['name']); ?> (<?php echo $dbouser[0]['member_id']; ?>)<span class="icon-ol"><img src="images/online1.png" /></span></span><br />
        <span class="small_detail"><?php echo $dbouser[0]['age']."yrs-".$db_height[0]['Ft_val']."Ft ".$db_height[0]['In_val']."in-".$dbouser[0]['city']; ?></span>
        
        <?php
	} 
	else if($dbouser[0]['gender']=='M' && $_SESSION['logged_user'][0]['gender']=='F')
	{ ?>
	 
	
    <a href="#" class="onlineUsers" data-unk="<?php echo $online_data[$i]['name'];?>" data-uid="<?php echo $online_data[$i]['id'];?>">
	
	<?php
		echo $pic;
	?>
        <span class="small_uname"><?php echo ucfirst($dbouser[0]['name']); ?> (<?php echo $dbouser[0]['member_id']; ?>)<span class="icon-ol"><img src="images/online1.png" /></span></span>
               <span class="small_detail"><?php echo $dbouser[0]['age']."yrs-".$db_height[0]['Ft_val']."Ft ".$db_height[0]['In_val']."in-".$dbouser[0]['city']; ?></span>
        <?php
	}
	?>
    
    <div class="clear"></div>
    </a>
    </div>
   
    
    <?php
		} 
	
}
?>
 </div>
</div>
<?php
}
?>
<script>
//$(document).ready(function(){
	//var h=$('.topMain').css('height');
//	h=h.replace('px','');
//	var fh=parseInt(h)+parseInt(30);
//	$('.online_member').css('top',fh+'px');
//});
</script>