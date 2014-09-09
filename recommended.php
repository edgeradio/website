<?php include 'inc/common_start.php'; ?>
<body>
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="left_column">
      <?php include 'inc/box_supporter.php'; ?>
    </div>
    <div id="right_column">
         <?php include 'inc/box_flickr.php'; ?>
    </div>
    <div id="three_column">
    <div style="background-image: url(images/edgeerrbanner.jpg); height: 150px;" class="rounded">
    </div>
    <br>
      <div class="rounded">
          <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM hub ORDER BY id DESC LIMIT 5",$db);
  ?>
        
              <?php
    $count = 0;
    $currentDate = null;
    while ($myrow = mysql_fetch_array($result)) {
        if (($count % 2) == 0)
        {
            $bg = "#F2F2F2";        //change this
        }
        else
        {
            $bg = "#FFFFFF";        //and this
        }
        $sd = $myrow["Date"];
?>
               <div style="background-color: <?php echo($bg); ?>; padding: 20px 10px 20px 10px;">
			   <?php
//        if(strtotime($myrow["StartDate"]) != strtotime($currentDate)) {
            if($currentDate != null)
            $currentDate = $myrow["StartDate"];
            $sd = $myrow["StartDate"];
            $se = $myrow["EndDate"];
            if($sd[4] == null)
             echo "Date: <strong>$sd</strong><br />";
            else
             echo "Date: <strong>$sd[6]$sd[7]/$sd[4]$sd[5]/$sd[0]$sd[1]$sd[2]$sd[3] - $se[6]$se[7]/$se[4]$se[5]/$se[0]$se[1]$se[2]$se[3]</strong><br />";
//        }
echo'<img style="float: right; width: 60px; height: 60px;" src="' . $myrow['cover'] . '">';

	   if ($myrow["URL"]) { 
		
			$address = '';
			if(!preg_match('/^http:\/\//', $myrow["URL"])) {
                $address = 'http://' . $myrow["URL"];
            }  else {
				$address = $myrow["URL"]; 
			}
			echo'<span style="font-size: 20px; text-decoration: none; line-height: 22px; font-weight: bold; color: rgb(31, 31, 31);">';
		
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
				 echo 'Artist: <a style="font-size: 20px; text-decoration: none; line-height: 22px; font-weight: bold; color: rgb(31, 31, 31);" href="' . $address . '" target="_blank">';
             } 
			
			echo($myrow["Artist"]); ?>
                  </a>
                  <?php
      
	  } else {
            echo "Artist: " . $myrow["Artist"] . "";
	  }
	  echo'<br>';
        echo "Album: " . $myrow["Album"] . "";
		echo'<br>';
		echo "Label: " . $myrow["Label"] . "";
        echo'</span>';
?>
<br>
<div style="margin-top: 5px; line-height: 16px;">
                  <?php if($myrow["Description"]) echo '' . stripslashes($myrow["Description"]) . ''; ?>
                  <br />
                  <?php 
    $count++;
    echo'</div></div>';
 }
 echo'<br><strong><a href="err_archive.php" target="_top">Archived Entries</a></strong>';

            ?>
      </div>
      <div id="footer">
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>
