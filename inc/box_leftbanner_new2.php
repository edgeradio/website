<?php

mysql_select_db('edge_content'); 
$inforesult = mysql_query("SELECT * FROM banners WHERE banner = 'side_2'");
while ($info = mysql_fetch_array($inforesult)) {

?>
<div class="rounded-side-new" onclick="location.href='<?php echo $info['http_url']; ?>';" style="background-image: url(<?php echo $info['image_url']; ?>); cursor: pointer; height: 230px;">

 </div>
 
 <?php } ?>

