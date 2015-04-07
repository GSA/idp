<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$home_link = $this->configuration->getValue('home_link', '#');


/**
 * Support the htmlinject hook, which allows modules to change header, pre and post body on all pages.
 */
$this->data['htmlinject'] = array(
	'htmlContentPre' => array(),
	'htmlContentPost' => array(),
	'htmlContentHead' => array(),
);


$jquery = array();
if (array_key_exists('jquery', $this->data)) $jquery = $this->data['jquery'];

if (array_key_exists('pageid', $this->data)) {
	$hookinfo = array(
		'pre' => &$this->data['htmlinject']['htmlContentPre'], 
		'post' => &$this->data['htmlinject']['htmlContentPost'], 
		'head' => &$this->data['htmlinject']['htmlContentHead'], 
		'jquery' => &$jquery, 
		'page' => $this->data['pageid']
	);
		
	SimpleSAML_Module::callHooks('htmlinject', $hookinfo);	
}
// - o - o - o - o - o - o - o - o - o - o - o - o -

/**
 * Do not allow to frame simpleSAMLphp pages from another location.
 * This prevents clickjacking attacks in modern browsers.
 *
 * If you don't want any framing at all you can even change this to
 * 'DENY', or comment it out if you actually want to allow foreign
 * sites to put simpleSAMLphp in a frame. The latter is however
 * probably not a good security practice.
 */
header('X-Frame-Options: SAMEORIGIN');

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


<title>
<?php
if(array_key_exists('header', $this->data)) {
	echo $this->data['header'];
} else {
	echo 'simpleSAMLphp';
}
?>
</title>
    <link href='//fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="/<?php echo $this->data['baseurlpath']; ?>resources/data.gov/default.css" />
<link rel="icon" type="image/icon" href="/<?php echo $this->data['baseurlpath']; ?>resources/data.gov/favicon.ico" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="/<?php echo $this->data['baseurlpath']; ?>resources/jquery-ui.js"></script>
    <script type="text/javascript" src="/<?php echo $this->data['baseurlpath']; ?>resources/script.js"></script>

<?php

if(!empty($jquery)) {
	$version = '1.5';
	if (array_key_exists('version', $jquery))
		$version = $jquery['version'];
		
	if ($version == '1.5') {
		if (isset($jquery['core']) && $jquery['core'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery.js"></script>' . "\n");
	
		if (isset($jquery['ui']) && $jquery['ui'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery-ui.js"></script>' . "\n");
	
		if (isset($jquery['css']) && $jquery['css'])
			echo('<link rel="stylesheet" media="screen" type="text/css" href="/' . $this->data['baseurlpath'] . 
				'resources/uitheme/jquery-ui-themeroller.css" />' . "\n");	
			
	} else if ($version == '1.6') {
		if (isset($jquery['core']) && $jquery['core'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery-16.js"></script>' . "\n");
	
		if (isset($jquery['ui']) && $jquery['ui'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery-ui-16.js"></script>' . "\n");
	
		if (isset($jquery['css']) && $jquery['css'])
			echo('<link rel="stylesheet" media="screen" type="text/css" href="/' . $this->data['baseurlpath'] . 
				'resources/uitheme16/ui.all.css" />' . "\n");	
	}
}

if(!empty($this->data['htmlinject']['htmlContentHead'])) {
	foreach($this->data['htmlinject']['htmlContentHead'] AS $c) {
		echo $c;
	}
}




if ($this->isLanguageRTL()) {
?>
<link rel="stylesheet" type="text/css" href="/<?php echo $this->data['baseurlpath']; ?>resources/default-rtl.css" />
<?php	
}
?>
<meta name="robots" content="noindex, nofollow" />
<?php	
if(array_key_exists('head', $this->data)) {
	echo '<!-- head -->' . $this->data['head'] . '<!-- /head -->';
}
?>
</head>
<?php
$onLoad = '';
if(array_key_exists('autofocus', $this->data)) {
	$onLoad .= 'SimpleSAML_focus(\'' . $this->data['autofocus'] . '\');';
}
if (isset($this->data['onLoad'])) {
	$onLoad .= $this->data['onLoad']; 
}

if($onLoad !== '') {
	$onLoad = ' onload="' . $onLoad . '"';
}
?>
<body<?php echo $onLoad; ?>>


<div id="wrap">
<div class="header-group region grid12-12" id="header-group">
  <div class="header-group-inner inner clearfix" id="header-group-inner">
    <div class="block block-blockify logo grid12-6 first  odd" id="block-blockify-blockify-logo">
      <div class="gutter inner clearfix">
        <div class="content clearfix"> <a title="Return to the Data.gov home page" rel="home" id="logo" href="<?php echo $home_link; ?>"><img alt="Data.gov logo" 
        src="/<?php echo $this->data['baseurlpath']; ?>resources/data.gov/images/logo.png"></a> </div>
      </div>
   
    </div>


  </div>

</div>

<div id="header">
<h1 class="title gutter"><a style="text-decoration: none; color: white" href="/<?php echo $this->data['baseurlpath']; ?>">
User Account
    </a></h1>
</div>

<div id="content">
<?php

if(!empty($this->data['htmlinject']['htmlContentPre'])) {
	foreach($this->data['htmlinject']['htmlContentPre'] AS $c) {
		echo $c;
	}
}

