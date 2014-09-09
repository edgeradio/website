<h1 class="greyheader">Edge Radio Recommends</h1>
<div class="newstext">
  <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM hub WHERE Archived='N' ORDER BY StartDate ASC",$db);
    $currentDate = null;
    while ($myrow = mysql_fetch_array($result)) {
if(strtotime($myrow["StartDate"]) != strtotime($currentDate)) {
            if($currentDate != null)
                break;
            $currentDate = $myrow["StartDate"];
            $sd = $myrow["StartDate"];
            $se = $myrow["EndDate"];
            echo "<div style=\"float: right; padding-bottom: 2px; color: #B30000;\">$sd[6]$sd[7]/$sd[4]$sd[5]/$sd[0]$sd[1]$sd[2]$sd[3] - $se[6]$se[7]/$se[4]$se[5]/$se[0]$se[1]$se[2]$se[3]</div>";
        }
$address = $myrow["URL"]; 
        echo "
<table style=\"width: 100%;\" cellpadding=\"0\" cellspacing=\"0\">
<tr>
<td style=\"width: 60px;\"><a href=\"" . $address . "\" target=\"_blank\">"; if($myrow['cover'] == NULL) { echo '<img border="0" src="images/err-default.jpg">'; } else { echo '<img style="width: 50px; height: 50px;" border="0" src="' . $myrow["cover"] . '">'; } echo"</a></td>
<td>
";
        
		if ($myrow["URL"]) { 
		
			$address = '';
			if(!preg_match('/^http:\/\//', $myrow["URL"])) {
                $address = 'http://' . $myrow["URL"];
            }  else {
				$address = $myrow["URL"]; 
			}
		
         	if(preg_match('/musicSampler/i', $address)) { ?>
  <a href="javascript: void(0)" 
   onclick="window.open('http://www.edgeradio.org.au/musicSampler.htm', 
  'windowname2', 
  'width=304, \
   height=401, \
   directories=no, \
   location=no, \
   menubar=no, \
   resizable=no, \
   scrollbars=no, \
   status=no, \
   toolbar=no'); 
  return false;">
  <?php } else {
				 echo '<a href="' . $address . '" target="_blank">';
             } 
			
			echo($myrow["Artist"]); ?>
</a>
  <?php
      
	  } else {
            echo "<u>" . $myrow["Artist"] . "</u>";
	  }
        echo " - <strong>" . $myrow["Album"] . "</strong> (" . $myrow["Label"] . ")";
?>
  
  <?php 
  
  $description = stripslashes($myrow["Description"]);
  if($description) echo '<br><em>' . $description . '</em>'; ?>
</td>
</tr>
</table>
  <hr />
  <?php 

} ?>
  <strong><a href="err_archive.php" target="_top">Archived Entries</a></strong> </div>
