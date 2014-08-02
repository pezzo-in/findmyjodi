<?php
$url=explode('/',$_SERVER['REQUEST_URI']);
if(isset($_POST['reply']))
{
	$insert = "insert into messages(id,from_mem,to_mem,message,parent_id,send_date)
			   values
			   (NULL,'".$_SESSION['logged_user'][0]['member_id']."',
			   	 	 '".$_POST['to_mem']."',
					 '".$_POST['txtMsg']."',
					 '".$_POST['msg_id']."',
					 '".date('Y-m-d H:i:s')."'
					 )";
	$save_rpl = $obj->insert($insert);				 
}
if(isset($_GET['delete_msg_id']))
{
	$sqld="delete from messages where id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld);
	
	$sqld2="delete from not_interested_members where msg_id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld2);
	
	$sqld3="delete from need_more_info_detail where msg_id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld3);
	
	$sqld4="delete from need_more_time_detail where msg_id = '".$_GET['delete_msg_id']."' ";
	$obj->sql_query($sqld4);
	
	echo "<script> window.location.href = 'my_account.php' </script>";	
}
if(isset($_GET['id']))
{
	if($_GET['flag'] == 'y')
	{
		$sqld="delete from messages where id = '".$_GET['id']."' ";
		$obj->sql_query($sqld);
		
		$del_from_notint_mem = "delete from not_interested_members where msg_id = '".$_GET['id']."'";
		$obj->sql_query($del_from_notint_mem);
	}
	else
	{
		$sqld="delete from messages where id = '".$_GET['id']."'";
		$obj->sql_query($sqld);
	}
	echo "<script> window.location.href = 'my_account.php' </script>";	
}
if(isset($_GET['reply_msg_id']))
{
	$sqld="delete from replies where id = '".$_GET['reply_msg_id']."' ";
	$obj->sql_query($sqld);
	echo "<script> window.location.href = 'my_account.php' </script>";	
}
if(isset($_POST['send_reply']))
	{
		$update_msg_status = "update messages 
							  set 
							  	is_replied = 'Y' 
							  where 
							  	from_mem = '".$_POST['to_mem_id']."'and
								to_mem = '".$_POST['from_mem_id']."'";
							//and id='".$_POST['msg_id']."'	
	
		$update = $obj->edit($update_msg_status);
		$insert_reply = "insert into replies (id,to_mem,from_mem,message,to_msg_id)
						 values
						 (NULL,'".$_POST['to_mem_id']."','".$_POST['from_mem_id']."','".$_POST['message']."','".$_POST['msg_id']."')";
		$insert = $obj->insert($insert_reply);		
		echo "<script>window.location='my_account.php'</script>";
		 
						 
	}	
//LOGGED-IN USER'S DETAIL //
	$sql_login = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.id = '".$_SESSION['logged_user'][0]['id']."'";	
	$logged_in_member=$obj->select($sql_login);
	
		
?>
<?php
	
	$select_new_msgs = "select * from messages where conversation=1 and (to_mem = '".$_SESSION['logged_user'][0]['member_id']."' OR  from_mem = '".$_SESSION['logged_user'][0]['member_id']."') order by id desc";
	$messages = $obj->select($select_new_msgs);
	/*$arrMembers  =  array_unique(array_merge($arrTempTo,$arrTempFrom));*/
	
 	if(!empty($messages)) 
	{
?>
<div class="content col-md-9 col-sm-12 col-xs-12">
	<div class="msgChat">
    	<ul id="msgChat">
        <?php
			
		for($lpcntrl=0;$lpcntrl<count($messages); $lpcntrl++)
		{

					if($messages[$lpcntrl]['from_mem']==$_SESSION['logged_user'][0]['member_id'])
					{
					$muser = "SELECT members.*,member_photos.photo FROM members 
					LEFT JOIN member_photos ON members.id = member_photos.member_id	WHERE
					members.member_id = '".$messages[$lpcntrl]['to_mem']."'";
					
					$dbmuser=$obj->select($muser);
					if(count($dbmuser)>0)
					{
					if($dbmuser[0]['gender']=='M' && $dbmuser[0]['photo']!='')
					{
						$pic="<img src='upload/".$dbmuser[0]['photo']."' height='50' width='50' class='ol-prfl-img' />";
					}
					else
					{
						$pic="<img src='images/male-user1.png' height='50' width='50' class='ol-prfl-img' />";
					}
					if($dbmuser[0]['gender']=='F' && $dbmuser[0]['photo']!='')
					{
						$pic1="<img src='upload/".$dbmuser[0]['photo']."' height='50' width='50' class='ol-prfl-img' />";
					}
					else
					{
						$pic1="<img src='images/female-user1.png' height='50' width='50' class='ol-prfl-img' />";
					}
					?>
                    <li id="<?php echo $messages[$lpcntrl]['from_mem']."_".$messages[$lpcntrl]['to_mem']; ?>" class="message <?php if($messages[$lpcntrl]['is_read']==0){ ?> unread <?php } ?>">
            	<a href="javascript:void(0);" id="lnk<?php echo $messages[$lpcntrl]['to_mem']; ?>">
					<div class="msgChatIn">
                        <?php if($dbmuser[0]['gender']=='F')
						{
							echo $pic1;
						}
						else
						{
							echo $pic;
						}
						?>
                        <div class="chatMsgCont clearfix">
                            <span class="chatMsgName" id="chantmsgname<?php echo $messages[$lpcntrl]['from_mem']."_".$messages[$lpcntrl]['to_mem']; ?>">
								<?php echo ucfirst($dbmuser[0]['name']).' ('.$dbmuser[0]['member_id'].')'; ?>
                            </span>
                            <?php $last_message = "select message,send_date from messages where (from_mem='".$dbmuser[0]['member_id']."' and to_mem='".$_SESSION['logged_user'][0]['member_id']."') or (from_mem='".$_SESSION['logged_user'][0]['member_id']."' and to_mem='".$dbmuser[0]['member_id']."') order by id desc";
							//echo $last_message;
								$db_last_msg = $obj->select($last_message);
							?>
                            <span class="chatMsgText"><?php echo $db_last_msg[0]['message']; ?></span>
                            <span class="chatMsgDate"><?php echo date('d M Y',strtotime($db_last_msg[0]['send_date'])); ?></span>
                        </div>
                    </div>
              	</a>
         	</li><?php
					} }
					else
					{
					$muser = "SELECT members.*,member_photos.photo FROM members 
					LEFT JOIN member_photos ON members.id = member_photos.member_id	WHERE
					members.member_id = '".$messages[$lpcntrl]['from_mem']."'";
					
					$dbmuser=$obj->select($muser);
					if(count($dbmuser)>0){
					if($dbmuser[0]['gender']=='M' && $dbmuser[0]['photo']!='')
					{
						$pic="<img src='upload/".$dbmuser[0]['photo']."' height='50' width='50' class='ol-prfl-img' />";
					}
					else
					{
						$pic="<img src='images/male-user1.png' height='50' width='50' class='ol-prfl-img' />";
					}
					if($dbmuser[0]['gender']=='F' && $dbmuser[0]['photo']!='')
					{
						$pic1="<img src='upload/".$dbmuser[0]['photo']."' height='50' width='50' class='ol-prfl-img' />";
					}
					else
					{
						$pic1="<img src='images/female-user1.png' height='50' width='50' class='ol-prfl-img' />";
					}
					?>
                    <li id="<?php echo $messages[$lpcntrl]['to_mem']."_".$messages[$lpcntrl]['from_mem']; ?>" class="message <?php if($messages[$lpcntrl]['is_read']==0){ ?> unread <?php } ?>">
            	<a href="javascript:void(0);" id="lnk<?php echo $messages[$lpcntrl]['from_mem']; ?>">
					<div class="msgChatIn">
                        <?php if($dbmuser[0]['gender']=='F')
						{
							echo $pic1;
						}
						else
						{
							echo $pic;
						}
						?>
                        <div class="chatMsgCont clearfix">
                            <span class="chatMsgName" id="chantmsgname<?php echo $messages[$lpcntrl]['to_mem']."_".$messages[$lpcntrl]['from_mem']; ?>">
								<?php echo ucfirst($dbmuser[0]['name']).' ('.$dbmuser[0]['member_id'].')'; ?>
                            </span>
                             <?php $last_message = "select message,send_date from messages where (from_mem='".$dbmuser[0]['member_id']."' and to_mem='".$_SESSION['logged_user'][0]['member_id']."') or (from_mem='".$_SESSION['logged_user'][0]['member_id']."' and to_mem='".$dbmuser[0]['member_id']."') order by id desc";
							//echo $last_message;
								$db_last_msg = $obj->select($last_message);
							?>
                            <span class="chatMsgText"><?php echo $db_last_msg[0]['message']; ?></span>
                            <span class="chatMsgDate"><?php echo date('d M Y',strtotime($db_last_msg[0]['send_date'])); ?></span>
                        </div>
                    </div>
              	</a>
         	</li><?php
					}
					
            } } ?>
		</ul>
    </div>
    <div class="msgAll">             
    	 <?php
					if($messages[0]['to_mem']==$_SESSION['logged_user'][0]['member_id'])
					{
						$to=$messages[0]['from_mem'];
						$from=$messages[0]['to_mem'];
					}
					else
					{
						$to=$messages[0]['to_mem'];
						$from=$messages[0]['from_mem'];
					}
					
					
					//echo $to."</br>";
					//echo $from;
					$sql = "select name,member_id from members where member_id = '".$to."'";
					//echo $sql;
					$con_name = $obj->select($sql); ?>
					<span class="converse-span1" style="font-size:20px;color:#0075A7;"><?php echo ucwords($con_name[0]['name']).' ('.$con_name[0]['member_id'].')' ?></span>
      
                    <ul id="msgAll">
				
<?php 					
$conversation = "select * from messages where (to_mem = '".$to."' and from_mem='".$from."') or (to_mem = '".$from."' and from_mem='".$to."') order by id asc";
$dbconversation= $obj->select($conversation);
if(!empty($dbconversation))
{ 
		for($lpcntrl=0;$lpcntrl<count($dbconversation); $lpcntrl++){
			
			$muser = "SELECT members.*,member_photos.photo FROM members 
				LEFT JOIN member_photos ON members.id = member_photos.member_id
				WHERE
			 	members.member_id = '".$dbconversation[$lpcntrl]['from_mem']."'";	
				$dbmuser=$obj->select($muser);
				if($dbmuser[0]['gender']=='M' && $dbmuser[0]['photo']!='')
				{
					$pic="<img src='upload/".$dbmuser[0]['photo']."' height='25' width='25' class='ol-prfl-img' />";
				}
				else
				{
					$pic="<img src='images/male-user1.png' height='25' width='25' class='ol-prfl-img' />";
				}
				if($dbmuser[0]['gender']=='F' && $dbmuser[0]['photo']!='')
				{
					$pic1="<img src='upload/".$dbmuser[0]['photo']."' height='25' width='25' class='ol-prfl-img' />";
				}
				else
				{
					$pic1="<img src='images/female-user1.png' height='25' width='25' class='ol-prfl-img' />";
				}
				
				?>
           	
           
           
                <li>
      <div class="msgChatIn">
          <a href="#">
           <?php if($dbmuser[0]['gender']=='F')
			{
				echo $pic1;
			}
			else
			{
				echo $pic;
			}
			?>
         </a>
          <div class="chatMsgCont">
             <?php if($dbmuser[0]['member_id']==$_SESSION['logged_user'][0]['member_id']):?>
                 <a href="my_account.php">
			 <?php else: ?>
					 <a href="view_profile.php?id=<?php echo $dbmuser[0]['id'];?>">             
			 <?php endif;?>

              	<span class="chatMsgName"><?php echo  ucfirst($dbmuser[0]['name']); ?></span>
              </a>
			   <span class="chatMsgText"><?php echo $dbconversation[$lpcntrl]['message']; ?></span>
               <span class="chatMsgDate"><?php echo date('d M Y', strtotime($dbconversation[$lpcntrl]['send_date'])); ?></span>
          </div>
      </div>
  </li>
                <?php
		}
}?>
                    </ul>
                    <?php if($_SESSION['Member_status']=='Paid') { ?>
                      <div class="inputtxt msginput">
                        <input type="text" class="msg-send-text" name="Message" id="message_sent_<?php echo $from; ?>_<?php echo $to; ?>" value="">
                    <a class="msg_send_btn " id="message_sent_<?php echo $from; ?>_<?php echo $to; ?>" onclick="">click</a>
                    </div>
                    <?php } else { ?>
                   	  <div class="inputtxt msginput">
                        <input type="text" disabled="disabled" placeholder="Your membership is expire please upgrade" >
                      </div>
                    <?php } ?>
               </div>
 </div>
 
 <?php } else { ?>
<div class="content col-md-9 col-sm-12 col-xs-12">
<?php echo"<div style='font-size:16px;'>Sorry you have no messages</div>"; ?>
</div>
  <?php } $j++; ?>
<style>
.msginput input[type="text"]:disabled{background-color:#fff;}
.upload_pic
{
	float: left;
    margin-right: 20px;
    padding: 24px 13px;
}
.size
{
	height:181px;
	width:171px;
}
.back_btn
{
	text-align:right;
	padding-right:5px;	
}
.back_btn_size
{
	height:15px;
	padding-top:5px;
}
.profile_pic{
	/*height:150px;*/
	width:75px;
}
</style>
<script>
$(document).ready(function(e) {
    $('#msgChat li:first a').addClass('msgactive');
});
function check_msg(id)
{
	$('#txtMsg'+id).css('border','1px solid #ccc');
	error = 0;
	if($('#txtMsg'+id).val().trim()=='')
	{
		$('#txtMsg'+id).css('border','1px solid red');
		error =1;
	}
	if(error==1)
	{
		return false;
	}
	return true;
}
//on not-interest msg click
$('.not_int_msg_class').click(function() {
		 var ids = this.id;
		 var exploded = ids.split('_');
		 
		 jQuery.post("include/save_not_int.php", {
				to_member_id:exploded[2],
				msg_id:exploded[3]				
				},
				function(data, to_member_id,msg_id)
				{
					if(data == "1")
					{
						$('.cb-msgs').html("Member has been notified that you're not interested.");
						$('.cb-msgs').css('color','green');						
					}					
			});
		 
	});
	function doYouWantTo(id,data){
	 doIt=confirm('Are you sure you want to delete this message?');
	  if(doIt){
		  if(data == "del_frm_notint_mem")
		  {
			//window.location.href = 'my_account.php?id='+id+&flag=y';		
		  }
		  else
		  {
			  window.location.href = 'my_account.php?id='+id;		
		  }
	  }
	  else{ 
		  return false;
	  }
	  return true;
	}
</script> 
<script type="text/javascript" src="js/slimScroll.js"></script>
<script type="text/javascript">
   $(function(){
		$('#msgChat').slimscroll({
			width: '300px',
			height: '580px'
		  });
		  $('#msgAll').slimscroll({
			height: '510px'
		  })
    });
</script>
<script>
$('.message').click(function(){
	$('#msgAll').html('<img src="uploading.gif" style="margin-left: 50%;margin-top: 50%;"/>');
	var id=this.id;
	var ids=id.split('_');
	//alert(ids);
	var con_name = $('#chantmsgname'+id).text();
	//alert(ids);
	$.ajax({
			 type: "GET",		
			 url: 'get_message.php',
			 data :{From :ids[0],
					To:ids[1]
				   } ,      
			 success: function(data) {
				 //alert(data);
				 $('.converse-span1').html(con_name);
				 $('#msgAll').html(data);
				 $('#msgChat li a').removeClass('msgactive');
 				 $('#'+id).removeClass('unread');
				 $('#lnk'+ids[1]).addClass('msgactive');
				 $('.msg_send_btn').attr('id','message_sent_'+ids[0]+'_'+ids[1]);
				 $('.msg-send-text').attr('id','message_sent_'+ids[0]+'_'+ids[1]);
			}
		  });
});
</script>
<script>
$( ".msg-send-text" ).keyup(function(e) {
if(e.keyCode==13 && $.trim($('.msg-send-text').val()))
{
	$('.msg_send_btn').trigger('click');
}
});
</script>
<script>
$('.msg_send_btn').click(function(){
	if($.trim($('.msg-send-text').val())!='')
	{
		 var id = this.id;
	 var ids=id.split('_');
	 //alert(ids);
	 var message = document.getElementById(id).value;
    
	$.ajax({
			 type: "GET",		
			 url: 'ajax_sent_message.php',
			 data :{From :ids[2],
					To:ids[3],
					Msg:message,
				   } ,      
			 success: function(data) {
				 	 
					 $('#msgAll').append(data);
					 $('.msg-send-text').val("");
					 // $("p").css("color","red");
					 $("ul#msgAll").animate({scrollTop: $('ul#msgAll li:last').offset().top + 300000000});
					// $("ul#msgAll").scrollTop($('ul#msgAll').last().position().top() + $('ul#msgAll li').last().height());
					//$('.slimScrollBar').animate({"scrollTop": $('.slimScrollBar')[0].scrollHeight}, "slow");
					 //$(".ui-draggable").animate({scrollTop:  scrolled});
				 
			 }
		  });
	}
	
	
});
</script>
