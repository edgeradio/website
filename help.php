<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type"
 content="text/html; charset=ISO-8859-1">
  <title>Edge Radio 99.3fm - Listen Live</title>

  <style>
body {
margin: 0;
padding: 0;
background-image: url(images/listenbg.jpg); background-repeat: no-repeat;
background-color: #2B2B2B;
font-family: verdana;
font-size: 11px;
color: #2B2B2B;
}
.listenbottomlinks {
height: 40px;
padding-top: 4px;
color: #FFFFFF;
font-size: 11px; 
}
.listenbottomlinks a {
font-family: Helvetica,Arial,sans-serif; 
font-size: 11px; 
color: #FFFFFF;
text-decoration: none;
}

  </style>
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()

{
$('#load_program').load('record_count.php').fadeIn("slow");
}, 4000);
</script>
</head>
<body>
<table style="text-align: left; width: 500px; height: 480px;" border="0"
 cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td style="text-align: center; height: 253px;"><div style="overflow: auto; width: 480px; padding: 10px; height: 233px; color: #FFFFFF; font-size: 11px; text-align: left;"><big><span
 style="font-weight: bold;">Troubleshooting
&amp; Help</span></big><br>
      <br>
      <span style="font-weight: bold;">Requirements</span><br>
      <ul>
        <li>Internet Explorer,
Firefox, Opera or Chrome</li>
        <li>Flash 9+ or older</li>
        <li>Javascript (Enabled in
your browser)</li>
        <li>Broadband Internet</li>
      </ul>
      <span style="font-weight: bold;">
Still Experiencing problems? Try these tips..</span><br>
      <ul>
        <li>Try clearing your
browser's temporary internet files to ensure you have the most up to
date media player.</li>
        <li>If you are at work,
you may be behind a firewall or have our streaming port blocked.
Contact your work's IT department to see if streaming is blocked and
beg for them to unblock it!</li>
        <li>Our player usually
takes between 5 - 10 seconds to start up depending on your internet
connection.&nbsp;</li>
        <li>Make sure your
speakers are turned on and up nice and loud!</li>
        <li>If all else fails, try
rebooting your browser or PC and try again.</li>
      </ul>
If you have any streaming questions or problems not listed here. Please
      <a target="_blank" style="color: #FFFFFF;" href="http://edgeradio.org.au/contact.php">Contact
Us</a>
with a detailed description of your problem. :)<br><br>

<a href="listen-popup.php" style="color: #FFFFFF;"><b><big>GO BACK >></big></b></a></div></td>
    </tr>
    <tr>
      <td style="height: 30px; text-align: center;">
	  <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="500" height="30">
<param name="movie" value="player-licensed.swf" />
<param name="allowfullscreen" value="false" />
<param name="allowscriptaccess" value="always" />
<param name="flashvars" value="file=http://131.217.118.2:7990/EdgeRadio.mp3&duration=999999&type=sound&skin=modieus.swf&abouttext=Edge_Radio_Player&aboutlink=http://www.edgeradio.org.au/&autostart=true" />
<embed
  src='player-licensed.swf'
  width='500'
  height='30'
  bgcolor='#ffffff'
  allowscriptaccess='always'
  allowfullscreen='false'
  flashvars='file=http://131.217.118.2:7990/EdgeRadio.mp3&duration=999999&type=sound&skin=modieus.swf&abouttext=Edge_Radio_Player&aboutlink=http://www.edgeradio.org.au/&autostart=true'
/></embed></object></td>
    </tr>
    <tr>
      <td style="height: 80px;">
      <table style='width: 100%;'><tr>
	<td style='text-align: left; font-size: 11px;'>
      <div id='load_program'>
<table style="width: 100%; height: 88px;" cellpadding="10">
<tr>
<td style="vertical-align: top; width: 250px;">
<div style="font-size: 11px; margin: 24px 0px 0px 5px;"><img src="images/loading.gif"></div>
</td>
<td style="vertical-align: top; width: 220px;">
	<div style="font-size: 11px; margin: 24px 0px 0px 5px;"><img src="images/loading.gif"></div>
	</td>
</tr>
</table>
</div></td>
</tr></table>
      </td>
    </tr>
    <tr>
      <td style="height: 80px;">
	  <?php include'thisweek_count.php'; ?>
      </td>
    </tr>
    <tr>
      <td style="height: 25px; color: #FFFFFF; text-align: right;">
      <div class="listenbottomlinks">&nbsp; <a style="color: #FFFFFF;"
 href="http://www.edgeradio.org.au/EdgeRadio99.3.m3u">Launch
In Media Player</a>
&nbsp;|
&nbsp;<a style="color: #FFFFFF;" href="javascript:location.reload(true)">Refresh Page</a> &nbsp;|
&nbsp;<a style="color: #FFFFFF;" href="help.php">Help</a> &nbsp;</div>
      </td>
    </tr>
  </tbody>
</table>
<br>
</body>
</html>

