	<?php
$db = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db("edge_programs");

putenv("TZ=Australia/Hobart");
$hour = date('H:i:s');
$day = date('l');


$presult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00') FROM program_special WHERE day_time='$day' AND start_time <= '$hour' ORDER BY start_time DESC LIMIT 1");
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

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00'), DATE_FORMAT(r_start_time, '%l%p') as r_start, DATE_FORMAT(r_end_time, '%l%p') as r_finish, REPLACE(r_end_time, '00:00:00', '24:00:00') FROM program_info WHERE (day_time='$day' AND start_time <= '$hour') OR (r_day_time='$day' AND r_start_time <= '$hour') ORDER BY IF(day_time='$day', start_time, r_start_time) DESC LIMIT 1");
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
<img src="../images/on-air-now.png"> <a href="javascript:popUp(\'http://www.edgeradio.org.au/player/\')"><img style="border: 0px; margin: 0 0 2px 0;" src="../images/listen-live-i.png"></a><br>
<a href="http://www.edgeradio.org.au/program/'.str_replace(" ","-",$info['seotitle']).'/">'; echo stripslashes($info['title']); echo'</a><br><i></i>' . $start . ' - ' . $finish . '</div>';
}

if($count == 0) { echo'<img class="show_image" src="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg">
<div class="show_title">
<img src="../images/on-air-now.png"> <a href="javascript:popUp(\'http://www.edgeradio.org.au/player/\')"><img style="margin: 0 0 2px 0;" src="../images/listen-live-i.png"></a><br>
Edge Tunes<br><i>All Night</i></div>'; }


}
    
    ?>