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
  <h1 class="title-head-right">Tasmanian Music</h1>
  
  <div class="top_exp">
  <h1>We <3 Tasmanian Music</h1>
  <p>Edge Radio is the ONLY radio station that supports Tasmanian music, arts and culture all year round. Explore some of the great artists and bands we showcase on Edge Radio below.</p>
  </div>
  
</div><br>
  
  <div class="roundednew">
  <h1 class="title-head-right">New Tassie Tracks on Soundcloud</h1>
  <p><iframe width="100%" height="900" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Fplaylists%2F6571570&auto_play=false&show_artwork=true&show_comments=false&sharing=true"></iframe></p>
  
<h5>Please note: Edge Radio does not host any music on its Soundcloud account. Edge Radio provides existing Soundcloud content in a setlist for your listening pleasure.</h5>
  </div><br>
 
 <div class="roundednew">
 <h1 class="title-head-right">All New Tracks On Edge</h1>

<table style="width: 100%;" cellpadding="15">
 	<?php
include "../../inc/database.inc.php";
mysql_select_db("edge_music",$db);

date_default_timezone_set('Australia/Hobart');
$inforesult = mysql_query("SELECT * FROM music WHERE tasmanian = 'true' AND public = 'true' ORDER BY date_added DESC LIMIT 10");
while ($info = mysql_fetch_array($inforesult)) {
echo'

<tr>
	<td style="width: 100px;"><div style="background-image: url(http://www.edgeradio.org.au/images/unknown.jpg); width: 100px; height: 100px;"><img style="width:100px;height:100px;" src="'.$info['image'].'"></div></td>
	<td>
	<span class="title">'.stripslashes($info['artist']).' - '.stripslashes($info['title']).' <span style="color: #333333;">('.stripslashes($info['album']).')</span></span>'; if($info['tasmanian']) { echo' <img title="Tasmanian Artist" src="http://www.edgeradio.org.au/images/tas_icon.png">'; } echo'<br>
	<span><b>Genre:</b> '.stripslashes($info['genre']).' - <b>Label:</b> '.stripslashes($info['label']).'</span><br>
	';
	if($info['soundcloud']) {
	 echo'
	<object height="18" width="100%"> <param name="movie" value="http://player.soundcloud.com/player.swf?url='.$info['soundcloud'].'&amp;auto_play=false&amp;player_type=tiny&amp;font=Arial&amp;color=000000&amp;theme_color=333333&amp;show_user=false&amp;single_active=true&amp;show_playcount=false"></param> <param name="allowscriptaccess" value="always"></param> <embed allowscriptaccess="always" height="18" src="http://player.soundcloud.com/player.swf?url='.$info['soundcloud'].'&amp;auto_play=false&amp;player_type=tiny&amp;font=Arial&amp;color=000000&amp;theme_color=333333&amp;show_user=false&amp;single_active=true&amp;show_playcount=false" type="application/x-shockwave-flash" width="100%"></embed> </object>
	';
	}
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
