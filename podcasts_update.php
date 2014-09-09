<?php
/*
updatepods.php - 2009-03-16: glopata

				Updates RSS Podcasts using magpie. Inteded to be used via a cron job.



*/

include 'inc/database.pod.php';


// set the currDay for database update
 	$currDay = getdate();
	$currDayFormatted = $currDay[year] . '-' . $currDay[mon] . '-' . $currDay[mday] . ' '. $currDay[hours] . ':' . $currDay[minutes];


	
	// UPDATE PODCASTS
	
	
echo "<h1>Edge Radio - Update Podcasts</h1><br>";
echo "This script will update all podcasts. For queries contact web@edgeradio.org.au<br><br>";


require_once('php/magpie/rss_fetch.inc');

// turn off caching, doesn't work on cron job for JOY hosting provider.
	
	define('MAGPIE_CACHE_ON', 0);

// grab list of active podcasts

		$sqlBlogger = "SELECT id, rss_name, rss_url from tbl_RSS_feeds_cbaa where active = 1";

			
		$data = mysql_query($sqlBlogger);
		
		$pointer = mysql_fetch_object($data);

// run a cursor to loop through all podcasts and update the SQL table
	
		while($pointer != NULL ) {
		
			$pointURL = "http://www.cpod.org.au/feed.php?id=" . $pointer->rss_url;
			$pointID = $pointer->id;

			$rss = fetch_rss($pointURL);
			
// when $rss is false there was an error with the feed, don't update the sql table
			
			if ($rss) {
		
			$items = array_slice($rss->items, 0, 1);

			foreach ( $items as $item ) {

				$rssLink = $item['guid'];
				$rssTitle = htmlentities(strip_tags($item['title'], "<br>"), ENT_QUOTES);
				$rssDate = getDate(strtotime($item['pubdate']));
				$rssDateFormatted = $rssDate[year] . '-' . $rssDate[mon] . '-' . $rssDate[mday] . ' '. $rssDate[hours] . ':' . $rssDate[minutes];
				$rssDuration = $item['itunes']['duration'];
				$rssDescription = htmlentities(strip_tags($item['description'], "<br>"), ENT_QUOTES);
				$rssDescription = str_ireplace("'", "", $rssDescription);
				
		 		 		} //foreach
		 
		 		$sqlUpdate = " UPDATE tbl_RSS_feeds_cbaa set feed_url = '" . 
								$rssLink . "', feed_title = '" .
								$rssTitle . "', feed_description = '" .
								$rssDescription . "', feed_date = '". $rssDateFormatted 
								. "', feed_duration = '". $rssDuration
								. "', updated = '". $currDayFormatted 											
								. "' where id = " . $pointID ;
// Debug echo								
			
			if ($rssTitle != ''){
			
			echo "Execute: " . $sqlUpdate . "<br><br>" ; 
			
				$insert = mysql_query($sqlUpdate);
				$rssTitle = '';

		} else {
				echo "No podcasts available at " . $pointURL . ".<br><br>"; }

			} else  { 
			
				echo "Skipped item, timed out or error occurred.<br><br> "; }
			
	
				
// get the next cursor item
		
			$pointer = mysql_fetch_object($data);
			
			
// deal with memory leak, a known prob with simplepie and magpie
		
		if ($feed !== NULL) { 
		$feed->__destruct(); 
		$feed = NULL; 

		} 
			
			
	} //while
								
		 
	
	
	// END UPDATE PODCASTS
	

	?>
 