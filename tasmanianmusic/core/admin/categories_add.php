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

### Check if user is logged ###
	if ($amilogged != "true") { exit; }
###

$PG_mainbody .= '<h3>'.$L_addacat.'</h3>';

include ("$absoluteurl"."components/xmlparser/loadparser.php");
include ("$absoluteurl"."core/admin/readXMLcategories.php");

// define variables
$arrdesc = NULL;
$arrid = NULL;
$isduplicated = NULL;

$n = 0; // counter

$add = $_POST['addcategory']; // variable

// Depurate input
$add = stripslashes($add);
$add = htmlspecialchars($add);
$add = depurateContent($add);


if ($add != NULL and $add != "all") { /// 000


	// create unique and depurated id from the description (using the function renamefilestrict)
	$id = renamefilestrict ($add);


	//parse
	if (isset($parser->document->category)) {
		foreach($parser->document->category as $singlecategory)
		{
			// echo $singlecategory->id[0]->tagData."<br>";
			// echo $singlecategory->description[0]->tagData;
			// echo "<br><br>";

			if ($id != ($singlecategory->id[0]->tagData)) { // if the id of the new category is different from the ids already present in the XML file 

				// put into the array 
				//(yeah yeah I know I'm using arrays instead of XML commands... but I thought this solution, and it works...). If you have a more elegant solution (e.g. PHP native XML commands), please re-code this file and send your work to me under GPL license: beta@yellowjug.com (PS. your solution should work perfectly either with PHP 4 and 5, otherwise I won't be able to include it in the new releases of podcast generator)

			$arrdesc[] .= htmlspecialchars($singlecategory->description[0]->tagData); // Encode special characters - Thanks to Garrett Vogenbeck for this fix
				$arrid[] .= $singlecategory->id[0]->tagData;

			}
			else { // if ID already present in XML

				$isduplicated = "yes"; // assign duplicated label

			}


			$n++; //increment count
		}
	}


	if ($isduplicated != "yes") { // 001 if new category doesn't exist yet
	$arrdesc[] .= $add; //Description



	$arrid[] .= $id; // create Id

	//echo "<br>tot elementi $n<BR>";



	$xmlfiletocreate = '<?xml version="1.0" encoding="'.$feed_encoding.'"?>
	<PodcastGenerator>';

	foreach ($arrdesc as $key => $val) {
		// echo "cat[" . $key . "] = " . $val . "<br>";
		// echo $key."<br>";



		$xmlfiletocreate .= '
			<category>
			<id>'.$arrid[$key].'</id>
			<description>'.$val.'</description>
			</category>';
	}


	$xmlfiletocreate .= '
		</PodcastGenerator>';

	/////////////////////
	// WRITE THE XML FILE
	$fp = fopen("categories.xml",'w+'); //open desc file or create it

	fwrite($fp,$xmlfiletocreate);

	fclose($fp);

	$PG_mainbody .= '<p>'.$L_newcat.' <i>'.$val.'</i></p>';

	$PG_mainbody .= '<p><b>'.$L_catadded.'</b></p><p><a href="?p=admin&do=categories">'.$L_catgotomanagement.'</a>';

} // 001 end 

else { //if new category already exists

	$PG_mainbody .= $L_cat_exists.'<br /><br />
		<form>
		<INPUT TYPE="button" VALUE='.$L_back.' onClick="history.back()">
		</form>';

}

} // 000
else { // if POST is empty or is = to the word "all", which is already taken to show all podcasts


$PG_mainbody .= $L_writecatname.'
	<br /><br />
	<form>
	<INPUT TYPE="button" VALUE='.$L_back.' onClick="history.back()">
	</form>';


}


?>