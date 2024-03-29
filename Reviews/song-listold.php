<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Song List</title>
</head>

<body>
<table width="495" cellspacing="5" cellpadding="5" border="0">

<?php
	
	function saveXML($track,$album)
	{
	include "./scripts/minixml.inc.php";
	include "./scripts/utf.inc.php";
	$xmlDoc = new MiniXMLDoc();
	$rawxml = file_get_contents('./xml/song.xml');
	$utf8xml = utf16_to_utf8($rawxml);
	//$xmlDoc->fromFile('./xml/song.xml');
	$xmlDoc->fromString($utf8xml);

	$xmlDocument =& $xmlDoc->getRoot();
	$xmlRoot =& $xmlDocument->getElement('Selector');
	
  	$temp = split(' ',$album['dateadded']);
  	$dateadded = $temp[0];
  	
	$song =& $xmlRoot->createChild('s:Song');
		$song->attribute('title', $track['title']); //here
		$song->attribute('ID',$track['ID']);
		$song->attribute('internalID','');
		$song->attribute('thirdPartyAudioFileName','');
		$song->attribute('category',$album['category']);  //here
		$song->attribute('level','');
		$song->attribute('packet','');
		$song->attribute('percentBack','10'); //here
		if ($track['language'] == "Yes")
			$song->attribute('daypartGrid','003'); //here
		$song->attribute('dateAdded',$dateadded); //here
		$song->attribute('mediaField','');
		$song->attribute('opening','');
		$song->attribute('ending','');
		$song->attribute('alternatePacket','');
		$song->attribute('alternatePercentBack','');
		$song->attribute('alternateMediaField','');
		$song->attribute('isCompleteWork','');
		$song->attribute('lastPlayDate','');
		$song->attribute('lastPlayTime','');
		$song->attribute('lastEditedDate','');
		$song->attribute('enteredCategory','');
		$song->attribute('playsInCategory','');
		$song->attribute('totalPlays','');
		$song->attribute('maintenanceFlag','');
		$song->attribute('comment',''); //here
		$song->attribute('isLive','');
		$song->attribute('isExternal','');
		
		
	$codes =& $song->createChild('s:Codes');
		$codes->attribute('role1',$album['role1']); //here
		$codes->attribute('role2',$album['role2']); //here
		$codes->attribute('artistGroup1','');
		$codes->attribute('artistGroup2','');
		$codes->attribute('mood',$track['mood']); //here
		$codes->attribute('energy',$track['energy']); //here
		$codes->attribute('tempo','');
		$codes->attribute('bpm','');
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
		$artist->attribute('name',$album['artist']);  //here
		$artist->attribute('country','');
		$artist->attribute('sequenceNumber','');
		$artist->attribute('internalID','');
		$artist->attribute('sortName','');
	
	$chart =& $song->createChild('s:Chart');
		$chart->attribute('thisWeek','');
		$chart->attribute('lastWeek','');
		$chart->attribute('weeksOn','');
		$chart->attribute('weeksAtPeak','');
		$chart->attribute('peakPosition','');
		$chart->attribute('yearEndRank','');
		$chart->attribute('peakMonth','');
		$chart->attribute('peakYear','');
		$chart->attribute('chartNote','');
		$chart->attribute('chartRotation','');
	
	$albumnode =& $song->createChild('s:Album');
		$albumnode->attribute('title',$album['title']);	//here

	$media =& $song->createChild('m:Media');
		$media->attribute('ID','');	
		$media->attribute('runTime','');	
		$media->attribute('intro1','');	
		$media->attribute('intro2','');	
		$media->attribute('intro3','');	
		$media->attribute('fileName','');	
		$media->attribute('hookStart','');	
		$media->attribute('hookEnd','');	
		$media->attribute('trimStart','');	
		$media->attribute('trimEnd','');	
		$media->attribute('JITA','');	
		$media->attribute('totalTime','');	
		$media->attribute('earlyNextToPlay','');	
		$media->attribute('linkOverLapNTP','');	
	
	$location =& $media->createChild('m:Location');
		$location->attribute('protocol','');
		$location->attribute('path','');

		$xmlString = $xmlDoc->toString();
		
		$xmlutf16 = utf8_to_utf16($xmlString);
		
		$fh = fopen('./xml/song.xml', 'w') or die("can't open file");
		fwrite($fh, $xmlutf16);
		fclose($fh);

	}
	
	
	if (!$_GET['albumid'])
	{
		echo "Error: Invalid Album ID";
	}
	else
	{
		include "../inc/database.inc.php";
		
		if($_GET['export'])
		{
		$query = "select * from reviews_track where ID = '".$_GET['export']."'";

		$result = mysql_query($query,$db);
		$trackInfo = mysql_fetch_assoc($result);
		

		$query= "select * from reviews_album where ID = '".$trackInfo['ALBUM_ID']."'";
		$result = mysql_query($query,$db);
		$albumInfo = mysql_fetch_assoc($result);
		
		//check for errors here!!!!
		
		//should return false if there were errors
		saveXML($trackInfo,$albumInfo);
		
		$query = "UPDATE reviews_track SET selected = 'Yes' WHERE ID = '".$_GET['export']."'";		//update Database here
		echo $query;
		mysql_query($query,$db);
		}
		
		$id = $_GET['albumid'];
		
		$query = "select * from reviews_track where ALBUM_ID = '$id'";
		$result = mysql_query($query,$db);
		
		
		echo "<table width=\"495\" cellspacing=\"5\" cellpadding=\"5\" border=\"0\">";
		while ($row = mysql_fetch_assoc($result))
		{
			echo "<tr>
				<td width=\"100%\">
					<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"5\" bgcolor=\"#EEEEEE\">
					";
			echo "<tr height=\"8\">
				<td width=\"67%\" bgcolor=\"#CCCCCC\">
					<b>Song: </b>";
			echo $row['title'];
			echo "</td><td align=\"right\" width=\"33%\" bgcolor=\"#CCCCCC\">";
			//echo "<input type=\"checkbox\" value=\"". $row['ID']."\" name=\"trackCheck\" />";
			switch ($row['selected'])
			{
				case "Yes": echo "Successfully Exported";break;
				case "No": echo "<a href=\"songlist.php?albumid=$id&export=".$row['ID']."\" target=\"songlist\">Export XML</a>"; break;
				default: echo "Error!";
			}
			echo "</td></tr><tr><td width=\"64%\"  valign=\"top\">";
			echo "<b>Mood:</b> ". $row['mood']."<br />";
			echo "<b>Energy:</b>". $row['energy']."<br />";
			echo "<b>Course Language:</b>". $row['language']."<br />";
			echo "</td><td width=\"33%\"><b>Genre Information</b><br />";
			echo $row['soundCode1']." <br />";
			echo $row['soundCode2']." <br />";
			echo $row['soundCode3']." <br />";
			echo "</td></tr></table></td></tr>";
		}
		
		
	}
?>	
			
			
			

</table>
</body>
