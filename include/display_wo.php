<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title>What's On Edge</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="/frames.css" type="text/css" />
 </head>

 <body>
<?php
 include "../include/database.inc.php";
 $result = mysql_query("SELECT * FROM Cup WHERE Display='Y'ORDER BY Date ASC",$db);

 while ($myrow = mysql_fetch_array($result)) {
  $sd = $myrow["Date"];
  print "<font color=\"#B30000\">$sd[6]$sd[7]/$sd[4]$sd[5]/$sd[0]$sd[1]$sd[2]$sd[3]</font> @ " . $myrow["start"] . " - " . $myrow["end"] . ": ";
  echo "<u>" . $myrow["Title"] . "</u>";
  echo "<br />";
  if($myrow["Description"])
   echo $myrow["Description"] . "<br />";
  if ($myrow["Link"]) { ?>
 <br />
 <strong>For further information,</strong> <a href="<?php
  if(!preg_match('/^http:\/\//', $myrow["Link"])) {
   echo('http://' . $myrow["Link"]);
  }
  else echo($myrow["Link"]);
?>" target="_blank">click here.</a><br /><?php
 }
?><br />
<?php
 }
?>
  <strong><a href="/whats_on_archive.php" target="_top">Archived Entries</a></strong>

 </body>

</html>
