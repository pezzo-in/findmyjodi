<?php 
date_default_timezone_set('Asia/Calcutta');
$sessionVar = 'chatUser';
$url=explode('/',$_SERVER['REQUEST_URI']);
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
			$sql="select * from members where (email_id = '".$_POST['username']."' or member_id = '".$_POST['username']."') and password = '".md5($_POST['password'])."' and status = 'Active'";
			$ans=$obj->select($sql);
			
			if(count($ans)>0)
			{
				$_SESSION['logged_user'][0]['id']=$ans[0]['id'];	
				$_SESSION['UserEmail']=$ans[0]['email_id'];	
				$_SESSION['IsActive']='Yes';
				$_SESSION['logged_user'] = $ans;
				
				$select_member_plan="select member_plans.* from member_plans, members where member_plans.member_id='".$ans[0]['id']."' AND members.id=member_plans.member_id and member_plans.expiry_date>'".date('Y-m-d')."'";
				$db_member_plan=$obj->select($select_member_plan);
				/*$exp_date=date('Y-m-d');
				if(count($db_member_plan)>0)
				{
					$select_plan="select * from new_membership_plans where id='".$db_member_plan[0]['plan_id']."'";
					$db_plan=$obj->select($select_plan);
					
					$exp_date=date('Y-m-d',strtotime('+'.$db_plan[0]['plan_duration'].' days '.$db_date[0]['reg_date']));
				}
			*/
				if(count($db_member_plan)>0)
				{
					$_SESSION[$sessionVar]=$ans[0]['name'];
					$_SESSION['chatStat']=1;
					$_SESSION['Member_status']='Paid';
					
					$select_chat_user="select * from chat_users where email='".$_SESSION['UserEmail']."'";
					$db_chat_user=$obj->select($select_chat_user);
					if(count($db_chat_user)>0)
					{
						$update_chat_user="update chat_users set status='1', name='".$ans[0]['name']."', chat_last_activity='".date('Y-m-d H:i:s')."' where email='".$_SESSION['UserEmail']."'";
						$obj->edit($update_chat_user);
					}
					else
					{
			$insert_online = "insert into chat_users(id, name, email, status) values(null, '".$ans[0]['name']."', '".$_SESSION['UserEmail']."', '1')";
						$db_insert_online = $obj->insert($insert_online);
					}
				}
				if(isset($_SESSION['redirect_profile'])){echo "<script> window.location='view_profile.php?id=".$_SESSION['redirect_profile']."'</script>";}
				else{echo "<script> window.location='my_account.php'</script>";}
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
<div class="top col-md-12 col-xs-12 col-sm-12">
    <div class="topIn col-md-12 col-xs-12 col-sm-12">
    <?php if($_SESSION['UserEmail']=='' || $_SESSION['IsActive']=='No') { ?>
        <a href="index.php" class="logo col-md-2 col-xs-offset-3 col-sm-offset-0"><img src="images/logo2.png" alt="Find My Jodi" title="Find My Jodi" width="130" /></a>
        <?php }else { ?>
        <a href="my_account.php" class="logo col-md-2 col-xs-12"><img src="images/logo2.png" alt="Find My Jodi" title="Find My Jodi" width="130" /></a>
        <?php } ?>
        <div class="topLogin col-md-3 pull-right text-right col-xs-12">
            <div class="loginlink col-md-6 col-xs-6 col-sm-6 pull-right">
            <?php if($_SESSION['UserEmail']=='' || $_SESSION['IsActive']=='No') { ?>
                <div class="dropdown">
                    <a data-toggle="dropdown" href="login.php" class="btn btn-info btn-md col-md-12 col-xs-12 col-sm-12" title="Login to your profile">Sign In</a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li>
                            <div class="loginbox">
                                <div class="loginboxtop"></div>
                                <div class="loginboxmain">
                                    <form method="post" name="login">
                                        <div class="row"><input type="text" name="username" placeholder="Email OR MemberId" class="form-control" /></div>
                                        <div class="row"><input type="password" name="password" placeholder="Password" class="form-control" /></div>
                                        <input type="submit" class="loginnow" value="Login now" name="login" class="btn btn-success btn-sm" />
                                        <label><!--<input type="checkbox" />Stay Signed in--></label>
                                        <a href="forgot_password.php" style="font-size: 12px;margin-top: 12px;">Forgot Password?</a>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <?php } else { ?>
                <a href="logout.php" class="link-reg btn btn-danger btn-md pull-right sign-out" title="Sign Out">Sign Out</a>
                <?php } ?>
            </div>
            <?php if($_SESSION['UserEmail']=='' || $_SESSION['IsActive']=='No') { ?>
            <a href="register.php" class="btn btn-danger btn-md col-md-6 col-xs-5 col-sm-6" title="Create your profile">Register</a>
            <?php } ?>
        </div>
        <?php if($_SESSION['UserEmail']=='' || $_SESSION['IsActive']=='No') { ?> 
       <!-- <nav role="navigation" class="navbar">
            <div class="container-fluid">
            &lt;!&ndash; Brand and toggle get grouped for better mobile display &ndash;&gt;
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                &lt;!&ndash; Collect the nav links, forms, and other content for toggling &ndash;&gt;
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">-->
                    <ul class="menu col-md-6" id="menu">
                        <li <?php //if($url[2] == "index.php") { echo "class='active'"; } ?>><a href="index.php" title="Home">Home</a></li>
                        <li <?php //if($url[2] == "search.php") { echo "class='active'"; } ?>><a href="search.php" title="Search">Search</a>
                            <ul>
                                <li><a href="search.php?flag=rag">Simple Search</a></li>
                                <li><a href="search.php?flag=adv">Advanced Search</a></li>
                                <li><a href="search.php?flag=key">Keyword Search</a></li>
                                <li><a href="search.php?flag=id">Search by ID</a></li>
                                <li><a href="save_search.php">Saved Search</a></li>
                            </ul>
                        </li>
                        <li><a href="upgrade.php" title="Upgrade">Packages</a></li>
                        <li <?php //if($url[2] == "quick_tour.php") { echo "class='active'"; } ?>><a href="quick_tour.php" title="Quick Tour">Quick Tour</a></li>
                        <li <?php //if($url[2] == "help.php") { echo "class='active'"; } ?>><a href="help.php" title="Contact Us">Contact Us</a></li>
                    </ul>
                <!--</div>&lt;!&ndash; /.navbar-collapse &ndash;&gt;
            </div>&lt;!&ndash; /.container-fluid &ndash;&gt;
        </nav>-->
        
       <?php }else { ?>
       <ul class="menu" id="menu">
            <!--<li><a href="index.php">Home</a></li>-->
            
            <li <?php //if($url[2] == "my_account.php") { echo "class='active'"; } ?>><a href="my_account.php" title="My Profile">My Profile</a>
            	   
              </li>  
                 <li <?php //if($url[2] == "search.php") { echo "class='active'"; } ?>><a href="search.php" title="Search">Search</a>
               <ul><div>
	               	<li><a href="search.php?flag=rag">Simple Search</a></li>
               		<li><a href="search.php?flag=adv">Advanced Search</a></li>
                    <!--<li><a href="search.php?flag=soul">Soulmate search</a></li>-->
                    <li><a href="search.php?flag=key">Keyword Search</a></li>
                    <!--<li><a href="search.php?flag=online">Who's Online</a></li>-->
                    <li><a href="search.php?flag=id">Search by ID</a></li>
                    <li><a href="save_search.php">Saved Search</a></li>                    
                    </div>
               </ul> 
            </li>   
            <li><a href="packages.php" title="Upgrade">Upgrade</a></li>
            <li <?php //if($url[2] == "all_notifications.php") { echo "class='active'"; } ?>><a href="received_msgs.php#msgtab-2"  title="Messages">
            <?php $new_msg = "select * from messages 
			                  where to_mem = '".$_SESSION['logged_user'][0]['member_id']."'";							   
				 $total_msg = $obj->select($new_msg);			  
							  ?>
            Messages<?php /*?><span><?php echo count($total_msg); ?></span><?php */?></a></li>
            <li <?php //if($url[2] == "help.php") { echo "class='active'"; } ?>><a href="help.php" title="Contact Us">Contact Us</a></li>
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
<script>
$(document).ready(function(){
	$('#friends').css('display','none');
});
</script>