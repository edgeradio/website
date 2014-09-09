<?php 
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Album View</title>

<style type="text/css">
	
	A:hover {color: #FF0000; text-decoration: overline}
	A:visited {color: #808080;}
	A:active {color: 808080;}
	A:link {color: #CC0000; text-decoration:underline}
	
	.redlabel{
	font-family: Arial;
	font-weight:bold;
	size:8;
	color:#CC0000;
	}
	
	.content {
	background-image: url("images/bg.gif");
	background-repeat: repeat;
	font-family:Arial;
	font-size:12px;
	}
	
	.menuText {
	font-family:Arial;
	color: #ffffff;
	font-weight:bold;
	text-decoration:underline;
	}
	.menuText:hover {
	text-decoration:overline;
	}
	
	.ldetail {
	background-color: #CCCCCC;
	font-weight:bold;
	}
	
	.rdetail {
	background-color: #EEEEEE;
	
	}
	
	.commentsbox {
	background-color: #FAFAFA;
	}
	
	
	body {
	background-color: #cc0000;
	}
	
</style>	

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
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr height="100%" valign="top">
			<td width="250">
				<table cellspacing="1" cellpadding="0"  border="0" width="100%">
				<tr>
					<th colspan="2" class="ldetail"><?php echo $row['title']; ?>&nbsp;</th>
				</tr>
				<tr>
					<td class="ldetail" width="60">Atrist</td><td class="rdetail" align="right"><?php echo $row['artist']; ?></td>
				</tr>
				<tr>
					<td class="ldetail" width="60">Category</td><td class="rdetail" align="right"><?php echo $row['category']; ?></td>
				</tr>
				<tr>
					<td class="ldetail" width="60">Act Details</td>
					<td class="rdetail" align="right"><?php echo role($row['role1'],$row['role2']); ?> </td>
				</tr>
				<tr>
					<td class="ldetail" width="60">Label</td><td class="rdetail" align="right"><?php echo $row['label']; ?></td>
				</tr>
				<tr>
					<td class="ldetail" width="60">Publisher</td><td class="rdetail" align="right"><?php echo $row['publisher']; ?></td>
				</tr>
				<tr>
					<td class="ldetail" width="60">Australian</td><td class="rdetail" align="right"><?php echo $row['content']; ?></td>
				</tr>
				<tr>
					<td class="ldetail" width="60">Entered On</td><td class="rdetail" align="right"><?php echo $row['dateadded']; ?></td>
				</tr>				
				</table>
				<br />
				<table cellpadding="2" cellspacing="1" border="0" bgcolor="#bbbbbb" width="240" align="center">
					<tr valign="top">
						<td width="100%" class="commentsbox" align="center">
						<b>Comments</b> <br />
						<div align="left">
						<?php 
						echo $row['comments'];
						?>
						</div>
						</td>
					</tr>
				</table>
				<a href="./reviews.php"><b>Back</b></a>	
			</td>
			<td width="500">
			<table cellspacing="1" cellpadding="0"  border="0" width="100%">
			<tr>
				<td class="ldetail" align="center">Best Tracks</td>
			</tr>
			<tr>
				<td>
				<?php
				echo "<iframe src=\"http://www.edgeradio.org.au/reviews/song-list.php?albumid=".$_GET['albumid']."\" frameborder=\"0\" name=\"songlist\" height=\"400\" scrolling=\"auto\" width=\"500\" />";
				?>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>	

	<!-- End Of Main Content -->
	</td>
</tr>
<tr>
	<?php include("footer.inc.htm"); ?>
</tr>
	
</table>



</div>
</body>
</html>
