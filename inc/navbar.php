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

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00')  FROM program_info WHERE day_time='$d' AND start_time <= '$h' ORDER BY start_time DESC LIMIT 1");
$count = mysql_num_rows($inforesult);
while ($info = mysql_fetch_array($inforesult)) {
$titlecount = strlen($info['title']);
if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }

echo'
<img class="show_image" src="' . $img . '">
<div class="show_title">
<img src="http://www.edgeradio.org.au/images/on-air-now.png"> <a href="javascript:popUp(\'http://www.edgeradio.org.au/listen-popup.php\')"><img style="border: 0px; margin: 0 0 2px 0;" src="http://www.edgeradio.org.au/images/listen-live-i.png"></a><br>
<a href="http://www.edgeradio.org.au/programs/'.$info['day_time'].'/'.str_replace(" ","-",$info['seotitle']).'/">'; echo stripslashes($info['title']); echo'</a><br><i></i>' . $info['start'] . ' - ' . $info['finish'] . '</div>';
}

if($count == 0) { echo'<img class="show_image" src="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg">
<div class="show_title">
<img src="../images/on-air-now.png"> <a href="javascript:popUp(\'http://www.edgeradio.org.au/listen-popup.php\')"><img style="margin: 0 0 2px 0;" src="../images/listen-live-i.png"></a><br>
Edge Tunes<br><i>All Night</i></div>'; }
    
    ?>
	</div>
	<a href="http://www.edgeradio.org.au/"><img src="http://www.edgeradio.org.au/images/edge-logo.png"></a>
	</div>
    <div id="navbar_nav">
    <ul>
<li><a href="http://www.edgeradio.org.au/">Home</a></li>
<li><a href="http://www.edgeradio.org.au/programs/">Programs</a></li>
<li><a href="http://www.edgeradio.org.au/music/">Music</a></li>
<li><a href="http://www.edgeradio.org.au/blog/">Edge News</a></li>
<li><a href="http://www.edgeradio.org.au/community/">Community</a></li>
<li><a href="http://www.edgeradio.org.au/supporter/">Support Us</a></li>
<li class="last"><a href="http://www.edgeradio.org.au/about/">About Edge</a></li>
</ul>
    </div>
    </div>
  </div>
</div>
