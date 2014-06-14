<?php

$error=array();
define('DIR_APP', str_replace('\'', '/', realpath(dirname(__FILE__))) . '/');
define('DIR_SMOOTH_CHAT', str_replace('\'', '/', realpath(DIR_APP . '../')) . '/');

if (phpversion() < '4.0') {
			$error['warning'] = 'Warning: You need to use PHP4 or above for Smooth AJAX Chat to work!';
		}
	
		if (ini_get('session.auto_start')) {
			$error['warning'] = 'Warning: Smooth AJAX Chat will not work with session.auto_start enabled!';
		}

		if (!extension_loaded('mysql')) {
			$error['warning'] = 'Warning: MySQL extension needs to be loaded for Smooth AJAX Chat to work!';
		}
	
		if (!is_writable(DIR_SMOOTH_CHAT . 'include/vars.php')) {
			$error['warning'] = 'Warning: vars.php needs to be writable for Smooth AJAX Chat to be installed!';
		}
		
		if (!is_writable(DIR_SMOOTH_CHAT . 'include/config.php')) {
			$error['warning'] = 'Warning: config.php needs to be writable for Smooth AJAX Chat to be installed!';
		}
		
		if (!is_writable(DIR_SMOOTH_CHAT . 'js/vars.js')) {
			$error['warning'] = 'Warning: vars.js needs to be writable for Smooth AJAX Chat to work properly !';
		}

?>

<div id="gCtr">
<h1 style="background: url('image/installation.png') no-repeat;">Step 2 - Pre-Installation</h1>
<div style="width: 100%; display: inline-block;">
  <div style="float: left; width: 569px;">
    <?php if (isset($error['warning'])) { ?>
    <div id="warning" class="warning"><?php echo $error['warning']; ?></div>
    <?php } ?>
      <p>1. Please configure your PHP settings to match requirements listed below.</p>
      <div class="inner">
        <table width="100%">
          <tr>
            <th width="35%" align="left"><b>PHP Settings</b></th>
            <th width="25%" align="left"><b>Current Settings</b></th>
            <th width="25%" align="left"><b>Required Settings</b></th>
            <th width="15%" align="center"><b>Status</b></th>
          </tr>
          <tr>
            <td>PHP Version:</td>
            <td><?php echo phpversion(); ?></td>
            <td>4.0+</td>
            <td align="center"><?php echo (phpversion() >= '4.0') ? '<img src="image/good.png" alt="Good" />' : '<img src="image/bad.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>Register Globals:</td>
            <td><?php echo (ini_get('register_globals')) ? 'On' : 'Off'; ?></td>
            <td>Off</td>
            <td align="center"><?php echo (!ini_get('register_globals')) ? '<img src="image/good.png" alt="Good" />' : '<img src="image/bad.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>Session Auto Start:</td>
            <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
            <td>Off</td>
            <td align="center"><?php echo (!ini_get('session_auto_start')) ? '<img src="image/good.png" alt="Good" />' : '<img src="image/bad.png" alt="Bad" />'; ?></td>
          </tr>
        </table>
      </div>
      <p>2. Please make sure the extensions listed below are installed.</p>
      <div class="inner">
        <table width="100%">
          <tr>
            <th width="35%" align="left"><b>Extension</b></th>
            <th width="25%" align="left"><b>Current Settings</b></th>
            <th width="25%" align="left"><b>Required Settings</b></th>
            <th width="15%" align="center"><b>Status</b></th>
          </tr>
          <tr>
            <td>MySQL:</td>
            <td><?php echo extension_loaded('mysql') ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td align="center"><?php echo extension_loaded('mysql') ? '<img src="image/good.png" alt="Good" />' : '<img src="image/bad.png" alt="Bad" />'; ?></td>
          </tr>
        </table>
      </div>
      <p>3. Please make sure you have set the correct permissions on the files list below.</p>
      <div class="inner">
        <table width="100%">
          <tr>
            <th align="left"><b>Files</b></th>
            <th width="15%" align="left"><b>Status</b></th>
          </tr>
          <tr>
            <td><?php echo DIR_SMOOTH_CHAT . 'include/vars.php'; ?></td>
            <td><?php echo is_writable(DIR_SMOOTH_CHAT . 'include/vars.php') ? '<span class="good">Writable</span>' : '<span class="bad">Unwritable</span>'; ?></td>
          </tr>
           <tr>
            <td><?php echo DIR_SMOOTH_CHAT . 'include/config.php'; ?></td>
            <td><?php echo is_writable(DIR_SMOOTH_CHAT . 'include/config.php') ? '<span class="good">Writable</span>' : '<span class="bad">Unwritable</span>'; ?></td>
          </tr>
                    <tr>
            <td><?php echo DIR_SMOOTH_CHAT . 'js/vars.js'; ?></td>
            <td><?php echo is_writable(DIR_SMOOTH_CHAT . 'js/vars.js') ? '<span class="good">Writable</span>' : '<span class="bad">Unwritable</span>'; ?></td>
          </tr>
        </table>
      </div>
      <div style="text-align: right;"><a id="stp2" class="button"></a></div>
  </div>
  <div id="sidebar">
    <ul>
      <li><del>Welcome</del></li>
      <li><b>Pre-Installation</b></li>
      <li>Configuration</li>
      <li>Finished</li>
    </ul>
  </div>
</div>
</div>