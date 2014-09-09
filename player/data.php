
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
    

echo'<span style="font-size: 18px; color: #FFFFFF; font-family: \'bebas\', arial, serif;">Now Playing: ';

    $data = file_get_contents('http://edgeradio.org.au/BILBOARD.ASC');
       $data = str_replace("_", " ", $data);
       $data = str_replace("Playing", " - ", $data);
       $data = ucwords(strtolower($data));
$data = explode("Song",$data,2);
echo ''.$data[0].'</span>';

	echo'<br>';
	
	
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
	<span style="font-size: 18px; color: #FFFFFF; font-family: \'bebas\', arial, serif;"><b>Now On Air:</b> 
	' . stripslashes($info['title']) . '</span>';
}

if($count == 0) { echo'
<span style="font-size: 18px; color: #FFFFFF; font-family: \'bebas\', arial, serif;"><b>Now On Air:</b> Edge Tunes</span>'; }
	

      ?>