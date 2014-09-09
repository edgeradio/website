<h1 class="greyheader">Edge News</h1>
<div class="newstext">
  <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM news WHERE Display='Y' ORDER BY Date DESC",$db);
 while ($myrow = mysql_fetch_array($result)) {
  $sd = $myrow["Date"];
  print "<font color=\"#B30000\">$sd[6]$sd[7]/$sd[4]$sd[5]/$sd[0]$sd[1]$sd[2]$sd[3]</font> - ";
  echo "<u>" . $myrow["Title"] . "</u>";
  echo "<br />";
  if($myrow["Content"])
   echo $myrow["Content"] . "<br />";
  if($myrow["Content2"]) 
   echo $myrow["Content2"] . "<br />";
  if($myrow["Content3"]) 
   echo $myrow["Content3"] . "<br />";
  if($myrow["Content4"]) 
   echo $myrow["Content4"] . "<br />";
  if ($myrow["URL"]) { ?>
  <strong>For further information,</strong> <a href="<?php
   if(!preg_match('/^http:\/\//', $myrow["URL"])) {
    echo('http://' . $myrow["URL"]); 
   }
   else echo($myrow["URL"]);
?>" target="_blank">click here.</a>
  <?php
 }
?>
  <hr />
  <?php
 }
?>
  <strong><a href="news_archive.php" target="_top">Archived Entries</a></strong> </div>
