<?php include 'inc/common_start.php'; ?>
<body>
<?php include 'inc/navbar.php'; ?>
<?php
$max = 10;
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
    <div style="background-image: url(images/edgethisweekbannerarch.jpg); height: 150px;" class="rounded">
    </div>
    <br>
      <div class="roundedcontainer">
        <div class="rounded">
          <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM cup WHERE Display='N' ORDER BY Date DESC LIMIT ".$limits.",$max",$db);
$totalres = mysql_result(mysql_query("SELECT count(*) as tot FROM cup WHERE Display='N' ORDER BY Date DESC"),0);
$totalpages = ceil($totalres / $max); 
  ?>
              <?php
$count = 0;
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
  echo "<span style='font-size: 20px; text-decoration: none; line-height: 22px; font-weight: bold; color: rgb(31, 31, 31);'>" . $myrow["Title"] . "</span>";
  echo "<br />";
  echo"<span style=\"color: #B30000; line-height: 20px;\">$sd[6]$sd[7]/$sd[4]$sd[5]/$sd[0]$sd[1]$sd[2]$sd[3] @ " . $myrow["start"] . " - " . $myrow["end"] . "</span>";
  echo "<br />";
  echo'<div style="line-height: 16px;">';
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
	  $count++;
	  echo'</div></div>';
    }
 ?>
      <?php
            if($p != 1) {
echo '<a style="margin: 10px 0 10px 0; padding: 2px; font-weight: bold;" href="http://www.edgeradio.org.au/whats_on_archive.php?p='; echo $p-1; echo'"><< Previous Page</a> ';
}
if($p != $totalpages) {
   echo '<a style="margin: 10px 0 10px 0; padding: 2px; font-weight: bold;" href="http://www.edgeradio.org.au/whats_on_archive.php?p='; echo $p+1; echo'">Next Page >></a>';
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
