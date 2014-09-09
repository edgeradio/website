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
  <h1 class="title-head-right">Edge Radio Recommended</h1>
  
  <div class="top_exp">
  <h1>Tune In!</h1>
  <p>Every week, we showcase the best new release that's pleased our ears. You can hear tracks from the Edge Radio Recommended (ERR)feature between 7am and 7pm every day of the week. If you tune in at the right moment you might even get the chance to win a copy of the current ERR.</p>
  </div>

<table style="width: 100%;" cellpadding="10">
 	<?php
include "../../inc/database.inc.php";
mysql_select_db("edge_music",$db);

date_default_timezone_set('Australia/Hobart');
$inforesult = mysql_query("SELECT * FROM music WHERE err_date_end != '0000-00-00' ORDER BY date_added DESC LIMIT 10");
while ($info = mysql_fetch_array($inforesult)) {
 if(strtotime($info['err_date_end']) > time()) {
echo'

<tr>
	<td style="width: 100px;"><br><div style="background-image: url(http://www.edgeradio.org.au/images/unknown.jpg); width: 100px; height: 100px;"><img style="width:150px;height:150px;" src="'.$info['image'].'"></div><br><br><br><br><br></td>
	<td style="width: 400px;">
	<span class="title">'.stripslashes($info['artist']).' - '.stripslashes($info['title']).' <span style="color: #333333;">'.stripslashes($info['album']).'</span></span>'; if($info['tasmanian']) { echo' <img title="Tasmanian Artist" src="http://www.edgeradio.org.au/images/tas_icon.png">'; } echo'<br>
	<span><b>Genre:</b> '.stripslashes($info['genre']).' - <b>Label:</b> '.stripslashes($info['label']).'</span><br>
	<p>'; echo stripslashes(substr($info['notes'],0,700)); if(strlen($info['notes']) >= 700) { echo'...'; } echo'</p>
		</td>
</tr>
	';
	if($info['soundcloud']) {
	 echo'
	 
	 <br><div width: 100%><iframe class="iframe" src="https://w.soundcloud.com/player?url='.$info['soundcloud'].'&auto_play=false&show_artwork=false&show_comments=false&sharing=true" width="100%" height="166" scrolling="no" frameborder="no">...</iframe></div>
	';
	}
	echo'


';
}
}
    
    ?></table>
    
    <a href="archive.php" style="text-decoration: none; color: #FF0000; float: right;" class="title">Archive -></a><br><br>
 </div>
 
        
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>
