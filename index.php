<?php include 'templates/common_start.php'; ?>
<body>
<?php include 'templates/navbar.php'; ?>

 <div id="light" class="white_content">
Heard a song you like? Wanting to enter a competition? Or maybe you just want to comment on the current presenter's lovely voice? Use the form below to email our studio!
 <iframe src="send-studio-message.php" style="border: 0px; width: 100%; height: 355px;"></iframe>
 
<small><b>Please Note</b> This form is to send a message to our studio. Please do not send our studio spam, commercial shoutouts or requests for an email back. We are unable to do that! If you wish to email our office for a direct reply, please do so <a href="http://www.edgeradio.org.au/about/contact-edge/">here</a>.</small>
 <br>
 <a class="title" style="float: right; text-decoration: none; color: #FF0000;" href="javascript:void(0)" onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div>
		<div id="fade" class="black_overlay"></div>
		
<div id="main_fluid">
  <div id="main_container">
  
    <div id="left_column">
<?php include 'inc/box_leftbanner_new.php'; ?>
<br />

<script language="JavaScript">
<!-- Newsletter Box By:  James Davey -->

function popUpnewsletter(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=260,height=200');");
}
</script>



<!-- <div class="rounded-side-new" style="height: 90px;">
<span style="position: relative; top: -2px; font-size: 44px; color: #C21313;" class="title">Get Social</span>
<br><br>
<a target="_blank" href="https://www.facebook.com/edgeradio993fm"><img style="padding-right: 3px; border: 0px;" src="http://edgeradio.org.au/images/social/facebook.png"></a>
<a target="_blank" href="https://twitter.com/edgeradio993fm"><img style="padding-right: 3px; border: 0px;" src="http://edgeradio.org.au/images/social/twitter.png"></a>
<a target="_blank" href="https://plus.google.com/115201223591078358236/posts"><img style="padding-right: 3px; border: 0px;" src="http://edgeradio.org.au/images/social/google.png"></a>
<a target="_blank" href="http://www.youtube.com/user/edgeradio993"><img style="padding-right: 3px; border: 0px;" src="http://edgeradio.org.au/images/social/youtube.png"></a>
<br>
<div style="text-align: center; margin: 5px 0px 10px 0px;"><a href="javascript:popUpnewsletter('http://www.edgeradio.org.au/newsletter/signup.php')" style="color: #000000; line-height: 18px; font-size: 18px; font-family: 'bebas', arial, serif; padding: 2px; text-decoration: none;">Subscribe To Our Newsletter</a></div>
</div>
<br />
<?php include 'inc/box_leftbanner_new2.php'; ?> !-->

<div class="rounded-side-new">
<span style="position: relative; top: 2px; font-size: 44px; color: #C21313;" class="title">Twitter</span>
<a class="twitter-timeline" width="300" height="315" href="https://twitter.com/EdgeRadio993FM" data-widget-id="470572410605817857" data-chrome="transparent noborders noheader noscrollbar">Tweets by @EdgeRadio993FM</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

    </div> 
    <div id="two_column">
    
    
    <!--[if gte IE 8]>
    <div class="roundednew" style="font-family: 'bebas', arial, serif; font-size: 18px; padding: 10px; color: #000000; font-weight: bold; width: 100%; background-color: #F6FF00;">
    NOTE: You are using a pretty retro browser. You should upgrade to a <a target="_blank" href="http://google.com/chrome/">better</a> <a target="_blank" href="http://www.mozilla.org/en-US/firefox/">browser</a> to enhance your edge experience!
</div>
<br>
<![endif]-->

<!--[if lt IE 7]>
    <div class="roundednew" style="font-family: 'bebas', arial, serif; font-size: 18px; padding: 10px; color: #000000; font-weight: bold; width: 100%; background-color: #F6FF00;">
    NOTE: You are using a pretty retro browser. You should upgrade to a <a target="_blank" href="http://google.com/chrome/">better</a> <a target="_blank" href="http://www.mozilla.org/en-US/firefox/">browser</a> to enhance your edge experience!
</div>
<br>
<![endif]-->
    
  <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM cup WHERE Display='Y' AND expire > NOW() ORDER BY expire ASC",$db);
?>

<div style="height: 180px; margin-bottom: 15px;" id="transitionEffect">
<?php
$count = 0;
$num = mysql_num_rows($result);

if($num == 0) {
 
   ?> 
  <div class="slide">
  <div class="roundednew" style="height: 180px; width: 730px; background-image: url(http://www.edgeradio.org.au/images/edge-blank.png);">
  <div style="width: 250px;" class="head_trans">
<?php
  echo "<a href='http://www.edgeradio.org.au/program/new-music-on-edge-radio/playlists/' border='0' style='text-decoration: none; font-family: \"bebas\", arial, serif; font-size: 28px; line-height: 32px; color: #FF2A2A;'>New Music On Edge Radio</a><br>";
  echo "<span style='color: rgb(150, 150, 150); line-height: 16px;'>We <3 New Music!</span>";
  echo "<br />";
   echo "<div style='padding-top: 3px; font-size: 12px; line-height: 16px; color: #ffffff;'>Browse some of our new music on Edge Radio from Tasmanian, Australian and International artists.</div>";
?>
</div>
 </div>
 </div>
  <?php
 
 }
 
 
 while ($myrow = mysql_fetch_array($result)) {
    $sd = $myrow["Date"];
  $counttitle = strlen($myrow["Title"]);
  $counttext = strlen($myrow["Description"]);
  $text = substr($myrow["Description"], 0, 240);
  $show_id = $myrow["show_id"];
  mysql_select_db("edge_programs",$db);
  $inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_time, DATE_FORMAT(end_time,'%h:%i%p') as end_time FROM program_info WHERE id='$show_id' LIMIT 1");
  while ($info = mysql_fetch_array($inforesult)) {
   $start = $info['start_time'];
   $end = $info['end_time'];
   $day = $info['day_time'];
   $seotitle = $info['seotitle'];
   if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }
   ?> 
  <div class="roundednew slide" style="height: 180px; width: 730px; background-image: url(<?php echo $info['lrg_img']; ?>);">
  <div style="width: 250px;" class="head_trans">
<?php
  echo "<a href='http://www.edgeradio.org.au/program/".str_replace(" ","-",$seotitle)."/playlists/' border='0' style='text-decoration: none; font-family: \"bebas\", arial, serif; font-size: 28px; line-height: 32px; color: #FF2A2A;'>"; echo $myrow["Title"]; echo"</a><br>";
  echo "<span style='color: rgb(150, 150, 150); line-height: 16px;'>".$day." @ " . $start . " - " . $end . "</span>";
  echo "<br />";
  if($myrow["Description"]) {
   echo "<div style='padding-top: 3px; font-size: 12px; line-height: 16px; color: #ffffff;'>"; if($counttext > 240) { echo $text.'...'; } else { echo $text; } echo"</div>";
   }
   ?>
</div>
 </div>
  <?php
  }
  }
?>
</div>


    <script type="text/javascript">
      (function($) {
        function init() {
          $("#transitionEffect").fadeTransition({pauseTime: 4000,
                                                 transitionTime: 1000,
                                                 manualNavigation: false,
                                                 pauseOnMouseOver: true});
        }
        
        $(document).ready(init);
      })(jQuery);
    </script>
    
    <br />
    
    <?php

mysql_select_db('edge_content'); 
$inforesult = mysql_query("SELECT * FROM banners WHERE banner = 'home_1'");
while ($info = mysql_fetch_array($inforesult)) {

?>
<div class="rounded-side-new" onclick="location.href='<?php echo $info['http_url']; ?>';" style="background-image: url(<?php echo $info['image_url']; ?>); cursor: pointer; width: 730px; height: 90px;"></div>
<br />
     <?php } ?>
         
        
<!-- ERR SLIDER -->

       
          <div style="width: 480px; height: 180px; margin-right: 25px; float: left;">
        
        <style>
#err-slide ul, #err-slide li{
	padding: 5px 0px 0 0;
	margin: 0;
	list-style:none;
	}
#err-slide li{ 
	width:445px;
	height:150px;
	overflow:hidden; 
	}	
	
	p#controls{
	margin:0;
	position:relative;
	} 

#prevBtn, #nextBtn{ 
	display:block;
	margin:0;		
	position:relative;
	left:0px;
	top:-26px;
	}	
#nextBtn{ 
	left:420px;
	top:-40px;
	}														
#prevBtn a, #nextBtn a{  
	display:block;
	font-family: "bebas", arial, serif;
	color: #FFFFFF;
	font-size: 18px;
	text-decoration: none;
	}	

        
        </style>
<script type="text/javascript">
	$(document).ready(function(){	
		$("#err-slide").easySlider({
		auto: true,
		controlsShow: true,
		continuous: true,
		controlsBefore:	'<p id="controls">',
	controlsAfter:	'</p>',
		pause: 12000
	});	
	});	
</script>
<a href="http://www.edgeradio.org.au/music/edge-radio-recommended/"><img style="position: relative; float: left; bottom: -20px; width: 480px; height: 50px;" src="images/blank.gif"></a>
<div style="background-image: url(images/err-back.gif); height: 190px;" class="roundednew">
<div id="err-slide">
		<ul>	
		<?php
mysql_select_db("edge_music",$db);
 $result = mysql_query("SELECT * FROM music WHERE err_date_end != '0000-00-00' ORDER BY date_added DESC",$db);
 while ($info = mysql_fetch_array($result)) {
 if(strtotime($info['err_date_end']) > time()) {
?>
			
			<li>
			<?php 
			echo'<img style="float: left; width: 100px; height: 100px; padding: 0px 15px 0px 0px;" src="'.$info['image'].'"><span style="color: #FFFFFF;" class="title">'.stripslashes($info['artist']).' - '.stripslashes($info['title']).' <span style="color: #F0F0F0;">'.stripslashes($info['album']).'</span></span>
		
	<p style="color: #F0F0F0;">'; echo stripslashes(substr($info['notes'],0,140)); if(strlen($info['notes']) >= 140) { echo'...'; } echo'</p>';
			?>
			</li>	
			
			<?php
			}
			}
		
			?>	
		</ul>
	</div>
	</div>
	</div>
	
	
	<!-- SOAPBOX -->
	
	<div onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" style="background-image: url(images/text-mess.png); width: 205px; height: 150px; padding: 30px 25px 20px 25px; cursor:pointer; float: left;"></div>
	
	<div style="clear:both;"></div>
	<br />
<div class="roundednew">
<span style="position: relative; top: 2px; font-size: 44px; color: #C21313;" class="title">Edge Blog</span>
<br><br>
<?php
$content = file_get_contents("http://edgeradio.org.au/blog/?feed=rss2");  
    $x = new SimpleXmlElement($content);  
   
      $limit = 1;
        for ($i = 0; $i<$limit; $i++) {
             $entry = $x->channel->item;
        echo "<a class='title' style='text-decoration: none; color: #000000;' href='$entry->link' title='$entry->title'>" . $entry->title . "</a><br><p>$entry->description</p>";  
    }  
?>          
 </div>         
          
      <div id="footer">
        <?php include 'templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'templates/common_end.php'; ?>