<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script src="http://jwpsrv.com/library/QTmcxgZpEeORqBIxOUCPzg.js"></script>
  <meta http-equiv="content-type"
 content="text/html; charset=ISO-8859-1">
  <title>Edge Radio 99.3fm - Player</title>
 <script type="text/javascript" src="http://www.edgeradio.org.au/include/jquery.js"></script>
 <script type="text/javascript" src="/jwplayer/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="XK4dieVs8KoMq1+ZrfqHbyLaR6h8e8QZZMZVJw==";</script>
<!-- <script src="http://jwpsrv.com/library/QTmcxgZpEeORqBIxOUCPzg.js"></script> !-->

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()

{
$('#kick').load('data.php').fadeIn("slow");
}, 5000);
</script>

<script>
$(document).ready(function() {
 
	$('.tabs a').click(function(){
		switch_tabs($(this));
	});
 
	switch_tabs($('.defaulttab'));
 
});
 
function switch_tabs(obj)
{
	$('.tab-content').hide();
	$('.tabs a').removeClass("selected");
	var id = obj.attr("rel");
 
	$('#'+id).show();
	obj.addClass("selected");
}
</script>

  <style>
  html {
overflow-x:hidden;
overflow-y:hidden;
}
  
body {
overflow-x:hidden;
overflow-y:hidden;
margin: 0;
padding: 0;
background-image: url(player-bg.jpg); background-repeat: no-repeat;
background-color: #000000;
font-family: arial;
font-size: 11px;
color: #2B2B2B;
}

@font-face {
/* for other browsers */
font-family: 'bebas';
    src: url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.eot?#iefix') format('embedded-opentype'),
         url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.woff') format('woff'),
         url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.ttf') format('truetype'),
         url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.svg') format('svg');
}

ul.tabs {
    width:250px;
    margin:10px;
    padding:0px;
}
ul.tabs li {
    display:block;
    float:left;
    padding:0 5px;
}
ul.tabs li a {
    display:block;
    float:left;
    padding:3px 8px 3px 8px;
    font-size:1.0em;
    font-family: "bebas", arial, serif;
    background-color:#FFFFFF;
    text-decoration:none;
    color: #000000;
    -moz-border-radius-topright: 5px;
border-top-right-radius: 5px;
-moz-border-radius-topleft: 5px;
border-top-left-radius: 5px;
}
.tab-content {
    clear:both;
    margin: 0 10px 0 10px;
    background-color:#FFFFFF;
    padding:10px;
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border-radius:5px;
}

.title {

font-size:1.8em; 
font-family: "bebas", arial, serif;
}

  </style>

<script type="text/javascript">
var auto_refresh = setInterval(
function ()

{
$('#load_program').load('record_count.php').fadeIn("slow");
$('#load_sced').load('record_count.php?function=1').fadeIn("slow");
}, 5000);


    
</script>

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>

</head>
<body>

<?php

if($_GET['podcast']) {

include '../inc/database.pod.php';
$id = $_GET['podcast'];
$sqlBlogger = mysql_query("SELECT * from tbl_RSS_feeds_cbaa where active = 1 AND id = '$id' ORDER BY id ASC");
		
		
// run a cursor to loop through all podcasts and update the SQL table
	
		while ($info = mysql_fetch_array($sqlBlogger)) {

			
  

?>


<table style="text-align: left; width: 300px; height: 300px;" border="0"
 cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td style="text-align: left; vertical-align: bottom; height: 193px;">
      <div style="padding: 10px;">
      <img style="-moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; width: 55px; height: 55px; margin-bottom: 10px;" src="<?php echo $info['rss_image']; ?>"><br>
	<img style="margin-bottom: 5px;" src="player-nowplay.png"><br>
	<a style="font-size: 18px; color: #FFFFFF; font-weight: bold; text-decoration: none;" target="_blank" href="#"><b>PODCAST: <?php echo $info['rss_name']; ?></b></a><br><span style="font-size: 11px; color: #C0C0C0;"><i><?php echo $info['feed_title']; ?></i></span>
      </div>
      </td>
    </tr>
    <tr>
      <td style="height: 30px; text-align: center;">
	  <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="300" height="30">
<param name="movie" value="player-licensed.swf" />
<param name="allowfullscreen" value="false" />
<param name="allowscriptaccess" value="always" />
<param name="flashvars" value="file=<?php echo $info['feed_url']; ?>&type=sound&skin=modieus.swf&abouttext=Edge_Radio_Player&duration=999999&aboutlink=http://www.edgeradio.org.au/&autostart=true" />
<embed
  src='player-licensed.swf'
  width='300'
  height='30'
  bgcolor='#ffffff'
  allowscriptaccess='always'
  allowfullscreen='false'
  flashvars='file=<?php echo $info['feed_url']; ?>&type=sound&skin=modieus.swf&duration=999999&abouttext=Edge_Radio_Player&aboutlink=http://www.edgeradio.org.au/&autostart=true'
/></embed></object></td>
    </tr>
    <tr>
      <td style="height: 243px; vertical-align: top;">
      
      <div id="wrapper">
    <ul class="tabs">
        <li><a href="#" class="defaulttab" rel="tabs1">Now Playing</a></li>
        <li><a href="#" rel="tabs2">Share</a></li>
    </ul>
 
    <div class="tab-content" id="tabs1">
    
    <span class="title">Now Playing</span><br>
	<a style="font-size: 18px; color: #000000; font-weight: bold; text-decoration: none;" target="_blank" href="#"><b>PODCAST: <?php echo $info['rss_name']; ?></b></a><br><span style="font-size: 11px; color: #808080;"><i><?php echo stripslashes($info['feed_title']); ?></i></span>

    
    </div>
    <div class="tab-content" id="tabs2"><span style="font-size: 18px;" class="title">Share This!</span>
    
    <br>
    
    <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:url="http://7edg.com/index.php?podcast=<?php echo $id; ?>&title=Listen: <?php echo $info['rss_name']; ?>">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fc321640122c52d"></script>
<!-- AddThis Button END -->
 </div>

</div>
      
    
      </td>
    </tr>
  </tbody>
</table>
<br>

<?php }  ?>

<?php

} elseif($_GET['interview']) {

include '../inc/database.inc.php';
mysql_select_db('edge_programs');
$id = $_GET['interview'];
$sqlBlogger = mysql_query("SELECT * from interviews where id = '$id' ORDER BY id ASC");
		
		
// run a cursor to loop through all podcasts and update the SQL table
	
		while ($info = mysql_fetch_array($sqlBlogger)) {

			
  

?>


<table style="text-align: left; width: 300px; height: 300px;" border="0"
 cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td style="text-align: left; vertical-align: bottom; height: 193px;">
      <div style="padding: 10px;">
      <img style="-moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; width: 55px; height: 55px; margin-bottom: 10px;" src="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg"><br>
	<img style="margin-bottom: 5px;" src="player-nowplay.png"><br>
	<a style="font-size: 18px; color: #FFFFFF; font-weight: bold; text-decoration: none;" target="_blank" href="#"><b>INTERVIEW: <?php echo $info['title']; ?></b></a>
      </div>
      </td>
    </tr>
    <tr>
      <td style="height: 30px; text-align: center;">
	  <object height="81" width="300px"> <param name="movie" value="https://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F56325840"></param> <param name="autoplay" value="true"></param> <param name="allowscriptaccess" value="always"></param> <embed allowscriptaccess="always" height="81" src="https://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F56325840&autoplay=true" type="application/x-shockwave-flash" width="300px"></embed> </object></td>
    </tr>
  </tbody>
</table>
<br>

<?php }  ?>

<?php

} elseif($_GET['restream']) {
$id = $_GET['restream'];
$id2 = $_GET['restream2'];
$id3 = $_GET['restream3'];
$pid = $_GET['pid'];
include '../inc/database.programs.php';
$sqlBlogger = mysql_query("SELECT * from program_info where id = '$pid'");

		while ($info = mysql_fetch_array($sqlBlogger)) {
		
		if($info['restream_enabled'] == 'true') {
		
?>


<table style="text-align: left; width: 300px; height: 300px;" border="0"
 cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td style="text-align: left; vertical-align: bottom; height: 193px;">
      <div style="padding: 10px;">
	<img style="margin-bottom: 5px;" src="player-nowplay.png"><br>
	<a style="font-size: 18px; color: #FFFFFF; font-weight: bold; text-decoration: none;" target="_blank" href="#"><b>ON DEMAND: <?php echo $info['title']; ?></b></a><br><span style="font-size: 11px; color: #C0C0C0;"><i><?php echo stripslashes($info['summary']); ?></i></span>
      </div>
      </td>
    </tr>
    <tr>
      <td style="height: 30px; text-align: center;">
      
      
      <?php
if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad'))
 {
  ?>
   <script>
window.onload = function() {
	var pElement = document.getElementById("myVideo");

	pElement.load();
	pElement.play();
};
</script>
 <audio width="300" controls="controls" autoplay="autoplay">
  <source src="http://7edg.com/stream.php?id=<?php echo $id; ?><?php if($id2 > 1) { echo'&id2='.$id2.''; } if($id3 > 1) { echo'&id3='.$id3.''; }  ?>" type="audio/mpeg" />
  Your browser does not support the audio element.
</audio>
  <?php
} else
 {
 ?>
 
<div id='playerKD7kdEGGBTbM'></div>
<script type='text/javascript'>
    jwplayer('playerKD7kdEGGBTbM').setup({
        file: 'http://mymyrecords.com/7edg/<?php echo $id;?>.mp3',
        title: '<?php echo $info['title']; ?>',
        width: '300',
        height: '30',
        controls: 'true',
        autostart: 'true',
        fallback: 'true'
    });
    
    function addAudio(audioUrl, audioTitle) {
        var playlist = jwplayer().getPlaylist();
        var newItem = {
            file: audioUrl,
            title: audioTitle
        };
        playlist.push(newItem);
        jwplayer().load(playlist);
    }
    //addAudio('http://mymyrecords.com/7edg/<?php echo $id2;?>.mp3', <?php echo $info['title']; ?>);
</script>


 <?php
 
 }
?>


	</td>
    </tr>
    <tr>
      <td style="height: 243px; vertical-align: top;">
      
      <div id="wrapper">
    <ul class="tabs">
        <li><a href="#" class="defaulttab" rel="tabs1">Now Playing</a></li>
        <li><a href="#" rel="tabs2">Share</a></li>
    </ul>
 
    <div class="tab-content" id="tabs1">
    
    <span class="title">Now Playing</span><br>
	<a style="font-size: 18px; color: #000000; font-weight: bold; text-decoration: none;" target="_blank" href="#"><b><?php echo stripslashes($info['title']); ?></b></a><br><span style="font-size: 11px; color: #808080;"><i><?php echo stripslashes($info['summary']); ?></i></span>

    
    </div>
    <div class="tab-content" id="tabs2"><span style="font-size: 18px;" class="title">Share This!</span>
    
    <br>
    <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:url="http://edgeradio.org.au/program/<?php echo $info['title']; ?>/playlist/restream/">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fc321640122c52d"></script>
<!-- AddThis Button END -->

<br>
<span style="font-size: 18px;" class="title">Link This!</span>
<input onClick="this.select(); pageTracker._trackEvent('new-done-click','short-click');"  readonly="readonly" style="width: 100%;" value="http://edgeradio.org.au/program/<?php echo $info['title']; ?>/playlist/restream/"/>

    </div>
    
  
</div>
      
    
      </td>
    </tr>
  </tbody>
</table>
<br>


<?php

}

}

} else {



?>


<table style="text-align: left; width: 300px; height: 300px;" border="0"
 cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td style="text-align: left; vertical-align: bottom; height: 193px;">
      <div id='load_program'><img style="margin: 10px;" src="../images/loading-bl.gif"></div>
      </td>
    </tr>
    <tr>
      <td style="height: 30px; text-align: center;">
      
      <?php
      if(strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad'))
 {
      
      ?>
      
<div id="myElement">Loading the player...</div>

<script type="text/javascript">

    jwplayer("myElement").setup({
        file: "http://131.217.118.2:7990/EdgeRadio.mp3",
        controls: 'false',
        autostart: 'true',
        height: '30',
        width: '300',
        fallback: 'true'
        
    });
    
    
</script><br>

<script>
window.onload = function() {
	var pElement = document.getElementById("myVideo");

	pElement.load();
	pElement.play();
};

</script>



<audio width="300" controls="controls" autoplay="autoplay">
  <source src="http://131.217.118.2:7990/EdgeRadio.mp3" type="audio/mpeg" />
  Your browser does not support the audio element.
</audio>
<?php
} else
 {
?>
<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="300" height="30">
<param name="movie" value="player-licensed.swf" />
<param name="allowfullscreen" value="false" />
<param name="allowscriptaccess" value="always" />
<param name="flashvars" value="file=http://131.217.118.2:7990/EdgeRadio.mp3&duration=999999&type=sound&skin=modieus.swf&abouttext=Edge_Radio_Player&aboutlink=http://www.edgeradio.org.au/&autostart=true" />
<embed
  src='player-licensed.swf'
  width='300'
  height='30'
  bgcolor='#ffffff'
  allowscriptaccess='always'
  allowfullscreen='false'
  flashvars='file=http://131.217.118.2:7990/EdgeRadio.mp3&duration=999999&type=sound&skin=modieus.swf&abouttext=Edge_Radio_Player&aboutlink=http://www.edgeradio.org.au/&autostart=true'
/></embed></object>
<?php
}
?>
	  </td>
    </tr>
    <tr>
      <td style="height: 243px; vertical-align: top;">
      
      <div id="wrapper">
    <ul class="tabs">
        <li><a href="#" class="defaulttab" rel="tabs1">Now Playing</a></li> 
        <li><a href="#" rel="tabs2">Share</a></li>
    </ul>
 
    <div class="tab-content" id="tabs1"><div id='load_sced'><img style="margin: 10px;" src="../images/loading.gif"></div></div>
    <div class="tab-content" id="tabs2"><span style="font-size: 18px;" class="title">Share This!</span>
    
    <br>
    
    <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:url="http://7edg.com/index.php">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fc321640122c52d"></script>
<!-- AddThis Button END -->
    </div>
</div>
      
    
      </td>
    </tr>
  </tbody>
</table>
<br>
<?php } ?>
</body>
</html>
