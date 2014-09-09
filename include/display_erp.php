<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title>Edge Radio Presents</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="/frames.css" type="text/css" />
 </head>

 <body>
<?php
 include "../include/database.inc.php";
 $result = mysql_query("SELECT * FROM Events WHERE Display='Y' ORDER BY Date ASC",$db);

 while ($myrow = mysql_fetch_array($result)) {
  $sd = $myrow["Date"];
  echo "<font color=\"#B30000\">$sd[6]$sd[7]/$sd[4]$sd[5]/$sd[0]$sd[1]$sd[2]$sd[3]</font> @ " . $myrow["start"] . " - " . $myrow["finish"] . ": <u>" . $myrow["Title"] . "</u><br />";
?><p>
<strong>Venue:</strong> <?php echo($myrow["Venue"]); ?><br />
<?php
 if($myrow["Description"]) { ?>
<?php echo($myrow["Description"]) ?><br /><?php echo($myrow["Description2"]) ?><br />
<?php
 }
 if($myrow["Charity"]) { ?>
<?php echo($myrow["Charity"]) ?></br />
<?php
 }
 if($myrow["Performers"]) { ?>
<?php echo($myrow["Performers"]) ?></br />
<?php
 }
 if($myrow["Cost"]) { ?>
<strong>Cost:</strong> <?php echo($myrow["Cost"]) ?><br />
<?php
 }
 if($myrow["Conclusion"]) { ?>
<?php echo($myrow["Conclusion"]) ?><br />
<?php
 }
 if ($myrow["URL"]) { ?>
 <br />
 <strong>For further information,</strong> <a href="<?php
  if(!preg_match('/^http:\/\//', $myrow["URL"])) {
   echo('http://' . $myrow["URL"]);
  }
  else echo($myrow["URL"]);
?>" target="_blank">click here.</a><?php
 }
?>
</p>
<?php
}
?>
  <strong><a href="/erp_archive.php" target="_top">Archived Entries</a></strong>
 </body>
</html>
