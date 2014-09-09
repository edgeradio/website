<style>

.speech-bubble
  {
   width: 720px;
   padding: 10px;
   background: #404040;
   color: #fff;
   font: normal 18px Arial;
   -moz-border-radius: 10px;
   -webkit-border-radius: 10px;
   border-radius: 10px;
  }
  .speech-bubble:after
  {
   content: "";
   border: solid 10px transparent; /* set all borders to 10 pixels width */
   border-top-color: #404040; /* the callout */
   border-bottom: 0; /* we do not need the bottom border in this case */
   width: 0;
   height: 0;
   overflow: hidden;
   display: block;
   position: relative;
   bottom: -20px; /* border-width of the :after element + padding of the root element */
   margin: ;
  }
  
  
  .speech-name
  {
   width: 720px;
   padding: 15px 10px 20px 10px;
   color: #000;
   font: normal 12px Arial;
  }

</style>

<?php
 include'../inc/database.inc.php';
  mysql_select_db("edge_content",$db);
  
  $emresult = mysql_query("SELECT * FROM studio_email ORDER BY date_sent DESC LIMIT 5");
while ($em = mysql_fetch_array($emresult)) {

?>


 <div class="speech-bubble"><?php echo $em['message']; ?></div>
 <div class="speech-name"><?php echo $em['name']; ?> from <?php echo $em['suburb']; ?> <i>(Phone Number: <?php echo $em['mobile_no']; ?>)</i><div style="float: right;"><?php echo date("d/m/Y g:i A", strtotime($em['date_sent'])); ?></div></div>

<?php

}
