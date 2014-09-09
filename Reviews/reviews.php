<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Album View</title>
<link rel="stylesheet" href="edge.css" type="text/css">
	

</head>

<body >

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
<tr height="200" valign="top">
	<td width="750" class="content">
	<!-- Main Content Begins here -->
	<div align="center">


	<?php
	
	function shrinkComments($value)
	{
		if (strlen($value) < 200) return($value);
		$rest = substr($value,0,200);
		$rest .= "...";
		return($rest);
	}






	echo "<div align='right'>";
	echo "<b>";
	echo "<form method=\"GET\" action=\"reviews.php\" style=\"margin-bottom: 0\">";
   	echo "Search Reviews <input type=\"text\" name=\"s\" value=\"".$s."\" size=\"20\"><input type=\"hidden\" name=\"p\" value=\"1\"><input type=\"submit\" value=\"Search\" name=\"submit\">";
   	echo " Entries per page ";
   	echo "<select size=\"1\" name=\"v\">";
   	echo "<option selected>20</option>
        <option>40</option>
        <option>50</option>
        <option>100</option>";

   	echo "</select></form></b>";
	echo "</div>";
	function displayResults($query,$page,$view,$search,$dbs)
	{
				
		$limit = "LIMIT ".($page*$view-$view).", ". "$view";
		$lquery = $query." ".$limit;
		$result = mysql_query($lquery,$dbs);
	 	echo "<table width=\"100%\" cellpadding=\"1\" celspacing=\"1\">";
	 	echo "<td class=\"row2\" align=\"left\" width=\"33%\"><b> Artist </b></td><td align=\"left\" class=\"row2\" width=\"33%\"><b> Album </b></td><td align=\"left\"class=\"row2\" width=\"34%\"><b> Comments </b></td>";
	 	$count = 0;
	 	while ($row = mysql_fetch_assoc($result)) 
    	{
    		$count += 1;
    		if ($count%2 == 0)
    			echo "<tr align=\"left\" class=\"row1\">";
    		else
    			echo "<tr align=\left\" class=\"content\">";
    			
    		echo "<td align=\"left\" valign=\"top\" width=\"33%\">";
    		echo "<a href =\"show-album.php?albumid={$row['ID']}\">";
		
		if ($row['new'] == "Yes")
		{ echo "<b>(NEW)</b>"; }
		echo $row['artist'];
		echo "</a>";
    		echo "</td>";
    		echo "<td align=\"left\" valign= \"top\" width=\"33%\">";
    		echo "<a href =\"show-album.php?albumid={$row['ID']}\">{$row['title']}</a>";
    		echo "</td>";
    		echo "<td align=\"left\" width=\"34%\">";
    		echo shrinkComments($row['artistnote']);
    		echo "</td></tr>";
    		echo "
    		      ";
    	}
    	echo "</table>";
    	echo "<br><br>";
    	
    	
    	$results = mysql_query($query,$dbs);
		$num = mysql_num_rows($results);
		if ($num%$view != 0)
			$num = (int)($num/$view) + 1;
		else
			$num = (int)($num/$view);
		
		if ($page != 1)
		{
			$prev = $page-1;
			echo "<a href=\"reviews.php?p=$prev&v=$view&s=$search\">previous</a>";
			echo " ";
		}
		for ($i = 1; $i <= $num; $i++)
		{
			if ($page != $i)
				echo "<a href=\"reviews.php?p=$i&v=$view&s=$search\">$i</a>";
			else
				echo $i;
			echo " ";
		}
		if ($page != $num)
		{
			$next = $page+1;
			echo "<a href=\"reviews.php?p=$next&v=$view&s=$search\">next</a>";
			echo " ";
		}


    }
	
	
	
	include "../inc/database.inc.php";

		$p = $_GET['p'];
		$v = $_GET['v'];
		$s = $_GET['s'];

   		if (!$p)
   			$p = 1;
   		if (!$v)
   			$v = 20;

   		if (!$s)
   		{
   			$q = "SELECT * FROM reviews_album ORDER BY id DESC";
   			$s = " ";
   		}
   		else
   		{	
   			$q = "SELECT * FROM reviews_album WHERE artist LIKE '%".$s."%' OR title LIKE '%".$s."%' OR comments LIKE '%".$s."%' ORDER BY id DESC";
   		}
 	displayResults($q,$p,$v,$s,$db);


		
	?>





	<!-- End Of Main Content -->
	<div valign="bottom">
	<?php include("footer.inc.htm"); ?>
	</div>
	</td>
</tr>
<tr>
	
</tr>
	
</table>



</div>
</body>
</html>
