 <?php
    

echo'
   <script type="text/javascript" src="http://www.edgeradio.org.au/include/jquery.js"></script>
<script type="text/javascript" src="http://www.edgeradio.org.au/include/fade-plugin.js"></script>
 <style>
a:link {
	color: #2B2B2B;
}
a:visited {
	color: #2B2B2B;
}
a:hover {
	color: #2B2B2B;
}
  </style>';
  
  
  
  include'inc/database.inc.php';
$result = mysql_query("SELECT * FROM cup WHERE Display='Y' ORDER BY Date ASC",$db);
?>
<table style="width: 100%; height: 60px; padding: 5px 10px 10px 10px;">
<tr>
	<td style="vertical-align: top;">
<div id="transitionEffect">
<?php
$count = 0;
 while ($myrow = mysql_fetch_array($result)) {
  $counttitle = strlen($myrow["Title"]);
  $text = substr($myrow["Description"], 0, 100);
  $textsub = substr($myrow["Description"], 0, 100);
  $show_id = $myrow["show_id"];
  mysql_select_db("edge_programs",$db);
  $inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_time, DATE_FORMAT(end_time,'%h:%i%p') as end_time FROM program_info WHERE id='$show_id' LIMIT 1");
  while ($info = mysql_fetch_array($inforesult)) {
   $title = $info['title'];
   $start = $info['start_time'];
   $end = $info['end_time'];
   $day = $info['day_time'];
   $seotitle = $info['seotitle'];
   if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }
   }
  ?> 
  <div style="margin: 2px 0px 0px 5px;" class="slide">
<?php
  echo "<a href='http://www.edgeradio.org.au/programs/".$day."/".str_replace(' ','-',$seotitle)."/' border='0' target='_blank' style='font-size: 11px; text-decoration: none; font-weight: bold;'>"; echo $title; echo"</a> ";
  echo "<span style='font-size: 11px; color: #969696;'>($day @ " . $start . " - " . $end . ")</span>";
  echo "<br />";
  if($myrow["Description"]) {
   echo "<div style='font-size: 11px; padding-top: 2px; color: #333333;'>"; echo $textsub.'...'; 
   }
?>
</div></div>
  <?php
  }
?>
</div>
</td>
</tr>
</table>
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