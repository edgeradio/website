<?php

function display_prizes($result) {
?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><?php
    mysql_data_seek($result, 0);
    $count = 0;
    while ($myrow = mysql_fetch_array($result)) {
        if (($count % 2) == 0)
        {
            $bg = "#CCCCCC";        //change this
        }
        else
        {
            $bg = "#FFFFFF";        //and this
        }
        $sd = $myrow["Date"];
?>
<tr bgcolor="<?php echo($bg); ?>">
 <td>
   <span class="style1">
    <strong>Available on: <font color="#FF0000"><?php print $myrow["Program"] . " ($sd[6]$sd[7]/$sd[4]$sd[5]/$sd[0]$sd[1]$sd[2]$sd[3])"; ?></font></strong>
   </span>
  </td>
 </tr>
 <tr bgcolor="<?php echo($bg); ?>">
  <td>
   <span class="style1"><?php echo($myrow["Prize"]); ?> - <?php echo($myrow["Description"]); ?></span>
  </td>
 </tr>
 <tr bgcolor="<?php echo($bg); ?>">
  <td class="style1">
   <strong>Winner:</strong> <?php echo($myrow["First"]); ?> <?php echo($myrow["Suburb"]); ?>
  </td>
 </tr>
<?php
      $count++;
    }
 ?></table><?php
}
?>
