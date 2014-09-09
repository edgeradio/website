<?php
define('IN_PHPBB', true);
$phpbb_root_path = '/home/edge/public_html/soapbox/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('ucp');

if($finishreg == 'true') {
require($phpbb_root_path .'includes/functions_user.php'); 
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edge Radio 99.3FM <?php if($showtitle) { echo'- '.$showtitle.''; } elseif($pagetitle) { echo'- '.$pagetitle; } else { echo'- Independent Youth Radio'; } ?></title>
<?php
if ($_SERVER["REQUEST_URI"] == '/swag/') { ?>
<?php } elseif ($_SERVER["REQUEST_URI"] == '/program.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/music-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/interview-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/swag/index.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/win-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/shop/') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/shop-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/shop/index.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/shop-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/shop/checkout.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/shop-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/community/') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/gig-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/community/new-gig/') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/gig-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/community/new-gig') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/gig-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/community/new-gig/index.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/gig-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/community/index.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/gig-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/community/school-of-rock/index.php') { ?>
<link rel="image_src" href="http://www.edgeradio.org.au/images/sorfb.png" />
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/sor-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/community/school-of-rock/register/finish.php') { ?>
<link rel="image_src" href="http://www.edgeradio.org.au/images/sorfb.png" />
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/sor-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/community/school-of-rock/register/index.php') { ?>
<link rel="image_src" href="http://www.edgeradio.org.au/images/sorfb.png" />
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/sor-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/programs/indie-tas/index.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/indie-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/programs/indie-tas/') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/indie-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/programs/interviews/index.php') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/interview-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/programs/interviews/') { ?>
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/interview-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/community/school-of-rock/register/') { ?>
<link rel="image_src" href="http://www.edgeradio.org.au/images/sorfb.png" />
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/sor-style.css" />
<?php } elseif ($_SERVER["REQUEST_URI"] == '/community/school-of-rock/') { ?>
<link rel="image_src" href="http://www.edgeradio.org.au/images/sorfb.png" />
<link rel="stylesheet" type="text/css" href="http://www.edgeradio.org.au/templates/sor-style.css" />
<?php } else { ?>
<link rel="stylesheet" type="text/css" href="/templates/style_all.css" />
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

<link rel="image_src" href="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg" />

<script type="text/javascript" src="http://www.edgeradio.org.au/java/easySlider1.5.js"></script>

<link rel="shortcut icon" href="http://www.edgeradio.org.au/favicon.ico">

<script language="JavaScript">
<!-- Listen Live Box By:  James Davey -->

function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=500');");
}
</script>



</head>




