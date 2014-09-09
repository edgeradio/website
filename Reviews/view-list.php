<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
		if (!isSet($_SESSION['exportlist']))
		{
			echo "You must be logged in to use this page";
			die();
		}
		
		if (sizeOf($_SESSION['exportlist']) == 0)
		{
			echo "No tracks have been added";
		}else
		{
			for ($i=0;$i<=sizeOf($_SESSION['exportlist']);$i++)
			{
				echo $_SESSION['exportlist'][$i];
				echo "<br />";
			}
		}
	?>
		

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
