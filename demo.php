<?php
    include('lib/myclass.php'); 
    session_start();
    if($_REQUEST['oauth_problem']=='user_refused')
    {
     
        echo "<script>window.location='edit_profile.php'</script>"; 
        exit;
    }

    $config['base_url']=$obj->SITEURL.'acesslinkeddata.php';
    $config['callback_url']=$obj->SITEURL.'demo.php';
    $config['linkedin_access']='75vkqc3tq7hrwp';
    $config['linkedin_secret']='VpK3l3fMS3hMna7f';

    include_once "linkedin.php";
   
    
    # First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
    $linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['callback_url'] );
    //$linkedin->debug = true;

   if (isset($_REQUEST['oauth_verifier'])){
        $_SESSION['oauth_verifier']     = $_REQUEST['oauth_verifier'];

        $linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->getAccessToken($_REQUEST['oauth_verifier']);

        $_SESSION['oauth_access_token'] = serialize($linkedin->access_token);
        header("Location: " . $config['callback_url']);
        exit;
   }
   else{
        $linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->access_token     =   unserialize($_SESSION['oauth_access_token']);
   }


    # You now have a $linkedin->access_token and can make calls on behalf of the current member
   
	$xml_response = $linkedin->getProfile("~:(id,headline,industry,positions)");
        $data = simplexml_load_string($xml_response);
        $data1=  json_encode($data);
        $update="UPDATE members SET linkedin_data = '".$data1."'  where id = '".$_SESSION['logged_user'][0]['id']."'";
	$db_updatepage=$obj->edit($update);	
        $_SESSION['linkedin_id']= 1;
        echo "<script>window.location='edit_profile.php'</script>";
   /* echo '<pre>';
    echo 'My Profile Info';
   
	$data = simplexml_load_string($xml_response1);
	print_r($data);
	$value=$data->{'positions'};
	
	echo $data->industry;
    echo $value->position->title;
	
    echo '<br />';
    echo '</pre>'; */
	?>  
	<!--    echo 'My Profile Info';
    $data = simplexml_load_string($xml_response);
   
  <table border="0" cellspacing="3" cellpadding="3">
    <tr><td>Name</td>          <td><a target="_blank" href="<?=$data->{'public-profile-url'}?>"><?=$data->{'first-name'}?> <?=$data->{'last-name'}?></a></td></tr>
     <tr><td>Headline</td>      <td><?=$data->headline?></td></tr>
     <tr><td>Profile Image</td> <td><img src="<?=$data->{'picture-url'}?>" alt="" /></td></tr>
  </table> -->



