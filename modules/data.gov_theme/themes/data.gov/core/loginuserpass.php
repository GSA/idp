<?php
// get idm config variables
$idm_login_link = $this->configuration->getValue('idm_login_link', '#');
$idm_register_page_link = $this->configuration->getValue('idm_register_page_link', '#');
$idm_password_reset_link = $this->configuration->getValue('idm_password_reset_link', '#');

$this->data['header'] = $this->t('{login:user_pass_header}');

if (strlen($this->data['username']) > 0) {
	$this->data['autofocus'] = 'password';
} else {
	$this->data['autofocus'] = 'username';
}
$this->includeAtTemplateBase('includes/header.php');

?>
<?php
if ($this->data['errorcode'] !== NULL) {
?>

<div style="border-left: 1px solid #e8e8e8; border-bottom: 1px solid #e8e8e8; background: #f5f5f5"> <img src="/<?php echo $this->data['baseurlpath']; ?>resources/icons/experience/gtk-dialog-error.48x48.png" class="float-l" style="margin: 15px " />
  <h2><?php echo $this->t('{login:error_header}'); ?></h2>
  <p><b><?php echo $this->t('{errors:title_' . $this->data['errorcode'] . '}'); ?></b></p>
  <p><?php echo $this->t('{errors:descr_' . $this->data['errorcode'] . '}'); ?></p>
</div>
<?php
}
?>
<div class="content-tabs block" id="content-tabs">
  <div class="content-tabs-inner gutter" id="content-tabs-inner">
    <ul class="tabs primary">
      <li><a href="<?php print $idm_register_page_link ?>">Create new account</a></li>
      <li class="active"><a class="active" href="<?php print $idm_login_link ?>">Log in</a></li>
      <li><a href="<?php print $idm_password_reset_link ?>">Request new password</a></li>
    </ul>
  </div>
  <!-- /content-tabs-inner --> 
</div>
<!-- /content-tabs --> 
<br clear="all"  />
<!---<h2 style="break: both"><?php // echo $this->t('{login:user_pass_header}'); ?></h2>
<p><?php // echo $this->t('{login:user_pass_text}'); ?></p> -->
<form action="?" method="post" name="f">
  <div>
  <div class="form-item form-type-textfield form-item-name">
    <label for="edit-name">E-mail <span title="This field is required." class="form-required">*</span></label>
    <?php
if ($this->data['forceUsername']) {
	echo '<strong style="font-size: medium">' . htmlspecialchars($this->data['username']) . '</strong>';
} else {
	echo '<input type="text" id="username" tabindex="1" name="username" value="' . htmlspecialchars($this->data['username']) . '" />';
}
?>
    <div class="description">Enter your e-mail address.</div>
  </div>
  <?php
if ($this->data['rememberUsernameEnabled']) {
	$rowspan = 1;
} elseif (array_key_exists('organizations', $this->data)) {
	$rowspan = 3;
} else {
	$rowspan = 2;
}
?>
  
<div class="form-item form-type-password form-item-pass">
<label for="edit-pass"> <?php echo $this->t('{login:password}'); ?> <span title="This field is required." class="form-required">*</span></label>
    <input id="password" type="password" tabindex="2" name="password" />
    <div class="description">Enter the password that accompanies your e-mail.</div>
    </div>
    <?php
// Move submit button to next row if remember checkbox enabled
if ($this->data['rememberUsernameEnabled']) {
	$rowspan = (array_key_exists('organizations', $this->data) ? 2 : 1);
?>
    <input type="submit" tabindex="5" value="<?php echo $this->t('{login:login_button}'); ?>" />
    <?php
}
?>
 <div id="edit-actions" class="form-actions form-wrapper">
<?php
if ($this->data['rememberUsernameEnabled']) {
	echo str_repeat("\t", 4);
	echo '<input type="checkbox" id="remember_username" tabindex="4" name="remember_username" value="Yes" ';
	echo ($this->data['rememberUsernameChecked'] ? 'checked="Yes" /> ' : '/> ');
	echo $this->t('{login:remember_username}');
} else {
	$text = $this->t('{login:login_button}');
	echo str_repeat("\t", 4);
	echo "<input type=\"submit\" tabindex=\"4\" value=\"{$text}\" />";
}
?>
 </div>
  </div>
  <?php
if (array_key_exists('organizations', $this->data)) {
?>
 <?php echo $this->t('{login:organization}'); ?>
<select name="organization" tabindex="3">
        <?php
if (array_key_exists('selectedOrg', $this->data)) {
	$selectedOrg = $this->data['selectedOrg'];
} else {
	$selectedOrg = NULL;
}

foreach ($this->data['organizations'] as $orgId => $orgDesc) {
	if (is_array($orgDesc)) {
		$orgDesc = $this->t($orgDesc);
	}

	if ($orgId === $selectedOrg) {
		$selected = 'selected="selected" ';
	} else {
		$selected = '';
	}

	echo '<option ' . $selected . 'value="' . htmlspecialchars($orgId) . '">' . htmlspecialchars($orgDesc) . '</option>';
}
?>
      </select>
  <?php
}
?>

  <?php
foreach ($this->data['stateparams'] as $name => $value) {
	echo('<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '" />');
}
?>
</form>
<?php

if(!empty($this->data['links'])) {
	echo '<ul class="links" style="margin-top: 2em">';
	foreach($this->data['links'] AS $l) {
		echo '<li><a href="' . htmlspecialchars($l['href']) . '">' . htmlspecialchars($this->t($l['text'])) . '</a></li>';
	}
	echo '</ul>';
}
?>
<br clear="all"  />
<?php
//echo('<h2>' . $this->t('{login:help_header}') . '</h2>');
//echo('<p>' . $this->t('{login:help_text}') . '</p>');

 $this->includeAtTemplateBase('includes/footer.php');
?>
