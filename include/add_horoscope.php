<?php
session_start(); ?>
<form  method="post" id="form_sample_2" name="form_sample_3" class="form-horizontal" enctype="multipart/form-data">
              <div class="alert">
                <?php if (isset($erroruser)) { echo "<p class='message'>" .$erroruser. "</p>" ;} 
				 if (isset($errorblank)) { echo "<p class='message'>" .$errorblank. "</p>" ;} ?></div>
               
              <div class="control-group">
               
                <label class="control-label">From<span class="required">*</span></label>
                <div class="controls">
                  <input type="email" name="from_user" value="<?php  echo $_SESSION['logged_user'][0]['email_id'];  ?>" class="span6 m-wrap required"/>
                 
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">To<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="to_user" value="<?php echo $_GET['email'];  ?>" class="span6 m-wrap required"/>
                  <input type="hidden" name="member_id" id="member_id" value="<?php echo $_GET['id']; ?>" />
                  <input type="hidden" name="to_member_id" id="member_id" value="<?php echo $_GET['to_mem_id']; ?>" />
                  <input type="hidden" name="from_member_id" id="member_id" value="<?php echo $_SESSION['logged_user'][0]['member_id']; ?>" />
                </div>
              </div>
              </div>
              <div class="control-group">
                <label class="control-label">Message</label>
                <div class="controls">
                <textarea name="message" class="span6 m-wrap required">
                </textarea>
                </div>
              </div>
              
              <div class="form-actions">
                <input type="submit" name="send_msg" class="btn blue" value="SEND">
               </div>
            </form>