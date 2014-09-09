
<div style="width: 300px; height: 140px; padding: 10px 5px 10px 5px; margin-left: auto; margin-right: 0px;">
  <?php
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM cup WHERE Display='Y' AND expire > NOW() ORDER BY expire ASC",$db);
?>






<div id="transitionEffect">
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
  ?> 
  <div class="slide">
<?php
  echo "<a href='http://www.edgeradio.org.au/programs/".$day."/".str_replace(" ","-",$seotitle)."/' border='0' style='text-decoration: none; font-weight: bold; color: #FF2A2A;'>"; echo $myrow["Title"]; echo"</a><br>";
  echo "<span style='color: rgb(150, 150, 150); line-height: 16px;'>".$day." @ " . $start . " - " . $end . "</span>";
  echo "<br />";
  if($myrow["Description"]) {
   echo "<div style='padding-top: 3px; font-size: 12px; line-height: 16px; color: #000000;'>"; if($counttext > 240) { echo $text.'...'; } else { echo $text; }echo"<br><a style=\"color: #333333; font-size: 11px; float: right;\" href=\"http://www.edgeradio.org.au/whats_on.php\">Read More</a></div>";
   }
?>
</div>
  <?php
  }
?>
</div>
    <script type="text/javascript">
      (function($) {
        function init() {
          $("#transitionEffect").fadeTransition({pauseTime: 4000,
                                                 transitionTime: 1000,
                                                 manualNavigation: false,
                                                 pauseOnMouseOver: true,
                                                 createNavButtons: false});
        }
        
        $(document).ready(init);
      })(jQuery);
    </script>
    
    </div>