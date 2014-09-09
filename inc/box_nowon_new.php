<div class="roundednew" style="height: 315px; background-image: url(http://www.edgeradio.org.au/images/onairback.png);">
<a href="javascript:popUp('http://www.edgeradio.org.au/listen-popup.php')"><img border="0" style="margin: 12px 0px 0px 100px;" src="http://www.edgeradio.org.au/images/listen-live-i.png"></a>
<?php

include'database.inc.php';
mysql_select_db("edge_programs",$db);

putenv("TZ=Australia/Hobart");
$h = date('H:i:s');
$d = date('l');

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00')  FROM program_info WHERE day_time='$d' AND start_time <= '$h' ORDER BY start_time DESC LIMIT 1");
$count = mysql_num_rows($inforesult);
while ($info = mysql_fetch_array($inforesult)) {
$titlecount = strlen($info['title']);
if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }

echo'<center><a style="color: #000000; text-decoration: none;" href="http://www.edgeradio.org.au/programs/'.$info['day_time'].'/'.str_replace(" ","-",$info['seotitle']).'/"><img style="margin-top: 5px; width: 163px; height: 163px;" src="' . $img . '"></a></center>
<div style="padding-left: 5px; padding-bottom: 5px; margin-top: 5px; font-size: 12px;"><a style="color: #000000; text-decoration: none;" href="http://www.edgeradio.org.au/programs/'.$info['day_time'].'/'.str_replace(" ","-",$info['seotitle']).'/"><b>'; if($titlecount > 25) { echo'<marquee>'; echo stripslashes($info['title']); echo'</marquee>'; } else { echo stripslashes($info['title']); } echo'</b></a><br><i>' . $info['start'] . ' - ' . $info['finish'] . '</i></div>';
}

if($count == 0) { echo'<center><img style="margin-top: 5px; width: 163px; height: 163px;" src="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg"></center>
<div style="padding-left: 5px; padding-bottom: 5px; margin-top: 5px; font-size: 12px;"><b>Edge Tunes</b><br><i>All Night</i></div>'; }



$curesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish FROM program_info WHERE day_time='$d' AND start_time > '$h' ORDER BY start_time ASC LIMIT 0,1");
$coua = mysql_num_rows($curesult);
while ($ina = mysql_fetch_array($curesult)) {
 $next_titlecount = strlen($ina['title']);
echo'<div style="padding-left: 5px; margin-top: 40px;"><a style="color: #000000; text-decoration: none;" href="http://www.edgeradio.org.au/programs/'.$ina['day_time'].'/'.str_replace(" ","-",$ina['seotitle']).'/"><b>'; if($next_titlecount > 25) { echo'<marquee>'; echo stripslashes($ina['title']); echo'</marquee>'; } else { echo stripslashes($ina['title']); } echo'</b></a><br><i>' . $ina['start'] . ' - ' . $ina['finish'] . '</i></div>
';
}

if($coua == 0) { echo'<div style="padding-left: 5px; margin-top: 40px;"><b>Edge Tunes</b><br><i>All Night</i></div>
'; }


?>

</div>
