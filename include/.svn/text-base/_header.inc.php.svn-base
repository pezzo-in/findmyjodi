<?php 
$url=explode('/',$_SERVER['REQUEST_URI']);

	/*if($_GET['flag'] == "deactive")
	{
		$update="UPDATE members 
				  SET 
				  	status = 'Deactive'				  		
				 where 
				 	id = '".$_SESSION['logged_user'][0]['id']."'";
		$db_updatepage=$obj->edit($update);	
	   	echo "<script>window.location='edit_profile.php'</script>";
	}
	if($_GET['flag'] == "activate")
	{
		$update="UPDATE members 
				  SET 
				  		status = 'Active'				  		
				 where 
				 		id = '".$_SESSION['logged_user'][0]['id']."'";
		$db_updatepage=$obj->edit($update);	
		echo "<script>window.location='edit_profile.php'</script>";
	}
	if($_GET['flag'] == "delete")
	{
		$delete_acc="delete from members 
				 where 
				 id = '".$_SESSION['logged_user'][0]['id']."'";
		$obj->sql_query($delete_acc);
		echo "<script>window.location='logout.php'</script>";
	}*/
	if(isset($_GET['logged']))
	{
		$sql = "select * from members where id = '".$_GET['mem_id']."'";
		$res = $obj->select($sql);
		$_SESSION['logged_user'][0]['id'] = $res[0]['id'];
		$_SESSION['logged_user'] = $res;
	}
	if(isset($_POST['login']))
	{
		if($_POST['username'] != "" || $_POST['password'] != "")
		{
			$sql="select * from members 
			 	 where
			  	email_id = '".$_POST['username']."' and 
				password = '".md5($_POST['password'])."' and
				status = 'Active'";
				
			$ans=$obj->select($sql);
			if(!empty($ans))
			{
				$_SESSION['logged_user'][0]['id']=$ans[0]['id'];	
				$_SESSION['logged_user'] = $ans;
	
				echo "<script> window.location='edit_profile.php'</script>";
			}
			else
			{
				echo "<script> window.location='login.php'</script>";
			}
		}
		else
		{
			echo "<script> window.location='login.php'</script>";
		}
	}
?>
<div class="top">
    <div class="topIn">
        <a href="index.php" class="logo"><img src="images/logo.png" /></a>
        
        <div class="topLogin">
            <div class="loginlink">            	
            <?php if($_SESSION['logged_user'][0]['id']=='') { ?>
                <a href="javascript:;" class="link-signin">Sign In</a> 
				<?php } else { ?>
                <a href="logout.php" class="link-reg">Sign Out</a> 
                <?php } ?>
				<div class="loginbox">
                    <div class="loginboxtop"></div>
                    <div class="loginboxmain">
                        <form method="post" name="login">
                            <div class="row"><input type="text" name="username" placeholder="Username" /></div>
                            <div class="row"><input type="password" name="password" placeholder="Password" /></div>
                            <input type="submit" class="loginnow" value="Login now" name="login" />
                            <label><input type="checkbox" />Stay Signed in</label>
                            <a href="reset_password.php">Forgot Password?</a>
                        </form>
                    </div>
                </div>
            </div>
            <?php if($_SESSION['logged_user'][0]['id']=='') { ?>
            <a href="register.php" class="link-reg">Register</a>            
            <?php } ?>
        </div>
        <?php if($_SESSION['logged_user'][0]['id']=='') { ?> 
        <ul class="menu" id="menu">
            <li <?php if($url[3] == "index.php") { echo "class='active'"; } ?>><a href="index.php">Home</a></li>
            <li <?php if($url[3] == "search.php") { echo "class='active'"; } ?>><a href="search.php">Search</a>
               <ul>
               		<div>
                    <li><a href="search.php?flag=rag">Regular search</a></li>
               		<li><a href="search.php#searchtab-2">Advanced search</a></li>
                    <li><a href="search.php?flag=soul">Soulmate search</a></li>
                    <li><a href="search.php?flag=key">Keyword search</a></li>                    
                   </div>
               </ul>
            </li>
            <li <?php if($url[3] == "upgrade.php") { echo "class='active'"; } ?>><a href="upgrade.php">Upgrade</a></li>
            <li <?php if($url[3] == "quick_tour.php") { echo "class='active'"; } ?>><a href="quick_tour.php">Take A Quick Tour</a></li>
            <li <?php if($url[3] == "help.php") { echo "class='active'"; } ?>><a href="help.php">Help</a></li>
        </ul>
       <?php }else { ?>
       <ul class="menu" id="menu">
            <li <?php if($url[3] == "index.php") { echo "class='active'"; } ?>><a href="index.php">Home</a></li>
            <li <?php if($url[3] == "search.php") { echo "class='active'"; } ?>><a href="search.php">Search</a>
               <ul><div>
	               	<li><a href="search.php?flag=rag">Regular search</a></li>
               		<li><a href="search.php?flag=adv">Advanced search</a></li>
                    <li><a href="search.php?flag=soul">Soulmate search</a></li>
                    <li><a href="search.php?flag=key">Keyword search</a></li>
                    </div>
               </ul> 
            </li>
            <li <?php if($url[3] == "my_account.php") { echo "class='active'"; } ?>><a href="my_account.php">My Profile</a>
            	<ul> 
	                <div>
	               	<li><a href="edit_profile.php">Edit profile</a></li>
                    <li><a href="edit_photo_upload.php">Upload photo</a></li>
                    <li><a href="edit_mobile_no.php">Edit Mobile Number</a></li>
                    <li><a href="edit_horoscope.php">Add Horoscope</a></li>
                    <li><a href="edit_partner_pref.php">Add/Edit Partner Preference</a></li>
                    <li><a href="edit_family_detail.php">Add/Edit Family Details</a></li>
                    <li><a href="edit_hobbies.php">Add/Edit Hobbies & Interests</a></li>
                    <?php if($_SESSION['logged_user'][0]['is_profile_active'] == 'Y') { ?>
                    <li><a href="edit_profile.php?flag=deactive">Deactivate Profile</a></li>
                    <?php }  else { ?>
                    <li><a href="edit_profile.php?flag=active">Activate Profile</a></li><?php } ?>
                    <li><a href="edit_profile.php?flag=delete">Delete Profile</a></li>
                    </div>
                </ul>    
              </li>  
                    
            <li <?php if($url[3] == "all_notifications.php") { echo "class='active'"; } ?>><a href="all_notifications.php">
            <?php $new_msg = "select * from messages 
			                  where to_mem = '".$_SESSION['logged_user'][0]['member_id']."'
							  and is_replied = 'N' and interested = 'Y'"; 
				 $total_msg = $obj->select($new_msg);			  
							  ?>
            Messages<span><?php echo count($total_msg); ?></span></a></li>
            <li <?php if($url[3] == "help.php") { echo "class='active'"; } ?>><a href="help.php">Help</a></li>
        </ul>
       <?php } ?> 
        <script type="text/javascript">
        var menu=new menu.dd("menu");
        menu.init("menu","menuhover");
        </script> 
    </div>
</div>
<script>
$(document).ready(function(){
	$(".link-signin").click(function(e) {
       $(".loginbox").toggle(function(){
			$(".loginbox").addClass("open");
		}, function () {
			$(".loginbox").removeClass("open");
		}); 
    });
	
	$(document).mouseup(function (e)
	{
		var container = $(".loginbox");
	
		if (!container.is(e.target) // if the target of the click isn't the container...
			&& container.has(e.target).length === 0) // ... nor a descendant of the container
		{
			container.hide(500);
		}
	});
	
	
});
</script>
 <?php
		/*if(isset($_SESSION['logged_user'])){
				echo "Welcome ".$_SESSION['logged_user'][0]['name']."(".$_SESSION['logged_user'][0]['email_id'].")";
			}*/
		?>