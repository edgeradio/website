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

if (isset($_GET['p']) AND $_GET['p']=="admin" AND isset($_GET['do']) AND $_GET['do']=="edit" AND isset($_GET['c']) AND $_GET['c']=="ok") { 

	$PG_mainbody .= '<h3>'.$L_editpodcast.'</h3>';

	include("$absoluteurl"."core/admin/sendchanges.php");

	$PG_mainbody .= '</div>';

}

else {


	###########

	if (isset($_GET['name']) AND $_GET['name'] != NULL ) {
		$file_multimediale = $_GET['name'];


		if (file_exists("$absoluteurl"."$upload_dir$file_multimediale")) {


			//		require_once("$absoluteurl"."components/getid3/getid3.php"); //read id3 tags in media files (e.g.title, duration)

			//		$getID3 = new getID3; //initialize getID3 engine

			//load XML parser for PHP4 or PHP5
			include("$absoluteurl"."components/xmlparser/loadparser.php");


			$file_multimediale = explode(".",$file_multimediale); //divide filename from extension [1]=extension (if there is another point in the filename... it's a problem)


			$fileData = checkFileType($file_multimediale[1],$podcast_filetypes,$filemimetypes);


			if ($fileData != NULL) { //This IF avoids notice error in PHP4 of undefined variable $fileData[0]


				$podcast_filetype = $fileData[0];


				if ($file_multimediale[1]=="$podcast_filetype") { // if the extension is the same as specified in config.php

					$wholeepisodefile = "$absoluteurl"."$upload_dir$file_multimediale[0].$podcast_filetype";


					//				$file_size = filesize("$wholeepisodefile");
					//				$file_size = $file_size/1048576;
					//				$file_size = round($file_size, 2);


					//				$file_time = filemtime("$wholeepisodefile");

					//				$filedate = date ("$dateformat", "$file_time");



					############
					$filedescr = "$absoluteurl"."$upload_dir$file_multimediale[0].xml"; //database file

					if (file_exists("$filedescr")) { //if database file exists 


						//$file_contents=NULL; 


						# READ the XML database file and parse the fields
						include("$absoluteurl"."core/readXMLdb.php");



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

						#############################


						#### CONTENT DEPURATION (solves problem with quotes etc...)
						$text_title = depurateContent($text_title); //title
						$text_shortdesc = depurateContent($text_shortdesc); //short desc
						$text_longdesc = depurateContent($text_longdesc); //long desc
						$text_keywordspg = depurateContent($text_keywordspg); //Keywords
						$text_authornamepg = depurateContent($text_authornamepg); 

						}	}	}
						#########

						$PG_mainbody .= '<h3>'.$L_editpodcast.'</h3>';

						$PG_mainbody .= '
							<form action="?p=admin&amp;do=edit&amp;c=ok" method="POST" enctype="multipart/form-data" name="uploadform" id="uploadform" onsubmit="return submitForm();">

							<fieldset>
							<legend><b>'.$L_maininfo.'</b></legend>
							<br />

							<input type="hidden" name="userfile" value="'.$_GET['name'].'">

							<label for="userfile">'.$L_filetoedit.'</label><br />
							<p><b>'.$text_title.'</b> ('.$_GET['name'].')</p>';

						$PG_mainbody .= '<br /><br />
							<label for="title">'.$L_title.'*</label><br />
							<input name="title" id="title" type="text" size="50" maxlength="255" value="'.$text_title.'"><br /><br /><br />

							<label for="description">'.$L_shortdesc.'*</label><br />
							<span class ="admin_hints">'.$L_maxchardesc.'</span><br />

							<input name="description" id="description" type="text" onKeyDown="limitText this.form.description,this.form.countdown,255);" 
							onKeyUp="limitText(this.form.description,this.form.countdown,255);" size="50" maxlength="255" value="'.$text_shortdesc.'">
							<br /><br />
							<span class ="admin_hints">
							<input name="countdown" type="text" value="255" class ="admin_hints" size="3" readonly> '.$L_remainchar.'</span> 
							<br /><br />';

						### INCLUDE CATEGORIES FORM
						if ($categoriesenabled == "yes") { // if categories are enabled in config.php

							include("$absoluteurl"."core/admin/showcat.php");

						} 
						//else { // if categories are disabled, then use an empty value
							//$PG_mainbody .= '<input type="hidden" name="category[0]" value="">';
							//	}

							### END CATEGORIES FORM

							$PG_mainbody .= $L_fieldsrequired.'
								</fieldset>
								';

							$PG_mainbody .= '


								<br />
								<div id="main"> 

								<fieldset>
								<legend><b>'.$L_extrainfo.'</b></legend>

								<label for="long_description">'.$L_longdesc.'</label> <span class ="admin_hints">'.$L_htmlaccepted.'</span><br /><br />

								<textarea id="long_description" name="long_description" cols="50" rows="3">'.$text_longdesc.'</textarea>
								<br /><br />



								';

							$fileimagetocheck = "$absoluteurl"."$img_dir$text_imgpg";

							if (file_exists($fileimagetocheck) AND $text_imgpg != NULL) { // if image exists
								
								$PG_mainbody .= '
								
								<input type="hidden" name="existentimage" value="'.$text_imgpg.'">
								
								<label for="image">'.$L_image.'</label><br /><br />'.$L_imagecurrent.'<br /><img src="'.$url.$img_dir.$text_imgpg.'" alt="'.$L_imagecurrent.'" /><br />

									'.$L_imagenew.'<br />	
									<span class ="admin_hints">'.$L_imagenewhint.'</span><br />
									<span class ="admin_hints">'.$L_imageformat.'</span><br /><br />
									<input name="image" type="file">
									<br />	

									';
							}	else { // if image doesn't exist

							$PG_mainbody .= '<label for="image">'.$L_image.'</label><br />

								<span class ="admin_hints">'.$L_imagehint.'</span><br />
								<span class ="admin_hints">'.$L_imageformat.'</span><br /><br />
					
					<input name="image" type="file">
								<br />
								';
						} 


						$PG_mainbody .= '
							<br /><br /><br />

							<label for="keywords">'.$L_itunes_keywords.'</label><br />
							<span class ="admin_hints">'.$L_separatekeywords.'</span><br /><br />
							<input name="keywords" type="text" onkeyup="cnt(this,document.uploadform.counttotalwords)" size="50" maxlength="255" value="'.$text_keywordspg.'"><br />
							<span class ="admin_hints"><input type="text" name="counttotalwords" class ="admin_hints" value="0" size="3" onkeyup="cnt(document.uploadform.keywords,this)" readonly> '.$L_words.'</span>
							<br /><br /><br />


							<label for="explicit">'.$L_explicitcontent.'</label><br />
							<span class ="admin_hints">'.$L_explicithint.'</span><br /><br />
							'.$L_yes.'<input type="radio" name="explicit" value="yes"';

						if ($text_explicitpg == "yes") {
							$PG_mainbody .= ' checked';	
						}

						$PG_mainbody .=	'>&nbsp;'.$L_no.'<input type="radio" name="explicit" value="no"';
						if ($text_explicitpg != "yes") {
							$PG_mainbody .= ' checked';	
						}
						$PG_mainbody .= '>
							<br /><br /><br />


							'.$L_author.'<br />
							<span class ="admin_hints">'.$L_authorhint.'</span><br /><br />

							<label for="auth_name">'.$L_authorname.'</label><br />
							<input name="auth_name" type="text" id="auth_name" size="50" maxlength="255" value="'.$text_authornamepg.'">
							<br /><br />

							<label for="auth_email">'.$L_authoremail.'</label><br />
							<input name="auth_email" type="text" id="auth_email" size="50" maxlength="255" value="'.$text_authoremailpg.'">

							</fieldset>
							<br /></div>

							<input type="submit" value="'.$L_send.'" onClick="showNotify(\''.$L_uploading.'\');">
							<br /><br /><br /><br />

							</form>

							';

						$PG_mainbody .= '</div>';
						}	}				

					} // end else . if GET variable "c" is not = "ok"

?>