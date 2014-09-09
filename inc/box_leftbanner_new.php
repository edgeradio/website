<script language="JavaScript">
<!-- Soundcloud Box By:  Alastair Ling -->

function popUpsoundcloud(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=600');");
}
</script>

<?php

mysql_select_db('edge_content'); 
$inforesult = mysql_query("SELECT * FROM banners WHERE banner = 'side_1'");
while ($info = mysql_fetch_array($inforesult)) {

?>
<div class="rounded-side-new" onclick="location.href='<?php echo $info['http_url']; ?>';" style="background-image: url(<?php echo $info['image_url']; ?>); cursor: pointer; height: 290px;">

 </div>
 
 <?php } ?>

