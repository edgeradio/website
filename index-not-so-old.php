<?php include 'inc/common_start.php'; ?>
<body>
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="left_column">
<?php include 'inc/box_leftbanner_new.php'; ?>
        <br>
      <?php include 'inc/box_supporter_new.php'; ?>
    </div>
    <div id="right_column">
        <?php include 'inc/box_nowon_new.php'; ?>
        <br>
<?php include 'inc/box_rightbanner_new.php'; ?>
          </div>
    <div id="three_column">
      <div class="roundednew" style="height: 160px; background-image: url(http://www.edgeradio.org.au/images/whatsonedgeback.png);">
        <?php include 'inc/display_wo_new.php'; ?>
        </div>
            <br />
            
            <div onclick="location.href='http://www.edgeradio.org.au/edgeatfalls/';" style="cursor: pointer; height: 140px; background-image: url(http://www.edgeradio.org.au/images/edgeatfallsbann.png);" class="roundednew">
        </div>
            
        <!--<div onclick="location.href='http://www.edgeradio.org.au/news_archive.php';" style="cursor: pointer; float: left; width: 217px; margin-right: 15px; height: 140px; background-image: url(http://www.edgeradio.org.au/images/edgenews.jpg);" class="roundednew"></div>-->
        <!--<div onclick="location.href='http://www.edgeradio.org.au/erp_archive.php';" style="cursor: pointer; float: left; width: 217px; height: 140px; background-image: url(http://www.edgeradio.org.au/images/edgepres.jpg);" class="roundednew"></div>-->
        <!--<div style="clear: both;"></div>-->
            
                    <br />
    <img onclick="location.href='http://www.edgeradio.org.au/err_archive.php';" style="cursor: pointer;" src="http://www.edgeradio.org.au/images/errheader.png">
        <div style="width: 530px;" class="carousel">
                <ul>
<?php include 'inc/display_err_new.php'; ?>
				</ul>
            </div>
            
            <img class="prev" style="cursor: pointer;" src="http://www.edgeradio.org.au/images/arrow_left.jpg">
<img class="next" style="float: right; cursor: pointer;" src="http://www.edgeradio.org.au/images/arrow_right.jpg">

            
<script type="text/javascript">
$(".carousel").jCarouselLite({
 auto: 10000,
speed: 500,
btnNext: ".next",
btnPrev: ".prev",
pauseOnHover: true 
});
 </script>
 
 <script type="text/javascript">
$(document).ready(function(){
  $('.bslink').bstip({
	  color:"bswrap",
	  forewrap:" <div class=\"roundednew\"><div style=\"width: 200px;\">",
	  backwrap:"</div></div>",
	  hook:"top-right",
	  opacity:".9"
  });
});

</script>
<div style="clear: both;"></div> 
        <br />
 <div onclick="window.open('http://dispatch.dorja.com/em/forms/subscribe.php?db=198932&amp;s=39590&amp;u=31805&amp;k=97ca1b0', 
  'windowname2', 
  'width=465, \
   height=220, \
   directories=no, \
   location=no, \
   menubar=no, \
   resizable=no, \
   scrollbars=no, \
   status=no, \
   toolbar=no'); 
  return false;" style="cursor: pointer; height: 90px; background-image: url(http://www.edgeradio.org.au/images/newsletter.jpg);" class="roundednew"></div>
        
      <div id="footer">
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>
