<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    <?php include '../sidebar.php'; ?>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
 
 <div class="roundednew">
  <h1 class="title-head-right">Edge Radio Recommended Archive</h1>
  
  <div class="top_exp">
  <h1>What Did We Feature?</h1>
  <p>Check out what ERR's we have featured in the previous weeks, months or years!</p>
  </div>

<table style="width: 100%;" cellpadding="15">
 	<?php
include "../../inc/database.inc.php";
mysql_select_db("edge_music",$db);

date_default_timezone_set('Australia/Hobart');
$inforesult = mysql_query("SELECT * FROM music WHERE err_date_end != '0000-00-00' ORDER BY date_added DESC LIMIT 104");
while ($info = mysql_fetch_array($inforesult)) {
echo'

<tr>
	<td style="width: 100px;"><div style="background-image: url(http://www.edgeradio.org.au/images/unknown.jpg); width: 100px; height: 100px;"><img style="width:100px;height:100px;" src="'.$info['image'].'"></div></td>
	<td>
	<span class="title">'.stripslashes($info['artist']).' - '.stripslashes($info['title']).' <span style="color: #333333;">'.stripslashes($info['album']).'</span></span>'; if($info['tasmanian']) { echo' <img title="Tasmanian Artist" src="http://www.edgeradio.org.au/images/tas_icon.png">'; } echo'<br>
	<span><b>From:</b> '.stripslashes($info['country']).' - <b>Genre:</b> '.stripslashes($info['genre']).' - <b>Label:</b> '.stripslashes($info['label']).'</span> - <b>End Date:</b> '.stripslashes($info['err_date_end']).'<br>
	<p>'; echo stripslashes(substr($info['notes'],0,700)); if(strlen($info['notes']) >= 700) { echo'...'; } echo'</p>
	';
	echo' 
	</td>
</tr>

';
}
    
    ?></table>
 </div>
 
        
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>
