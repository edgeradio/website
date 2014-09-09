  <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM hub ORDER BY id DESC LIMIT 5",$db);
    $currentDate = null;
    while ($myrow = mysql_fetch_array($result)) {
$address = $myrow["URL"]; 
$image = $myrow['cover'];
$image = stripslashes($image);
$image = str_replace(" ","%20",$image);
        echo "<li><div class=\"roundednew bslink\" onclick=\"window.open('" . $address . "');\" title=\"<b>" .$myrow["Artist"] ."</b> - " .$myrow["Album"] ." (" .$myrow["Label"] .")<br>";$description = stripslashes($myrow["Description"]);if($description) echo '<small>' . $description . '</small>';echo"\" style=\"cursor: pointer; width: 81px; height: 100px; margin-right: 15px; background-image: url('"; echo $image; echo"'); background-position: center center;\"></div></li>";
} ?>