<?php

	#################################################################
	# Podcast Generator
	# http://podcastgen.sourceforge.net
	# developed by Alberto Betella
	#
	# Config.php file created automatically - v.1.3


	$podcastgen_version = "1.3"; // Version

	$scriptlang = "en";

	$url = "http://www.edgeradio.org.au/tasmanianmusic/"; // Complete URL of the script (Trailing slash REQUIRED)

	$absoluteurl = "/home/edge/public_html/tasmanianmusic/"; // Absolute path on the server (Trailing slash REQUIRED)

	$theme_path = "themes/edge/";

	$username = "edge";

	$userpassword = "d42a60670f4aec0884116491aab732cc";

	$max_upload_form_size = "104857600"; //e.g.: "30000000" (about 30MB)

	$upload_dir = "media/"; // "media/" the default folder (Trailing slash required). Set chmod 755

	$img_dir = "images/";  // (Trailing slash required). Set chmod 755

	$feed_dir = ""; // Where to create feed.xml (empty value = root directory). Set chmod 755

	$max_recent = 20; // How many file to show in the home page

	$recent_episode_in_feed = "All"; // How many file to show in the XML feed (1,2,5 etc.. or "All")

	$episodeperpage = 10;

	$enablestreaming = "yes"; // Enable mp3 streaming? ("yes" or "no")

	$streamingplayercolor = "grey";

	$dateformat = "d-m-Y"; // d-m-Y OR m-d-Y OR Y-m-d 

	$freebox = "yes"; // enable freely customizable box

	$enablehelphints = "yes";

	$enablepgnewsinadmin = "no";

	$strictfilenamepolicy = "yes"; // strictly rename files (just characters A to Z and numbers) 

	$categoriesenabled = "no";


	###################
	# XML Feed elements
	# The followings specifications will be included in your podcast "feed.xml" file.


	$podcast_title = "Tasmanian Music Downloads";

	$podcast_subtitle = "Edge Radio - Supporting Tassie Music Twenty-Four-Seven";

	$podcast_description = "Here at Edge Radio we luuurve supporting Tasmanian artists. So much so that we're making it even easier for you to get your hands on fresh Tasmanian tracks, straight from us to you. Here you'll find our feature tracks available for you to download this month, for free.

Get some Tassie music onto your player. If you like it, request the artist on Edge Radio, or better yet, go check out the band online, at a local gig, or buy their album. 

Subscribe to our downloads and they'll magically appear as soon as we upload a new one. Amazing!";

	$author_name = "Edge Radio"; 

	$author_email = "web@edgeradio.org.au"; 

	$itunes_category[0] = "Arts"; // iTunes categories (mainCategory:subcategory)
	$itunes_category[1] = "";
	$itunes_category[2] = "";

	$link = $url."?p=episode&amp;name="; // permalink URL of single episode (appears in the <link> and <guid> tags in the feed)

	$feed_language = "en"; // Language used in the XML feed (can differ from the script language).

	$copyright = "Your copyright notice"; // Copyright notice

	$feed_encoding = "utf-8"; // Feed Encoding (e.g. "iso-8859-1", "utf-8"). UTF-8 is strongly suggested

	$explicit_podcast = "no"; //does your podcast contain explicit language? ("yes", "no" or "clean")

	// END OF CONFIGURATION

	?>