<?php
############################################################
# PODCAST GENERATOR
#
# Created by Alberto Betella
# http://podcastgen.sourceforge.net
# 
# This is Free Software released under the GNU/GPL License.
############################################################

########### Security code, avoids cross-site scripting (Register Globals ON)
if (isset($_REQUEST['GLOBALS']) OR isset($_REQUEST['absoluteurl']) OR isset($_REQUEST['amilogged']) OR isset($_REQUEST['theme_path'])) { exit; } 
########### End

$PG_mainbody = NULL; //erase variable which contains episodes data

if (isset($_GET['name']) AND $_GET['name'] != NULL ) {
	$file_multimediale = $_GET['name'];


	if (file_exists("$absoluteurl"."$upload_dir$file_multimediale")) {

		$episode_present = "yes"; //assign presence to episode (recall in themes.php)

		require_once("$absoluteurl"."components/getid3/getid3.php"); //read id3 tags in media files (e.g.title, duration)

		$getID3 = new getID3; //initialize getID3 engine

		//load XML parser for PHP4 or PHP5
		include("$absoluteurl"."components/xmlparser/loadparser.php");


		$file_multimediale = explode(".",$file_multimediale); //divide filename from extension [1]=extension (if there is another point in the filename... it's a problem)


		$fileData = checkFileType($file_multimediale[1],$podcast_filetypes,$filemimetypes);


		if ($fileData != NULL) { //This IF avoids notice error in PHP4 of undefined variable $fileData[0]


			$podcast_filetype = $fileData[0];


			if ($file_multimediale[1]=="$podcast_filetype") { // if the extension is the same as specified in config.php

				$wholeepisodefile = "$absoluteurl"."$upload_dir$file_multimediale[0].$podcast_filetype";


				$file_size = filesize("$wholeepisodefile");
				$file_size = $file_size/1048576;
				$file_size = round($file_size, 2);


				$file_time = filemtime("$wholeepisodefile");

				$filedate = date ("$dateformat", "$file_time");



				############
				$filedescr = "$absoluteurl"."$upload_dir$file_multimediale[0].xml"; //database file

				if (file_exists("$filedescr")) { //if database file exists 


					//$file_contents=NULL; 


					# READ the XML database file and parse the fields
					include("$absoluteurl"."core/readXMLdb.php");


					#Define episode headline
					$episode_date = "<a name=\"$file_multimediale[0]\"></a>
						<a href=\"".$url."download.php?filename=$file_multimediale[0].$podcast_filetype\">
						<img src=\"download.gif\" alt=\"$L_downloadfile $text_title\" title=\"$L_downloadfile $text_title\" border=\"0\" align=\"left\" /></a>&nbsp;$filedate <i>($file_size $L_bytes)</i>";


					# File details (duration, bitrate, etc...)
					$ThisFileInfo = $getID3->analyze("$upload_dir$file_multimediale[0].$podcast_filetype"); //read file tags

					$file_duration = @$ThisFileInfo['playtime_string'];

					if($file_duration!=NULL) { // display file duration
						$episode_details = "$L_duration ";
						$episode_details .= @$ThisFileInfo['playtime_string'];
						$episode_details .= " $L_episode_minutes - $L_episode_filetype ";
						$episode_details .= @$ThisFileInfo['fileformat'];

						if($podcast_filetype=="mp3") { //if mp3 show bitrate &co
							$episode_details .= " - $L_bitrate ";
							$episode_details .= @$ThisFileInfo['bitrate']/1000;
							$episode_details .= " $L_episode_kbps - $L_frequency ";
							$episode_details .= @$ThisFileInfo['audio']['sample_rate'] ;
							$episode_details .= " $L_episode_hz";
						}

					} 


					### Here the output code for the episode is created

					# Fields Legend (parsed from XML):
					# $text_title = episode title
					# $text_shortdesc = short description
					# $text_longdesc = long description
					# $text_imgpg = image (url) associated to episode
					# $text_category1, $text_category2, $text_category3 = categories
					# $text_keywordspg = keywords
					# $text_explicitpg = explicit podcast (yes or no)
					# $text_authornamepg = author's name
					# $text_authoremailpg = author's email

					$PG_mainbody .= 
						'<div class="episode">
						<p class="episode_date">'.$episode_date.'</p>';

					if (isset($episode_details)) {
						$PG_mainbody .= '<p class="episode_info">'.$episode_details.'</p>';
					}

					$PG_mainbody .= '<h3 class="episode_title">'.$text_title;

					if ($podcast_filetype=="mpg" OR $podcast_filetype=="mpeg" OR $podcast_filetype=="mov" OR $podcast_filetype=="mp4" OR $podcast_filetype=="wmv" OR $podcast_filetype=="3gp" OR $podcast_filetype=="mp4" OR $podcast_filetype=="avi" OR $podcast_filetype=="flv" OR $podcast_filetype=="m4v") { // if it is a video

						$PG_mainbody .= '&nbsp;<img src="video.png" alt="'.$L_podcastvideo.'" />';

						$isvideo = "yes"; 

					}

					$PG_mainbody .= '</h3>
						<ul class="episode_imgdesc">';

					if(isset($text_imgpg) AND $text_imgpg!=NULL AND file_exists("$img_dir$text_imgpg")) {

						$PG_mainbody .= "<li><img src=\"http://www.edgeradio.org.au/phpthumb/phpThumb.php?src=../tasmanianmusic/$img_dir$text_imgpg&w=150&fltr[]=ric|30|30&f=jpg\" class=\"episode_image\" alt=\"$text_title\" /></li>";

					}

					if(isset($text_longdesc) AND $text_longdesc!=NULL ) { // if is set long description

						$PG_mainbody .= 
							'<li>'.$text_longdesc;

					} else {

						$PG_mainbody .= 
							'<li>'.$text_shortdesc;	
					}


					if($enablestreaming=="yes" AND $podcast_filetype=="mp3") { // if streaming is enabled show streaming player

						include ("components/player/player.php");
						$PG_mainbody .= '<br /><br />'.$showplayercode; 

					} else {
						$PG_mainbody .= '<br />'; 
					}

					$PG_mainbody .= "<br />";

					if (isset($isvideo) AND $isvideo == "yes") {
						$PG_mainbody .= "<a href=\"".$url.$upload_dir."$file_multimediale[0].$podcast_filetype\" title=\"$L_viewvideo\"><span class=\"episode_download\">$L_view</span></a><span class=\"episode_download\"> - </span>";

						$isvideo = "no"; //so variable is assigned on every cicle

					}

					$PG_mainbody .= "<a href=\"".$url."download.php?filename=$file_multimediale[0].$podcast_filetype\" title=\"$L_donloadthis\"><span class=\"episode_download\">$L_downloadfile</span></a>";

					if ($text_keywordspg != NULL) {
						$PG_mainbody .=	'<p class="episode_keywords"><b>'.$L_episode_keywords.'</b> '.$text_keywordspg.'</p>';
					}


					$PG_mainbody .= "</li>
						</ul>
						</div>";

				} 

			} 

		}

	} else { // if file doesn't exist
	$episode_present = "no"; 

	$PG_mainbody .= '<div class="topseparator"><p>'.$L_dir.' <b>'.$upload_dir.'</b> '.$L_empty.'</p></div>';
}
}
?>