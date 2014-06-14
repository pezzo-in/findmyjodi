<?php
if($_POST['radio3'] == '1'){ 
echo "<script>window.location='success_story.php#success_story-2' </script>";	
}else {
echo "<script>alert('delete');</script>";
echo "<script>window.location='my_account.php'</script>";
 } ?>