<?php include 'inc/common_start.php'; ?>
<body>
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="left_column">
      <div class="rounded">
        <h1 class="redheader">WEBSTREAM</h1>
        <p align="center"><img src="images/radio.jpg" width="160" height="125" alt="Radio" /></p>
        <p align="center">Use one of the links on the right to listen to Edge online.</p>
      </div>
    </div>
    <div id="right_column">
       <?php include 'inc/box_flickr.php'; ?>
    </div>
    <div id="three_column">
      <div class="rounded">
        <h1 class="greyheader">LISTEN ONLINE</h1>
        <p class="text"><strong>Webcast Link:</strong></p>
        <p class="text">Click on the link below to try your luck at an auto connection to your default webstreaming program.</p>
        <a href="http://www.edgeradio.org.au/EdgeRadio99.3.m3u">http://www.edgeradio.org.au/EdgeRadio99.3.m3u</a> <br />
        <p class="text"><strong> Webstream Link:</strong></p>
        <p class="text"> Copy and paste this link into the Play/Open URL section of your media player</p>
        <a href="http://131.217.118.2:7990/EdgeRadio.mp3">http://131.217.118.2:7990/EdgeRadio.mp3 </a> <br />
        <p><strong>For Winamp: </strong><br/>
          Go to - File/Play URL. Copy and paste everything inside the webstream box below</p>
        <p><strong>Windows Media Player 9:</strong><br />
          Go to - File/Open URL. Copy and paste everything inside the webstream box below</p>
        <p><strong>RealOne player (minimum version 2):</strong><br />
          Go to - File/Open. Copy and paste everything inside the webstream box below</p>
      </div>
      <div id="footer">
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>
