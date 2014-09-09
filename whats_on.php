<?php include 'inc/common_start.php'; ?>
<body>
<?php include 'inc/navbar.php'; ?>
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
    <div style="background-image: url(images/edgethisweekbanner.jpg); height: 150px;" class="rounded">
    </div>
    <br>
      <div class="roundedcontainer">
        <div class="rounded">
          <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM cup WHERE Display='Y' AND expire > NOW() ORDER BY expire ASC",$db);
  ?>
  <table style="width: 100%;" cellpadding="10" cellspacing="5">
              <?php
$count = 0;
    while ($myrow = mysql_fetch_array($result)) {
      $sd = $myrow["Date"];
  $counttitle = strlen($myrow["Title"]);
  $counttext = strlen($myrow["Description"]);
  $text = substr($myrow["Description"], 0, 240);
  $show_id = $myrow["show_id"];
  mysql_select_db("edge_programs",$db);
  $inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_time, DATE_FORMAT(end_time,'%h:%i%p') as end_time FROM program_info WHERE id='$show_id' LIMIT 1");
  while ($info = mysql_fetch_array($inforesult)) {
   $start = $info['start_time'];
   $end = $info['end_time'];
   $day = $info['day_time'];
   $seotitle = $info['seotitle'];
   if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }
   }
        if (($count % 2) == 0)
        {
            $bg = "#F2F2F2";        //change this
        }
        else
        {
            $bg = "#FFFFFF";        //and this
        }
?>
			  <tr>
			  <?php
			  echo'<td style="background-color: rgb(246, 246, 246); vertical-align: top; width: 100px;"><a href="http://www.edgeradio.org.au/programs/'.$day.'/'.str_replace(" ","-",$seotitle).'/"><img style="border: 0px none; width: 100px; height: 100px;" src="' . $img . '"></a></td>';
			  echo'<td style="background-color: rgb(246, 246, 246);">';
 echo "<a href='http://www.edgeradio.org.au/programs/".$day."/".str_replace(" ","-",$seotitle)."/' border='0' style='text-decoration: none; font-weight: bold; color: #FF2A2A;'>"; echo $myrow["Title"]; echo"</a><br>";
  echo "<span style='color: rgb(150, 150, 150); line-height: 16px;'>".$day." @ " . $start . " - " . $end . "</span>";
  echo "<br />";
  if($myrow["Description"]) {
   echo "<div style='padding-top: 3px; font-size: 12px; line-height: 16px; color: #000000;'>"; if($counttext > 240) { echo $text.'...'; } else { echo $text; }echo"</div>";
   }
echo'</td>
</tr>';
    }
 ?>
 </table>
      </div>
      <div id="footer">
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>
