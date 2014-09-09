
 <style>
 @font-face {
/* for other browsers */
font-family: 'bebas';
    src: url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.eot?#iefix') format('embedded-opentype'),
         url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.woff') format('woff'),
         url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.ttf') format('truetype'),
         url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.svg') format('svg');
}
 
a:link {
	color: #2B2B2B;
}
a:visited {
	color: #2B2B2B;
}
a:hover {
	color: #2B2B2B;
}

.title {

font-size:1.8em; 
font-family: "bebas", arial, serif;
}

  </style>
   <?php
    

  
  if($_GET['function'] != 1) {
  
  echo'<div style="padding: 10px;">';
  
  include'../inc/database.inc.php';
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
	<img style="-moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; width: 55px; height: 55px; margin-bottom: 10px;" src="' . $img . '"><br>
	<img style="margin-bottom: 5px;" src="player-nowplay.png"><br>
	<a style="font-size: 18px; color: #FFFFFF; font-weight: bold; text-decoration: none;" target="_blank" href="http://www.edgeradio.org.au/program/'.str_replace(" ","-",$info['seotitle']).'/"><b>' . stripslashes($info['title']) . '</b></a><br><span style="font-size: 11px; color: #C0C0C0;"><i>' . $info['start'] . ' - ' . $info['finish'] . '</i></span>';
}

if($count == 0) { echo'
	<img style="-moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; width: 55px; height: 55px; margin-bottom: 10px;" src="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg">
	<a style="font-size: 18px; color: #FFFFFF; font-weight: bold; text-decoration: none;" target="_blank" href="#"><b>Edge Tunes</b></a><br><span style="font-size: 11px; color: #C0C0C0;"><i>All Night</i></span>'; }
	
	
	
	
	
	
	} else {
	
	echo'<div style="padding: 0px;">';
	
	
	
echo'<span class="title">Now Playing</span><br>';

    $data = file_get_contents('http://edgeradio.org.au/BILBOARD.ASC');
       $data = str_replace("_", " ", $data);
       $data = str_replace("Playing", " ", $data);
       $data = ucwords(strtolower($data));
$data = explode("Song",$data,2);
echo '<span style="font-size: 16px; color: #000000; font-weight: bold;">'.$data[0].'</span>';

	echo'<br><br>';
	
	
include'../inc/database.inc.php';
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
	<span class="title">Now On Air:</span><br>
	<a style="font-size: 16px; color: #000000; font-weight: bold; text-decoration: none;" target="_blank" href="http://www.edgeradio.org.au/program/'.str_replace(" ","-",$info['seotitle']).'/"><b>' . stripslashes($info['title']) . '</b></a><br><span style="font-size: 11px; color: #808080;"><i>' . $info['start'] . ' - ' . $info['finish'] . '</i></span>';
}

if($count == 0) { echo'
<span class="title">Now Playing</span><br>
	<a style="font-size: 18px; color: #000000; font-weight: bold; text-decoration: none;" target="_blank" href="#"><b>Edge Tunes</b></a><br><span style="font-size: 11px; color: #808080;"><i>All Night</i></span>'; }
	

	echo'</div>';

      }
      ?>