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
    <div style="background-image: url(images/edgecasts.jpg); height: 150px;" class="rounded">
    </div>
    <br>
      <div class="rounded">
        <div class="text">
          <h1 class="greyheader">Edgecasts</h1>
          <p>Yessss! We’re entering the digital age and throwing off our nappies as we do so (c’mon, we’re still young). We’re starting off with caution but our podcasts will grow in time – hang in there!</p>
          <p><strong>What’s an Edgecast?</strong> <br />
            It’s all about media on demand baby! You can take any of these little nuggets of audio, download them and pop them on your mp3 player to listen to at your leisure.</p>
          <p><strong>Subscribe?</strong><br />
            Yup, easier to get a digital monkey to do the hard work. Just enter the feed URL into a program like iTunes, or any other podcast grabber, and wheeeeeeee it’ll snap them up as soon as we launch them into cyberspace.</p>
          <?php include 'inc/database.pod.php';

$sqlBlogger = "SELECT * from tbl_RSS_feeds_cbaa where active = 1 ORDER BY id ASC";
$data = mysql_query($sqlBlogger);
$podcast = mysql_fetch_object($data);
		
		
// run a cursor to loop through all podcasts and update the SQL table
	
		while($podcast != NULL ) {
		
			$podcast_name = $podcast->rss_name;
			$podcast_desc = $podcast->rss_description;
			$podcast_img = $podcast->rss_image;
			$podcast_id = $podcast->rss_url;
			$podcast_mp3 = $podcast->feed_url;
			$podcast_episode = $podcast->feed_description;
			$podcast_title = $podcast->feed_title;
			$podcast_duration = $podcast->feed_duration;
			$podcast_date = $podcast->feed_date;
			
			?>
          <h1 class="greyheader"><?php echo $podcast_name; ?></h1>
          <p><?php echo $podcast_desc; ?></p>
          <table width="489" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td width="269" valign="top"><hr /><p><strong>Latest Episode:</strong></p>
                <span class="smalltext"><strong><?php echo $podcast_title; ?>: </strong><?php echo $podcast_episode; ?> (<?php echo date("M t, Y", strtotime($podcast_date)); ?>)</span>
                <p class="smalltext"><strong>Listen:</strong> <a href="<?php echo $podcast_mp3; ?>.mp3"></a> Duration: <?php echo $podcast_duration; ?> minutes.</p><hr />
                <p><strong>Subscribe Feed URL: </strong>http://www.cpod.org.au/feed.php?id=<?php echo $podcast_id; ?><br />
                  <span class="smalltext">Copy and paste the URL into your podcast software to subscribe or you can try to <a href="itpc://www.cpod.org.au/feed.php?id=<?php echo $podcast_id; ?>">subscribe here</a></span>.</p>
                <p><strong>Archive:</strong> Listen to previous episodes <a href="http://www.cpod.org.au/page.php?id=<?php echo $podcast_id; ?>&amp;page_style=edge.css" target="_blank">here</a>.</p></td>
              <td width="200" valign="top"><img src="<?php echo $podcast_img; ?>" alt="<?php echo $podcast_name; ?>" /></td>
            </tr>
          </table>
          <?php	
			$podcast = mysql_fetch_object($data);

} //while ?>

        </div>
        <div id="footer">
          <?php include 'inc/footer.php'; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>
