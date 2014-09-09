<?php
/*
* home.php
* Description: example file for displaying latest posts and topics
* by battye (for phpBB.com MOD Team)
* September 29, 2009
*/

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../soapbox/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/bbcode.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('viewforum'); 

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edge Studio Panel</title>
<link rel="shortcut icon" href="http://www.edgeradio.org.au/favicon.ico">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="jquery.countdown.js"></script>
<script type="text/javascript">
$(document).ready(function() { $("#load_program").load("record_count.php"); var refreshId = setInterval(function() { $("#load_program").load('record_count.php?randval='+ Math.random()); }, 9000); });
</script>
<style>
html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
}
/*Opera Fix*/
body:before {
    content:"";
    height:100%;
    float:left;
    width:0;
    margin-top:-32767px;/* negate effect of float*/
}
#outer {
    width:100%;
    height:100%;
    text-align:left;
    clear:both;
    display:table;
    position:relative;
    z-index:1;
}
#content {
    vertical-align:middle;
    display:table-cell;
}
#content .inner {
    background-image: url(images/panel-welcome.png);
    padding:0 10px;
    width: 353px;
    height: 295px;
    margin: 0 auto;
}
</style>
</head>
<body style="background-color: #EDEDED;">

<div id="outer">
    <div id="content">
        <div class="inner">
            <?php 
            
            $database = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db("edge_programs",$database);

putenv("TZ=Australia/Hobart");
$h = date('H:i:s');
$d = date('l');

            $inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, DATE_FORMAT(end_time, '%k') as hourfinish FROM program_info WHERE day_time='$d' AND start_time <= '$h' ORDER BY start_time DESC LIMIT 1");
while ($info = mysql_fetch_array($inforesult)) {
            if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }
            ?>
            <div style="padding: 90px 0 0 70px;"><img style="width: 80px; height: 80px; -moz-border-radius:10px;
-webkit-border-radius:10px;
border-radius:10px; float: left; margin-right: 10px;" src="<?php echo $img; ?>">
<div style="color: #FFF; font-family: arial; font-size: 12px;"><img style="padding-bottom: 10px;" src="images/presenter.png"><br>
Log In As <span style="color: #FF0000;"><?php echo stripslashes($info['title']); ?></span></div>
</div>
<?php } ?>

<div style="clear: both; padding: 20px 0 0 70px;"><img style="width: 80px; height: 80px; -moz-border-radius:10px;
-webkit-border-radius:10px;
border-radius:10px; float: left; margin-right: 10px;" src="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg">
<div style="color: #FFF; font-family: arial; font-size: 12px;"><img style="padding-bottom: 10px;" src="images/admin.png"><br>
Log In As <span style="color: #FF0000;">An Administrator</span></div>
</div>
            
            
        </div>
    </div>
</div>
</body>
</html>



