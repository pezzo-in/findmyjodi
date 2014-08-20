<script src="../js/jquery-1.7.1.min.js">



</script>
<?php
$online1="select * from chat_users where email='".$_SESSION['UserEmail']."' and status='1'";
$dbonline1=$obj->select($online1);
if(count($dbonline1)>0)
{

?>
<script src="../js/chat.js"></script>
<div class="openChat btn btn-success btn-lg hidden-xs">Chat</div>
<div class="online_member hide">
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
                $thumb_pic="<img src='upload/".$dbouser[0]['photo']."' height='150' width='150' class='ol-prfl-img' />";
	}
	else
	{
		$pic="<img src='images/male-user1.png' height='25' width='25' class='ol-prfl-img' />";
                $thumb_pic="<img src='images/male-user1.png' height='150' width='150' class='ol-prfl-img' />";
	}
	if($dbouser[0]['gender']=='F' && $dbouser[0]['photo']!='')
	{
		$pic1="<img src='upload/".$dbouser[0]['photo']."' height='25' width='25' class='ol-prfl-img' />";
                $thumb_pic1="<img src='upload/".$dbouser[0]['photo']."' height='150' width='150' class='ol-prfl-img' />";
	}
	else
	{
		$pic1="<img src='images/female-user1.png' height='25' width='25' class='ol-prfl-img' />";
                $thumb_pic1="<img src='images/female-user1.png' height='150' width='150' class='ol-prfl-img' />";
	}
	?>
    <div class="online">
<?php if($dbouser[0]['gender']=='F' && $_SESSION['logged_user'][0]['gender']=='M')
	{ ?>

        <div>
            <div>     
    <a href="#" class="onlineUsers" data-unk="<?php echo $online_data[$i]['name'];?>" data-uid="<?php echo $online_data[$i]['id'];?>">
     
<?php
		echo $pic1;
		?>
        <span class="small_uname"><?php echo ucfirst($dbouser[0]['name']); ?> (<?php echo $dbouser[0]['member_id']; ?>)<span class="icon-ol"><img src="images/online1.png" /></span></span><br />
        <span class="small_detail"><?php echo $dbouser[0]['age']."yrs-".$db_height[0]['Ft_val']."Ft ".$db_height[0]['In_val']."in-".$dbouser[0]['city']; ?></span></a>
            </div>
         <div  class="popover left"  style="margin-left: -440px;margin-top: -105px;padding-right: 10px;" id="popup-<?php echo $online_data[$i]['id'];?>" >
             <div class="arrow" style="right:0px;margin-top: 10px;"></div>
         <div style="width:430px;  padding: 1px;text-align: left;background-color: #ffffff;background-clip: padding-box;border: 1px solid #cccccc;border: 1px solid rgba(0, 0, 0, 0.2);border-radius: 6px;-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);white-space: normal;">
	<div style="padding-left: 10px;" >
        <span style="font-weight: bold;" ><a style="text-decoration:none; color:#000000 " onclick=""><?php echo ucfirst($dbouser[0]['name']); ?> (<?php echo $dbouser[0]['member_id']; ?>)</a></span>

        <div class="clear"></div>
        </div>
        <div >
                <div style="float:left;padding: 10px;"><?php echo $thumb_pic1; ?></div>
                <div style="float:left;" >
                    <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Age, Height</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" ><?php echo $dbouser[0]['age']."yrs / ".$db_height[0]['Ft_val']."Ft ".$db_height[0]['In_val']."in"; ?> </span>
                                <div class="clear"></div>
                        </div>
                    <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Religion</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" ><?php echo $dbouser[0]['religion']; ?> </span>
                                <div class="clear"></div>
                        </div>
                       <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Caste</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" ><?php echo $dbouser[0]['caste']; ?> </span>
                                <div class="clear"></div>
                        </div>
                       <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Location</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" ><?php echo $dbouser[0]['city'].", ".$dbouser[0]['country']; ?> </span>
                                <div class="clear"></div>
                        </div>
                     <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Education</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" >
                                 <?php $select_education="select * from education_course where Id='".$dbouser[0]['education']."'";
	                         $db_education=$obj->select($select_education);
	                         echo $db_education[0]['Title']; ?> </span>
                                <div class="clear"></div>
                        </div>
                         <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Occupation</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" ><?php echo $dbouser[0]['occupation']; ?> </span>
                                <div class="clear"></div>
                        </div>

                     
                        <div ><a href="view_profile.php?id=<?php echo $dbouser[0]['id']?>" >View Full Profile</a></div>
                </div>
                <div class="clear"></div>
        </div>
									
         </div>
    </div>
        </div>
        <?php
	} 
	else if($dbouser[0]['gender']=='M' && $_SESSION['logged_user'][0]['gender']=='F')
	{ ?>
      <div>
            <div> 

    <a href="#"  class="onlineUsers" data-unk="<?php echo $online_data[$i]['name'];?>" data-uid="<?php echo $online_data[$i]['id'];?>">
       
	<?php
		echo $pic;
	?>
        <span class="small_uname"><?php echo ucfirst($dbouser[0]['name']); ?> (<?php echo $dbouser[0]['member_id']; ?>)<span class="icon-ol"><img src="images/online1.png" /></span></span>
               <span class="small_detail"><?php echo $dbouser[0]['age']."yrs-".$db_height[0]['Ft_val']."Ft ".$db_height[0]['In_val']."in-".$dbouser[0]['city']; ?></span></a>
          </div>
            <div  class="popover left"  style="margin-left: -440px;margin-top: -105px;padding-right: 10px;" id="popup-<?php echo $online_data[$i]['id'];?>" >
             <div class="arrow" style="right:0px;margin-top: 10px;"></div>
         <div style="width:430px;  padding: 1px;text-align: left;background-color: #ffffff;background-clip: padding-box;border: 1px solid #cccccc;border: 1px solid rgba(0, 0, 0, 0.2);border-radius: 6px;-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);white-space: normal;">
	<div style="padding-left: 10px;" >
        <span style="font-weight: bold;" ><a style="text-decoration:none; color:#000000 " onclick=""><?php echo ucfirst($dbouser[0]['name']); ?> (<?php echo $dbouser[0]['member_id']; ?>)</a></span>

        <div class="clear"></div>
        </div>
        <div >
                <div style="float:left;padding: 10px;"><?php echo $thumb_pic; ?></div>
                <div style="float:left;" >
                    <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Age, Height</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" ><?php echo $dbouser[0]['age']."yrs / ".$db_height[0]['Ft_val']."Ft ".$db_height[0]['In_val']."in"; ?> </span>
                                <div class="clear"></div>
                        </div>
                    <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Religion</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" ><?php echo $dbouser[0]['religion']; ?> </span>
                                <div class="clear"></div>
                        </div>
                       <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Caste</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" ><?php echo $dbouser[0]['caste']; ?> </span>
                                <div class="clear"></div>
                        </div>
                       <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Location</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" ><?php echo $dbouser[0]['city'].", ".$dbouser[0]['country']; ?> </span>
                                <div class="clear"></div>
                        </div>
                     <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Education</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" >
                                 <?php $select_education="select * from education_course where Id='".$dbouser[0]['education']."'";
	                         $db_education=$obj->select($select_education);
	                         echo $db_education[0]['Title']; ?> </span>
                                <div class="clear"></div>
                        </div>
                         <div style="line-height: 15px;padding-top: 3px;">
                                <span style="width:70px;float:left;" >Occupation</span>
                                <span style="width:8px;float:left;" >:</span>
                                <span style="width:167px;float:left;" ><?php echo $dbouser[0]['occupation']; ?> </span>
                                <div class="clear"></div>
                        </div>

                     
                         <div ><a href="view_profile.php?id=<?php echo $dbouser[0]['id']?>" >View Full Profile</a></div>
                </div>
                <div class="clear"></div>
        </div>
									
         </div>
    </div>
        <?php
	}
	?>

    <div class="clear"></div>
  
       
    </div>
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
$(document).ready(function(){
	//var h=$('.topMain').css('height');
//	h=h.replace('px','');
//	var fh=parseInt(h)+parseInt(30);
//	$('.online_member').css('top',fh+'px');
    $('.openChat').click(function(){
        $('.online_member').toggleClass('hide');
        $(this).toggleClass('open');
    })
});

</script>