<?php include 'inc/common_start.php'; ?>
<body>
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="left_column">
<?php include 'inc/box_leftbanner.php'; ?>
        <br>
      <?php include 'inc/box_supporter.php'; ?>
      <br />
    </div>
    <div id="right_column">
        <?php include 'inc/box_rightbanner.php'; ?>
        <br>
<?php include 'inc/box_nowon.php'; ?>
          </div>
    <div id="three_column">
      <div class="rounded" style="height: 160px; background-image: url(images/whatsonedgeback.png);">
        <?php include 'inc/display_wo_new.php'; ?>
        </div>
            <br />
        <div style="float: left; width: 217px; margin-right: 15px; height: 140px; background-image: url(http://www.edgeradio.org.au/images/edgenews.jpg);" class="rounded"></div>
        <div style="float: left; width: 217px; height: 140px; background-image: url(http://www.edgeradio.org.au/images/edgepres.jpg);" class="rounded"></div>
        <div style="clear: both;"></div> 
            
                    <br />
    
        <div style="width: 530px;" class="carousel">
                <ul>
<?php include 'inc/display_err_new.php'; ?>
				</ul>
            </div>
            
            
<script type="text/javascript">
$(".carousel").jCarouselLite({
 auto: 10000,
speed: 500,
pauseOnHover: true 
});
 </script>
 
 <script type="text/javascript">
$(document).ready(function(){
  $('.bslink').bstip({
	  color:"bswrap",
	  forewrap:" <div class=\"rounded\"><div style=\"width: 200px;\">",
	  backwrap:"</div></div>",
	  hook:"top-right"
  });
});

</script>
<div style="clear: both;"></div> 
        <br />
        <div style="height: 90px; background-image: url(http://www.edgeradio.org.au/images/newsletter.jpg);" class="rounded"></div>
        
      <div id="footer">
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>
