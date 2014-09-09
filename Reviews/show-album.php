<?php 
	session_start();
	
	function role($value,$value2)
	{
		switch ($value)
		{
			case 'F': return("Solo Female"); break;
			case 'M': return("Solo Male"); break;
			case 'G': return(role2($value2)); break;
			default: return("Unknow Act Type"); break;
		}  
	}
	
	function role2($value)
	{
		switch ($value)
		{
			case 'M': return("Group, Male Lead Singer");break;
			case 'F': return("Group, Female Lead Singer");break;
			default: return("Unknown Artist Type");break;
		}
	}

	include("../inc/database.inc.php");
	$result = mysql_query("SELECT * FROM reviews_album where ID='".$_GET['albumid']."'",$db);
	$row = mysql_fetch_assoc($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Album View</title>
<link rel="stylesheet" href="edge.css" type="text/css">
	

</head>

<body bgcolor="#CC0000">



<div align="center">
<?php include("header.inc.htm"); ?>
</div>

<table width="100%" border="0">
	<tr>
		<td bgcolor="#333333"> 
			<div align="center">
				<marquee width="750" height="20" style="font-family: Verdana; font-size: 14px; color: #CC0000" scrollamount="3" scrolldelay="75" align="middle">
					99.3 FM In Hobart, Tasmania &amp; Webstreaming Globally Now Right Here! Click
					The 'Listen' Link To Get Edge Into Your Ears. New Program Schedule Now
					On. Go To The Program Grid To Check It Out. Post A Message To Your
					Favourite Program From The Grid. The 'School Of Rock' Is Coming, Keep
					Listening To Find Out More........
				</marquee>
			</div>
		</td>
	</tr>
</table>


<div align="center">
<table border="0" cellpadding="0" cellspacing="10" height="300">
	<tr>
	<td width="750" class="content">
	<?php include("login.inc.php"); ?>
	</td> 
</tr>
	<tr>
		<td width="750"  align="center" noresize="1" background="http://www.edgeradio.org.au/images/bg.gif" valign="top">			<!-- Main Content Begins here -->
	

	<table cellspacing="0" cellpadding="0" border="0" width="100%">


		<tr height="100%" valign="top">
			<td width="250">
				<table cellspacing="1" cellpadding="0"  border="0" width="100%">
				<tr>
					<td colspan="2" class="row2"><span class="blackbold"><?php echo $row['title']; ?></span>&nbsp;</th>
				</tr>
				<tr>
					<td class="row2" width="60"><span class="blackbold">Atrist</span></td><td class="row1" align="right"><?php echo $row['artist']; ?></td>
				</tr>
				<tr>
					<td class="row2" width="60"><span class="blackbold">Category</span></td><td class="row1" align="right"><?php echo $row['category']; ?></td>
				</tr>
				<tr>
					<td class="row2" width="60"><span class="blackbold">Act Details</span></td>
					<td class="row1" align="right"><?php echo role($row['role1'],$row['role2']); ?> </td>
				</tr>
				<tr>
					<td class="row2" width="60"><span class="blackbold">Label</span></td><td class="row1" align="right"><?php echo $row['label']; ?></td>
				</tr>
				<tr>
					<td class="row2" width="60"><span class="blackbold">Publisher</span></td><td class="row1" align="right"><?php echo $row['publisher']; ?></td>
				</tr>
				<tr>
					<td class="row2" width="60"><span class="blackbold">Australian</span></td><td class="row1" align="right"><?php echo $row['content']; ?></td>
				</tr>
				<tr>
					<td class="row2" width="60"><span class="blackbold">Artist note</span></td><td class="row1" align="right"><?php echo $row['artistnote']; ?></td>
				</tr>
				<tr>
					<td class="row2" width="60"><span class="blackbold">Release Date</span></td><td class="row1" align="right"><?php echo $row['releasedate']; ?></td>
				</tr>
				<tr>
					<td class="row2" width="60"><span class="blackbold">Entered On</span></td><td class="row1" align="right"><?php echo $row['dateadded']; ?></td>
				</tr>
				<?php
					if (isSet($_SESSION['user']))
					{
				?>
					<tr>
						<td class="row2" width="60"><span class="blackbold">Entered By</span></td><td class="row1" align="right"><?php echo $row['enteredby']; ?></td>
					</tr>
					<tr>
						<td class="row2" width="60"><span class="blackbold">Email</span></td><td class="row1" align="right"><?php echo $row['email']; ?></td>
					</tr>
					<tr>
						<td class="row2" width="60"><span class="blackbold">Phone</span></td><td class="row1" align="right"><?php echo $row['phone']; ?></td>
					</tr>
				<?php
					}
				?>
									
				</table>
				<br />
				<table cellpadding="2" cellspacing="1" border="0" bgcolor="#bbbbbb" width="240" align="center">
					<tr valign="top">
						<td width="100%" class="commentsbox" align="center">
						<b>Comments</b> <br />
						<div align="left">
						<?php
						if ($row['comments'] == "")
							echo " There are no comments for this album."; 
						echo $row['comments'];
						?>
						</div>
						</td>
					</tr>
				</table>
					
			</td>
			<td width="500">
			<table cellspacing="1" cellpadding="0"  border="0" width="100%">
			<tr>
				<td class="row2" align="center"><span class="blackbold">Best Tracks</span></td>
			</tr>
			<tr>
				<td>
				<?php
				echo "<iframe src=\"http://www.edgeradio.org.au/Reviews/song-list.php?albumid=".$_GET['albumid']."\" frameborder=\"0\" 
name=\"songlist\" height=\"400\" scrolling=\"auto\" width=\"500\" ></iframe>";
				?>
				</td>
			</tr>
			
			
			</table>
		</td>
	</tr>
	<tr>
				<td colspan="2" class="row2" align="left">
					<a href="./reviews.php"><font class="redbold">Back</font></a>
				</td>
			</tr>	

	</table>	

	<!-- End Of Main Content -->
	<?php include("footer.inc.htm"); ?>


		</td>
		
	</tr>


</table>
</div>
</body>
</html>
