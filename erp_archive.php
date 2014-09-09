<?php include 'inc/common_start.php'; ?>
<body>
<?php include 'inc/navbar.php'; ?>
<?php
$max = 5;
$p = $_GET['p'];
if(empty($p))
{
$p = 1;
}
$limits = ($p - 1) * $max;
?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="left_column">
     <?php include 'inc/box_supporter.php'; ?>
     <br />
     <?php include 'inc/box_newsletter.php'; ?>
    </div>
    <div id="right_column">
       <?php include 'inc/box_flickr.php'; ?>
    </div>
    <div id="three_column">
    <div style="background-image: url(images/edgepresbanner.jpg); height: 150px;" class="rounded">
    </div>
    <br>
      <div class="roundedcontainer">
        <div class="rounded">
            <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM events WHERE display = 'Y' ORDER BY date DESC LIMIT ".$limits.",$max",$db);
$totalres = mysql_result(mysql_query("SELECT count(*) as tot FROM events WHERE display = 'Y' ORDER BY date DESC"),0);
$totalpages = ceil($totalres / $max); 
  ?>
              <?php
	$count = 0;
    while ($myrow = mysql_fetch_array($result)) {
    	if (($count % 2) == 0)
    	{
    		$bg = "#F2F2F2";		//change this
    	}
    	else
    	{
    		$bg = "#FFFFFF";		//and this
    	}
        $sd = $myrow["Date"];
?>
              <div style="background-color: <?php echo($bg); ?>; padding: 20px 10px 20px 10px;">
                <?php
                 echo "<span style='font-size: 20px; text-decoration: none; line-height: 22px; font-weight: bold; color: rgb(31, 31, 31);'>" . $myrow["Title"] . "</span>";
  echo "<br />";
  echo"<span style=\"color: #B30000; line-height: 20px;\">Date Posted: $sd[6]$sd[7]/$sd[4]$sd[5]/$sd[0]$sd[1]$sd[2]$sd[3] @ " . $myrow["start"] . " - " . $myrow["finish"] . "</span>";
  echo "<br />";
  echo'<div style="line-height: 16px;">';
?>
                  <p> <strong>Venue:</strong> <?php echo($myrow["Venue"]); ?><br />
                    <?php
 if($myrow["Description"]) { ?>
                    <?php echo($myrow["Description"]) ?><br />
                    <?php echo($myrow["Description2"]) ?><br />
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
                    <strong>For further information,</strong> <a href="<?php
  if(!preg_match('/^http:\/\//', $myrow["URL"])) {
   echo('http://' . $myrow["URL"]);
  }
  else echo($myrow["URL"]);
?>" target="_blank">click here.</a>
                    <?php
 }
	  $count++;
	  echo'</div></div>';
    }
 ?>
      <?php
            if($p != 1) {
echo '<a style="margin: 10px 0 10px 0; padding: 2px; font-weight: bold;" href="http://www.edgeradio.org.au/erp_archive.php?p='; echo $p-1; echo'"><< Previous Page</a> ';
}
if($p != $totalpages) {
   echo '<a style="margin: 10px 0 10px 0; padding: 2px; font-weight: bold;" href="http://www.edgeradio.org.au/erp_archive.php?p='; echo $p+1; echo'">Next Page >></a>';
  }
            ?>
            <br><br></div>
      </div>
      <div id="footer">
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>
