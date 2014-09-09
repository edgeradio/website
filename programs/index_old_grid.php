<?php include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    <?php include 'sidebar.php'; ?>
    <br />
<?php include '../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
 
 <div class="roundednew">
  <h1 class="title-head-right">Programs</h1>
  
  <div class="top_exp">
  <h1>What's the forecast?</h1>
  <p>Wondering what programs are coming up today? The Edge Web Bot has conveniently put them in order below...</p>
  </div>
  
  <table style="width: 100%;" cellpadding="15">
  
  
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

echo'
<tr>
<td style="width: 20px;"><span class="title"><center>ON AIR NOW</center></span></td>
	<td style="width: 100px;"><div style="background-image: url(http://www.edgeradio.org.au/images/edge-head.png); width: 100px; height: 100px;"><img style="border: 0px; width:100px;height:100px;" src="' . $img . '"></div></td>
	<td>
	<span class="title">'.stripslashes($infop['title']).'</span><br>
	<span><i>' . $start . ' - ' . $finish . '</i></span><br>
	<p>' . stripslashes($infop['summary']) . '</p>	
	</td>
</tr>';
}


} else {

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00'), DATE_FORMAT(r_start_time, '%l%p') as r_start, DATE_FORMAT(r_end_time, '%l%p') as r_finish, REPLACE(r_end_time, '00:00:00', '24:00:00') FROM program_info WHERE (day_time='$d' AND start_time <= '$h') OR (r_day_time='$d' AND r_start_time <= '$h') ORDER BY IF(day_time='$d', start_time, r_start_time) DESC LIMIT 1");
$count = mysql_num_rows($inforesult);
while ($info = mysql_fetch_array($inforesult)) {
$titlecount = strlen($info['title']);
if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }

if($info['r_day_time']) {
$start = $info['r_start'];
$finish = $info['r_finish'];
} else {
$start = $info['start'];
$finish = $info['finish'];
}

echo'
<tr>
<td style="width: 20px;"><span class="title"><center>ON AIR NOW</center></span></td>
	<td style="width: 100px;"><div style="background-image: url(http://www.edgeradio.org.au/images/edge-head.png); width: 100px; height: 100px;"><a style="color: #000000; text-decoration: none;" href="http://www.edgeradio.org.au/program/'.str_replace(" ","-",$info['seotitle']).'/"><img style="border: 0px; width:100px;height:100px;" src="' . $img . '"></a></div></td>
	<td>
	<a href="javascript:popUp(\'http://www.edgeradio.org.au/player/\')"><img style="float: right; border: 0px; margin: 0 0 2px 0;" src="http://www.edgeradio.org.au/images/listenlivei.png"></a>
	<a style="color: #000000; text-decoration: none;" href="http://www.edgeradio.org.au/program/'.str_replace(" ","-",$info['seotitle']).'/"><span class="title">'.stripslashes($info['title']).''; if($info['restream_enabled']) { echo' <img title="Re-streaming Available" src="http://www.edgeradio.org.au/images/restream-mini.png">'; }  echo'</span></a><br>
	<span><i>' . $start . ' - ' . $finish . '</i></span><br>
	<p>' . stripslashes($info['summary']) . '</p>	
	</td>
</tr>';
}

}


mysql_select_db("edge_programs",$db);

putenv("TZ=Australia/Hobart");
$h = date('H:i:s');
$d = date('l');

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00'), DATE_FORMAT(r_start_time, '%l%p') as r_start, DATE_FORMAT(r_end_time, '%l%p') as r_finish, REPLACE(r_end_time, '00:00:00', '24:00:00') FROM program_info WHERE (day_time='$d' AND start_time >= '$h') OR (r_day_time='$d' AND r_start_time >= '$h') ORDER BY IF(day_time='$d', start_time, r_start_time) ASC");

 while ($info = mysql_fetch_array($inforesult)) {
 
 if($info['r_day_time']) {
$start = $info['r_start'];
$finish = $info['r_finish'];
} else {
$start = $info['start'];
$finish = $info['finish'];
}
 
 if($info['title'] != 'Edge Tunes') {
if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }
echo'
<tr>
<td style="width: 20px;"><span class="title">' . $info['start'] . '</span></td>
	<td style="width: 100px;"><div style="background-image: url(http://www.edgeradio.org.au/images/edge-head.png); width: 100px; height: 100px;"><a style="color: #000000; text-decoration: none;" href="http://www.edgeradio.org.au/program/'.str_replace(" ","-",$info['seotitle']).'/"><img style="border: 0px; width:100px;height:100px;" src="' . $img . '"></a></div></td>
	<td>
	<a style="color: #000000; text-decoration: none;" href="http://www.edgeradio.org.au/program/'.str_replace(" ","-",$info['seotitle']).'/"><span class="title">'.stripslashes($info['title']).''; if($info['restream_enabled']) { echo' <img title="Re-streaming Available" src="http://www.edgeradio.org.au/images/restream-mini.png">'; }  echo'</span></a><br>
	<span><i>' . $start . ' - ' . $finish . '</i></span><br>
	<p>' . stripslashes($info['summary']) . '</p>	
	</td>
</tr>';
}
}
?>
    </table>
  </div> 
        
      <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../templates/common_end.php'; ?>
