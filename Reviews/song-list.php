<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Tracks</title>
<style type="text/css">
	
	A:hover {color: #FF0000; text-decoration: overline}
	A:visited {color: #CC0000;}
	A:active {color: 808080;}
	A:link {color: #CC0000; text-decoration:underline}
	
	.ldetail {
	background-color: #CCCCCC;
	font-weight:bold;
	}
	
	.rdetail {
	background-color: #EEEEEE;]
	}
	
	body {
	font-family:Arial;
	font-size:12px;
	}

	td.content {
	background-image: url('imges/bg.gif');
	}


}
</style>
</head>

<body >
<?php
	function remove_space($str)
	{
		$str = str_replace(" ","_", $str);
		return ($str);
	}
	

	
function saveXML($track,$album)
	{
	include "./scripts/minixml.inc.php";
	include "./scripts/utf.inc.php";
	$xmlDoc = new MiniXMLDoc();
	$rawxml = file_get_contents($_SESSION['xmlfile']);
	$utf8xml = utf16_to_utf8($rawxml);
	//$xmlDoc->fromFile('./xml/song.xml');
	$xmlDoc->fromString($utf8xml);

	$xmlDocument =& $xmlDoc->getRoot();
	$xmlRoot =& $xmlDocument->getElement('Selector');
	
  	$temp = split(' ',$album['dateadded']);
  	$dateadded = $temp[0];
  	
	$song =& $xmlRoot->createChild('s:Song');
		$song->attribute('title', $track['title']); //here
		$song->attribute('thirdPartyAudioFileName','');
		$song->attribute('category',$album['category']);  //here
		$song->attribute('level','1');
		$song->attribute('packet','0');
		$song->attribute('percentBack','10'); //here
		if ($track['language'] == "Yes")
			$song->attribute('daypartGrid','003'); //here
		$song->attribute('dateAdded',$dateadded); //here
		$song->attribute('mediaField','');
		$song->attribute('opening','');
		$song->attribute('ending','');
		$song->attribute('alternatePacket','0');
		$song->attribute('alternatePercentBack','100');
		$song->attribute('alternateMediaField','');
		$song->attribute('isCompleteWork','0');
		$song->attribute('lastEditedDate',$dateadded);
		$song->attribute('playsInCategory','0');
		$song->attribute('totalPlays','0');
		$song->attribute('maintenanceFlag','0');
		$song->attribute('comment',''); //here
		$song->attribute('isLive','0');
		$song->attribute('isExternal','0');
		
		
	$codes =& $song->createChild('s:Codes');
		$codes->attribute('role1',$album['role1']); //here
		$codes->attribute('role2',$album['role2']); //here
		$codes->attribute('artistGroup1','');
		$codes->attribute('artistGroup2','');
		$codes->attribute('mood',$track['mood']); //here
		$codes->attribute('energy',$track['energy']); //here
		$codes->attribute('tempo','');
		$codes->attribute('bpm','0');
		$codes->attribute('textureOpen','');
		$codes->attribute('textureClose','');
		$codes->attribute('soundCode1',$track['soundCode1']); //here
		$codes->attribute('soundCode2',$track['soundCode2']); //here
		$codes->attribute('soundCode3',$track['soundCode3']); //here
		$codes->attribute('soundCode4','');
		$codes->attribute('soundCode5','');
		$codes->attribute('opener','');
		$codes->attribute('era','');
		$codes->attribute('type','');
		$codes->attribute('pattern','');
		$codes->attribute('keyIn','');
		$codes->attribute('keyOut','');
	
	
	$additional =& $song->createChild('s:SongAdditional');
		$additional->attribute('additionalArtists','');
		$additional->attribute('composers','');
		$additional->attribute('publisher',$album['publisher']); //here
		$additional->attribute('lyricist','');
		$additional->attribute('isrc','');
		$additional->attribute('arranger','');
		$additional->attribute('license','');
		$additional->attribute('label',$album['label']);  //here
		$additional->attribute('recordNumber','');
		$additional->attribute('promoter','');
		$additional->attribute('country','');
		$additional->attribute('content','');
		$additional->attribute('address','');
		$additional->attribute('radioText','');
		$additional->attribute('barcode','');
	
	$artist =& $song->createChild('s:Artist');
		$artist->attribute('name',remove_space($album['artist']));  //here
		$artist->attribute('country','');
		$artist->attribute('sortName',remove_space($album['artist'])); //here

	$note =& $artist->createChild('n:Note');
		$note->attribute('title',$album['artistnote']);
		$note->attribute('text',''); //here
		$note->attribute('enteredOn',$dateadded); //here
		$note->attribute('duration','0.00');
		$note->attribute('lastEdited',$dateadded); //here
		$note->attribute('comment','');
		$note->attribute('mediaType','text');
		$note->attribute('type','note');

	
	$chart =& $song->createChild('s:Chart');
		$chart->attribute('thisWeek','0');
		$chart->attribute('lastWeek','0');
		$chart->attribute('weeksOn','0');
		$chart->attribute('weeksAtPeak','0');
		$chart->attribute('peakPosition','0');
		$chart->attribute('yearEndRank','0');
		$chart->attribute('peakMonth','0');
		$chart->attribute('peakYear','0');
		$chart->attribute('chartNote','');
		$chart->attribute('chartRotation','');
		$chart->attribute('chartDebutDate',$album['releasedate']);
	
	$albumnode =& $song->createChild('s:Album');
		$albumnode->attribute('title',$album['title']);	//here

	$media =& $song->createChild('m:Media');
		$media->attribute('ID','');	
		$media->attribute('runTime','0.00');	
		$media->attribute('intro1','');	
		$media->attribute('intro2','');	
		$media->attribute('intro3','');	
		$media->attribute('fileName','');	
		$media->attribute('hookStart','');	
		$media->attribute('hookEnd','');	
		$media->attribute('trimStart','0.00');	
		$media->attribute('trimEnd','0.00');	
		$media->attribute('JITA','0');	
		$media->attribute('totalTime','0.00');	
		$media->attribute('earlyNextToPlay','');	
		$media->attribute('linkOverLapNTP','');	
	
	$location =& $media->createChild('m:Location');
		$location->attribute('protocol','unc');

		$xmlString = $xmlDoc->toString();
		
		$xmlutf16 = utf8_to_utf16($xmlString);
		$fh = fopen($_SESSION['xmlfile'], 'w') or die("can't open file");
		fwrite($fh, $xmlutf16);
		fclose($fh);

	}

	include("../inc/database.inc.php");
	
	if($_GET['export'] && $_SESSION['user'])
		{
		
		$query = "select * from reviews_track where ID = '".$_GET['export']."'";

		$result = mysql_query($query,$db);
		$trackInfo = mysql_fetch_assoc($result);
		

		$query= "select * from reviews_album where ID = '".$trackInfo['ALBUM_ID']."'";
		$result = mysql_query($query,$db);
		$albumInfo = mysql_fetch_assoc($result);
		
		
		saveXML($trackInfo,$albumInfo);
		//addsong($_GET['export']);
		if ($_SESSION['user'] != "tristan it dept")
		{
			$query = "UPDATE reviews_track SET selected = 'Yes' WHERE ID = '".$_GET['export']."'";		//update Database here
			mysql_query($query,$db);
			if ($albumInfo['new'] == "Yes")
			{
				
				$query = "UPDATE reviews_album SET new = 'No' WHERE ID = '".$albumInfo['ID']."'";		//update Database here
				$result = mysql_query($query,$db);
			}
				
		}
		}
		
	
	
	$query = "select * from reviews_track where ALBUM_ID = '".$_GET['albumid']."'";

	$r = mysql_query($query,$db);
	


echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"0\" border=\"0\" bgcolor=\"#000000\">";

	while ($row = mysql_fetch_assoc($r))
		{
?>
<tr>
	<td width="100%" >
	
		<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#EEEEEE">
		<tr>
			<td width="67%" class="ldetail"><?php echo $row['title']; ?></td>
			<td align="right" width="33%" class="ldetail">
			<?php
				if ($row['selected'] == "Yes"  && session_is_registered("user") && ($_SESSION['user'] != "tristan it dept"))
					echo "Successfully Exported";
				else
				{
					if ($_SESSION['user'])
					{
					
						echo "<a href=\"song-list.php?albumid=".$_GET['albumid']."&export=".$row['ID']."\">Export</a>";
					}	
				}
			?>
			</td>
		</tr>
		<tr>
			<td width="64%" class="rdetail">Mood: <?php echo $row['mood']; ?></td>
		
			<td width="33%" class="rdetail">Sound Codes</td>
		</tr>
		<tr>
			<td width="64%" class="rdetail">Energy: <?php echo $row['energy']; ?></td>
		
			<td width="33%" class="rdetail"><?php echo $row['soundCode1']; ?></td>
		</tr>
		<tr>
			<td width="33%" class="rdetail">Course Language: <?php echo $row['language']; ?></td>
			<td width="33%" class="rdetail"><?php echo $row['soundCode2']; ?></td>
		</tr>
		</table>
	</td>
</tr>
<?php
	}
?>
</table>



	
			
			
			


</body>
</html>
