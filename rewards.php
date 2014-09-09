<?php include 'inc/common_start.php'; ?>
<body onLoad="document.getElementById('one_column').style.display='';document.getElementById('loading').style.display='none'">
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="loading" style="margin-top:150px;display:"><img src="images/loading.gif" width="16" height="16" alt="Loading" /></div>
    <div id="one_column" style="display: none">
      <div class="rounded">
        <h1 class="greyheader">Supporter Rewards</h1>
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
          <p align="center">Click <a href="rewards_form.php">here</a> to order your prefered reward</p>
        </div>
        <div class="smalltext">
          <iframe id="musicstock" src="musicstock/rewards.html" width="100%" frameborder="0" scrolling="auto" height="800">
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
