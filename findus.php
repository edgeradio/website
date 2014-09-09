<?php include 'inc/common_start.php'; ?>
<body onload="load()" onunload="GUnload()">
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
        <div class="text">
          <h1 class="greyheader">How do I get to Edge Radio?</h1>
          <p><strong>The Edge Radio studio is located at:</strong></p>
          <p>Room 207<br />
            Arts Building<br />
            University of Tasmania<br />
            Churchill Ave, Sandy Bay</p>
          <p><strong>Below is a map of how to get to the Sandy Bay UTAS Campus<br />
            </strong></p>
          <div id="map" style="width:490px;height:350px"></div>
          <p><strong>Below is a map of how to get to our studio</strong></p>
          <p>Walk down the path and through the Alcove to Room 207.</p>
          <p><img src="images/edge_map.jpg" alt="Edge Studio Map" width="490" height="389" border="0" /></p>
          <p><strong>Public Transport</strong></p>
          <p>We suggest you catch a Metro Bus and get off at stop E or D. <a href="http://www.metrotas.com.au/attachments/hobart/Timetable%20-%20Sandy%20Bay%20-%20Web.pdf" target="_blank">Here’s a timetable</a> to get you started.</p>
          <p><br />
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
