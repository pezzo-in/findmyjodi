<?php
    session_start();
    include('lib/myclass.php');
    $config['base_url']=$obj->SITEURL.'acesslinkeddata.php';
    $config['callback_url']=$obj->SITEURL.'demo.php';
    $config['linkedin_access']='75vkqc3tq7hrwp';
    $config['linkedin_secret']='VpK3l3fMS3hMna7f';

    include_once "linkedin.php";

    # First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
    $linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['callback_url'] );
    //$linkedin->debug = true;

    # Now we retrieve a request token. It will be set as $linkedin->request_token
    $linkedin->getRequestToken();
    $_SESSION['requestToken'] = serialize($linkedin->request_token);
  
    # With a request token in hand, we can generate an authorization URL, which we'll direct the user to
    //echo "Authorization URL: " . $linkedin->generateAuthorizeUrl() . "\n\n";
    header("Location:".$linkedin->generateAuthorizeUrl());
?>
