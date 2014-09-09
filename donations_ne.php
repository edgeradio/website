<?php include 'inc/common_start.php'; ?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAzCfn4Jq9VVl_bE3-MT8GChQdYf3WK95eEeoeFsw9KL-QebWYchRnXBeEovGTnkjdw70CSiRy6fPvbQ"
      type="text/javascript"></script>
<script type="text/javascript">

    //<![CDATA[

    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.setCenter(new GLatLng(-42.90381231834313, 147.32674464583397), 17);
		var marker = new GMarker(new GLatLng(-42.90381231834313, 147.32674464583397));
         var html = '<div style="width:200; padding-right:10px;">'+
            '<strong>Edge Radio Studio</strong><br />Room 207, Arts Building<br />'+
			'University of Tasmania<br />'+
			'Churchill Ave, Sandy Bay</div>';
		map.setMapType(G_SATELLITE_MAP);
		map.addControl(new GSmallMapControl());
		 map.addOverlay(marker);
         marker.openInfoWindowHtml(html);
      }
    }

    //]]>
    </script>
<body onLoad="load()" onUnload="GUnload()">
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="left_column">
      <?php include 'inc/box_signup.php'; ?>
    </div>
    <div id="right_column">
      <?php include 'inc/box_flickr.php'; ?>
    </div>
    <div id="three_column">
      <div class="rounded">
          <h1 class="greyheader">TAX DEDUCTABLE DONATIONS</h1>
          <div class="text">
          <p>Edge Radio can always do with a bit of a spit and polish. In fact, with all this radio we make, all those buttons getting pushed every day, our equipment tends to break a lot and need to be replaced. And believe it or not, there are big bucks involved in operating a radio station.</p>
          <p>So if you want to show us some love in the form of cashola, we will collectively do happy dances and then send you a nice receipt because all donations are <strong>tax deductable</strong>.</p>
          <p>You can donate online securely through the PayPal &quot;Donate&quot; button below, OR call the Station Manager on 6226 7273 to talk about carrier pigeons and other forms of money delivery.</p>
 <p><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="3571497">
<span style="margin-top:-5px; line-height:15px;"><strong>Donate using PayPal:</strong></span> 
<input type="image" src="https://www.paypal.com/en_AU/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
</form>
</p>
        </div>
      </div>
      <div id="footer">
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>
