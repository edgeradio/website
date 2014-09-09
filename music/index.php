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
    
    <?php
    include "../inc/database.inc.php";
mysql_select_db("edge_music",$db);

 
 $inforesult = mysql_query("SELECT * FROM music WHERE public = 'true' AND date_featured!='0000-00-00' ORDER BY date_featured DESC LIMIT 5",$db);
 
 $hownany = mysql_num_rows($inforesult);
 
 if($hownany > 0) {
     ?>
    
    <div style="height: 180px; margin-bottom: 15px;" id="transitionEffect">
 
 <?php
while ($info = mysql_fetch_array($inforesult)) {
 
 ?>
  <div class="roundednew slide" style="height: 180px; width: 730px; background-image: url(<?php echo str_replace("thumb_", "", $info['image']); ?>);">
  <div style="width: 500px;" class="head_trans">
  <span class="title" style="color: #FF0000;">Featured: &nbsp;</span>
<span class="title" style="color: #FFFFFF;"><?php echo stripslashes($info['title']); ?> - <?php echo $info['artist']; ?></span><br>
<span style='color: rgb(150, 150, 150); line-height: 16px;'><span><b>Genre:</b> <?php echo stripslashes($info['genre']); ?>  - <b>Label:</b> <?php echo stripslashes($info['label']); ?></span></span><br /><div style='padding-top: 3px; font-size: 12px; line-height: 16px; color: #ffffff;'><?php echo stripslashes(substr($info['notes'],0,240)); if(strlen($info['notes']) >= 240) { echo'...'; } ?>
<?php
if($info['soundcloud']) {
	 echo'
	<div style="margin-top: 10px;" class="roundednew"><object height="18" width="100%"> <param name="movie" value="http://player.soundcloud.com/player.swf?url='.$info['soundcloud'].'&amp;auto_play=false&amp;player_type=tiny&amp;font=Arial&amp;color=000000&amp;theme_color=333333&amp;show_user=false&amp;single_active=true&amp;show_playcount=false"></param> <param name="allowscriptaccess" value="always"></param> <embed allowscriptaccess="always" height="18" src="http://player.soundcloud.com/player.swf?url='.$info['soundcloud'].'&amp;auto_play=false&amp;player_type=tiny&amp;font=Arial&amp;color=000000&amp;theme_color=333333&amp;show_user=false&amp;single_active=true&amp;show_playcount=false" type="application/x-shockwave-flash" width="100%"></embed> </object></div>
	';
	}
	?>
</div></div>
 </div>
   <?php
   
   }
   
   ?>
     </div>

    <script type="text/javascript">
      (function($) {
        function init() {
          $("#transitionEffect").fadeTransition({pauseTime: 4000,
                                                 transitionTime: 1000,
                                                 manualNavigation: false,
                                                 pauseOnMouseOver: true,
                                                 createNavButtons: false});
        }
        
        $(document).ready(init);
      })(jQuery);
    </script>
   
   <?php
   }
   
   ?>

 
 <br />
 <div class="roundednew">
  <h1 onclick="location.href='http://www.edgeradio.org.au/music/songs/';" style="cursor: pointer;" class="title-head-right">New Songs On Edge</h1>

<table style="width: 100%;" cellpadding="15">
 	<?php

$inforesult = mysql_query("SELECT * FROM music WHERE public = 'true' AND type='track' ORDER BY id DESC, date_added DESC LIMIT 3",$db);

while ($info = mysql_fetch_array($inforesult)) {


echo'

<tr>
	<td style="width: 100px;"><div style="background-image: url(http://www.edgeradio.org.au/images/unknown.jpg); width: 100px; height: 100px;"><img style="width:100px;height:100px;" src="'.$info['image'].'"></div></td>
	<td>
	<span class="title">'.stripslashes($info['artist']).' - '.stripslashes($info['title']).' '; if($info['album']) { echo'<span style="color: #333333;">('.stripslashes($info['album']).')</span>'; } echo'</span>'; if($info['tasmanian']) { echo' <img title="Tasmanian Artist" src="http://www.edgeradio.org.au/images/tas_icon.png">'; } echo'<br>
	<span><b>Genre:</b> '.stripslashes($info['genre']).' - <b>Label:</b> '.stripslashes($info['label']).'</span><br>
	<p>'; echo stripslashes(substr($info['notes'],0,240)); if(strlen($info['notes']) >= 240) { echo'...'; } echo'</p>
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
    
    ?>

	</table>
	
	
	<br><br>
 </div>
 
 <br />
 <div class="roundednew">
  <h1 onclick="location.href='http://www.edgeradio.org.au/music/albums/';" style="cursor: pointer;" class="title-head-right">New Albums On Edge</h1>

<table style="width: 100%;" cellpadding="15">
 	<?php

$inforesult = mysql_query("SELECT * FROM music WHERE public = 'true' AND type='album' ORDER BY id DESC, date_added DESC LIMIT 3",$db);

while ($info = mysql_fetch_array($inforesult)) {


echo'

<tr>
	<td style="width: 100px;"><div style="background-image: url(http://www.edgeradio.org.au/images/unknown.jpg); width: 100px; height: 100px;"><img style="width:100px;height:100px;" src="'.$info['image'].'"></div></td>
	<td>
	<span class="title">'.stripslashes($info['artist']).' - '.stripslashes($info['title']).' '; if($info['album']) { echo'<span style="color: #333333;">('.stripslashes($info['album']).')</span>'; } echo'</span>'; if($info['tasmanian']) { echo' <img title="Tasmanian Artist" src="http://www.edgeradio.org.au/images/tas_icon.png">'; } echo'<br>
	<span><b>Genre:</b> '.stripslashes($info['genre']).' - <b>Label:</b> '.stripslashes($info['label']).'</span><br>
	<p>'; echo stripslashes(substr($info['notes'],0,240)); if(strlen($info['notes']) >= 240) { echo'...'; } echo'</p>
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
    
    ?>

	</table>
	
	
	<br><br>
 </div>
 
        
      <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../templates/common_end.php'; ?>
