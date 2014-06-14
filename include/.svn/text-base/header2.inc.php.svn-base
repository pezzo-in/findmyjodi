<?php
	if(isset($_GET['logged']))
	{
		$sql = "select * from members where id = '".$_GET['mem_id']."'";
		$result = $obj->select($sql);
		
		$_SESSION['logged_user'][0]['id'] = $result[0]['id'];
		$_SESSION['logged_user'] = $result;
		
	}


	if(isset($_POST['login']))
	{
		if($_POST['username'] != "" || $_POST['password'] != "")
		{
			$sql="select * from members 
			 	 where
			  	username = '".$_POST['username']."' and password = '".md5($_POST['password'])."'";
			$ans=$obj->select($sql);
			if(!empty($ans))
			{
				echo $_SESSION['logged_user'][0]['id']=$ans[0]['id'];		
				echo "<script> window.location='index.php'</script>";
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
            <div class="toploginlink2">            	
                <a href="login.php" class="link-signin">Sign In</a> 
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
            <a href="register.php" class="link-reg">Register</a>
        </div>
        <ul class="menu" id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Search</a>
                <ul>
                    <li><a href="#">Submenu1</a></li>
                    <li><a href="#">Submenu2</a>
                        <ul>
                            <li><a href="#">Submenu4</a></li>
                            <li><a href="#">Submenu5</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Submenu3</a></li>
                </ul>
            </li>
            <li><a href="#">Upgrade</a></li>
            <li><a href="#">Take A Quick Tour</a></li>
            <li><a href="#">Help</a></li>
        </ul>
        <script type="text/javascript">
        var menu=new menu.dd("menu");
        menu.init("menu","menuhover");
        </script> 
    </div>
</div>
<style>
.toploginlink2
{
	.float: left;
    position: relative;
}
</style>