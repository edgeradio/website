<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title>Edge Radio Recommended</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="/frames.css" type="text/css" />
 </head>

 <body>
<?php
 include "../include/database.inc.php";
 $result = mysql_query("SELECT * FROM Hub WHERE Archived='N' ORDER BY StartDate ASC",$db);
    $currentDate = null;
    while ($myrow = mysql_fetch_array($result)) {
        if(strtotime($myrow["StartDate"]) != strtotime($currentDate)) {
            if($currentDate != null)
                break;
            $currentDate = $myrow["StartDate"];
            $sd = $myrow["StartDate"];
            $se = $myrow["EndDate"];
            echo "<font color=\"#B30000\">$sd[6]$sd[7]/$sd[4]$sd[5]/$sd[0]$sd[1]$sd[2]$sd[3] - $se[6]$se[7]/$se[4]$se[5]/$se[0]$se[1]$se[2]$se[3]</font>";
        }
        echo "<li>";
        if ($myrow["URL"]) { ?>
            <a href="<?php
                if(!preg_match('/^http:\/\//', $myrow["URL"])) {
                    echo('http://' . $myrow["URL"]);
                }
                else echo($myrow["URL"]); ?>" target="_blank"><?php echo($myrow["Artist"]); ?></a><?php
        }
        else
            echo "<u>" . $myrow["Artist"] . "</u>";

        echo " - <strong>" . $myrow["Album"] . "</strong> (" . $myrow["Label"] . ")";
?></li>
<?php if($myrow["Description"]) echo '<em>' . $myrow["Description"] . '</em>'; ?><br />
<br />
<?php } ?>
  <strong><a href="/err_archive.php" target="_top">Archived Entries</a></strong>
 </body>
</html>
