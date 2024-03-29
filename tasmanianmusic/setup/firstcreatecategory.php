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

if (file_exists("../categories.xml")) { //if categories already exist stop the script

	echo "<font color=\"red\">$SL_catexist</font><br />";


} else { // else create "categories.xml" file in the root dir

// take the localized $SL_uncategorized variable in setup_LANGUAGE, depurate it and generate a unique id to use in the categories.xml file generated

$idcat = stripslashes($SL_uncategorized); 
$idcat = htmlspecialchars($idcat);
$idcat = depurateContent($idcat); // category name (external)
$id = renamefilestrict ($idcat); // category id generated (internal)


$categoriesfiletocreate = '<?xml version="1.0" encoding="utf-8"?>
<PodcastGenerator>
	<category>
	<id>'.$id.'</id>
	<description>'.$idcat.'</description>
	</category>
	</PodcastGenerator>';

$createcatf = fopen("$absoluteurl"."categories.xml",'w'); //create categories file
fwrite($createcatf,$categoriesfiletocreate); //write content into the file
fclose($createcatf);

}

?>