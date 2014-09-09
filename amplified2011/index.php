<?php include 'common_start.php'; ?>
<?php include '../inc/database.inc.php'; ?>
<body>
<?php include '../inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div style="height: 115px;" align="center"></div>
    <div id="left_column">
      <div class="rounded">
        <img src="aboutamplified.gif">
    
            <p>Amplified 2011 is the sixth installment of Tasmania's annual music industry festival.</p>
<p>This year featuring 98 performances across 22 events in 9 venues, Amplified has evolved as CMST steps up to the role of delivering this program. Also featuring 11 training opportunities across a series of workshops and presentations, Amplified continues to deliver great outcomes for the Tasmanian music community.</p>
         
      </div>
      <br />
      <div onclick="window.open('http://www.edgeradio.org.au/erp_archive.php'); return false;" class="rounded" style="cursor: pointer; background-image: url(amp-poster.jpg); height: 297px;">
      </div>
      <br />
      <div onclick="window.open('http://www.facebook.com/event.php?eid=137796426300959'); return false;" class="rounded" style="cursor: pointer; background-image: url(S2L-Edge-Radio-Banner.gif); height: 297px;">
      </div>
    </div>
    <div id="two_column">
    <div class="rounded">
    <img src="ampliweek.gif">
    
            <p>Edge Radio loves to support Tasmanian music - at least 10% of all music heard on Edge is Tasmanian. We have the largest radio catalogue of Tasmanian music in the world!

<p>This year, Edge Radio is celebrating Amplified Week! Amplified is with no doubt the biggest celebration of the Tasmanian music industry. From Monday August 15 to Sunday August 21, you can hear Tasmanian music on high rotation, exclusive Amplified interviews and live performances, as well as all of the info you need on CMST's Amplified 2011.</p>

<p>Throughout Edge Radio's Amplified Week, you'll be able to use the handy calendar below to keep up with the Amplified fun which is happening both on-air and around town.</p>
    </div>
    <br>
      <div class="rounded">
      <img src="upcomingevents.gif">
      
      
<div style="background-color: #000000; color: #FFFFFF; padding: 10px; margin: 20px 5px 5px 5px;"><b>15th August</b></div><table style="width: 100%;" cellpadding="10" cellspacing="5">
<?php 
$inforesult = mysql_query("SELECT * FROM amplified_events WHERE date = '2011-08-15'");
while ($info = mysql_fetch_array($inforesult)) {
?> 
<tr> 
<td style="background-color: rgb(246, 246, 246); vertical-align: top; width: 100px;"><img style="border: 0px none; width: 100px; height: 100px;" src="ampsmall.gif"></td>
<td style="background-color: rgb(246, 246, 246);">
<a href="<?php echo $info['url']; ?>" target="_blank" style="text-decoration: none; font-weight: bold; color: #FF2A2A;"><?php echo stripslashes($info['title']); ?></a>
<br>
<div style="padding-top: 3px; font-size: 12px; line-height: 16px; color: #000000;"><?php echo stripslashes($info['description']); ?></div></td>
<td style="width: 190px; background-color: rgb(246, 246, 246);">
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Venue:</span> <?php echo stripslashes($info['venue']); ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Time:</span> <?php echo $info['time']; ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Cost:</span> <?php echo $info['cost']; ?></span>
</td> 
</tr>
<?php } ?>			 
</table> 
      
<div style="background-color: #000000; color: #FFFFFF; padding: 10px; margin: 20px 5px 5px 5px;"><b>16th August</b></div><table style="width: 100%;" cellpadding="10" cellspacing="5">
<?php 
$inforesult = mysql_query("SELECT * FROM amplified_events WHERE date = '2011-08-16'");
while ($info = mysql_fetch_array($inforesult)) {
?> 
<tr> 
<td style="background-color: rgb(246, 246, 246); vertical-align: top; width: 100px;"><img style="border: 0px none; width: 100px; height: 100px;" src="ampsmall.gif"></td>
<td style="background-color: rgb(246, 246, 246);">
<a href="<?php echo $info['url']; ?>" target="_blank" style="text-decoration: none; font-weight: bold; color: #FF2A2A;"><?php echo stripslashes($info['title']); ?></a>
<br>
<div style="padding-top: 3px; font-size: 12px; line-height: 16px; color: #000000;"><?php echo stripslashes($info['description']); ?></div></td>
<td style="width: 190px; background-color: rgb(246, 246, 246);">
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Venue:</span> <?php echo stripslashes($info['venue']); ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Time:</span> <?php echo $info['time']; ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Cost:</span> <?php echo $info['cost']; ?></span>
</td> 
</tr>
<?php } ?>			 
</table> 
      
<div style="background-color: #000000; color: #FFFFFF; padding: 10px; margin: 20px 5px 5px 5px;"><b>17th August</b></div><table style="width: 100%;" cellpadding="10" cellspacing="5">
<?php 
$inforesult = mysql_query("SELECT * FROM amplified_events WHERE date = '2011-08-17'");
while ($info = mysql_fetch_array($inforesult)) {
?> 
<tr> 
<td style="background-color: rgb(246, 246, 246); vertical-align: top; width: 100px;"><img style="border: 0px none; width: 100px; height: 100px;" src="ampsmall.gif"></td>
<td style="background-color: rgb(246, 246, 246);">
<a href="<?php echo $info['url']; ?>" target="_blank" style="text-decoration: none; font-weight: bold; color: #FF2A2A;"><?php echo stripslashes($info['title']); ?></a>
<br>
<div style="padding-top: 3px; font-size: 12px; line-height: 16px; color: #000000;"><?php echo stripslashes($info['description']); ?></div></td>
<td style="width: 190px; background-color: rgb(246, 246, 246);">
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Venue:</span> <?php echo stripslashes($info['venue']); ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Time:</span> <?php echo $info['time']; ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Cost:</span> <?php echo $info['cost']; ?></span>
</td> 
</tr>
<?php } ?>			 
</table> 
      
<div style="background-color: #000000; color: #FFFFFF; padding: 10px; margin: 20px 5px 5px 5px;"><b>18th August</b></div><table style="width: 100%;" cellpadding="10" cellspacing="5">
<?php 
$inforesult = mysql_query("SELECT * FROM amplified_events WHERE date = '2011-08-18'");
while ($info = mysql_fetch_array($inforesult)) {
?> 
<tr> 
<td style="background-color: rgb(246, 246, 246); vertical-align: top; width: 100px;"><img style="border: 0px none; width: 100px; height: 100px;" src="ampsmall.gif"></td>
<td style="background-color: rgb(246, 246, 246);">
<a href="<?php echo $info['url']; ?>" target="_blank" style="text-decoration: none; font-weight: bold; color: #FF2A2A;"><?php echo stripslashes($info['title']); ?></a>
<br>
<div style="padding-top: 3px; font-size: 12px; line-height: 16px; color: #000000;"><?php echo stripslashes($info['description']); ?></div></td>
<td style="width: 190px; background-color: rgb(246, 246, 246);">
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Venue:</span> <?php echo stripslashes($info['venue']); ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Time:</span> <?php echo $info['time']; ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Cost:</span> <?php echo $info['cost']; ?></span>
</td> 
</tr>
<?php } ?>			 
</table> 

<div style="background-color: #000000; color: #FFFFFF; padding: 10px; margin: 20px 5px 5px 5px;"><b>19th August</b></div><table style="width: 100%;" cellpadding="10" cellspacing="5">
<?php 
$inforesult = mysql_query("SELECT * FROM amplified_events WHERE date = '2011-08-19'");
while ($info = mysql_fetch_array($inforesult)) {
?> 
<tr> 
<td style="background-color: rgb(246, 246, 246); vertical-align: top; width: 100px;"><img style="border: 0px none; width: 100px; height: 100px;" src="ampsmall.gif"></td>
<td style="background-color: rgb(246, 246, 246);">
<a href="<?php echo $info['url']; ?>" target="_blank" style="text-decoration: none; font-weight: bold; color: #FF2A2A;"><?php echo stripslashes($info['title']); ?></a>
<br>
<div style="padding-top: 3px; font-size: 12px; line-height: 16px; color: #000000;"><?php echo stripslashes($info['description']); ?></div></td>
<td style="width: 190px; background-color: rgb(246, 246, 246);">
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Venue:</span> <?php echo $info['venue']; ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Time:</span> <?php echo $info['time']; ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Cost:</span> <?php echo $info['cost']; ?></span>
</td> 
</tr>
<?php } ?>			 
</table> 

<div style="background-color: #000000; color: #FFFFFF; padding: 10px; margin: 20px 5px 5px 5px;"><b>20th August</b></div><table style="width: 100%;" cellpadding="10" cellspacing="5">
<?php 
$inforesult = mysql_query("SELECT * FROM amplified_events WHERE date = '2011-08-20'");
while ($info = mysql_fetch_array($inforesult)) {
?> 
<tr> 
<td style="background-color: rgb(246, 246, 246); vertical-align: top; width: 100px;"><img style="border: 0px none; width: 100px; height: 100px;" src="ampsmall.gif"></td>
<td style="background-color: rgb(246, 246, 246);">
<a href="<?php echo $info['url']; ?>" target="_blank" style="text-decoration: none; font-weight: bold; color: #FF2A2A;"><?php echo stripslashes($info['title']); ?></a>
<br>
<div style="padding-top: 3px; font-size: 12px; line-height: 16px; color: #000000;"><?php echo stripslashes($info['description']); ?></div></td>
<td style="width: 190px; background-color: rgb(246, 246, 246);">
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Venue:</span> <?php echo $info['venue']; ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Time:</span> <?php echo $info['time']; ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Cost:</span> <?php echo $info['cost']; ?></span>
</td> 
</tr>
<?php } ?>			 
</table> 

<div style="background-color: #000000; color: #FFFFFF; padding: 10px; margin: 20px 5px 5px 5px;"><b>21st August</b></div><table style="width: 100%;" cellpadding="10" cellspacing="5">
<?php 
$inforesult = mysql_query("SELECT * FROM amplified_events WHERE date = '2011-08-21'");
while ($info = mysql_fetch_array($inforesult)) {
?> 
<tr> 
<td style="background-color: rgb(246, 246, 246); vertical-align: top; width: 100px;"><img style="border: 0px none; width: 100px; height: 100px;" src="ampsmall.gif"></td>
<td style="background-color: rgb(246, 246, 246);">
<a href="<?php echo $info['url']; ?>" target="_blank" style="text-decoration: none; font-weight: bold; color: #FF2A2A;"><?php echo stripslashes($info['title']); ?></a>
<br>
<div style="padding-top: 3px; font-size: 12px; line-height: 16px; color: #000000;"><?php echo stripslashes($info['description']); ?></div></td>
<td style="width: 190px; background-color: rgb(246, 246, 246);">
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Venue:</span> <?php echo $info['venue']; ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Time:</span> <?php echo $info['time']; ?></span><br>
<span style="line-heright: 16px;"><span style="text-decoration: none; font-weight: bold; color: #FF2A2A;">Cost:</span> <?php echo $info['cost']; ?></span>
</td> 
</tr>
<?php } ?>			 
</table> 

      
      </div>
      <div id="footer">
        <?php include '../inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../inc/common_end.php'; ?>
