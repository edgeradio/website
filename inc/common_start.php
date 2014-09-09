<?php

header('Location: http://www.edgeradio.org.au/');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edge Radio - 99.3fm in Hobart<?php if($showtitle) { echo' - '.$showtitle.''; } ?></title>
<?php
if ($_SERVER["REQUEST_URI"] == '/radiothon/') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/css/radiothon_style.css" />
<?php }
elseif ($_SERVER["REQUEST_URI"] == '/radiothon/presenters/') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/css/radiothon_style.css" />
<?php }
elseif ($_SERVER["REQUEST_URI"] == '/facethemusic.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/css/radiothon_style.css" />
<?php } else { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/style_all.css" />
<?php } ?>
<!--[if lt IE 6]>
	<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/css/style_ie5.css" />
<![endif]-->
<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/css/style_ie6.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/css/pop_style.css" />
<?php if ($_SERVER["REQUEST_URI"] == '/programs/') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/css/schedule.css" />
<?php }  
if ($_SERVER["REQUEST_URI"] == '/programs/program-grid/') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/css/schedule.css" />
<?php } 
if ($_SERVER["REQUEST_URI"] == '/arts_featured.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/css/artist_images.css" />
<?php }
if ($_SERVER["REQUEST_URI"] == '/arts_featured_april.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/css/artist_images.css" />
<?php } 
if ($_SERVER["REQUEST_URI"] == '/arts_featured_march.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/css/artist_images.css" />
<?php } ?>
 <script type="text/javascript" src="http://www.edgeradio.org.au/include/jquery.js"></script>
<script type="text/javascript" src="http://www.edgeradio.org.au/include/jcarousellite.js"></script>
<script type="text/javascript" src="http://www.edgeradio.org.au/include/tooltips.js"></script>
<script type="text/javascript" src="http://www.edgeradio.org.au/include/fade-plugin.js"></script>
<script type="text/javascript" src="http://airnet.org.au/lib/iframe/auto.js"></script> 


<script type="text/javascript" src="http://www.edgeradio.org.au/java/easySlider1.5.js"></script>

<link rel="shortcut icon" href="http://www.edgeradio.org.au/favicon.ico">

<script language="JavaScript">
<!-- Listen Live Box By:  James Davey -->

function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=400');");
}
</script>



</head>




