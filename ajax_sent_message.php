<?php
include('lib/myclass.php');

$from_id = $_GET['From'];
$to_id = $_GET['To'];
$message = $_GET['Msg'];


$insert = "insert into messages(id,from_mem,to_mem,message,parent_id,send_date)
			   values
			   (NULL,'".$from_id."',
			   	 	 '".$to_id."',
					 '".$message."',
					 '0',
					 '".date('Y-m-d H:i:s')."'
					 )";
					 //echo $insert;exit;
					 
$save_msg = $obj->insert($insert);

//echo"1";
				$muser = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.member_id = '".$from_id."'";	
				$dbmuser=$obj->select($muser);
				
				//echo"<pre>";print_r($dbmuser);
				
				
				if($dbmuser[0]['photo'] != ''){
					
					$pic1="<img src='upload/".$dbmuser[0]['photo']."' height='25' width='25' class='ol-prfl-img' />";
						
				}else{
					
					if($dbmuser[0]['gender'] == 'M'){
						$pic1="<img src='images/male-user1.png' height='25' width='25' class='ol-prfl-img' />";
					}else{
						$pic1="<img src='images/female-user1.png' height='25' width='25' class='ol-prfl-img' />";
					}
				
				}
				$name = $dbmuser[0]['name'];
				$img = $dbmuser[0]['photo'];
				$msf = $message;
				$date = date('d M Y');
				
				
				//echo"<pre>";print_r($dbmuser); exit;*/



?>
<li><div class="msgChatIn"><a href="#"><?php echo $pic1; ?></a><div class="chatMsgCont"><a href="#"><span class="chatMsgName"><?php echo $name; ?></span></a><span class="chatMsgText"><?php echo $message; ?></span><span class="chatMsgDate"><?php echo $date; ?></span></div></div></li>