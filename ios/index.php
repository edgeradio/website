<?php include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">

    <div id="one_column">
 <img src="edgeradioios.png"><a target="_blank" href="http://itunes.apple.com/us/app/edge-radio/id498802737"><img border="0" src="appstore.png"></a>
 <div style="padding: 15px;" class="roundednew">
 <div style="padding-left: 15px; float: right; width: 200px;">
 <img src="listen.png">
  <?php
  include "../inc/database.inc.php";
mysql_select_db("edge_programs",$db);
  $presult = mysql_query("SELECT * FROM program_info where sml_img != ''") or die(mysql_error());

while ($infop = mysql_fetch_array($presult)) {
echo'<img style="width: 40px; height: 40px;" src="'.$infop['sml_img'].'">';
}
  
  ?>
  </div>
 
  <div class="title">Using the Edge Radio ios app, you can now listen to Hobart's award winning youth community radio station from anywhere in the world on your iOS Device.
  <br><br>
  
  Features Include:
  <ul>
<li>Live streaming radio</li>
<li>Program Notifications, get reminded about your favourite shows.</li>
<li>Studio text-in, contact the on air hosts directly.</li>
<li>'Love It', tell us what you love listening to.</li>
<li>Background audio, listen to Edge while you work and play.</li>
<li>AirPlay, beam the Edge beats through your house!</li>
<li>Detailed weekly program information.</li>
</ul>
  
 
  Start listening to Edge Radio from anywhere in the world simply via your compatible ios device, download it free from the app store!
</div>

<br>
<div style="color: #969696" class="title">Requirements: Compatible with iPhone 3GS, iPhone 4, iPhone 4S, iPod touch (3rd generation), iPod touch (4th generation) and iPad. Requires iOS 4.0 or later.</div>
  
  
  <div style="clear:both;"></div>
  </div> 
        
      <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../templates/common_end.php'; ?>
