  <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM hub WHERE Archived='N' ORDER BY StartDate ASC",$db);
    $currentDate = null;
    while ($myrow = mysql_fetch_array($result)) {
$address = $myrow["URL"]; 
$image = $myrow['cover'];
        echo "
<li><div class=\"roundednew bslink\" onclick=\"window.open('" . $address . "');\" title=\"<b>" .$myrow["Artist"] ."</b> - " .$myrow["Album"] ." (" .$myrow["Label"] .")<br>";$description = stripslashes($myrow["Description"]);if($description) echo '<small>' . $description . '</small>';echo"\" style=\"cursor: pointer; width: 81px; height: 100px; margin-right: 15px; background-image: url('".$image."'); background-position: center center;\"></li>";
} ?>