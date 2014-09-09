<h1 class="greyheader">Whats On Edge?</h1>
<div class="newstext">
  <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM cup WHERE Display='Y'ORDER BY Date ASC",$db);

 while ($myrow = mysql_fetch_array($result)) {
  $sd = $myrow["Date"];
  print "<font color=\"#B30000\">$sd[6]$sd[7]/$sd[4]$sd[5]/$sd[0]$sd[1]$sd[2]$sd[3]</font> @ " . $myrow["start"] . " - " . $myrow["end"] . ": ";
  echo "<u>" . $myrow["Title"] . "</u>";
  echo "<br />";
  if($myrow["Description"])
   echo $myrow["Description"] . "<br />";
  if ($myrow["Link"]) { ?>
  <strong>For further information,</strong> <a href="<?php
  if(!preg_match('/^http:\/\//', $myrow["Link"])) {
   echo('http://' . $myrow["Link"]);
  }
  else echo($myrow["Link"]);
?>" target="_blank">click here.</a><br />
  <?php
 }
?>
  <hr />
  <?php
 }
?>
  <strong><a href="whats_on_archive.php">Archived Entries</a></strong> </div>
