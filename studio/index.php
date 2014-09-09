<?php include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/navbar.php'; ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="jquery.countdown.js"></script>
<script type="text/javascript">
$(document).ready(function() { $("#load_program").load("record_count.php"); var refreshId = setInterval(function() { $("#load_program").load('record_count.php?randval='+ Math.random()); }, 9000); });
</script>

<style>

.speech-bubble
  {
   width: 720px;
   padding: 10px;
   background: #404040;
   color: #fff;
   font: normal 18px Arial;
   -moz-border-radius: 10px;
   -webkit-border-radius: 10px;
   border-radius: 10px;
  }
  .speech-bubble:after
  {
   content: "";
   border: solid 10px transparent; /* set all borders to 10 pixels width */
   border-top-color: #404040; /* the callout */
   border-bottom: 0; /* we do not need the bottom border in this case */
   width: 0;
   height: 0;
   overflow: hidden;
   display: block;
   position: relative;
   bottom: -20px; /* border-width of the :after element + padding of the root element */
   margin: ;
  }

</style>

<div id="main_fluid">
  <div id="main_container">
<?php
$blacklist_ip_range = array(
    '/^131\.217\.(\d+)\.(\d+)/',
);

$request_ip = $_SERVER['REMOTE_ADDR'];

foreach($blacklist_ip_range as $ip) {
    if(preg_match($ip, $request_ip)) {
      
?>
  
  <div class="roundednew" style="background-image: url(studiopanel.png); height: 70px;"></div>
  <br /><br />
  
  
   <div class="roundednew">
 <br>
  <div style="font-family: 'bebas', arial, serif; font-size: 60px; color: #000000; padding: 15px 0 20px 0;">PLEASE NOTE</div>

<div style="font-family: 'bebas', arial, serif; font-size: 18px; color: #000000; padding: 15px 0 20px 0;">Please ensure you are finishing your program before or at the top of the hour. Do not run overtime!</div>

    </div> 
    
    <br /> <br />
    
    
  
    <div id="left_column">
    
     <div class="roundednew">
 
     
     
	 <?php
	 
	 
$database = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db("edge_programs",$database);

putenv("TZ=Australia/Hobart");
$h = date('H:i:s');
$d = date('l');

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, DATE_FORMAT(end_time, '%k') as hourfinish FROM program_info WHERE day_time='$d' AND start_time <= '$h' ORDER BY start_time DESC LIMIT 1");
$count = mysql_num_rows($inforesult);
while ($info = mysql_fetch_array($inforesult)) {
$titlecount = strlen($info['title']);
if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }

echo'
<div style="font-family: \'bebas\', arial, serif; font-size: 30px; color: #000000; padding: 15px 0 20px 0;">On Air Now</div>
<center><img style="margin-top: 5px; width: 163px; height: 163px;" src="' . $img . '"></center>
<div style="padding-left: 8px; padding-bottom: 5px; margin-top: 5px; font-size: 12px;"><a style="color: #000000; text-decoration: none;" href="http://www.edgeradio.org.au/programs/'.$info['day_time'].'/'.str_replace(" ","-",$info['seotitle']).'/"><b>' . stripslashes($info['title']) . '</b></a><br><i>' . $info['start'] . ' - ' . $info['finish'] . '</i>';

$day = date('j');
$month = date('n');
$year = date('Y');

?>
<br>
<script type="text/javascript">
$(function () {
	var nowon = new Date();
	$('#defaultCountdown').countdown({until: $.countdown.UTCDate(+11, <?php echo $year; ?>, <?php echo $month; ?>-1, <?php echo $day; ?>, <?php if($info['hourfinish'] == 0) { echo '25'; } else { echo $info['hourfinish']; }?>, 0, 0, 0), format: 'M', compact: true, description: ' minutes left'});
	$('#year').text(nowon.getFullYear());});
</script>

<div style="font-weight: bold; color: #FF0000;" id="defaultCountdown"></div></div>
</div>
<br />
<?php

}

if($count == 0) { 

$day = date('j');
$month = date('n');
$year = date('Y');

echo'
<div style="font-family: \'bebas\', arial, serif; font-size: 30px; color: #000000; padding: 15px 0 20px 0;">On Air Now</div>
<center><img style="margin-top: 5px; width: 163px; height: 163px;" src="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg"></center>
<div style="padding-left: 8px; padding-bottom: 5px; margin-top: 5px; font-size: 12px;"><b>Edge Tunes</b><br><i>All Night</i>'; 

?>

<script type="text/javascript">
$(function () {
	var nowon = new Date();
	$('#defaultCountdown').countdown({until: $.countdown.UTCDate(+11, <?php echo $year; ?>, <?php echo $month; ?>-1, <?php echo $day; ?>, 6, 0, 0, 0), format: 'M', compact: true, description: ' minutes left'});
	$('#year').text(nowon.getFullYear());});
</script>

<div style="font-weight: bold; color: #FF0000;" id="defaultCountdown"></div></div>
</div>
<br />
<?php

}



$curesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish FROM program_info WHERE day_time='$d' AND start_time > '$h' ORDER BY start_time ASC LIMIT 0,1");
$coua = mysql_num_rows($curesult);
while ($ina = mysql_fetch_array($curesult)) {
 $next_titlecount = strlen($ina['title']);
 if($info['sml_img'] == '') { $imgn = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $imgn = $ina['sml_img']; }

echo'<div class="roundednew">
<div style="font-family: \'bebas\', arial, serif; font-size: 30px; color: #000000; padding: 15px 0 20px 0;">Coming Up</div>
<center><img style="margin-top: 5px; width: 163px; height: 163px;" src="' . $imgn . '"></center>
<div style="padding-left: 8px; margin-top: 5px;"><a style="color: #000000; text-decoration: none;" href="http://www.edgeradio.org.au/programs/'.$ina['day_time'].'/'.str_replace(" ","-",$ina['seotitle']).'/"><b>'; if($next_titlecount > 25) { echo'<marquee>'; echo stripslashes($ina['title']); echo'</marquee>'; } else { echo stripslashes($ina['title']); } echo'</b></a><br><i>' . $ina['start'] . ' - ' . $ina['finish'] . '</i></div>
';
}

if($coua == 0) { echo'<div class="roundednew"><div style="font-family: \'bebas\', arial, serif; font-size: 30px; color: #000000; padding: 15px 0 20px 0;">Coming Up</div>
<center><img style="margin-top: 5px; width: 163px; height: 163px;" src="http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg"></center>
<div style="padding-left: 8px; margin-top: 5px;"><b>Edge Tunes</b><br><i>All Night</i></div>
'; }


	 
	 
	 ?>
	 <br />
	 	 </div>
	 	 <br />
	 	 <div class="roundednew">
  <div style="font-family: 'bebas', arial, serif; font-size: 30px; color: #000000; padding: 15px 0 20px 0;">Promote!</div>
  <p><b>SMS:</b><br>0427 EDGE FM (334 336)</p>
 <p><b>Website Messages:</b><br>edgeradio.org.au</p>
 <p><b>Facebook</b><br>facebook.com/edgeradio993fm</p>
 <p><b>Twitter</b><br>twitter.com/edgeradio993fm</p>
</div>
<br />

 <div class="roundednew">
  <div style="font-family: 'bebas', arial, serif; font-size: 30px; color: #000000; padding: 15px 0 20px 0;">Useful Links</div>
 <p><a href="http://www.edgeradio.org.au/" style="color: #000000;">Edge Radio Homepage</a></p>
 <p><a href="http://www.edgeradio.org.au/" style="color: #000000;">New Music Page</a></p>
 <p><a href="http://www.edgeradio.org.au/admin/woe-manager.php" style="color: #000000;">Whats On Edge Manager</a></p>
 <p><a href="http://www.edgeradio.org.au/admin/handbook.pdf" style="color: #000000;">Station Handbook (PDF)</a></p>
 <p><a href="http://airit.org.au/web/Amrap_Pages/Amrap_Pages_Broadcaster_Guide.pdf" style="color: #000000;">AMRAP Pages Guide</a></p>
 <p><a href="#" style="color: #000000;">Studio Video Guides</a></p>
 <p><a href="http://www.cbaa.org.au/codes" style="color: #000000;">CBAA Codes Of Practice</a></p>
  
</div>

<br />

	 	 <div class="roundednew">
<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="http://edgeradio.us5.list-manage2.com/subscribe/post?u=3d971fe29c5c8a5d24c5adc57&amp;id=0ed9a776ab" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	<label for="mce-EMAIL">Volunteer Update Emails</label>
	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_3d971fe29c5c8a5d24c5adc57_0ed9a776ab" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
</form>
</div>

<!--End mc_embed_signup-->
</div>
<br />

 <div class="roundednew">
  <div style="font-family: 'bebas', arial, serif; font-size: 30px; color: #000000; padding: 15px 0 20px 0;">Require Help?</div>
  <p>During office hours (9am til 5pm, Monday to Friday), dial extension <b>7273</b> for assistance in emergencies or general questions.</p>
  <p>After hours technical support is available 24/7.</p>
  <p><small>*PLEASE NOTE: Only call this number when an emergency happens <i>after hours</i>. If there is no answer, wait a few mins and try again. Remember, we do have a backup plan, so the station will never go off air. Relax!</small></p>
  
</div>
	 	 
    </div>
    <div id="two_column">

 <div class="roundednew">
  <div style="font-family: 'bebas', arial, serif; font-size: 30px; color: #000000; padding: 15px 0 20px 0;">Latest Studio E-Mail Messages</div>
  
  <div id='load_program'><img style="padding: 10px;" src="loading.gif"></div>
 

    </div> 
    <br />
    
<div style="background-color: #FFFFFF; " class="roundednew">
  <div style="font-family: 'bebas', arial, serif; font-size: 30px; color: #000000; padding: 15px 0 20px 0;">Twitter @EdgeRadio993FM</div>
<center><a class="twitter-timeline" width="700" height="600" href="https://twitter.com/EdgeRadio993FM" data-widget-id="470572410605817857" data-chrome="transparent noborders noheader">Tweets by @EdgeRadio993FM</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></center>
</div><br>

<div style="background-color: #FFFFFF; " class="roundednew">
 <div style="font-family: 'bebas', arial, serif; font-size: 30px; color: #000000; padding: 15px 0 20px 0;">FaceBook @EdgeRadio993FM</div>
 <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fedgeradio993fm&amp;width=700&amp;height=600&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=true&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; width:730px; height:600px;" allowTransparency="true"></iframe>
</div><br>
  
<div style="background-color: #000000; " class="roundednew">
  <div style="font-family: 'bebas', arial, serif; font-size: 30px; color: #FFFFFF; padding: 15px 0 20px 0;">Gig Guide Summary</div>

    
    <?php

mysql_select_db("edge_content",$db);

$inforesult = mysql_query("SELECT * FROM gig_guide WHERE approved = 'true' ORDER BY sponsor DESC, whenevent DESC",$db);
$count = 1;
while ($info = mysql_fetch_array($inforesult)) {
?>
 
<div style="z-index: <?php echo $count; ?>; padding: 20px; width: 290px; display: inline-block; vertical-align: top; margin: 10px; min-height: 100px;" class="rounded">
    
<span class="title"><?php echo $info['title']; ?></span>

<p><?php if($info['image']) { ?><img style="margin-right: 10px; width: 60px; height: 60px; float: left;" src="<?php echo $info['image']; ?>"><?php } ?><?php echo $info['description']; ?></p>
        
<div title="Date & Time Of Event" style="background: url(../images/date-icon.png) top left no-repeat; padding: 5px 0 0 25px; margin: 10px 5px 5px 5px; font-size: 10px; height: 20px;"><?php echo date("<b>l</b> jS \of F Y <b>h:i:s A</b>", strtotime($info['whenevent'])); ?></div>
    
<div title="Where The Event Is Being Held" style="background: url(../images/map-icon.png) top left no-repeat; padding: 5px 0 0 25px; margin: 5px 5px 5px 5px; font-size: 10px; height: 20px;"><a href="https://maps.google.com.au/?q=<?php echo $info['venue']; ?>" style="text-decoration: none; color: #000000;"><?php echo $info['venue']; ?></a></div>
    
<div title="The Lineup Of The Event" style="background: url(../images/lineup-icon.png) top left no-repeat; padding: 5px 0 0 25px; margin: 5px 5px 5px 5px; font-size: 10px; height: 20px;"><?php echo $info['lineup']; ?></div>

<?php if($info['website']) { ?><a title="Website" href="<?php echo $info['website']; ?>" style="text-decoration: none; float: right; margin: 5px; padding: 5px; background-color: #E82A46; color: #FFFFFF;">Website</a><?php } ?>

<?php if($info['facebook']) { ?><a title="Facebook" href="<?php echo $info['facebook']; ?>" style="text-decoration: none; float: right; margin: 5px; padding: 5px; background-color: #3B5998; color: #FFFFFF;">Facebook</a><?php } ?>
        
      </div>
      
<?php
      $count++;
      }
      ?>

    </div> 
<?php 

 
} else {

?>
 <div class="roundednew">
 <br>
  <div style="font-family: 'bebas', arial, serif; font-size: 60px; color: #000000; padding: 15px 0 20px 0;">Whey!</div>

<div style="font-family: 'bebas', arial, serif; font-size: 30px; color: #000000; padding: 15px 0 20px 0;">You're not in the Edge studio! What are you doing here?</div>

    </div>
<?php

}
    }
    
?>


        
      <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../templates/common_end.php'; ?>
