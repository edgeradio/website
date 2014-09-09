<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Album View</title>
<link rel="stylesheet" href="http://www.edgeradio.org.au/include/edge.css" type="text/css">

</head>

<body >


<div align="center">
<table cellpadding="" cellspacing="10" border="0" width="750">
<tr valign="top">
	<td width="100%">
	<?php include("header.inc.htm"); ?>
	</td>
</tr>
<tr>
	<td bgcolor="#333333"> 
		<div align="center">
			<marquee width="100%" height="20" style="font-family: Verdana; font-size: 14px; color: #CC0000" scrollamount="3" scrolldelay="75" align="middle">
				99.3 FM In Hobart, Tasmania &amp; Webstreaming Globally Now Right Here! Click
				The 'Listen' Link To Get Edge Into Your Ears. New Program Schedule Now
				On. Go To The Program Grid To Check It Out. Post A Message To Your
				Favourite Program From The Grid. The 'School Of Rock' Is Coming, Keep
				Listening To Find Out More........
			</marquee>
		</div>
	</td>
</tr>
<tr>
	<td width="100%">
	<?php include("login.inc.php"); ?>
	</td> 
</tr>
<tr height="200" valign="top">
	<td width="100%" class="content">
	<!-- Main Content Begins here -->
	<?php
	if (!session_is_registered('xmlfile'))
	{
		echo "You arn't logged in";
		die();
	}


	$tempXML = new MiniXMLDoc();
	$rawxml = file_get_contents($_SESSION['xmlfile']);
	$utf8xml = utf16_to_utf8($rawxml);
	$tempXML->fromString($utf8xml);

	$xmlRoot =& $tempXML->getElement('Selector');

	$songs =& $xmlRoot->getAllChildren();
	$songCount = sizeOf($songs);


	if (isSet($_GET['del']) && ($songCount == $_GET['max']))
	{
		$del = $_GET['del'];		
		
	$xmlRoot->removeChild($songs[$del]);

	
		$xmlString = $xmlRoot->toString();
		echo $xmlString;
		$xmlutf16 = utf8_to_utf16($xmlString);
		$fh = fopen($_SESSION['xmlfile'], 'w') or die("can't open file");
		fwrite($fh, $xmlutf16);
		fclose($fh);

		$songs =& $xmlRoot->getAllChildren();
		$songCount = sizeOf($songs);
	}
	?>	
	<table cellspacing="1" cellpadding="0"  border="0" width="500" align="left">
	<tr>
		<td colspan="4" class = "row2" align="left">
			There are <span class="redbold"><?php echo $songCount; ?></span> songs in this list.
		</td>
		</tr><tr>
		<td class="row1" align="left">
			Song Title
		</td>
		<td class="row1" align="left">
			Album
		</td>
		<td class="row1" align="left">
			Artist
		</td>
		<td class="row1" align="left">
		</td>
	</tr>
	<?php
		for($i = 0;$i < $songCount; $i++ )
		{
			echo "<tr>";
			echo "<td class=\"row1\" align=\"left\">";
				echo $songs[$i]->attribute('title');
			echo "</td>";

			echo "<td class=\"row2\" align=\"left\">";
				$temp = $songs[$i]->getElement('s:Album');
				echo $temp->attribute('title');
			echo "</td>";

			echo "<td class=\"row2\" align=\"left\">";
				$temp = $songs[$i]->getElement('s:Artist');
				echo $temp->attribute('name');
			echo "</td>";

			echo "<td class=\"row2\" align=\"right\">";
				echo "<a href=\"tempxml.php?del=$i&max=$songCount\">Remove</a>";
			echo "</td>";



			echo "</tr>";
		}
	?>
	<tr>
		<td colspan="4" class="row2" align="left">
			<a href="reviews.php"><span class="redbold">Back</a>
		</td>
	</tr>
	</table>
			



		

	<!-- End Of Main Content -->
	</td>
</tr>
<tr>
	<?php //include("footer.inc.htm"); ?>
</tr>
	
</table>



</div>
</body>
</html>
