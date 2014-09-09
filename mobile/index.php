
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
    "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html>
<head>
  <meta http-equiv="content-type"
 content="text/html; charset=ISO-8859-1">
  <title>Edge Radio 99.3FM - Mobile</title>
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(
hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <link rel="apple-touch-icon" href="http://mobile.edgeradio.org.au/apple-touch-icon.png">
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
  <meta name="viewport"
 content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
 <meta name="apple-mobile-web-app-capable" content="yes">
 <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
  <link rel="stylesheet" type="text/css"
 href="http://mobile.edgeradio.org.au/style.css">
 <script type="text/javascript" language="javascript"> 
function goToSite(e)
{   
    var url = e.options[e.selectedIndex].value;
    document.location.href = url;
    return true;
}
</script>
<style>

@font-face {
/* for other browsers */
font-family: 'bebas';
    src: url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.eot?#iefix') format('embedded-opentype'),
         url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.woff') format('woff'),
         url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.ttf') format('truetype'),
         url('http://www.edgeradio.org.au/templates/BebasNeue-webfont.svg') format('svg');
}

</style>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()

{
$('#kick').load('data.php').fadeIn("slow");
}, 5000);
</script>
</head>
<body style="background-color: #000000; padding: 0px; margin: 0px; background-repeat: no-repeat; background-image: url(http://www.edgeradio.org.au/images/edge-bg.png); background-position: top center;">

<div style="position: fixed; background-image: url(images/bg.png); width: 100%; text-align: right;"><img src="images/logo.png"></div>


<div style="padding: 10px; position: fixed; bottom: 0; background-image: url(images/bg.png); width: 100%; text-align: left;"><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
 
<script>
	$(document).ready(function(){
		$("#play-bt").click(function(){
			$("#audio-player")[0].play();
			$("#message").text("Live Stream Started");
		})
 
		$("#stop-bt").click(function(){
			$("#audio-player")[0].pause();
			$("#audio-player")[0].currentTime = 0;
			$("#message").text("Live Stream Stopped");
		})
	})
</script>
 
<audio id="audio-player" name="audio-player" src="http://131.217.118.2:7990/EdgeRadio.mp3" ></audio><br>

<div id="kick"></div>
<br>


<a id="play-bt" style="text-decoration: none; color: #33CC33; font-size: 28px; line-height: 18px; letter-spacing:1px; font-family: 'bebas', arial, serif;" href="#">Play</a>  &nbsp; &nbsp; <a id="stop-bt" style="text-decoration: none; color: #FF0000; font-size: 28px; line-height: 18px; letter-spacing:1px; font-family: 'bebas', arial, serif;" href="#">Stop</a><br>
<span style="text-decoration: none; color: #CCCCCC; font-size: 14px; line-height: 18px; letter-spacing:1px; font-family: 'bebas', arial, serif;" id="message"></span>
</div>

</body>
</html>
