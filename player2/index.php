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
      
<div id="myElement">Loading the player...</div>

<script type="text/javascript">

    
    jwplayer("myElement").setup({
	height: 30,
	width: 300,
	flashplayer: "jwplayer.flash.swf",
	file: "http://131.217.118.2:7990/EdgeRadio.mp3",
	type: 'mp3',
	flashvars: 'ignoremeta=true',
	provider: 'sound',
	autostart: 'true',
    });
    
    
</script><br>

<!-- <script>
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

</body>
</html>