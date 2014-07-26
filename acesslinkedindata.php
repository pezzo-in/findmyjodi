<?php
define('API_KEY','75vkqc3tq7hrwp');
define('API_SECRET','VpK3l3fMS3hMna7f');
define('REDIRECT_URI', 'http://localhost/findmyjodi-master/edit_profile.php');
define('SCOPE','r_fullprofile r_emailaddress rw_nus');
session_name('linkedin');
session_start();
if(isset($_GET['error'])) {
$_GET['error'].':'.$_GET['error_description'];

}elseif(isset($_GET['code'])) {
if($_SESSION['state']==$_GET['state']) 
{
  getAccessToken();
} else {
        exit;
}
} else { 
if((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
       $_SESSION = array();
       
}
if(empty($_SESSION['access_token'])) {
    getAuthorizationCode();
}
}

$user = fetch('GET','/v1/people/~:(firstName,lastName)');

print "Hello $user->firstName $user->lastName.";


function getAuthorizationCode() 
{
   $params = array('response_type' => 'code','client_id' => API_KEY,'scope' => SCOPE,'state' => uniqid('', true),'redirect_uri' => REDIRECT_URI,);
   $url = 'https://www.linkedin.com/uas/oauth2/authorization?'.http_build_query($params);
   $_SESSION['state'] = $params['state'];
   header("Location: $url");
   exit;
}
function getAccessToken() {
  $params = array('grant_type' => 'authorization_code','client_id' => API_KEY,'client_secret' => API_SECRET,'code' => $_GET['code'],'redirect_uri' => REDIRECT_URI,);
  $url = 'https://www.linkedin.com/uas/oauth2/accessToken?'.http_build_query($params);
  $context = stream_context_create(array('http'=>array('method' => 'POST',)));
  $response = file_get_contents($url,false,$context);
  $token=json_decode($response);
  $_SESSION['access_token']=$token->access_token;
  $_SESSION['expires_in']=$token->expires_in;
  $_SESSION['expires_at']=time()+$_SESSION['expires_in'];
return true;
} 
function fetch($method,$resource,$body=''){
$params=array('oauth2_access_token'=>$_SESSION['access_token'],'format' =>'json',);
$url='https://api.linkedin.com'.$resource.'?'.http_build_query($params);
$context=stream_context_create(array('http' => array('method'=>$method,)));
$response=file_get_contents($url,false,$context);
$_SESSION['response']=$response;
return json_decode($response);
}
?>