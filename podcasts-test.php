<?php include 'inc/common_start.php'; ?>
<body>
<script type="text/javascript" src="player/anarchy.js"></script>
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="left_column">
      <?php include 'inc/box_supporter.php'; ?>
    </div>
    <div id="right_column">
      <?php include 'inc/box_flickr.php'; ?>
    </div>
    <div id="three_column">
      <div class="rounded">
        <div class="text">
          <h1 class="greyheader">Edgecasts</h1>
          <p>Yessss! We’re entering the digital age and throwing off our nappies as we do so (c’mon, we’re still young). We’re starting off with caution but our podcasts will grow in time – hang in there!</p>
          <p><strong>What’s an Edgecast?</strong> <br />
            It’s all about media on demand baby! You can take any of these little nuggets of audio, download them and pop them on your mp3 player to listen to at your leisure.</p>
          <p><strong>Subscribe?</strong><br />
            Yup, easier to get a digital monkey to do the hard work. Just enter the feed URL into a program like iTunes, or any other podcast grabber, and wheeeeeeee it’ll snap them up as soon as we launch them into cyberspace.</p>



<?php

	$content = file_get_contents('http://www.cpod.org.au/feed.php?id=152');
	
	$x = new SimpleXmlElement($content);
	
	echo "<ul>";
	
	foreach($x->channel->item as $entry) {
		echo "
		<li>
		  <a href='$entry->feed_url' title='$entry->title'>" . $entry->title . "</a>
		</li>";
		}
	echo "</ul>";
?>





        </div>
        <div id="footer">
          <?php include 'inc/footer.php'; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>
