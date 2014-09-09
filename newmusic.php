<?php include 'inc/common_start.php'; ?>
<body onLoad="document.getElementById('one_column').style.display='';document.getElementById('loading').style.display='none'">
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="loading" style="margin-top:150px;display:"><img src="images/loading.gif" width="16" height="16" alt="Loading" /></div>
    <div id="one_column" style="display: none">
      <div class="rounded">
        <h1 class="greyheader">NEW Music on Edge Radio</h1>
        <p align="center"> <a href="javascript: void(0)" 
   onclick="window.open('http://www.edgeradio.org.au/musicSampler.htm', 
  'windowname2', 
  'width=304, \
   height=401, \
   directories=no, \
   location=no, \
   menubar=no, \
   resizable=no, \
   scrollbars=no, \
   status=no, \
   toolbar=no'); 
  return false;"><img src="banners/playerlink.jpg" width="581" height="88" alt="Music Player" /></a><br />
          Click the banner to sample our new music.</p>
        <div class="text">
          <p>The titles below are a selection of the music spinning on Edge Radio. We have ears for all genres and particularly for Tasmanian and independent releases. </p>
          <p>Request songs by texting us on 0427 334 336. Click <a href="err_archive.php">here</a> to see the Edge Radio Recommended archive (Best of 2005 onwards) </p>
        </div>
        <div class="smalltext">
          <iframe id="musicstock" src="musicstock/newmusic.html" width="100%" frameborder="0" scrolling="auto" height="800">
          <p>Your browser does not support iframes.</p>
          </iframe>
        </div>
      </div>
      <div id="footer">
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>
