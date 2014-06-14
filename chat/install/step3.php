<?php 
$error=0;
	if(isset($_POST['e'])){
		$errors=$_POST['e'];
		if(!empty($errors)){
		$error=1;	
		}
		$replaced=array('Array','[db_host]','[db_user]','[db_name]','[username]','[password]','[warning]','[db_users]','[table_user]','[user_status]','[user_nick]','[user_email]','1','(',')','Fatal Error');
		$errors=str_replace($replaced,'',$errors);
		$vars=explode('@>#__!',$errors);
		$errors=explode('=>',$vars[0]);
			$errs='';
		$count=count($errors);
		for($i=1;$i<$count;$i++){
			$errs.='<li>'.$errors[$i].'</li>';
		}
    if($errs!=''){
      $errs='Please fix those errors to continue :<ul>'.$errs.'</ul>';
    }
		$vals=@explode('*_@#/',$vars[1]);
    if(empty($vals[0])){
     $vals[0]=urldecode(@$_COOKIE['vars']);
     $vals=explode('*_@#/',$vals[0]);
    }
	}
	$chk='checked="checked"';
 ?>
 <span id="loadin" style="display:none;">Loading <img src="image/loading.gif" /></span>
 <h1 style="background: url('image/configuration.png') no-repeat;">Step 3 - Configuration</h1>
<div style="width: 100%; display: inline-block;">
  <div style="float: left; width: 569px;">
    <?php if ($error) { ?>
    <div class="warning"><?php echo $errs; ?></div>
    <?php } ?>
    <form action="#" method="post" enctype="multipart/form-data" id="form3">
    	
    	 <p>1. Please choose which mode of the chat you will use.</p>
      <div class="inner">
        <table>
          <tr>
            <td width="80">Mode A*:</td>
            <?php
              if(!empty($vals[0])){
                switch($vals[0]){
                  case'b':
                    echo'<td><input id="modeA" type="radio" name="mode" value="a" /></td></tr><tr>
                          <td>Mode B**:</td><td><input id="modeB" type="radio" name="mode" value="b" ';
                          echo $chk.'/></td>';
                  break;
                  default:
                    echo'<td><input id="modeA" type="radio" name="mode" value="a" ';
                    echo $chk.' /></td></tr><tr>
                          <td>Mode B**:</td><td><input id="modeB" type="radio" name="mode" value="b"  /></td>';
                  break;
                } 
              }else{
                echo'<td><input id="modeA" type="radio" name="mode" value="a" ';
                echo $chk.' /></td></tr><tr>
                <td>Mode B**:</td><td><input id="modeB" type="radio" name="mode" value="b"  /></td>';
              }        
            ?>
          </tr>
        </table>
        <table>
        <tr>
           	<td width="400">* : Use the chat default authentication system</td>
          </tr>
           <tr>
           <td>**: Use your own authentication system</td>
            </tr>
        </table>
      </div>
      
      <p>2 . Please enter your database connection details.</p>
      <div class="inner">
        <table>
          <tr>
            <td width="185"><span class="required">*</span>Database Host:</td>
            <td><input type="text" name="db_host" value="<?php echo !empty($vals[1])?$vals[1]:null; ?>" /></td>
          </tr>
          <tr>
            <td><span class="required">*</span>User:</td>
            <td><input type="text" name="db_user" value="<?php echo !empty($vals[2])?$vals[2]:null; ?>" /></td>
          </tr>
          <tr>
            <td>Password:</td>
            <td><input type="password" name="db_password" value="<?php echo !empty($vals[3])?$vals[3]:null; ?>" /></td>
          </tr>
          <tr>
            <td><span class="required">*</span>Database Name:</td>
            <td><input type="text" name="db_name" value="<?php echo !empty($vals[4])?$vals[4]:null; ?>" /></td>
          </tr>
          <tr>
            <td>Database Prefix:</td>
            <td><input type="text" name="db_prefix" value="<?php echo !empty($vals[5])?$vals[5]:null; ?>" /></td>
          </tr>
        </table>
      </div>
      
       <p class="div4">3 . Please enter your Users table details.</p>
      <div class="div4 inner" >
        <table>
          <tr>
            <td width="300"><span class="required">*</span>The Database where Users are stored:</td>
            <td><input type="text" name="db_users" value="<?php echo !empty($vals[6])?$vals[6]:null; ?>" /></td>
          </tr>
          <tr>
            <td><span class="required">* #</span>The Table of the users:</td>
            <td><input type="text" name="table_user" value="<?php echo !empty($vals[7])?$vals[7]:null; ?>" /></td>
          </tr>
          <tr>
            <td><span class="required">*</span>Status column name:</td>
            <td><input type="text" name="user_status" value="<?php echo !empty($vals[8])?$vals[8]:null; ?>" /></td>
          </tr>
          <tr>
            <td><span class="required">*</span>User's ID column name:</td>
            <td><input type="text" name="user_id" value="<?php echo !empty($vals[9])?$vals[9]:null; ?>" /></td>
          </tr>
          <tr>
            <td><span class="required">*</span>User's nickname column name:</td>
            <td><input type="text" name="user_nick" value="<?php echo !empty($vals[10])?$vals[10]:null; ?>" /></td>
          </tr>
           <tr>
            <td><span class="required">*</span>User's email column name:</td>
            <td><input type="text" name="user_email" value="<?php echo !empty($vals[11])?$vals[11]:null; ?>" /></td>
          </tr>
            <tr>
            <td><strong><span style="color:red"># : The prefix will not be applied on this field </span> </strong> </td>
          </tr>
        </table>
      </div>  
      
      <div style="text-align: right;"><a id="stp3" class="button"></a></div>
    </form>
  </div>
  <div id="sidebar">
    <ul>
      <li><del>Welcome</del></li>
      <li><del>Pre-Installation</del></li>
      <li><b>Configuration</b></li>
      <li>Finished</li>
    </ul>
  </div>
</div>