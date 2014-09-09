<body> 
<div style="background-color: #000000; width: 100%;">
<div style="background-color: #000000; margin: 0 auto; width: 1000px; height: 14px; padding: 5px; color: #FFFFFF;">
<!--  <?php

if($user->data['user_id'] != ANONYMOUS)
{
echo"<span style='font-size: 11px; color: #CCCCCC;'>Hey There, " . $user->data['username'] . "! <span style='float: right;'>";

 $userid = $user->data['user_id'];
 $root = realpath($_SERVER["DOCUMENT_ROOT"]);
 include "$root/inc/database.inc.php";
 mysql_select_db('edge_programs',$db); 
 $rar = mysql_query("SELECT * FROM program_info WHERE presenter_1='$userid' OR presenter_2='$userid' OR presenter_3='$userid'") or die(mysql_error());
$info = mysql_num_rows($rar);
if($info || $user->data['group_id'] == 5 || $user->data['group_id'] == 4) {
echo"<a href='http://www.edgeradio.org.au/admin/welcome.php?id=$userid' style='color: #FF0000; text-decoration: none;'>Admin Panel</a> - ";
}

echo"<a href='http://www.edgeradio.org.au/soapbox/ucp.php' sid=" . $user->data['session_id'] . " style='color: #CCCCCC; text-decoration: none;'>User CP</a> - <a href='http://www.edgeradio.org.au/soapbox/ucp.php?mode=logout&amp;redirect=../index.php&amp;sid=" . $user->data['session_id'] . "' sid=" . $user->data['session_id'] . " style='color: #CCCCCC; text-decoration: none;'>Logout</a></span></span>";
}
else
{
echo'<form action="http://www.edgeradio.org.au/soapbox/ucp.php" method="post" enctype="multipart/form-data">
<input type="text" style="padding: 2px; margin: 0px 2px 0px 0px; border: 0px; font-size: 11px;" value="Username"  onclick="this.value=\'\';" onfocus="this.select()" onblur="this.value=!this.value?\'Username\':this.value;" name="username" class="user" size="14">
<input type="password" style="padding: 2px; margin: 0px 2px 0px 0px; border: 0px; font-size: 11px;" value="Password"  onclick="this.value=\'\';" onfocus="this.select()" onblur="this.value=!this.value?\'Password\':this.value;" name="password" class="pass" size="14">
<input type="hidden" name="redirect" value="http://www.edgeradio.org.au/">
<input type="submit" style="padding: 1px; margin: 0px 8px 0px 0px; border: 0px; font-size: 11px;" value="Login" name="login">
<INPUT TYPE="button" style="float: right; padding: 1px 4px 1px 4px; margin: 0px 0px 0px 0px; border: 0px; font-size: 11px;" value="Register For FREE!" onClick="parent.location=\'http://www.edgeradio.org.au/soapbox/ucp.php?mode=register\'">
</form>
';
}

?> !-->
</div>
</div> 

<div id="navbar_float">
  <div id="navbar_fluid">
    <div id="navbar">
    <div id="navbar_head">
    <div id="navbar_nowon">
	<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include "$root/inc/database.inc.php";
mysql_select_db("edge_programs",$db);

putenv("TZ=Australia/Hobart");
$h = date('H:i:s');
$d = date('l');

$presult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00') FROM program_special WHERE day_time='$d' AND start_time <= '$h' ORDER BY start_time DESC LIMIT 1");
$countp = mysql_num_rows($presult);
if($countp > 0) {

while ($infop = mysql_fetch_array($presult)) {

$titlecount = strlen($infop['title']);
if($infop['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $infop['sml_img']; }

$start = $infop['start'];
$finish = $infop['finish'];
$stream = $infop['streaming_enabled'];

echo'
<img class="show_image" src="' . $img . '">
<div class="show_title"><img src="http://www.edgeradio.org.au/images/on-air-now.png">';

if($stream != 'false'){
echo ' <a href="javascript:popUp(\'http://www.edgeradio.org.au/player/\')"><img style="border: 0px; margin: 0 0 2px 0;" src="http://www.edgeradio.org.au/images/listen-live-i.png"></a>';
}
echo '<br><a href="http://www.edgeradio.org.au/programs/">';
echo stripslashes($infop['title']);
echo'</a><br><i></i>' . $start . ' - ' . $finish . '</div>';
}


} else {

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l:%i%p') as start, DATE_FORMAT(end_time, '%l:%i%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00'), DATE_FORMAT(r_start_time, '%l%p') as r_start, DATE_FORMAT(r_end_time, '%l%p') as r_finish, REPLACE(r_end_time, '00:00:00', '24:00:00') FROM program_info WHERE (day_time='$d' AND start_time <= '$h') OR (r_day_time='$d' AND r_start_time <= '$h') ORDER BY IF(day_time='$d', start_time, r_start_time) DESC LIMIT 1");
$count = mysql_num_rows($inforesult);
while ($info = mysql_fetch_array($inforesult)) {
$titlecount = strlen($info['title']);
if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }

$day = date('l');

if($info['r_day_time'] == $day) {
$start = $info['r_start'];
$finish = $info['r_finish'];
} else {
$start = $info['start'];
$finish = $info['finish'];
}

echo'
<img class="show_image" src="' . $img . '">
<div class="show_title">
<img src="http://www.edgeradio.org.au/images/on-air-now.png"> <a href="javascript:popUp(\'http://www.edgeradio.org.au/player/\')"><img style="border: 0px; margin: 0 0 2px 0;" src="http://www.edgeradio.org.au/images/listen-live-i.png"></a><br>
<a href="http://www.edgeradio.org.au/program/'.str_replace(" ","-",$info['seotitle']).'/">'; echo stripslashes($info['title']); echo'</a><br><i></i>' . $start . ' - ' . $finish . '</div>';
}

if($count == 0) { echo'<img class="show_image" src="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg">
<div class="show_title">
<img src="http://www.edgeradio.org.au/images/on-air-now.png"> <a href="javascript:popUp(\'http://www.edgeradio.org.au/player/\')"><img style="margin: 0 0 2px 0;" src="http://www.edgeradio.org.au/images/listen-live-i.png"></a><br>
Edge Tunes<br><i>All Night</i></div>'; }

}
    
    ?>
	</div>
	<a href="http://www.edgeradio.org.au/"><img src="http://www.edgeradio.org.au/images/edge-logo.png"></a>
	</div>
    <div id="navbar_nav">
    <ul>
<li><a href="http://www.edgeradio.org.au/">Home</a></li>
<li><a href="http://www.edgeradio.org.au/programs/">Programs</a></li>
<li><a href="http://www.edgeradio.org.au/program/new-music-on-edge-radio/playlists/">Music</a></li>
<li><a href="http://www.edgeradio.org.au/blog/">Blog</a></li>
<li><a href="http://www.edgeradio.org.au/community/school-of-rock/">School of Rock</a></li>
<li><a href="http://www.edgeradio.org.au/community/">Community</a></li>
<li><a href="http://www.edgeradio.org.au/supporter/">Support Us</a></li>
<li class="last"><a href="http://www.edgeradio.org.au/about/staff/">About Edge</a></li>
</ul>
    </div>