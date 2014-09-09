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
    <div style="background-image: url(images/edgeerrbanner.jpg); height: 150px;" class="rounded">
    </div>
    <br>
      <div class="roundedcontainer">
        <div class="rounded">
        
         <table style="width: 100%;" cellpadding="10" cellspacing="5">
              			  <tbody>
            <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM hub ORDER BY id DESC LIMIT ".$limits.",$max",$db);
$totalres = mysql_result(mysql_query("SELECT count(*) as tot FROM hub ORDER BY id DESC"),0);
$totalpages = ceil($totalres / $max); 
  ?>
        
              <?php
    $count = 0;
    $currentDate = null;
    while ($myrow = mysql_fetch_array($result)) {
     
     $sd = $myrow["StartDate"];
            $se = $myrow["EndDate"];
     ?><tr>
			  <td style="background-color: rgb(246, 246, 246); text-align: center; vertical-align: middle; width: 100px;"><a href="<?php echo $myrow['URL']; ?>"><img style="border: 0px none; width: 60px; height: 60px;" src="<?php echo $myrow['cover']; ?>"></a><br><span style="color: rgb(150, 150, 150); font-size: 10px; line-height: 16px;"><?php echo "$sd[6]$sd[7]/$sd[4]$sd[5] - $se[6]$se[7]/$se[4]$se[5]"; ?></span></td><td style="background-color: rgb(246, 246, 246);"><a href="<?php echo $myrow['URL']; ?>" border="0" style="text-decoration: none; font-weight: bold; color: rgb(255, 42, 42); line-height: 18px; "><?php echo $myrow['Artist']; ?> - <?php echo $myrow['Album']; ?></a><br><span style="color: rgb(150, 150, 150); line-height: 16px;"><?php echo $myrow['Label']; ?></span><br><div style="padding-top: 3px; font-size: 12px; line-height: 16px; color: rgb(0, 0, 0);"><?php if($myrow["Description"]) { echo '' . stripslashes($myrow["Description"]) . ''; } ?></div></td>

</tr>
<?php
    $count++;
 }
 echo'</tbody></table>
<br>';
if($p != 1) {
echo '<a style="margin: 10px 0 10px 0; padding: 2px; font-weight: bold;" href="http://www.edgeradio.org.au/err_archive.php?p='; echo $p-1; echo'"><< Previous Week</a> ';
}
if($p != $totalpages) {
   echo '<a style="margin: 10px 0 10px 0; padding: 2px; font-weight: bold;" href="http://www.edgeradio.org.au/err_archive.php?p='; echo $p+1; echo'">Next Week >></a>';
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
<br>
<?php include 'inc/common_end.php'; ?>
