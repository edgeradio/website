<?php include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    <?php include 'sidebar.php'; ?><br>
    <?php include'../music/sidebar.php'; ?>
    <br />
<?php include '../inc/sidebar.php'; ?><br>

<div class="rounded-side-new">
<span style="position: relative; top: -2px; font-size: 44px; color: #C21313;" class="title">Twitter</span>
<a class="twitter-timeline" width="300" height="1200" href="https://twitter.com/EdgeRadio993FM" data-widget-id="470572410605817857" data-chrome="transparent noborders noheader noscrollbar">Tweets by @EdgeRadio993FM</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

    </div>
    <div id="two_column">
 
 <div class="roundednew">
	<h1 class="title-head-right">Program Guide</h1>
	<div id="amrappages"></div><br>
	<b>(s) Denotes a syndicated program from the CBAA <a href="http://cbaa.org.au/crn">Community Radio Network.</a></b><br>
</div> 
        
      <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../templates/common_end.php'; ?>
