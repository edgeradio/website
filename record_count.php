 <?php
    

echo'
 <style>
a:link {
	color: #2B2B2B;
}
a:visited {
	color: #2B2B2B;
}
a:hover {
	color: #2B2B2B;
}
  </style>';
  
  
  
  include'inc/database.inc.php';
mysql_select_db("edge_programs",$db);

putenv("TZ=Australia/Hobart");
$h = date('H:i:s');
$d = date('l');

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00') FROM program_info WHERE day_time='$d' AND start_time <= '$h'ORDER BY start_time DESC LIMIT 1");
$count = mysql_num_rows($inforesult);
while ($info = mysql_fetch_array($inforesult)) {
$titlecount = strlen($info['title']);
if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }
echo'
<table style="width: 100%; height: 80px;" cellpadding="10">
<tr>
	<td style="vertical-align: top; width: 250px;">
	<img style="width: 55px; height: 55px; margin: 2px 2px 0px 0px; float: right;" src="' . $img . '">
	<div style="font-size: 11px; margin: 24px 0px 0px 5px;"><a style="text-decoration: none;" target="_blank" href="http://www.edgeradio.org.au/programs/'.$info['day_time'].'/'.str_replace(" ","-",$info['seotitle']).'/"><b>'; if($titlecount > 25) { echo'<marquee style="width: 180px;">'; echo stripslashes($info['title']); echo'</marquee>'; } else { echo stripslashes($info['title']); } echo'</b></a><br><i>' . $info['start'] . ' - ' . $info['finish'] . '</i></div>
	</td>';
}

if($count == 0) { echo'<table style="width: 100%; height: 88px;" cellpadding="10">
<tr>
	<td style="vertical-align: top; width: 250px;">
	<img style="width: 55px; height: 55px; margin: 2px 2px 0px 0px; float: right;" src="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg">
	<div style="font-size: 11px; margin: 24px 0px 0px 5px;"><b>Edge Tunes</b><br><i>All Night</i></div>
	</td>'; }



$curesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish FROM program_info WHERE day_time='$d' AND start_time > '$h' ORDER BY start_time ASC LIMIT 0,1");
$coua = mysql_num_rows($curesult);
while ($ina = mysql_fetch_array($curesult)) {
 $next_titlecount = strlen($ina['title']);
 if($ina['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $ina['sml_img']; }
echo'
<td style="vertical-align: top; width: 220px;">
<img style="width: 55px; height: 55px; margin: 2px 2px 0px 0px; float: right;" src="' . $img . '">
	<div style="font-size: 11px; margin: 24px 0px 0px 5px;"><a style="text-decoration: none;" target="_blank" href="http://www.edgeradio.org.au/programs/'.$ina['day_time'].'/'.str_replace(" ","-",$ina['seotitle']).'/"><b>'; if($next_titlecount > 25) { echo'<marquee style="width: 130px;">'; echo stripslashes($ina['title']); echo'</marquee>'; } else { echo stripslashes($ina['title']); } echo'</b></a><br><i>' . $ina['start'] . ' - ' . $ina['finish'] . '</i></div>
	</td>
</tr>
</table>
';
}

if($coua == 0) { echo'<td style="vertical-align: top; width: 220px;">
<img style="width: 55px; height: 55px; margin: 2px 2px 0px 0px; float: right;" src="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg">
	<div style="font-size: 11px; margin: 24px 0px 0px 5px;"><b>Edge Tunes</b><br><i>All Night</i></div>
	</td>
</tr>
</table>'; }
      
      ?>