<?php include '../../templates/common_start.php'; ?>
<body>
<script type="text/javascript" src="../../player/anarchy.js"></script>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    <?php include '../sidebar.php'; ?>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
 
 <div class="roundednew">
  <h1 class="title-head-right">Edgecasts</h1>
  
  
   <div class="top_exp">
  <h1>Podcasts Ahoy!</h1>
  <p>Yessss! We're entering the digital age and throwing off our nappies as we do so (c'mon, we're still young). We’re starting off with caution but our podcasts will grow in time - hang in there!</p>
  </div>
</div>
<br />
        
          <?php include '../../inc/database.pod.php';

$sqlBlogger = "SELECT * from tbl_RSS_feeds_cbaa where active = 1 ORDER BY id ASC";
$data = mysql_query($sqlBlogger);
$podcast = mysql_fetch_object($data);
		
		
// run a cursor to loop through all podcasts and update the SQL table
	
		while($podcast != NULL ) {
		
			$podcast_name = $podcast->rss_name;
			$podcast_desc = $podcast->rss_description;
			$podcast_img = $podcast->rss_image;
			$podcast_url = $podcast->rss_url;
			$podcast_id = $podcast->id;
			$podcast_mp3 = $podcast->feed_url;
			$podcast_episode = $podcast->feed_description;
			$podcast_title = $podcast->feed_title;
			$podcast_duration = $podcast->feed_duration;
			$podcast_date = $podcast->feed_date;
			
			?>
			<div class="roundednew">
          <span style="font-size: 44px; line-height: 58px;" class="title"><?php echo $podcast_name; ?></span>
          <p><?php echo $podcast_desc; ?></p>
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td width="100%" valign="top"><hr /><p><strong>Latest Episode:</strong></p>
                <span class="smalltext"><strong><?php echo $podcast_title; ?>: </strong><?php echo $podcast_episode; ?> (<?php echo date("M t, Y", strtotime($podcast_date)); ?>)</span>
                <p class="smalltext"><strong>Listen:</strong> <a href="javascript:popUp('http://www.edgeradio.org.au/player/?podcast=<?php echo $podcast_id; ?>')"><img style="border: 0;" src="http://www.edgeradio.org.au/images/listen-live-i.png"></a> Duration: <?php echo $podcast_duration; ?> minutes.</p><hr />
                <p><strong>Subscribe Feed URL: </strong>http://www.cpod.org.au/feed.php?id=<?php echo $podcast_url; ?><br />
                  <span class="smalltext">Copy and paste the URL into your podcast software to subscribe or you can try to <a href="itpc://www.cpod.org.au/feed.php?id=<?php echo $podcast_url; ?>">subscribe here</a></span>.</p>
                <p><strong>Archive:</strong> Listen to previous episodes <a href="http://www.cpod.org.au/page.php?id=<?php echo $podcast_url; ?>&amp;page_style=edge.css" target="_blank">here</a>.</p></td>
              <td width="200" valign="top"><img src="<?php echo $podcast_img; ?>" alt="<?php echo $podcast_name; ?>" /></td>
            </tr>
          </table>
          </div>
<br />
          <?php	
			$podcast = mysql_fetch_object($data);

} //while ?>

        
        
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>
